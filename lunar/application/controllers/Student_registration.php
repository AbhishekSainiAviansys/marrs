<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Student_registration
 * ---------------------------------------------------------------
 * Public-facing controller — no login required to reach index().
 * The student picks a class, then an open scheduled batch for that
 * class (subject/series/type/level_id all come from the chosen
 * batch, not raw POST), fills in their details, and gets a CIN to
 * log in with at cin_login.
 *
 * Route suggestion (application/config/routes.php):
 *   $route['register'] = 'student_registration/index';
 * ---------------------------------------------------------------
 *
 * FIX (this version): payment could succeed, the order be marked
 * Paid, and yet the student ends up with no real CIN and no email.
 * Root cause — _finalize_paid_order() did CIN generation, the
 * cin_list/cin_result/new_cart inserts, and the email send inside
 * ONE try/catch. If a later step threw (e.g. an insert failed) after
 * students.purchase_cin had already been saved, the catch swallowed
 * it — but order_success()'s old self-heal only checked
 * `empty($student['purchase_cin'])`, which was now FALSE, so it
 * never retried. reconcile_payment() made it worse: once
 * order.status was already 'Paid', it returned success immediately
 * without checking whether CIN/email had actually completed.
 *
 * Fix: a single idempotent _ensure_post_payment_finalized() that
 * checks the REAL cin_list row (not just the purchase_cin field)
 * before doing any writes, and is called from every path that can
 * land on a Paid order: the happy path, the self-heal in
 * order_success(), and the "already Paid" branch in
 * reconcile_payment(). Also widened the catches to \Throwable so a
 * PHP Error (not just \Exception) can't silently abort mid-step.
 *
 * Requires one small addition to Student_registration_model.php —
 * see cin_list_exists_for_cin() referenced below; add it next to
 * get_existing_cin_list_for_prid() if it isn't there yet:
 *
 *   public function cin_list_exists_for_cin($cin)
 *   {
 *       if (empty($cin)) return false;
 *       return (bool) $this->db->get_where('cin_list', ['cin' => $cin])->row();
 *   }
 */
class Student_registration extends CI_Controller
{
    // Fixed phase boundaries for the Mix & Match "Start Week -> End Week"
    // range picker, mirroring the rows in study_schedule_lunar (Wk 1-8,
    // 9-16, ... 49-52). Re-validated server-side because the client-side
    // <select> options can be tampered with.
    private $allowed_starts = [1, 9, 17, 25, 33, 41, 49];
    private $allowed_ends   = [8, 16, 24, 32, 40, 48, 52];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('student_registration_model');
        $this->load->library(['form_validation', 'session']);
        $this->load->helper(['form', 'url']);
    }

 public function index()
{
    
    // print_R($_SESSION);
    $data['classes']    = $this->student_registration_model->get_open_classes();
    $data['states']     = $this->student_registration_model->get_states();
    $data['associates'] = $this->student_registration_model->get_associates();
    $data['schools']    = $this->student_registration_model->get_schools();
    $data['errors']     = [];
    $data['schedules']  = [];
    $data['franchises'] = [];

    /*
     * LOAD COUNTRIES
     */
    $data['countries'] = $this->db
        ->order_by('country_name', 'ASC')
        ->get('countries')
        ->result_array();

    /*
     * DEFAULT EMPTY DROPDOWNS (School Location cascade — Step 4)
     */
    $data['school_states']    = [];
    $data['school_districts'] = [];
    $data['school_areas']     = [];

    /*
     * REGION cascade dropdowns (Step 5)
     */
    $data['districts'] = [];
    $data['areas']     = [];

    $countryId = $this->input->post('country_id');
    if (!empty($countryId)) {
        $data['school_states'] = $this->student_registration_model->get_states_by_country($countryId);
    }

    $stateId = $this->input->post('state_id');
    if (!empty($stateId)) {
        $data['districts'] = $this->student_registration_model->get_districts_by_state($stateId);
        $data['areas']     = $this->student_registration_model->get_areas_by_state($stateId);

        // Keep school_* populated too, in case the same POST round-trip
        // needs to re-render Step 4's selects with a chosen value.
        $data['school_districts'] = $data['districts'];
        $data['school_areas']     = $data['areas'];
    }

    /*
     * RELOAD SCHEDULES
     */
    if ($this->input->post('class')) {
        $data['schedules'] = $this->student_registration_model
            ->get_schedules_for_class(
                $this->input->post('class')
            );
    }

    /*
     * RELOAD FRANCHISES
     */
    if ($this->input->post('state_id')) {
        $data['franchises'] = $this->student_registration_model
            ->get_franchises_by_state(
                $this->input->post('state_id')
            );
    }

    /*
     * HANDLE SUBMISSION
     */
    if ($this->input->post('register_submit')) {
        $this->_handle_registration($data);
    }

    $this->load->view('student_registration', $data);
}
    /**
     * AJAX: returns open schedules for a class as JSON, used to
     * populate the schedule dropdown when the class changes.
     */
    public function ajax_schedules()
    {
        $class = $this->input->post('class');
        $schedules = $class ? $this->student_registration_model->get_schedules_for_class($class) : [];
        echo json_encode($schedules);
    }

    /**
     * AJAX: returns franchises for a state as JSON, used to populate
     * the franchise dropdown when the state changes.
     */
    public function ajax_franchises()
    {
        $state_id = $this->input->post('state_id');
        $franchises = $state_id ? $this->student_registration_model->get_franchises_by_state($state_id) : [];
        echo json_encode($franchises);
    }

    public function ajax_franchise_by_id()
    {
        $franchise_id = $this->input->post('franchise_id');

        if (empty($franchise_id)) {
            echo json_encode([]);
            return;
        }

        $row = $this->db
            ->select('franchise_id, company_name')
            ->get_where('franchise', ['franchise_id' => $franchise_id])
            ->row_array();

        echo json_encode($row ?: []);
    }

    public function ajax_registration_code()
    {
        $schedule_id = $this->input->post('schedule_id');

        if (empty($schedule_id)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['registration_code' => null]));
        }

        $this->db->select('lunar_schedule_cin.registration_code');
        $this->db->from('lunar_schedule_cin');
        $this->db->where('lunar_schedule_cin.lunar_schedule_id', $schedule_id);
        $this->db->where('lunar_schedule_cin.product_name', 'Lunar Skill Test');
        $this->db->limit(1);

        $row = $this->db->get()->row_array();

        $code = $row['registration_code'] ?? null;

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['registration_code' => $code]));
    }

    /**
     * Validates and processes the registration POST.
     * Mutates $data by reference so index() can re-render the form
     * with errors on failure.
     */
    private function _handle_registration(&$data)
    {
        $this->form_validation->set_rules('student_name', 'Student Name', 'required|trim');
        $this->form_validation->set_rules('class', 'Class', 'required|trim');
        $this->form_validation->set_rules('schedule_id', 'Test Series', 'required|integer');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('stud_email', 'Student Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('stud_phone', 'Student Phone', 'required|trim|numeric|min_length[10]');
        //$this->form_validation->set_rules('father_name', 'Father Name', 'trim');
        //$this->form_validation->set_rules('mother_name', 'Mother Name', 'trim');
        $this->form_validation->set_rules('address1', 'Address', 'required|trim');
        $this->form_validation->set_rules('state_id', 'State', 'required');


        if ($this->form_validation->run() === FALSE) {
            $data['errors'] = $this->form_validation->error_array();
            $data['old']    = $this->input->post();
            return;
        }

        $class     = $this->input->post('class');
        $schedule  = $this->student_registration_model->get_schedule(
            $this->input->post('schedule_id'),
            $class
        );

        if (!$schedule) {
            $data['errors']['schedule_id'] = 'Please select a valid, open test series for this class.';
            $data['old'] = $this->input->post();
            return;
        }

        $cin = $this->student_registration_model->register_student(
            $this->input->post(),
            $schedule
        );

        if (!$cin) {
            $data['errors']['general'] = 'Registration failed. Please try again.';
            $data['old'] = $this->input->post();
            return;
        }

        $this->session->set_flashdata(
            'success',
            "Registration successful! Your CIN is <strong>{$cin}</strong>."
        );

        redirect('student_registration/select_plan/' . $cin, 'refresh');
    }

    /**
     * Entry point for the after-login dashboard's Buy buttons, which
     * only know a student's CIN (cin_list), not the catalog's PRID
     * (students table) — the two are separate identity systems,
     * bridged by cin_list.prid. If that bridge hasn't been made yet
     * (student registered through the legacy CIN system before this
     * catalog existed), this creates the students/PRID row on the
     * fly and backfills cin_list.prid, then sends them on to
     * select_plan() as normal. Preserves ?program= for deep-linking
     * straight into the program they were looking at.
     */
    public function start_from_cin($cin = null)
    {
        if (!$cin) {
            show_404();
            return;
        }

        $cinRow = $this->db->get_where('cin_list', ['cin' => $cin])->row_array();
        if (!$cinRow) {
            show_error('Student not found', 404);
            return;
        }

        $prid = $cinRow['prid'] ?: $this->student_registration_model->create_student_from_cin($cin);

        if (!$prid) {
            show_error('We could not set up your account for purchases. Please contact support.', 500);
            return;
        }

        $target = 'student_registration/select_plan/' . $prid;
        $program = $this->input->get('program');
        if ($program) {
            $target .= '?program=' . $program;
        }

        redirect($target);
    }

    /**
     * Shows the plan list (with Add to Cart) for a just-registered
     * student. $cin is taken from the URL so this page can be
     * reloaded/bookmarked without depending on session/flashdata.
     */
       public function select_plan($cin = null)
    {
        if (!$cin) {
            show_404();
            return;
        }

        $student = $this->student_registration_model->get_student_by_cin($cin);

        if (!$student) {
            show_error('Student not found', 404);
            return;
        }

        $data['student'] = $student;
        $data['lm_content'] = $this->student_registration_model
    ->get_lm_content_for_student($cin, $student['class'] ?? null);

        $lockedProgram = $this->student_registration_model->get_locked_program_for_prid($cin);

        if ($lockedProgram) {
            // Student already owns a program — restrict the catalog to
            // just that program's plans/components (server-enforced too,
            // in add_plan_to_cart()/add_component_to_cart()) and jump
            // straight into its detail view instead of a list they can't
            // really use.
            $data['programs']   = [$lockedProgram];
            $data['plans']      = array_values(array_filter(
                $this->student_registration_model->get_active_plans_catalog(),
                function ($p) use ($lockedProgram) { return (int) $p['program_id'] === (int) $lockedProgram['id']; }
            ));
            $data['components'] = array_values(array_filter(
                $this->student_registration_model->get_active_components_catalog(),
                function ($c) use ($lockedProgram) { return (int) $c['program_id'] === (int) $lockedProgram['id']; }
            ));
            $data['locked_program']  = $lockedProgram;
            $data['open_program_id'] = $lockedProgram['id'];
        } else {
            // First purchase — free to browse, but only among programs
            // that match this student's class (grade_from..grade_to).
            $programs = $this->student_registration_model->get_active_programs($student['class'] ?? null);
            $allowedProgramIds = array_column($programs, 'id');

            $data['programs']        = $programs;
            $data['plans']           = $this->student_registration_model->get_active_plans_catalog($allowedProgramIds);
            $data['components']      = $this->student_registration_model->get_active_components_catalog($allowedProgramIds);
            $data['locked_program']  = null;
            $data['open_program_id'] = $this->input->get('program');
        }

        $data['cart']       = $this->student_registration_model->get_cart($cin);
        $data['cart_total'] = $this->student_registration_model->get_cart_total($cin);
        $data['error']      = null;

        // Tag each plan/component as already-bought so the catalog can
        // hide the Add option for it instead of letting the student buy
        // the same thing twice. Matches by id (structured orders path)
        // OR by name against the legacy new_cart purchases (see
        // get_purchased_items() / get_purchased_product_names()).
                $purchasedItems = $this->student_registration_model->get_purchased_items($cin);
        $purchasedIds   = array_map(function ($p) { return (int) $p['item_id']; }, $purchasedItems);
        $purchasedNames = $this->student_registration_model->get_purchased_product_names($cin);

        // ✅ NEW — total units already bought per component (structured
        // orders path only; legacy new_cart name-match has no quantity,
        // so a name-matched-only component stays 0 here even if
        // 'bought' below is true via that path). Sent to the view so it
        // can show "X units purchased" while still letting the student
        // buy MORE units, instead of fully blocking the component.
        $purchasedComponentUnits = [];
        foreach ($purchasedItems as $p) {
            if ($p['item_type'] === 'component') {
                $cid = (int) $p['item_id'];
                $purchasedComponentUnits[$cid] = ($purchasedComponentUnits[$cid] ?? 0) + (int) ($p['quantity'] ?? 1);
            }
        }

        foreach ($data['plans'] as &$plan) {
            $plan['bought'] = in_array((int) $plan['id'], $purchasedIds, true)
                || in_array(strtolower(trim($plan['plan_name'])), $purchasedNames, true);
        }
        unset($plan);

        foreach ($data['components'] as &$component) {
            $cid = (int) $component['id'];

            $component['bought'] = in_array($cid, $purchasedIds, true)
                || in_array(strtolower(trim($component['component_name'])), $purchasedNames, true);

            // ✅ NEW — see $purchasedComponentUnits note above.
            $component['purchased_units'] = $purchasedComponentUnits[$cid] ?? 0;
        }
        unset($component);
        
        
        
       // Logged-in dashboard student? The URL holds the PRID, so match the session CIN
// against either its own CIN or the PRID it's bridged to in cin_list.
$sessionCin    = $this->session->userdata('cin');
$fromDashboard = false;

if (!empty($sessionCin)) {
    $row = $this->db->get_where('cin_list', ['cin' => $sessionCin])->row_array();
    if ($row) {
        $rowPrid = $row['prid'] ?? ($row['PRID'] ?? '');
        $fromDashboard = ((string) $row['cin'] === (string) $cin)
                      || ($rowPrid !== '' && (string) $rowPrid === (string) $cin);
    }
}


$data['from_dashboard'] = $fromDashboard;
$data['dashboard_url']  = site_url('student_registration/go_to_dashboard/' . $cin);
$data['logout_url']     = site_url('Cin_login/logout');

        $this->load->view('student_plan_select', $data);
    }
    /*Go to dashboard controller*/
public function go_to_dashboard($cin = null)
{
    if (!$cin) {
        show_404();
        return;
    }

    // The URL param here is actually the PRID (e.g. 26MREG6248), not
    // the generated CIN — match directly on cin_list.prid first,
    // falling back to cin_list.cin in case a real CIN was ever passed
    // in directly (e.g. from an older link).
    $row = $this->db->get_where('cin_list', ['prid' => $cin])->row_array();

    if (!$row) {
        $row = $this->db->get_where('cin_list', ['PRID' => $cin])->row_array();
    }

    if (!$row) {
        $row = $this->db->get_where('cin_list', ['cin' => $cin])->row_array();
    }

    if (!$row) {
        log_message('error', 'go_to_dashboard: no cin_list row matched for prid/cin=' . $cin);
        show_error('Student not found', 404);
        return;
    }

    // Session must hold the REAL cin_list.cin value — that's what
    // Cin_login::index() and everything downstream expects.
    $this->session->set_userdata('cin', $row['cin']);

    redirect(site_url('Cin_login/index'), 'refresh');
}
 
public function profile_ByPRID($prid = null)
{
    if (!$prid) {
        show_404();
        return;
    }

    $profile = $this->student_registration_model->get_profile_by_prid($prid);

    if (!$profile) {
        show_404();
        return;
    }

    $data['profile'] = $profile;
     $data['schools_list'] = $this->db
    ->select('*')
    ->order_by('school_name', 'ASC')
    ->get('school_new')
    ->result_array();
    $school = $this->student_registration_model->get_school_by_id($profile['school_id'] ?? null);
    $data['school_name']    = $school['school_name'] ?? '';
    $data['school_address'] = $school['school_name'] ?? '';
    $data['school_code'] = $school['school_code'] ?? '';
    $this->load->view('cin_login/student_profile_prid', $data);
}

public function save_profile_details()
{
    // AJAX only
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }

    $student_id = $this->input->post('student_id');
    if (!$student_id) {
        echo json_encode(['status' => 'error', 'message' => 'Missing student ID.']);
        return;
    }

    // School must exist in school_new (same table the picker lists)
    $school_id = (int) $this->input->post('school_id', true);
    $school = $this->db
        ->select('id, school_name')
        ->where('id', $school_id)
        ->get('school_new')
        ->row_array();

    if (!$school) {
        echo json_encode(['status' => 'error', 'message' => 'Please select a valid school.']);
        return;
    }

    $updateData = [
        'first_name'  => $this->input->post('first_name', true),
        'class'       => $this->input->post('class', true),
        'gender'      => $this->input->post('gender', true),
        'email'       => $this->input->post('email', true),
        'mobile'      => $this->input->post('mobile', true),
        'father_name' => $this->input->post('father_name', true),
        'mother_name' => $this->input->post('mother_name', true),
        'address1'    => $this->input->post('address1', true),
        'school_id'   => $school['id'],      // NEW
    ];

    $result = $this->student_registration_model->update_profile($student_id, $updateData);

    if ($result) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Could not update profile.']);
    }
}
    /**
     * AJAX: add a plan to the cart. Returns updated cart summary.
     */
     
    public function ajax_plan_unit_preview()
{
    $cin     = $this->input->post('cin');
    $plan_id = $this->input->post('plan_id');
    if (!$cin || !$plan_id || !$this->student_registration_model->get_student_by_cin($cin)) {
        echo json_encode(['success' => false, 'message' => 'Invalid request']);
        return;
    }
    echo json_encode($this->student_registration_model->get_plan_unit_preview($cin, $plan_id));
} 
     
   public function ajax_add_plan_to_cart()
{
    $cin     = $this->input->post('cin');
    $plan_id = $this->input->post('plan_id');
    $units_s = $this->input->post('units');   // "3,5,9,10"

    if (!$cin || !$plan_id || !$this->student_registration_model->get_student_by_cin($cin)) {
        echo json_encode(['success' => false, 'message' => 'Invalid request']);
        return;
    }

    $plan = $this->student_registration_model->get_lunar_plan($plan_id);
    if ($plan && !$this->student_registration_model->can_buy_from_program($cin, $plan['program_id'])) {
        echo json_encode(['success' => false, 'message' => 'You can only buy plans/components from the program you already purchased.']);
        return;
    }
    if ($plan && $this->student_registration_model->is_already_purchased($cin, $plan_id, $plan['plan_name'])) {
        echo json_encode(['success' => false, 'message' => 'You have already purchased this plan.']);
        return;
    }

    $selected = ($units_s !== null && $units_s !== '')
        ? array_map('intval', explode(',', $units_s))
        : null;

    $error = null;
    $ok = $this->student_registration_model->add_plan_to_cart($cin, $plan_id, $selected, $error);

    echo json_encode([
        'success' => (bool) $ok,
        'message' => $ok ? '' : ($error ?: 'Could not add plan to cart.'),
        'cart'    => $this->student_registration_model->get_cart($cin),
        'total'   => $this->student_registration_model->get_cart_total($cin),
    ]);
}
    /**
     * AJAX: add a component (optionally with a quantity) to the
     * cart. Returns updated cart summary.
     */
  public function ajax_add_component_to_cart()
{
    $cin          = $this->input->post('cin');
    $component_id = $this->input->post('component_id');
    $qty          = max(1, (int) $this->input->post('quantity'));
    $week_number  = $this->input->post('week_number');
    $class_number = $this->input->post('class_number');

    if (!$cin || !$component_id || !$this->student_registration_model->get_student_by_cin($cin)) {
        echo json_encode(['success' => false, 'message' => 'Invalid request']);
        return;
    }

    $component = $this->student_registration_model->get_lunar_component($component_id);
    if ($component && !$this->student_registration_model->can_buy_from_program($cin, $component['program_id'])) {
        echo json_encode(['success' => false, 'message' => 'You can only buy plans/components from the program you already purchased.']);
        return;
    }

    $ok = $this->student_registration_model->add_component_to_cart(
        $cin, $component_id, $qty,
        $week_number !== null && $week_number !== '' ? (int) $week_number : null,
        $class_number !== null && $class_number !== '' ? (int) $class_number : null
    );

    echo json_encode([
        'success' => (bool) $ok,
        'cart'    => $this->student_registration_model->get_cart($cin),
        'total'   => $this->student_registration_model->get_cart_total($cin),
    ]);
}


public function ajax_add_component_range_to_cart()
{
    $cin          = $this->input->post('cin');
    $component_id = $this->input->post('component_id');
    $class_number = $this->input->post('class_number');
    $from_week    = $this->input->post('from_week');
    $to_week      = $this->input->post('to_week');

    if (!$cin || !$component_id || !$this->student_registration_model->get_student_by_cin($cin)) {
        echo json_encode(['success' => false, 'message' => 'Invalid request']);
        return;
    }

    $result = $this->student_registration_model->add_component_week_range_to_cart(
        $cin, $component_id, $class_number, $from_week, $to_week
    );

    echo json_encode([
        'success' => $result['success'],
        'message' => $result['message'] ?? null,
        'added'   => $result['added'] ?? 0,
        'cart'    => $this->student_registration_model->get_cart($cin),
        'total'   => $this->student_registration_model->get_cart_total($cin),
    ]);
}

    /**
     * AJAX: remove a line item (plan or component) from the cart by
     * its cart row id. Returns updated cart summary.
     */
    public function ajax_remove_from_cart()
    {
        $cin           = $this->input->post('cin');
        $cart_item_id  = $this->input->post('cart_item_id');

        if (!$cin || !$cart_item_id) {
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            return;
        }

        $this->student_registration_model->remove_cart_item($cin, $cart_item_id);

        echo json_encode([
            'success' => true,
            'cart'    => $this->student_registration_model->get_cart($cin),
            'total'   => $this->student_registration_model->get_cart_total($cin),
        ]);
    }

    /**
     * AJAX: returns the study_schedule_lunar milestone rows (Mover/Flyer/
     * Nationals) that fall inside a given start_week/end_week range —
     * powers the "what do I get" summary in the Mix & Match builder.
     */
    public function ajax_get_schedule_range()
    {
        $start = (int) $this->input->post('start_week');
        $end   = (int) $this->input->post('end_week');

        if (!in_array($start, $this->allowed_starts, true)) {
            return $this->_json(['success' => false, 'message' => 'Invalid start week.']);
        }
        if (!in_array($end, $this->allowed_ends, true) || $end < $start) {
            return $this->_json(['success' => false, 'message' => 'Invalid end week.']);
        }

        $rows = $this->student_registration_model->get_milestones_in_range($start, $end);

        $milestones = [];
        foreach ($rows as $row) {
            // One row per milestone event (Mover/Flyer/Nationals) that falls in-range.
            $milestones[] = [
                'label' => $row['milestone_name'],
                'week'  => (int) $row['milestone_week'],
                'count' => 1,
                'content_unlocked' => $row['content_unlocked'],
            ];
        }

        return $this->_json([
            'success'    => true,
            'start_week' => $start,
            'end_week'   => $end,
            'weeks'      => $end - $start + 1,
            'milestones' => $milestones,
        ]);
    }

    /**
     * AJAX: prices a Mix & Match "Start Week -> End Week" selection.
     * Price comes straight from study_schedule_lunar's `price` column
     * (e.g. ₹3,500 for Wk1-8, Free for the rest) — the total is the sum
     * of the price on every phase row that falls inside the selected
     * range. Does not touch the cart — this is called live (debounced)
     * as the student adjusts the builder.
     */
    public function ajax_get_custom_price()
    {
        $sel = $this->student_registration_model->normalize_custom_selection($this->input->post());
        if (!$sel) {
            return $this->_json(['success' => false, 'message' => 'Please select at least one component and a valid number of weeks (1–52).']);
        }

        $priced = $this->student_registration_model->calculate_custom_pack_price($sel);
        if (!$priced) {
            return $this->_json(['success' => false, 'message' => 'Custom pack pricing isn\'t set up yet. Please contact your franchise.']);
        }

        return $this->_json([
            'success'   => true,
            'total'     => $priced['total'],
            'breakdown' => $priced['breakdown'],
        ]);
    }

    /**
     * AJAX: prices a Mix & Match "Start Week -> End Week" selection
     * SERVER-SIDE (never trusts a client-supplied price — re-runs the
     * SAME lookup as ajax_get_custom_price at the moment "Add to Cart"
     * is clicked), then adds it to the cart. Returns updated cart
     * summary, same shape as ajax_add_to_cart().
     */
    public function ajax_add_custom_to_cart()
    {
        $cin = $this->input->post('cin');

        if (!$cin || !$this->student_registration_model->get_student_by_cin($cin)) {
            return $this->_json(['success' => false, 'message' => 'Invalid request']);
        }

        $error = null;
        $ok = $this->student_registration_model->add_custom_pack_to_cart($cin, $this->input->post(), $error);

        if (!$ok) {
            return $this->_json(['success' => false, 'message' => $error ?: 'Could not add custom pack to cart.']);
        }

        return $this->_json([
            'success' => true,
            'cart'    => $this->student_registration_model->get_cart($cin),
            'total'   => $this->student_registration_model->get_cart_total($cin),
        ]);
    }

    /**
     * Shared by ajax_get_custom_price (quote) and ajax_add_custom_to_cart
     * (checkout) so the two can never drift — one price calculation, used
     * for both the live estimate shown to the student and the amount
     * actually charged.
     */
    private function _price_range($start, $end)
    {
        $phases = $this->student_registration_model->get_phases_in_range($start, $end);

        if (empty($phases)) {
            return null;
        }

        $total = 0;
        $breakdown = [];
        foreach ($phases as $row) {
            $price = (float) $row['price']; // NULL/0/'' in the DB = Free, cast to 0 safely
            $total += $price;
            $breakdown[] = [
                'phase'      => $row['phase'],
                'week_start' => (int) $row['week_start'],
                'week_end'   => (int) $row['week_end'],
                'price'      => $price,
            ];
        }

        return ['total' => $total, 'breakdown' => $breakdown];
    }

    private function _json($data)
    {
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    /**
     * Standalone cart review page (linked from select_plan).
     */
    public function cart($cin = null)
    {
        if (!$cin) {
            show_404();
            return;
        }

        $student = $this->student_registration_model->get_student_by_cin($cin);
        if (!$student) {
            show_error('Student not found', 404);
            return;
        }

        $data['student']    = $student;
        $data['cart']       = $this->student_registration_model->get_cart($cin);
        $data['cart_total'] = $this->student_registration_model->get_cart_total($cin);

        $this->load->view('student_cart', $data);
    }

    /**
     * Creates a local order + a Razorpay order for the student's
     * current cart, then renders the checkout page that opens
     * Razorpay's hosted payment widget.
     */
    public function checkout($cin = null)
    {
        if (!$cin) {
            show_404();
            return;
        }

        $student = $this->student_registration_model->get_student_by_cin($cin);
        if (!$student) {
            show_error('Student not found', 404);
            return;
        }

        $cart = $this->student_registration_model->get_cart($cin);
        if (empty($cart)) {
            redirect('student_registration/cart/' . $cin, 'refresh');
            return;
        }

        $local_order_id = $this->student_registration_model->create_order($cin);
        if (!$local_order_id) {
            log_message('error', 'checkout: create_order failed for ' . $cin);
            redirect('student_registration/cart/' . $cin, 'refresh');
            return;
        }
        $order = $this->student_registration_model->get_order($local_order_id);

        $this->load->config('razorpay', TRUE);
        $key_id     = $this->config->item('razorpay_key_id', 'razorpay');
        $key_secret = $this->config->item('razorpay_key_secret', 'razorpay');

        // Amount to Razorpay must be in the smallest currency unit
        // (paise for INR), and as an integer.
        $amount_paise = (int) round($order['amount'] * 100);

        // Route split — percentages come from the lunar_programs row
        // the order's items belong to (franchise / associate / maker /
        // management / aviansys / crm / it — whichever columns are set
        // on that program). If the program can't be resolved, or a
        // party has no linked Razorpay account configured, this comes
        // back empty (or partial) and that share simply stays in the
        // main account — checkout still proceeds either way.
        $program_id = $this->student_registration_model->get_order_program_id($local_order_id);
        $transfers  = $this->student_registration_model->build_transfers_payload(
            $order['amount'],
            $program_id,
            $student['franchise_id'],
            $student['associate_id']
        );

        $razorpay_order = $this->_razorpay_create_order($amount_paise, 'order_rcpt_' . $local_order_id, $key_id, $key_secret, $transfers);

        if (!$razorpay_order || empty($razorpay_order['id'])) {
            $this->student_registration_model->mark_order_failed($local_order_id);
            $data = [
                'student'    => $student,
                'error'      => 'Could not initiate payment right now. Please try again.',
                'plans'      => $this->student_registration_model->get_active_plans(),
                'cart'       => $cart,
                'cart_total' => $this->student_registration_model->get_cart_total($cin),
            ];
            $this->load->view('student_plan_select', $data);
            return;
        }

        $this->student_registration_model->set_razorpay_order_id($local_order_id, $razorpay_order['id']);
        $data['order_items']     = $this->student_registration_model->get_order_items($local_order_id);
        $data['student']         = $student;
        $data['order']           = $order;
        $data['razorpay_order']  = $razorpay_order;
        $data['razorpay_key_id'] = $key_id;

        $this->load->view('student_checkout', $data);
    }

    /**
     * AJAX: called by the Razorpay checkout.js success handler in
     * the browser once payment completes. Verifies the signature
     * SERVER-SIDE before trusting anything the client sent — the
     * browser callback alone is not proof of payment.
     */
    public function razorpay_verify()
    {
        // This endpoint MUST always return valid JSON — the frontend
        // does fetch(...).then(r => r.json()). If PHP prints a
        // warning/notice or hits a fatal error anywhere below, that
        // breaks the JSON and the browser falls into its catch()
        // block with a generic "could not confirm payment" message,
        // even though the payment itself may have gone through.
        //
        // Two layers of defense:
        //  1. Suppress default error HTML output (log instead).
        //  2. A shutdown handler that catches fatal errors (the kind
        //     try/catch cannot catch on PHP < 7, e.g. a missing class)
        //     and still emits a JSON response as a last resort.
        ini_set('display_errors', '0');

        register_shutdown_function(function () {
            $error = error_get_last();
            $fatal_types = [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR];
            if ($error && in_array($error['type'], $fatal_types, true)) {
                log_message('error', 'razorpay_verify fatal: ' . $error['message'] . ' in ' . $error['file'] . ':' . $error['line']);
                if (!headers_sent()) {
                    header('Content-Type: application/json');
                }
                echo json_encode([
                    'success' => false,
                    'message' => 'Server error while confirming payment. Please contact support with your payment ID — do not retry.',
                ]);
            }
        });

        $this->load->config('razorpay', TRUE);
        $key_secret = $this->config->item('razorpay_key_secret', 'razorpay');

        $razorpay_order_id   = $this->input->post('razorpay_order_id');
        $razorpay_payment_id = $this->input->post('razorpay_payment_id');
        $razorpay_signature  = $this->input->post('razorpay_signature');

        if (!$razorpay_order_id || !$razorpay_payment_id || !$razorpay_signature) {
            echo json_encode(['success' => false, 'message' => 'Missing payment details']);
            return;
        }

        $expected_signature = hash_hmac(
            'sha256',
            $razorpay_order_id . '|' . $razorpay_payment_id,
            $key_secret
        );

        if (!hash_equals($expected_signature, $razorpay_signature)) {
            echo json_encode(['success' => false, 'message' => 'Signature verification failed']);
            return;
        }

        $order = $this->student_registration_model->get_order_by_razorpay_id($razorpay_order_id);
        if (!$order) {
            echo json_encode(['success' => false, 'message' => 'Order not found']);
            return;
        }

        // Explicitly capture the payment. Razorpay only AUTHORIZES
        // (holds) the money on payment — it does not become yours
        // until captured. Doing this here, right after our own
        // signature check, is more robust than relying on an
        // account-level auto-capture setting: it's tied to a payment
        // WE just verified, and it can't silently regress if that
        // account setting ever changes.
        $key_id = $this->config->item('razorpay_key_id', 'razorpay');
        $captured = $this->_razorpay_capture_payment(
            $razorpay_payment_id,
            (int) round($order['amount'] * 100),
            $key_id,
            $key_secret
        );

        if (!$captured) {
            log_message('error', 'razorpay_verify: capture failed for payment ' . $razorpay_payment_id . ' (order ' . $order['id'] . '). Check Razorpay dashboard — payment may still be Authorized and will auto-void if not captured.');
            echo json_encode([
                'success' => false,
                'message' => 'Payment authorized but could not be captured automatically. Please contact support — do not retry, your payment is being investigated.',
            ]);
            return;
        }

        [$order, $is_bridged] = $this->_finalize_paid_order($order, $razorpay_payment_id);

        echo json_encode([
            'success'      => true,
            'redirect_url' => $this->_post_payment_redirect_url($order, $is_bridged),
        ]);
    }

    /**
     * Recovery path for the "Could not confirm payment" case: the
     * browser's fetch to razorpay_verify() failed (network hiccup,
     * JSON parse error, transient 5xx) or came back with
     * success:false, but the charge may have gone through on
     * Razorpay's side regardless. Rather than trusting anything the
     * client sends, this asks Razorpay directly "what actually
     * happened to this payment_id?" and, if it really was captured,
     * finalizes the matching LOCAL order exactly like razorpay_verify
     * does — so the student still lands on the success page with a
     * generated CIN instead of being stuck on a dead-end error.
     *
     * Safe to call repeatedly (e.g. from a "Check payment status
     * again" link): finalization is idempotent via
     * _finalize_paid_order()/_ensure_post_payment_finalized(), and if
     * Razorpay reports anything other than captured/authorized we
     * just report that back without touching the order.
     */
    public function reconcile_payment()
    {
        // Same JSON-must-always-come-back guarantee as razorpay_verify().
        ini_set('display_errors', '0');
        register_shutdown_function(function () {
            $error = error_get_last();
            $fatal_types = [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR];
            if ($error && in_array($error['type'], $fatal_types, true)) {
                log_message('error', 'reconcile_payment fatal: ' . $error['message'] . ' in ' . $error['file'] . ':' . $error['line']);
                if (!headers_sent()) {
                    header('Content-Type: application/json');
                }
                echo json_encode([
                    'success' => false,
                    'message' => 'Still could not confirm this payment. Please contact support with your payment ID.',
                ]);
            }
        });

        $payment_id = $this->input->post('razorpay_payment_id');
        if (!$payment_id) {
            return $this->_json(['success' => false, 'message' => 'Missing payment ID.']);
        }

        $this->load->config('razorpay', TRUE);
        $key_id     = $this->config->item('razorpay_key_id', 'razorpay');
        $key_secret = $this->config->item('razorpay_key_secret', 'razorpay');

        $payment = $this->_razorpay_fetch_payment($payment_id, $key_id, $key_secret);

        if (!$payment || empty($payment['order_id'])) {
            log_message('error', 'reconcile_payment: could not fetch payment ' . $payment_id . ' from Razorpay.');
            return $this->_json(['success' => false, 'message' => 'Could not look up this payment with Razorpay yet. Please try again shortly or contact support.']);
        }

        $order = $this->student_registration_model->get_order_by_razorpay_id($payment['order_id']);
        if (!$order) {
            log_message('error', 'reconcile_payment: no local order for razorpay order ' . $payment['order_id'] . ' (payment ' . $payment_id . ')');
            return $this->_json(['success' => false, 'message' => 'Could not match this payment to an order. Please contact support with your payment ID.']);
        }

        // Never finalize against a payment for a different amount —
        // guards against a stale/mistyped payment_id being replayed
        // against the wrong order.
        if ((int) round($order['amount'] * 100) !== (int) $payment['amount']) {
            log_message('error', 'reconcile_payment: amount mismatch for order ' . $order['id'] . ' — order=' . $order['amount'] . ' payment=' . $payment['amount']);
            return $this->_json(['success' => false, 'message' => 'Payment amount does not match this order. Please contact support with your payment ID.']);
        }

        // Already marked Paid (e.g. the original verify actually
        // succeeded, or a previous reconcile got this far) — but
        // status alone doesn't prove the CIN/email steps completed
        // (see class docblock). Always re-run the idempotent finalize
        // check before redirecting, instead of trusting status blindly.
        if ($order['status'] === 'Paid') {
            $is_bridged = false;
            try {
                $finalized  = $this->_ensure_post_payment_finalized($order);
                $is_bridged = $finalized['is_bridged'] ?? false;
            } catch (\Throwable $e) {
                log_message('error', 'reconcile_payment: finalize retry failed for already-paid order ' . $order['id'] . ': ' . $e->getMessage());
            }

            // Fills lunar_split_prid if it was missed earlier (idempotent).
            $this->_save_split_safely($order, $payment_id);

            return $this->_json([
                'success'      => true,
                'redirect_url' => $this->_post_payment_redirect_url($order, $is_bridged),
            ]);
        }

        if ($payment['status'] === 'authorized') {
            $captured = $this->_razorpay_capture_payment($payment_id, (int) $payment['amount'], $key_id, $key_secret);
            if (!$captured) {
                log_message('error', 'reconcile_payment: capture failed for payment ' . $payment_id . ' (order ' . $order['id'] . ')');
                return $this->_json(['success' => false, 'message' => 'Payment is authorized but could not be captured automatically. Please contact support — do not retry.']);
            }
        } elseif ($payment['status'] !== 'captured') {
            // failed / created / refunded — the charge genuinely
            // didn't succeed, nothing to reconcile.
            return $this->_json(['success' => false, 'message' => 'This payment was not successful (status: ' . $payment['status'] . ').']);
        }

        [$order, $is_bridged] = $this->_finalize_paid_order($order, $payment_id);

        return $this->_json([
            'success'      => true,
            'redirect_url' => $this->_post_payment_redirect_url($order, $is_bridged),
        ]);
    }

    /**
     * Marks the local order Paid and clears the cart (only once —
     * guarded by $already_paid), then hands off to
     * _ensure_post_payment_finalized() for the CIN/email steps.
     *
     * Called by razorpay_verify() and reconcile_payment() so the two
     * can never drift apart.
     */
    private function _finalize_paid_order($order, $razorpay_payment_id)
    {
        $already_paid = ($order['status'] === 'Paid');

        if (!$already_paid) {
            $this->student_registration_model->mark_order_paid($order['id'], $razorpay_payment_id);
            $this->student_registration_model->clear_cart($order['cin']);
            $order = $this->student_registration_model->get_order($order['id']); // refresh, now has payment_id/status
        }

        // Runs on every call — paid-just-now or already-paid — because
        // order.status alone doesn't prove CIN/email actually completed
        // on a previous attempt (see class docblock). Wrapped so a
        // failure here can NEVER turn an already-confirmed payment into
        // a "payment failed" response to the browser.
        $finalized = ['purchase_cin' => null, 'is_bridged' => false];
        try {
            $finalized = $this->_ensure_post_payment_finalized($order) ?: $finalized;
        } catch (\Throwable $e) {
            log_message('error', '_finalize_paid_order: post-payment CIN/email step failed: ' . $e->getMessage());
        }

        // Record the Razorpay Route split in lunar_split_prid. Runs AFTER the
        // CIN/email step, never throws, and is idempotent per payment_id.
        $this->_save_split_safely($order, $razorpay_payment_id);

        return [$order, $finalized['is_bridged']];
    }

    /**
     * The single, idempotent place that guarantees a Paid order ends
     * up with a real purchase CIN, a cin_list/cin_result/new_cart
     * row, and (for genuinely new students) a confirmation email.
     *
     * Idempotency is checked against the ACTUAL cin_list row for the
     * chosen CIN (student_registration_model->cin_list_exists_for_cin),
     * not just whether students.purchase_cin happens to be set — that
     * field can be saved a step before a later insert throws, which is
     * exactly the bug this fixes: a "half finalized" order that looked
     * done from students.purchase_cin's point of view but was missing
     * its cin_list row and its email.
     *
     * Called from _finalize_paid_order() (happy path), order_success()
     * (page-load self-heal), and reconcile_payment() (already-Paid
     * branch) — so no matter which path a given order takes, it keeps
     * getting retried here until it fully succeeds.
     */
    private function _ensure_post_payment_finalized($order)
    {
        $student = $this->student_registration_model->get_student_by_cin($order['cin']);
        if (!$student) {
            log_message('error', '_ensure_post_payment_finalized: no student found for cin ' . $order['cin']);
            return null;
        }

        // Looked up only AFTER the null check above; a missing school row
        // no longer causes a "null offset" notice during payment.
        $areaRow   = $this->db->get_where('school_new', ['id' => $student['school_id'] ?? 0])->row_array();
        $area_code = $areaRow['area_code'] ?? '';

        // Bridged students (came in via start_from_cin()) already had
        // cin_list.prid set before this purchase — reuse their real CIN
        // instead of generating a duplicate one, and skip both the
        // cin_list insert and the confirmation email (they're already
        // logged in with an account).
        $existingCinList = $this->student_registration_model->get_existing_cin_list_for_prid($student['PRID']);
        $is_bridged      = (bool) $existingCinList;

        $purchase_cin = $student['purchase_cin'] ?: null;
        if (!$purchase_cin) {
            $purchase_cin = $is_bridged
                ? $existingCinList['cin']
                : $this->student_registration_model->generate_post_payment_cin($area_code);
            $this->student_registration_model->save_post_payment_cin($student['PRID'], $purchase_cin);
        }

        // The real completion check — only write cin_list/cin_result/
        // new_cart (and the email) if that CIN doesn't already have a
        // cin_list row. This is what lets a retry pick up exactly where
        // a previous partial failure left off.
        if (!$this->student_registration_model->cin_list_exists_for_cin($purchase_cin)) {
            $order_items = $this->student_registration_model->get_order_items($order['id']);
            $this->student_registration_model->save_post_payment_records($student, $order, $order_items, $purchase_cin, $is_bridged);

            if (!$is_bridged) {
                $this->student_registration_model->send_purchase_confirmation_email($student, $order, $order_items, $purchase_cin);
            }
        }

        return [
            'purchase_cin' => $purchase_cin,
            'is_bridged'   => $is_bridged,
        ];
    }

    /**
     * Where to send the browser after a successful payment: back to
     * their existing dashboard if this was a bridged already-logged-in
     * purchase (cin_list.prid already existed for this PRID BEFORE the
     * order — not after, since _ensure_post_payment_finalized() may
     * have just inserted that very row a moment ago for a genuinely
     * new student), or to the normal order_success page otherwise.
     *
     * $is_bridged must come from the same _ensure_post_payment_finalized()
     * call made for this order — never re-derive it here by querying
     * cin_list again, since by this point a fresh cin_list row may
     * already exist for a brand-new student too.
     */
    private function _post_payment_redirect_url($order, $is_bridged)
    {
        if ($is_bridged) {
            return site_url('cin_login/lunarindex');
        }

        return site_url('student_registration/order_success/' . $order['id']);
    }

    public function order_success($order_id = null)
    {
        $order = $order_id ? $this->student_registration_model->get_order($order_id) : null;

        if (!$order || $order['status'] !== 'Paid') {
            show_error('Order not found or not paid', 404);
            return;
        }

        // Self-heal: re-runs the same idempotent check used everywhere
        // else. Safe even if a previous attempt already fully
        // succeeded — cin_list_exists_for_cin() short-circuits and this
        // becomes a no-op.
        try {
            $this->_ensure_post_payment_finalized($order);
        } catch (\Throwable $e) {
            log_message('error', 'order_success: late CIN self-heal failed for order ' . $order_id . ': ' . $e->getMessage());
        }

        $student = $this->student_registration_model->get_student_by_cin($order['cin']);

        $data['order']        = $order;
        $data['order_items']  = $this->student_registration_model->get_order_items($order_id);
        $data['purchase_cin'] = $student['purchase_cin'] ?? null;

        $this->load->view('student_order_success', $data);
    }

    /**
     * TEMPORARY DIAGNOSTIC TOOL — not meant to stay in production.
     *
     * Creates one small, real (but unpaid/harmless) Razorpay test
     * order PER PARTY, each with only that one party's transfer, and
     * prints Razorpay's raw JSON response for every single one. This
     * isolates which specific linked account/transfer Razorpay is
     * rejecting instead of guessing from the "This transfer is not
     * supported" error on the combined checkout order.
     *
     * These test orders just sit as "Created" in your Razorpay
     * dashboard under Orders — nothing is charged, nobody pays them,
     * safe to ignore/delete afterwards.
     *
     * SECURITY: guarded by a query-string key so this isn't callable
     * by anyone who finds the URL. Change DEBUG_ROUTE_KEY below to
     * something private before deploying, and DELETE this whole
     * method once you're done diagnosing.
     *
     * Usage:
     *   /student_registration/debug_route_split/<program_id>/<franchise_id>/<associate_id>?key=YOUR_SECRET
     *   franchise_id / associate_id can be 0 or omitted if not applicable.
     */
    const DEBUG_ROUTE_KEY = 'change-me-to-something-private';

    public function debug_route_split($program_id = null, $franchise_id = null, $associate_id = null)
    {
        if (!$program_id || $this->input->get('key') !== self::DEBUG_ROUTE_KEY) {
            show_404();
            return;
        }

        $this->load->config('razorpay', TRUE);
        $key_id     = $this->config->item('razorpay_key_id', 'razorpay');
        $key_secret = $this->config->item('razorpay_key_secret', 'razorpay');

        $lunar_program = $this->student_registration_model->get_lunar_program($program_id);
        if (!$lunar_program) {
            $this->_json(['error' => 'No lunar_programs row found for id ' . $program_id]);
            return;
        }

        // A generous fixed test amount so every party's share clears
        // Razorpay's Rs. 1 minimum-per-transfer regardless of its
        // percentage — we're isolating the "is this account/transfer
        // rejected" question here, not re-testing the real amount math.
        $test_amount = 10000; // Rs. 10,000
        $split       = $this->student_registration_model->calculate_transfer_split($test_amount, $lunar_program);
        $accounts    = $this->student_registration_model->get_transfer_accounts($franchise_id, $associate_id);

        $results = [];
        foreach ($split as $key => $info) {
            $account_id = $accounts[$key] ?? null;
            if (empty($account_id)) {
                $results[$key] = [
                    'percent' => $info['percent'],
                    'skipped' => 'no linked Razorpay account id resolved for this party',
                ];
                continue;
            }

            $amount_paise = max(100, (int) round($info['amount'] * 100)); // floor at Rs. 1 for this isolated test

            $transfer = [[
                'account'  => $account_id,
                'amount'   => $amount_paise,
                'currency' => 'INR',
            ]];

            $response = $this->_razorpay_create_order_raw(
                $amount_paise,
                'debug_' . $key . '_' . time(),
                $key_id,
                $key_secret,
                $transfer
            );

            $results[$key] = [
                'account_id'   => $account_id,
                'amount_paise' => $amount_paise,
                'razorpay_response' => $response,
            ];

            usleep(300000); // stay comfortably under Razorpay's rate limit
        }

        $this->_json($results);
    }

    /**
     * Same Orders-API call as _razorpay_create_order(), but returns
     * the FULL decoded response (success or error) instead of
     * collapsing failures to null — used only by the debug_route_split()
     * diagnostic above, so the real Razorpay error object is visible.
     */
    private function _razorpay_create_order_raw($amount_paise, $receipt, $key_id, $key_secret, $transfers = [])
    {
        $order_payload = [
            'amount'   => $amount_paise,
            'currency' => 'INR',
            'receipt'  => $receipt,
        ];

        if (!empty($transfers)) {
            $order_payload['transfers'] = $transfers;
        }

        $ch = curl_init('https://api.razorpay.com/v1/orders');
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($order_payload),
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
            CURLOPT_USERPWD        => $key_id . ':' . $key_secret,
            CURLOPT_TIMEOUT        => 30,
        ]);

        $response  = curl_exec($ch);
        $errno     = curl_errno($ch);
        $curl_err  = curl_error($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($errno || !$response) {
            return ['curl_error' => $curl_err ?: 'unknown cURL failure'];
        }

        return [
            'http_code' => $http_code,
            'body'      => json_decode($response, true),
        ];
    }

    /**
     * Calls Razorpay's Orders API to create a remote order.
     * Uses basic cURL + HTTP basic auth (key_id:key_secret) rather
     * than the razorpay-php SDK, to avoid a composer dependency —
     * matches the plain-cURL style already used elsewhere in this
     * codebase (see lunarindex()'s grademarker calls).
     */
    private function _razorpay_create_order($amount_paise, $receipt, $key_id, $key_secret, $transfers = [])
    {
        $order_payload = [
            'amount'   => $amount_paise,
            'currency' => 'INR',
            'receipt'  => $receipt,
        ];

        if (!empty($transfers)) {
            $order_payload['transfers'] = $transfers;
        }

        $payload = json_encode($order_payload);

        $ch = curl_init('https://api.razorpay.com/v1/orders');
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
            CURLOPT_USERPWD        => $key_id . ':' . $key_secret,
            CURLOPT_TIMEOUT        => 30,
        ]);

        $response   = curl_exec($ch);
        $errno      = curl_errno($ch);
        $curl_error = curl_error($ch);
        $http_code  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($errno || !$response) {
            log_message('error', 'Razorpay create-order cURL failure (receipt ' . $receipt . '): errno=' . $errno . ' ' . $curl_error);
            return null;
        }

        $decoded = json_decode($response, true);

        if (!isset($decoded['id'])) {
            // Razorpay returns 400 with {"error":{"code":...,"description":...,
            // "field":...}} when the payload (very often the `transfers`
            // array — bad/unlinked account id, or an amount below its
            // ₹1 minimum) is rejected. Log the raw body so the real
            // reason shows up in the application log instead of just
            // silently falling back to "could not initiate payment".
            log_message('error', 'Razorpay create-order rejected (receipt ' . $receipt . ', HTTP ' . $http_code . '): ' . $response);
            return null;
        }

        return $decoded;
    }

    /**
     * Captures an authorized payment. Without this call, Razorpay only
     * holds (authorizes) the money — it is never actually collected,
     * and Razorpay auto-voids/refunds it if it's not captured within
     * their authorization window.
     */
    private function _razorpay_capture_payment($payment_id, $amount_paise, $key_id, $key_secret)
    {
        $payload = json_encode([
            'amount'   => $amount_paise,
            'currency' => 'INR',
        ]);

        $ch = curl_init('https://api.razorpay.com/v1/payments/' . $payment_id . '/capture');
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
            CURLOPT_USERPWD        => $key_id . ':' . $key_secret,
            CURLOPT_TIMEOUT        => 30,
        ]);

        $response = curl_exec($ch);
        $errno    = curl_errno($ch);
        curl_close($ch);

        if ($errno || !$response) {
            return false;
        }

        $decoded = json_decode($response, true);

        // A successful capture response has status "captured".
        // Razorpay also returns 400 with error.description containing
        // "already been captured" if we race a payment that was
        // already auto-captured — treat that as success too.
        if (isset($decoded['status']) && $decoded['status'] === 'captured') {
            return true;
        }

        if (isset($decoded['error']['description']) && stripos($decoded['error']['description'], 'already been captured') !== false) {
            return true;
        }

        return false;
    }

    /**
     * Fetches a payment's current state straight from Razorpay
     * (GET /v1/payments/{id}) — used by reconcile_payment() to find
     * out what really happened to a payment_id the browser couldn't
     * get confirmation for, rather than trusting anything client-
     * supplied. Returns the decoded payload (has at least 'id',
     * 'status', 'order_id', 'amount') or null on any failure.
     */
    private function _razorpay_fetch_payment($payment_id, $key_id, $key_secret)
    {
        $ch = curl_init('https://api.razorpay.com/v1/payments/' . rawurlencode($payment_id));
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
            CURLOPT_USERPWD        => $key_id . ':' . $key_secret,
            CURLOPT_TIMEOUT        => 30,
        ]);

        $response = curl_exec($ch);
        $errno    = curl_errno($ch);
        curl_close($ch);

        if ($errno || !$response) {
            return null;
        }

        $decoded = json_decode($response, true);

        return (isset($decoded['id'], $decoded['status'])) ? $decoded : null;
    }

    /**
     * Saves the Route split to lunar_split_prid. PAYMENT-SAFE: swallows every
     * error (logs only), uses short Razorpay timeouts, and is a no-op if the
     * row already exists. Must never affect the payment response.
     */
    private function _save_split_safely($order, $razorpay_payment_id)
    {
        try {
            if (empty($razorpay_payment_id) || empty($order['id'])) {
                return;
            }

            $splitStudent = $this->student_registration_model->get_student_by_cin($order['cin']);
            if (!$splitStudent) {
                return;
            }

            $transfers = $this->_razorpay_fetch_payment_transfers($razorpay_payment_id);
            $this->student_registration_model->save_lunar_split($order, $splitStudent, $razorpay_payment_id, $transfers);
        } catch (\Throwable $e) {
            log_message('error', '_save_split_safely failed: ' . $e->getMessage());
        }
    }

    /**
     * GET /v1/payments/{id}/transfers -> 'items' (id, recipient, amount[paise]).
     * Returns [] on any failure so the split row is still saved (ids NULL).
     */
    private function _razorpay_fetch_payment_transfers($payment_id)
    {
        $this->load->config('razorpay', TRUE);
        $key_id     = $this->config->item('razorpay_key_id', 'razorpay');
        $key_secret = $this->config->item('razorpay_key_secret', 'razorpay');

        $ch = curl_init('https://api.razorpay.com/v1/payments/' . rawurlencode($payment_id) . '/transfers');
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERPWD        => $key_id . ':' . $key_secret,
            CURLOPT_CONNECTTIMEOUT => 5,   // short: must never hold up the payment response
            CURLOPT_TIMEOUT        => 10,
        ]);
        $response = curl_exec($ch);
        $errno    = curl_errno($ch);
        curl_close($ch);

        if ($errno || !$response) {
            return [];
        }
        $decoded = json_decode($response, true);
        return (isset($decoded['items']) && is_array($decoded['items'])) ? $decoded['items'] : [];
    }

public function ajax_states()
{
    $country_id = $this->input->post('country_id');
    echo json_encode($this->student_registration_model->get_states_by_country($country_id));
}

public function ajax_districts()
{
    $state_id = $this->input->post('state_id');
    echo json_encode($this->student_registration_model->get_districts_by_state($state_id));
}

public function ajax_areas()
{
    $state_id = $this->input->post('state_id');
    echo json_encode($this->student_registration_model->get_areas_by_state($state_id));
}



}