<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapping_log_report_model extends CI_Model
{
    private $table = 'mapping_log_report';

    public function __construct()
    {
        parent::__construct();
    }


    public function get_all_logs()
    {
        return $this->db->get('mapping_log_report')->result_array();
    }




    public function insert_update_log($old_data, $new_data, $id, $action_type = 'UPDATE')
    {
        $log_data = array(
            'action_type' => $action_type,
            'action_time' => date('Y-m-d H:i:s'),
            'action_by' => $this->session->userdata('user_name'),
            'log_id' => $id,
            'distributors_id' => $old_data['distributors_id'],
            'DB_Code' => $new_data['DB_Code'],
            'Sales_Code' => $old_data['Sales_Code'],
            'Distribution_Channel_Code' => $old_data['Distribution_Channel_Code'],
            'Division_Code' => $old_data['Division_Code'],
            'Customer_Type_Code' => $old_data['Customer_Type_Code'],
            'Customer_Group_Code' => $old_data['Customer_Group_Code'],
            'Level_1' => $new_data['Level_1'],
            'Level_2' => $new_data['Level_2'],
            'Level_3' => $new_data['Level_3'],
            'Level_4' => $new_data['Level_4'],
            'Level_5' => $new_data['Level_5'],
            'Level_6' => $new_data['Level_6'],
            'Level_7' => $new_data['Level_7'],
            'old_Level_1' => $old_data['Level_1'],
            'old_Level_2' => $old_data['Level_2'],
            'old_Level_3' => $old_data['Level_3'],
            'old_Level_4' => $old_data['Level_4'],
            'old_Level_5' => $old_data['Level_5'],
            'old_Level_6' => $old_data['Level_6'],
            'old_Level_7' => $old_data['Level_7'],
            'create_date' => $old_data['create_date'],
            'update_date' => date('Y-m-d H:i:s')
        );

        return $this->db->insert($this->table, $log_data);
    }

    public function insert_log($data, $action_type = 'INSERT')
    {
        $log_data = array(
            'action_type' => $action_type,
            'action_time' => date('Y-m-d H:i:s'),
            'action_by' => $this->session->userdata('user_name'),
            'log_id' => $data['id'] ?? null,
            'distributors_id' => $data['distributors_id'],
            'DB_Code' => $data['DB_Code'],
            'Sales_Code' => $data['Sales_Code'],
            'Distribution_Channel_Code' => $data['Distribution_Channel_Code'],
            'Division_Code' => $data['Division_Code'],
            'Customer_Type_Code' => $data['Customer_Type_Code'],
            'Customer_Group_Code' => $data['Customer_Group_Code'],
            'Level_1' => $data['Level_1'],
            'Level_2' => $data['Level_2'],
            'Level_3' => $data['Level_3'],
            'Level_4' => $data['Level_4'],
            'Level_5' => $data['Level_5'],
            'Level_6' => $data['Level_6'],
            'Level_7' => $data['Level_7'],
            'create_date' => $data['create_date'],
            'update_date' => date('Y-m-d H:i:s')
        );

        return $this->db->insert($this->table, $log_data);
    }


    public function delete_log($data, $id, $action_type = 'INSERT')
    {
        $log_data = array(
            'action_type' => $action_type,
            'action_time' => date('Y-m-d H:i:s'),
            'action_by' => $this->session->userdata('user_name'),
            'log_id' => $id,
            'distributors_id' => $data['distributors_id'],
            'DB_Code' => $data['DB_Code'],
            'Sales_Code' => $data['Sales_Code'],
            'Distribution_Channel_Code' => $data['Distribution_Channel_Code'],
            'Division_Code' => $data['Division_Code'],
            'Customer_Type_Code' => $data['Customer_Type_Code'],
            'Customer_Group_Code' => $data['Customer_Group_Code'],
            'Level_1' => $data['Level_1'],
            'Level_2' => $data['Level_2'],
            'Level_3' => $data['Level_3'],
            'Level_4' => $data['Level_4'],
            'Level_5' => $data['Level_5'],
            'Level_6' => $data['Level_6'],
            'Level_7' => $data['Level_7'],
            'create_date' => $data['create_date'],
            'update_date' => date('Y-m-d H:i:s')
        );

        return $this->db->insert($this->table, $log_data);
    }




    public function get_logs($filters = array(), $length = 10, $start = 0)
    {
        $this->db->select('mapping_log_report.*, 
            curr_l1.name as level1_name, 
            curr_l2.name as level2_name,
            curr_l3.name as level3_name,
            curr_l4.name as level4_name,
            curr_l5.name as level5_name,
            curr_l6.name as level6_name,
            curr_l7.name as level7_name,
            old_l1.name as old_level1_name,
            old_l2.name as old_level2_name,
            old_l3.name as old_level3_name,
            old_l4.name as old_level4_name,
            old_l5.name as old_level5_name,
            old_l6.name as old_level6_name,
            old_l7.name as old_level7_name');
        
        $this->db->from('mapping_log_report');
        
        // Joins for current levels
        $this->db->join('employee curr_l1', 'curr_l1.pjp_code = mapping_log_report.Level_1', 'left');
        $this->db->join('employee curr_l2', 'curr_l2.pjp_code = mapping_log_report.Level_2', 'left');
        $this->db->join('employee curr_l3', 'curr_l3.pjp_code = mapping_log_report.Level_3', 'left');
        $this->db->join('employee curr_l4', 'curr_l4.pjp_code = mapping_log_report.Level_4', 'left');
        $this->db->join('employee curr_l5', 'curr_l5.pjp_code = mapping_log_report.Level_5', 'left');
        $this->db->join('employee curr_l6', 'curr_l6.pjp_code = mapping_log_report.Level_6', 'left');
        $this->db->join('employee curr_l7', 'curr_l7.pjp_code = mapping_log_report.Level_7', 'left');
        
        // Joins for old levels
        $this->db->join('employee old_l1', 'old_l1.pjp_code = mapping_log_report.old_Level_1', 'left');
        $this->db->join('employee old_l2', 'old_l2.pjp_code = mapping_log_report.old_Level_2', 'left');
        $this->db->join('employee old_l3', 'old_l3.pjp_code = mapping_log_report.old_Level_3', 'left');
        $this->db->join('employee old_l4', 'old_l4.pjp_code = mapping_log_report.old_Level_4', 'left');
        $this->db->join('employee old_l5', 'old_l5.pjp_code = mapping_log_report.old_Level_5', 'left');
        $this->db->join('employee old_l6', 'old_l6.pjp_code = mapping_log_report.old_Level_6', 'left');
        $this->db->join('employee old_l7', 'old_l7.pjp_code = mapping_log_report.old_Level_7', 'left');

        // Apply search filter
        if (!empty($filters['search'])) {
            $this->db->group_start();
            $this->db->like('DB_Code', $filters['search']);
            $this->db->or_like('action_by', $filters['search']);
            $this->db->or_like('Sales_Code', $filters['search']);
            $this->db->group_end();
        }

        // Apply specific filters
        if (!empty($filters['action_type'])) {
            $this->db->where('action_type', $filters['action_type']);
        }
        if (!empty($filters['DB_Code'])) {
            $this->db->like('DB_Code', $filters['DB_Code']);
        }
        if (!empty($filters['date_from'])) {
            $this->db->where('action_time >=', $filters['date_from'] . ' 00:00:00');
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('action_time <=', $filters['date_to'] . ' 23:59:59');
        }

        // Apply ordering
        if (!empty($filters['order'])) {
            foreach ($filters['order'] as $order) {
                $this->db->order_by($order['column'], $order['dir']);
            }
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
        if (!empty($filters['action_type'])) {
            $this->db->where('action_type', $filters['action_type']);
        }
        if (!empty($filters['DB_Code'])) {
            $this->db->like('DB_Code', $filters['DB_Code']);
        }
        if (!empty($filters['date_from'])) {
            $this->db->where('action_time >=', $filters['date_from'] . ' 00:00:00');
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('action_time <=', $filters['date_to'] . ' 23:59:59');
        }
        if (!empty($filters['search'])) {
            $this->db->group_start();
            $this->db->like('DB_Code', $filters['search']);
            $this->db->or_like('action_by', $filters['search']);
            $this->db->or_like('Sales_Code', $filters['search']);
            $this->db->or_like('Distribution_Channel_Code', $filters['search']);
            $this->db->or_like('Division_Code', $filters['search']);
            $this->db->group_end();
        }

        return $this->db->count_all_results();
    }


    public function insert_mapping($data)
    {
        $result = $this->db->insert('maping', $data);
        $insert_id = $this->db->insert_id();

        if ($result) {
            // Load the log model
            $this->load->model('Mapping_log_report_model');

            // Add the insert ID to the data array
            $data['id'] = $insert_id;

            // Log the mapping action
            $this->Mapping_log_report_model->insert_log($data, 'INSERT');
        }

        return $insert_id;
    }





    
}
