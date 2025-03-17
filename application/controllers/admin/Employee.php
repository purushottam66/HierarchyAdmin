<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Role_model');
        $this->load->model('Employee_model');
        $this->load->library('email');

        $this->load->model('Maping_model');
        $this->load->model('Zone_model');
        $this->load->model('Distributor_model');
    }
    public function Employee()
    {

        $back_user_id = $this->session->userdata('back_user_id');

        if (!$back_user_id) {

            redirect('admin/login');
        }

        $data['level'] = $this->Employee_model->get_all_levels();
        $data['designation'] = $this->Employee_model->get_all_designations();
        $data['unique_State'] = array_column($this->Distributor_model->get_unique_State(), 'State');


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




        $has_view_permission = false;

        foreach ($data['permissions'] as $permission) {
            if ($permission['module_name'] === 'User Manager' && $permission['view'] === 'yes') {
                $has_view_permission = true;
                break;
            }
        }

        if (!$has_view_permission) {
            echo "<h3>Access Denied: You do not have permission to view this page.</h3>";
            exit;
        }
        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';


        $hasPermission = false;
        if (!empty($data['permissions']) && is_array($data['permissions'])) {
            foreach ($data['permissions'] as $p) {
                if ($p['module_name'] === "User Manager" && $p['view'] === "yes") {
                    $hasPermission = true;
                    break;
                }
            }
        }


        if (!$hasPermission) {
            print_r("You do not have permission to access this page.");
            return;
        }


        $this->load->view('admin/header', $data);
        $this->load->view('admin/Employee', $data);
        $this->load->view('admin/footer', $data);
    }



    public function emp_Left()
    {
        $back_user_id = $this->session->userdata('back_user_id');

        if (!$back_user_id) {
            redirect('admin/login');
        }

        $Emp_ids = [];
        for ($i = 1; $i <= 7; $i++) {
            $Emp_ids[$i] = $this->input->get('id' . $i);
        }

        $data['employees'] = [];
        foreach ($Emp_ids as $key => $Emp_id) {
            if ($Emp_id) {
                $data['employees'][$key] = $this->Employee_model->get_employees_by_Emp_id($Emp_id);
            }
        }



        //         $Emp_id1 = $this->input->get('id1');
        // $Emp_id2 = $this->input->get('id2');
        // $Emp_id3 = $this->input->get('id3');
        // $Emp_id4 = $this->input->get('id4');
        // $Emp_id5 = $this->input->get('id5');
        // $Emp_id6 = $this->input->get('id6');
        // $Emp_id7 = $this->input->get('id7');
        // $customer_name = $this->input->get('customer_name');

        // echo "Emp ID 1: " . $Emp_id1 . "<br>";
        // echo "Emp ID 2: " . $Emp_id2 . "<br>";
        // echo "Emp ID 3: " . $Emp_id3 . "<br>";
        // echo "Emp ID 4: " . $Emp_id4 . "<br>";
        // echo "Emp ID 5: " . $Emp_id5 . "<br>";
        // echo "Emp ID 6: " . $Emp_id6 . "<br>";
        // echo "Emp ID 7: " . $Emp_id7 . "<br>";
        // echo "Customer Name: " . $customer_name . "<br>";



        // echo '<pre>';
        // print_r($data['employees']);
        // echo '</pre>';

        // die;


        $data['level'] = $this->Employee_model->get_all_levels();
        $data['designation'] = $this->Employee_model->get_all_designations();


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

        $data['Emp_id'] = $Emp_id;

        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';


        $hasPermission = false;
        if (!empty($data['permissions']) && is_array($data['permissions'])) {
            foreach ($data['permissions'] as $p) {
                if ($p['module_name'] === "User Movement" && $p['view'] === "yes") {
                    $hasPermission = true;
                    break;
                }
            }
        }


        if (!$hasPermission) {
            print_r("You do not have permission to access this page.");
            return;
        }

        $this->load->view('admin/header', $data);
        $this->load->view('admin/emp_Left', $data);
        $this->load->view('admin/footer', $data);
    }

    public function Save_Replace()
    {
        $back_user_id = $this->session->userdata('back_user_id');

        if (!$back_user_id) {
            redirect('admin/login');
        }

        $postData = $this->input->post();
        if (empty($postData['set_pjp_code']) || empty($postData['selectedEmployeesselectedValue'])) {
            echo json_encode(["status" => "error", "message" => "Required fields are missing (set_pjp_code or selectedEmployeesselectedValue)."]);
            return;
        }


        if (!empty($postData['DB_Code'])) {
            foreach ($postData['DB_Code'] as $db_code_json) {
                $db_code_data = json_decode($db_code_json, true);
                if ($db_code_data) {
                    $updateConditions = [
                        'DB_Code' => $db_code_data['Customer_Code'] ?? null,
                        'Sales_Code' => $db_code_data['Sales_Code'] ?? null,
                        'Distribution_Channel_Code' => $db_code_data['Distribution_Channel_Code'] ?? null,
                        'Division_Code' => $db_code_data['Division_Code'] ?? null,
                        'Customer_Type_Code' => $db_code_data['Customer_Type_Code'] ?? null,
                        'Customer_Group_Code' => $db_code_data['Customer_Group_Code'] ?? null,
                        'distributors_id' => $db_code_data['distributors_id'] ?? null
                    ];


                    $updateConditions = array_filter($updateConditions, function ($value) {
                        return $value !== null;
                    });

                    if (count($updateConditions) === 7) {
                        $this->db->where($updateConditions);
                        $this->db->update('maping', [
                            "Level_{$postData['level']}" => $postData['set_pjp_code']
                        ]);
                    }
                }
            }
        }


        if (!empty($postData['Vacant']) && !empty($postData['Replace_DB_Code'])) {
            foreach ($postData['Replace_DB_Code'] as $replace_db_code_json) {
                $replace_db_code_data = json_decode($replace_db_code_json, true);
                if ($replace_db_code_data) {
                    $updateConditions = [
                        'DB_Code' => $replace_db_code_data['DB_Code'] ?? null,
                        'Sales_Code' => $replace_db_code_data['Sales_Code'] ?? null,
                        'Distribution_Channel_Code' => $replace_db_code_data['Distribution_Channel_Code'] ?? null,
                        'Division_Code' => $replace_db_code_data['Division_Code'] ?? null,
                        'Customer_Type_Code' => $replace_db_code_data['Customer_Type_Code'] ?? null,
                        'Customer_Group_Code' => $replace_db_code_data['Customer_Group_Code'] ?? null,
                        'distributors_id' => $replace_db_code_data['distributors_id'] ?? null
                    ];


                    $updateConditions = array_filter($updateConditions, function ($value) {
                        return $value !== null;
                    });

                    if (!empty($updateConditions)) {

                        $this->db->where($updateConditions);
                        $this->db->update('maping', [
                            "Level_{$postData['level']}" => $postData['Vacant']
                        ]);
                    }
                }
            }
        } else {
            log_message('info', 'Vacant data is empty or Replace_DB_Code is not provided. No updates made.');
        }


        if ($this->db->trans_status() === FALSE) {
            echo json_encode(["status" => "error", "message" => "Failed to update mapping table."]);
        } else {
            echo json_encode(["status" => "success", "message" => "Mapping table updated successfully."]);
        }
    }




    public function Save_Replace_emp_Promoted()
    {
        $back_user_id = $this->session->userdata('back_user_id');
        if (!$back_user_id) {
            redirect('admin/login');
        }
        $postData = $this->input->post();


        if (empty($postData['set_pjp_code']) || empty($postData['selectedEmployeesselectedValue'])) {
            echo json_encode([
                "status" => "error",
                "message" => "Required fields are missing: set_pjp_code or selectedEmployeesselectedValue."
            ]);
            return;
        }

        $this->db->trans_start();


        if (!empty($postData['DB_Code'])) {
            foreach ($postData['DB_Code'] as $db_code_json) {
                $db_code_data = json_decode($db_code_json, true);
                if ($db_code_data) {

                    $updateConditions = [
                        'DB_Code' => $db_code_data['Customer_Code'] ?? null,
                        'Sales_Code' => $db_code_data['Sales_Code'] ?? null,
                        'Distribution_Channel_Code' => $db_code_data['Distribution_Channel_Code'] ?? null,
                        'Division_Code' => $db_code_data['Division_Code'] ?? null,
                        'Customer_Type_Code' => $db_code_data['Customer_Type_Code'] ?? null,
                        'Customer_Group_Code' => $db_code_data['Customer_Group_Code'] ?? null,
                        'distributors_id' => $db_code_data['distributors_id'] ?? null
                    ];


                    $updateConditions = array_filter($updateConditions, function ($value) {
                        return $value !== null;
                    });

                    if (count($updateConditions) === 7) {
                        $this->db->where($updateConditions);
                        $this->db->update('maping', [
                            "Level_{$postData['level']}" => $postData['set_pjp_code']
                        ]);
                    }
                }
            }
        }


        $pjp_code = $postData['selectedEmployeesselectedValue'] ?? null;
        $level = $postData['level'] ?? null;
        $state = $postData['state'] ?? null;
        $city = $postData['city'] ?? null;
        $region = $postData['Zone'] ?? null;

        $new_level = ($level > 1) ? max(2, $level - 1) : $level;

        if ($pjp_code && $level) {
            $employee = $this->db->where([
                'pjp_code' => $pjp_code,
                'level' => $level
            ])->get('employee')->row();

            if ($employee) {
                $update_data = [
                    'state' => $state,
                    'city' => $city,
                    'level' => $new_level,
                    'region' => $region
                ];
                $this->db->where('id', $employee->id)->update('employee', $update_data);
            }
        }


        if (!empty($postData['employee_data'])) {
            foreach ($postData['employee_data'] as $employee_data_json) {
                $employee_data = json_decode($employee_data_json, true);

                if ($employee_data) {

                    $current_level = $postData['level'] ?? 1;
                    $level = ($current_level > 1) ? max(2, $current_level - 1) : $current_level;


                    $updateConditions = [
                        'DB_Code' => $employee_data['Customer_Code'] ?? null,
                        'Sales_Code' => $employee_data['Sales_Code'] ?? null,
                        'Distribution_Channel_Code' => $employee_data['Distribution_Channel_Code'] ?? null,
                        'Division_Code' => $employee_data['Division_Code'] ?? null,
                        'Customer_Type_Code' => $employee_data['Customer_Type_Code'] ?? null,
                        'Customer_Group_Code' => $employee_data['Customer_Group_Code'] ?? null,
                        'distributors_id' => $employee_data['distributors_id'] ?? null
                    ];


                    $updateConditions = array_filter($updateConditions, function ($value) {
                        return $value !== null;
                    });

                    if (!empty($updateConditions)) {
                        $this->db->where($updateConditions);
                        $this->db->update('maping', [
                            "Level_{$level}" => $postData['selectedEmployeesselectedValue'] ?? null
                        ]);
                    }
                }
            }
        }


        if (!empty($postData['Vacant']) && !empty($postData['Replace_DB_Code'])) {
            foreach ($postData['Replace_DB_Code'] as $replace_db_code_json) {
                $replace_db_code_data = json_decode($replace_db_code_json, true);

                if ($replace_db_code_data) {
                    $updateConditions = [
                        'DB_Code' => $replace_db_code_data['DB_Code'] ?? null,
                        'Sales_Code' => $replace_db_code_data['Sales_Code'] ?? null,
                        'Distribution_Channel_Code' => $replace_db_code_data['Distribution_Channel_Code'] ?? null,
                        'Division_Code' => $replace_db_code_data['Division_Code'] ?? null,
                        'Customer_Type_Code' => $replace_db_code_data['Customer_Type_Code'] ?? null,
                        'Customer_Group_Code' => $replace_db_code_data['Customer_Group_Code'] ?? null,
                        'distributors_id' => $replace_db_code_data['distributors_id'] ?? null
                    ];


                    $updateConditions = array_filter($updateConditions, function ($value) {
                        return $value !== null;
                    });

                    if (!empty($updateConditions)) {
                        $this->db->where($updateConditions);
                        $this->db->update('maping', [
                            "Level_{$postData['level']}" => $postData['Vacant'] ?? null
                        ]);
                    }
                }
            }
        } else {
            log_message('info', 'Vacant data is empty or Replace_DB_Code is not provided. No updates made.');
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            log_message('error', 'Transaction failed during Save_Replace_emp_Promoted.');
            echo json_encode([
                "status" => "error",
                "message" => "Failed to update data."
            ]);
        } else {
            log_message('info', 'Transaction succeeded during Save_Replace_emp_Promoted.');
            echo json_encode([
                "status" => "success",
                "message" => "Employee details updated successfully."
            ]);
        }
    }

    public function employeedata()
    {
        $level = $this->input->post('level');
        $draw = $this->input->post('draw');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search')['value'];
        $order_column = $this->input->post('order')[0]['column'];
        $order_dir = $this->input->post('order')[0]['dir'];

        $columns = array(
            0 => 'id',
            1 => 'employer_code',
            2 => 'name',
            3 => 'mobile',
            4 => 'state',
            5 => 'city',
            6 => 'designation_name',
            7 => 'email'
        );

        $sort_by = isset($columns[$order_column]) ? $columns[$order_column] : 'id';


        $employees = $this->Employee_model->get_Employee_by_level(
            $level,
            $length,
            $start,
            $search,
            $sort_by,
            $order_dir
        );


        $total_records = $this->Employee_model->get_total_employees_by_level($level, $search);

        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $employees,
            "status" => "success"
        );

        echo json_encode($response);
    }

    public function dummmymaping__()
    {



        $this->db->select('d.Customer_Code, d.Sales_Code, d.Distribution_Channel_Code, 
                           d.Division_Code, d.Customer_Type_Code, d.Customer_Group_Code');
        $this->db->from('distributors d');
        $this->db->where('d.STATUS', 'ACTIVE');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $distributor) {
                $this->db->select('m.id');
                $this->db->from('maping m');
                $this->db->where('m.DB_Code', $distributor->Customer_Code);
                $this->db->where('m.Sales_Code', $distributor->Sales_Code);
                $this->db->where('m.Distribution_Channel_Code', $distributor->Distribution_Channel_Code);
                $this->db->where('m.Division_Code', $distributor->Division_Code);
                $this->db->where('m.Customer_Type_Code', $distributor->Customer_Type_Code);
                $this->db->where('m.Customer_Group_Code', $distributor->Customer_Group_Code);

                $mapingQuery = $this->db->get();


                if ($mapingQuery->num_rows() > 0) {
                    $mapingId = $mapingQuery->row()->id;

                    $this->db->delete('maping', ['id' => $mapingId]);
                }


                $mappingData = [
                    'DB_Code' => $distributor->Customer_Code,
                    'Sales_Code' => $distributor->Sales_Code,
                    'Distribution_Channel_Code' => $distributor->Distribution_Channel_Code,
                    'Division_Code' => $distributor->Division_Code,
                    'Customer_Type_Code' => $distributor->Customer_Type_Code,
                    'Customer_Group_Code' => $distributor->Customer_Group_Code,
                    'pjp_code' => $pjp_codes[array_rand($pjp_codes)]
                ];


                $this->db->insert('maping', $mappingData);
            }


            echo json_encode(['status' => 'success', 'message' => 'Active distributors and corresponding mappings updated with pjp_code successfully.']);
        } else {

            echo json_encode(['status' => 'error', 'message' => 'No active distributors found.']);
        }
    }



    public function dummmymaping()
    {

        $this->db->select('d.Customer_Code, d.Sales_Code, d.Distribution_Channel_Code, 
                           d.Division_Code, d.Customer_Type_Code, d.Customer_Group_Code');
        $this->db->from('distributors d');
        $this->db->group_by([
            'd.Customer_Code',
            'd.Sales_Code',
            'd.Distribution_Channel_Code',
            'd.Division_Code',
            'd.Customer_Type_Code',
            'd.Customer_Group_Code'
        ]);
        $query = $this->db->get();


        log_message('info', 'Distributors Query Result: ' . json_encode($query->result()));

        $totalMappingsAdded = 0;

        if ($query->num_rows() > 0) {

            $mappingsToInsert = [];

            foreach ($query->result() as $distributor) {

                log_message('info', 'Processing Distributor: ' . json_encode($distributor));


                $this->db->from('maping');
                $this->db->where([
                    'DB_Code' => $distributor->Customer_Code,
                    'Sales_Code' => $distributor->Sales_Code,
                    'Distribution_Channel_Code' => $distributor->Distribution_Channel_Code,
                    'Division_Code' => $distributor->Division_Code,
                    'Customer_Type_Code' => $distributor->Customer_Type_Code,
                    'Customer_Group_Code' => $distributor->Customer_Group_Code
                ]);
                $existingMapping = $this->db->count_all_results();


                log_message('info', 'Existing Mapping Count: ' . $existingMapping);

                if ($existingMapping > 0) {
                    log_message('info', 'Mapping already exists for Distributor: ' . json_encode($distributor));
                    continue;
                }


                $mappingData = [
                    'DB_Code' => $distributor->Customer_Code,
                    'Sales_Code' => $distributor->Sales_Code,
                    'Distribution_Channel_Code' => $distributor->Distribution_Channel_Code,
                    'Division_Code' => $distributor->Division_Code,
                    'Customer_Type_Code' => $distributor->Customer_Type_Code,
                    'Customer_Group_Code' => $distributor->Customer_Group_Code
                ];

                log_message('info', 'Inserting Mapping: ' . json_encode($mappingData));

                $mappingsToInsert[] = $mappingData;
            }


            if (!empty($mappingsToInsert)) {

                log_message('info', 'Inserting Mappings to Database: ' . json_encode($mappingsToInsert));

                $this->db->insert_batch('maping', $mappingsToInsert);


                $totalMappingsAdded = count($mappingsToInsert);


                log_message('info', 'Total Mappings Added: ' . $totalMappingsAdded);

                echo json_encode([
                    'status' => 'success',
                    'message' => $totalMappingsAdded . ' mappings added successfully.'
                ]);
            } else {

                log_message('info', 'No new mappings to add.');
                echo json_encode(['status' => 'error', 'message' => 'No new mappings to add.']);
            }
        } else {

            log_message('error', 'No distributors found.');
            echo json_encode(['status' => 'error', 'message' => 'No distributors found.']);
        }
    }




    public function checkAndDeleteDistributor()
    {

        $this->db->select('d.Customer_Code, d.Sales_Code, d.Distribution_Channel_Code, 
                       d.Division_Code, d.Customer_Type_Code, d.Customer_Group_Code');
        $this->db->select('d.*');
        $this->db->from('distributors d');
        $this->db->where('d.STATUS', 'INACTIVE');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            foreach ($query->result() as $distributor) {

                $this->db->select('m.id, m.DB_Code, m.Sales_Code, m.Distribution_Channel_Code, m.Division_Code, 
            m.Customer_Type_Code, m.Customer_Group_Code, m.Level_1, m.Level_2, m.Level_3, m.Level_4, m.Level_5, m.Level_6, m.Level_7');
                $this->db->from('maping m');
                $this->db->where('m.DB_Code', $distributor->Customer_Code);
                $this->db->where('m.Sales_Code', $distributor->Sales_Code);
                $this->db->where('m.Distribution_Channel_Code', $distributor->Distribution_Channel_Code);
                $this->db->where('m.Division_Code', $distributor->Division_Code);
                $this->db->where('m.Customer_Type_Code', $distributor->Customer_Type_Code);
                $this->db->where('m.Customer_Group_Code', $distributor->Customer_Group_Code);

                $mapingQuery = $this->db->get();


                if ($mapingQuery->num_rows() > 0) {
                    foreach ($mapingQuery->result_array() as $mapingData) {

                        $archivedData = [
                            'DB_Code' => $mapingData['DB_Code'],
                            'Sales_Code' => $mapingData['Sales_Code'],
                            'Distribution_Channel_Code' => $mapingData['Distribution_Channel_Code'],
                            'Division_Code' => $mapingData['Division_Code'],
                            'Customer_Type_Code' => $mapingData['Customer_Type_Code'],
                            'Customer_Group_Code' => $mapingData['Customer_Group_Code'],
                            'Level_1' => $mapingData['Level_1'],
                            'Level_2' => $mapingData['Level_2'],
                            'Level_3' => $mapingData['Level_3'],
                            'Level_4' => $mapingData['Level_4'],
                            'Level_5' => $mapingData['Level_5'],
                            'Level_6' => $mapingData['Level_6'],
                            'Level_7' => $mapingData['Level_7'],

                            'Customer_Name' => $distributor->Customer_Name,
                            'Pin_Code' => $distributor->Pin_Code,
                            'City' => $distributor->City,
                            'District' => $distributor->District,
                            'Contact_Number' => $distributor->Contact_Number,
                            'Country' => $distributor->Country,
                            'Zone' => $distributor->Zone,
                            'State' => $distributor->State,
                            'Population_Strata_1' => $distributor->Population_Strata_1,
                            'Population_Strata_2' => $distributor->Population_Strata_2,
                            'Country_Group' => $distributor->Country_Group,
                            'GTM_TYPE' => $distributor->GTM_TYPE,
                            'SUPERSTOCKIST' => $distributor->SUPERSTOCKIST,
                            'STATUS' => $distributor->STATUS,
                            'Customer_Type_Name' => $distributor->Customer_Type_Name,
                            'Customer_Creation_Date' => $distributor->Customer_Creation_Date,
                            'Sector_Code' => $distributor->Sector_Code,
                            'State_Code' => $distributor->State_Code,
                            'Zone_Code' => $distributor->Zone_Code,
                            'Distribution_Channel_Name' => $distributor->Distribution_Channel_Name,
                            'Customer_Group_Name' => $distributor->Customer_Group_Name,
                            'Sales_Name' => $distributor->Sales_Name,
                            'Division_Name' => $distributor->Division_Name,
                            'Sector_Name' => $distributor->Sector_Name,

                            'deleted_at' => date('Y-m-d H:i:s')
                        ];

                        for ($i = 1; $i <= 7; $i++) {
                            $this->db->select('name, employer_code, designation_name, employer_name, id'); // Adjust the columns as per your schema

                            $this->db->from('employee');
                            $this->db->where('pjp_code', $mapingData['Level_' . $i]);
                            $employeeQuery = $this->db->get();

                            if ($employeeQuery->num_rows() > 0) {
                                $employeeData = $employeeQuery->row_array();
                                $employeeData = $employeeQuery->row_array();
                                $archivedData['Level_' . $i . '_employee_name'] = $employeeData['name'];
                                $archivedData['Level_' . $i . '_employee_code'] = $employeeData['employer_code'];
                                $archivedData['Level_' . $i . '_employee_designation'] = $employeeData['designation_name']; // designation_name
                                $archivedData['Level_' . $i . '_employee_employer'] = $employeeData['employer_name']; // employer_name
                                $archivedData['Level_' . $i . '_employee_id'] = $employeeData['id'];
                            } else {
                                $archivedData['Level_' . $i . '_employee_name'] = 'Unknown';
                                $archivedData['Level_' . $i . '_employee_code'] = 'Unknown';
                                $archivedData['Level_' . $i . '_employee_designation'] = 'Unknown';
                                $archivedData['Level_' . $i . '_employee_employer'] = 'Unknown';
                                $archivedData['Level_' . $i . '_employee_id'] = 'Unknown';
                            }
                        }

                        $this->db->insert('archived_maping', $archivedData);

                        $this->db->delete('maping', ['id' => $mapingData['id']]);
                    }
                }
            }


            echo json_encode(['status' => 'success', 'message' => 'Inactive distributors and corresponding mappings deleted successfully.']);
        } else {

            echo json_encode(['status' => 'error', 'message' => 'No inactive distributors found.']);
        }
    }


    public function Save_Replace_emp_Transfer()
    {
        $back_user_id = $this->session->userdata('back_user_id');
        if (!$back_user_id) {
            redirect('admin/login');
        }
        $postData = $this->input->post();


        if (empty($postData['set_pjp_code']) || empty($postData['selectedEmployeesselectedValue'])) {
            echo json_encode([
                "status" => "error",
                "message" => "Required fields are missing: set_pjp_code or selectedEmployeesselectedValue."
            ]);
            return;
        }


        $this->db->trans_start();


        if (!empty($postData['DB_Code'])) {
            foreach ($postData['DB_Code'] as $db_code_json) {
                $db_code_data = json_decode($db_code_json, true);

                if ($db_code_data) {

                    $updateConditions = [
                        'DB_Code' => $db_code_data['Customer_Code'] ?? null,
                        'Sales_Code' => $db_code_data['Sales_Code'] ?? null,
                        'Distribution_Channel_Code' => $db_code_data['Distribution_Channel_Code'] ?? null,
                        'Division_Code' => $db_code_data['Division_Code'] ?? null,
                        'Customer_Type_Code' => $db_code_data['Customer_Type_Code'] ?? null,
                        'Customer_Group_Code' => $db_code_data['Customer_Group_Code'] ?? null,
                        'distributors_id' => $db_code_data['distributors_id'] ?? null
                    ];


                    $updateConditions = array_filter($updateConditions, function ($value) {
                        return $value !== null;
                    });

                    if (count($updateConditions) === 7) {
                        $this->db->where($updateConditions);
                        $this->db->update('maping', [
                            "Level_{$postData['level']}" => $postData['set_pjp_code']
                        ]);
                    }
                }
            }
        }




        $pjp_code = $postData['selectedEmployeesselectedValue'] ?? null;
        $level = $postData['level'] ?? null;
        $state = $postData['state'] ?? null;
        $city = $postData['city'] ?? null;
        $region = $postData['Zone'] ?? null;


        $new_level = ($level > 1) ? max(2, $level - 1) : $level;


        if ($pjp_code && $level) {
            $employee = $this->db->where([
                'pjp_code' => $pjp_code,
                'level' => $level
            ])->get('employee')->row();

            if ($employee) {
                $update_data = [
                    'state' => $state,
                    'city' => $city,
                    'level' => $new_level,
                    'region' => $region
                ];
                $this->db->where('id', $employee->id)->update('employee', $update_data);
            }
        }






        // Similar approach for employee_data processing
        if (!empty($postData['employee_data'])) {
            foreach ($postData['employee_data'] as $employee_data_json) {
                $employee_data = json_decode($employee_data_json, true);

                if ($employee_data) {
                    $updateConditions = [
                        'DB_Code' => $employee_data['Customer_Code'] ?? null,
                        'Sales_Code' => $employee_data['Sales_Code'] ?? null,
                        'Distribution_Channel_Code' => $employee_data['Distribution_Channel_Code'] ?? null,
                        'Division_Code' => $employee_data['Division_Code'] ?? null,
                        'Customer_Type_Code' => $employee_data['Customer_Type_Code'] ?? null,
                        'Customer_Group_Code' => $employee_data['Customer_Group_Code'] ?? null,
                        'distributors_id' => $employee_data['distributors_id'] ?? null
                    ];

                    $updateConditions = array_filter($updateConditions, function ($value) {
                        return $value !== null;
                    });

                    if (!empty($updateConditions)) {
                        $this->db->where($updateConditions);
                        $this->db->update('maping', [
                            "Level_{$postData['level']}" => $postData['selectedEmployeesselectedValue']
                        ]);
                    }
                }
            }
        }

        // Similar approach for Replace_DB_Code processing
        if (!empty($postData['Vacant']) && !empty($postData['Replace_DB_Code'])) {
            foreach ($postData['Replace_DB_Code'] as $replace_db_code_json) {
                $replace_db_code_data = json_decode($replace_db_code_json, true);

                if ($replace_db_code_data) {
                    $updateConditions = [
                        'DB_Code' => $replace_db_code_data['DB_Code'] ?? null,
                        'Sales_Code' => $replace_db_code_data['Sales_Code'] ?? null,
                        'Distribution_Channel_Code' => $replace_db_code_data['Distribution_Channel_Code'] ?? null,
                        'Division_Code' => $replace_db_code_data['Division_Code'] ?? null,
                        'Customer_Type_Code' => $replace_db_code_data['Customer_Type_Code'] ?? null,
                        'Customer_Group_Code' => $replace_db_code_data['Customer_Group_Code'] ?? null,
                        'distributors_id' => $replace_db_code_data['distributors_id'] ?? null
                    ];

                    $updateConditions = array_filter($updateConditions, function ($value) {
                        return $value !== null;
                    });

                    if (!empty($updateConditions)) {
                        $this->db->where($updateConditions);
                        $this->db->update('maping', [
                            "Level_{$postData['level']}" => $postData['Vacant']
                        ]);
                    }
                }
            }
        }

        // Commit or rollback transaction
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            echo json_encode([
                "status" => "error",
                "message" => "Failed to update data."
            ]);
        } else {
            echo json_encode([
                "status" => "success",
                "message" => "Employee details updated successfully."
            ]);
        }
    }



    public function pjp_code_emp_Left()
    {


      

       
        $user_id = $this->session->userdata('back_user_id');
        if (!$user_id) {
            log_message('error', 'User not logged in. Redirecting to login.');
            redirect('admin/login');
            return;
        }

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

     


        
        $level = $this->input->post('level');
        $pjp_code = $this->input->post('pjp_code');
        $search = $this->input->post('search');  
        $limit = $this->input->post('limit') ?? 20; 
        $page = $this->input->post('page') ?? 1; 
        $offset = ($page - 1) * $limit; 

        $result = $this->Maping_model->get_pjp_code_by_level( $zone_ids, $level, $pjp_code, $limit, $offset, $search);

        echo json_encode([
            'status' => 'success',
            'data' => $result['data'],
            'pagination' => [
                'page' => (int)$page,
                'limit' => (int)$limit,
                'total' => (int)$result['total_count'],
                'total_pages' => ceil($result['total_count'] / $limit)
            ]
        ]);
    }





    public function emp_Transfer()
    {
        $back_user_id = $this->session->userdata('back_user_id');

        if (!$back_user_id) {
            redirect('admin/login');
        }

        $data['state'] = array_unique(array_column($this->Employee_model->get_all_emp_state(), 'state'));
        $data['unique_cities'] = array_column($this->Distributor_model->get_unique_cities(), 'City');
        $data['unique_State'] = array_column($this->Distributor_model->get_unique_State(), 'State');
        $data['unique_zone'] = array_column($this->Distributor_model->get_unique_zone(), 'Zone');



        // Retrieve employee IDs from the query string
        $Emp_ids = [];
        for ($i = 1; $i <= 7; $i++) {
            $Emp_ids[$i] = $this->input->get('id' . $i);
        }

        // Fetch employee data for each ID
        $data['employees'] = [];
        foreach ($Emp_ids as $key => $Emp_id) {
            if ($Emp_id) {
                $data['employees'][$key] = $this->Employee_model->get_employees_by_Emp_id($Emp_id);
            }
        }

        // Debugging output
        // echo '<pre>';
        // print_r($data['employees']);
        // echo '</pre>';

        // die;


        $data['level'] = $this->Employee_model->get_all_levels();
        $data['designation'] = $this->Employee_model->get_all_designations();


        // Retrieve user and permissions based on the session
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

        // Load the views with the data
        $data['Emp_id'] = $Emp_id;
        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';


        $hasPermission = false;
        if (!empty($data['permissions']) && is_array($data['permissions'])) {
            foreach ($data['permissions'] as $p) {
                if ($p['module_name'] === "User Movement" && $p['view'] === "yes") {
                    $hasPermission = true;
                    break;
                }
            }
        }


        if (!$hasPermission) {
            print_r("You do not have permission to access this page.");
            return;
        }

        $this->load->view('admin/header', $data);
        $this->load->view('admin/emp_Transfer', $data);
        $this->load->view('admin/footer', $data);
    }


    public function emp_Promoted()
    {
        $back_user_id = $this->session->userdata('back_user_id');

        if (!$back_user_id) {
            redirect('admin/login');
        }

        // Fetch unique states for employees
        $data['state'] = array_unique(array_column($this->Employee_model->get_all_emp_state(), 'state'));
        $data['unique_cities'] = array_column($this->Distributor_model->get_unique_cities(), 'City');
        $data['unique_State'] = array_column($this->Distributor_model->get_unique_State(), 'State');
        $data['unique_zone'] = array_column($this->Distributor_model->get_unique_zone(), 'Zone');





        $Emp_ids = [];
        for ($i = 1; $i <= 7; $i++) {
            $Emp_ids[$i] = $this->input->get('id' . $i);
        }

        // Fetch employee data for each ID
        $data['employees'] = [];
        foreach ($Emp_ids as $key => $Emp_id) {
            if ($Emp_id) {
                $data['employees'][$key] = $this->Employee_model->get_employees_by_Emp_id($Emp_id);
            }
        }

        $data['level'] = $this->Employee_model->get_all_levels();
        $data['designation'] = $this->Employee_model->get_all_designations();

        // Retrieve user and permissions based on the session
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

        // Load the views with the data
        $data['Emp_id'] = $Emp_id;
        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';



        $hasPermission = false;
        if (!empty($data['permissions']) && is_array($data['permissions'])) {
            foreach ($data['permissions'] as $p) {
                if ($p['module_name'] === "User Movement" && $p['view'] === "yes") {
                    $hasPermission = true;
                    break;
                }
            }
        }


        if (!$hasPermission) {
            print_r("You do not have permission to access this page.");
            return;
        }

        $this->load->view('admin/header', $data);
        $this->load->view('admin/emp_Promoted', $data);
        $this->load->view('admin/footer', $data);
    }


    public function get_cities_by_state()
    {
        $state = $this->input->post('state');
        $cities = $this->Distributor_model->get_cities_by_state($state);
        echo json_encode($cities);
    }

    public function get_employees_by_city()
    {
        $city = $this->input->post('city');
        $level = (int) $this->input->post('selectedValue'); // Ensure it's an integer
        $pjpCode = $this->input->post('pjpCode');

        // Increment the level, but ensure it does not exceed 7
        if ($level < 7) {
            $level--; // Increment by 1 if it's less than 7
        } else {
            $level = 7; // Set level to 7 if it's already 7 or greater
        }

        // Pass both city and updated level to the model function
        $employees = $this->Employee_model->get_employees_by_city_and_level($city, $level, $pjpCode);

        // Return the results as JSON
        echo json_encode($employees);
    }



    public function get_employees_by_city_t()
    {
        $city = $this->input->post('city');
        $employees = $this->Employee_model->get_employees_by_city_and_level($city);
        echo json_encode($employees);
    }

    public function get_employees_by_city_and_level_zone_all_distubuter()
    {

        $state = $this->input->post('state');
        $city = $this->input->post('city');
        $zone = $this->input->post('zone');


        $employees = $this->Employee_model->get_employees_by_city_and_level_zone_all_distubuter($state, $city, $zone);

        echo json_encode($employees);
    }





    public function empreplace_level()
    {
        $back_user_id = $this->session->userdata('back_user_id');

        if (!$back_user_id) {
            redirect('admin/login');
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $level = isset($data['level']) ? $data['level'] : null;
        $pjpCode = isset($data['pjpCode']) ? $data['pjpCode'] : null;
        $search = isset($data['search']) ? $data['search'] : '';
        $limit = isset($data['limit']) ? intval($data['limit']) : 10;
        $page = isset($data['page']) ? intval($data['page']) : 1;



        if (empty($level)) {
            echo json_encode(['error' => 'No level provided']);
            return;
        }

        $offset = ($page - 1) * $limit;


        $employees = $this->Employee_model->get_employees_by_Emp_level($level, $pjpCode, $search, $limit, $offset);
        $employeesPromoted = $this->Employee_model->get_employees_by_Emp_level_emp_Promoted($level, $pjpCode, $search, $limit, $offset);

        $totalRecords = $this->Employee_model->get_employees_count($level, $pjpCode, $search);
        $totalPages = ($limit > 0) ? ceil($totalRecords / $limit) : 1;

        $response = [
            'employees' => $employees,
            'employees_level_Promoted' => $employeesPromoted,
            'total_records' => $totalRecords,
            'limit' => $limit,
            'page' => $page,
            'total_pages' => $totalPages
        ];

        echo json_encode($response);
    }




    public function empreplace_level_Promoted()
    {
        $back_user_id = $this->session->userdata('back_user_id');

        if (!$back_user_id) {
            redirect('admin/login');
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $level = isset($data['level']) ? $data['level'] : null;
        $pjpCode = isset($data['pjpCode']) ? $data['pjpCode'] : null;
        $search = isset($data['search']) ? $data['search'] : '';
        $limit = isset($data['limit']) ? intval($data['limit']) : 10;
        $page = isset($data['page']) ? intval($data['page']) : 1;

        if (empty($level)) {
            echo json_encode(['error' => 'No level provided']);
            return;
        }

        $offset = ($page - 1) * $limit;

        // Normal employees
        $employees = $this->Employee_model->get_employees_by_Emp_level($level, $pjpCode, $search, $limit, $offset);

        // Promoted employees
        $employeesPromoted = $this->Employee_model->get_employees_by_Emp_level_emp_Promoted($level, $pjpCode, $search, $limit, $offset);
        $totalRecordsPromoted = $this->Employee_model->get_employees_count($level, $pjpCode, $search);
        $totalPagesPromoted = ($limit > 0) ? ceil($totalRecordsPromoted / $limit) : 1;


        // Total records count based on array length
        $totalRecordsPromoted = count($employeesPromoted);

        // Calculate total pages
        $totalPagesPromoted = ($limit > 0) ? ceil($totalRecordsPromoted / $limit) : 1;

        $response = [
            'employees_level_Promoted' => $employeesPromoted,
            'total_records' => $totalRecordsPromoted,
            'limit' => $limit,
            'page' => $page,
            'total_pages' => $totalPagesPromoted
        ];

        echo json_encode($response);
    }









    public function submit_employee()
    {
        $back_user_id = $this->session->userdata('back_user_id');

        if (!$back_user_id) {
            redirect('admin/login');
        }

        date_default_timezone_set('Asia/Kolkata');

        $name = $this->input->post('name');
        $hiddenVacant = $this->input->post('hiddenVacant') ? $this->input->post('hiddenVacant') : 0;
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $pjp_code = $this->input->post('pjp_code');
        $dob = $this->input->post('dob');
        $employer_code = $this->input->post('employer_code');
        $employer_name = $this->input->post('employer_name');
        $adhar_card = $this->input->post('adhar_card');
        $gender = $this->input->post('gender');
        $employee_id = $this->input->post('employee_id');
        $application_id = $this->input->post('application_id');
        $level = $this->input->post('level');
        $designation = $this->input->post('designation');
        $designation_label = $this->input->post('designation_label');
        $designation_name = $this->input->post('designation_name');
        $designation_label_name = $this->input->post('designation_label_name');
        $doj = $this->input->post('doj');
        $employee_status = $this->input->post('employee_status');
        $city = $this->input->post('city');
        $state = $this->input->post('state');
        $address = $this->input->post('address');
        $region = $this->input->post('region');
        $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        // Check if email already exists
        if ($this->Employee_model->email_exists($email)) {
            echo json_encode(['status' => 'error', 'message' => 'Email already exists.']);
            return;
        }

        // Data for insertion
        $data = array(
            'name' => $name,
            'vacant_status' => $hiddenVacant,
            'email' => $email,
            'mobile' => $mobile,
            'pjp_code' => $pjp_code,
            'dob' => $dob,
            'employer_code' => $employer_code,
            'employer_name' => $employer_name,
            'adhar_card' => $adhar_card,
            'gender' => $gender,
            'employee_id' => $employee_id,
            'application_id' => $application_id,
            'level' => $level,
            'designation' => $designation,
            'designation_label' => $designation_label,
            'designation_name' => $designation_name,
            'designation_label_name' => $designation_label_name,
            'doj' => $doj,
            'employee_status' => $employee_status,
            'city' => $city,
            'state' => $state,
            'address' => $address,
            'region' => $region,
            'password' => $password,
            'created_at' => date('Y-m-d H:i:s')
        );

        // Insert employee data
        if ($this->Employee_model->insert_employee($data)) {
            echo json_encode(['status' => 'success', 'message' => 'Employee added successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add employee.']);
        }
    }


    public function userdetails()
    {


        $back_user_id = $this->session->userdata('back_user_id');


        if (!$back_user_id) {

            redirect('admin/login');
        }
        $data['userAll'] = $this->Employee_model->get_all_employees();

        $user_id = $this->session->userdata('back_user_id');
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
            if ($permission['module_name'] === 'User Manager' && $permission['view'] === 'yes') {
                $has_view_permission = true;
                break;
            }
        }

        if (!$has_view_permission) {
            echo "<h3>Access Denied: You do not have permission to view this page.</h3>";
            exit;
        }
        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';


        //  header('Content-Type: application/json');
        //  echo json_encode($data, JSON_PRETTY_PRINT);
        //  die();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/userdetails', $data);
        $this->load->view('admin/footer', $data);
    }

    public function Unmapped_Employee()
    {


        $back_user_id = $this->session->userdata('back_user_id');

        if (!$back_user_id) {

            redirect('admin/login');
        }
        $data['userAll'] = $this->Employee_model->get_all_employees();

        $user_id = $this->session->userdata('back_user_id');
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
            if ($permission['module_name'] === 'User Manager' && $permission['view'] === 'yes') {
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
        $this->load->view('admin/Unmapped-Employee', $data);
        $this->load->view('admin/footer', $data);
    }


    public function Unmapped_Employee_ajex_load()
    {
        $back_user_id = $this->session->userdata('back_user_id');
        if (!$back_user_id) {
            redirect('admin/login');
        }


        $draw = $this->input->get('draw');
        $start = $this->input->get('start', TRUE);
        $length = $this->input->get('length', TRUE);
        $search = $this->input->get('search', TRUE);
        $order_column_index = $this->input->get('order[0][column]', TRUE);
        $order_dir = $this->input->get('order[0][dir]', TRUE);


        $columns = [
            'name',
            'employer_name',
            'email',
            'mobile',
            'employee_id',
            'level',
            'state',
            'city',
            'region',
            'designation',
            'designation_name',
            'gender',
            'employee_status',
        ];
        $order_column = isset($columns[$order_column_index]) ? $columns[$order_column_index] : 'name';


        if (!in_array($order_dir, ['asc', 'desc'])) {
            $order_dir = 'asc';
        }


        $total_get_employee = $this->Employee_model->getTotal_employees_unmaped($search);
        $employee_s = $this->Employee_model->get_employees_unmaped($start, $length, $search, $order_column, $order_dir);


        $data = array();
        foreach ($employee_s->result() as $AS_employee) {
            $data[] = array(
                $AS_employee->name,
                $AS_employee->employer_name,
                $AS_employee->email,
                $AS_employee->mobile,
                $AS_employee->employee_id,
                $AS_employee->level,
                $AS_employee->state,
                $AS_employee->city,
                $AS_employee->region,
                $AS_employee->designation_name,
                $AS_employee->designation_label_name,
                !empty($AS_employee->gender) ? $AS_employee->gender : 'Non',
                $AS_employee->employee_status == 'active' ? '<span style="color: green;">Active</span>' : '<span style="color: red;">Inactive</span>',
            );
        }


        $output = array(
            'draw' => $draw,
            'recordsTotal' => $total_get_employee,
            'recordsFiltered' => $total_get_employee,
            'data' => $data
        );

        echo json_encode($output);
        exit();
    }



    public function Employee_ajex_load()
    {
        // Get the input values from the DataTables request
        $back_user_id = $this->session->userdata('back_user_id');
        $user_id = $this->session->userdata('back_user_id');

        if (!$back_user_id) {
            redirect('admin/login');
        }

        $data['user'] = $this->Role_model->get_user_by_id($user_id);


        $draw = $this->input->post('draw');
        $start = $this->input->post('start', TRUE);
        $length = $this->input->post('length', TRUE);
        $search = $this->input->post('search', TRUE);
        $order_column = $this->input->post('order[0][column]', TRUE); // Get the column index for sorting
        $order_dir = $this->input->post('order[0][dir]', TRUE); // Get the direction for sorting
        log_message('debug', 'Order Column Index: ' . $order_column);
        log_message('debug', 'Order Direction: ' . $order_dir);
        // Map the column index to the actual column name (You can adjust this mapping based on your table columns)
        $columns = [
            'name',
            'employer_name',
            'email',
            'mobile',
            'employee_id',
            'level',
            'state',
            'city',
            'region',
            'designation',
            'designation_name',
            'gender',
            'employee_status',
        ];
        $order_column_name = isset($columns[$order_column]) ? $columns[$order_column] : 'name';

        log_message('debug', 'Order Column: ' . $order_column_name);
        log_message('debug', 'Order Direction: ' . $order_dir);
        // Fetch total employee count and paginated employees
        $total_get_employee = $this->Employee_model->getTotal_employees($search);
        $employee_s = $this->Employee_model->get_employees($start, $length, $search, $order_column_name, $order_dir);


        if ($user_id) {
            if ($data['user']) {
                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
                log_message('debug', 'No permissions found for the user.');
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
            log_message('debug', 'User ID not provided, permissions set to empty.');
        }


        // Fetch user permissions
        $permissions = $data['permissions'];



        $has_edit_permission = false;
        foreach ($permissions as $permission) {
            if ($permission['module_name'] === "User Manager" && $permission['edit'] === "yes") {
                $has_edit_permission = true;
                break;
            }
        }

        // Log Permission Check
        //log_message('debug', 'userdetails Edit Permission: ' . ($has_edit_permission ? 'Allowed' : 'Denied'));


        $data = [];
        foreach ($employee_s->result() as $AS_employee) {
            // Status switch should be disabled if the user lacks edit permission
            $status_switch = $has_edit_permission ? '
                <div class="switches-container">
                    <input type="radio" id="switchActive' . $AS_employee->id . '" name="switchPlan' . $AS_employee->id . '" 
                        value="Active" ' . ($AS_employee->employee_status == 'active' ? 'checked="checked"' : '') . '
                        onchange="changeEmployeeStatus(' . $AS_employee->id . ', \'active\')" />
                    <input type="radio" id="switchInactive' . $AS_employee->id . '" name="switchPlan' . $AS_employee->id . '" 
                        value="Inactive" ' . ($AS_employee->employee_status == 'inactive' ? 'checked="checked"' : '') . '
                        onchange="changeEmployeeStatus(' . $AS_employee->id . ', \'inactive\')" />
                    <label for="switchActive' . $AS_employee->id . '">Active</label>
                    <label for="switchInactive' . $AS_employee->id . '">Inactive</label>
                    <div class="switch-wrapper">
                        <div class="switch">
                            <div>Active</div>
                            <div>Inactive</div>
                        </div>
                    </div>
                </div>
            ' : '<span class="text-danger fw-bold">No Permission</span>'; // Show "No Permission" if edit is denied

            // Action buttons should be hidden if the user lacks edit permission
            $action_buttons = '<div class="d-flex">';

            if ($has_edit_permission) {
                $action_buttons .= '
                    <a href="' . site_url('admin/Employeeedit/' . $AS_employee->id) . '" class="btn btn-primary setfont">
                        <i class="fa-solid fa-pencil fa-fw"></i>
                    </a>
              ';
            }

            $action_buttons .= '
            <a href="' . site_url('admin/Employeeview/' . $AS_employee->id) . '" class="btn btn-primary setfont">
            <i class="fa-solid fa-eye fa-fw"></i>
        </a>
            ';


            if ($has_edit_permission) {
                $action_buttons .= '
            
                    <a href="javascript:void(0);" data-id="' . $AS_employee->id . '" class="delete-btn btn btn-danger setfont">
                        <i class="fa-solid fa-trash fa-fw"></i>
                    </a>';
            }





            $action_buttons .= '
                
         
            
            
            
            
            ';

            $data[] = [
                $AS_employee->name,
                $AS_employee->employer_name,
                $AS_employee->email,
                $AS_employee->mobile,
                $AS_employee->employee_id,
                $AS_employee->level,
                $AS_employee->state,
                $AS_employee->city,
                $AS_employee->region,
                $AS_employee->designation_name,
                $AS_employee->designation_label_name,
                !empty($AS_employee->gender) ? $AS_employee->gender : 'Non',
                $status_switch,
                $action_buttons
            ];
        }



        $output = [
            'draw' => $draw,
            'recordsTotal' => $total_get_employee,
            'recordsFiltered' => $total_get_employee,
            'data' => $data
        ];

        echo json_encode($output);
        exit();
    }






    public function edit_employee($id)
    {
        $back_user_id = $this->session->userdata('back_user_id');

        if (!$back_user_id) {
            redirect('admin/login');
        }
        $data['employee'] = $this->Employee_model->get_employee_by_id($id);
        $employee_city = $data['employee']['city'];
        $employee_region = $data['employee']['region'];
        $data['unique_State'] = array_column($this->Distributor_model->get_unique_State(), 'State');
        $user_id = $this->session->userdata('back_user_id');
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
            if ($permission['module_name'] === 'User Manager' && $permission['view'] === 'yes') {
                $has_view_permission = true;
                break;
            }
        }

        if (!$has_view_permission) {
            echo "<h3>Access Denied: You do not have permission to view this page.</h3>";
            exit;
        }

        if ($this->input->post()) {
            $updatedData = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
                'pjp_code' => $this->input->post('pjp_code'),
                'employee_id' => $this->input->post('employee_id'),
                'level' => $this->input->post('level'),
                'designation' => $this->input->post('designation'),
                'designation_label' => $this->input->post('designation_label'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            ];

            $this->Employee_model->update_employee($id, $updatedData);
            redirect('admin/userdetails');
        }

        $data['level'] = $this->Employee_model->get_all_levels();
        $data['designation'] = $this->Employee_model->get_all_designations();
        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';


        $data['employee_city'] = $employee_city;
        $data['employee_region'] = $employee_region;





        $this->load->view('admin/header', $data);
        $this->load->view('admin/Employeeedit', $data);
        $this->load->view('admin/footer', $data);
    }





    public function updateEmployeeStatus()
    {
        $back_user_id = $this->session->userdata('back_user_id');
        if (!$back_user_id) {
            redirect('admin/login');
        }

        $id = $this->input->post('employee_id', TRUE);
        $employee_status = $this->input->post('employee_status', TRUE);

        date_default_timezone_set('Asia/Kolkata');

        log_message('debug', 'Employee ID: ' . $id);
        log_message('debug', 'Employee Status: ' . $employee_status);

        if (empty($id) || empty($employee_status)) {
            log_message('error', 'Invalid input data');
            echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
            return;
        }

        // Get the pjp_code of the employee
        $pjp_code = $this->Employee_model->get_pjp_code_by_employee_id($id);
        log_message('debug', 'pjp_code: ' . $pjp_code);

        if (!$pjp_code) {
            log_message('error', 'Failed to retrieve Employee ');
            echo json_encode(['status' => 'error', 'message' => 'Failed to retrieve Employee ']);
            return;
        }

        // Check if pjp_code is mapped to levels 1 to 7
        $is_mapped = $this->Maping_model->is_pjp_code_mapped_to_levels($pjp_code);

        if ($is_mapped) {
            log_message('info', 'Status change not allowed: Employee is already mapped');
            echo json_encode(['status' => 'error', 'message' => 'Status change not allowed: Employee is already mapped ']);
            return;
        }

        // Normalize employee_status
        $employee_status = ucfirst(strtolower($employee_status));

        $data = ['employee_status' => $employee_status];

        // Set date for active/inactive status
        if ($employee_status === 'Active') {
            $data['active_date'] = date('Y-m-d H:i:s');
        } elseif ($employee_status === 'Inactive') {
            $data['inactive_date'] = date('Y-m-d H:i:s');
        }

        log_message('debug', 'Update data: ' . print_r($data, true));

        $result = $this->Employee_model->update_employee($id, $data);

        if ($result) {
            echo json_encode([
                'status' => 'success',
                'message' => "Employee status successfully updated to {$employee_status}."
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update status.']);
        }
    }











    public function submit_employee_edit($id)
    {
        $back_user_id = $this->session->userdata('back_user_id');
        if (!$back_user_id) {
            redirect('admin/login');
        }

        // Load form validation library
        //$this->load->library('form_validation');

        // Validation Rules
        $this->form_validation->set_rules('name', 'Name', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('employer_name', 'Employer Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'required');
        $this->form_validation->set_rules('employer_code', 'Employer Code', 'required');
        $this->form_validation->set_rules('adhar_card', 'Aadhar Card', 'required|numeric|min_length[12]|max_length[12]');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('designation', 'Designation', 'required');
        $this->form_validation->set_rules('designation_label', 'Designation Label', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            // If validation fails, reload the edit page with errors
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/Employeeedit/' . $id);
        } else {
            // If validation passes, update the employee data
            date_default_timezone_set('Asia/Kolkata');

            $updatedData = [
                'name' => $this->input->post('name'),
                'employer_name' => $this->input->post('employer_name'),
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
                'dob' => $this->input->post('dob'),
                'employer_code' => $this->input->post('employer_code'),
                'adhar_card' => $this->input->post('adhar_card'),
                'gender' => $this->input->post('gender'),
                'designation' => $this->input->post('designation'),
                'designation_label' => $this->input->post('designation_label'),
                'designation_name' => $this->input->post('designation_name'),
                'designation_label_name' => $this->input->post('designation_label_name'),
                'address' => $this->input->post('address'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->Employee_model->update_employee($id, $updatedData);
            $this->session->set_flashdata('success', 'Employee details updated successfully.');
            redirect('admin/userdetails');
        }
    }



    public function view_employee($id)
    {

        $back_user_id = $this->session->userdata('back_user_id');


        if (!$back_user_id) {

            redirect('admin/login');
        }
        $data['employee'] = $this->Employee_model->get_employee_by_id($id);

        $user_id = $this->session->userdata('back_user_id');
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
            if ($permission['module_name'] === 'User Manager' && $permission['view'] === 'yes') {
                $has_view_permission = true;
                break;
            }
        }

        if (!$has_view_permission) {
            echo "<h3>Access Denied: You do not have permission to view this page.</h3>";
            exit;
        }

        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';

        // header('Content-Type: application/json');
        // echo json_encode($data, JSON_PRETTY_PRINT);
        // die();


        $this->load->view('admin/header', $data);
        $this->load->view('admin/Employeeview', $data);
        $this->load->view('admin/footer', $data);
    }


    public function delete_employee($id)
    {
        $back_user_id = $this->session->userdata('back_user_id');

        if (!$back_user_id) {
            redirect('admin/login');
        }

        // Get the pjp_code of the employee
        $pjp_code = $this->Employee_model->get_pjp_code_by_employee_id($id);

        if (!$pjp_code) {
            $this->session->set_flashdata('error', 'Failed to retrieve PJP Code.');
            redirect('admin/userdetails');
            return;
        }

        // Check if pjp_code is mapped to levels 1 to 7
        $is_mapped = $this->Maping_model->is_pjp_code_mapped_to_levels($pjp_code);

        if ($is_mapped) {
            $this->session->set_flashdata('error', ' Deletion of this user is not allowed as the user is mapped to the distributor..');
        } else {
            $this->Employee_model->delete_employee($id);
            $this->session->set_flashdata('success', 'Employee deleted successfully.');
        }

        redirect('admin/userdetails');
    }
}
