<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Student_registration_model
 * ---------------------------------------------------------------
 * Built against the confirmed `cin_list` schema (DESCRIBE output
 * supplied by the client). Registration enrolls a student directly
 * into an OPEN scheduled batch from `lunar_schedule_cin` — the same
 * source lunarindex() reads from — rather than a pricing "plan".
 * subject / series / type / level_id / sch_id / period_id are all
 * copied server-side from the chosen schedule row (never trusted
 * from raw POST) so a student can't tamper with which batch/level
 * they land in.
 *
 * STILL UNVERIFIED / BEST-EFFORT — please confirm or correct:
 *   - `schools` table: assumed columns `id`, `school_name`
 *     (cin_list itself uses `school_name`, so this mirrors that).
 *   - `franchise` table: assumed to carry `code` and, optionally,
 *     `district_id` / `district_code` so those can be auto-filled
 *     from the chosen franchise. If your `franchise` table doesn't
 *     have those columns, district_id/district_code will just be
 *     left NULL — tell me the real source and I'll wire it up.
 *   - `class_id` / `category_id` on cin_list: I could not find a
 *     source table for these anywhere in the code you've shared, so
 *     they are left NULL on insert. If there's a `classes` or
 *     `categories` table, tell me its structure and I'll populate
 *     them from the student's selected class.
 *   - Passwords are stored PLAINTEXT to match the existing
 *     convention (per your confirmation). Column is also only
 *     varchar(50), so nothing longer than that will fit — worth
 *     hardening later, but not changed here since it must match
 *     how cin_login currently authenticates.
 * ---------------------------------------------------------------
 */
class Student_registration_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Distinct classes that currently have at least one open
     * (not yet ended) Lunar Skill Test schedule.
     */
     
         /**
     * Central grade-order map, used to resolve a student's `class`
     * text label against a program's grade_from/grade_to text labels
     * (lunar_programs.grade_from/grade_to are varchar, not numeric,
     * so string comparison alone would be wrong — e.g. "Class-10"
     * would sort before "Class-2"). Keep this the ONE place that maps
     * grade labels to an order — if the school adds/renames a grade,
     * update only here.
     */
    private $grade_order = [
        'Nursery'   => 1,
        'LKG'       => 2,
        'UKG'       => 3,
        'Class-1'   => 4,
        'Class-2'   => 5,
        'Class-3'   => 6,
        'Class-4'   => 7,
        'Class-5'   => 8,
        'Class-6'   => 9,
        'Class-7'   => 10,
        'Class-8'   => 11,
        'Class-9'   => 12,
        'Class-10'  => 13,
        'Class-11'  => 14,
        'Class-12'  => 15,
    ];
    private $brevo_api_key  = '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';       // ← update
    private $brevo_url      = 'https://api.brevo.com/v3/smtp/email';
    private $sender_email   = 'donotreply@marrs.in';        // ← update
    private $sender_name    = 'MaRRS Enquiry';               // ← update

    public function get_open_classes()
    {
        $this->db->distinct();
        $this->db->select('lunar_schedule_class.class');
        $this->db->from('lunar_schedule_class');
        $this->db->join(
            'lunar_schedule_cin',
            'lunar_schedule_cin.lunar_schedule_id = lunar_schedule_class.sch_id'
        );
        $this->db->where('lunar_schedule_cin.product_name', 'Lunar Skill Test');
        $this->db->where('(lunar_schedule_cin.end_date IS NULL OR lunar_schedule_cin.end_date >= CURDATE())', NULL, FALSE);
        $this->db->order_by('lunar_schedule_class.class', 'ASC');
        return $this->db->get()->result_array();
    }

    /**
     * Open schedules available for a given class — mirrors the
     * schedule lookup in lunarindex().
     */
    public function get_schedules_for_class($class)
    {
       $this->db->select('lunar_schedule_cin.*');
$this->db->from('lunar_schedule_cin');
$this->db->join(
    'lunar_schedule_class',
    'lunar_schedule_class.sch_id = lunar_schedule_cin.lunar_schedule_id'
);
$this->db->where('lunar_schedule_cin.product_name', 'Lunar Skill Test');
$this->db->where('lunar_schedule_class.class', $class);
$this->db->where('lunar_schedule_cin.period_id', 16); // <-- add this
$this->db->group_by('lunar_schedule_cin.series');
return $this->db->get()->result_array();
    }
    
    /**
 * Resolves a student's text class label ("Class-1") to the numeric
 * class_number used in lm_content. ASSUMPTION: Class-N -> N. Please
 * confirm the mapping for Nursery/LKG/UKG if they should also carry
 * study_pack content — currently they resolve to null (no weeks shown).
 */
private function resolve_class_number($class_label)
{
    if (preg_match('/(\d+)/', (string) $class_label, $m)) {
        return (int) $m[1];
    }
    return null;
}

/**
 * All Active lm_content rows for content_type='study_pack' matching
 * this student's class, each flagged `bought` if that exact
 * (component_id, week_number, class_number) has already been paid
 * for by this student (order_items, via a Paid order).
 */
/**
 * CHANGED: removed the content_type='study_pack' restriction — this now
 * returns weekly content for ANY component that has lm_content rows for
 * this student's class, not just Study Pack. If a component has no rows
 * here, the view falls back to the old plain quantity dropdown for it —
 * so nothing breaks for components without weekly data yet.
 */
public function get_lm_content_for_student($cin, $student_class)
{
    $class_number = $this->resolve_class_number($student_class);
    if ($class_number === null) {
        log_message('error', 'get_lm_content_for_student: could not resolve class_number for class "' . $student_class . '"');
        return [];
    }

    $rows = $this->db
        ->where('class_number', $class_number)
        ->where('status', 'Active')
        ->where('content_type', 'study_pack') // only Study Pack has weekly units; other components must NOT get From/To dropdowns
        ->order_by('component_id', 'ASC')
        ->order_by('week_number', 'ASC')
        ->get('lm_content')
        ->result_array();

    if (empty($rows)) {
        return [];
    }

    $bought = $this->db
        ->select('order_items.plan_id AS component_id, order_items.week_number, order_items.class_number')
        ->from('order_items')
        ->join('orders', 'orders.id = order_items.order_id')
        ->where('orders.cin', $cin)
        ->where('orders.status', 'Paid')
        ->where('order_items.item_type', 'component')
        ->where('order_items.week_number IS NOT NULL', null, false)
        ->get()
        ->result_array();

    $boughtKeys = [];
    foreach ($bought as $b) {
        $boughtKeys[$b['component_id'] . '-' . $b['week_number'] . '-' . $b['class_number']] = true;
    }

    foreach ($rows as &$row) {
        $key = $row['component_id'] . '-' . $row['week_number'] . '-' . $row['class_number'];
        $row['bought'] = isset($boughtKeys[$key]) ? 1 : 0;
    }
    unset($row);

    return $rows;
}

/**
 * Adds every week in [from_week, to_week] (inclusive) for one component
 * to the cart in a single call — skips any week that's already Paid-
 * purchased or already sitting in the cart, rather than failing the
 * whole range. One cart row per week (so each stays individually
 * trackable/removable and "bought" detection keeps working per-week).
 */
public function add_component_week_range_to_cart($cin, $component_id, $class_number, $from_week, $to_week)
{
    $component = $this->get_lunar_component($component_id);
    if (!$component) {
        return ['success' => false, 'message' => 'Invalid component.'];
    }
    if (!$this->can_buy_from_program($cin, $component['program_id'])) {
        return ['success' => false, 'message' => 'You can only buy plans/components from the program you already purchased.'];
    }

    $from_week = (int) $from_week;
    $to_week   = (int) $to_week;
    if ($from_week < 1 || $to_week < $from_week) {
        return ['success' => false, 'message' => 'Invalid week range.'];
    }

    // Only weeks that genuinely exist (Active) in lm_content for this
    // component/class — never trust the range bounds alone.
    $rows = $this->db
        ->where('component_id', $component_id)
        ->where('class_number', $class_number)
        ->where('status', 'Active')
        ->where('content_type', 'study_pack')
        ->where('week_number >=', $from_week)
        ->where('week_number <=', $to_week)
        ->order_by('week_number', 'ASC')
        ->get('lm_content')
        ->result_array();

    if (empty($rows)) {
        return ['success' => false, 'message' => 'No weeks available in that range.'];
    }

    $boughtWeeks = array_column(
        $this->db->select('order_items.week_number')
            ->from('order_items')
            ->join('orders', 'orders.id = order_items.order_id')
            ->where('orders.cin', $cin)
            ->where('orders.status', 'Paid')
            ->where('order_items.item_type', 'component')
            ->where('order_items.plan_id', $component_id)
            ->where('order_items.class_number', $class_number)
            ->get()->result_array(),
        'week_number'
    );

    $cartWeeks = array_column(
        $this->db->select('week_number')
            ->where('cin', $cin)
            ->where('item_type', 'component')
            ->where('item_id', $component_id)
            ->where('class_number', $class_number)
            ->get('lunar_cart_items')->result_array(),
        'week_number'
    );

    $now   = date('Y-m-d H:i:s');
    $added = 0;

    foreach ($rows as $row) {
        $week = (int) $row['week_number'];
        if (in_array($week, $boughtWeeks, true) || in_array($week, $cartWeeks, true)) {
            continue;
        }

        $this->db->insert('lunar_cart_items', [
            'cin'          => $cin,
            'program_id'   => $component['program_id'],
            'item_type'    => 'component',
            'item_id'      => $component_id,
            'item_name'    => $component['component_name'] . ' (Week ' . $week . ')',
            'unit_price'   => $component['unit_price'],
            'quantity'     => 1,
            'week_number'  => $week,
            'class_number' => $class_number,
            'created_at'   => $now,
            'updated_at'   => $now,
        ]);
        $added++;
    }

    if ($added === 0) {
        return ['success' => false, 'message' => 'All selected weeks are already purchased or in your cart.'];
    }

    return ['success' => true, 'added' => $added];
}
    /**
     * Fetch a single schedule by its PK (lunar_schedule_id), scoped
     * to the class the student picked, so the values we copy into
     * cin_list are always server-verified rather than trusted from
     * raw POST.
     */
    public function get_schedule($sch_id, $class)
    {
        $this->db->select('lunar_schedule_cin.*');
        $this->db->from('lunar_schedule_cin');
        $this->db->join(
            'lunar_schedule_class',
            'lunar_schedule_class.sch_id = lunar_schedule_cin.lunar_schedule_id'
        );
        $this->db->where('lunar_schedule_cin.lunar_schedule_id', $sch_id);
        $this->db->where('lunar_schedule_class.class', $class);
        $this->db->where('lunar_schedule_cin.product_name', 'Lunar Skill Test');
        return $this->db->get()->row_array();
    }

    /**
     * Fetches a single lunar_schedule_cin row by its PK. Used post-payment
     * to pull level_id ("clevel") and the schedule's date for cin_result /
     * new_cart, keyed off students.competition_schedule_id (which stores
     * the lunar_schedule_id chosen at registration — see register_student()).
     *
     * ASSUMPTION: the schedule's date column is named `end_date` (the only
     * date column confirmed elsewhere in this model, used in
     * get_open_classes()/get_schedules_for_class() for "is this schedule
     * still open"). If lunar_schedule_cin actually has a dedicated
     * `comp_date` column, change the SELECT below to use it instead.
     */
    public function get_schedule_by_id($schedule_id)
    {
        if (empty($schedule_id)) {
            return null;
        }

        return $this->db
            ->select('lunar_schedule_cin.*, lunar_schedule_cin.end_date AS comp_date')
            ->get_where('lunar_schedule_cin', ['lunar_schedule_id' => $schedule_id])
            ->row_array();
    }

    public function get_states()
    {
        return $this->db->get_where('states', ['country_id' => '105'])->result_array();
    }

    public function get_franchises_by_state($state_id)
    {
        return $this->db->get_where('franchise', ['state_id' => $state_id])->result_array();
    }

    public function get_franchise($franchise_id)
    {
        return $this->db->get_where('franchise', ['franchise_id' => $franchise_id])->row_array();
    }

    /**
     * Matches the "Active" associate lookup used in schedule_lunar().
     */
    public function get_associates()
    {
        $this->db->select('associates.associate_id, first_name, last_name');
        $this->db->from('associates');
        $this->db->join('associate_bank_details', 'associate_bank_details.associate_id = associates.associate_id');
        $this->db->where('associates.status','Active');
        return $this->db->get()->result_array();
    }

    /**
     * ASSUMPTION: `schools` table has `id` and `school_name` columns.
     * Confirm and adjust if different.
     */
   public function get_schools()
{
    return $this->db
        ->select('*')
        ->from('school_new')
        ->order_by('school_name', 'ASC')
        ->get()
        ->result_array();
}

    public function email_exists($email)
    {
        if (empty($email)) {
            return false;
        }
        return (bool) $this->db
            ->get_where('cin_list', ['stud_email' => $email])
            ->row();
    }

    /**
     * Same generation pattern as generate_unique_code() in
     * schedule_lunar() — prefix + year + random digits, checked
     * for uniqueness against the table.
     */
    public function generate_unique_cin()
    {
        $year_suffix = date('y');

        do {
            $random_number = rand(1000, 9999);
            $cin = 'S' . $year_suffix . $random_number;

            $existing = $this->db->get_where('cin_list', ['cin' => $cin])->row();
        } while ($existing);

        return $cin;
    }

    /**
     * Creates the cin_list row. $schedule must be a row already
     * fetched via get_schedule() so subject/series/type/level_id/
     * period_id are trusted values, not raw POST.
     *
     * Returns the generated CIN on success, or false on failure.
     */
    public function register_student($post, $schedule)
{
    $franchise      = null;
    $franchise_code = null; // still no franchise_code/district columns on students — see note below
    if (!empty($this->session->userdata('franchise_id'))) {
        $franchise = $this->get_franchise($this->session->userdata('franchise_id'));
        $franchise_code = $franchise['code'] ?? null;
    }

    $data = [
        'first_name'          => $post['student_name'] ?? '',
        'middle_name'         => '',
        'last_name'           => '',

        'father_name'         => $post['father_name'] ?: '',
        'mother_name'         => $post['mother_name'] ?: '',

        'mobile'              => $post['stud_phone'] ?? '',
        'email'               => $post['stud_email'] ?? '',

        'school_code'         => null,
        'registration_code'   => null,

        'class_key'           => $post['class'] ?? '',
        'class_id'            => null, // still no classes table referenced — see note below
        'category'            => $post['category'] ?? '',
        'category_id'         => null, // same — no categories table referenced yet

        'period_id'           => (string)($schedule['period_id'] ?? ''),

        'country'             => $post['country'] ?? null,
        'state'               => $post['state'] ?? null,
        'pin'                 => $post['pin'] ?? 0,
        'address1'            => $post['address1'] ?: '',
        'address2'            => $post['address2'] ?: '',
        'date'                => time(),

        'status'              => 'Active',
        'payment_status'      => 'Pending',
        'product_id'          => $post['product_id'] ?? 0,
        'discount_id'         => $post['discount_id'] ?? 0,

        'PRID'                => $this->generate_prid(),
        'gender'              => $post['gender'] ?: '',
        'whatsapp'            => $post['stud_phone'] ?? '',
        'city'                => $post['city'] ?? '',
        'area_code'           => $post['area_code'] ?? null,
        'year'                => (int) date('Y'),
        'class'               => $post['class'] ?? '',
        'level_id'            => (int) ($schedule['level_id'] ?? 0),
        'school_id'           => $post['school_id'] ?: 0,

        'franchise_id'            => $this->session->userdata('franchise_id') ?: null,
        'associate_id'            => $this->session->userdata('associate_id') ?: null,
        'competition_schedule_id' => $post['competition_schedule_id'] ?? null,
    ];

    $inserted = $this->db->insert('students', $data);

    return $inserted ? $data['PRID'] : false;
}

    // -----------------------------------------------------------
    // Plan purchase step (runs AFTER registration, using the
    // pricing schema from lunar_plans_schema.sql — `plans`,
    // `plan_categories`, `plan_test_allocations`). This is a
    // separate concern from cin_list/lunar_schedule_cin above:
    // cin_list has no plan_id column, so the chosen plan is
    // recorded in a new `student_plan_orders` table instead (see
    // the SQL in the setup notes). Nothing here touches cin_list.
    // -----------------------------------------------------------

   public function get_student_by_cin($cin)
{
    return $this->db->get_where('students', ['PRID' => $cin])->row_array();
}
    // application/models/Student_registration_model.php

    public function generate_prid()
    {
        $prefix = date('y') . 'MREG'; // e.g. '26MREG'
    
        $this->db->select("MAX(CAST(SUBSTRING(PRID, " . (strlen($prefix) + 1) . ") AS UNSIGNED)) AS last_num");
        $this->db->like('PRID', $prefix, 'after');
        $query = $this->db->get('students');
        $row   = $query->row();
    
        $next_num = ($row && $row->last_num !== null) ? ((int)$row->last_num + 1) : 1;
    
        return $prefix . $next_num;
    }
    // -----------------------------------------------------------
    // Post-payment CIN
    // -----------------------------------------------------------
    // Format confirmed by client: 25LUAB17500011
    //   25       -> 2-digit year
    //   LU       -> constant
    //   AB1      -> area code (variable length, taken as-is)
    //   7500011  -> incrementing number
    // Mirrors generate_prid()'s prefix + MAX + 1 pattern. The
    // increment is scoped PER prefix (year+LU+area_code) since the
    // area code is embedded in the string, starting at 7500001 if no
    // prior CIN exists for that prefix.
    // ASSUMPTION: confirm the increment should reset per area code
    // (as implemented) rather than run as one global counter across
    // all area codes.
    // Requires a `purchase_cin` VARCHAR column on `students` — add it
    // if it doesn't already exist:
    //   ALTER TABLE students ADD COLUMN purchase_cin VARCHAR(30) NULL;
    public function generate_post_payment_cin($area_code)
    {
        $area_code = strtoupper(trim((string) $area_code));
        $prefix    = date('y') . 'LU' . $area_code;
        $start_num = 7500001;

        $this->db->select("MAX(CAST(SUBSTRING(purchase_cin, " . (strlen($prefix) + 1) . ") AS UNSIGNED)) AS last_num");
        $this->db->like('purchase_cin', $prefix, 'after');
        $row = $this->db->get('students')->row();

        $next_num = ($row && $row->last_num !== null) ? ((int) $row->last_num + 1) : $start_num;

        // Uniqueness loop, same defensive pattern as generate_unique_cin().
        do {
            $cin = $prefix . $next_num;
            $exists = $this->db->get_where('students', ['purchase_cin' => $cin])->row();
            $next_num++;
        } while ($exists);

        return $cin;
    }

    /**
     * Saves the post-payment CIN onto the student's row, keyed by
     * their registration PRID (what the rest of this codebase calls
     * "$cin" everywhere — e.g. add_to_cart($cin, ...)).
     */
    public function save_post_payment_cin($prid, $purchase_cin)
    {
        return $this->db->update('students', ['purchase_cin' => $purchase_cin], ['PRID' => $prid]);
    }

    /**
     * Writes the legacy cin_list / cin_result / new_cart rows for a paid
     * order, ADDITIONAL to (not instead of) students.purchase_cin.
     *
     * - cin_list  : one row for the student, keyed by the new purchase_cin.
     * - cin_result: one row PER purchased item (order_items), status
     *               depends on level_id ('Q' for level_id > 1, blank
     *               otherwise — mirrors the original snippet's branching).
     * - new_cart  : one row PER purchased item, status 'Paid'.
     *
     * franchise_code / clevel / comp_date are looked up live rather than
     * trusted from POST:
     *   - franchise_code <- franchise.code, via students.franchise_id
     *   - clevel / comp_date <- lunar_schedule_cin, via
     *     students.competition_schedule_id (see get_schedule_by_id()).
     *
     * Wrapped by the caller's try/catch (_finalize_paid_order) — a
     * failure here must not affect the already-confirmed payment.
     */
    /**
     * If this student was bridged from an already-logged-in dashboard
     * user (via Student_registration::start_from_cin()), their
     * cin_list.prid was set BEFORE any purchase happened — so this
     * being non-null at payment time reliably means "they already
     * have a real CIN, don't generate another one."
     */
    public function get_existing_cin_list_for_prid($prid)
    {
        return $this->db->get_where('cin_list', ['prid' => $prid])->row_array();
    }

    public function cin_list_exists_for_cin($cin)
    {
        $cin = trim((string) $cin);

        if ($cin === '') {
            return false;
        }

        return $this->db
            ->where('cin', $cin)
            ->limit(1)
            ->count_all_results('cin_list') > 0;
    }

    public function save_post_payment_records($student, $order, $order_items, $purchase_cin, $skip_cin_list_insert = false)
    {
        $franchise_code = null;
        if (!empty($student['franchise_id'])) {
            $franchise = $this->get_franchise($student['franchise_id']);
            $franchise_code = $franchise['code'] ?? null;
        }

        $schedule   = $this->get_schedule_by_id($student['competition_schedule_id'] ?? null);
        $clevel     = (int) ($schedule['level_id'] ?? $student['level_id'] ?? 0);
        $comp_date  = $schedule['comp_date'] ?? null;

        // ---- cin_list (one row for the student) ----
        $cin_list_row = [
            'cin'                     => $purchase_cin,
            'password'                => $purchase_cin,
            'period_id'               => $student['period_id'] ?? null,
            'student_name'            => trim(($student['first_name'] ?? '') . ' ' . ($student['last_name'] ?? '')),
            'franchise_id'            => $student['franchise_id'] ?? null,
            'franchise_code'          => $franchise_code,
            'address1'                => $student['address1'] ?? '',
            'address2'                => $student['address2'] ?? '',
            'stud_email'              => $student['email'] ?? '',
            'stud_phone'              => $student['mobile'] ?? '',
            'class'                   => $student['class'] ?? '',
            'father_name'             => $student['father_name'] ?? '',
            'mother_name'             => $student['mother_name'] ?? '',
            'school_id'               => $student['school_id'] ?? 0,
            'state_id'                => $student['state'] ?? null,
            'status'                  => 'Active',
            'gender'                  => $student['gender'] ?? '',
            'prid'                    => $student['PRID'] ?? null,
            'competition_schedule_id' => $student['competition_schedule_id'] ?? null,
        ];

        if (!$skip_cin_list_insert) {
            $this->db->insert('cin_list', $cin_list_row);
        }

        foreach ($order_items as $item) {

            // ---- cin_result (one row per purchased item) ----
            if ($clevel > 1) {
                $cin_result_row = [
                    'cin'                     => $purchase_cin,
                    'period_id'               => $student['period_id'] ?? null,
                    'product_name'            => "Lunar Skill Test",
                    'clevel'                  => $clevel,
                    'status'                  => 'Q',
                    'competition_date'        => $comp_date,
                    'competition_schedule_id' => $student['competition_schedule_id'] ?? null,
                ];
            } else {
                $cin_result_row = [
                    'cin'                     => $purchase_cin,
                    'period_id'               => $student['period_id'] ?? null,
                    'product_name'            => "Lunar Skill Test",
                    'clevel'                  => $clevel,
                    'competition_schedule_id' => $student['competition_schedule_id'] ?? null,
                ];
            }

            $this->db->insert('cin_result', $cin_result_row);

            // ---- new_cart (one row per purchased item) ----
            $new_cart_row = [
                'cin'          => $purchase_cin,
                'period_id'    => $student['period_id'] ?? null,
                'product_name' => $item['plan_name'],
                'clevel'       => $clevel,
                'status'       => 'Paid',
                'comp_date'    => $comp_date,
            ];

            $this->db->insert('new_cart', $new_cart_row);
        }

        return true;
    }

    // -----------------------------------------------------------
    // Razorpay Route split (franchise / associate / content maker /
    // management / Aviansys / CRM / IT)
    // -----------------------------------------------------------
    //   - Percentages are read directly off the `lunar_programs` row
    //     for the order (franchise_percentage, associate_percentage,
    //     maker_percentage, management_percentage, aviansys_percentage,
    //     crm_per, it_percentage) instead of a separate revenue_setting
    //     table — the program IS the revenue setting now.
    //   - Linked Razorpay account IDs (acc_...) are pulled per party:
    //       franchise  -> `franchise`.`account_id`               (by franchise_id)
    //       associate  -> `associate_bank_details`.`razorpay_id`  (by associate_id, status = Active)
    //       maker      -> application/config/razorpay.php ($config['content_maker_account_id'])
    //       management -> `gst_account_marrs`.`rozarpay_id` where account_name = 'Management Account MaRRS'
    //       aviansys   -> `gst_account_marrs`.`rozarpay_id` where account_name = 'Aviansys 2'
    //       crm        -> `gst_account_marrs`.`rozarpay_id` where account_name = 'CRM MaRRS'
    //       it         -> `gst_account_marrs`.`rozarpay_id` where account_name = 'IT Account MaRRS'
    //   - Any party with a 0/NULL percentage on the program, or with no
    //     linked account id configured, is simply skipped — its share
    //     stays in the main Razorpay account rather than breaking checkout.
    const GST_ACCOUNT_TABLE = 'gst_account_marrs';
    const RAZORPAY_FEE_PCT  = 0.05; // used only to derive baseTotal per client's formula
    const ROUTE_GST_PCT     = 0.18;

    // Fixed GST-account names each cut is routed to (gst_account_marrs.account_name).
    const GST_ACCOUNT_NAMES = [
        'management' => 'Management Account MaRRS',
        'aviansys'   => 'Aviansys 2',
        'crm'        => 'CRM MaRRS',
        'it'         => 'IT Account MaRRS',
    ];

    /**
     * Looks up the Razorpay linked-account id for one of the fixed
     * gst_account_marrs rows (management / aviansys / crm / it) by its
     * account_name.
     */
    public function get_gst_account_id($account_name)
    {
        $row = $this->db->select('rozarpay_id')
            ->where('account_name', $account_name)
            ->where('status', 'Active')
            ->get(self::GST_ACCOUNT_TABLE)
            ->row_array();

        return $row['rozarpay_id'] ?? null;
    }

    /**
     * Confirmed formula:
     *   baseTotal = total - (total * 5%)
     *   gst       = baseTotal * 18%
     *   totalMain = baseTotal - gst
     *   party cut = (totalMain * party%) + (gst * party%)
     * Percentages come straight off the lunar_programs row for this
     * order — whichever columns are > 0 get a transfer, so the split
     * is fully dynamic per program instead of hard-coded percentages.
     */
    public function calculate_transfer_split($total_amount, $lunar_program)
    {
        $base_total = $total_amount - ($total_amount * self::RAZORPAY_FEE_PCT);
        $gst        = $base_total * self::ROUTE_GST_PCT;
        $total_main = $base_total - $gst;

        $parties = [
            'franchise'  => (float) ($lunar_program['franchise_percentage'] ?? 0),
            'associate'  => (float) ($lunar_program['associate_percentage'] ?? 0),
            'maker'      => (float) ($lunar_program['maker_percentage'] ?? 0),
            'management' => (float) ($lunar_program['management_percentage'] ?? 0),
            'aviansys'   => (float) ($lunar_program['aviansys_percentage'] ?? 0),
            'crm'        => (float) ($lunar_program['crm_per'] ?? 0),
            'it'         => (float) ($lunar_program['it_percentage'] ?? 0),
        ];

        $split = [];
        foreach ($parties as $key => $pct) {
            if ($pct <= 0) {
                continue;
            }
            $main_share = $total_main * ($pct / 100);
            $gst_share  = $gst * ($pct / 100);
            $split[$key] = [
                'percent' => $pct,
                'amount'  => round($main_share + $gst_share, 2),
            ];
        }

        return $split;
    }

    /**
     * Resolves every party's Razorpay linked-account id, keyed the
     * same way as calculate_transfer_split()'s $split array.
     */
    public function get_transfer_accounts($franchise_id, $associate_id)
    {
        $accounts = [
            'franchise'  => null,
            'associate'  => null,
            'maker'      => null,
            'management' => null,
            'aviansys'   => null,
            'crm'        => null,
            'it'         => null,
        ];

        if (!empty($franchise_id)) {
            $f = $this->db->select('account_id')
                ->get_where('franchise', ['franchise_id' => $franchise_id])
                ->row_array();
            $accounts['franchise'] = $f['account_id'] ?? null;
        }

        if (!empty($associate_id)) {
            $a = $this->db->select('razorpay_id')
                ->get_where('associate_bank_details', [
                    'associate_id' => $associate_id,
                    'status'       => 'Active',
                ])
                ->row_array();
            $accounts['associate'] = $a['razorpay_id'] ?? null;
        }

        $this->load->config('razorpay', TRUE);
        $accounts['maker'] = $this->config->item('content_maker_account_id', 'razorpay');

        foreach (self::GST_ACCOUNT_NAMES as $key => $account_name) {
            $accounts[$key] = $this->get_gst_account_id($account_name);
        }

        return $accounts;
    }

    /**
     * Builds the `transfers` array for the Razorpay Orders API
     * (Route). Percentages come from the order's lunar_programs row
     * ($program_id); any party missing a linked account id is skipped
     * (and logged) rather than breaking checkout — their share simply
     * stays in the main account until the account id is configured.
     */
    // Razorpay Route rejects the ENTIRE order (not just the one bad
    // line) if any single transfer is below its ₹1 minimum — a small
    // percentage cut on a small order total can easily round under
    // that, so those are dropped before the request is ever sent.
    const MIN_TRANSFER_PAISE = 100; // ₹1

    public function build_transfers_payload($total_amount, $program_id, $franchise_id, $associate_id)
    {
        $lunar_program = $this->get_lunar_program($program_id);
        if (!$lunar_program) {
            log_message('error', 'No lunar_programs row found for program ' . $program_id . ' — skipping Route split, full amount stays with Aviansys.');
            return [];
        }

        $split    = $this->calculate_transfer_split($total_amount, $lunar_program);
        $accounts = $this->get_transfer_accounts($franchise_id, $associate_id);

        $transfers = [];
        foreach ($split as $key => $info) {
            $account_id = $accounts[$key] ?? null;
            if (empty($account_id)) {
                log_message('error', "Missing Razorpay linked account for '{$key}' (program {$program_id}) — transfer skipped.");
                continue;
            }

            $amount_paise = (int) round($info['amount'] * 100);
            if ($amount_paise < self::MIN_TRANSFER_PAISE) {
                log_message('error', "Transfer for '{$key}' (program {$program_id}) is below Razorpay's ₹1 minimum ({$amount_paise} paise) — skipped so it doesn't fail the whole order.");
                continue;
            }

            $transfers[] = [
                'account'  => $account_id,
                'amount'   => $amount_paise, // paise
                'currency' => 'INR',
            ];
        }

        return $transfers;
    }

    // -----------------------------------------------------------
    // lunar_split_prid — local record of the Razorpay Route split
    // -----------------------------------------------------------
    /**
     * Saves one row in lunar_split_prid for a Paid order (idempotent per
     * payment_id). PAYMENT-SAFE: never throws and never lets a DB error
     * page appear — any problem is logged and false is returned, so a
     * confirmed payment can't be turned into an error by this step.
     *
     * $rzp_transfers = 'items' of GET /payments/{id}/transfers
     * (id, recipient, amount in paise).
     */
    public function save_lunar_split($order, $student, $razorpay_payment_id, array $rzp_transfers = [])
    {
        $prev_debug          = $this->db->db_debug;
        $this->db->db_debug  = FALSE;   // DB errors -> return FALSE, not show_error()+exit

        try {
            $ok = $this->_save_lunar_split_inner($order, $student, $razorpay_payment_id, $rzp_transfers);
        } catch (\Throwable $e) {
            log_message('error', 'save_lunar_split failed (order ' . ($order['id'] ?? '?') . '): ' . $e->getMessage());
            $ok = false;
        }

        $this->db->db_debug = $prev_debug;
        return $ok;
    }

    private function _save_lunar_split_inner($order, $student, $razorpay_payment_id, array $rzp_transfers)
    {
        if (empty($razorpay_payment_id) || !$this->db->table_exists('lunar_split_prid')) {
            return false;
        }

        $existing = $this->db->get_where('lunar_split_prid', ['payment_id' => $razorpay_payment_id])->row_array();

        if ($existing) {
            // Already saved. Redo only if it was saved without transfer ids
            // and we now have them (Razorpay hadn't created them yet).
            $hasIds = false;
            foreach ($existing as $col => $val) {
                if ((strpos($col, 'tranfer_id') !== false || strpos($col, 'transfer_id') !== false) && !empty($val)) {
                    $hasIds = true;
                    break;
                }
            }
            if ($hasIds || empty($rzp_transfers)) {
                return true;
            }
            $this->db->delete('lunar_split_prid', ['pay_id' => $existing['pay_id']]);
        }

        $program_id = $this->get_order_program_id($order['id']);
        $program    = $this->get_lunar_program($program_id);
        if (!$program) {
            log_message('error', 'save_lunar_split: no program for order ' . $order['id']);
            return false;
        }

        $total    = (float) $order['amount'];
        $base     = $total - ($total * self::RAZORPAY_FEE_PCT);
        $gst      = $base * self::ROUTE_GST_PCT;
        $split    = $this->calculate_transfer_split($total, $program);
        $accounts = $this->get_transfer_accounts($student['franchise_id'] ?? null, $student['associate_id'] ?? null);

        // party => [amount col, transfer-id col, gst col|null]
        $map = [
            'franchise'  => ['franchise_amount',   'franchise_transfer_id',  'franchise_gst'],
            'associate'  => ['associate_amount',   'associate_tranfer_id',   'associate_gst'],
            'maker'      => ['maker_amount',       'maker_tranfer_id',       null],
            'management' => ['management_amount',  'management_tranfer_id',  null],
            'aviansys'   => ['aviansys_amount',    'aviansys_tranfer_id',    'aviansys_gst'],
            'crm'        => ['crm_fix',            'crm_fix_tranfer_id',     null],
            'it'         => ['it_amount',          'it_transfer_id',         null],
        ];

        $row = [
            'prid'            => $order['cin'],
            'payment_id'      => $razorpay_payment_id,
            'total_amount'    => number_format($total, 2, '.', ''),
            'date_of_payment' => date('Y-m-d H:i:s'),
            'sch_id'          => !empty($student['school_id'])    ? $student['school_id']    : null, // ASSUMPTION: school id
            'associate_id'    => !empty($student['associate_id']) ? $student['associate_id'] : null,
            'franchise_id'    => !empty($student['franchise_id']) ? (int) $student['franchise_id'] : null,
            'razpay_service'  => number_format($total * self::RAZORPAY_FEE_PCT, 2, '.', ''),
            'gst_amount'      => number_format($gst, 2, '.', ''),
        ];

        $pool    = $rzp_transfers;
        $sentSum = 0;

        foreach ($split as $key => $info) {
            if (!isset($map[$key])) { continue; }

            $paise = (int) round($info['amount'] * 100);
            $acc   = $accounts[$key] ?? null;

            // Same rule as build_transfers_payload(): no account / < Rs1 => not sent
            if (empty($acc) || $paise < self::MIN_TRANSFER_PAISE) { continue; }

            $trfId = null;
            foreach ($pool as $i => $t) {
                if (($t['recipient'] ?? '') === $acc && (int) ($t['amount'] ?? 0) === $paise) {
                    $trfId = $t['id'] ?? null;
                    unset($pool[$i]);
                    break;
                }
            }

            list($amtCol, $idCol, $gstCol) = $map[$key];
            $row[$amtCol] = $info['amount'];
            $row[$idCol]  = $trfId;
            if ($gstCol) {
                $row[$gstCol] = round($gst * ($info['percent'] / 100), 2);
            }
            $sentSum += $info['amount'];
        }

        // What stays in the main (MaRRS) account
        $row['MaRRS_bal'] = number_format($total - $sentSum, 2, '.', '');

        // Keep only columns that really exist (e.g. it_* if the ALTER wasn't run)
        $row = array_intersect_key($row, array_flip($this->db->list_fields('lunar_split_prid')));

        return (bool) $this->db->insert('lunar_split_prid', $row);
    }

    // -----------------------------------------------------------
    // Purchase confirmation email
    // -----------------------------------------------------------
    // ASSUMPTION: CodeIgniter's `email` library is configured in
    // application/config/email.php (SMTP host/user/pass etc). If mail
    // is sent some other way elsewhere in this project, swap only the
    // body of this method — callers stay the same.
public function send_purchase_confirmation_email($student, $order, $order_items, $purchase_cin)
{
    

    $student_email = trim((string) ($student['email'] ?? ''));

    if (!filter_var($student_email, FILTER_VALIDATE_EMAIL)) {
        log_message(
            'error',
            'send_purchase_confirmation_email: Invalid student email. PRID: ' .
            ($student['PRID'] ?? 'N/A')
        );

        return false;
    }

    $full_name = trim(
        (string) (
            $student['name']
            ?? $student['full_name']
            ?? $student['student_name']
            ?? 'Student'
        )
    );

    if ($full_name === '') {
        $full_name = 'Student';
    }

    $safe_name = htmlspecialchars(
        $full_name,
        ENT_QUOTES,
        'UTF-8'
    );

    $safe_cin = htmlspecialchars(
        (string) $purchase_cin,
        ENT_QUOTES,
        'UTF-8'
    );

    $subject = 'Welcome to Lunar Learning Programs – Your CIN & Learning Access Details';

    $portal_url = 'https://marrs.in/';

    $safe_portal_url = htmlspecialchars(
        $portal_url,
        ENT_QUOTES,
        'UTF-8'
    );

    /*
     * Prepare purchased program details
     */
    $program_rows = '';

    if (!empty($order_items) && is_array($order_items)) {
        foreach ($order_items as $item) {
            $program_name =
                $item['plan_name']
                ?? $item['program_name']
                ?? $item['component_name']
                ?? 'Lunar Learning Program';

            $safe_program_name = htmlspecialchars(
                (string) $program_name,
                ENT_QUOTES,
                'UTF-8'
            );

            $program_rows .= '
                <tr>
                    <td style="
                        padding:12px 15px;
                        border:1px solid #e5e7eb;
                        font-size:14px;
                        color:#374151;
                    ">
                        ' . $safe_program_name . '
                    </td>
                </tr>
            ';
        }
    }

    if ($program_rows === '') {
        $program_rows = '
            <tr>
                <td style="
                    padding:12px 15px;
                    border:1px solid #e5e7eb;
                    font-size:14px;
                    color:#374151;
                ">
                    Lunar Learning Program
                </td>
            </tr>
        ';
    }

    /*
     * Email HTML
     */
    $message = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome to Lunar Learning Programs</title>
    </head>

    <body style="
        margin:0;
        padding:0;
        background:#f3f4f6;
        font-family:Arial, Helvetica, sans-serif;
        color:#1f2937;
    ">

        <table width="100%" cellpadding="0" cellspacing="0" border="0"
               style="background:#f3f4f6;padding:25px 10px;">

            <tr>
                <td align="center">

                    <table width="100%" cellpadding="0" cellspacing="0" border="0"
                           style="
                               max-width:680px;
                               background:#ffffff;
                               border-radius:12px;
                               overflow:hidden;
                               box-shadow:0 3px 15px rgba(0,0,0,0.08);
                           ">

                        <!-- Header -->
                        <tr>
                            <td style="
                                background:#123c78;
                                padding:28px 25px;
                                text-align:center;
                            ">
                                <h1 style="
                                    margin:0;
                                    color:#ffffff;
                                    font-size:25px;
                                    line-height:1.4;
                                ">
                                    Welcome to Lunar Learning Programs
                                </h1>

                                <p style="
                                    margin:8px 0 0;
                                    color:#dbeafe;
                                    font-size:14px;
                                ">
                                    MaRRS Rediscover
                                </p>
                            </td>
                        </tr>

                        <!-- Content -->
                        <tr>
                            <td style="padding:30px 28px;">

                                <p style="
                                    margin:0 0 16px;
                                    font-size:16px;
                                    line-height:1.6;
                                ">
                                    Dear <strong>' . $safe_name . '</strong>,
                                </p>

                                <p style="
                                    margin:0 0 18px;
                                    font-size:15px;
                                    line-height:1.7;
                                    color:#4b5563;
                                ">
                                    Congratulations! Your registration and purchase
                                    for the Lunar Learning Programs has been completed
                                    successfully.
                                </p>

                                <!-- CIN Box -->
                                <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                       style="
                                           margin:22px 0;
                                           background:#eff6ff;
                                           border:1px solid #bfdbfe;
                                           border-radius:8px;
                                       ">
                                    <tr>
                                        <td style="padding:20px;text-align:center;">

                                            <p style="
                                                margin:0 0 8px;
                                                color:#1d4ed8;
                                                font-size:14px;
                                                font-weight:bold;
                                            ">
                                                Your CIN / Login ID
                                            </p>

                                            <div style="
                                                font-size:28px;
                                                font-weight:bold;
                                                letter-spacing:2px;
                                                color:#123c78;
                                            ">
                                                ' . $safe_cin . '
                                            </div>

                                            <p style="
                                                margin:10px 0 0;
                                                color:#4b5563;
                                                font-size:13px;
                                            ">
                                                Your CIN will be used as your username
                                                and initial password.
                                            </p>

                                        </td>
                                    </tr>
                                </table>

                                <!-- Login Details -->
                                <h2 style="
                                    margin:25px 0 12px;
                                    font-size:19px;
                                    color:#123c78;
                                ">
                                    Learning Portal Login Details
                                </h2>

                                <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                       style="border-collapse:collapse;margin-bottom:20px;">

                                    <tr>
                                        <td style="
                                            padding:12px 0;
                                            font-size:14px;
                                            color:#6b7280;
                                            width:35%;
                                        ">
                                            Portal URL
                                        </td>

                                        <td style="
                                            padding:12px 0;
                                            font-size:14px;
                                        ">
                                            <a href="' . $safe_portal_url . '"
                                               target="_blank"
                                               rel="noopener"
                                               style="
                                                   color:#2563eb;
                                                   text-decoration:none;
                                                   font-weight:bold;
                                               ">
                                                Open Learning Portal
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="
                                            padding:12px 0;
                                            font-size:14px;
                                            color:#6b7280;
                                        ">
                                            Username
                                        </td>

                                        <td style="
                                            padding:12px 0;
                                            font-size:14px;
                                            font-weight:bold;
                                            color:#111827;
                                        ">
                                            ' . $safe_cin . '
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="
                                            padding:12px 0;
                                            font-size:14px;
                                            color:#6b7280;
                                        ">
                                            Password
                                        </td>

                                        <td style="
                                            padding:12px 0;
                                            font-size:14px;
                                            font-weight:bold;
                                            color:#111827;
                                        ">
                                            ' . $safe_cin . '
                                        </td>
                                    </tr>

                                </table>

                                <!-- Purchased Programs -->
                                <h2 style="
                                    margin:25px 0 12px;
                                    font-size:19px;
                                    color:#123c78;
                                ">
                                    Your Purchased Programs
                                </h2>

                                <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                       style="
                                           width:100%;
                                           border-collapse:collapse;
                                           margin-bottom:22px;
                                       ">
                                    ' . $program_rows . '
                                </table>

                                <!-- Learning Process -->
                                <h2 style="
                                    margin:25px 0 12px;
                                    font-size:19px;
                                    color:#123c78;
                                ">
                                    Your Learning Journey
                                </h2>

                                <p style="
                                    margin:0 0 18px;
                                    font-size:15px;
                                    line-height:1.8;
                                    color:#4b5563;
                                ">
                                    Learn → Watch → Practise → Attend → Test
                                    → Improve → Compete → Excel
                                </p>

                                <p style="
                                    margin:0 0 18px;
                                    font-size:15px;
                                    line-height:1.7;
                                    color:#4b5563;
                                ">
                                    Please log in to the learning portal using your
                                    CIN and explore your available learning modules,
                                    assessments, practice activities and competitions.
                                </p>

                                <p style="
                                    margin:0;
                                    font-size:15px;
                                    line-height:1.7;
                                    color:#4b5563;
                                ">
                                    If you face any issue while logging in, please
                                    contact our support team.
                                </p>

                            </td>
                        </tr>

                        <!-- Footer -->
                        <tr>
                            <td style="
                                background:#f9fafb;
                                border-top:1px solid #e5e7eb;
                                padding:22px 25px;
                                text-align:center;
                            ">

                                <p style="
                                    margin:0 0 6px;
                                    font-size:14px;
                                    font-weight:bold;
                                    color:#123c78;
                                ">
                                    Team MaRRS Rediscover
                                </p>

                                <p style="
                                    margin:0;
                                    font-size:13px;
                                    color:#6b7280;
                                ">
                                    Lunar Learning Programs
                                </p>

                            </td>
                        </tr>

                    </table>

                </td>
            </tr>

        </table>

    </body>
    </html>
    ';

    /*
     * Brevo API Payload
     */
    $payload = [
        'sender' => [
            'name'  => $this->sender_name,
            'email' => $this->sender_email,
        ],
        'to' => [
            [
                'email' => $student_email,
                'name'  => $full_name,
            ],
        ],
        'replyTo' => [
            'email' => 'support@marrs.in',
            'name'  => 'MaRRS Support',
        ],
        'subject' => $subject,
        'htmlContent' => $message,
    ];

    $json_payload = json_encode(
        $payload,
        JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
    );

    if ($json_payload === false) {
        log_message(
            'error',
            'send_purchase_confirmation_email: JSON encode failed. Error: ' .
            json_last_error_msg()
        );

        return false;
    }

    /*
     * Send Email Through Brevo
     */
    $ch = curl_init($this->brevo_url);

    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $json_payload,
        CURLOPT_HTTPHEADER     => [
            'accept: application/json',
            'api-key: ' . $this->brevo_api_key,
            'content-type: application/json',
        ],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_CONNECTTIMEOUT => 10,
    ]);

    $response = curl_exec($ch);
    $curl_error = curl_error($ch);
    $http_code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    /*
     * cURL Error
     */
    if ($response === false || $curl_error !== '') {
        log_message(
            'error',
            'send_purchase_confirmation_email: Brevo cURL error: ' .
            $curl_error
        );

        return false;
    }

    /*
     * Brevo API Error
     */
    if ($http_code < 200 || $http_code >= 300) {
        log_message(
            'error',
            'send_purchase_confirmation_email: Brevo API failed. HTTP Code: ' .
            $http_code .
            ' Response: ' .
            $response
        );

        return false;
    }

    /*
     * Success
     */
    log_message(
        'info',
        'send_purchase_confirmation_email: Email sent successfully to ' .
        $student_email .
        '. Brevo Response: ' .
        $response
    );

    return true;
}

    public function get_active_plans()
{
    $this->db->select('plans.*, plans.plan_name AS name, plans.final_amount AS price, plan_categories.name AS category_name');
    $this->db->from('plans');
    $this->db->join('plan_categories', 'plan_categories.id = plans.category_id');
    $this->db->where('plans.status', 'Active');
    $this->db->order_by('plan_categories.id', 'ASC');
    $this->db->order_by('plans.final_amount', 'ASC');
    $plans = $this->db->get()->result_array();
    foreach ($plans as &$plan) {
        $this->db->select('test_types.name, plan_test_allocations.quantity');
        $this->db->from('plan_test_allocations');
        $this->db->join('test_types', 'test_types.id = plan_test_allocations.test_type_id');
        $this->db->where('plan_test_allocations.plan_id', $plan['id']);
        $plan['allocations'] = $this->db->get()->result_array();
    }
    return $plans;
}

public function get_plan($plan_id)
{
    $this->db->select('plans.*, plans.plan_name AS name, plans.final_amount AS price, plan_categories.name AS category_name');
    $this->db->from('plans');
    $this->db->join('plan_categories', 'plan_categories.id = plans.category_id');
    $this->db->where('plans.id', $plan_id);
    $this->db->where('plans.status', 'Active');
    return $this->db->get()->row_array();
}

    /**
     * Records the student's plan choice as a Pending order.
     * Requires the `student_plan_orders` table — see setup notes
     * for the CREATE TABLE statement.
     *
     * SUPERSEDED by the cart/orders methods below — kept only in
     * case anything already calls it. Prefer create_order() for
     * new checkout flows.
     */
    public function create_plan_order($cin, $plan)
    {
        $data = [
            'cin'        => $cin,
            'plan_id'    => $plan['id'],
            'price'      => $plan['price'],
            'status'     => 'Pending',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        return $this->db->insert('student_plan_orders', $data)
            ? $this->db->insert_id()
            : false;
    }

    // -----------------------------------------------------------
    // Catalog: Programs → Plans / Components
    // (lunar_programs / lunar_plans / lp_components)
    // -----------------------------------------------------------

       public function get_active_programs($student_class = null)
    {
        $this->db->from('lunar_programs');
        $this->db->where('status', 'Active');
        $this->db->order_by('id', 'ASC');
        $programs = $this->db->get()->result_array();

        // No class given (e.g. bridged/legacy student with no class
        // recorded) — fail OPEN, show everything, rather than hiding
        // the whole catalog from someone we can't classify.
        if ($student_class === null || $student_class === '') {
            return $programs;
        }

        $student_order = $this->grade_order[$student_class] ?? null;

        // Unknown/unmapped class value — same fail-open reasoning.
        // Log it so unmapped labels get noticed and added to the map.
        if ($student_order === null) {
            log_message('error', 'get_active_programs: unmapped student class "' . $student_class . '" — showing all active programs.');
            return $programs;
        }

        return array_values(array_filter($programs, function ($p) use ($student_order) {
            $from = $this->grade_order[$p['grade_from']] ?? null;
            $to   = $this->grade_order[$p['grade_to']] ?? null;

            // A program with an unmapped grade_from/grade_to is
            // excluded rather than risk showing it to the wrong class.
            if ($from === null || $to === null) {
                return false;
            }

            return $student_order >= $from && $student_order <= $to;
        }));
    }

    public function get_active_plans_catalog($allowed_program_ids = null)
{
    $this->db->from('lunar_plans');
    $this->db->where('status', 'Active');

    if ($allowed_program_ids !== null) {
        if (empty($allowed_program_ids)) {
            return []; // no allowed programs -> no plans to show
        }
        $this->db->where_in('program_id', $allowed_program_ids);
    }

    $this->db->order_by('program_id', 'ASC');
    $this->db->order_by('final_price', 'ASC');
    $plans = $this->db->get()->result_array();

    if (empty($plans)) {
        return $plans;
    }

    /* ---- attach components: lunar_plans -> lunar_plan_components -> lp_components ---- */
    $plan_ids = array_column($plans, 'id');

    $plan_components = $this->db
        ->select('lpc.plan_id, lpc.component_id, lpc.units AS quantity, c.component_name')
        ->from('lunar_plan_components lpc')
        ->join('lp_components c', 'c.id = lpc.component_id', 'inner')
        ->where('c.status', 'Active')
        ->where_in('lpc.plan_id', $plan_ids)
        ->order_by('lpc.plan_id', 'ASC')
        ->order_by('lpc.id', 'ASC')
        ->get()
        ->result_array();

    $components_by_plan = [];
    foreach ($plan_components as $component) {
        $plan_id = (int) $component['plan_id'];
        $components_by_plan[$plan_id][] = [
            'component_id'   => (int) $component['component_id'],
            'quantity'       => (int) $component['quantity'],
            'component_name' => $component['component_name'],
        ];
    }

    foreach ($plans as &$plan) {
        $plan['components'] = $components_by_plan[(int) $plan['id']] ?? [];
    }
    unset($plan);

    return $plans;
}
public function get_active_components_catalog()
{
    // Reset any previous Query Builder state
    $this->db->reset_query();

    $this->db->select('lp_components.*');
    $this->db->from('lp_components');
     $this->db->where('price >', 0); 

    $this->db->where('lp_components.status', 'Active');

    $this->db->order_by('lp_components.program_id', 'DESC');
    $this->db->order_by('lp_components.id', 'DESC');

    return $this->db->get()->result_array();
}

    /**
     * Bridges a cin_list-only student (no linked `students`/PRID row
     * yet — e.g. someone who registered through the legacy CIN system
     * before this catalog existed) into the students table on demand,
     * so they can use the Program/Plan/Component catalog. Mirrors the
     * field mapping already used in reverse by
     * save_post_payment_records(). Backfills cin_list.prid so this
     * only ever needs to run once per student.
     *
     * Returns the PRID to use (existing or newly created), or false
     * if the cin_list row doesn't exist or the insert failed.
     */
    public function create_student_from_cin($cin)
    {
        $cinRow = $this->db->get_where('cin_list', ['cin' => $cin])->row_array();
        if (!$cinRow) {
            return false;
        }

        if (!empty($cinRow['prid'])) {
            return $cinRow['prid']; // already linked — nothing to do
        }

        $prid = $this->generate_prid();

        $data = [
            'first_name'              => $cinRow['student_name'] ?? '',
            'middle_name'             => '',
            'last_name'               => '',
            'father_name'             => $cinRow['father_name'] ?? '',
            'mother_name'             => $cinRow['mother_name'] ?? '',
            'mobile'                  => $cinRow['stud_phone'] ?? '',
            'email'                   => $cinRow['stud_email'] ?? '',
            'school_code'             => null,
            'registration_code'       => null,
            'class_key'               => $cinRow['class'] ?? '',
            'class_id'                => null,
            'category'                => '',
            'category_id'             => null,
            'period_id'               => (string) ($cinRow['period_id'] ?? ''),
            'country'                 => null,
            'state'                   => $cinRow['state_id'] ?? null,
            'pin'                     => 0,
            'address1'                => $cinRow['address1'] ?? '',
            'address2'                => $cinRow['address2'] ?? '',
            'date'                    => time(),
            'status'                  => 'Active',
            'payment_status'          => 'Pending',
            'product_id'              => 0,
            'discount_id'             => 0,
            'PRID'                    => $prid,
            'gender'                  => $cinRow['gender'] ?? '',
            'whatsapp'                => $cinRow['stud_phone'] ?? '',
            'city'                    => '',
            'area_code'               => null,
            'year'                    => (int) date('Y'),
            'class'                   => $cinRow['class'] ?? '',
            'level_id'                => 0,
            'school_id'               => $cinRow['school_id'] ?: 0,
            'franchise_id'            => $cinRow['franchise_id'] ?: null,
            'associate_id'            => null,
            'competition_schedule_id' => $cinRow['competition_schedule_id'] ?? null,
        ];

        $inserted = $this->db->insert('students', $data);
        if (!$inserted) {
            return false;
        }

        $this->db->update('cin_list', ['prid' => $prid], ['cin' => $cin]);

        return $prid;
    }

    public function get_lunar_plan($plan_id)
    {
        $this->db->from('lunar_plans');
        $this->db->where('id', $plan_id);
        $this->db->where('status', 'Active');
        return $this->db->get()->row_array();
    }

    public function get_lunar_component($component_id)
    {
        $this->db->from('lp_components');
        $this->db->where('id', $component_id);
        $this->db->where('status', 'Active');
        return $this->db->get()->row_array();
    }

    public function get_lunar_program($program_id)
    {
        // No status='Active' filter here on purpose — a student who
        // already bought into a program should still see it even if
        // it's later deactivated for new purchases.
        return $this->db->get_where('lunar_programs', ['id' => $program_id])->row_array();
    }

    /**
     * All (item_type, item_id, program_id) triples the student has
     * actually paid for, according to orders/order_items. Currently
     * this will always come back empty in production, since checkout
     * still writes to the legacy `new_cart` table (see
     * get_purchased_product_names() below) — kept here so this starts
     * working automatically once checkout is switched over to
     * orders/order_items, with no further code changes needed.
     */

    /**
     * Cached check: do order_items carry the plan-unit columns? Lets the
     * code below run safely even if the ALTER hasn't been applied yet,
     * instead of throwing a DB error in the middle of a payment.
     */
    private $_oi_unit_cols = null;

    private function order_items_has_unit_cols()
    {
        if ($this->_oi_unit_cols === null) {
            $this->_oi_unit_cols = $this->db->field_exists('unit_component_id', 'order_items')
                && $this->db->field_exists('unit_from', 'order_items')
                && $this->db->field_exists('unit_to', 'order_items')
                && $this->db->field_exists('unit_list', 'order_items');
        }
        return $this->_oi_unit_cols;
    }

public function get_purchased_items($cin)
{
    $select = 'order_items.item_type, order_items.plan_id AS item_id, order_items.program_id,
               order_items.quantity, order_items.week_number';

    if ($this->order_items_has_unit_cols()) {
        $select .= ', order_items.unit_component_id, order_items.unit_from, order_items.unit_to, order_items.unit_list';
    }

    $this->db->select($select);
    $this->db->from('order_items');
    $this->db->join('orders', 'orders.id = order_items.order_id');
    $this->db->where('orders.cin', $cin);
    $this->db->where('orders.status', 'Paid'); // only Paid orders count
    return $this->db->get()->result_array();
}
    /**
     * The live source of truth for purchases today: `new_cart` doesn't
     * carry a plan/component id or a program_id — just a free-text
     * `product_name` — so a Paid row here is matched back to a
     * lunar_plans.plan_name or lp_components.component_name by exact
     * text (case/whitespace-insensitive). This is inherently fragile
     * (renaming a plan breaks the match to anyone who already bought
     * it under the old name) but it's what the live checkout script
     * actually writes today.
     */
    public function get_purchased_product_names($cin)
    {
        $this->db->select('product_name');
        $this->db->distinct();
        $this->db->from('new_cart');
        $this->db->where('cin', $cin);
        $this->db->where('status', 'Paid');
        $rows = $this->db->get()->result_array();

        return array_map(function ($r) {
            return strtolower(trim($r['product_name']));
        }, $rows);
    }

    /**
     * The program a student is enrolled in for the year. Tries the new
     * orders/order_items path first (structured, unambiguous); if that
     * comes back empty — which it will, until checkout is switched
     * over — falls back to matching their Paid new_cart product names
     * against plan/component names to find which program they belong
     * to. Assumes one program per student per year, per the "one
     * program, one year" rule. Returns null if nothing matches either
     * way.
     */
    /**
     * The program a student is already locked into, looked up by
     * their catalog PRID (i.e. the value used everywhere else in
     * this file as "$cin", from select_plan()'s URL segment) rather
     * than a real cin_list CIN. Checks two paths:
     *   - orders.cin literally holds the PRID for purchases made
     *     through this catalog's own checkout, so get_student_program()
     *     already finds those directly.
     *   - Legacy new_cart purchases are recorded under the student's
     *     real CIN, not their PRID — bridged here via cin_list.prid.
     * Returns null if the student hasn't bought into any program yet
     * (first purchase — free to pick any program).
     */
    public function get_locked_program_for_prid($prid)
    {
        $program = $this->get_student_program($prid);
        if ($program) {
            return $program;
        }

        $cinRow = $this->db->get_where('cin_list', ['prid' => $prid])->row_array();
        if ($cinRow) {
            $program = $this->get_student_program($cinRow['cin']);
        }

        return $program;
    }

    /**
     * Whether a student (by PRID) is allowed to buy from $program_id:
     * true if they have no locked program yet, or if $program_id is
     * exactly the program they're already locked into. Used both to
     * scope the catalog view and to reject cross-program cart adds
     * server-side (the view-level restriction alone isn't real
     * enforcement).
     */
    public function can_buy_from_program($prid, $program_id)
    {
        $locked = $this->get_locked_program_for_prid($prid);
        if (!$locked) {
            return true;
        }
        return (int) $locked['id'] === (int) $program_id;
    }

    public function get_student_program($cin)
    {
        $this->db->select('order_items.program_id');
        $this->db->from('order_items');
        $this->db->join('orders', 'orders.id = order_items.order_id');
        $this->db->where('orders.cin', $cin);
        $this->db->where('orders.status', 'Paid');
        $this->db->where('order_items.program_id IS NOT NULL', null, false);
        $this->db->order_by('orders.paid_at', 'desc');
        $this->db->limit(1);
        $row = $this->db->get()->row_array();

        if ($row) {
            return $this->get_lunar_program($row['program_id']);
        }

        $purchasedNames = $this->get_purchased_product_names($cin);
        return $this->match_program_from_names($purchasedNames);
    }

    /**
     * Shared helper: given a list of lowercased/trimmed purchased
     * product names, finds the program_id of whichever lunar_plans or
     * lp_components row matches one of them.
     */
    private function match_program_from_names($purchasedNames)
    {
        if (empty($purchasedNames)) {
            return null;
        }

        $escaped = array_map([$this->db, 'escape'], $purchasedNames);
        $inList  = implode(',', $escaped);

        $row = $this->db->query(
            "SELECT program_id FROM lunar_plans WHERE LOWER(TRIM(plan_name)) IN ($inList) LIMIT 1"
        )->row_array();

        if (!$row) {
            $row = $this->db->query(
                "SELECT program_id FROM lp_components WHERE LOWER(TRIM(component_name)) IN ($inList) LIMIT 1"
            )->row_array();
        }

        if (!$row) {
            return null;
        }

        return $this->get_lunar_program($row['program_id']);
    }

    /**
     * Every plan and component under a program, each flagged with
     * 'bought' => true/false. A plan/component counts as bought if
     * either:
     *   - its own id shows up in a Paid orders/order_items row (the
     *     structured path, currently always empty in production), or
     *   - its name matches a Paid new_cart.product_name for this cin
     *     (the live path today).
     * Drives the "Bought / Pending — Buy" dashboard section.
     */

public function get_program_purchase_status($cin, $program_id)
{
    $plans      = $this->db->get_where('lunar_plans', ['program_id' => $program_id])->result_array();
    $components = $this->db->get_where('lp_components', ['program_id' => $program_id])->result_array();

    // legacy new_cart path (name match)
    $purchasedNames = $this->get_purchased_product_names($cin);

    // plan -> components mapping (lunar_plan_components)
    $componentToPlans = [];
    $planUnitsByComp  = []; // plan_id => [component_id => units]
    if (!empty($plans)) {
        $pcs = $this->db->select('plan_id, component_id, units')
            ->from('lunar_plan_components')
            ->where_in('plan_id', array_column($plans, 'id'))
            ->get()->result_array();
        foreach ($pcs as $pc) {
            $componentToPlans[(int) $pc['component_id']][] = (int) $pc['plan_id'];
            $planUnitsByComp[(int) $pc['plan_id']][(int) $pc['component_id']] = (int) $pc['units'];
        }
    }

    $boughtPlanIds           = [];
    $boughtComponentIds      = [];
    $componentQuantities     = [];
    $componentPurchasedWeeks = [];

    foreach ($this->get_purchased_items($cin) as $p) {
        if ((int) $p['program_id'] !== (int) $program_id) {
            continue;
        }

        if ($p['item_type'] === 'component') {
            $cid = (int) $p['item_id'];
            $boughtComponentIds[$cid]  = true;
            $componentQuantities[$cid] = ($componentQuantities[$cid] ?? 0) + (int) ($p['quantity'] ?? 1);
            if ($p['week_number'] !== null && $p['week_number'] !== '') {
                $componentPurchasedWeeks[$cid][] = (int) $p['week_number'];
            }
        } else {
            // plan purchase
            $planId = (int) $p['item_id'];
            $boughtPlanIds[$planId] = true;

            // plan's units -> that component's purchased_weeks
            $weeks    = [];
            $unitList = $p['unit_list'] ?? null;
            $unitFrom = $p['unit_from'] ?? null;
            $unitTo   = $p['unit_to']   ?? null;

            if (!empty($unitList)) {
                foreach (explode(',', $unitList) as $w) {
                    if (trim($w) !== '') { $weeks[] = (int) $w; }
                }
            } elseif (!empty($unitFrom)) {
                for ($w = (int) $unitFrom; $w <= (int) $unitTo; $w++) { $weeks[] = $w; }
            }

            $unitCid = (int) ($p['unit_component_id'] ?? 0);

            if ($unitCid && $weeks) {
                $componentPurchasedWeeks[$unitCid] = array_merge($componentPurchasedWeeks[$unitCid] ?? [], $weeks);
                $componentQuantities[$unitCid]     = ($componentQuantities[$unitCid] ?? 0) + count($weeks);
            } else {
                // FALLBACK — older Paid orders whose order_items have no unit_*:
                // unlock the plan's first N units.
                foreach (($planUnitsByComp[$planId] ?? []) as $cid => $need) {
                    $componentQuantities[$cid] = max($componentQuantities[$cid] ?? 0, $need);
                }
            }
        }
    }

    // plans
    foreach ($plans as &$plan) {
        $pid = (int) $plan['id'];
        $plan['bought'] = isset($boughtPlanIds[$pid])
            || in_array(strtolower(trim($plan['plan_name'])), $purchasedNames, true);
    }
    unset($plan);

    // components
    foreach ($components as &$component) {
        $cid = (int) $component['id'];

        $directBought = isset($boughtComponentIds[$cid])
            || in_array(strtolower(trim($component['component_name'])), $purchasedNames, true);

        $viaPlan = false;
        foreach (($componentToPlans[$cid] ?? []) as $pid) {
            if (isset($boughtPlanIds[$pid])) { $viaPlan = true; break; }
        }

        $component['bought']          = $directBought || $viaPlan;
        $purchased                    = $componentQuantities[$cid] ?? null;
        $component['purchased_units'] = $purchased;
        $component['purchased_weeks'] = array_values(array_unique($componentPurchasedWeeks[$cid] ?? []));

        $maxUnits = isset($component['max_units']) ? (int) $component['max_units'] : 0;
        $component['remaining_units'] = $maxUnits > 0
            ? max(0, $maxUnits - (int) ($purchased ?? 0))
            : null;
    }
    unset($component);

    return ['plans' => $plans, 'components' => $components];
}


public function update_profile($student_id, array $data)
{
    if (empty($student_id) || empty($data)) {
        return false;
    }

    // Only these columns can be changed through the profile form
    $allowed = [
        'first_name', 'middle_name', 'last_name',
        'class', 'gender', 'email', 'mobile',
        'father_name', 'mother_name', 'address1',
        'school_id',
    ];
    $data = array_intersect_key($data, array_flip($allowed));

    if (empty($data)) {
        return false;
    }

    $this->db->where('id', $student_id);
    $ok = $this->db->update('students', $data);   // returns TRUE/FALSE

    // Don't use affected_rows(): saving without changes returns 0
    // and would wrongly show "Could not update profile".
    return (bool) $ok;
}

public function get_profile_by_prid($prid)
{
    $this->db->select('*');
    $this->db->from('students');
    $this->db->where('PRID', $prid);
    $query = $this->db->get();

    return $query->row_array(); // returns array, or NULL if no match
}


public function get_school_by_id($school_id)
{
    if (!$school_id) {
        return null;
    }

    $this->db->select('*');
    $this->db->from('school_new');
    $this->db->where('id', $school_id);
    $query = $this->db->get();

    return $query->row_array(); // matches array-style access: $school['name'], $school['address']
}
    // -----------------------------------------------------------
    // Cart
    //
    // Cart rows live in `lunar_cart_items`: one row per plan or
    // component line, told apart by `item_type` ('plan' |
    // 'component'). `item_id` points at lunar_plans.id or
    // lp_components.id depending on item_type. `item_name` and
    // `unit_price` are snapshotted at add-time so the cart doesn't
    // silently change under the student if a price/name is edited
    // later — checkout re-snapshots into order_items regardless.
    // -----------------------------------------------------------

    /**
     * Adds a plan to the cart, or is a no-op if it's already there.
     * Validates the plan is real and active before inserting.
     */
    /**
     * Whether a plan/component has already been purchased by this
     * student (by PRID, i.e. the "$cin" used throughout this file),
     * checking both the structured orders/order_items path and the
     * live new_cart name-match path. Used to block re-adding
     * something already owned, in addition to the catalog UI hiding
     * the Add option for it.
     */
    public function is_already_purchased($cin, $item_id, $item_name)
    {
        $purchasedIds = array_map(function ($p) { return (int) $p['item_id']; }, $this->get_purchased_items($cin));
        if (in_array((int) $item_id, $purchasedIds, true)) {
            return true;
        }

        $purchasedNames = $this->get_purchased_product_names($cin);
        return in_array(strtolower(trim($item_name)), $purchasedNames, true);
    }

   /**
 * Unit preview for a plan. $from_unit (optional) = unit chosen by the student
 * for the FIRST study-pack component; must be one of valid_starts.
 */
/**
 * Unit preview for a plan.
 * $selected_units (array|null): units chosen by the student for the FIRST
 * study-pack component; must be exactly "units" many, all free.
 */
public function get_plan_unit_preview($cin, $plan_id, $selected_units = null)
{
    $student = $this->get_student_by_cin($cin);
    $plan    = $this->get_lunar_plan($plan_id);
    if (!$student || !$plan) {
        return ['success' => false, 'message' => 'Invalid plan.'];
    }
    $class_number = $this->resolve_class_number($student['class'] ?? null);
    if ($class_number === null) {
        return ['success' => true, 'items' => []];
    }

    $pcs = $this->db
        ->select('lpc.component_id, lpc.units, c.component_name')
        ->from('lunar_plan_components lpc')
        ->join('lp_components c', 'c.id = lpc.component_id')
        ->where('lpc.plan_id', $plan_id)
        ->order_by('lpc.id', 'ASC')
        ->get()->result_array();

    $items = [];
    $first = true;

    foreach ($pcs as $pc) {
        $cid  = (int) $pc['component_id'];
        $need = (int) $pc['units'];

        // Only study-pack components have weekly units in lm_content
        $weeks = array_map('intval', array_column(
            $this->db->select('week_number')->distinct()
                ->where('component_id', $cid)->where('class_number', $class_number)
                ->where('status', 'Active')->where('content_type', 'study_pack')
                ->order_by('week_number', 'ASC')->get('lm_content')->result_array(),
            'week_number'));
        if (empty($weeks) || $need < 1) { continue; }

        $used = [];

        // 1) Paid single-week component purchases
        $rows = $this->db->select('oi.week_number')->from('order_items oi')
            ->join('orders o', 'o.id = oi.order_id')
            ->where('o.cin', $cin)->where('o.status', 'Paid')
            ->where('oi.item_type', 'component')->where('oi.plan_id', $cid)
            ->where('oi.week_number IS NOT NULL', null, false)
            ->get()->result_array();
        foreach ($rows as $r) { $used[(int) $r['week_number']] = true; }

        // 2) Paid plan purchases (unit_list, or from-to range for older rows)
        $rows = $this->db->select('oi.unit_list, oi.unit_from, oi.unit_to')->from('order_items oi')
            ->join('orders o', 'o.id = oi.order_id')
            ->where('o.cin', $cin)->where('o.status', 'Paid')
            ->where('oi.item_type', 'plan')->where('oi.unit_component_id', $cid)
            ->get()->result_array();
        foreach ($rows as $r) { $this->mark_units_used($used, $r); }

        // 3) Already in cart (component weeks + plan units)
        $rows = $this->db->select('week_number')
            ->where('cin', $cin)->where('item_type', 'component')
            ->where('item_id', $cid)->where('week_number IS NOT NULL', null, false)
            ->get('lunar_cart_items')->result_array();
        foreach ($rows as $r) { $used[(int) $r['week_number']] = true; }

        $rows = $this->db->select('unit_list, unit_from, unit_to')
            ->where('cin', $cin)->where('item_type', 'plan')
            ->where('unit_component_id', $cid)->get('lunar_cart_items')->result_array();
        foreach ($rows as $r) { $this->mark_units_used($used, $r); }

        $free = array_values(array_filter($weeks, function ($w) use ($used) { return !isset($used[$w]); }));
             if (count($free) < $need) {
             return ['success' => false,
            'message' => $pc['component_name'] . ' – ' . $need . ' Units: This option is currently unavailable because one or more of the ' . $need .
                         ' Units have already been purchased or added to your cart. ' .
                         'Please remove the units already selected or choose the available Units individually.'];
            }

        if ($first && is_array($selected_units)) {
            // validate the student's choice
            $sel = array_values(array_unique(array_map('intval', $selected_units)));
            sort($sel);
            if (count($sel) !== $need) {
                return ['success' => false, 'message' => 'Please select exactly ' . $need . ' units.'];
            }
            foreach ($sel as $w) {
                if (!in_array($w, $free, true)) {
                    return ['success' => false, 'message' => 'Unit ' . $w . ' is not available. Please choose again.'];
                }
            }
            $pick = $sel;
        } else {
            $pick = array_slice($free, 0, $need);
        }

        $items[] = [
            'component_id'   => $cid,
            'component_name' => $pc['component_name'],
            'units'          => $need,
            'from'           => $pick[0],
            'to'             => end($pick),
            'list'           => implode(',', $pick),
            'weeks'          => $weeks,
            'used'           => array_map('intval', array_keys($used)),
        ];
        $first = false;
    }

    return ['success' => true, 'items' => $items];
}

/** helper: mark units of a plan row (unit_list, else from-to range) as used */
private function mark_units_used(array &$used, array $row)
{
    if (!empty($row['unit_list'])) {
        foreach (explode(',', $row['unit_list']) as $w) {
            if ($w !== '') { $used[(int) $w] = true; }
        }
    } elseif (!empty($row['unit_from'])) {
        for ($w = (int) $row['unit_from']; $w <= (int) $row['unit_to']; $w++) { $used[$w] = true; }
    }
}

public function add_plan_to_cart($cin, $plan_id, $selected_units = null, &$error = null)
{
    $plan = $this->get_lunar_plan($plan_id);
    if (!$plan) { return false; }

    if (!$this->can_buy_from_program($cin, $plan['program_id'])) {
        return false; // already locked into a different program
    }
    if ($this->is_already_purchased($cin, $plan_id, $plan['plan_name'])) {
        return false; // already bought — no re-adding
    }

    $existing = $this->db->get_where('lunar_cart_items', [
        'cin'       => $cin,
        'item_type' => 'plan',
        'item_id'   => $plan_id,
    ])->row();
    if ($existing) { return true; } // already in cart

    // Server-side validation of the student's selected units
    $preview = $this->get_plan_unit_preview($cin, $plan_id, $selected_units);
    if (!$preview['success']) {
        $error = $preview['message'];
        return false;
    }
    $unit = !empty($preview['items']) ? $preview['items'][0] : null;

    $now = date('Y-m-d H:i:s');
    return $this->db->insert('lunar_cart_items', [
        'cin'               => $cin,
        'program_id'        => $plan['program_id'],
        'item_type'         => 'plan',
        'item_id'           => $plan_id,
        'item_name'         => $plan['plan_name'],
        'unit_price'        => $plan['final_price'],
        'quantity'          => 1,
        'unit_component_id' => $unit ? $unit['component_id'] : null,
        'unit_from'         => $unit ? $unit['from'] : null,
        'unit_to'           => $unit ? $unit['to'] : null,
        'unit_list'         => $unit ? $unit['list'] : null,
        'created_at'        => $now,
        'updated_at'        => $now,
    ]);
}

    /**
     * Adds a component to the cart. If it's already in the cart,
     * increments the quantity instead of inserting a duplicate row.
     * Validates the component is real and active before inserting.
     */
      public function add_component_to_cart($cin, $component_id, $qty = 1, $week_number = null, $class_number = null)
{
    $component = $this->get_lunar_component($component_id);
    if (!$component) return false;
    if (!$this->can_buy_from_program($cin, $component['program_id'])) return false;

    $qty = max(1, (int) $qty);
    $now = date('Y-m-d H:i:s');

    // Week-based rows are never merged into an existing row —
    // each week is its own cart line so it can be tracked/removed
    // individually and correctly reflected as "bought" later.
    if ($week_number !== null) {
        return $this->db->insert('lunar_cart_items', [
            'cin'          => $cin,
            'program_id'   => $component['program_id'],
            'item_type'    => 'component',
            'item_id'      => $component_id,
            'item_name'    => $component['component_name'] . ' (Week ' . $week_number . ')',
            'unit_price'   => $component['unit_price'],
            'quantity'     => 1,
            'week_number'  => $week_number,
            'class_number' => $class_number,
            'created_at'   => $now,
            'updated_at'   => $now,
        ]);
    }

    // Non-weekly component (e.g. Test) — one cart row, no From/To units.
    $existing = $this->db->get_where('lunar_cart_items', [
        'cin'       => $cin,
        'item_type' => 'component',
        'item_id'   => $component_id,
    ])->row();

    if ($existing) {
        return true; // already in cart
    }

    return $this->db->insert('lunar_cart_items', [
        'cin'         => $cin,
        'program_id'  => $component['program_id'],
        'item_type'   => 'component',
        'item_id'     => $component_id,
        'item_name'   => $component['component_name'],
        'unit_price'  => $component['unit_price'],
        'quantity'    => 1,
        'created_at'  => $now,
        'updated_at'  => $now,
    ]);
}
    /**
     * Removes a single cart row by its own id (works for either a
     * plan or a component line, since both live in `lunar_cart_items`).
     */
    public function remove_cart_item($cin, $cart_item_id)
    {
        return $this->db->delete('lunar_cart_items', ['cin' => $cin, 'id' => $cart_item_id]);
    }

    /**
     * Cart contents, using the snapshotted name/price stored on
     * `lunar_cart_items` at add-time, joined only to `lunar_programs`
     * for the program name shown alongside each line.
     */

   public function get_cart($cin)
{
    $this->db->select('lunar_cart_items.*, lunar_programs.program_name AS category_name');
    $this->db->from('lunar_cart_items');
    $this->db->join('lunar_programs', 'lunar_programs.id = lunar_cart_items.program_id', 'left');
    $this->db->where('lunar_cart_items.cin', $cin);
    $this->db->order_by('lunar_cart_items.id', 'ASC');
    $rows = $this->db->get()->result_array();

    $items = [];
    foreach ($rows as $row) {
        $items[] = [
            'cart_item_id'    => $row['id'],
            'id'              => $row['item_id'],
            'item_type'       => $row['item_type'],
            'name'            => $row['item_name'],
            'category_name'   => $row['category_name'],
            'program_id'      => $row['program_id'],
            'price'           => (float) $row['unit_price'],
            'quantity'        => (int) $row['quantity'],
            // week already sitting in the cart (so the From-Unit dropdown hides it)
            'week_class_key'  => ($row['week_number'] !== null)
                ? $row['week_number'] . '-' . $row['class_number']
                : null,
            'unit_component_id' => $row['unit_component_id'] ?? null,
            'unit_from'         => $row['unit_from'] ?? null,
            'unit_to'           => $row['unit_to'] ?? null,
            'unit_list'         => $row['unit_list'] ?? null,   // NEW — create_order() needs it
        ];
    }

    return $items;
}

    public function get_cart_total($cin)
    {
        $items = $this->get_cart($cin);
        $total = 0;
        foreach ($items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    public function clear_cart($cin)
    {
        return $this->db->delete('lunar_cart_items', ['cin' => $cin]);
    }

    // -----------------------------------------------------------
    // Mix & Match (custom pack builder)
    // -----------------------------------------------------------
    // Requires two schema additions — see mix_match_schema.sql:
    //   1. A `mix_match_rates` table (one settings row) holding the
    //      per-unit rates used to price a custom combination.
    //   2. Three nullable columns on `plans`:
    //        duration_weeks INT NULL,
    //        pack_type      VARCHAR(30) NULL,
    //        includes_videos TINYINT(1) NOT NULL DEFAULT 0,
    //        is_custom       TINYINT(1) NOT NULL DEFAULT 0,
    //        custom_fingerprint VARCHAR(64) NULL UNIQUE
    //      A custom pack is stored as an ordinary row in `plans`
    //      (is_custom = 1) so the existing cart / checkout / order
    //      snapshot code needs zero changes to support it.
    // -----------------------------------------------------------

    /**
     * Fetches the single mix_match_rates settings row, or null if
     * the table is empty / doesn't exist yet (caller should treat
     * that as "pricing not configured").
     */
    public function get_mix_match_rates()
    {
        if (!$this->db->table_exists('mix_match_rates')) {
            return null;
        }
        $row = $this->db->limit(1)->get('mix_match_rates')->row_array();
        return $row ?: null;
    }

    /**
     * Normalizes and validates the raw POST-shaped input used by
     * both ajax_get_custom_price() and ajax_add_custom_to_cart().
     * Returns a clean array, or null if the selection is invalid
     * (out-of-range weeks, or nothing at all selected).
     */
    public function normalize_custom_selection($input)
    {
        $weeks = (int) ($input['weeks'] ?? 0);
        if ($weeks < 1 || $weeks > 52) {
            return null;
        }

        $sel = [
            'weeks'            => $weeks,
            'include_material' => !empty($input['include_material']) && $input['include_material'] !== '0',
            'include_videos'   => !empty($input['include_videos']) && $input['include_videos'] !== '0',
            'include_mock'     => !empty($input['include_mock']) && $input['include_mock'] !== '0',
            'include_starter'  => !empty($input['include_starter']) && $input['include_starter'] !== '0',
            'include_mover'    => !empty($input['include_mover']) && $input['include_mover'] !== '0',
            'include_flyer'    => !empty($input['include_flyer']) && $input['include_flyer'] !== '0',
            'include_national' => !empty($input['include_national']) && $input['include_national'] !== '0',
        ];

        // Videos only make sense alongside Learning Material.
        $sel['include_videos'] = $sel['include_videos'] && $sel['include_material'];

        // Mover Test: 1 every 16 weeks, plus a bonus Mover Test when the
        // pack is exactly 52 weeks (plan completion bonus — does not
        // apply to other lengths, even multiples of 52).
        $sel['movers']    = intdiv($weeks, 16) + ($weeks === 52 ? 1 : 0);
        // Flyer Test: 1 every 26 weeks.
        $sel['flyers']    = intdiv($weeks, 26);
        // National Assessment: 1 every 52 weeks.
        $sel['nationals'] = intdiv($weeks, 52);

        // Each milestone test can only be selected if the range actually earns one.
        $sel['include_mover']    = $sel['include_mover']    && $sel['movers'] > 0;
        $sel['include_flyer']    = $sel['include_flyer']    && $sel['flyers'] > 0;
        $sel['include_national'] = $sel['include_national'] && $sel['nationals'] > 0;

        $anything = $sel['include_material'] || $sel['include_mock'] || $sel['include_starter']
            || $sel['include_videos'] || $sel['include_mover'] || $sel['include_flyer'] || $sel['include_national'];

        if (!$anything) {
            return null;
        }

        return $sel;
    }

    /**
     * Prices a normalized selection against the mix_match_rates row.
     * Daily Tests are bundled free with Learning Material and are not
     * priced or toggled separately. Mover/Flyer/National are each
     * gated by their own include_* flag (set only when the range
     * actually earns that milestone — see normalize_custom_selection).
     * Returns ['total' => float, 'breakdown' => [...]], or null if
     * rates aren't configured.
     */
    public function calculate_custom_pack_price($sel, $rates = null)
    {
        $rates = $rates ?? $this->get_mix_match_rates();
        if (!$rates) {
            return null;
        }

        $weeks = $sel['weeks'];
        $breakdown = [];
        $total = 0.0;

        if ($sel['include_material']) {
            $amt = $weeks * (float) $rates['rate_learning_material_per_lm'];

            // Discount applies only to the Learning Material line:
            //   52 weeks (full plan)  -> 10%
            //   33-51 weeks (>32)     -> 5%
            //   32 weeks or fewer     -> no discount
            $discount_percent = 0;
            if ($weeks === 52) {
                $discount_percent = 10;
            } elseif ($weeks > 32) {
                $discount_percent = 5;
            }
            $discount_amount = round($amt * $discount_percent / 100, 2);
            $amt_after_discount = round($amt - $discount_amount, 2);

            $breakdown['learning_material'] = $amt_after_discount;
            if ($discount_percent > 0) {
                $breakdown['learning_material_gross'] = round($amt, 2);
                $breakdown['learning_material_discount_percent'] = $discount_percent;
                $breakdown['learning_material_discount_amount'] = $discount_amount;
            }
            $total += $amt_after_discount;
        }
        if ($sel['include_mock']) {
            $amt = $weeks * (float) $rates['rate_mock_test_per_lm'];
            $breakdown['mock_test'] = $amt;
            $total += $amt;
        }
        if ($sel['include_starter']) {
            $amt = $weeks * (float) $rates['rate_starter_test_per_lm'];
            $breakdown['starter_test'] = $amt;
            $total += $amt;
        }
        if ($sel['include_videos']) {
            $amt = $weeks * (float) $rates['rate_video_per_lm'];
            $breakdown['videos'] = $amt;
            $total += $amt;
        }
        if ($sel['include_mover']) {
            $amt = $sel['movers'] * (float) $rates['rate_mover_test'];
            $breakdown['mover_test'] = $amt;
            $total += $amt;
        }
        if ($sel['include_flyer']) {
            $amt = $sel['flyers'] * (float) $rates['rate_flyer_test'];
            $breakdown['flyer_test'] = $amt;
            $total += $amt;
        }
        if ($sel['include_national']) {
            $amt = $sel['nationals'] * (float) $rates['rate_national_test'];
            $breakdown['national_test'] = $amt;
            $total += $amt;
        }

        return ['total' => round($total, 2), 'breakdown' => $breakdown];
    }

    /**
     * Deterministic fingerprint for a selection, so re-picking the
     * exact same combination reuses one `plans` row instead of
     * creating a new one every time.
     */
    private function custom_fingerprint($sel)
    {
        return hash('sha256', json_encode([
            $sel['weeks'], $sel['include_material'], $sel['include_videos'],
            $sel['include_mock'], $sel['include_starter'],
            $sel['include_mover'], $sel['include_flyer'], $sel['include_national'],
        ]));
    }

    private function get_or_create_custom_category()
    {
        $existing = $this->db->get_where('plan_categories', ['name' => 'Custom Pack'])->row_array();
        if ($existing) {
            return $existing['id'];
        }
        $this->db->insert('plan_categories', ['name' => 'Custom Pack']);
        return $this->db->insert_id();
    }

    private function build_custom_plan_name($sel)
    {
        $parts = [];
        if ($sel['include_material']) $parts[] = 'Learning Material';
        if ($sel['include_mock'])     $parts[] = 'Mock Test';
        if ($sel['include_starter'])  $parts[] = 'Starter Test';
        if ($sel['include_videos'])   $parts[] = 'Videos';
        if ($sel['include_mover'])    $parts[] = 'Mover Test';
        if ($sel['include_flyer'])    $parts[] = 'Flyer Test';
        if ($sel['include_national']) $parts[] = 'National Test';

        return 'Custom Pack — ' . $sel['weeks'] . ' Weeks (' . implode(', ', $parts) . ')';
    }

    /**
     * Finds (or creates, or re-prices) the `plans` row representing
     * this exact custom combination, then returns its plan_id.
     */
   private function find_or_create_custom_plan($sel, $price)
{
    $fingerprint = $this->custom_fingerprint($sel);
    $existing = $this->db->get_where('plans', ['custom_fingerprint' => $fingerprint])->row_array();

    if ($existing) {
        if ((float) $existing['final_amount'] !== (float) $price) {
            $this->db->update('plans', [
                'final_amount' => $price,
                'price'        => $price,
            ], ['id' => $existing['id']]);
        }
        return $existing['id'];
    }

    $weeks = $sel['weeks'];

    $ok = $this->db->insert('plans', [
        'category_id'         => $this->get_or_create_custom_category(),
        'plan_name'            => $this->build_custom_plan_name($sel),
        'start_week'           => 1,
        'end_week'             => $weeks,
        'units'                => $weeks,
        'total_study_material' => $sel['include_material'] ? $weeks : 0,
        'starter_tests'        => $sel['include_starter'] ? $weeks : 0,
        'mover_tests'          => $sel['include_mover'] ? $sel['movers'] : 0,
        'mock_tests'           => $sel['include_mock'] ? $weeks : 0,
        'flyer_tests'          => $sel['include_flyer'] ? $sel['flyers'] : 0,
        'national_tests'       => $sel['include_national'] ? $sel['nationals'] : 0,
        'total_amount'         => $price,
        'discount_percent'     => 0,
        'discount_amount'      => 0,
        'final_amount'         => $price,
        'price'                => $price,
        'status'               => 'Active',
        'duration_label'       => $weeks . ' Weeks',
        'duration_weeks'       => $weeks,
        'pack_type'            => $sel['include_material'] ? 'study_pack_plus_tests' : 'tests_only',
        'includes_videos'      => $sel['include_videos'] ? 1 : 0,
        'is_custom'            => 1,
        'custom_fingerprint'   => $fingerprint,
    ]);

    if (!$ok) {
        log_message('error', 'find_or_create_custom_plan insert failed: ' . $this->db->error()['message']);
        return false;
    }

    // Don't trust insert_id() — re-fetch by the unique fingerprint we
    // just wrote, so a stale/shared-connection insert_id() can't leak
    // a wrong plan_id into cart_items.
    $created = $this->db->get_where('plans', ['custom_fingerprint' => $fingerprint])->row_array();

    if (!$created) {
        log_message('error', 'find_or_create_custom_plan: insert reported success but row not found for fingerprint ' . $fingerprint);
        return false;
    }

    return $created['id'];
}
    /**
     * Validates + prices a Mix & Match selection, materializes it as
     * a `plans` row, and adds it to the student's cart. Returns the
     * same shape add_to_cart()'s caller expects to build a response
     * from: true/false. On failure, $error is populated by reference.
     */
    public function add_custom_pack_to_cart($cin, $input, &$error = null)
    {
        $sel = $this->normalize_custom_selection($input);
        if (!$sel) {
            $error = 'Please select at least one component and a valid number of weeks (1–52).';
            return false;
        }

        $priced = $this->calculate_custom_pack_price($sel);
        if (!$priced) {
            $error = 'Custom pack pricing isn\'t set up yet. Please contact your franchise.';
            return false;
        }

        $plan_id = $this->find_or_create_custom_plan($sel, $priced['total']);
        if (!$plan_id) {
            $error = 'Could not create the custom pack. Please try again.';
            return false;
        }

        return $this->add_to_cart($cin, $plan_id);
    }

    // -----------------------------------------------------------
    // Orders (Razorpay)
    // -----------------------------------------------------------

    /**
     * Creates the local `orders` row (status Created) plus its
     * order_items snapshot from the current cart. Does NOT talk to
     * Razorpay — that happens in the controller, which then calls
     * set_razorpay_order_id() once Razorpay confirms.
     *
     * Returns the new local order id, or false if the cart is empty.
     */
    // GST rate applied at checkout (18%). Kept as a single constant so
    // it's only ever defined in one place — used here when the order
    // total is calculated, and re-derived on the checkout view for
    // display (order amount - items subtotal).
    const GST_RATE = 0.18;


   public function create_order($cin)
{
    $items = $this->get_cart($cin);
    if (empty($items)) {
        return false;
    }

    $subtotal = 0;
    foreach ($items as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }

    $gst_amount = round($subtotal * self::GST_RATE, 2);
    $total      = round($subtotal + $gst_amount, 2);

    // Only write the plan-unit columns if the table actually has them,
    // so a missing ALTER can never break checkout.
    $has_unit_cols = $this->order_items_has_unit_cols();

    $this->db->trans_start();

    $this->db->insert('orders', [
        'cin'        => $cin,
        'amount'     => $total,
        'currency'   => 'INR',
        'status'     => 'Created',
        'created_at' => date('Y-m-d H:i:s'),
    ]);
    $order_id = $this->db->insert_id();

    foreach ($items as $item) {
        // week_class_key ("1-1") is split back into its two columns.
        $week_number  = null;
        $class_number = null;
        if (!empty($item['week_class_key'])) {
            $parts        = explode('-', $item['week_class_key']);
            $week_number  = $parts[0] ?? null;
            $class_number = $parts[1] ?? null;
        }

        $order_item = [
            'order_id'     => $order_id,
            'plan_id'      => $item['id'],
            'plan_name'    => $item['name'],
            'item_type'    => $item['item_type'],
            'program_id'   => $item['program_id'],
            'price'        => $item['price'],
            'quantity'     => $item['quantity'],
            'week_number'  => $week_number,
            'class_number' => $class_number,
        ];

        if ($has_unit_cols) {
            $order_item['unit_component_id'] = $item['unit_component_id'] ?? null;
            $order_item['unit_from']         = $item['unit_from']         ?? null;
            $order_item['unit_to']           = $item['unit_to']           ?? null;
            $order_item['unit_list']         = $item['unit_list']         ?? null;
        }

        $this->db->insert('order_items', $order_item);
    }

    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE) {
        return false;
    }

    return $order_id;
}

    public function set_razorpay_order_id($order_id, $razorpay_order_id)
    {
        return $this->db->update('orders', ['razorpay_order_id' => $razorpay_order_id], ['id' => $order_id]);
    }

    public function get_order($order_id)
    {
        return $this->db->get_where('orders', ['id' => $order_id])->row_array();
    }

    public function get_order_by_razorpay_id($razorpay_order_id)
    {
        return $this->db->get_where('orders', ['razorpay_order_id' => $razorpay_order_id])->row_array();
    }

    public function get_order_items($order_id)
    {
        return $this->db->get_where('order_items', ['order_id' => $order_id])->result_array();
    }

    /**
     * The lunar_programs id the order's line items belong to — used to
     * pull the Route split percentages via build_transfers_payload().
     * A student can only ever have items from one locked program (see
     * can_buy_from_program()), so the first order_item's program_id is
     * enough.
     */
    public function get_order_program_id($order_id)
    {
        $row = $this->db->select('program_id')
            ->where('order_id', $order_id)
            ->where('program_id IS NOT NULL', null, false)
            ->limit(1)
            ->get('order_items')
            ->row_array();

        return $row['program_id'] ?? null;
    }

    public function mark_order_paid($order_id, $razorpay_payment_id)
    {
        return $this->db->update('orders', [
            'status'              => 'Paid',
            'razorpay_payment_id' => $razorpay_payment_id,
            'paid_at'             => date('Y-m-d H:i:s'),
        ], ['id' => $order_id]);
    }

    public function mark_order_failed($order_id)
    {
        return $this->db->update('orders', ['status' => 'Failed'], ['id' => $order_id]);
    }
    
   public function ajax_get_schedule_range()
{
    $start_week = (int) $this->input->post('start_week');
    $end_week   = (int) $this->input->post('end_week');

    if ($start_week < 1 || $end_week < $start_week) {
        echo json_encode(['success' => false, 'message' => 'Invalid week range.']);
        return;
    }

    $milestones = $this->Student_registration_model->get_milestones_in_range($start_week, $end_week);

    echo json_encode([
        'success'    => true,
        'milestones' => $milestones,
    ]);
}
public function get_milestones_in_range($start_week, $end_week)
{
    $this->db->select('milestone AS label, milestone_week AS week, 1 AS count');
    $this->db->where('milestone_week >=', $start_week);
    $this->db->where('milestone_week <=', $end_week);
    $this->db->where('milestone !=', '');
    $this->db->order_by('milestone_week', 'ASC');
    return $this->db->get('study_schedule_lunar')->result_array();
}
    /**
     * Returns every phase row (Wk1-8, Wk9-16, ...) whose OWN range overlaps the
     * student's selected [start_week, end_week] — used purely for pricing, since
     * price lives on the phase row, not the milestone row. A phase counts as "in
     * range" if any part of it overlaps the selection (standard interval overlap:
     * phase.week_start <= selection.end AND phase.week_end >= selection.start).
     */
    public function get_phases_in_range($start_week, $end_week)
    {
        return $this->db
            ->where('week_start <=', $end_week)
            ->where('week_end >=', $start_week)
            ->order_by('week_start', 'ASC')
            ->get('study_schedule_lunar')
            ->result_array();
    }
  
 // application/models/Student_registration_model.php

public function get_countries()
{
    return $this->db->order_by('country_name', 'ASC')->get('countries')->result_array();
}

public function get_states_by_country($country_id)
{
    if (empty($country_id)) return [];
    return $this->db
        ->where('country_id', $country_id)
        ->order_by('state_subdivision_name', 'ASC')
        ->get('states')
        ->result_array();
}

// Districts (district_name) — keyed off state_subdivision_id
public function get_districts_by_state($state_id)
{
    if (empty($state_id)) return [];
    return $this->db
        ->where('state_id', $state_id)
        ->order_by('district_name', 'ASC')
        ->get('districts')
        ->result_array();
}

// City data actually lives in `areas` (city_name column) — NOT `districts`.
public function get_areas_by_state($state_id)
{
    if (empty($state_id)) return [];
    return $this->db
        ->select('id, area_code, city_name')
        ->where('state_id', $state_id)
        ->order_by('city_name', 'ASC')
        ->get('areas')
        ->result_array();
}
    

}