<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_log_report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();


        $this->output->set_header('X-Content-Type-Options: nosniff');
        $this->output->set_header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
        $this->output->set_header('X-XSS-Protection: 1; mode=block');
        ini_set('memory_limit', '512M'); // Or 1G
        $this->load->library('session');
        $this->load->model('Role_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Zone_model');
        $this->load->model('Distributor_model');
        $this->load->library('session');
        $user_id = $this->session->userdata('back_user_id');
        $this->load->model('User_log_report_model');

        if (!$user_id) {

            $this->session->set_flashdata('error', 'Session expired. Please login again.');
            redirect('admin/login');
        }
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
        $this->load->view('admin/user_log_report', $data);
        $this->load->view('admin/footer', $data);
    }


    public function get_logs_ajax()
    {
        $back_user_id = $this->session->userdata('back_user_id');
        if (!$back_user_id) {
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }

        // Get DataTables parameters
        $draw = $this->input->get('draw');
        $start = $this->input->get('start');
        $length = $this->input->get('length');
        $search = $this->input->get('search')['value'];
        $order_column = $this->input->get('order')[0]['column'];
        $order_dir = $this->input->get('order')[0]['dir'];

        // Define column names for sorting
        $columns = array(
            'log_id',
            'action_type',
            'action_time',
            'action_by',
            'name',
            'email',
            'designation_name',
            'town'
        );

        // Filters
        $filters = array(
            'action_type' => $this->input->get('action_type'),
            'employee_search' => $this->input->get('employee_search'),
            'date_from' => $this->input->get('date_from'),
            'date_to' => $this->input->get('date_to'),
            'search' => $search,
            'order' => array(
                'column' => $columns[$order_column] ?? 'action_time',
                'dir' => $order_dir
            )
        );

        // Load the model
   
        
        // Get filtered data
        $logs = $this->User_log_report_model->get_logs($filters, $length, $start);
        $total_records = $this->User_log_report_model->get_total_logs($filters);

        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => intval($total_records),
            "recordsFiltered" => intval($total_records),
            "data" => $logs
        );

        echo json_encode($response);
    }


    public function json()
{
    header('Content-Type: application/json');

    $back_user_id = $this->session->userdata('back_user_id');
    if (!$back_user_id) {
        http_response_code(401);
        echo json_encode([
            'status' => 'error',
            'message' => 'Unauthorized access'
        ]);
        return;
    }

    $this->load->model('User_log_report_model');
    $logs = $this->User_log_report_model->get_logs(); // No filters, just raw logs

    $formatted_logs = [];

    foreach ($logs as $log) {
        $formatted_logs[] = [
            'log_id' => $log['log_id'],
            'action' => [
                'type' => $log['action_type'],
                'time' => $log['action_time'],
                'by' => $log['action_by']
            ],
            'new_employee' => [
                'id' => $log['id'],
                'name' => $log['name'],
                'vacant_status' => $log['vacant_status'],
                'email' => $log['email'],
                'mobile' => $log['mobile'],
                'dob' => $log['dob'],
                'employer_code' => $log['employer_code'],
                'employer_name' => $log['employer_name'],
                'adhar_card' => $log['adhar_card'],
                'gender' => $log['gender'],
                'pjp_code' => $log['pjp_code'],
                'employee_id' => $log['employee_id'],
                'application_id' => $log['application_id'],
                'level' => $log['level'],
                'designation' => $log['designation'],
                'designation_name' => $log['designation_name'],
                'designation_label' => $log['designation_label'],
                'designation_label_name' => $log['designation_label_name'],
                'doj' => $log['doj'],
                'employee_status' => $log['employee_status'],
              
                'city' => $log['city'],
                'state' => $log['state'],
                'zone' => $log['region'],
                'Zone_Code' => $log['Zone_Code'],
                'address' => $log['address'],
                'created_at' => $log['created_at'],
                'updated_at' => $log['updated_at'],
            ],
            'old_employee' => [
                'id' => $log['old_id'],
                'name' => $log['old_name'],
                'vacant_status' => $log['old_vacant_status'],
                'email' => $log['old_email'],
                'mobile' => $log['old_mobile'],
                'dob' => $log['old_dob'],
                'employer_code' => $log['old_employer_code'],
                'employer_name' => $log['old_employer_name'],
                'adhar_card' => $log['old_adhar_card'],
                'gender' => $log['old_gender'],
                'pjp_code' => $log['old_pjp_code'],
                'employee_id' => $log['old_employee_id'],
                'application_id' => $log['old_application_id'],
                'level' => $log['old_level'],
                'designation' => $log['old_designation'],
                'designation_name' => $log['old_designation_name'],
                'designation_label' => $log['old_designation_label'],
                'designation_label_name' => $log['old_designation_label_name'],
                'doj' => $log['old_doj'],
                'employee_status' => $log['old_employee_status'],
             
                'city' => $log['old_city'],
                'state' => $log['old_state'],
                'zone' => $log['old_region'],
                'Zone_Code' => $log['old_Zone_Code'],
                'address' => $log['old_address'],
                'created_at' => $log['old_created_at'],
                'updated_at' => $log['old_updated_at'],
            ]
        ];
    }

    echo json_encode([
        'status' => 'success',
        'count' => count($formatted_logs),
        'logs' => $formatted_logs
    ]);
}

    
}
