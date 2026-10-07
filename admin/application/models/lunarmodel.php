<?php

class LunarModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /* =========================================================
     * CATEGORIES  (legacy "Programs" tab — plan_categories)
     * =======================================================*/

    public function get_categories($active_only = false)
    {
        return $this->db->order_by('id', 'ASC')
                         ->get('plan_categories')
                         ->result();
    }

    public function get_category($id)
    {
        return $this->db->where('id', $id)
                         ->get('plan_categories')
                         ->row();
    }

    public function category_name_exists($name, $exclude_id = null)
    {
        $this->db->where('name', $name);
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        return $this->db->get('plan_categories')->num_rows() > 0;
    }

    public function create_category($data)
    {
        $this->db->insert('plan_categories', [
            'name'        => $data['name'],
            'description' => $data['description'] ?? null,
        ]);
        return $this->db->insert_id();
    }

    public function update_category($id, $data)
    {
        return $this->db->where('id', $id)
                         ->update('plan_categories', [
                             'name'        => $data['name'],
                             'description' => $data['description'] ?? null,
                         ]);
    }

    public function delete_category($id)
    {
        $plan_count = $this->db->where('category_id', (int) $id)->count_all_results('plans');
        if ($plan_count > 0) {
            return ['success' => false, 'error' => 'This program still has plans. Delete its plans first.'];
        }
        $deleted = $this->db->where('id', (int) $id)->delete('plan_categories');
        return ['success' => (bool) $deleted];
    }

    public function get_product_categories()
    {
        return $this->db->select('lunar_sub_categories.*, lunar_subjects.sub_name')
                         ->from('lunar_sub_categories')
                         ->join('lunar_subjects', 'lunar_subjects.sub_id = lunar_sub_categories.sub_id', 'left')
                         ->order_by('lunar_subjects.sub_name', 'ASC')
                         ->order_by('lunar_sub_categories.category_name', 'ASC')
                         ->get()
                         ->result();
    }

    public function product_category_name_exists($name, $sub_id, $exclude_id = null)
    {
        $this->db->where('category_name', $name)
                 ->where('sub_id', (int) $sub_id);
        if ($exclude_id) {
            $this->db->where('category_id !=', (int) $exclude_id);
        }
        return $this->db->get('lunar_sub_categories')->num_rows() > 0;
    }

    public function product_category_subject_exists($sub_id)
    {
        return $this->db->where('sub_id', (int) $sub_id)
                        ->get('lunar_subjects')
                        ->num_rows() > 0;
    }

    public function save_product_category($data, $id = null)
    {
        if ($id) {
            $this->db->where('category_id', (int) $id)->update('lunar_sub_categories', $data);
            return (int) $id;
        }

        $this->db->insert('lunar_sub_categories', $data);
        return (int) $this->db->insert_id();
    }

    public function delete_product_category($id)
    {
        $deleted = $this->db->where('category_id', (int) $id)->delete('lunar_sub_categories');
        return ['success' => (bool) $deleted];
    }

    public function get_products()
    {
        return $this->db->order_by('sub_name', 'ASC')
                         ->get('lunar_subjects')
                         ->result();
    }

    public function product_name_exists($name, $exclude_id = null)
    {
        $this->db->where('sub_name', $name);
        if ($exclude_id) {
            $this->db->where('sub_id !=', (int) $exclude_id);
        }
        return $this->db->get('lunar_subjects')->num_rows() > 0;
    }

    public function save_product($data, $id = null)
    {
        if ($id) {
            $this->db->where('sub_id', (int) $id)->update('lunar_subjects', $data);
            return (int) $id;
        }

        $this->db->insert('lunar_subjects', $data);
        return (int) $this->db->insert_id();
    }

    public function delete_product($id)
    {
        $deleted = $this->db->where('sub_id', (int) $id)->delete('lunar_subjects');
        return ['success' => (bool) $deleted];
    }

    /* =========================================================
     * SUBJECTS  (lunar_subjects master)
     * =======================================================*/

    public function get_subjects()
    {
        return $this->db->where('status', 'Active')
                         ->order_by('sub_name', 'ASC')
                         ->get('lunar_subjects')
                         ->result();
    }
    
    public function get_domains()
    {
        return $this->db->where('status', 'Active')
                         ->order_by('category_name', 'ASC')
                         ->get('lunar_sub_categories')
                         ->result();
    }
    
    public function get_domains1($subject)
    {
        $sub = $this->db->where('status', 'Active')
                         ->where('sub_name', $subject)
                         ->get('lunar_subjects')
                         ->row();
        
        return $this->db->where('status', 'Active')
                         ->where('sub_id',$sub->sub_id)
                         ->order_by('category_name', 'ASC')
                         ->get('lunar_sub_categories')
                         ->result();
    }

    public function get_program_subjects()
    {
        return $this->db->select('sub_id AS id, sub_name AS name, status')
                         ->order_by('sub_name', 'ASC')
                         ->get('lunar_subjects')
                         ->result();
    }

    public function get_program_domains()
    {
        return $this->db->select('category_id AS id, category_name AS name, status, sub_id')
                         ->order_by('category_name', 'ASC')
                         ->get('lunar_sub_categories')
                         ->result();
    }

    public function get_program_material_types()
    {
        $this->ensure_material_types_table();
        return $this->db->order_by('name', 'ASC')
                         ->get('lunar_types')
                         ->result();
    }

    private function ensure_material_types_table()
    {
        $this->db->query("CREATE TABLE IF NOT EXISTS `lunar_types` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(100) NOT NULL,
            `status` ENUM('Active','Inactive') NOT NULL DEFAULT 'Active',
            `created_at` DATETIME NOT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `uq_lunar_type_name` (`name`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1");
        $this->db->query("INSERT IGNORE INTO `lunar_types` (`name`, `status`, `created_at`)
            VALUES ('Study Material', 'Active', NOW()), ('Test', 'Active', NOW())");
    }

    public function material_type_name_exists($name, $exclude_id = null)
    {
        $this->ensure_material_types_table();
        $this->db->where('name', $name);
        if ($exclude_id) {
            $this->db->where('id !=', (int) $exclude_id);
        }
        return $this->db->get('lunar_types')->num_rows() > 0;
    }

    public function save_program_material_type($data, $id = null)
    {
        $this->ensure_material_types_table();
        $payload = [
            'name' => trim($data['name']),
            'status' => $data['status'] ?? 'Active',
        ];
        if ($id) {
            $this->db->where('id', (int) $id)->update('lunar_types', $payload);
            return (int) $id;
        }
        $payload['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('lunar_types', $payload);
        return (int) $this->db->insert_id();
    }

    public function delete_program_material_type($id)
    {
        $this->ensure_material_types_table();
        $this->ensure_program_columns();
        $type = $this->db->where('id', (int) $id)->get('lunar_types')->row();
        if (!$type) {
            return ['success' => false, 'error' => 'Material type was not found.'];
        }
        $used = $this->db->where('material_type', $type->name)->count_all_results('lunar_programs');
        $used += $this->db->where('component_type', $type->name)->count_all_results('lp_components');
        if ($used > 0) {
            return ['success' => false, 'error' => 'This type is in use. Deactivate it instead.'];
        }
        $deleted = $this->db->where('id', (int) $id)->delete('lunar_types');
        return ['success' => (bool) $deleted];
    }

    /* =========================================================
     * MATERIAL MAKERS
     * Reuses the existing `material_maker` vendor/payee table
     * (already managed elsewhere in the app — this is read-only
     * here, just for the Upload Learning Materials dropdowns).
     * =======================================================*/
    public function get_material_makers()
    {
        return $this->db->select('material_maker_id AS id, name, status')
                         ->order_by('name', 'ASC')
                         ->get('material_maker')
                         ->result();
    }

    public function get_component_types()
    {
        return $this->get_program_material_types();
    }

    public function component_type_name_exists($name, $exclude_id = null)
    {
        return $this->material_type_name_exists($name, $exclude_id);
    }

    public function save_component_type($data, $id = null)
    {
        return $this->save_program_material_type($data, $id);
    }

    public function delete_component_type($id)
    {
        return $this->delete_program_material_type($id);
    }

    /* =========================================================
     * PERIOD  (academic year lookups)
     * =======================================================*/

    public function get_academic_years()
    {
        return $this->db->distinct()
                         ->select('academic_year')
                         ->from('period')
                         ->where('academic_year !=', '')
                         ->order_by('academic_year', 'DESC')
                         ->limit('3')
                         ->get()
                         ->result();
    }

    /* =========================================================
     * TEST TYPES  (legacy component master)
     * =======================================================*/

    public function get_test_types()
    {
        return $this->db->order_by('id', 'ASC')
                         ->get('test_types')
                         ->result();
    }

    public function get_test_type($id)
    {
        return $this->db->where('id', $id)->get('test_types')->row();
    }

    public function create_test_type($data)
    {
        $this->db->insert('test_types', [
            'name'        => $data['name'],
            'max_allowed' => $data['max_allowed'],
            'description' => $data['description'],
        ]);
        return $this->db->insert_id();
    }

    public function update_test_type($id, $data)
    {
        return $this->db->where('id', (int) $id)->update('test_types', [
            'name'        => $data['name'],
            'max_allowed' => $data['max_allowed'],
            'description' => $data['description'],
        ]);
    }

    public function delete_test_type($id)
    {
        $id = (int) $id;
        if ($this->db->where('test_type_id', $id)->count_all_results('plan_test_allocations') > 0) {
            return ['success' => false, 'error' => 'This component is used by a plan. Remove it from plans first.'];
        }
        if ($this->db->where('component_id', $id)->count_all_results('lm_content') > 0) {
            return ['success' => false, 'error' => 'This component has uploaded content. Remove that content first.'];
        }
        return ['success' => (bool) $this->db->where('id', $id)->delete('test_types')];
    }

    /* =========================================================
     * LEGACY PLANS  (plans table — kept for existing functionality)
     * =======================================================*/

    public function get_plans($filters = [])
    {
        $this->db->select('p.*, pc.name AS category_name')
                  ->from('plans p')
                  ->join('plan_categories pc', 'pc.id = p.category_id', 'left');

        if (!empty($filters['category_id'])) {
            $this->db->where('p.category_id', $filters['category_id']);
        }
        if (!empty($filters['status'])) {
            $this->db->where('p.status', $filters['status']);
        }

        $plans = $this->db->order_by('p.category_id', 'ASC')
                           ->order_by('p.start_week', 'ASC')
                           ->get()
                           ->result();
        foreach ($plans as $plan) {
            $plan->allocations = $this->get_plan_allocations($plan->id);
        }
        return $plans;
    }

    public function get_plan($id)
    {
        return $this->db->select('p.*, pc.name AS category_name')
                         ->from('plans p')
                         ->join('plan_categories pc', 'pc.id = p.category_id')
                         ->where('p.id', $id)
                         ->get()
                         ->row();
    }

    public function get_plan_allocations($plan_id)
    {
        return $this->db->select('pta.id, pta.test_type_id, pta.quantity, tt.name AS test_type_name, tt.max_allowed')
                         ->from('plan_test_allocations pta')
                         ->join('test_types tt', 'tt.id = pta.test_type_id')
                         ->where('pta.plan_id', $plan_id)
                         ->order_by('tt.id', 'ASC')
                         ->get()
                         ->result();
    }

    public function create_plan($data, $allocations = [])
    {
        $payload = $this->_build_plan_payload($data);
        $this->db->trans_start();
        $ok = $this->db->insert('plans', $payload);
        if (!$ok) throw new RuntimeException('Plan insert failed: ' . $this->db->error()['message']);
        $id = $this->db->insert_id();
        $this->save_allocations($id, $allocations);
        if (!$this->db->trans_status()) throw new RuntimeException('Plan allocation insert failed: ' . $this->db->error()['message']);
        $this->db->trans_complete();
        return $id;
    }

    public function update_plan($id, $data, $allocations = [])
    {
        $payload = $this->_build_plan_payload($data);
        $this->db->trans_start();
        $ok = $this->db->where('id', $id)->update('plans', $payload);
        if (!$ok) throw new RuntimeException('Plan update failed: ' . $this->db->error()['message']);
        if ($ok) {
            $this->save_allocations($id, $allocations, true);
        }
        if (!$this->db->trans_status()) throw new RuntimeException('Plan allocation update failed: ' . $this->db->error()['message']);
        $this->db->trans_complete();
        return $ok;
    }

    public function calculate_component_total($allocations)
    {
        $rates = $this->get_mix_match_rates();
        $types = $this->get_test_types();
        $total = 0;
        foreach ((array) $allocations as $type_id => $quantity) {
            $type = null;
            foreach ($types as $candidate) {
                if ((int) $candidate->id === (int) $type_id) { $type = $candidate; break; }
            }
            if (!$type || !$rates) continue;
            $name  = strtolower((string) $type->name);
            $field = null;
            if (strpos($name, 'study') !== false || strpos($name, 'material') !== false) $field = 'rate_learning_material_per_lm';
            elseif (strpos($name, 'video')    !== false) $field = 'rate_video_per_lm';
            elseif (strpos($name, 'mock')     !== false) $field = 'rate_mock_test_per_lm';
            elseif (strpos($name, 'starter')  !== false) $field = 'rate_starter_test_per_lm';
            elseif (strpos($name, 'national') !== false) $field = 'rate_national_test';
            elseif (strpos($name, 'mover')    !== false) $field = 'rate_mover_test';
            elseif (strpos($name, 'flyer')    !== false) $field = 'rate_flyer_test';
            elseif (strpos($name, 'test')     !== false) $field = 'rate_daily_test_per_lm';
            if ($field) $total += (float) $rates->$field * max(0, (int) $quantity);
        }
        return round($total, 2);
    }

    private function _build_plan_payload($data)
    {
        $price_per_unit   = ($data['price_per_unit'] ?? '') !== '' ? (float) $data['price_per_unit'] : 500;
        $units            = (int) ($data['units'] ?? 0);
        $total_amount     = ($data['total_amount'] ?? '') !== '' ? (float) $data['total_amount'] : round($price_per_unit * $units, 2);
        $discount_percent = (float) ($data['discount_percent'] ?? 0);
        $discount_amount  = ($data['discount_amount'] ?? '') !== '' ? (float) $data['discount_amount'] : round($total_amount * ($discount_percent / 100), 2);
        $final_amount     = ($data['final_amount'] ?? '') !== '' ? (float) $data['final_amount'] : round($total_amount - $discount_amount, 2);

        return [
            'category_id'          => (int) $data['category_id'],
            'name'                 => $data['plan_name'],
            'plan_name'            => $data['plan_name'],
            'start_week'           => (int) $data['start_week'],
            'end_week'             => (int) $data['end_week'],
            'units'                => $units,
            'total_study_material' => (int) ($data['total_study_material'] ?? 0),
            'starter_tests'        => (int) ($data['starter_tests'] ?? 0),
            'mover_tests'          => (int) ($data['mover_tests'] ?? 0),
            'mock_tests'           => (int) ($data['mock_tests'] ?? 0),
            'price_per_unit'       => $price_per_unit,
            'total_amount'         => $total_amount,
            'discount_percent'     => $discount_percent,
            'discount_amount'      => $discount_amount,
            'final_amount'         => $final_amount,
            'price'                => $final_amount,
            'start_date'           => $data['start_date'] ?: null,
            'end_date'             => $data['end_date'] ?: null,
            'status'               => $data['status'] ?? 'Active',
        ];
    }

    protected function save_allocations($plan_id, $allocations, $wipe_first = false)
    {
        if ($wipe_first) {
            $this->db->where('plan_id', $plan_id)->delete('plan_test_allocations');
        }
        $rows = [];
        foreach ($allocations as $test_type_id => $qty) {
            $qty = (int) $qty;
            if ($qty <= 0) continue;
            $rows[] = ['plan_id' => $plan_id, 'test_type_id' => (int) $test_type_id, 'quantity' => $qty];
        }
        if (!empty($rows)) {
            $this->db->insert_batch('plan_test_allocations', $rows);
        }
    }

    public function toggle_plan_status($id)
    {
        $plan = $this->db->where('id', $id)->get('plans')->row();
        if (!$plan) return false;
        $new_status = $plan->status === 'Active' ? 'Inactive' : 'Active';
        return $this->db->where('id', $id)->update('plans', ['status' => $new_status]);
    }

    public function delete_plan($id)
    {
        $content_count = $this->db->where('plan_id', (int) $id)->count_all_results('lm_content');
        if ($content_count > 0) {
            return ['success' => false, 'error' => 'This plan has uploaded content. Remove the content before deleting the plan.'];
        }
        $this->db->trans_start();
        $this->db->where('plan_id', (int) $id)->delete('plan_test_allocations');
        $this->db->where('id', (int) $id)->delete('plans');
        $this->db->trans_complete();
        return ['success' => $this->db->trans_status()];
    }

    public function get_price_history($plan_id)
    {
        return $this->db->where('plan_id', $plan_id)
                         ->order_by('changed_at', 'DESC')
                         ->get('plan_price_history')
                         ->result();
    }

    /* =========================================================
     * MIX & MATCH RATES
     * =======================================================*/

    public function get_mix_match_rates()
    {
        return $this->db->order_by('id', 'DESC')->limit(1)->get('mix_match_rates')->row();
    }

    public function save_mix_match_rates($id, $data)
    {
        $payload = [
            'rate_learning_material_per_lm' => (float) ($data['rate_learning_material_per_lm'] ?? 0),
            'rate_daily_test_per_lm'        => (float) ($data['rate_daily_test_per_lm'] ?? 0),
            'rate_mock_test_per_lm'         => (float) ($data['rate_mock_test_per_lm'] ?? 0),
            'rate_starter_test_per_lm'      => (float) ($data['rate_starter_test_per_lm'] ?? 0),
            'rate_video_per_lm'             => (float) ($data['rate_video_per_lm'] ?? 0),
            'rate_mover_test'               => (float) ($data['rate_mover_test'] ?? 0),
            'rate_flyer_test'               => (float) ($data['rate_flyer_test'] ?? 0),
            'rate_national_test'            => (float) ($data['rate_national_test'] ?? 0),
            'updated_at'                    => date('Y-m-d H:i:s'),
        ];
        if ($id) {
            return $this->db->where('id', $id)->update('mix_match_rates', $payload) ? $id : false;
        }
        $this->db->insert('mix_match_rates', $payload);
        return $this->db->insert_id();
    }

    /* =========================================================
     * LEGACY CONTENT LIBRARY  (lm_content)
     * =======================================================*/

    public function get_catalogue()
    {
        $plans = $this->get_plans(['status' => 'Active']);
        foreach ($plans as $plan) {
            $plan->allocations = $this->get_plan_allocations($plan->id);
        }
        return $plans;
    }

    public function get_content_list($filters = [])
    {
        $has_program_col = $this->db->field_exists('program_id', 'lm_content');

        $select = 'lc.*, p.plan_name, p.start_week, p.end_week, p.category_id, pc.name AS category_name, lpc.component_name AS component_name';
        if ($has_program_col) {
            $select .= ', lpr.program_name AS program_name';
        }

        $this->db->select($select)
                  ->from('lm_content lc')
                  ->join('plans p', 'p.id = lc.plan_id', 'left')
                  ->join('plan_categories pc', 'pc.id = p.category_id', 'left')
                  ->join('lp_components lpc', 'lpc.id = lc.component_id', 'left');
        if ($has_program_col) {
            $this->db->join('lunar_programs lpr', 'lpr.id = lc.program_id', 'left');
        }

        if (!empty($filters['program_id'])) {
            $pid = (int) $filters['program_id'];
            // Files are stored under uploads/lm_content/<program_id>/..., so the
            // folder is used as a fallback for rows without a program_id (or
            // when the column does not exist) so a program never shows another
            // program's material.
            $path_match = "lc.file_path LIKE 'uploads/lm_content/" . $pid . "/%'";
            if ($has_program_col) {
                $this->db->where("(lc.program_id = {$pid} OR ((lc.program_id IS NULL OR lc.program_id = 0) AND {$path_match}))", null, false);
            } else {
                $this->db->where($path_match, null, false);
            }
        }
        if (!empty($filters['plan_id']))      $this->db->where('lc.plan_id', (int) $filters['plan_id']);
        if (!empty($filters['component_id'])) $this->db->where('lc.component_id', (int) $filters['component_id']);
        if (!empty($filters['week_number']))  $this->db->where('lc.week_number', (int) $filters['week_number']);
        if (!empty($filters['class_number'])) $this->db->where('lc.class_number', (int) $filters['class_number']);
        if (!empty($filters['content_type'])) $this->db->where('lc.content_type', $filters['content_type']);
        if (!empty($filters['status']))       $this->db->where('lc.status', $filters['status']);

        if ($has_program_col) {
            $this->db->order_by('lc.program_id', 'ASC');
        }
        return $this->db->order_by('lc.plan_id', 'ASC')
                         ->order_by('lc.week_number', 'ASC')
                         ->order_by('lc.content_type', 'ASC')
                         ->get()
                         ->result_array();
    }

    /* Adds material_maker_id to lm_content the first time it's needed,
       same pattern as ensure_program_columns() for lunar_programs. */
    private function ensure_content_columns()
    {
        if (!$this->db->field_exists('material_maker_id', 'lm_content')) {
            $this->db->query("ALTER TABLE `lm_content` ADD COLUMN `material_maker_id` INT(11) NULL DEFAULT NULL AFTER `component_id`");
        }
    }

    public function save_content($meta)
{
    $this->ensure_content_columns();

    $meta['status'] = isset($meta['status']) && $meta['status'] !== ''
        ? $meta['status']
        : 'Active';

    $fields = $this->db->list_fields('lm_content');
    $payload = [];

    foreach ($meta as $key => $value) {
        if (!in_array($key, $fields, true)) {
            continue;
        }

        if ($value === null) {
            continue;
        }

        if ($value === '' && strpos($key, 'id') !== false) {
            continue;
        }

        $payload[$key] = $value;
    }

    if (isset($payload['component_id']) && !$payload['component_id']) {
        unset($payload['component_id']);
    }

    if (isset($payload['program_id']) && !$payload['program_id']) {
        unset($payload['program_id']);
    }

    if (isset($payload['material_maker_id']) && !$payload['material_maker_id']) {
        unset($payload['material_maker_id']);
    }

    $this->db->insert('lm_content', $payload);

    if (!$this->db->insert_id()) {
        log_message(
            'error',
            'save_content DB error: ' .
            json_encode($this->db->error()) .
            ' payload=' .
            json_encode($payload)
        );

        return false;
    }

    return $this->db->insert_id();
}


/**
 * Check whether this exact Program + Class + Unit already contains
 * one of the ZIP bundle content types.
 *
 * lm_content is connected to the program through plans.category_id.
 */
public function bundle_exists($program_id, $class_number, $week_number, $end_unit)
{
    $program_id   = (int) $program_id;
    $class_number = (int) $class_number;
    $week_number  = (int) $week_number;
    $end_unit     = (int) $end_unit;

    if (!$program_id || !$week_number) {
        return false;
    }

    /*
     * New Lunar program flow:
     *
     * lm_content
     *      ↓ plan_id
     * plans
     *      ↓ category_id
     * program
     *
     * Also support program_id directly if that column exists.
     */
    if ($this->db->field_exists('program_id', 'lm_content')) {

        $this->db
            ->select('id')
            ->from('lm_content')
            ->where('program_id', $program_id)
            ->where('class_number', $class_number)
            ->where('week_number', $week_number)
            ->where('status', 'Active')
            ->where_in('content_type', [
                'study_pack',
                'mock_test',
                'starter_test'
            ]);

        if ($this->db->field_exists('end_unit', 'lm_content')) {
            $this->db->where('end_unit', $end_unit);
        }

        return $this->db
            ->limit(1)
            ->get()
            ->num_rows() > 0;
    }

    /*
     * Legacy structure.
     */
    $this->db
        ->select('lc.id')
        ->from('lm_content lc')
        ->join(
            'plans p',
            'p.id = lc.plan_id',
            'inner'
        )
        ->where('p.category_id', $program_id)
        ->where('lc.class_number', $class_number)
        ->where('lc.week_number', $week_number)
        ->where('lc.status', 'Active')
        ->where_in('lc.content_type', [
            'study_pack',
            'mock_test',
            'starter_test'
        ]);

    if ($this->db->field_exists('end_unit', 'lm_content')) {
        $this->db->where('lc.end_unit', $end_unit);
    }

    return $this->db
        ->limit(1)
        ->get()
        ->num_rows() > 0;
}

        public function component_unit_exists($program_id, $class_number, $week_number, $component_id)
    {
        $component_id = (int) $component_id;
        if (!$component_id || !$this->db->field_exists('component_id', 'lm_content')) {
            return false;
        }

        $this->db->select('id')
            ->from('lm_content')
            ->where('class_number', (int) $class_number)
            ->where('week_number', (int) $week_number)
            ->where('component_id', $component_id)
            ->where('status', 'Active');

        // Only filter by program when this server's table actually has the column
        if ($this->db->field_exists('program_id', 'lm_content')) {
            $this->db->where('program_id', (int) $program_id);
        }

        return $this->db->limit(1)->get()->num_rows() > 0;
    }

    public function toggle_content_status($id)
    {
        $row = $this->db->where('id', $id)->get('lm_content')->row();
        if (!$row) return false;
        $new_status = $row->status === 'Active' ? 'Inactive' : 'Active';
        return $this->db->where('id', $id)->update('lm_content', ['status' => $new_status]);
    }

    /**
     * "Already uploaded?" check for the ZIP bundle flow.
     * A bundle for a given Program + Class + Unit is considered already
     * uploaded if any Active lm_content row already exists for that exact
     * combination with one of the bundle-produced content types
     * (study_pack, mock_test, starter_test). Used to reject re-uploads of
     * the same Unit-N.zip instead of silently duplicating content.
     */
   

    public function delete_content($id)
    {
        $row = $this->db->get_where('lm_content', ['id' => $id])->row_array();
        if ($row && !empty($row['file_path']) && file_exists(FCPATH . $row['file_path'])) {
            @unlink(FCPATH . $row['file_path']);
        }
        return $this->db->delete('lm_content', ['id' => $id]);
    }

    /**
     * Delete several lm_content rows (and their files on disk) in one go.
     * Rows are removed from the DB first; a file is only unlinked once the
     * DB delete succeeded. Returns the number of rows deleted, or false.
     */
    public function delete_content_multiple(array $ids)
    {
        $ids = array_values(array_unique(array_filter(array_map('intval', $ids))));
        if (empty($ids)) {
            return 0;
        }

        $rows = $this->db->where_in('id', $ids)->get('lm_content')->result_array();
        if (empty($rows)) {
            return 0;
        }

        // Older CodeIgniter builds have no $this->db->error(); delete() itself
        // returns FALSE on failure (controller turns db_debug off).
        $ok = $this->db->where_in('id', $ids)->delete('lm_content');
        if (!$ok) {
            return false;
        }
        $deleted = (int) $this->db->affected_rows();

        foreach ($rows as $row) {
            $path = isset($row['file_path']) ? (string) $row['file_path'] : '';
            if ($path !== '' && strpos($path, '..') === false && file_exists(FCPATH . $path)) {
                @unlink(FCPATH . $path);
            }
        }

        return $deleted;
    }

    /* =========================================================
     * LUNAR PROGRAMS  (new Program Management redesign)
     * Table: lunar_programs
     *   id INT AI PK, program_name VARCHAR(255), subject VARCHAR(100),
     *   domain VARCHAR(100), grade VARCHAR(50), season INT,
     *   status ENUM('Active','Inactive') DEFAULT 'Active',
     *   created_at DATETIME
     * =======================================================*/

    public function get_programs($active_only = false)
    {
        $this->ensure_program_columns();
        if ($active_only) {
            $this->db->where('status', 'Active');
        }
        return $this->db->order_by('id', 'ASC')
                         ->get('lunar_programs')
                         ->result();
    }

    public function get_program($id)
    {
        $this->ensure_program_columns();
        return $this->db->where('id', (int) $id)
                         ->get('lunar_programs')
                         ->row();
    }

    private function ensure_program_columns()
    {
        $columns = $this->db->query("SHOW COLUMNS FROM `lunar_programs`")->result_array();
        $existing = array_column($columns, 'Field');
        $additions = [
            'material_type' => "ALTER TABLE `lunar_programs` ADD COLUMN `material_type` VARCHAR(100) NOT NULL DEFAULT '' AFTER `domain`",
            'grade_from' => "ALTER TABLE `lunar_programs` ADD COLUMN `grade_from` VARCHAR(50) NOT NULL DEFAULT '' AFTER `material_type`",
            'grade_to' => "ALTER TABLE `lunar_programs` ADD COLUMN `grade_to` VARCHAR(50) NOT NULL DEFAULT '' AFTER `grade_from`",
            'academic_year' => "ALTER TABLE `lunar_programs` ADD COLUMN `academic_year` VARCHAR(50) NOT NULL DEFAULT '' AFTER `season`",
            'syllabus_path' => "ALTER TABLE `lunar_programs` ADD COLUMN `syllabus_path` VARCHAR(500) NOT NULL DEFAULT '' AFTER `academic_year`",
            'test_schedule_path' => "ALTER TABLE `lunar_programs` ADD COLUMN `test_schedule_path` VARCHAR(500) NOT NULL DEFAULT '' AFTER `syllabus_path`",
            'what_you_get_path' => "ALTER TABLE `lunar_programs` ADD COLUMN `what_you_get_path` VARCHAR(500) NOT NULL DEFAULT '' AFTER `test_schedule_path`",
        ];
        foreach ($additions as $field => $sql) {
            if (!in_array($field, $existing, true)) {
                $this->db->query($sql);
            }
        }
    }

    public function normalize_grade_value($value)
    {
        if ($value === null || $value === '') {
            return '';
        }
        $value = trim((string) $value);
        if (strcasecmp($value, 'Preschool') === 0) {
            return 'Preschool';
        }
        if (strcasecmp($value, 'Adults') === 0) {
            return 'Adults';
        }
        if (preg_match('/^grade\s*([0-9]{1,2})$/i', $value, $m)) {
            return 'Grade ' . (int) $m[1];
        }
        if (preg_match('/^([0-9]{1,2})$/', $value, $m)) {
            return 'Grade ' . (int) $m[1];
        }
        return $value;
    }

    public function build_grade_label($grade_from, $grade_to)
    {
        $from = $this->normalize_grade_value($grade_from);
        $to   = $this->normalize_grade_value($grade_to);
        if ($from === '' && $to === '') {
            return '';
        }
        if ($from === '') {
            return $to;
        }
        if ($to === '') {
            return $from;
        }
        if (strcasecmp($from, $to) === 0) {
            return $from;
        }
        return $from . ' - ' . $to;
    }


public function getAssociates() {
    return $this->db->select('associate_id, first_name, last_name')
                     ->order_by('first_name', 'ASC')
                     ->get('associates')
                     ->result();
}
  public function save_program($data, $id = null)
{
    $this->ensure_program_columns();
    $grade_from = $this->normalize_grade_value($data['grade_from'] ?? $data['from_grade'] ?? $data['grade'] ?? '');
    $grade_to   = $this->normalize_grade_value($data['grade_to'] ?? $data['to_grade'] ?? $data['grade'] ?? '');
    $grade_label = $this->build_grade_label($grade_from, $grade_to);

    $payload = [
        'program_name'  => trim($data['program_name']),
        'subject'       => trim($data['subject'] ?? ''),
        'domain'        => trim($data['domain'] ?? ''),
        'description' => trim($data['description'] ?? ''),
        'material_type' => trim($data['material_type'] ?? ''),
        'grade_from'    => $grade_from,
        'grade_to'      => $grade_to,
        'grade'         => $grade_label,
        'season'        => (int) ($data['season'] ?? 1),
        'academic_year' => trim($data['academic_year'] ?? ''),
        'status'        => $data['status'] ?? 'Active',
    ];
    if (array_key_exists('syllabus_path', $data)) {
        $payload['syllabus_path'] = trim((string) $data['syllabus_path']);
    }
    if (array_key_exists('test_schedule_path', $data)) {
        $payload['test_schedule_path'] = trim((string) $data['test_schedule_path']);
    }
    if (array_key_exists('what_you_get_path', $data)) {
        $payload['what_you_get_path'] = trim((string) $data['what_you_get_path']);
    }
    $payload['management_percentage'] = ($data['management_percentage'] ?? '') !== '' ? (int) $data['management_percentage'] : null;
    $payload['aviansys_percentage']   = ($data['aviansys_percentage'] ?? '') !== '' ? (int) $data['aviansys_percentage'] : null;
    $payload['crm_per']               = ($data['crm_per'] ?? '') !== '' ? (int) $data['crm_per'] : null;
    $payload['maker_percentage']      = ($data['maker_percentage'] ?? '') !== '' ? (int) $data['maker_percentage'] : null;
    $payload['associate_id']          = ($data['associate_id'] ?? '') !== '' ? (int) $data['associate_id'] : null;
    $payload['associate_percentage']  = ($data['associate_percentage'] ?? '') !== '' ? (int) $data['associate_percentage'] : null;
    $payload['it_percentage'] = ($data['it_percentage'] ?? '') !== '' ? (int) $data['it_percentage'] : null;
    if ($id) {
        $this->db->where('id', (int) $id)->update('lunar_programs', $payload);
        return (int) $id;
    }
    $payload['created_at'] = date('Y-m-d H:i:s');
    $this->db->insert('lunar_programs', $payload);
    $new_program_id = $this->db->insert_id();

    // Mirror the same program data into lunar_schedule_cin at
    // creation time. Only fields that genuinely exist in $payload are
    // copied across; lunar_schedule_cin's other NOT NULL columns
    // (period_id, dates, series, etc.) have no equivalent on a
    // program yet, so they get safe placeholder values rather than
    // being left to fail the insert. Update these once the real
    // source for them (a schedule/period form) is wired up.
    $this->save_program_to_schedule_cin($new_program_id, $payload);

    return $new_program_id;
}

    /**
     * Creates the matching lunar_schedule_cin row for a newly created
     * program. Only called on create (not update) — see save_program().
     * Columns copied 1:1 from $payload where the names/meaning match;
     * everything else lunar_schedule_cin requires (NOT NULL, no
     * program equivalent yet) gets a safe placeholder so the insert
     * doesn't fail.
     */
    private function save_program_to_schedule_cin($program_id, $payload)
    {
        $today = date('Y-m-d');

        $cin = [
            // --- matched from the program ---
            'title'                 => $payload['program_name'] ?? '',
            'description'           => $payload['description'] ?? '',
            'subject'               => mb_substr((string) ($payload['subject'] ?? ''), 0, 20),
            'season'                => (string) ($payload['season'] ?? ''),
            'crm_per'               => $payload['crm_per'] !== null ? (string) $payload['crm_per'] : null,
            'associate_id'          => $payload['associate_id'] ?? null,
            'aviansys_percentage'   => $payload['aviansys_percentage'] !== null ? (string) $payload['aviansys_percentage'] : null,
            'management_percentage' => $payload['management_percentage'] !== null ? (string) $payload['management_percentage'] : null,
            'franchise_percentage'  => $payload['franchise_percentage'] ?? null,
            'syllabus'              => mb_substr((string) ($payload['syllabus_path'] ?? ''), 0, 200),
            'period_id'             => '16',
            'registration_code'      => $this->next_schedule_registration_code(),
            'product_name'           => 'Lunar Skill Test',
            'period_id'              => 0,
            'associate_cut'          => '0',
            'start_date'             => $today,
            'end_date'               => $today,
            'series'                 => '',
            'level_id'               => '',
            'study_material_a_price' => '0',
            'orientation'            => '0',
            'mock'                   => '0',
        ];

        $this->db->insert('lunar_schedule_cin', $cin);
        $id = $this->db->insert_id();
        $class_list = $this->get_class_range($payload['grade_from'], $payload['grade_to']);
        //print_r($payload);
        foreach ($class_list as $class_name) {
            $class_array = array(
                'sch_id' => $id,
                'class'  => $class_name,
            );
            $this->db->insert('lunar_schedule_class', $class_array);
        }
        return $id;
    }
    
    private function next_schedule_registration_code($prefix = 'L')
    {
        $year_prefix = $prefix . date('y'); // e.g. 'L26' for 2026
        $counter_pad = 4;
        $prefix_len  = strlen($year_prefix) + 1; // 1-indexed: chars after 'L26'

        $sql = "SELECT MAX(CAST(SUBSTRING(registration_code, ?) AS UNSIGNED)) AS max_num
                FROM lunar_schedule_cin
                WHERE registration_code REGEXP ?";
        $result = $this->db->query($sql, [$prefix_len, '^' . $year_prefix . '[0-9]{' . $counter_pad . '}$'])->row();

        $next_num = ($result && $result->max_num !== null) ? ((int) $result->max_num + 1) : 1;

        return $year_prefix . str_pad($next_num, $counter_pad, '0', STR_PAD_LEFT);
    }
    function get_class_range($grade_from, $grade_to)
    {
        // Canonical ordered list of all possible grades
        $all_grades = array(
            'Nursery', 'LKG', 'UKG',
            'Class-1', 'Class-2', 'Class-3', 'Class-4', 'Class-5',
            'Class-6', 'Class-7', 'Class-8', 'Class-9', 'Class-10',
            'Class-11', 'Class-12'
        );
    
        // Normalize input (trim spaces, fix casing/hyphen issues if needed)
        $grade_from = trim($grade_from);
        $grade_to   = trim($grade_to);
    
        $from_index = array_search($grade_from, $all_grades);
        $to_index   = array_search($grade_to, $all_grades);
    
        if ($from_index === false || $to_index === false) {
            // One or both values didn't match the known list
            return array();
        }
    
        if ($from_index > $to_index) {
            // Swap if given in reverse order
            $temp = $from_index;
            $from_index = $to_index;
            $to_index = $temp;
        }
    
        return array_slice($all_grades, $from_index, ($to_index - $from_index + 1));
    }

    public function delete_program($id)
    {
        $id         = (int) $id;
        $comp_count = $this->db->where('program_id', $id)->count_all_results('lp_components');
        if ($comp_count > 0) {
            return ['success' => false, 'error' => 'This program has components. Delete components first.'];
        }
        $deleted = $this->db->where('id', $id)->delete('lunar_programs');
        return ['success' => (bool) $deleted];
    }

    /* =========================================================
     * LUNAR PROGRAM COMPONENTS  (per-program component master)
     * Table: lp_components  (renamed to avoid clash with existing lunar_components)
     *   id INT AI PK, program_id INT, component_name VARCHAR(255),
     *   component_type VARCHAR(100), unit_price DECIMAL(10,2),
     *   status ENUM('Active','Inactive') DEFAULT 'Active',
     *   created_at DATETIME
     * =======================================================*/

    public function get_components($program_id)
    {
        $components = $this->db->where('program_id', (int) $program_id)
                         ->order_by('id', 'ASC')
                         ->get('lp_components')
                         ->result();
        foreach ($components as $c) {
            $c->venues = ($c->component_mode === 'Offline') ? $this->get_component_venues($c->id) : [];
        }
        return $components;
    }

    public function get_component($id)
    {
        $component = $this->db->where('id', (int) $id)->get('lp_components')->row();
        if ($component) {
            $component->venues = ($component->component_mode === 'Offline') ? $this->get_component_venues($component->id) : [];
        }
        return $component;
    }

    private function ensure_component_document_columns()
    {
        $columns = $this->db->query("SHOW COLUMNS FROM `lp_components`")->result_array();
        $existing = array_column($columns, 'Field');

        $additions = [
            'domain'         => "ALTER TABLE `lp_components` ADD COLUMN `domain` VARCHAR(100) NOT NULL DEFAULT '' AFTER `component_type`",
            'component_mode' => "ALTER TABLE `lp_components` ADD COLUMN `component_mode` VARCHAR(50) NOT NULL DEFAULT '' AFTER `component_type`",
            'venue'          => "ALTER TABLE `lp_components` ADD COLUMN `venue` VARCHAR(255) NOT NULL DEFAULT '' AFTER `component_mode`",
            'circular_path'  => "ALTER TABLE `lp_components` ADD COLUMN `circular_path` VARCHAR(500) NOT NULL DEFAULT '' AFTER `venue`",
            'admit_path'     => "ALTER TABLE `lp_components` ADD COLUMN `admit_path` VARCHAR(500) NOT NULL DEFAULT '' AFTER `circular_path`",
        ];

        foreach ($additions as $field => $sql) {
            if (!in_array($field, $existing, true)) {
                $this->db->query($sql);
            }
        }
    }

    /* =========================================================
     * LUNAR OFFLINE COMPONENT VENUES  (multi-venue support)
     * Table: lp_component_venues — one row per venue for an
     * Offline-mode component. country/state are stored as both
     * id + name (denormalized) so listings don't need extra joins
     * back to the countries/states master tables.
     * =======================================================*/

    private function ensure_component_venues_table()
    {
        $exists = $this->db->query("SHOW TABLES LIKE 'lp_component_venues'")->num_rows() > 0;
        if (!$exists) {
            $this->db->query("
                CREATE TABLE `lp_component_venues` (
                    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                    `component_id` INT UNSIGNED NOT NULL,
                    `country_id` INT NOT NULL DEFAULT 0,
                    `country_name` VARCHAR(150) NOT NULL DEFAULT '',
                    `state_id` INT NOT NULL DEFAULT 0,
                    `state_name` VARCHAR(150) NOT NULL DEFAULT '',
                    `city` VARCHAR(150) NOT NULL DEFAULT '',
                    `venue_date` DATE NULL DEFAULT NULL,
                    `venue_name` VARCHAR(255) NOT NULL DEFAULT '',
                    `status` ENUM('Active','Inactive') NOT NULL DEFAULT 'Active',
                    `created_at` DATETIME NULL DEFAULT NULL,
                    PRIMARY KEY (`id`),
                    KEY `component_id` (`component_id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
            ");
        }
    }

    // Reuses the existing `countries` / `states` master tables that
    // add_associate()/edit_profile() etc. already query directly.
    public function get_countries()
    {
        return $this->db->order_by('country_name', 'ASC')->get('countries')->result();
    }

    public function get_states_by_country($country_id)
    {
        return $this->db->where('country_id', (int) $country_id)
                         ->order_by('state_subdivision_name', 'ASC')
                         ->get('states')
                         ->result();
    }

    public function get_component_venues($component_id)
    {
        $this->ensure_component_venues_table();
        return $this->db->where('component_id', (int) $component_id)
                         ->where('status', 'Active')
                         ->order_by('venue_date', 'ASC')
                         ->get('lp_component_venues')
                         ->result();
    }
    public function get_cities_by_state($state_id)
    {
        return $this->db->where('state_id', (int) $state_id)
                         ->order_by('district_name', 'ASC')
                         ->get('districts')
                         ->result();
    }

    /**
     * Replaces all venue rows for a component in one shot
     * (wipe + reinsert) — same approach save_allocations() uses
     * for plan-component links.
     */
   public function save_component_venues($component_id, array $venues)
    {
        $this->ensure_component_venues_table();
        $component_id = (int) $component_id;
        $this->db->where('component_id', $component_id)->delete('lp_component_venues');

        $now = date('Y-m-d H:i:s');
        foreach ($venues as $v) {
            $venue_name = trim((string) ($v['venue_name'] ?? ''));
            $venue_date = trim((string) ($v['venue_date'] ?? ''));
            if ($venue_name === '' && $venue_date === '') {
                continue; // skip blank rows the UI may submit
            }
            $this->db->insert('lp_component_venues', [
                'component_id' => $component_id,
                'country_id'   => (int) ($v['country_id'] ?? 0),
                'country_name' => trim((string) ($v['country_name'] ?? '')),
                'state_id'     => (int) ($v['state_id'] ?? 0),
                'state_name'   => trim((string) ($v['state_name'] ?? '')),
                'city_id'      => (int) ($v['city_id'] ?? 0),
                'city'         => trim((string) ($v['city'] ?? '')),
                'venue_date'   => $venue_date ?: null,
                'venue_name'   => $venue_name,
                'status'       => 'Active',
                'created_at'   => $now,
            ]);
        }
        return true;
    }

    public function delete_component_venue($id)
    {
        $this->ensure_component_venues_table();
        return (bool) $this->db->where('id', (int) $id)->delete('lp_component_venues');
    }

 /** Program ke andar unique code: study_pack, study_pack_2, ... */
private function make_component_code($program_id, $name, $exclude_id = null)
{
    $base = strtolower(trim((string) $name));
    $base = trim(preg_replace('/[^a-z0-9]+/', '_', $base), '_');
    $base = substr($base !== '' ? $base : 'component', 0, 45);

    $code = $base;
    $i    = 2;
    while (true) {
        $this->db->where('program_id', (int) $program_id)
                 ->where('component_code', $code);
        if ($exclude_id) {
            $this->db->where('id !=', (int) $exclude_id);
        }
        if ($this->db->count_all_results('lp_components') === 0) {
            break;
        }
        $code = $base . '_' . $i++;
    }
    return $code;
}

public function save_component($data, $id = null)
{
    $this->ensure_component_document_columns();

    $name = trim($data['component_name']);
    $code = strtolower(trim((string) ($data['component_code'] ?? '')));

    // Code blank ho to: edit me purana code rakho, warna name se generate karo
    if ($code === '') {
        $existing_code = '';
        if ($id) {
            $row = $this->db->get_where('lp_components', ['id' => (int) $id])->row();
            $existing_code = $row ? trim((string) $row->component_code) : '';
        }
        $code = $existing_code !== ''
            ? $existing_code
            : $this->make_component_code($data['program_id'], $name, $id ?: null);
    }

    $payload = [
        'program_id'        => (int) $data['program_id'],
        'component_name'    => $name,
        'component_code'    => $code,
        'component_type'    => trim($data['component_type'] ?? ''),
        'domain'            => trim($data['domain'] ?? ''),
        'component_mode'    => trim($data['component_mode'] ?? ''),
        'venue'             => trim($data['venue'] ?? ''),
        'price'             => (float) ($data['price'] ?? $data['unit_price'] ?? 0),
        'unit_price'        => (float) ($data['unit_price'] ?? $data['price'] ?? 0),
        'circular_path'     => trim((string) ($data['circular_path'] ?? '')),
        'admit_path'        => trim((string) ($data['admit_path'] ?? '')),
        'start_date'        => trim((string) ($data['start_date'] ?? '')) ?: null,
        'end_date'          => trim((string) ($data['end_date'] ?? '')) ?: null,
        'competition_date'  => trim((string) ($data['competition_date'] ?? '')) ?: null,
        'status'            => $data['status'] ?? 'Active',
    ];

    if ($id) {
        $this->db->where('id', (int) $id)->update('lp_components', $payload);
        $component_id = (int) $id;
    } else {
        $payload['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('lp_components', $payload);
        $component_id = $this->db->insert_id();
    }

    if ($payload['component_mode'] === 'Offline' && !empty($data['venues']) && is_array($data['venues'])) {
        $this->save_component_venues($component_id, $data['venues']);
    }

    return $component_id;
}

    public function delete_component($id)
    {
        $id   = (int) $id;
        $used = $this->db->where('component_id', $id)->count_all_results('lunar_plan_components');
        if ($used > 0) {
            return ['success' => false, 'error' => 'This component is used in one or more plans. Remove it from plans first.'];
        }
        $deleted = $this->db->where('id', $id)->delete('lp_components');
        return ['success' => (bool) $deleted];
    }

    public function get_component_stats($program_id)
    {
        $program_id = (int) $program_id;
        $all        = $this->db->where('program_id', $program_id)->get('lp_components')->result();
        $total      = count($all);
        $active     = count(array_filter($all, function($c) { return $c->status === 'Active'; }));
        $value      = array_sum(array_map(function($c) { return (float) $c->unit_price; }, $all));
        return ['total' => $total, 'active' => $active, 'total_value' => $value];
    }

    /* =========================================================
     * LUNAR PLANS  (per-program, with component links)
     * Tables:
     *   lunar_plans: id INT AI PK, program_id INT, plan_name VARCHAR(255),
     *     duration VARCHAR(50) DEFAULT 'Monthly',
     *     discount_percent DECIMAL(5,2), total_value DECIMAL(10,2),
     *     discount_amount DECIMAL(10,2), final_price DECIMAL(10,2),
     *     status ENUM('Active','Inactive'), created_at DATETIME
     *   lunar_plan_components: id INT AI PK, plan_id INT, component_id INT
     * =======================================================*/

    /* Adds lunar_plans.plan_type on first use (same pattern as
       ensure_program_columns). Values: 'Learning Material', 'Test',
       'Learning Material + Test'. */
    private function ensure_plan_columns()
    {
        if (!$this->db->field_exists('plan_type', 'lunar_plans')) {
            $this->db->query("ALTER TABLE `lunar_plans` ADD COLUMN `plan_type` VARCHAR(50) NOT NULL DEFAULT '' AFTER `plan_name`");
        }
    }

    public function get_plans_by_program($program_id)
    {
        $this->ensure_plan_columns();
        $plans = $this->db->where('program_id', (int) $program_id)
                           ->order_by('id', 'ASC')
                           ->get('lunar_plans')
                           ->result();
        foreach ($plans as $plan) {
            $plan->components = $this->get_plan_components($plan->id);
        }
        return $plans;
    }

    public function get_lunar_plan($id)
    {
        $plan = $this->db->where('id', (int) $id)->get('lunar_plans')->row();
        if ($plan) {
            $plan->components = $this->get_plan_components($plan->id);
        }
        return $plan;
    }

    public function get_plan_components($plan_id)
    {
        return $this->db->select('lpc.*, lc.component_name, lc.component_type, lc.unit_price')
                         ->from('lunar_plan_components lpc')
                         ->join('lp_components lc', 'lc.id = lpc.component_id')
                         ->where('lpc.plan_id', (int) $plan_id)
                         ->get()
                         ->result();
    }

    public function save_lunar_plan($data, $component_ids = [], $id = null)
    {
        $this->ensure_plan_columns();
        $payload = [
            'program_id'       => (int) $data['program_id'],
            'plan_name'        => trim($data['plan_name']),
            'duration'         => $data['duration'] ?? 'Monthly',
            'price'            => (float) ($data['price'] ?? $data['final_price'] ?? 0),
            'discount_percent' => (float) ($data['discount_percent'] ?? 0),
            'total_value'      => (float) ($data['total_value'] ?? 0),
            'discount_amount'  => (float) ($data['discount_amount'] ?? 0),
            'final_price'      => (float) ($data['final_price'] ?? $data['price'] ?? 0),
            'status'           => $data['status'] ?? 'Active',
        ];
        // Only touch plan_type when the caller actually sent it, so older
        // callers editing a plan don't blank an existing value.
        if (isset($data['plan_type'])) {
            $payload['plan_type'] = $data['plan_type'];
        }

        // $component_ids can be either:
        //  - a plain list of component ids, e.g. [1,2,3]  (legacy callers,
        //    units unknown/not tracked -> stored as 0)
        //  - an associative map of component_id => units, e.g. [5 => 8]
        //    (new Component + Unit selector in the Add Plan modal)
        // Both are normalised into $links = [component_id => units].
        $links = [];
        // A plain list has keys 0..n-1 that are the array's own indices,
        // not component ids — that's how we tell the two shapes apart.
        $is_plain_list = empty($component_ids)
            || array_keys($component_ids) === range(0, count($component_ids) - 1);
        if ($is_plain_list) {
            foreach (array_filter($component_ids) as $comp_id) {
                $links[(int) $comp_id] = (int) ($links[(int) $comp_id] ?? 0);
            }
        } else {
            foreach ($component_ids as $comp_id => $units) {
                $comp_id = (int) $comp_id;
                if ($comp_id <= 0) continue;
                $links[$comp_id] = max(0, (int) $units);
            }
        }

        $this->db->trans_start();
        if ($id) {
            $this->db->where('id', (int) $id)->update('lunar_plans', $payload);
            $plan_id = (int) $id;
        } else {
            $payload['created_at'] = date('Y-m-d H:i:s');
            $this->db->insert('lunar_plans', $payload);
            $plan_id = $this->db->insert_id();
        }
        // Replace component links
        $this->db->where('plan_id', $plan_id)->delete('lunar_plan_components');
        foreach ($links as $comp_id => $units) {
            $this->db->insert('lunar_plan_components', [
                'plan_id'      => $plan_id,
                'component_id' => $comp_id,
                'units'        => $units,
            ]);
        }
        $this->db->trans_complete();
        if (!$this->db->trans_status()) {
            throw new RuntimeException('Failed to save plan and components.');
        }
        return $plan_id;
    }

    /**
     * Units configured for a given plan+component link
     * (lunar_plan_components.units). Returns 0 if the link doesn't
     * exist or has no unit count configured.
     */
    public function get_plan_component_units($plan_id, $component_id)
    {
        $row = $this->db->select('units')
                         ->where('plan_id', (int) $plan_id)
                         ->where('component_id', (int) $component_id)
                         ->get('lunar_plan_components')
                         ->row();
        return $row ? (int) $row->units : 0;
    }

    public function toggle_lunar_plan_status($id)
    {
        $plan = $this->db->where('id', (int) $id)->get('lunar_plans')->row();
        if (!$plan) return false;
        $new = $plan->status === 'Active' ? 'Inactive' : 'Active';
        return $this->db->where('id', (int) $id)->update('lunar_plans', ['status' => $new]);
    }

    /* =========================================================
     * PLAN COMPONENT — UNIT-WISE STUDY MATERIAL
     * Reuses the existing `lm_content` table (plan_id, component_id,
     * start_unit, end_unit, file_path, status). One row per unit:
     * start_unit = end_unit = <unit number>. Distinct from the legacy
     * week-block uploads in ajax_content_upload, which never set
     * start_unit (they use week_number instead), so the two never
     * collide.
     * =======================================================*/

    /**
     * Which unit numbers (1..N) already have an uploaded file for
     * this plan+component. Does NOT assume completeness — only
     * returns what is actually present in the database.
     */
    public function get_uploaded_plan_units($plan_id, $component_id)
    {
        $rows = $this->db->select('start_unit')
                          ->where('plan_id', (int) $plan_id)
                          ->where('component_id', (int) $component_id)
                          ->where('start_unit IS NOT NULL')
                          ->group_by('start_unit')
                          ->order_by('start_unit', 'ASC')
                          ->get('lm_content')
                          ->result();
        return array_map(function ($r) { return (int) $r->start_unit; }, $rows);
    }

    /**
     * Full verification summary for the Add Plan modal:
     * required (from lunar_plan_components.units), uploaded count,
     * remaining count, and which specific units are missing.
     */
    public function get_plan_unit_upload_status($plan_id, $component_id)
    {
        $required = $this->get_plan_component_units($plan_id, $component_id);
        $uploaded_units = $this->get_uploaded_plan_units($plan_id, $component_id);
        // Only count uploads that fall within the currently configured
        // unit range — if units was reduced after some were uploaded,
        // don't over-count against the new requirement.
        $uploaded_in_range = array_values(array_filter($uploaded_units, function ($u) use ($required) {
            return $u >= 1 && $u <= $required;
        }));
        $uploaded  = count($uploaded_in_range);
        $remaining = max(0, $required - $uploaded);
        $missing_units = [];
        for ($u = 1; $u <= $required; $u++) {
            if (!in_array($u, $uploaded_in_range, true)) {
                $missing_units[] = $u;
            }
        }
        return [
            'required'       => $required,
            'uploaded'       => $uploaded,
            'remaining'      => $remaining,
            'uploaded_units' => $uploaded_in_range,
            'missing_units'  => $missing_units,
        ];
    }

    /**
     * The single lm_content row (if any) already saved for this
     * exact plan+component+unit — used so a re-upload replaces the
     * old file instead of creating a duplicate row.
     */
    public function get_unit_content_row($plan_id, $component_id, $unit)
    {
        return $this->db->where('plan_id', (int) $plan_id)
                         ->where('component_id', (int) $component_id)
                         ->where('start_unit', (int) $unit)
                         ->where('end_unit', (int) $unit)
                         ->get('lm_content')
                         ->row();
    }

    /**
     * Save (insert or replace) the uploaded file for one unit.
     * Returns the lm_content row id.
     */
    public function save_unit_content($meta)
    {
        $existing = $this->get_unit_content_row($meta['plan_id'], $meta['component_id'], $meta['start_unit']);

        if ($existing) {
            if (!empty($existing->file_path) && file_exists(FCPATH . $existing->file_path)) {
                @unlink(FCPATH . $existing->file_path);
            }
            $this->db->where('id', $existing->id)->update('lm_content', [
                'content_type' => $meta['content_type'],
                'file_path'    => $meta['file_path'],
                'status'       => 'Active',
                'uploaded_at'  => date('Y-m-d H:i:s'),
            ]);
            return (int) $existing->id;
        }

        $meta['status']      = 'Active';
        $meta['uploaded_at'] = date('Y-m-d H:i:s');
        $this->db->insert('lm_content', $meta);
        return $this->db->insert_id();
    }

    public function delete_lunar_plan($id)
    {
        $id = (int) $id;
        $this->db->trans_start();
        $this->db->where('plan_id', $id)->delete('lunar_plan_components');
        $this->db->where('id', $id)->delete('lunar_plans');
        $this->db->trans_complete();
        return ['success' => $this->db->trans_status()];
    }

    /* =========================================================
     * LUNAR LEARNING MODULES  (uploaded files per component/day)
     * Table: lunar_learning_modules
     *   id INT AI PK, program_id INT, component_id INT,
     *   day_number INT, original_filename VARCHAR(255),
     *   file_path VARCHAR(500), status ENUM('Active','Inactive'),
     *   uploaded_at DATETIME
     * =======================================================*/

    public function get_modules($program_id, $filters = [])
    {
        $this->db->select('llm.*, lc.component_name, lc.component_type')
                  ->from('lunar_learning_modules llm')
                  ->join('lp_components lc', 'lc.id = llm.component_id', 'left')
                  ->where('llm.program_id', (int) $program_id);

        if (!empty($filters['component_id'])) $this->db->where('llm.component_id', (int) $filters['component_id']);
        if (!empty($filters['day_number']))   $this->db->where('llm.day_number', (int) $filters['day_number']);

        return $this->db->order_by('llm.day_number', 'ASC')->get()->result();
    }

    public function save_module($meta)
    {
        $meta['uploaded_at'] = date('Y-m-d H:i:s');
        $meta['status']      = $meta['status'] ?? 'Active';
        $this->db->insert('lunar_learning_modules', $meta);
        return $this->db->insert_id();
    }

    public function delete_module($id)
    {
        $row = $this->db->where('id', (int) $id)->get('lunar_learning_modules')->row_array();
        if ($row && !empty($row['file_path']) && file_exists(FCPATH . $row['file_path'])) {
            @unlink(FCPATH . $row['file_path']);
        }
        return $this->db->where('id', (int) $id)->delete('lunar_learning_modules');
    }
}