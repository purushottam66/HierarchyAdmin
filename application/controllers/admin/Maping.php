<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Maping extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->output->set_header('X-Content-Type-Options: nosniff');

        $this->output->set_header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
        $this->output->set_header('X-XSS-Protection: 1; mode=block');
        ini_set('memory_limit', '512M'); // Or 1G

        $this->load->model('User_model');
        $this->load->model('Role_model');
        $this->load->model('Zone_model');


        $this->load->model('Maping_model');
        $this->load->model('Distributor_model');
        $this->load->library('form_validation');
        $this->load->model('Employee_model');
        $this->load->library('session');

        $user_id = $this->session->userdata('back_user_id');

        if (!$user_id) {

            $this->session->set_flashdata('error', 'Session expired. Please login again.');
            redirect('admin/login');
        }
    }
    public function mapingajex()
    {

        $back_user_id = $this->session->userdata('back_user_id');
        if (!$back_user_id) {
            log_message('error', 'User not logged in. Redirecting to login page.');
            redirect('admin/login');
        }


        $Sales_Code = $this->input->post('Sales_Code', TRUE);
        $Distribution_Channel_Code = $this->input->post('Distribution_Channel_Code', TRUE);
        $Division_Code = $this->input->post('Division_Code', TRUE);
        $Customer_Type_Code = $this->input->post('Customer_Type_Code', TRUE);
        $Customer_Group_Code = $this->input->post('Customer_Group_Code', TRUE);
        $Population_Strata_2 = $this->input->post('Population_Strata_2', TRUE);
        $Zone = $this->input->post('Zone', TRUE);


        $page = (int) $this->input->post('page') ?: 1;
        $limit = (int) $this->input->post('items_per_page') ?: 10;
        $offset = ($page - 1) * $limit;

        try {
            $total_items = $this->Distributor_model->get_total_unic_Distributors(
                $Sales_Code,
                $Distribution_Channel_Code,
                $Division_Code,
                $Customer_Type_Code,
                $Customer_Group_Code,
                $Population_Strata_2,
                $Zone
            );
        } catch (Exception $e) {
            log_message('error', 'Error fetching total distributor count: ' . $e->getMessage());
            echo json_encode(['error' => 'Error fetching distributor count']);
            return;
        }


        try {
            $distributors = $this->Distributor_model->get_unic_Distributors(
                $Sales_Code,
                $Distribution_Channel_Code,
                $Division_Code,
                $Customer_Type_Code,
                $Customer_Group_Code,
                $Population_Strata_2,
                $Zone,
                $limit,
                $offset
            );
        } catch (Exception $e) {
            log_message('error', 'Error fetching distributor data: ' . $e->getMessage());
            echo json_encode(['error' => 'Error fetching distributor data']);
            return;
        }


        if (empty($distributors)) {
            log_message('info', 'No distributors found matching the filters.');
            $data = [
                'error' => 'No distributors found matching the filters.',
                'pagination' => [
                    'current_page' => $page,
                    'items_per_page' => $limit,
                    'total_items' => $total_items,
                    'total_pages' => ceil($total_items / $limit)
                ]
            ];
        } else {
            log_message('info', 'Found ' . count($distributors) . ' distributors.');
            $data = [
                'Distributor' => $distributors,
                'pagination' => [
                    'current_page' => $page,
                    'items_per_page' => $limit,
                    'total_items' => $total_items,
                    'total_pages' => ceil($total_items / $limit)
                ]
            ];
        }


        echo json_encode($data);
    }











    public function maping()
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
        $data['distributors'] = $this->Distributor_model->get_distributors_by_zone_ids($zone_ids);
        $data['user'] = $this->Role_model->get_user_by_id($user_id);
        $data['mapping'] = $this->Maping_model->get_all_Maping();
        $data['employees'] = $this->Employee_model->get_all_employees();
        $data['zone_code_with_name'] = $this->Distributor_model->get_unique_zone_code_with_name();
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


        $hasPermission = false;
        if (!empty($data['permissions']) && is_array($data['permissions'])) {
            foreach ($data['permissions'] as $p) {
                if ($p['module_name'] === "User - Dist.Mapping" && $p['view'] === "yes") {
                    $hasPermission = true;
                    break;
                }
            }
        }


        if (!$hasPermission) {
            redirect('admin/Access_denied');
            return;
        }


        $this->load->view('admin/header', $data);
        $this->load->view('admin/maping', $data);
        $this->load->view('admin/footer', $data);
    }

    public function submit_maping()
    {
        $back_user_id = $this->session->userdata('back_user_id');

        if (!$back_user_id) {
            redirect('admin/login');
        }

        // Load the log model at the start
        $this->load->model('Mapping_log_report_model');

        $this->form_validation->set_rules('distributors_code[]', 'Distributor Code', 'required');
        $this->form_validation->set_rules('Sales_Code', 'Sales Code', 'required');
        $this->form_validation->set_rules('Distribution_Channel_Code', 'Distribution Channel Code', 'required');
        $this->form_validation->set_rules('Division_Code', 'Division Code', 'required');
        $this->form_validation->set_rules('Customer_Type_Code', 'Customer Type Code', 'required');
        $this->form_validation->set_rules('Customer_Group_Code', 'Customer Group Code', 'required');
        //$this->form_validation->set_rules('level1', 'Level 1', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/maping');
        } else {

            $distributors = array_unique($this->input->post('distributors_code[]'));


            $success_msgs = [];
            $error_msgs = [];

            date_default_timezone_set('Asia/Kolkata');
            foreach ($distributors as $distributor_code) {

                $new_sequence = $this->Maping_model->get_next_global_sequence();

                $data = array(
                    'distributors_id' => $distributor_code . '_' . str_pad($new_sequence, 4, '0', STR_PAD_LEFT),
                    'DB_Code' => $distributor_code,
                    'Sales_Code' => $this->input->post('Sales_Code'),
                    'Distribution_Channel_Code' => $this->input->post('Distribution_Channel_Code'),
                    'Division_Code' => $this->input->post('Division_Code'),
                    'Customer_Type_Code' => $this->input->post('Customer_Type_Code'),
                    'Customer_Group_Code' => $this->input->post('Customer_Group_Code'),
                    'Level_1' => $this->input->post('level1'),
                    'Level_2' => $this->input->post('level2'),
                    'Level_3' => $this->input->post('level3'),
                    'Level_4' => $this->input->post('level4'),
                    'Level_5' => $this->input->post('level5'),
                    'Level_6' => $this->input->post('level6'),
                    'Level_7' => $this->input->post('level7'),
                    'create_date' => date('Y-m-d H:i:s')
                );


                $this->load->model('Mapping_log_report_model');


                $insert_id = $this->Maping_model->insert_mapping($data);
                if ($insert_id) {
                    $user_id = $this->db->insert_id(); 


                    $this->db->trans_start();
                    $log_new = array(
                        'user_id' => $user_id,
                        'parent_id' => null,
                        'action' => 'MAPPING_INSERT',
                        'data' => json_encode([[$data]]),
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' =>   $back_user_id,
                    );

                    $this->db->insert('ci_mapping_activity', $log_new);
                    $this->db->trans_complete();


                    $success_msgs[] = 'Mapping for Distributor ' . $distributor_code . ' Successfully inserted - Successfully Done.';
                } else {

                    $error_msgs[] = 'An error occurred while inserting mapping for Distributor ' . $distributor_code . '.';
                }
            }


            if (!empty($success_msgs)) {
                $this->session->set_flashdata('success', implode('<br>', $success_msgs));
            }
            if (!empty($error_msgs)) {
                $this->session->set_flashdata('error', implode('<br>', $error_msgs));
            }

            redirect('admin/maping');
        }
    }
}
