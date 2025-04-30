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
        date_default_timezone_set('Asia/Kolkata');

        // if (!$user_id) {

        //     $this->session->set_flashdata('error', 'Session expired. Please login again.');
        //     redirect('admin/login');
        // }
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
        //  $hasPermission = false;
        //  if (!empty($data['permissions']) && is_array($data['permissions'])) {
        //      foreach ($data['permissions'] as $p) {
        //          if ($p['module_name'] === "Log Report" && $p['view'] === "yes") {
        //              $hasPermission = true;
        //              break;
        //          }
        //      }
        //  }

        // if (!$hasPermission) {
        //      redirect('admin/Access_denied');
        //      return;
        //  }




        // Basic data
        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';

        // Load views
        $this->load->view('admin/header', $data);
        $this->load->view('admin/user-log-report', $data);
        $this->load->view('admin/footer', $data);
    }


    public function get_logs_ajax()
    {
        // Check authentication
        $back_user_id = $this->session->userdata('back_user_id');
        if (!$back_user_id) {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized access']);
            return;
        }

        try {
            // Get and validate DataTables parameters
            $draw = intval($this->input->get('draw'));
            $start = max(0, intval($this->input->get('start')));
            $length = max(50000, min(100, intval($this->input->get('length')))); // Limit between 10 and 100
            $search = trim($this->input->get('search')['value'] ?? '');

            // Validate order parameters
            $order_column = intval($this->input->get('order')[0]['column'] ?? 0);
            $order_dir = strtoupper($this->input->get('order')[0]['dir'] ?? 'ASC');
            if (!in_array($order_dir, ['ASC', 'DESC'])) {
                $order_dir = 'ASC';
            }

            // Define and validate columns for sorting
            $columns = array(
                'user_id',
                'parent_id',
                'action',
                'data',
                'created_at',
                'created_by',
                'employee_name',
                'employee_code',
                'designation',
                'pjp_code',
                'state',
                'city',
                'zone',
                'zone_code'
            );

            // Validate date inputs
            $date_from = $this->input->get('date_from');
            $date_to = $this->input->get('date_to');
            if ($date_from && !strtotime($date_from)) $date_from = null;
            if ($date_to && !strtotime($date_to)) $date_to = null;

            // Build filters array
            $filters = array(
                'action_type' => $this->input->get('action_type'),
                'employee_search' => trim($this->input->get('employee_search')),
                'date_from' => $date_from,
                'date_to' => $date_to,
                'search' => $search,
                'order' => array(
                    'column' => $columns[$order_column] ?? 'created_at',
                    'dir' => $order_dir
                )
            );

            // Get logs data
            $logs = $this->User_log_report_model->get_logs($filters, $length, $start);
            $total_records = $this->User_log_report_model->get_total_logs($filters);

            // Format the data for table display
            $formatted_data = array_map(function ($log) {
                $data = json_decode($log['data'], true);

                // Create view button with action buttons
                $actions = '<div class="btn-group">';
                $actions .= '<button type="button" class="btn btn-info btn-sm view-log" data-id="' . $log['id'] . '" title="View Details">';
                $actions .= '<i class="fas fa-eye"></i></button>';
                $actions .= '</div>';

                // Format the action type with badge
                $action_badge = '';
                switch ($log['action']) {
                    case 'INSERT':
                        $action_badge = '<span class="badge bg-success">Insert</span>';
                        break;
                    case 'UPDATE':
                        $action_badge = '<span class="badge bg-warning">Update</span>';
                        break;
                    case 'DELETE':
                        $action_badge = '<span class="badge bg-danger">Delete</span>';
                        break;
                    default:
                        $action_badge = '<span class="badge bg-secondary">' . $log['action'] . '</span>';
                }

                return [
                    'DT_RowId' => 'row_' . $log['id'],
                    'id' => $log['id'],
                    'user_id' => $log['user_id'],
                    'parent_id' => $log['parent_id'] ?? '-',
                    'action' => $action_badge,
                    'employee_name' => $data['name'] ?? '-',
                    'vacant_status' => $data['vacant_status'] ?? '-',
                    'email' => $data['email'] ?? '-',
                    'mobile' => $data['mobile'] ?? '-',
                    'dob' => $data['dob'] ?? '-',
                    'employer_code' => $data['employer_code'] ?? '-',
                    'employer_name' => $data['employer_name'] ?? '-',
                    'adhar_card' => $data['adhar_card'] ?? '-',
                    'gender' => $data['gender'] ?? '-',
                    'employee_id' => $data['employee_id'] ?? '-',
                    'application_id' => $data['application_id'] ?? '-',
                    'level' => $data['level'] ?? '-',
                    'designation' => $data['designation'] ?? '-',
                    'designation_name' => $data['designation_name'] ?? '-',
                    'designation_label' => $data['designation_label'] ?? '-',
                    'designation_label_name' => $data['designation_label_name'] ?? '-',
                    'doj' => $data['doj'] ?? '-',
                    'employee_status' => $data['employee_status'] ?? '-',
                    'city' => $data['city'] ?? '-',
                    'state' => $data['state'] ?? '-',
                    'Zone' => $data['region'] ?? '-',
                    'address' => $data['address'] ?? '-',
                    'created_at' => date('Y-m-d H:i:s', strtotime($log['created_at'])),
                    'created_by' => $log['created_by_name'] ?? $log['created_by'], 
                 
                ];
            }, $logs);

            // Prepare response
            $response = array(
                "draw" => $draw,
                "recordsTotal" => intval($total_records),
                "recordsFiltered" => intval($total_records),
                "data" => $formatted_data
            );

            log_message('debug', 'get_logs_ajax response: ' . json_encode($response));
            echo json_encode($response);
        } catch (Exception $e) {
            log_message('error', 'Error in get_logs_ajax: ' . $e->getMessage());
            echo json_encode([
                'status' => 'error',
                'message' => 'An error occurred while fetching logs',
                'draw' => intval($this->input->get('draw')),
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => []
            ]);
        }
    }



    public function json()
    {
        header('Content-Type: application/json');

        $expected_token = 'c57f984eb1f9b891a203c99d8e991d0ed3a749cbddcad8e44aef3a46d6ed6aab'; // Replace with secure token
        $auth_header = $this->input->get_request_header('Authorization');
    
        if ($auth_header !== 'Bearer ' . $expected_token) {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized access']);
            http_response_code(401);
            return;
        }
    
        try {
            $draw = intval($this->input->get('draw'));
            $start = max(0, intval($this->input->get('start')));
            $length = max(5000, min(100, intval($this->input->get('length'))));
            $search = trim($this->input->get('search')['value'] ?? '');
    
            $order_column = intval($this->input->get('order')[0]['column'] ?? 0);
            $order_dir = strtoupper($this->input->get('order')[0]['dir'] ?? 'ASC');
            if (!in_array($order_dir, ['ASC', 'DESC'])) $order_dir = 'ASC';
    
            $columns = ['user_id', 'parent_id', 'action', 'data', 'created_at', 'created_by'];


            $date_from = $this->input->get('date_from');

            if (empty($date_from) || !strtotime($date_from)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Please select a valid date',
                ]);
                http_response_code(400); // Bad Request
                return;
            }
            
            $filters = [
                'search' => $search,
                'date_from' => $date_from,
                'order' => [
                    'column' => $columns[$order_column] ?? 'created_at',
                    'dir' => $order_dir
                ]
            ];
    
            $logs = $this->User_log_report_model->get_logs($filters, $length, $start);
            $total_records = $this->User_log_report_model->get_total_logs($filters);
    
            $customKeys = [
                'id' => 'record_id',
                'name' => 'employee_name',
                'vacant_status' => 'is_vacant',
                'email' => 'email_address',
                'mobile' => 'phone_number',
                'dob' => 'date_of_birth',
                'employer_code' => 'employer_code',
                'employer_name' => 'employer_name',
                'adhar_card' => 'aadhaar_number',
                'gender' => 'gender',
            
                'employee_id' => 'employee_id',
                'application_id' => 'application_id',
                'level' => 'level',
                'designation' => 'designation_code',
                'designation_name' => 'designation_title',
                'designation_label' => 'designation_label_code',
                'designation_label_name' => 'designation_label_title',
                'doj' => 'joining_date',
                'employee_status' => 'status',
                'city' => 'city_name',
                'state' => 'state_name',
                'region' => 'zone',
                'Zone_Code' => 'zone_code',
                'address' => 'residential_address',
                'created_at' => 'created_on',
                'updated_at' => 'last_updated',
              
            
            ];
    
            $formatted_data = array_map(function ($log) use ($customKeys) {
                $data = json_decode($log['data'], true);
                unset($data['password']); 
                unset($data['level_name']); 
                unset($data['lock_until']); 
                unset($data['failed_attempts']); 
                unset($data['inactive_date']); 
                unset($data['active_date']); 
                unset($data['pjp_code']); 
    
                $customData = [];
                foreach ($data as $key => $value) {
                    $customKey = $customKeys[$key] ?? $key;
                    $customData[$customKey] = $value;
                }
    
                return [
                    'id' => $log['id'],
                    'user_id' => $log['user_id'],
                    'parent_id' => $log['parent_id'] ?? null,
                    'action' => $log['action'],
                    'data' => $customData,
                    'created_at' => $log['created_at'],
                    'created_by' => $log['created_by_name'],
                ];
            }, $logs);
    
            $response = [
                "draw" => $draw,
                "recordsTotal" => intval($total_records),
                "recordsFiltered" => intval($total_records),
                "data" => $formatted_data,
                "status" => "success"
            ];
    
            echo json_encode($response);
    
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Error fetching logs',
                'data' => [],
                'draw' => intval($this->input->get('draw')),
                'recordsTotal' => 0,
                'recordsFiltered' => 0
            ]);
        }
    }
    



}
