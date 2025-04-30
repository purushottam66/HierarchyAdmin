<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapping_log_report_model extends CI_Model
{
    private $table = 'ci_mapping_activity';

    public function __construct()
    {
        parent::__construct();
    }


    public function get_logs($filters = array(), $limit = null, $offset = null)
    {

        log_message('info', 'Filters: ' . print_r($filters, true));



        $this->db->select('ci_mapping_activity.*, users.name as created_by_name');
        $this->db->from('ci_mapping_activity');


        $this->db->join('users', 'users.id = ci_mapping_activity.created_by', 'left');


        if (!empty($filters)) {
            if (!empty($filters['action_type'])) {
                $this->db->where('ci_mapping_activity.action', $filters['action_type']);
            }

            if (!empty($filters['employee_search'])) {
                $this->db->like('ci_mapping_activity.data', $filters['employee_search']);
            }

            if (!empty($filters['date_from'])) {
                $this->db->where('DATE(ci_mapping_activity.created_at)', $filters['date_from']);
            }


            if (!empty($filters['search'])) {
                $this->db->group_start();
                $this->db->like('ci_mapping_activity.data', $filters['search']);
                $this->db->or_like('ci_mapping_activity.action', $filters['search']);
                $this->db->or_like('users.user_name', $filters['search']);
                $this->db->group_end();
            }


            if (!empty($filters['order'])) {
                $this->db->order_by($filters['order']['column'], $filters['order']['dir']);
            } else {
                $this->db->order_by('ci_mapping_activity.created_at', 'DESC');
            }
        }


        if ($limit !== null) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        $logs = $query->result_array();


        foreach ($logs as &$log) {
            $data = json_decode($log['data'], true);
            if (!empty($data[0]) && !empty($data[0][0])) {
                $mapping = $data[0][0];


                $this->db->select('*');
                $this->db->from('distributors');
                $this->db->where('Customer_Code', $mapping['DB_Code']);
                $this->db->where('Sales_Code', $mapping['Sales_Code']);
                $this->db->where('Distribution_Channel_Code', $mapping['Distribution_Channel_Code']);
                $this->db->where('Division_Code', $mapping['Division_Code']);
                $this->db->where('Customer_Type_Code', $mapping['Customer_Type_Code']);
                $this->db->where('Customer_Group_Code', $mapping['Customer_Group_Code']);
                $distributor = $this->db->get()->row_array();

                if ($distributor) {
                    $log['distributor_data'] = $distributor;
                }

                // Get employee data for each level
                $log['employee_data'] = [];
                for ($i = 1; $i <= 7; $i++) {
                    if (!empty($mapping["Level_$i"])) {
                        $this->db->select('name, employer_code, designation_name');
                        $this->db->from('employee');
                        $this->db->where('pjp_code', $mapping["Level_$i"]);
                        $employee = $this->db->get()->row_array();
                        if ($employee) {
                            $log['employee_data']["Level_$i"] = $employee;
                        }
                    }
                }
            }
        }

        return $logs;
    }

    public function get_total_logs($filters = array())
    {



        $this->db->select('COUNT(*) as total');
        $this->db->from('ci_mapping_activity');
        $this->db->join('users', 'users.id = ci_mapping_activity.created_by', 'left');

        // Apply the same filters as in get_logs
        if (!empty($filters)) {
            if (!empty($filters['action_type'])) {
                $this->db->where('ci_mapping_activity.action', $filters['action_type']);
            }

            if (!empty($filters['employee_search'])) {
                $this->db->like('ci_mapping_activity.data', $filters['employee_search']);
            }

            if (!empty($filters['date_from'])) {
                $this->db->where('DATE(ci_mapping_activity.created_at)', $filters['date_from']);
            }



            if (!empty($filters['search'])) {
                $this->db->group_start();
                $this->db->like('ci_mapping_activity.data', $filters['search']);
                $this->db->or_like('ci_mapping_activity.action', $filters['search']);
                $this->db->or_like('users.user_name', $filters['search']);
                $this->db->group_end();
            }
        }

        $query = $this->db->get();
        $result = $query->row_array();




        return $result['total'];
    }
}
