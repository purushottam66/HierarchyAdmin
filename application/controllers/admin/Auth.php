<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        

        $this->output->set_header('X-Content-Type-Options: nosniff');
        //
        $this->output->set_header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
        $this->output->set_header('X-XSS-Protection: 1; mode=block');
        $this->load->model('User_model');
        $this->load->library('session');
        ini_set('memory_limit', '512M'); // Or 1G




        
        
        
  
    }

    public function login()
    {
        date_default_timezone_set('Asia/Kolkata');

        if ($this->session->userdata('back_user_id')) {
            redirect('admin/hierarchydata');
        }

        if ($this->input->method() === 'post') {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $recaptchaResponse = $this->input->post('g-recaptcha-response');

            // Check if email is blocked
            $blocked = $this->check_email_blocked($email);
            if ($blocked) {
                $this->session->set_flashdata('error', 'This email is temporarily blocked due to multiple failed attempts. Please try again later.');
                redirect('admin/login');
            }

            // Validate reCAPTCHA
            if (!$this->verifyRecaptcha($recaptchaResponse)) {
                $this->session->set_flashdata('error', 'reCAPTCHA verification failed. Please try again.');
                redirect('admin/login');
            }

            $user = $this->User_model->get_user_by_email($email);

            if ($user) {
                // Check if account is manually locked
                if ($user['status'] == 0) {
                    $this->session->set_flashdata('error', 'Your account has been disabled. Contact admin.');
                    redirect('admin/login');
                }

                // Check if account is temporarily locked
                if ($user['lock_until'] !== null && strtotime($user['lock_until']) > time()) {
                    $this->session->set_flashdata('error', 'Your account is locked until ' . date('Y-m-d H:i:s', strtotime($user['lock_until'])));
                    redirect('admin/login');
                }

                // Validate password
                if (password_verify($password, $user['password'])) {
                    $this->User_model->reset_login_attempts($user['id']);
                    $this->reset_email_attempts($email); // Reset cookie-based attempts

                    $this->session->set_userdata('role_id', $user['role_id']);
                    $this->session->set_userdata('back_user_id', $user['id']);
                    $this->session->set_userdata('user_name', $user['name']);
                    $this->session->set_flashdata('success', 'Login successful!');
                    redirect('admin/hierarchydata');
                } else {
                    $this->increment_failed_attempts($email);
                    $this->handle_failed_login($user['id'], $user['failed_attempts']);
                }
            } else {
                $this->increment_failed_attempts($email);
                $this->session->set_flashdata('error', 'Invalid email or password.');
                redirect('admin/login');
            }
        } else {
            $this->load->view('admin/login');
        }
    }

    private function check_email_blocked($email)
    {
        $this->db->where('email', $email);
        $this->db->where('lock_until >', date('Y-m-d H:i:s'));
        $query = $this->db->get('login_attempts');
        return $query->num_rows() > 0;
    }

    private function increment_failed_attempts($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('login_attempts');

        if ($query->num_rows() > 0) {
            $attempt = $query->row_array();
            $new_attempts = $attempt['attempts'] + 1;
            
            if ($new_attempts >= 3) {
                // Block for 1 hour after 3 attempts
                $lock_until = date('Y-m-d H:i:s', strtotime('+1 hour'));
                $this->db->where('email', $email);
                $this->db->update('login_attempts', [
                    'attempts' => $new_attempts,
                    'lock_until' => $lock_until
                ]);
            } else {
                $this->db->where('email', $email);
                $this->db->update('login_attempts', ['attempts' => $new_attempts]);
            }
        } else {
            $this->db->insert('login_attempts', [
                'email' => $email,
                'attempts' => 1,
                'ip_address' => $this->input->ip_address()
            ]);
        }
    }

    private function reset_email_attempts($email)
    {
        $this->db->where('email', $email);
        $this->db->delete('login_attempts');
    }





    private function verifyRecaptcha($recaptchaResponse)
    {
        $secretKey = '6LeBggIrAAAAADdgzrYnYjdRokkHTPPG-jwRatGw'; // Replace with your reCAPTCHA secret key
        $verifyUrl = "https://www.google.com/recaptcha/api/siteverify";

        $response = file_get_contents($verifyUrl . "?secret=" . $secretKey . "&response=" . $recaptchaResponse);
        $responseData = json_decode($response, true);

        return isset($responseData['success']) && $responseData['success'];
    }


    private function handle_failed_login($user_id, $failed_attempts)
    {
        date_default_timezone_set('Asia/Kolkata'); // Set timezone

        $new_attempts = $failed_attempts + 1;
        $lock_time = null;
        $status = 1; // Default status (active)

        if ($new_attempts >= 3 && $new_attempts < 6) {
            $lock_time = '+1 hour';
        } elseif ($new_attempts >= 6 && $new_attempts < 9) {
            $lock_time = '+4 hours';
        } elseif ($new_attempts >= 9) {
            $lock_time = '+24 hours';
            $status = 0;  // Disable the account
        }

        // Update login attempts and status
        $this->User_model->update_login_attempts($user_id, $new_attempts, $lock_time, $status);

        $this->session->set_flashdata('error', 'Invalid email or password.');
        redirect('admin/login');
    }



    public function forgot_password() {}



    public function logout()
    {

        $this->session->sess_destroy();
        redirect('admin/login');
    }
}
