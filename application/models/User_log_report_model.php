<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_log_report_model extends CI_Model
{
    private $table = 'ci_users_activity';

    public function get_logs($filters = array(), $length = 10, $start = 0)
    {
        $this->db->select('a.*, u.name as created_by_name');
        $this->db->from($this->table . ' as a');
        $this->db->join('users as u', 'a.created_by = u.id', 'left');

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

        return $this->db->get()->result_array();
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

    public function insert_log($data, $action_type = 'INSERT')
    {
        $log_data = array(
            'action_type' => $action_type,
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
            'city' => $data['city'] ?? null,
            'state' => $data['state'] ?? null,
            'region' => $data['region'] ?? null,
            'address' => $data['address'] ?? null,
            'created_at' => $data['created_at'] ?? null,
            'updated_at' => date('Y-m-d H:i:s')
        );

        return $this->db->insert($this->table, $log_data);
    }

    public function insert_update_log($old_data_emp, $updatedData , $id)
    {
        $log_data = array(
            'action_type' => 'UPDATE',
            'action_time' => date('Y-m-d H:i:s'),
            'action_by' => $this->session->userdata('user_name'),
            'id' => $id ?? null,
            'name' => $updatedData['name'] ?? null,
            'vacant_status' => $updatedData['vacant_status'] ?? null,
            'email' => $updatedData['email'] ?? null,
            'mobile' => $updatedData['mobile'] ?? null,
            'dob' => $updatedData['dob'] ?? null,
            'employer_code' => $updatedData['employer_code'] ?? null,
            'employer_name' => $updatedData['employer_name'] ?? null,
            'adhar_card' => $updatedData['adhar_card'] ?? null,
            'gender' => $updatedData['gender'] ?? null,
            'pjp_code' => $updatedData['pjp_code'] ?? null,
            'employee_id' => $updatedData['employee_id'] ?? null,
            'application_id' => $updatedData['application_id'] ?? null,
            'level' => $updatedData['level'] ?? null,
            'designation' => $updatedData['designation'] ?? null,
            'designation_name' => $updatedData['designation_name'] ?? null,
            'designation_label' => $updatedData['designation_label'] ?? null,
            'designation_label_name' => $updatedData['designation_label_name'] ?? null,
            'doj' => $updatedData['doj'] ?? null,
            'employee_status' => $updatedData['employee_status'] ?? null,
            'town' => $updatedData['town'] ?? null,
            'district_code' => $updatedData['district_code'] ?? null,
            'district' => $updatedData['district'] ?? null,
            'city' => $updatedData['city'] ?? null,
            'state' => $updatedData['state'] ?? null,
            'region' => $updatedData['region'] ?? null,
            'Zone_Code' => $updatedData['Zone_Code'] ?? null,
            'address' => $updatedData['address'] ?? null,
            'created_at' => $updatedData['created_at'] ?? null,
            'updated_at' => date('Y-m-d H:i:s'),
            
            // Old values
            'old_id' => $old_data_emp['id'] ?? null,
            'old_name' => $old_data_emp['name'] ?? null,
            'old_vacant_status' => $old_data_emp['vacant_status'] ?? null,
            'old_email' => $old_data_emp['email'] ?? null,
            'old_mobile' => $old_data_emp['mobile'] ?? null,
            'old_dob' => $old_data_emp['dob'] ?? null,
            'old_employer_code' => $old_data_emp['employer_code'] ?? null,
            'old_employer_name' => $old_data_emp['employer_name'] ?? null,
            'old_adhar_card' => $old_data_emp['adhar_card'] ?? null,
            'old_gender' => $old_data_emp['gender'] ?? null,
            'old_pjp_code' => $old_data_emp['pjp_code'] ?? null,
            'old_employee_id' => $old_data_emp['employee_id'] ?? null,
            'old_application_id' => $old_data_emp['application_id'] ?? null,
            'old_level' => $old_data_emp['level'] ?? null,
            'old_designation' => $old_data_emp['designation'] ?? null,
            'old_designation_name' => $old_data_emp['designation_name'] ?? null,
            'old_designation_label' => $old_data_emp['designation_label'] ?? null,
            'old_designation_label_name' => $old_data_emp['designation_label_name'] ?? null,
            'old_doj' => $old_data_emp['doj'] ?? null,
            'old_employee_status' => $old_data_emp['employee_status'] ?? null,
            'old_town' => $old_data_emp['town'] ?? null,
            'old_district_code' => $old_data_emp['district_code'] ?? null,
            'old_district' => $old_data_emp['district'] ?? null,
            'old_city' => $old_data_emp['city'] ?? null,
            'old_state' => $old_data_emp['state'] ?? null,
            'old_region' => $old_data_emp['region'] ?? null,
            'old_Zone_Code' => $old_data_emp['Zone_Code'] ?? null,
            'old_address' => $old_data_emp['address'] ?? null,
            'old_created_at' => $old_data_emp['created_at'] ?? null,
            'old_updated_at' => $old_data_emp['updated_at'] ?? null
        );

        return $this->db->insert($this->table, $log_data);
    }

    public function delete_log($data)
    {
        $log_data = array(
            'action_type' => 'DELETE',
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
            'city' => $data['city'] ?? null,
            'state' => $data['state'] ?? null,
            'region' => $data['region'] ?? null,
            'address' => $data['address'] ?? null,
            'updated_at' => date('Y-m-d H:i:s')
        );

        return $this->db->insert($this->table, $log_data);
    }
}
