<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Usermaster_model');
        $this->load->model('Distributor_model');

		$this->load->helper('menu'); // Load the menu helper

    }



    public function index()
    {
        // $data['hierarchy_json'] = $this->generate_json($data['sales_hierarchy']);
        $data['users'] = $this->Usermaster_model->get_sales_hierarchy();
    
    
        // Debugging the data (using print_r instead of Pandas DataFrame)
        //  echo "<pre>";
          // print_r($data['users']);
         // echo "</pre>";
         // die();
    
        // Loading the view with the data
        $this->load->view('index', $data);
    }
    

	public function login()
	{
		

		$this->load->view('login');
	}

	public function forgot_password() {


        $this->load->view('forgot-password');
    }

	public function otp() {


        $this->load->view('otp');
    }

    public function enterpass() {


        $this->load->view('enterpass');
    }


	
    private function generate_json($items, $parent = null) {
        $result = [];
        foreach ($items as $item) {
            if ($item['reporting_to'] == $parent) {
                $children = generate_json($items, $item['user_id']);
                $result[] = [
                    'user_id' => $item['user_id'],
                    'name' => $item['name'],
                    'email' => $item['email'],
                    'role' => $item['role'],
                    'level' => $item['level'],
                    'reporting_to' => $item['reporting_to'],
                    'subordinates' => $children
                ];
            }
        }
        return $result;
    }
    public function Usermaster_data() {
        $level = $this->input->get('level');
        $dbCode = $this->input->get('db_code');
        $id = $this->input->get('id');
    
        // Load the database library
        $this->load->database();
    
        // Validate inputs
        if (!$level || !$dbCode) {
            echo json_encode(['error' => 'Level or db_code not provided']);
            return;
        }
    
        // Fetch distributor data based on dbCode
        $distributor_data = $this->Distributor_model->get_data_by_level($dbCode);
    
        // Fetch usermaster and sales hierarchy data
        $usermaster_data = $this->Usermaster_model->get_data_by_level($level);
        $get_sales_hierarchy = $this->Distributor_model->get_sales_hierarchy($dbCode,$id);
    
        // Combine all data into a single array
        $data = [
            'distributor' => $distributor_data,
            'usermaster' => $usermaster_data,
            'get_sales_hierarchy' => $get_sales_hierarchy
        ];
    
        // Return the combined data as JSON
        echo json_encode($data);
    }
    
    



    public function distributorsAll()
    {
        // $data['hierarchy_json'] = $this->generate_json($data['sales_hierarchy']);
        $data['users'] = $this->Distributor_model->get_all_Distributors();
    
    
        // Debugging the data (using print_r instead of Pandas DataFrame)
           echo "<pre>";
            print_r($data['users']);
            echo "</pre>";
          die();
    
        // Loading the view with the data
        $this->load->view('index', $data);
    }
}
    
	