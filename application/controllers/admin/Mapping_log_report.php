<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapping_log_report extends CI_Controller
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
        $this->load->model('Mapping_log_report_model');


        $user_id = $this->session->userdata('back_user_id');

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
        $this->load->view('admin/mapping_log_report', $data);
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
        $order = $this->input->get('order');

        // Define column names for sorting
        $columns = array(
            0 => 'action_type',
            1 => 'action_time',
            2 => 'action_by',
            3 => 'DB_Code',
            4 => 'Sales_Code',
            5 => 'Distribution_Channel_Code',
            6 => 'Division_Code',
            7 => 'Customer_Type_Code',
            8 => 'Customer_Group_Code',
            9 => 'Level_1',
            10 => 'Level_2',
            11 => 'Level_3',
            12 => 'Level_4',
            13 => 'Level_5',
            14 => 'Level_6',
            15 => 'Level_7'
        );

        // Filters
        $filters = array(
            'action_type' => $this->input->get('action_type'),
            'DB_Code' => $this->input->get('DB_Code'),
            'date_from' => $this->input->get('date_from'),
            'date_to' => $this->input->get('date_to'),
            'search' => $search,
            'order' => array()
        );

        // Process ordering
        if (!empty($order)) {
            foreach ($order as $ord) {
                $filters['order'][] = array(
                    'column' => $columns[$ord['column']],
                    'dir' => $ord['dir']
                );
            }
        }

        // Get filtered data
        $logs = $this->Mapping_log_report_model->get_logs($filters, $length, $start);
        $total_records = $this->Mapping_log_report_model->get_total_logs($filters);
        $filtered_records = $total_records; // If you want separate count for filtered records

        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => intval($total_records),
            "recordsFiltered" => intval($filtered_records),
            "data" => array()
        );

        // Format the data
        foreach ($logs as $log) {
            $row = array();
            foreach ($columns as $column) {
                if (strpos($column, 'Level_') !== false && $log['action_type'] === 'UPDATE') {
                    $old_column = 'old_' . $column;
                    $row[] = "Old: " . ($log[$old_column] ?? 'N/A') . " → New: " . ($log[$column] ?? 'N/A');
                } else {
                    $row[] = $log[$column] ?? '';
                }
            }
            $response['data'][] = $row;
        }

        echo json_encode($response);
    }
}
