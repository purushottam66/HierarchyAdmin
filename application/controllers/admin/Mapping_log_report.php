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
        date_default_timezone_set('Asia/Kolkata');


        // $user_id = $this->session->userdata('back_user_id');

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
        // $hasPermission = false;
        // if (!empty($data['permissions']) && is_array($data['permissions'])) {
        //     foreach ($data['permissions'] as $p) {
        //         if ($p['module_name'] === "Log Report" && $p['view'] === "yes") {
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
        $this->load->view('admin/mapping-log-report', $data);
        $this->load->view('admin/footer', $data);
    }





    public function get_logs_ajax()
    {

        log_message('debug', 'get_logs_ajax called with params: ' . json_encode($_GET));
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
            $logs = $this->Mapping_log_report_model->get_logs($filters, $length, $start);
            $total_records = $this->Mapping_log_report_model->get_total_logs($filters);

            log_message('debug', 'get_logs_ajax logs: '. json_encode($logs));



            log_message('debug', 'get_logs_ajax total: ' . json_encode($total_records));





            // Format the data for table display
            // In get_logs_ajax() function, replace the formatting section with:
            $formatted_data = array_map(function ($log) {
                $data = json_decode($log['data'], true);
                $mapping_data = isset($data[0][0]) ? $data[0][0] : [];
                $distributor_data = $log['distributor_data'] ?? [];
                $employee_data = $log['employee_data'] ?? [];

                return [
                    'id' => $log['id'],
                    'user_id' => $log['user_id'],
                    'parent_id' => $log['parent_id'] ?? '-',
                    'action' => $this->format_action_badge($log['action']),
                    'created_at' => date('Y-m-d H:i:s', strtotime($log['created_at'])),
                    'created_by' => $log['created_by_name'] ?? $log['created_by'],


                    'Customer_Name' => $distributor_data['Customer_Name'] ?? '-',
                    'Customer_Code' => $distributor_data['Customer_Code'] ?? '-',
                    'Pin_Code' => $distributor_data['Pin_Code'] ?? '-',
                    'City' => $distributor_data['City'] ?? '-',
                    'District' => $distributor_data['District'] ?? '-',
                    'Contact_Number' => $distributor_data['Contact_Number'] ?? '-',
                    'Country' => $distributor_data['Country'] ?? '-',
                    'Zone' => $distributor_data['Zone'] ?? '-',
                    'State' => $distributor_data['State'] ?? '-',
                    'Population_Strata_1' => $distributor_data['Population_Strata_1'] ?? '-',
                    'Population_Strata_2' => $distributor_data['Population_Strata_2'] ?? '-',
                    'Country_Group' => $distributor_data['Country_Group'] ?? '-',
                    'GTM_TYPE' => $distributor_data['GTM_TYPE'] ?? '-',
                    'SUPERSTOCKIST' => $distributor_data['SUPERSTOCKIST'] ?? '-',
                    'STATUS' => $distributor_data['STATUS'] ?? '-',
                    'Sales_Code' => $distributor_data['Sales_Code'] ?? '-',
                    'Sales_Name' => $distributor_data['Sales_Name'] ?? '-',
                    'Distribution_Channel_Code' => $distributor_data['Distribution_Channel_Code'] ?? '-',
                    'Distribution_Channel_Name' => $distributor_data['Distribution_Channel_Name'] ?? '-',
                    'Division_Code' => $distributor_data['Division_Code'] ?? '-',
                    'Division_Name' => $distributor_data['Division_Name'] ?? '-',
                    'Customer_Type_Code' => $distributor_data['Customer_Type_Code'] ?? '-',
                    'Customer_Type_Name' => $distributor_data['Customer_Type_Name'] ?? '-',
                    'Customer_Group_Code' => $distributor_data['Customer_Group_Code'] ?? '-',
                    'Customer_Group_Name' => $distributor_data['Customer_Group_Name'] ?? '-',
                    'Customer_Creation_Date' => $distributor_data['Customer_Creation_Date'] ?? '-',
                    'Sector_Name' => $distributor_data['Sector_Name'] ?? '-',
                    'Sector_Code' => $distributor_data['Sector_Code'] ?? '-',
                    'State_Code' => $distributor_data['State_Code'] ?? '-',
                    'Zone_Code' => $distributor_data['Zone_Code'] ?? '-',


                    'Level_1_Name' => $employee_data['Level_1']['name'] ?? '-',
                    'Level_1_Code' => $employee_data['Level_1']['employer_code'] ?? '-',
                    'Level_1_Designation' => $employee_data['Level_1']['designation_name'] ?? '-',

                    'Level_2_Name' => $employee_data['Level_2']['name'] ?? '-',
                    'Level_2_Code' => $employee_data['Level_2']['employer_code'] ?? '-',
                    'Level_2_Designation' => $employee_data['Level_2']['designation_name'] ?? '-',

                    'Level_3_Name' => $employee_data['Level_3']['name'] ?? '-',
                    'Level_3_Code' => $employee_data['Level_3']['employer_code'] ?? '-',
                    'Level_3_Designation' => $employee_data['Level_3']['designation_name'] ?? '-',

                    'Level_4_Name' => $employee_data['Level_4']['name'] ?? '-',
                    'Level_4_Code' => $employee_data['Level_4']['employer_code'] ?? '-',
                    'Level_4_Designation' => $employee_data['Level_4']['designation_name'] ?? '-',

                    'Level_5_Name' => $employee_data['Level_5']['name'] ?? '-',
                    'Level_5_Code' => $employee_data['Level_5']['employer_code'] ?? '-',
                    'Level_5_Designation' => $employee_data['Level_5']['designation_name'] ?? '-',


                    'Level_6_Name' => $employee_data['Level_6']['name'] ?? '-',
                    'Level_6_Code' => $employee_data['Level_6']['employer_code'] ?? '-',
                    'Level_6_Designation' => $employee_data['Level_6']['designation_name'] ?? '-',


                    'Level_7_Name' => $employee_data['Level_7']['name'] ?? '-',
                    'Level_7_Code' => $employee_data['Level_7']['employer_code'] ?? '-',
                    'Level_7_Designation' => $employee_data['Level_7']['designation_name'] ?? '-',
                    'new_date' => isset($mapping_data['create_date']) ? date('Y-m-d H:i:s', strtotime($mapping_data['update_date'])) : date('Y-m-d H:i:s', strtotime($log['created_at'])),

                ];
            }, $logs);



            // Prepare response
            $response = array(
                "draw" => $draw,
                "recordsTotal" => intval($total_records),
                "recordsFiltered" => intval($total_records),
                "data" => $formatted_data
            );

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
            // Get and validate DataTables parameters
            $draw = intval($this->input->get('draw'));
            $start = max(0, intval($this->input->get('start')));
            $length = max(5000, min(100, intval($this->input->get('length')))); // Limit between 10 and 100
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


            );

            // Validate date inputs
            $date_from = $this->input->get('date_from');
           
      

            if (empty($date_from) || !strtotime($date_from)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Please select a valid date',
                ]);
                http_response_code(400); // Bad Request
                return;
            }
            // Build filters array
            $filters = array(
                'action_type' => $this->input->get('action_type'),
                'employee_search' => trim($this->input->get('employee_search')),
                'date_from' => $date_from,
              
                'search' => $search,
                'order' => array(
                    'column' => $columns[$order_column] ?? 'created_at',
                    'dir' => $order_dir
                )
            );

            // Get logs data
            $logs = $this->Mapping_log_report_model->get_logs($filters, $length, $start);
            $total_records = $this->Mapping_log_report_model->get_total_logs($filters);





            // Format the data for table display
            // In get_logs_ajax() function, replace the formatting section with:
            $formatted_data = array_map(function ($log) {
                $data = json_decode($log['data'], true);
                $mapping_data = isset($data[0][0]) ? $data[0][0] : [];
                $distributor_data = $log['distributor_data'] ?? [];
                $employee_data = $log['employee_data'] ?? [];

                return [
                    'id' => $log['id'],
                    'batch_id' => $log['user_id'],
                    'batch_parent_id' => $log['parent_id'] ?? '-',
                    'action' => $log['action'],
                    'created_at' => date('Y-m-d H:i:s', strtotime($log['created_at'])),
                    'created_by' => $log['created_by_name'] ?? $log['created_by'],
                    'Customer_Name' => $distributor_data['Customer_Name'] ?? '-',


                    // डिस्ट्रीब्यूटर डेटा
                    'distributors_id' => $mapping_data['distributors_id'] ?? '-',
                    'Customer_Code' => $distributor_data['Customer_Code'] ?? '-',
                    'Pin_Code' => $distributor_data['Pin_Code'] ?? '-',
                    'City' => $distributor_data['City'] ?? '-',
                    'District' => $distributor_data['District'] ?? '-',
                    'Contact_Number' => $distributor_data['Contact_Number'] ?? '-',
                    'Country' => $distributor_data['Country'] ?? '-',
                    'Zone' => $distributor_data['Zone'] ?? '-',
                    'State' => $distributor_data['State'] ?? '-',
                    'Population_Strata_1' => $distributor_data['Population_Strata_1'] ?? '-',
                    'Population_Strata_2' => $distributor_data['Population_Strata_2'] ?? '-',
                    'Country_Group' => $distributor_data['Country_Group'] ?? '-',
                    'GTM_TYPE' => $distributor_data['GTM_TYPE'] ?? '-',
                    'SUPERSTOCKIST' => $distributor_data['SUPERSTOCKIST'] ?? '-',
                    'STATUS' => $distributor_data['STATUS'] ?? '-',
                    'Sales_Code' => $distributor_data['Sales_Code'] ?? '-',
                    'Sales_Name' => $distributor_data['Sales_Name'] ?? '-',
                    'Distribution_Channel_Code' => $distributor_data['Distribution_Channel_Code'] ?? '-',
                    'Distribution_Channel_Name' => $distributor_data['Distribution_Channel_Name'] ?? '-',
                    'Division_Code' => $distributor_data['Division_Code'] ?? '-',
                    'Division_Name' => $distributor_data['Division_Name'] ?? '-',
                    'Customer_Type_Code' => $distributor_data['Customer_Type_Code'] ?? '-',
                    'Customer_Type_Name' => $distributor_data['Customer_Type_Name'] ?? '-',
                    'Customer_Group_Code' => $distributor_data['Customer_Group_Code'] ?? '-',
                    'Customer_Group_Name' => $distributor_data['Customer_Group_Name'] ?? '-',
                    'Customer_Creation_Date' => $distributor_data['Customer_Creation_Date'] ?? '-',
                    'Sector_Name' => $distributor_data['Sector_Name'] ?? '-',
                    'Sector_Code' => $distributor_data['Sector_Code'] ?? '-',
                    'State_Code' => $distributor_data['State_Code'] ?? '-',
                    'Zone_Code' => $distributor_data['Zone_Code'] ?? '-',

                    // कर्मचारी डेटा
                    'Level_1_Name' => $employee_data['Level_1']['name'] ?? '-',
                    'Level_1_Code' => $employee_data['Level_1']['employer_code'] ?? '-',
                    'Level_1_Designation' => $employee_data['Level_1']['designation_name'] ?? '-',

                    'Level_2_Name' => $employee_data['Level_2']['name'] ?? '-',
                    'Level_2_Code' => $employee_data['Level_2']['employer_code'] ?? '-',
                    'Level_2_Designation' => $employee_data['Level_2']['designation_name'] ?? '-',

                    'Level_3_Name' => $employee_data['Level_3']['name'] ?? '-',
                    'Level_3_Code' => $employee_data['Level_3']['employer_code'] ?? '-',
                    'Level_3_Designation' => $employee_data['Level_3']['designation_name'] ?? '-',

                    'Level_4_Name' => $employee_data['Level_4']['name'] ?? '-',
                    'Level_4_Code' => $employee_data['Level_4']['employer_code'] ?? '-',
                    'Level_4_Designation' => $employee_data['Level_4']['designation_name'] ?? '-',

                    'Level_5_Name' => $employee_data['Level_5']['name'] ?? '-',
                    'Level_5_Code' => $employee_data['Level_5']['employer_code'] ?? '-',
                    'Level_5_Designation' => $employee_data['Level_5']['designation_name'] ?? '-',


                    'Level_6_Name' => $employee_data['Level_6']['name'] ?? '-',
                    'Level_6_Code' => $employee_data['Level_6']['employer_code'] ?? '-',
                    'Level_6_Designation' => $employee_data['Level_6']['designation_name'] ?? '-',


                    'Level_7_Name' => $employee_data['Level_7']['name'] ?? '-',
                    'Level_7_Code' => $employee_data['Level_7']['employer_code'] ?? '-',
                    'Level_7_Designation' => $employee_data['Level_7']['designation_name'] ?? '-',

                    'new_date' => isset($mapping_data['create_date']) ? date('Y-m-d H:i:s', strtotime($mapping_data['update_date'])) : date('Y-m-d H:i:s', strtotime($log['created_at'])),

                ];
            }, $logs);



            // Prepare response
            $response = array(
                "draw" => $draw,
                "recordsTotal" => intval($total_records),
                "recordsFiltered" => intval($total_records),
                "data" => $formatted_data
            );

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

    protected function format_action_badge($action)
    {
        switch (strtoupper($action)) {
            case 'LEFT':
                return '<span class="badge bg-danger">LEFT</span>';
            case 'JOINED':
                return '<span class="badge bg-success">JOINED</span>';
            case 'MOVED':
                return '<span class="badge bg-warning">MOVED</span>';
            default:
                return '<span class="badge bg-secondary">' . strtoupper($action) . '</span>';
        }
    }
}
