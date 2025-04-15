<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distributor_filter extends CI_Controller {
    
    public function __construct() {
        parent::__construct();

        $this->output->set_header('X-Content-Type-Options: nosniff');
        	
            $this->output->set_header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
            $this->output->set_header('X-XSS-Protection: 1; mode=block');
            ini_set('memory_limit', '512M'); // Or 1G

        
        // Load necessary models
        $this->load->model('Distributor_filter_model');
        $this->load->model('Role_model');
        $this->load->model('Distributor_model');
        $this->load->model('Zone_model');
        
        // Load necessary libraries
        $this->load->library('form_validation');

        $this->load->library('session');

        $user_id = $this->session->userdata('back_user_id');

        if (!$user_id) {

            $this->session->set_flashdata('error', 'Session expired. Please login again.');
            redirect('admin/login');
        }
    }

    public function get_hierarchy_filter_options() {



        // Validate user authentication
        $user_id = $this->session->userdata('back_user_id');
        if (!$user_id) {
            log_message('error', 'Unauthorized access attempt to hierarchy filter options');
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Unauthorized']));
            return;
        }

    
        // Load Distributor Model
        $this->load->model('Distributor_filter_model');
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
    
    
        // Fetch filter parameters from GET request
        $params = [
            'Sales_Code' => $this->input->get('Sales_Code', true),
            'Distribution_Channel_Code' => $this->input->get('Distribution_Channel_Code', true),
            'Division_Code' => $this->input->get('Division_Code', true),
            'Customer_Type_Code' => $this->input->get('Customer_Type_Code', true),
            'Customer_Group_Code' => $this->input->get('Customer_Group_Code', true),
            'Population_Strata_2' => $this->input->get('Population_Strata_2', true),
            'Zone' => $this->input->get('Zone', true),

            'State_Code' => $this->input->get('State_Code', true),
            'City' => $this->input->get('City', true),

        ];
    
        // Fetch data from Distributor_model based on filters
        $data = $this->Distributor_filter_model->get_filtered_distributors($zone_ids , $params);
    
        // Return JSON response
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
    
}
