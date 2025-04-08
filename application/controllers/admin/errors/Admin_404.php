<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_404 extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->output->set_status_header('404');
        
        if ($this->session->userdata('back_user_id')) {
            $this->load->view('admin/errors/404');
        } else {
            redirect('admin/login');
        }
    }
}