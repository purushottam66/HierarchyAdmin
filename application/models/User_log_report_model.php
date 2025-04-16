<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_log_report_model extends CI_Model
{
    private $table = 'user_log_report';

    public function get_logs($filters = array(), $length = 10, $start = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        // Apply search filter
        if (!empty($filters['search'])) {
            $this->db->group_start();
            $this->db->like('name', $filters['search']);
            $this->db->or_like('email', $filters['search']);
            $this->db->or_like('employee_id', $filters['search']);
            $this->db->or_like('designation_name', $filters['search']);
            $this->db->group_end();
        }

        // Apply specific filters
        if (!empty($filters['action_type'])) {
            $this->db->where('action_type', $filters['action_type']);
        }
        if (!empty($filters['employee_search'])) {
            $this->db->group_start();
            $this->db->like('name', $filters['employee_search']);
            $this->db->or_like('employee_id', $filters['employee_search']);
            $this->db->group_end();
        }
        if (!empty($filters['date_from'])) {
            $this->db->where('action_time >=', $filters['date_from'] . ' 00:00:00');
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('action_time <=', $filters['date_to'] . ' 23:59:59');
        }

        // Apply ordering
        if (!empty($filters['order'])) {
            $this->db->order_by($filters['order']['column'], $filters['order']['dir']);
        } else {
            $this->db->order_by('action_time', 'DESC');
        }

        // Apply pagination
        $this->db->limit($length, $start);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_total_logs($filters = array())
    {
        $this->db->from($this->table);

        // Apply the same filters as get_logs
        if (!empty($filters['search'])) {
            $this->db->group_start();
            $this->db->like('name', $filters['search']);
            $this->db->or_like('email', $filters['search']);
            $this->db->or_like('employee_id', $filters['search']);
            $this->db->or_like('designation_name', $filters['search']);
            $this->db->group_end();
        }

        if (!empty($filters['action_type'])) {
            $this->db->where('action_type', $filters['action_type']);
        }
        if (!empty($filters['employee_search'])) {
            $this->db->group_start();
            $this->db->like('name', $filters['employee_search']);
            $this->db->or_like('employee_id', $filters['employee_search']);
            $this->db->group_end();
        }
        if (!empty($filters['date_from'])) {
            $this->db->where('action_time >=', $filters['date_from'] . ' 00:00:00');
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('action_time <=', $filters['date_to'] . ' 23:59:59');
        }

        return $this->db->count_all_results();
    }

    public function insert_log($data, $old_data = null)
    {
        $log_data = array(
            'action_type' => $old_data ? 'UPDATE' : 'INSERT',
            'action_time' => date('Y-m-d H:i:s'),
            'action_by' => $this->session->userdata('user_name'),
            'id' => $data['id'] ?? null,
            'name' => $data['name'] ?? null,
            'vacant_status' => $data['vacant_status'] ?? null,
            'email' => $data['email'] ?? null,
            'mobile' => $data['mobile'] ?? null,
            'dob' => $data['dob'] ?? null,
            'employer_code' => $data['employer_code'] ?? null,
            'employer_name' => $data['employer_name'] ?? null,
            'adhar_card' => $data['adhar_card'] ?? null,
            'gender' => $data['gender'] ?? null,
            'pjp_code' => $data['pjp_code'] ?? null,
            'employee_id' => $data['employee_id'] ?? null,
            'application_id' => $data['application_id'] ?? null,
            'level' => $data['level'] ?? null,
            'designation' => $data['designation'] ?? null,
            'designation_name' => $data['designation_name'] ?? null,
            'designation_label' => $data['designation_label'] ?? null,
            'designation_label_name' => $data['designation_label_name'] ?? null,
            'doj' => $data['doj'] ?? null,
            'employee_status' => $data['employee_status'] ?? null,
            'town' => $data['town'] ?? null,
            'district_code' => $data['district_code'] ?? null,
            'district' => $data['district'] ?? null,
            'city' => $data['city'] ?? null,
            'state' => $data['state'] ?? null,
            'region' => $data['region'] ?? null,
            'Zone_Code' => $data['Zone_Code'] ?? null,
            'address' => $data['address'] ?? null,
            'created_at' => $data['created_at'] ?? date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        // Add old data if this is an update
        if ($old_data) {
            $log_data = array_merge($log_data, array(
                'old_id' => $old_data['id'] ?? null,
                'old_name' => $old_data['name'] ?? null,
                'old_vacant_status' => $old_data['vacant_status'] ?? null,
                'old_email' => $old_data['email'] ?? null,
                'old_mobile' => $old_data['mobile'] ?? null,
                'old_dob' => $old_data['dob'] ?? null,
                'old_employer_code' => $old_data['employer_code'] ?? null,
                'old_employer_name' => $old_data['employer_name'] ?? null,
                'old_adhar_card' => $old_data['adhar_card'] ?? null,
                'old_gender' => $old_data['gender'] ?? null,
                'old_pjp_code' => $old_data['pjp_code'] ?? null,
                'old_employee_id' => $old_data['employee_id'] ?? null,
                'old_application_id' => $old_data['application_id'] ?? null,
                'old_level' => $old_data['level'] ?? null,
                'old_designation' => $old_data['designation'] ?? null,
                'old_designation_name' => $old_data['designation_name'] ?? null,
                'old_designation_label' => $old_data['designation_label'] ?? null,
                'old_designation_label_name' => $old_data['designation_label_name'] ?? null,
                'old_doj' => $old_data['doj'] ?? null,
                'old_employee_status' => $old_data['employee_status'] ?? null,
                'old_town' => $old_data['town'] ?? null,
                'old_district_code' => $old_data['district_code'] ?? null,
                'old_district' => $old_data['district'] ?? null,
                'old_city' => $old_data['city'] ?? null,
                'old_state' => $old_data['state'] ?? null,
                'old_region' => $old_data['region'] ?? null,
                'old_Zone_Code' => $old_data['Zone_Code'] ?? null,
                'old_address' => $old_data['address'] ?? null,
                'old_created_at' => $old_data['created_at'] ?? null,
                'old_updated_at' => $old_data['updated_at'] ?? null
            ));
        }

        return $this->db->insert($this->table, $log_data);
    }
}
