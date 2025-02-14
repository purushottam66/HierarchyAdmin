<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
    }

    public function login()
    {
        // Check if the user is already logged in
        if ($this->session->userdata('back_user_id')) {
            redirect('admin/hierarchydata'); // Redirect to the dashboard if already logged in
        }
    
        if ($this->input->method() === 'post') {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->User_model->validate_user($email, $password);
            if ($user) {
                $this->session->set_userdata('role_id', $user['role_id']);
                $this->session->set_userdata('back_user_id', $user['id']);
                $this->session->set_userdata('user_name', $user['name']);
                $this->session->set_flashdata('success', 'Login successful!');
                redirect('admin/hierarchydata');
            } else {
                $this->session->set_flashdata('error', 'Invalid email or password.');
                redirect('admin/login');
            }
        } else {
            $this->load->view('admin/login');
        }
    }
    


    public function forgot_password() {}



    public function logout()
    {

        $this->session->sess_destroy();
        redirect('admin/login');
    }
}
