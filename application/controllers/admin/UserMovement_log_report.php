<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserMovement_log_report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->output->set_header('X-Content-Type-Options: nosniff');
        $this->output->set_header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
        $this->output->set_header('X-XSS-Protection: 1; mode=block');
        ini_set('memory_limit', '512M');

        // Load libraries and helpers once
        $this->load->library(['session', 'form_validation']);
        $this->load->helper(['url', 'form']);
        date_default_timezone_set('Asia/Kolkata');
        
        // Load models
        $this->load->model([
            'Role_model',
            'Zone_model',
            'Distributor_model',
            'Mapping_log_report_model'
        ]);

        // $user_id = $this->session->userdata('back_user_id');
        // if (!$user_id) {
        //     $this->session->set_flashdata('error', 'Session expired. Please login again.');
        //     redirect('admin/login');
        // }
    }




    public function json()
    {
        header('Content-Type: application/json');
        // $back_user_id = $this->session->userdata('back_user_id');
        // if (!$back_user_id) {
        //     echo json_encode(['error' => 'Unauthorized']);
        //     return;
        // }
    
        // Select from log and join with employees
        $this->db->select('
            log.id,
            log.action_type,
            log.action_by,
            log.level,
            log.selectedEmployeesselectedValue,
            log.set_pjp_code,
            log.db_code_data,
            log.vacant_data,
            log.created_at,
            log.status,
            log.message,
            emp1.name as old_employee_name,
               emp1.email as email,
            emp2.name as new_employee_name
        ');
        $this->db->from('log_report_m as log');
        $this->db->join('employee as emp1', 'log.selectedEmployeesselectedValue = emp1.pjp_code AND log.level = emp1.level', 'left');
        $this->db->join('employee as emp2', 'log.set_pjp_code = emp2.pjp_code AND log.level = emp2.level', 'left');
    
        // Optional filters
        if ($this->input->get('action_type')) {
            $this->db->where('log.action_type', $this->input->get('action_type'));
        }
    
        if ($this->input->get('action_by')) {
            $this->db->like('log.action_by', $this->input->get('action_by'));
        }
    
        $this->db->order_by('log.id', 'desc');
    
        $query = $this->db->get();
    
        // Error handling
        if ($this->db->error()['code'] !== 0) {
            log_message('error', 'Database Error: ' . print_r($this->db->error(), true));
            echo json_encode([
                'status' => 'error',
                'message' => 'Database error occurred'
            ]);
            return;
        }
    
        $logs = $query->result_array();
    
        // Process distributor data from db_code_data
        foreach ($logs as &$log) {
            $distributorData = [];
            if (!empty($log['db_code_data'])) {
                // Clean up the db_code_data
                $decoded = json_decode($log['db_code_data'], true);
                if (is_array($decoded)) {
                    $cleanData = [];
                    foreach ($decoded as $distJson) {
                        $dist = json_decode($distJson, true);
                        if ($dist) {
                            $cleanData[] = [
                                'Customer_Code' => $dist['Customer_Code'] ?? '',
                                'Sales_Code' => $dist['Sales_Code'] ?? '',
                                'Distribution_Channel_Code' => $dist['Distribution_Channel_Code'] ?? '',
                                'Division_Code' => $dist['Division_Code'] ?? '',
                                'Customer_Type_Code' => $dist['Customer_Type_Code'] ?? '',
                                'Customer_Group_Code' => $dist['Customer_Group_Code'] ?? '',
                                'distributors_id' => $dist['distributors_id'] ?? ''
                            ];
                        }
                    }
                    $log['db_code_data'] = $cleanData;
                }
            }
    
            if (is_array($decoded)) {
                foreach ($decoded as $distJson) {
                    $dist = json_decode($distJson, true);
    
                    if (isset($dist['Customer_Code'], $dist['Sales_Code'], $dist['Distribution_Channel_Code'], $dist['Division_Code'], $dist['Customer_Type_Code'], $dist['Customer_Group_Code'])) {
                        $this->db->where([
                            'Customer_Code' => $dist['Customer_Code'],
                            'Sales_Code' => $dist['Sales_Code'],
                            'Distribution_Channel_Code' => $dist['Distribution_Channel_Code'],
                            'Division_Code' => $dist['Division_Code'],
                            'Customer_Type_Code' => $dist['Customer_Type_Code'],
                            'Customer_Group_Code' => $dist['Customer_Group_Code'],
                        ]);
                        $distributor = $this->db->get('distributors')->row_array();
    
                        if ($distributor) {
                            $distributorData[] = $distributor;
                        }
                    }
                }
            }
    
            $log['distributor_details'] = $distributorData;
        }



    
        echo json_encode([
            'status' => 'success',
            'count' => count($logs),
            'logs' => $logs
        ], JSON_PRETTY_PRINT);




   
   
      
    }



    public function list()
    {
       



        $back_user_id = $this->session->userdata('back_user_id');
        if (!$back_user_id) {
            redirect('admin/login');
        }

        // Get user permissions
        if ($back_user_id) {
            $data['user'] = $this->Role_model->get_user_by_id($back_user_id);
            if ($data['user']) {
                $data['permissions'] = $this->Role_model->get_permissions_by_role($back_user_id);
            } else {
                $data['permissions'] = [];
            }
        }

        // Check for permission
        // $hasPermission = false;
        // if (!empty($data['permissions']) && is_array($data['permissions'])) {
        //     foreach ($data['permissions'] as $p) {
        //         if ($p['module_name'] === "User Log Report" && $p['view'] === "yes") {
        //             $hasPermission = true;
        //             break;
        //         }
        //     }
        // }

        // if (!$hasPermission) {
        //     redirect('admin/Access_denied');
        //     return;
        // }




        // Basic data
        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';

        // Load views
        $this->load->view('admin/header', $data);
        $this->load->view('admin/UserMovement_log_report', $data);
        $this->load->view('admin/footer', $data);
    }

    public function UserMovement_log_report_ajex()
    {
        $back_user_id = $this->session->userdata('back_user_id');
        if (!$back_user_id) {
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }

        $draw = $this->input->get('draw') ?? 0;
        $start = $this->input->get('start') ?? 0;
        $length = $this->input->get('length') ?? 10;
        $search = $this->input->get('search')['value'] ?? '';
        $order = $this->input->get('order') ?? array();

        $columns = array(
            'id',
            'action_type',
            'action_by',
            'level',
            'selectedEmployeesselectedValue',
            'set_pjp_code',
            'db_code_data',
            'vacant_data',
            'created_at',
            'status',
            'message'
        );

        $orderColumn = isset($order[0]['column']) ? $columns[$order[0]['column']] : 'id';
        $orderDir = isset($order[0]['dir']) ? $order[0]['dir'] : 'asc';



        // Get total records count
        $totalRecords = $this->db->count_all('log_report_m');

        // Build base query
        $this->db->select($columns)
            ->from('log_report_m');

        // Apply search if any
        if (!empty($search)) {
            $this->db->group_start()
                ->like('action_type', $search)
                ->or_like('action_by', $search)
                ->or_like('level', $search)
                ->or_like('selectedEmployeesselectedValue', $search)
                ->or_like('set_pjp_code', $search)
                ->or_like('status', $search)
                ->or_like('message', $search)
                ->group_end();
        }

        // Log SQL query
        log_message('error', 'SQL Query: ' . $this->db->last_query());

        // Get filtered count
        $countQuery = $this->db->get_compiled_select();
        $totalFiltered = $this->db->query("SELECT COUNT(*) as count FROM ($countQuery) as filtered_results")->row()->count;

        // Reset query builder
        $this->db->reset_query();

        // Rebuild the query for actual data
        $this->db->select($columns)
            ->from('log_report_m');

        if (!empty($search)) {
            $this->db->group_start()
                ->like('action_type', $search)
                ->or_like('action_by', $search)
                ->or_like('level', $search)
                ->or_like('selectedEmployeesselectedValue', $search)
                ->or_like('set_pjp_code', $search)
                ->or_like('status', $search)
                ->or_like('message', $search)
                ->group_end();
        }

        $this->db->order_by($orderColumn ?? 'id', $orderDir ?? 'desc')
            ->limit($length, $start);

        $logs = $this->db->get()->result_array();

        // Log any database errors
        if ($this->db->error()['code'] != 0) {
            log_message('error', 'Database error in UserMovement_log_report_ajex: ' . json_encode($this->db->error()));
        }

        log_message('error', 'Fetched Logs: ' . print_r($logs, true));

        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalFiltered,
            "data" => array()
        );

        foreach ($logs as $log) {
            $row = array();
            foreach ($columns as $column) {
                $row[] = isset($log[$column]) ? $log[$column] : '';
            }
            $response['data'][] = $row;
        }

        log_message('error', 'Final Response: ' . print_r($response, true));

        echo json_encode($response);
    }
}
