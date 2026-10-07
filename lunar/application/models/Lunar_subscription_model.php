<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lunar_subscription_model extends CI_Model {

    public function get_schedules_for_associate($associate_link_id)
    {
        if (!empty($associate_link_id)) {
            return $this->db
                ->select('lunar_schedule_cin.*, associatelink_to_lunar.amount AS price_amount')
                ->from('lunar_schedule_cin')
                ->join('associatelink_to_lunar', 'lunar_schedule_cin.lunar_schedule_id = associatelink_to_lunar.lunar_schedule_id')
                ->where('associatelink_to_lunar.associate_link_id', $associate_link_id)
                ->get()->result();
        }

        return $this->db->get('lunar_schedule_cin')->result();
    }

    public function get_eligible_schedules($class, $subject, $associate_link_id)
    {
        $this->db->select('lunar_schedule_cin.*, associatelink_to_lunar.amount AS price_amount');
        $this->db->from('lunar_schedule_cin');
        if (!empty($associate_link_id)) {
            $this->db->join('associatelink_to_lunar', 'lunar_schedule_cin.lunar_schedule_id = associatelink_to_lunar.lunar_schedule_id');
            $this->db->where('associatelink_to_lunar.associate_link_id', $associate_link_id);
        }
        $this->db->where('lunar_schedule_cin.subject', $subject);
        $schedules = $this->db->get()->result();

        $eligible = [];
        foreach ($schedules as $s) {
            $check = $this->db->get_where('lunar_schedule_class', [
                'sch_id' => $s->lunar_schedule_id,
                'class'  => $class
            ])->row();
            if ($check) {
                $eligible[] = $s;
            }
        }

        return $eligible;
    }
}
