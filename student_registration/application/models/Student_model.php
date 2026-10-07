<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * MaRRS Student Model
 * File: application/models/Student_model.php
 *
 * Required DB Tables:
 *   student_registrations (id, cin, first_name, last_name, email, dob, grade,
 *                          program_id, school_id, parent_cin, status, payment_status,
 *                          created_at, updated_at)
 *   school_access_codes   (id, code, school_name, program_id, max_uses, used_count,
 *                          expires_at, is_active)
 *   test_results          (id, student_id, test_id, score, max_score, attempted_at)
 *   tests                 (id, program_id, title, opens_at, closes_at, duration_minutes)
 */
class Student_model extends CI_Model {

    private $table = 'student_registrations';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // ── Registration ──

    public function create_registration(array $data) : int
    {
        $this->db->insert($this->table, $data);
        return (int) $this->db->insert_id();
    }

    public function cin_exists(string $cin) : bool
    {
        return $this->db->where('cin', $cin)->count_all_results($this->table) > 0;
    }

    public function get_by_cin(string $cin)
    {
        return $this->db->where('cin', $cin)->get($this->table)->row();
    }

    public function get_by_id(int $id)
    {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    public function update_payment_status(int $reg_id, string $status) : bool
    {
        return $this->db->where('id', $reg_id)
            ->update($this->table, ['payment_status' => $status, 'updated_at' => date('Y-m-d H:i:s')]);
    }

    // ── School Access Code ──

    public function validate_school_code(string $code)
    {
        return $this->db->where('code', strtoupper($code))
            ->where('is_active', 1)
            ->where('expires_at >=', date('Y-m-d'))
            ->where('used_count <', 'max_uses', FALSE)
            ->get('school_access_codes')->row();
    }

    public function increment_code_usage(int $code_id) : bool
    {
        return $this->db->where('id', $code_id)
            ->set('used_count', 'used_count + 1', FALSE)
            ->update('school_access_codes');
    }

    // ── Authentication ──

    public function authenticate(string $cin, string $dob = '', string $email = '')
    {
        $this->db->where('cin', $cin)->where('payment_status', 'paid');

        if (!empty($dob)) {
            $this->db->where('dob', $dob);
        } elseif (!empty($email)) {
            $this->db->where('email', strtolower($email));
        }

        return $this->db->get($this->table)->row();
    }

    // ── Tests & Results ──

    public function get_available_tests(int $student_id) : array
    {
        $student = $this->get_by_id($student_id);
        if (!$student) return [];

        $now = date('Y-m-d H:i:s');
        return $this->db
            ->where('program_id', $student->program_id)
            ->where('opens_at <=', $now)
            ->where('closes_at >=', $now)
            ->get('tests')
            ->result_array();
    }

    public function get_results(int $student_id) : array
    {
        return $this->db
            ->select('tr.*, t.title AS test_title, t.duration_minutes, p.name AS program_name')
            ->from('test_results tr')
            ->join('tests t', 't.id = tr.test_id')
            ->join('programs p', 'p.id = t.program_id')
            ->where('tr.student_id', $student_id)
            ->order_by('tr.attempted_at', 'DESC')
            ->get()->result_array();
    }

    public function save_result(int $student_id, int $test_id, int $score, int $max_score) : int
    {
        $this->db->insert('test_results', [
            'student_id'   => $student_id,
            'test_id'      => $test_id,
            'score'        => $score,
            'max_score'    => $max_score,
            'attempted_at' => date('Y-m-d H:i:s'),
        ]);
        return (int) $this->db->insert_id();
    }
}