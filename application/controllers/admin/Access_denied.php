<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Access_denied extends   CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->output->set_header('X-Content-Type-Options: nosniff');
        	
            $this->output->set_header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
            $this->output->set_header('X-XSS-Protection: 1; mode=block');
        $this->load->model('User_model');
        $this->load->library('session');
    }

    public function index(){

        $back_user_id = $this->session->userdata('back_user_id');
        if (!$back_user_id) {
            redirect('admin/login');
        }

      
        $this->load->view('admin/access-denied');
     


    }




}