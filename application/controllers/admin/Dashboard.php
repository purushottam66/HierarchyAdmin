<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        ini_set('memory_limit', '1024M');
        $this->load->model('User_model');
        $this->load->model('Role_model');
        $this->load->model('Zone_model');


        $this->load->model('Distributor_model');

        $this->load->model('Maping_model');
        $this->load->model('Employee_model');
    }

    public function index()
    {

        $user_id = $this->session->userdata('back_user_id');

        if (!$user_id) {

            redirect('admin/login');
        }

        if ($user_id) {
            $data['user'] = $this->Role_model->get_user_by_id($user_id);
            if ($data['user']) {

                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
        }

        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';


        $this->load->view('admin/header', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('admin/footer', $data);
    }

    public function masters()
    {

        $user_id = $this->session->userdata('back_user_id');

        if (!$user_id) {

            redirect('admin/login');
        }
        if ($user_id) {
            $data['user'] = $this->Role_model->get_user_by_id($user_id);
            if ($data['user']) {

                $role_id = $data['user']['role_id'];
                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
        }

        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';

        $this->load->view('admin/header', $data);

        $this->load->view('admin/masters');
        $this->load->view('admin/footer', $data);
    }

    public function zone()
    {
        $data['zone'] = $this->Distributor_model->get_all_zones();
        $user_id = $this->session->userdata('back_user_id');

        if (!$user_id) {
            redirect('admin/login');
        }

        if ($user_id) {
            $data['user'] = $this->Role_model->get_user_by_id($user_id);
            if ($data['user']) {
                $role_id = $data['user']['role_id'];
                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
        }

        // Check if the user has 'view' permission for the "User Master" module
        $has_view_permission = false;

        foreach ($data['permissions'] as $permission) {
            if ($permission['module_name'] === 'Masters' && $permission['view'] === 'yes') {
                $has_view_permission = true;
                break;
            }
        }

        if (!$has_view_permission) {
            echo "<h3>Access Denied: You do not have permission to view this page.</h3>";
            exit;
        }

        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';


        // Load the views if permission is granted
        $this->load->view('admin/header', $data);
        $this->load->view('admin/zone');
        $this->load->view('admin/footer', $data);
    }




    public function ZoneHierarchy()
    {


        $user_id = $this->session->userdata('back_user_id');
        if (!$user_id) {

            redirect('admin/login');
        }

        $data['maping'] = $this->Maping_model->get_all_Maping_table_zone();

        $data['zone'] = $this->Distributor_model->get_all_zones();



        if ($user_id) {
            $data['user'] = $this->Role_model->get_user_by_id($user_id);
            if ($data['user']) {

                $role_id = $data['user']['role_id'];
                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
        }

        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';




        $this->load->view('admin/header', $data);
        $this->load->view('admin/ZoneHierarchy', $data);
        $this->load->view('admin/footer', $data);
    }




    // public function ZoneHierarchy_ajex_tree()
    // {


    //     $user_id = $this->session->userdata('back_user_id');
    //     if (!$user_id) {

    //         redirect('admin/login');
    //     }

    //     $data['maping'] = $this->Maping_model->get_all_Maping_table_zone();
    //     if (empty($data['maping'])) {
    //         echo '<script>console.log("No mapping data found.");</script>';
    //     }
    //     $data['zone'] = $this->Distributor_model->get_all_zones();



    //     if ($user_id) {
    //         $data['user'] = $this->Role_model->get_user_by_id($user_id);
    //         if ($data['user']) {

    //             $role_id = $data['user']['role_id'];
    //             $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
    //         } else {
    //             $data['permissions'] = [];
    //         }
    //     } else {
    //         $data['user'] = null;
    //         $data['permissions'] = [];
    //     }

    //     $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';


    //     // echo json_encode($data, JSON_PRETTY_PRINT);
    //     // die();
    //     echo json_encode(   $data);

    // }






    public function treezoneajex()
    {

        $user_id = $this->session->userdata('back_user_id');
        if (!$user_id) {

            redirect('admin/login');
        }



        $rawInput = file_get_contents('php://input');
        try {

            $postData = json_decode($rawInput, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Invalid JSON format');
            }

            if (!is_array($postData) || empty($postData)) {
                throw new Exception('Input data is not valid.');
            }

            $dbCodes = array_column($postData, 'DB_Code');

            $levelCodes = [
                'Level_1' => array_column($postData, 'Level_1'),
                'Level_2' => array_column($postData, 'Level_2'),
                'Level_3' => array_column($postData, 'Level_3'),
                'Level_4' => array_column($postData, 'Level_4'),
                'Level_5' => array_column($postData, 'Level_5'),
                'Level_6' => array_column($postData, 'Level_6'),
                'Level_7' => array_column($postData, 'Level_7'),
            ];

            // Start building the query
            $this->db->select("
                mp.DB_Code,
                ds.Customer_Name,
                ds.Customer_Code,
                ds.Pin_Code,
                ds.City,
                ds.District,
                ds.Contact_Number,
                ds.Country,
                ds.Zone,
                ds.State,
                ds.Population_Strata_1,
                ds.Population_Strata_2,
                ds.Country_Group,
                ds.GTM_TYPE,
                ds.SUPERSTOCKIST,
                ds.STATUS,
                ds.Customer_Type_Code,
                ds.Sales_Code,
                ds.Customer_Type_Name,
                ds.Customer_Group_Code,
                ds.Customer_Creation_Date,
                ds.Division_Code,
                ds.Sector_Code,
                ds.State_Code,
                ds.Zone_Code,
                ds.Distribution_Channel_Code,
                ds.Distribution_Channel_Name,
                ds.Customer_Group_Name,
                ds.Sales_Name,
                ds.Division_Name,
                ds.Sector_Name,
                
                emp1.name as emp1_name,
                emp1.designation_label_name as emp1_employee_id,
                emp2.name as emp2_name,
                emp2.designation_label_name as emp2_employee_id,
                emp3.name as emp3_name,
                emp3.designation_label_name as emp3_employee_id,
                emp4.name as emp4_name,
                emp4.designation_label_name as emp4_employee_id,
                emp5.name as emp5_name,
                emp5.designation_label_name as emp5_employee_id,
                emp6.name as emp6_name,
                emp6.designation_label_name as emp6_employee_id,
                emp7.name as emp7_name, 
                emp7.designation_label_name as emp7_employee_id
            ");

            $this->db->from('maping mp');
            $this->db->join('distributors ds', 'ds.Customer_Code = mp.DB_Code
                AND ds.Sales_Code = mp.Sales_Code
                AND ds.Distribution_Channel_Code = mp.Distribution_Channel_Code
                AND ds.Division_Code = mp.Division_Code
                AND ds.Customer_Type_Code = mp.Customer_Type_Code
                AND ds.Customer_Group_Code = mp.Customer_Group_Code', 'inner');

            $this->db->join('employee emp1', 'emp1.pjp_code = mp.Level_1 AND emp1.level = 1', 'left');

            // For Level_2
            $this->db->join('employee emp2', 'emp2.pjp_code = mp.Level_2 AND emp2.level = 2', 'left');

            // For Level_3
            $this->db->join('employee emp3', 'emp3.pjp_code = mp.Level_3 AND emp3.level = 3', 'left');

            // For Level_4
            $this->db->join('employee emp4', 'emp4.pjp_code = mp.Level_4 AND emp4.level = 4', 'left');

            // For Level_5
            $this->db->join('employee emp5', 'emp5.pjp_code = mp.Level_5 AND emp5.level = 5', 'left');

            // For Level_6
            $this->db->join('employee emp6', 'emp6.pjp_code = mp.Level_6 AND emp6.level = 6', 'left');

            // For Level_7
            $this->db->join('employee emp7', 'emp7.pjp_code = mp.Level_7 AND emp7.level = 7', 'left');


            $this->db->where_in('mp.DB_Code', $dbCodes);


            $this->db->group_start();
            foreach ($levelCodes as $level => $codes) {
                if (!empty($codes)) {
                    $this->db->or_where_in('mp.' . $level, $codes);
                }
            }
            $this->db->group_end();


            // $this->db->group_by('mp.DB_Code, ds.Customer_Name, ds.Customer_Code, ds.Pin_Code, ds.City, ds.District, ds.Contact_Number, ds.Country, ds.Zone, ds.State, ds.Population_Strata_1, ds.Population_Strata_2, ds.Country_Group, ds.GTM_TYPE, ds.SUPERSTOCKIST, ds.STATUS, ds.Customer_Type_Code, ds.Sales_Code, ds.Customer_Type_Name, ds.Customer_Group_Code, ds.Customer_Creation_Date, ds.Division_Code, ds.Sector_Code, ds.State_Code, ds.Zone_Code, ds.Distribution_Channel_Code, ds.Distribution_Channel_Name, ds.Customer_Group_Name, ds.Sales_Name, ds.Division_Name, ds.Sector_Name');


            $query = $this->db->get();
            $data = $query->result_array();


            echo json_encode([
                'status' => 'success',
                'data' => $data
            ]);
        } catch (Exception $e) {

            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);

            log_message('error', $e->getMessage());
        }
    }






    public function ajax_endpoint()
    {
        $user_id = $this->session->userdata('back_user_id');
        if (!$user_id) {
            redirect('admin/login');
        }

        // Log user ID check
        //log_message('info', 'User ID: ' . $user_id);

        // Capture and log incoming POST data
        $postData = json_decode(file_get_contents('php://input'), true);
        //log_message('info', 'Received POST data: ' . json_encode($postData, JSON_PRETTY_PRINT));

        // Extract `level` and `id`, with logging
        $level = $postData['level'] ?? null;
        $id = $postData['id'] ?? null;
        //log_message('info', 'Level: ' . $level . ', ID: ' . $id);

        // Collect and log `Level_1` to `Level_7`
        $levels = [];
        for ($i = 1; $i <= 7; $i++) {
            $levelKey = "Level_" . $i;
            $levels[$levelKey] = $postData[$levelKey] ?? null;
        }
        //log_message('info', 'Levels data: ' . json_encode($levels, JSON_PRETTY_PRINT));

        // Call model method and log the result
        $result = $this->Maping_model->get_all_Maping_table_ajex_zone($level, $id, $levels);
        // log_message('info', 'Result from get_all_Maping_table_ajex_zone: ' . json_encode($result, JSON_PRETTY_PRINT));

        // Output the result as JSON
        header('Content-Type: application/json');
        echo json_encode($result);
    }


    public function get_table_columns($table_name)
    {
        $query = $this->db->query("
            SELECT COLUMN_NAME 
            FROM INFORMATION_SCHEMA.COLUMNS 
            WHERE TABLE_NAME = '{$table_name}' 
            AND TABLE_SCHEMA = DATABASE()
        ");

        $columns = array_column($query->result_array(), 'COLUMN_NAME');
        return $columns;
    }




    public function InactiveDistributors_ajex()
    {


        $user_id = $this->session->userdata('back_user_id');

        if (!$user_id) {
            redirect('admin/login');
            return;
        }

        $data['zone_permissions'] = $this->Zone_model->get_zone_permissions_by_user_id($user_id);

        $zone_ids = [];
        foreach ($data['zone_permissions'] as $permission) {
            if (isset($permission['zone_id'])) {
                $decoded_ids = json_decode($permission['zone_id'], true);
                if (is_array($decoded_ids)) {
                    $zone_ids = array_merge($zone_ids, $decoded_ids);
                }
            }
        }

        $zone_ids = array_unique($zone_ids);

        $draw = $this->input->post('draw');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search');
        $order = $this->input->post('order');

        // Fetch dynamic sortable columns
        $sortable_columns = $this->get_table_columns('distributors');

        // Extract sorting information
        if (isset($order[0])) {
            $order_column_index = isset($order[0]['column']) ? $order[0]['column'] : 0; // Default to 0
            $order_direction = isset($order[0]['dir']) ? $order[0]['dir'] : 'asc'; // Default to 'asc'
        } else {
            $order_column_index = 0;
            $order_direction = 'asc';
        }
        $order_column = isset($sortable_columns[$order_column_index]) ? $sortable_columns[$order_column_index] : '';

        $total_get_distributors = $this->Distributor_model->getTotal_distributors_inactive($search, $zone_ids);

        $distributors_s = $this->Distributor_model->get_distributors_inactive($start, $length, $search, $zone_ids, $order_column, $order_direction);

        $data = array();
        foreach ($distributors_s->result() as $AS_distributors) {
            $row = [];
            foreach ($sortable_columns as $column) {
                $row[] = isset($AS_distributors->$column) ? $AS_distributors->$column : '';
            }
            $data[] = array(
                $AS_distributors->Customer_Name,
                $AS_distributors->Customer_Code,
                $AS_distributors->Pin_Code,
                $AS_distributors->City,
                $AS_distributors->District,
                $AS_distributors->Contact_Number,
                $AS_distributors->Country,
                $AS_distributors->Zone,
                $AS_distributors->State,
                $AS_distributors->Population_Strata_1,
                $AS_distributors->Population_Strata_2,
                $AS_distributors->Country_Group,
                $AS_distributors->GTM_TYPE,
                $AS_distributors->SUPERSTOCKIST,
                $AS_distributors->STATUS,
                $AS_distributors->Customer_Type_Name,
                $AS_distributors->Customer_Type_Code,
                $AS_distributors->Sales_Name,
                $AS_distributors->Sales_Code,
                $AS_distributors->Customer_Group_Name,
                $AS_distributors->Customer_Group_Code,
                $AS_distributors->Customer_Creation_Date,
                $AS_distributors->Division_Name,
                $AS_distributors->Division_Code,
                $AS_distributors->Sector_Name,
                $AS_distributors->Sector_Code,
                $AS_distributors->State_Code,
                $AS_distributors->Zone_Code,
                $AS_distributors->Distribution_Channel_Name,
                $AS_distributors->Distribution_Channel_Code,
            );
        }
        $output = array(
            'draw' => $draw,
            'recordsTotal' => $total_get_distributors,
            'recordsFiltered' => $total_get_distributors,
            'data' => $data,
            'columns' => $sortable_columns

        );



        echo json_encode($output);
        exit();
    }





    public function ssss()
    {
        // Log user ID
        $user_id = $this->session->userdata('back_user_id');

        if (!$user_id) {
            redirect('admin/login');
            return;
        }

        // Get zone permissions
        $data['zone_permissions'] = $this->Zone_model->get_zone_permissions_by_user_id($user_id);

        $zone_ids = [];
        foreach ($data['zone_permissions'] as $permission) {
            if (isset($permission['zone_id'])) {
                $decoded_ids = json_decode($permission['zone_id'], true);
                if (is_array($decoded_ids)) {
                    $zone_ids = array_merge($zone_ids, $decoded_ids);
                }
            }
        }

        $zone_ids = array_unique($zone_ids);

        // Retrieve DataTable parameters
        $draw = $this->input->post('draw');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search');
        $order = $this->input->post('order');

        // Fetch dynamic sortable columns
        $sortable_columns = $this->get_table_columns('distributors');

        // Extract sorting information
        if (isset($order[0])) {
            $order_column_index = isset($order[0]['column']) ? $order[0]['column'] : 0; // Default to 0
            $order_direction = isset($order[0]['dir']) ? $order[0]['dir'] : 'asc'; // Default to 'asc'
        } else {
            $order_column_index = 0;
            $order_direction = 'asc';
        }
        $order_column = isset($sortable_columns[$order_column_index]) ? $sortable_columns[$order_column_index] : '';


        // Fetch total records and filtered records
        $total_get_distributors = $this->Distributor_model->getTotal_distributors_($search, $zone_ids);

        $distributors_s = $this->Distributor_model->get_distributors_($start, $length, $search, $zone_ids, $order_column, $order_direction);

        $data = array();
        foreach ($distributors_s->result() as $AS_distributors) {
            $row = [];
            foreach ($sortable_columns as $column) {
                $row[] = isset($AS_distributors->$column) ? $AS_distributors->$column : ''; // Dynamically populate row
            }
            $data[] = array(
                $AS_distributors->Customer_Name,
                $AS_distributors->Customer_Code,
                $AS_distributors->Pin_Code,
                $AS_distributors->City,
                $AS_distributors->District,
                $AS_distributors->Contact_Number,
                $AS_distributors->Country,
                $AS_distributors->Zone,
                $AS_distributors->State,
                $AS_distributors->Population_Strata_1,
                $AS_distributors->Population_Strata_2,
                $AS_distributors->Country_Group,
                $AS_distributors->GTM_TYPE,
                $AS_distributors->SUPERSTOCKIST,
                $AS_distributors->STATUS,
                $AS_distributors->Customer_Type_Code,
                $AS_distributors->Sales_Code,
                $AS_distributors->Customer_Type_Name,
                $AS_distributors->Customer_Group_Code,
                $AS_distributors->Customer_Creation_Date,
                $AS_distributors->Division_Code,
                $AS_distributors->Sector_Code,
                $AS_distributors->State_Code,
                $AS_distributors->Zone_Code,
                $AS_distributors->Distribution_Channel_Code,
                $AS_distributors->Distribution_Channel_Name,
                $AS_distributors->Customer_Group_Name,
                $AS_distributors->Sales_Name,
                $AS_distributors->Division_Name,
                $AS_distributors->Sector_Name,
            );
        }

        $output = array(
            'draw' => $draw,
            'recordsTotal' => $total_get_distributors,
            'recordsFiltered' => $total_get_distributors,
            'data' => $data,
            'columns' => $sortable_columns // This will send the column titles to the DataTable

        );



        echo json_encode($output);
        exit();
    }




    public function distributors_db_unmppd()
    {
        // Log user ID
        $user_id = $this->session->userdata('back_user_id');

        if (!$user_id) {
            redirect('admin/login');
            return;
        }

        // Get zone permissions
        $data['zone_permissions'] = $this->Zone_model->get_zone_permissions_by_user_id($user_id);

        $zone_ids = [];
        foreach ($data['zone_permissions'] as $permission) {
            if (isset($permission['zone_id'])) {
                $decoded_ids = json_decode($permission['zone_id'], true);
                if (is_array($decoded_ids)) {
                    $zone_ids = array_merge($zone_ids, $decoded_ids);
                }
            }
        }

        $zone_ids = array_unique($zone_ids);

        // Retrieve DataTable parameters
        $draw = $this->input->post('draw');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search');
        $order = $this->input->post('order');

        // Fetch dynamic sortable columns
        $sortable_columns = $this->get_table_columns('distributors');

        // Extract sorting information
        if (isset($order[0])) {
            $order_column_index = isset($order[0]['column']) ? $order[0]['column'] : 0; // Default to 0
            $order_direction = isset($order[0]['dir']) ? $order[0]['dir'] : 'asc'; // Default to 'asc'
        } else {
            $order_column_index = 0;
            $order_direction = 'asc';
        }
        $order_column = isset($sortable_columns[$order_column_index]) ? $sortable_columns[$order_column_index] : '';


        // Fetch total records and filtered records
        $total_get_distributors = $this->Distributor_model->getTotal_distributors_unmapped($search, $zone_ids);

        $distributors_s = $this->Distributor_model->get_distributors_unmapped($start, $length, $search, $zone_ids, $order_column, $order_direction);

        $data = array();
        foreach ($distributors_s->result() as $AS_distributors) {
            $row = [];
            foreach ($sortable_columns as $column) {
                $row[] = isset($AS_distributors->$column) ? $AS_distributors->$column : ''; // Dynamically populate row
            }
            $data[] = array(
                $AS_distributors->Customer_Name,
                $AS_distributors->Customer_Code,
                $AS_distributors->Pin_Code,
                $AS_distributors->City,
                $AS_distributors->District,
                $AS_distributors->Contact_Number,
                $AS_distributors->Country,
                $AS_distributors->Zone,
                $AS_distributors->State,
                $AS_distributors->Population_Strata_1,
                $AS_distributors->Population_Strata_2,
                $AS_distributors->Country_Group,
                $AS_distributors->GTM_TYPE,
                $AS_distributors->SUPERSTOCKIST,
                $AS_distributors->STATUS,
                $AS_distributors->Sales_Name,
                $AS_distributors->Sales_Code,
                $AS_distributors->Customer_Type_Name,
                $AS_distributors->Customer_Type_Code,
                $AS_distributors->Customer_Group_Name,
                $AS_distributors->Customer_Group_Code,
                $AS_distributors->Division_Name,
                $AS_distributors->Division_Code,
                $AS_distributors->Sector_Name,
                $AS_distributors->Sector_Code,
                $AS_distributors->State_Code,
                $AS_distributors->Zone_Code,
                $AS_distributors->Distribution_Channel_Name,
                $AS_distributors->Distribution_Channel_Code,
                $AS_distributors->Customer_Creation_Date,
            );
        }

        $output = array(
            'draw' => $draw,
            'recordsTotal' => $total_get_distributors,
            'recordsFiltered' => $total_get_distributors,
            'data' => $data,
            'columns' => $sortable_columns // This will send the column titles to the DataTable

        );



        echo json_encode($output);
        exit();
    }












    public function distributors_db()
    {
        $user_id = $this->session->userdata('back_user_id');

        if (!$user_id) {
            redirect('admin/login');
            return;
        }

        $data['zone_permissions'] = $this->Zone_model->get_zone_permissions_by_user_id($user_id);

        $zone_ids = [];
        foreach ($data['zone_permissions'] as $permission) {
            if (isset($permission['zone_id'])) {
                $decoded_ids = json_decode($permission['zone_id'], true);
                if (is_array($decoded_ids)) {
                    $zone_ids = array_merge($zone_ids, $decoded_ids);
                }
            }
        }

        $zone_ids = array_unique($zone_ids);

        // Get basic DataTables parameters
        $draw = $this->input->post('draw');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search');
        $order = $this->input->post('order');

        // Get filter parameters
        $filters = array(
            'Sales_Code' => $this->input->post('Sales_Code'),
            'Distribution_Channel_Code' => $this->input->post('Distribution_Channel_Code'),
            'Division_Code' => $this->input->post('Division_Code'),
            'Customer_Type_Code' => $this->input->post('Customer_Type_Code'),
            'Customer_Group_Code' => $this->input->post('Customer_Group_Code'),
            'Population_Strata_2' => $this->input->post('Population_Strata_2'),
            'Zone' => $this->input->post('Zone')
        );

        // Remove null/empty values from filters
        $filters = array_filter($filters, function ($value) {
            return $value !== null && $value !== '';
        });

        // Fetch dynamic sortable columns
        $sortable_columns = $this->get_table_columns('distributors');

        // Extract sorting information
        if (isset($order[0])) {
            $order_column_index = isset($order[0]['column']) ? $order[0]['column'] : 0;
            $order_direction = isset($order[0]['dir']) ? $order[0]['dir'] : 'asc';
        } else {
            $order_column_index = 0;
            $order_direction = 'asc';
        }
        $order_column = isset($sortable_columns[$order_column_index]) ? $sortable_columns[$order_column_index] : '';

        // Get total records with filters
        $total_get_distributors = $this->Distributor_model->getTotal_distributors($search, $zone_ids, $filters);

        // Get filtered records
        $distributors_s = $this->Distributor_model->get_distributors($start, $length, $search, $zone_ids, $order_column, $order_direction, $filters);

        $data = array();
        foreach ($distributors_s->result() as $AS_distributors) {
            $row = [];
            foreach ($sortable_columns as $column) {
                $row[] = isset($AS_distributors->$column) ? $AS_distributors->$column : '';
            }
            $data[] = array(
                $AS_distributors->id,

                $AS_distributors->Customer_Name,
                $AS_distributors->Customer_Code,
                $AS_distributors->Pin_Code,
                $AS_distributors->City,
                $AS_distributors->District,
                $AS_distributors->Contact_Number,
                $AS_distributors->Country,
                $AS_distributors->Zone,
                $AS_distributors->State,
                $AS_distributors->Population_Strata_1,
                $AS_distributors->Population_Strata_2,
                $AS_distributors->Country_Group,
                $AS_distributors->GTM_TYPE,
                $AS_distributors->SUPERSTOCKIST,
                $AS_distributors->STATUS,
                $AS_distributors->Customer_Type_Name,
                $AS_distributors->Customer_Type_Code,
                $AS_distributors->Sales_Name,
                $AS_distributors->Sales_Code,
                $AS_distributors->Customer_Group_Name,
                $AS_distributors->Customer_Group_Code,
                $AS_distributors->Customer_Creation_Date,
                $AS_distributors->Division_Name,
                $AS_distributors->Division_Code,
                $AS_distributors->Sector_Name,
                $AS_distributors->Sector_Code,
                $AS_distributors->State_Code,
                $AS_distributors->Zone_Code,
                $AS_distributors->Distribution_Channel_Code,
                $AS_distributors->Distribution_Channel_Name,
            );
        }

        $output = array(
            'draw' => $draw,
            'recordsTotal' => $total_get_distributors,
            'recordsFiltered' => $total_get_distributors,
            'data' => $data,
            'columns' => $sortable_columns
        );

        echo json_encode($output);
        exit();
    }





    public function InactiveDistributors()
    {
        $user_id = $this->session->userdata('back_user_id');

        if (!$user_id) {
            redirect('admin/login');
        }

        $data['user'] = $this->Role_model->get_user_by_id($user_id);
        $data['permissions'] = $data['user'] ? $this->Role_model->get_permissions_by_role($user_id) : [];
        $has_view_permission = false;

        foreach ($data['permissions'] as $permission) {
            if ($permission['module_name'] === 'Masters' && $permission['view'] === 'yes') {
                $has_view_permission = true;
                break;
            }
        }

        if (!$has_view_permission) {
            echo "<h3>Access Denied: You do not have permission to view this page.</h3>";
            exit;
        }

        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';

        // Load views
        $this->load->view('admin/header', $data);
        $this->load->view('admin/Inactive-Distributors', $data);
        $this->load->view('admin/footer', $data);
    }



    public function distributors()
    {
        $user_id = $this->session->userdata('back_user_id');

        if (!$user_id) {
            redirect('admin/login');
        }

        $data['user'] = $this->Role_model->get_user_by_id($user_id);
        $data['permissions'] = $data['user'] ? $this->Role_model->get_permissions_by_role($user_id) : [];
        $has_view_permission = false;

        foreach ($data['permissions'] as $permission) {
            if ($permission['module_name'] === 'Masters' && $permission['view'] === 'yes') {
                $has_view_permission = true;
                break;
            }
        }

        if (!$has_view_permission) {
            echo "<h3>Access Denied: You do not have permission to view this page.</h3>";
            exit;
        }

        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';

        // Load views
        $this->load->view('admin/header', $data);
        $this->load->view('admin/distributors', $data);
        $this->load->view('admin/footer', $data);
    }





    public function salesorg()
    {



        $user_id = $this->session->userdata('back_user_id');

        if (!$user_id) {

            redirect('admin/login');
        }

        $data['sales'] = $this->Distributor_model->get_unique_Sales_Name();


        if ($user_id) {
            $data['user'] = $this->Role_model->get_user_by_id($user_id);
            if ($data['user']) {

                $role_id = $data['user']['role_id'];
                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
        }


        $has_view_permission = false;

        foreach ($data['permissions'] as $permission) {
            if ($permission['module_name'] === 'Masters' && $permission['view'] === 'yes') {
                $has_view_permission = true;
                break;
            }
        }

        if (!$has_view_permission) {
            echo "<h3>Access Denied: You do not have permission to view this page.</h3>";
            exit;
        }

        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';


        $this->load->view('admin/header', $data);
        $this->load->view('admin/salesorg');
        $this->load->view('admin/footer', $data);
    }


    public function distributionchannel()
    {

        $user_id = $this->session->userdata('back_user_id');

        if (!$user_id) {

            redirect('admin/login');
        }
        $data['distributionchannel'] = $this->Distributor_model->get_unique_Distribution_Channel_Name();
        if ($user_id) {
            $data['user'] = $this->Role_model->get_user_by_id($user_id);
            if ($data['user']) {

                $role_id = $data['user']['role_id'];
                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
        }


        $has_view_permission = false;

        foreach ($data['permissions'] as $permission) {
            if ($permission['module_name'] === 'Masters' && $permission['view'] === 'yes') {
                $has_view_permission = true;
                break;
            }
        }

        if (!$has_view_permission) {
            echo "<h3>Access Denied: You do not have permission to view this page.</h3>";
            exit;
        }

        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/distributionchannel');
        $this->load->view('admin/footer', $data);
    }


    public function division()
    {
        $user_id = $this->session->userdata('back_user_id');

        if (!$user_id) {

            redirect('admin/login');
        }


        $data['division'] = $this->Distributor_model->get_unique_Division_Name();
        if ($user_id) {
            $data['user'] = $this->Role_model->get_user_by_id($user_id);
            if ($data['user']) {

                $role_id = $data['user']['role_id'];
                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
        }


        $has_view_permission = false;

        foreach ($data['permissions'] as $permission) {
            if ($permission['module_name'] === 'Masters' && $permission['view'] === 'yes') {
                $has_view_permission = true;
                break;
            }
        }

        if (!$has_view_permission) {
            echo "<h3>Access Denied: You do not have permission to view this page.</h3>";
            exit;
        }

        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';

        // print_r($data);
        // die();


        $this->load->view('admin/header', $data);
        $this->load->view('admin/division', $data);
        $this->load->view('admin/footer', $data);
    }






    public function division_Ajex_Load_Data()
    {
        $draw = $this->input->get('draw');
        $start = $this->input->get('start');
        $length = $this->input->get('length');
        $search = $this->input->get('search');

        // Check if search is received
        //log_message('debug', 'Search term: ' . $search);

        $total_get_division = $this->Distributor_model->getTotal_division($search);
        $division_s = $this->Distributor_model->get_division($start, $length, $search);

        $data = array();
        $sr_number = $start + 1; // Initialize serial number based on the starting record

        foreach ($division_s->result() as $AS_division) {
            $data[] = array(
                $sr_number++, // Serial number
                $AS_division->Division_Code,
                $AS_division->Division_Name
            );
        }

        $output = array(
            'draw' => intval($draw),
            'recordsTotal' => $total_get_division,
            'recordsFiltered' => $total_get_division,
            'data' => $data
        );

        echo json_encode($output);
        exit();
    }




    public function producthierarchy()
    {

        $user_id = $this->session->userdata('back_user_id');

        if (!$user_id) {

            redirect('admin/login');
        }
        if ($user_id) {
            $data['user'] = $this->Role_model->get_user_by_id($user_id);
            if ($data['user']) {

                $role_id = $data['user']['role_id'];
                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
        }

        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';

        $this->load->view('admin/header', $data);

        $this->load->view('admin/producthierarchy');
        $this->load->view('admin/footer', $data);
    }


    public function gcpdata()
    {
        $user_id = $this->session->userdata('back_user_id');

        if (!$user_id) {
            redirect('admin/login');
            return;
        }


        $data['division'] = $this->Distributor_model->get_unique_Division_Name();
        if ($user_id) {
            $data['user'] = $this->Role_model->get_user_by_id($user_id);
            if ($data['user']) {

                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
        }


        $has_view_permission = false;

        foreach ($data['permissions'] as $permission) {
            if ($permission['module_name'] === 'Masters' && $permission['view'] === 'yes') {
                $has_view_permission = true;
                break;
            }
        }

        if (!$has_view_permission) {
            echo "<h3>Access Denied: You do not have permission to view this page.</h3>";
            exit;
        }


        $data['user'] = $this->Role_model->get_user_by_id($user_id);
        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/gcpdata', $data);
        $this->load->view('admin/footer', $data);
    }



    public function hierarchydata()
    {

        $user_id = $this->session->userdata('back_user_id');


        if (!$user_id) {
            redirect('admin/login');
            return;
        }
        $data['maping'] = $this->Maping_model->get_all_Maping_data();
        $data['zone_permissions'] = $this->Zone_model->get_zone_permissions_by_user_id($user_id);


        $data['Sales_Code'] = $this->Distributor_model->get_unic_Sales_Code();
        $data['Distribution_Channel_Code'] = $this->Distributor_model->get_unic_Distribution_Channel_Code();
        $data['Division_Code'] = $this->Distributor_model->get_unic_Division_Code();
        $data['Customer_Type_Code'] = $this->Distributor_model->get_unic_Customer_Type_Code();
        $data['Customer_Group_Code'] = $this->Distributor_model->get_unic_Customer_Group_Code();
        $data['Customer_Code'] = $this->Distributor_model->get_unic_Customer_Code();
        $zone_ids = [];
        foreach ($data['zone_permissions'] as $permission) {
            if (isset($permission['zone_id'])) {

                $decoded_ids = json_decode($permission['zone_id'], true);
                if (is_array($decoded_ids)) {
                    $zone_ids = array_merge($zone_ids, $decoded_ids);
                }
            }
        }


        $zone_ids = array_unique($zone_ids);
        $filtered_maping = array_filter($data['maping'], function ($item) use ($zone_ids) {
            return in_array($item['Zone_Code'], $zone_ids);
        });
        $data['maping'] = $filtered_maping;
        $data['user'] = $this->Role_model->get_user_by_id($user_id);

        if ($user_id) {
            $data['user'] = $this->Role_model->get_user_by_id($user_id);
            if ($data['user']) {

                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
        }

        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';
        $this->load->view('admin/header', $data);
        $this->load->view('admin/hierarchydata', $data);
        $this->load->view('admin/footer', $data);
    }



    public function hierarchydata__()
    {
        $user_id = $this->session->userdata('back_user_id');

        if (!$user_id) {
            redirect('admin/login');
            return;
        }

        // Fetch the data
        $data['maping'] = $this->Maping_model->get_all_Maping_data();
        $data['zone_permissions'] = $this->Zone_model->get_zone_permissions_by_user_id($user_id);
        $data['Sales_Code'] = $this->Distributor_model->get_unique_Sales_Name();
        $data['Distribution_Channel_Code'] = $this->Distributor_model->get_unic_Distribution_Channel_Code();
        $data['Division_Code'] = $this->Distributor_model->get_unic_Division_Code();
        $data['Customer_Type_Code'] = $this->Distributor_model->get_unic_Customer_Type_Code();
        $data['Customer_Group_Code'] = $this->Distributor_model->get_unic_Customer_Group_Code();
        $data['Customer_Code'] = $this->Distributor_model->get_unic_Customer_Code();

        // Log the Sales_Code data for debugging

        // Process zone permissions
        $zone_ids = [];
        foreach ($data['zone_permissions'] as $permission) {
            if (isset($permission['zone_id'])) {
                $decoded_ids = json_decode($permission['zone_id'], true);
                if (is_array($decoded_ids)) {
                    $zone_ids = array_merge($zone_ids, $decoded_ids);
                }
            }
        }

        // Remove duplicate zone IDs
        $zone_ids = array_unique($zone_ids);

        $filtered_maping = array_filter($data['maping'], function ($item) use ($zone_ids) {
            return in_array($item['Zone_Code'], $zone_ids);
        });
        $data['maping'] = $filtered_maping;

        $data['user'] = $this->Role_model->get_user_by_id($user_id);
        if ($user_id) {
            if ($data['user']) {
                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
        }

        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';

        // echo json_encode($data['permissions']);
        // die();


        // Load views
        $this->load->view('admin/header', $data);
        $this->load->view('admin/UserMovement', $data);
        $this->load->view('admin/footer', $data);
    }








    public function hierarchydata_AJEX_LOAD()
    {

        header('Content-Type: application/json');
        $user_id = $this->session->userdata('back_user_id');
        if (!$user_id) {
            redirect('admin/login');
            return;
        }
        $data['maping'] = $this->Maping_model->get_all_Maping_data();
        $data['zone_permissions'] = $this->Zone_model->get_zone_permissions_by_user_id($user_id);
        $data['Sales_Code'] = $this->Distributor_model->get_unic_Sales_Code();
        $data['Distribution_Channel_Code'] = $this->Distributor_model->get_unic_Distribution_Channel_Code();
        $data['Division_Code'] = $this->Distributor_model->get_unic_Division_Code();
        $data['Customer_Type_Code'] = $this->Distributor_model->get_unic_Customer_Type_Code();
        $data['Customer_Group_Code'] = $this->Distributor_model->get_unic_Customer_Group_Code();
        $data['Customer_Code'] = $this->Distributor_model->get_unic_Customer_Code();

        // Extract zone_ids from zone_permissions
        $zone_ids = [];
        foreach ($data['zone_permissions'] as $permission) {
            if (isset($permission['zone_id'])) {
                // Decode JSON string to PHP array
                $decoded_ids = json_decode($permission['zone_id'], true);
                if (is_array($decoded_ids)) {
                    $zone_ids = array_merge($zone_ids, $decoded_ids);
                }
            }
        }

        // Remove any duplicate zone IDs
        $zone_ids = array_unique($zone_ids);


        // Filter maping data based on zone_ids
        $filtered_maping = array_filter($data['maping'], function ($item) use ($zone_ids) {
            return in_array($item['Zone_Code'], $zone_ids);
        });


        // Assign filtered maping data to the data array
        $data['maping'] = $filtered_maping;

        // Fetch user details and permissions
        $data['user'] = $this->Role_model->get_user_by_id($user_id);

        if ($user_id) {
            $data['user'] = $this->Role_model->get_user_by_id($user_id);
            if ($data['user']) {
                // Fetch permissions based on the user's role
                // $role_id = $data['user']['role_id'];
                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null; // No user data if no user_id is provided
            $data['permissions'] = [];
        }

        echo json_encode($data);
    }






    public function hierarchyedit()
    {
        $back_user_id = $this->session->userdata('back_user_id');

        if (!$back_user_id) {
            redirect('admin/login');
        }

        $id = $this->input->get('id');
        $customer_name = urldecode($this->input->get('customer_name'));


        $data['customer_name'] = $customer_name;

        // Fetching the necessary data for mapping, employees, and distributors
        $data['mapping_db'] = $this->Maping_model->editmaping($id);
        $data['mapping'] = $this->Maping_model->get_all_Maping();
        $data['employees'] = $this->Employee_model->get_all_employees();

        // Fetching distributor-related codes
        $data['Sales_Code'] = $this->Distributor_model->get_unic_Sales_Code();
        $data['Distribution_Channel_Code'] = $this->Distributor_model->get_unic_Distribution_Channel_Code();
        $data['Division_Code'] = $this->Distributor_model->get_unic_Division_Code();
        $data['Customer_Type_Code'] = $this->Distributor_model->get_unic_Customer_Type_Code();
        $data['Customer_Group_Code'] = $this->Distributor_model->get_unic_Customer_Group_Code();
        $data['Customer_Code'] = $this->Distributor_model->get_unic_Customer_Code();

        // Fetch user data and permissions based on session user_id
        $user_id = $this->session->userdata('back_user_id');

        if ($user_id) {
            $data['user'] = $this->Role_model->get_user_by_id($user_id);
            if ($data['user']) {
                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
        }
        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';


        // Load the view and pass the $data array
        $this->load->view('admin/header', $data);
        $this->load->view('admin/mapingedit', $data);
        $this->load->view('admin/footer', $data);
    }



    public function update_maping()
    {

        $back_user_id = $this->session->userdata('back_user_id');
        if (!$back_user_id) {
            redirect('admin/login');
        }
        date_default_timezone_set('Asia/Kolkata'); // Example for Indian Standard Time (IST)


        $id = $this->input->post('id');

        $data = array(
            'DB_Code' => $this->input->post('DB_Code'),

            'Level_1' => $this->input->post('level1'),
            'Level_2' => $this->input->post('level2'),
            'Level_3' => $this->input->post('level3'),
            'Level_4' => $this->input->post('level4'),
            'Level_5' => $this->input->post('level5'),
            'Level_6' => $this->input->post('level6'),
            'Level_7' => $this->input->post('level7'),
            'update_date' => date('Y-m-d H:i:s')  // Add update date

        );

        if ($this->Maping_model->update_mapping($id, $data)) {
            $this->session->set_flashdata('success', 'Mapping updated successfully');
            redirect('admin/hierarchydata');
        } else {
            $this->session->set_flashdata('error', 'Failed to update mapping');
            redirect('admin/hierarchydata');
        }
    }



    public function hierarchydelete($id)
    {

        $back_user_id = $this->session->userdata('back_user_id');

        if (!$back_user_id) {

            redirect('admin/login');
        }
        $this->Maping_model->hierarchydelete($id);
        redirect('admin/hierarchydata');
    }




    public function report()
    {

        $user_id = $this->session->userdata('back_user_id');
        if (!$user_id) {

            redirect('admin/login');
        }

        if ($user_id) {
            $data['user'] = $this->Role_model->get_user_by_id($user_id);
            if ($data['user']) {

                $role_id = $data['user']['role_id'];
                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
        }
        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';

        $this->load->view('admin/header', $data);

        $this->load->view('admin/report');
        $this->load->view('admin/footer', $data);
    }


    public function cron()
    {

        $user_id = $this->session->userdata('back_user_id');

        if (!$user_id) {

            redirect('admin/login');
        }
        if ($user_id) {
            $data['user'] = $this->Role_model->get_user_by_id($user_id);
            if ($data['user']) {
                $role_id = $data['user']['role_id'];
                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
        }
        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';


        $this->load->view('admin/header', $data);

        $this->load->view('admin/cron', $data);
        $this->load->view('admin/footer', $data);
    }




    public function designation_create()
    {

        $user_id = $this->session->userdata('back_user_id');

        if (!$user_id) {

            redirect('admin/login');
        }
        if ($user_id) {
            $data['user'] = $this->Role_model->get_user_by_id($user_id);
            if ($data['user']) {
                $role_id = $data['user']['role_id'];
                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
        }
        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';


        $this->load->view('admin/header', $data);
        $this->load->view('admin/designation-create', $data);
        $this->load->view('admin/footer', $data);
    }



    public function designation_list()
    {
        $user_id = $this->session->userdata('back_user_id');

        // Redirect to login if user is not logged in
        if (!$user_id) {
            redirect('admin/login');
        }

        // Fetch user data and permissions
        if ($user_id) {
            $data['user'] = $this->Role_model->get_user_by_id($user_id);
            if ($data['user']) {
                $role_id = $data['user']['role_id'];
                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
        }

        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';

        // Fetch designations from the database
        $this->load->model('Designation_model'); // Load your Designation model
        $data['designations'] = $this->Designation_model->get_all_designations();

        // Load views
        $this->load->view('admin/header', $data);
        $this->load->view('admin/designation-list', $data);
        $this->load->view('admin/footer', $data);
    }



    public function designations_ajex()
    {
      
        $designation_id = $this->input->post('id'); 
        
        $this->load->model('Designation_model');
    
        if ($designation_id) {
            
            $designations = $this->Designation_model->get_designation_by_id($designation_id);
        } else {
         
            $designations = $this->Designation_model->get_all_designations();
        }
    
      
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($designations));
    }
    




    public function designation_edit($id = null)
    {
        $back_user_id = $this->session->userdata('back_user_id');

        // Redirect to login if user is not logged in
        if (!$back_user_id) {
            redirect('admin/login');
        }

        // Fetch user and permissions data
        if ($back_user_id) {
            $data['user'] = $this->Role_model->get_user_by_id($back_user_id);
            if ($data['user']) {
                $data['permissions'] = $this->Role_model->get_permissions_by_role($back_user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
        }

        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';

        // Load Designation Model
        $this->load->model('Designation_model');

        // Fetch existing designation data
        if ($id) {
            $data['designation'] = $this->Designation_model->get_designation_by_id($id);
            if (!$data['designation']) {
                $this->session->set_flashdata('message', 'Designation not found.');
                $this->session->set_flashdata('message_type', 'danger'); // 'danger' sets the alert color to red
                redirect('admin/designation-list');
            }
        } else {
            $data['designation'] = null;
        }

        // Load views
        $this->load->view('admin/header', $data);
        $this->load->view('admin/designation-edit', $data); // Form view for editing
        $this->load->view('admin/footer', $data);
    }

    public function designation_update()
    {
        $back_user_id = $this->session->userdata('back_user_id');

        // Redirect to login if user is not logged in
        if (!$back_user_id) {
            redirect('admin/login');
        }

        // Load Designation Model
        $this->load->model('Designation_model');

        // Get form data
        $id = $this->input->post('id');
        $designation_name = $this->input->post('Designation');
        $designation_label = $this->input->post('Designation_Label');

        // Validate input
        if (empty($designation_name) || empty($designation_label)) {
            $this->session->set_flashdata('message', 'All fields are required.');
            $this->session->set_flashdata('message_type', 'danger'); // 'danger' sets the alert color to red
            redirect('admin/designation-edit/' . $id);
        }

        // Prepare data to update
        $data = [
            'Designation' => $designation_name,
            'Designation_Label' => $designation_label,
        ];

        // Update the designation
        $updated = $this->Designation_model->update_designation($id, $data);

        if ($updated) {
            $this->session->set_flashdata('message', 'Designation updated successfully.');
            $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', 'Failed to update designation.');
            $this->session->set_flashdata('message_type', 'danger'); // 'danger' sets the alert color to red
        }

        redirect('admin/designation-list');
    }





    public function designation_save()
    {
        // Check if the user is logged in
        $user_id = $this->session->userdata('back_user_id');
        if (!$user_id) {
            redirect('admin/login');
        }

        // Load Designation model
        $this->load->model('Designation_model');

        // Get form input data
        $designation_name = $this->input->post('Designation');
        $designation_label = $this->input->post('Designation_Label');

        // Validate input data
        if (empty($designation_name) || empty($designation_label)) {
            // Flash an error message if fields are empty
            $this->session->set_flashdata('message', 'Both fields are required.');
            $this->session->set_flashdata('message_type', 'danger'); // 'danger' sets the alert color to red
            redirect('admin/designation-create');  // Redirect to the create form if validation fails
        }

        // Check if the designation already exists
        $existing_designation = $this->Designation_model->get_designation_by_name($designation_name);
        if ($existing_designation) {
            // If the designation exists, flash an error message and redirect
            $this->session->set_flashdata('message', 'Designation name already exists.');
            $this->session->set_flashdata('message_type', 'danger'); // 'danger' sets the alert color to red
            redirect('admin/designation-create');  // Redirect to the create form if designation already exists
        }

        // Prepare data to insert
        $data = [
            'Designation' => $designation_name,
            'Designation_Label' => $designation_label,
        ];

        // Save the designation in the database
        $inserted = $this->Designation_model->save_designation($data);

        if ($inserted) {
            // If inserted successfully, flash a success message
            $this->session->set_flashdata('message', 'Designation added successfully.');
            $this->session->set_flashdata('message_type', 'success');
        } else {
            // If failed to insert, flash an error message
            $this->session->set_flashdata('message', 'Failed to add designation. Please try again.');
            $this->session->set_flashdata('message_type', 'danger'); // 'danger' sets the alert color to red
        }

        // Redirect to the designation list
        redirect('admin/designation-list');
    }





    public function designationdelete($id)
    {
        // Check if the user is logged in
        $back_user_id = $this->session->userdata('back_user_id');
        if (!$back_user_id) {
            redirect('admin/login');
        }

        // Load the required model
        $this->load->model('Designation_model');

        $this->db->where('id', $id);
        $zone_deleted = $this->db->delete('designations');

        // Delete the role using the Role model
        $role_deleted = $this->Role_model->delete_role($id);

        // Handle success or failure messages
        if ($zone_deleted && $role_deleted) {
            $this->session->set_flashdata('message', 'Designation  successfully deleted.');
            $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', 'Failed to delete designation. Please try again.');
            $this->session->set_flashdata('message_type', 'danger'); // 'danger' sets the alert color to red
        }

        // Redirect back to the role listing page
        redirect('admin/designation-list');
    }





    public function ajex_method_filter()
    {
        $salesCode = $this->input->post('Sales_Code');
        $customerTypeCode = $this->input->post('Customer_Type_Code');
        $customerGroupCode = $this->input->post('Customer_Group_Code');
        $divisionCode = $this->input->post('Division_Code');
        $distributionChannelCode = $this->input->post('Distribution_Channel_Code');

        // Query the database based on the selected values
        //  $maping = $this->Maping_model->get_all_Maping_data_filter($salesCode, $customerTypeCode, $customerGroupCode, $divisionCode, $distributionChannelCode);

        // Generate table rows HTML
        echo json_encode($salesCode);
    }




    public function geography()
    {

        $user_id = $this->session->userdata('back_user_id');
        if (!$user_id) {
            redirect('admin/login');
            return;
        }
        $data['maping'] = $this->Maping_model->get_all_Maping_data();
        $data['zone_permissions'] = $this->Zone_model->get_zone_permissions_by_user_id($user_id);
        $data['Sales_Code'] = $this->Distributor_model->get_unic_Sales_Code();
        $data['Distribution_Channel_Code'] = $this->Distributor_model->get_unic_Distribution_Channel_Code();
        $data['Division_Code'] = $this->Distributor_model->get_unic_Division_Code();
        $data['Customer_Type_Code'] = $this->Distributor_model->get_unic_Customer_Type_Code();
        $data['Customer_Group_Code'] = $this->Distributor_model->get_unic_Customer_Group_Code();
        $data['Customer_Code'] = $this->Distributor_model->get_unic_Customer_Code();


        $zone_ids = [];
        foreach ($data['zone_permissions'] as $permission) {
            if (isset($permission['zone_id'])) {

                $decoded_ids = json_decode($permission['zone_id'], true);
                if (is_array($decoded_ids)) {
                    $zone_ids = array_merge($zone_ids, $decoded_ids);
                }
            }
        }


        $zone_ids = array_unique($zone_ids);
        $filtered_maping = array_filter($data['maping'], function ($item) use ($zone_ids) {
            return in_array($item['Zone_Code'], $zone_ids);
        });

        $data['maping'] = $filtered_maping;
        $data['user'] = $this->Role_model->get_user_by_id($user_id);

        if ($user_id) {
            $data['user'] = $this->Role_model->get_user_by_id($user_id);
            if ($data['user']) {

                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
        }
        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';


        $this->load->view('admin/header', $data);
        $this->load->view('admin/geography', $data);
        $this->load->view('admin/footer', $data);
    }

    public function geographyajex()
    {
        header('Content-Type: application/json');

        $user_id = $this->session->userdata('back_user_id');
        if (!$user_id) {
            redirect('admin/login');
            return;
        }

        // Pagination parameters
        $draw = $this->input->POST('draw');
        $start = $this->input->POST('start', TRUE);
        $length = $this->input->POST('length', TRUE);
        $search = $this->input->POST('search', TRUE);

        // Sorting parameters
        $order_column_index = $this->input->POST('order[0][column]', TRUE);
        $order_dir = $this->input->POST('order[0][dir]', TRUE);
        $order_column_index = isset($order_column_index) ? (int) $order_column_index : 0; // Default to the first column
        $order_dir = isset($order_dir) ? $order_dir : 'asc'; // Default to ascending

        // Map column index to the database field
        $columns = [
            'Customer_Name',
            'Customer_Code',
            'Pin_Code',
            'City',
            'District',
            'Contact_Number',
            'Country',
            'Zone',
            'State',
            'Population_Strata_1',
            'Population_Strata_2',
            'Country_Group',
            'GTM_TYPE',
            'SUPERSTOCKIST',
            'STATUS',
            'Customer_Type_Name',
            'Customer_Type_Code',
            'Sales_Name',
            'Sales_Code',
            'Customer_Group_Name',
            'Customer_Group_Code',
            'Customer_Creation_Date',
            'Division_Name',
            'Division_Code',
            'Sector_Name',
            'Sector_Code',
            'State_Code',
            'Zone_Code',
            'Distribution_Channel_Code',
            'Distribution_Channel_Name',
        ];
        $order_column_name = isset($columns[$order_column_index]) ? $columns[$order_column_index] : 'Sales_Code';

        // Fetch filtering criteria
        $filters = [
            'Sales_Code' => $this->input->post('Sales_Code') ?: [],
            'Distribution_Channel_Code' => $this->input->post('Distribution_Channel_Code') ?: [],
            'Division_Code' => $this->input->post('Division_Code') ?: [],
            'Customer_Type_Code' => $this->input->post('Customer_Type_Code') ?: [],
            'Customer_Group_Code' => $this->input->post('Customer_Group_Code') ?: [],
            'Population_Strata_2' => $this->input->post('Population_Strata_2') ?: [],
            'Zone_Code' => $this->input->POST('Zone') ?: [],
            'State_Code' => $this->input->POST('State_Code') ?: [],
            'City' => $this->input->POST('City') ?: [],
        ];

        // Fetch all data with filters
        $all_mapping_data = $this->Maping_model->get_maping_d_count($search, $filters);
        $maping_data = $this->Maping_model->get_maping_d($start, $length, $search, $filters, $order_column_name, $order_dir);

        // Apply unique filtering (as in your earlier implementation)
        $unique_data = [];
        foreach ($maping_data as $item) {
            $unique_key = implode('|', [
                $item['Sales_Code'],
                $item['Distribution_Channel_Code'],
                $item['Distribution_Channel_Name'],
                $item['Division_Code'],
                $item['Division_Name'],
                $item['Customer_Type_Code'],
                $item['Customer_Type_Name'],
                $item['Zone_Code'],
                $item['Zone'],
                $item['State_Code'],
                $item['State'],
                $item['City'],
                $item['Customer_Group_Code'],
                $item['Customer_Group_Name'],
                $item['Population_Strata_2']
            ]);

            if (!isset($unique_data[$unique_key])) {
                $unique_data[$unique_key] = [
                    'Sales_Code' => $item['Sales_Code'],
                    'Sales_Name' => $item['Sales_Name'],
                    'Distribution_Channel_Code' => $item['Distribution_Channel_Code'],
                    'Distribution_Channel_Name' => $item['Distribution_Channel_Name'],
                    'Division_Code' => $item['Division_Code'],
                    'Division_Name' => $item['Division_Name'],
                    'Customer_Type_Code' => $item['Customer_Type_Code'],
                    'Zone_Code' => $item['Zone_Code'],
                    'Zone' => $item['Zone'],
                    'State_Code' => $item['State_Code'],
                    'State' => $item['State'],
                    'City' => $item['City'],
                    'Customer_Type_Name' => $item['Customer_Type_Name'],
                    'Customer_Group_Code' => $item['Customer_Group_Code'],
                    'Customer_Group_Name' => $item['Customer_Group_Name'],
                    'Population_Strata_2' => $item['Population_Strata_2']
                ];
            }
        }

        $unique_data = array_values($unique_data);

        // Prepare response
        $response = [
            'draw' => $draw,
            'recordsTotal' => count($all_mapping_data),
            'recordsFiltered' => count($all_mapping_data),
            'data' => $maping_data,
            'filter' => $unique_data
        ];

        echo json_encode($response);
    }








    public function hierarchydata_ajex()
    {
        // Enable logging

        header('Content-Type: application/json');

        // Ensure user is logged in
        $user_id = $this->session->userdata('back_user_id');
        if (!$user_id) {
            log_message('error', 'User not logged in. Redirecting to login.');
            redirect('admin/login');
            return;
        }

        $draw = $this->input->post('draw');
        $start = $this->input->post('start', TRUE);
        $length = $this->input->post('length', TRUE);
        $search = $this->input->post('search', TRUE);

        // Log input parameters

        // Get the column index and sorting direction
        $order_column_index = $this->input->post('order[0][column]', TRUE);  // Column index for sorting
        $order_dir = $this->input->post('order[0][dir]', TRUE);  // Sorting direction (asc/desc)



        // Map the column index to the actual column name
        $columns = [
            'Customer_Name',
            'Customer_Code',
            'Pin_Code',
            'City',
            'District',
            'Contact_Number',
            'Country',
            'Zone',
            'State',
            'Population_Strata_1',
            'Population_Strata_2',
            'Country_Group',
            'GTM_TYPE',
            'SUPERSTOCKIST',
            'STATUS',
            'Customer_Type_Name',
            'Customer_Type_Code',
            'Sales_Name',
            'Sector_Code',
            'Sales_Code',
            'Customer_Group_Name',
            'Customer_Group_Code',
            'Customer_Creation_Date',
            'Division_Name',
            'Division_Code',
            'State_Code',
            'Zone_Code',
            'Distribution_Channel_Code',
            'Distribution_Channel_Name',
            'Sector_Name',
        ];



        // Check if the index is valid


        $order_column = isset($columns[$order_column_index]) ? $columns[$order_column_index] : 'Sales_Code'; // Default sorting by 'name'

        // Apply sorting direction validation (either 'asc' or 'desc')
        if (!in_array($order_dir, ['asc', 'desc'])) {
            $order_dir = 'asc';  // Default to 'asc' if an invalid direction is passed
        }

        // Log sort parameters

        // Filters for mapping data
        $filters = [
            'Sales_Code' => $this->input->post('Sales_Code') ?: [],
            'Distribution_Channel_Code' => $this->input->post('Distribution_Channel_Code') ?: [],
            'Division_Code' => $this->input->post('Division_Code') ?: [],
            'Customer_Type_Code' => $this->input->post('Customer_Type_Code') ?: [],
            'Customer_Group_Code' => $this->input->post('Customer_Group_Code') ?: [],
            'Population_Strata_2' => $this->input->post('Population_Strata_2') ?: []
        ];

        // Log filters

        // Get the total count for mapping data
        $all_mapping_data = $this->Maping_model->get_maping_d_count($search, $filters);
        $maping_data = $this->Maping_model->get_maping_d($start, $length, $search, $filters, $order_column, $order_dir);



        // Ensure unique filtering logic
        $unique_data = [];
        foreach ($maping_data as $item) {
            $unique_key = implode('|', [
                $item['Sales_Code'],
                $item['Distribution_Channel_Code'],
                $item['Distribution_Channel_Name'],
                $item['Division_Code'],
                $item['Division_Name'],
                $item['Customer_Type_Code'],
                $item['Customer_Type_Name'],
                $item['Zone_Code'],
                $item['Zone'],
                $item['State_Code'],
                $item['State'],
                $item['City'],
                $item['Customer_Group_Code'],
                $item['Customer_Group_Name'],
                $item['Population_Strata_2']
            ]);

            if (!isset($unique_data[$unique_key])) {
                $unique_data[$unique_key] = [
                    'Sales_Code' => $item['Sales_Code'],
                    'Sales_Name' => $item['Sales_Name'],
                    'Distribution_Channel_Code' => $item['Distribution_Channel_Code'],
                    'Distribution_Channel_Name' => $item['Distribution_Channel_Name'],
                    'Division_Code' => $item['Division_Code'],
                    'Division_Name' => $item['Division_Name'],
                    'Customer_Type_Code' => $item['Customer_Type_Code'],
                    'Zone_Code' => $item['Zone_Code'],
                    'Zone' => $item['Zone'],
                    'State_Code' => $item['State_Code'],
                    'State' => $item['State'],
                    'City' => $item['City'],
                    'Customer_Type_Name' => $item['Customer_Type_Name'],
                    'Customer_Group_Code' => $item['Customer_Group_Code'],
                    'Customer_Group_Name' => $item['Customer_Group_Name'],
                    'Population_Strata_2' => $item['Population_Strata_2']
                ];
            }
        }

        // Convert the unique data to values
        $unique_data = array_values($unique_data);


        // Prepare response
        $response = [
            'draw' => $draw,
            'recordsTotal' => count($all_mapping_data),
            'recordsFiltered' => count($all_mapping_data),
            'data' => $maping_data,
            'filter' => $unique_data
        ];

        echo json_encode($response);
    }













    public function replacedataajex()
    {
        $user_id = $this->session->userdata('back_user_id');
        if (!$user_id) {
            redirect('admin/login');
        }

        $pjp_code = $this->input->get('pjp_code') ?? null;
        $level = $this->input->get('employee_level') ?? null;
        $search = $this->input->get('search') ?? ''; // Search keyword
        $limit = $this->input->get('limit') ?? 10; // Default 10 records per page
        $page = $this->input->get('page') ?? 1; // Default first page
        $offset = ($page - 1) * $limit;




        if ($pjp_code && $level) {
            $result = $this->Maping_model->get_db_code_by_pjp_and_level($pjp_code, $level, $limit, $offset, $search);
            $total_records = $this->Maping_model->get_total_records($pjp_code, $level, $search);
            $common_records = $this->Maping_model->get_common_records($pjp_code, $level); // Get total records

        } else {
            $result = [];
            $total_records = 0;
        }

        $response = [
            'Distributor_data' => $result,
            'common_records' => $common_records,

            'total_records' => $total_records,
            'limit' => $limit,
            'page' => $page,
            'total_pages' => ceil($total_records / $limit)
        ];

        echo json_encode($response);
    }









    public function zonewisegetdata_ajex()
    {
        header('Content-Type: application/json');

        $user_id = $this->session->userdata('back_user_id');
        if (!$user_id) {
            redirect('admin/login');
            return;
        }

        // Retrieve POST parameters
        $itemCode = $this->input->post('itemCode') ?? null;
        $level = $this->input->post('level') ?? null;
        $maping_data = $this->Maping_model->get_all_Maping_data_zone();

        $zone_permissions = $this->Zone_model->get_zone_permissions_by_user_id($user_id);

        $zone_ids = [];
        foreach ($zone_permissions as $permission) {
            if (isset($permission['zone_id'])) {
                $decoded_ids = json_decode($permission['zone_id'], true);
                if (is_array($decoded_ids)) {
                    $zone_ids = array_merge($zone_ids, $decoded_ids);
                }
            }
        }
        $zone_ids = array_unique($zone_ids);

        if (!empty($itemCode) && !empty($level)) {
            $filtered_maping = array_filter($maping_data, function ($item) use ($zone_ids, $itemCode, $level) {
                $zoneMatch = empty($zone_ids) || in_array($item['Zone_Code'], $zone_ids);
                $levelField = 'Level_' . intval($level);

                return $zoneMatch && ($item['DB_Code'] == $itemCode) && !empty($item[$levelField]);
            });
        } else {
            $filtered_maping = array_filter($maping_data, function ($item) use ($zone_ids) {
                return empty($zone_ids) || in_array($item['Zone_Code'], $zone_ids);
            });
        }

        $user = $this->Role_model->get_user_by_id($user_id);
        $permissions = $user ? $this->Role_model->get_permissions_by_role($user['role_id']) : [];


        $response = [
            'maping' => $filtered_maping,
            'user' => $user,
            'permissions' => $permissions
        ];

        echo json_encode($response);
    }

    public function mapinginactive()
    {


        $user_id = $this->session->userdata('back_user_id');

        if (!$user_id) {

            redirect('admin/login');
        }

        if ($user_id) {
            $data['user'] = $this->Role_model->get_user_by_id($user_id);
            if ($data['user']) {

                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
        }

        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/mapinginactive', $data);
        $this->load->view('admin/footer', $data);
    }

    public function fetchInactiveMappings()
    {
        if ($this->input->is_ajax_request()) {
            $search = $this->input->post('search')['value'] ?? '';
            $orderColumnIndex = $this->input->post('order')[0]['column'] ?? 0;
            $orderDirection = $this->input->post('order')[0]['dir'] ?? 'asc';
            $length = $this->input->post('length') ?? 10; // Records per page
            $start = $this->input->post('start') ?? 0; // Offset

            $dataTableData = $this->Role_model->getInactiveMappings($search, $orderColumnIndex, $orderDirection, $length, $start);

            $response = [
                'draw' => intval($this->input->post('draw')), // DataTables draw count
                'recordsTotal' => $this->Role_model->getTotalRecords(), // Total records in the database
                'recordsFiltered' => $this->Role_model->getFilteredRecords($search), // Filtered records count
                'data' => $dataTableData,
            ];

            echo json_encode($response);
            exit;
        } else {
            show_error('Invalid request', 400);
        }
    }
}
