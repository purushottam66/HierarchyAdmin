<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->output->set_header('X-Content-Type-Options: nosniff');
        //
        $this->output->set_header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
        $this->output->set_header('X-XSS-Protection: 1; mode=block');
        $this->load->model('User_model');
        $this->load->library('email');


    }
    public function index()
    {

        $this->load->view('admin/login');
    }

    public function forgot_password()
    {

        $this->load->view('admin/forgot-password');
    }

    public function forgotpassword()
    {
        $email_or_mobile = $this->input->post('email_or_mobile');
        $user = $this->User_model->find_user_by_email_or_mobile($email_or_mobile);

        if ($user) {
            $otp = rand(1000, 9999);
            $this->User_model->save_otp($user['id'], $otp);

            $this->session->set_userdata('back_user_id', $user['id']);

            if (filter_var($email_or_mobile, FILTER_VALIDATE_EMAIL)) {

                $config = array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'smtp.gmail.com',
                    'smtp_port' => 587,
                    'smtp_user' => 'smcstore110096@gmail.com',
                    'smtp_pass' => 'oksoccfzromepkis',
                    'mailtype'  => 'html',
                    'charset'   => 'utf-8',
                    'newline'   => "\r\n",
                    'smtp_crypto' => 'tls',
                    'SMTPDebug' => 2,
                );

                $this->email->initialize($config);

                $this->email->from('smcstore110096@gmail.com', 'Hierarchy Sels');
                $this->email->to($user['email']);
                $this->email->subject('Your OTP for Password Reset');

                $message = "
                    <p>Dear {$user['username']},</p>
                    <p>Your OTP for password reset is: <strong>{$otp}</strong></p>
                    <p>Please use this OTP to reset your password. It is valid for 1 minutes.</p>
                    <p>Thank you,<br>Your Website Team</p>
                ";

                $this->email->message($message);

                if ($this->email->send()) {
                    $this->session->set_flashdata('success', 'OTP has been sent to your email.');

                    redirect('admin/otp');
                } else {
                    $this->session->set_flashdata('error', 'Failed to send OTP. Please try again.');
                }
            } else {
            }
        } else {
            $this->session->set_flashdata('error', 'User not found with the provided email.');
        }

        redirect('admin/forgot-password');
    }


    public function otp()
    {
        date_default_timezone_set('Asia/Kolkata');


        $user_id = $this->session->userdata('back_user_id');

        if (!$user_id) {

            $this->session->set_flashdata('error', 'Session expired or OTP not requested. Please request a new OTP.');
            redirect('admin/forgot-password');
        }


        $this->load->model('User_model');
        $otp_record = $this->User_model->get_otp_by_user_id($user_id);

        if ($otp_record) {

            $current_time = date('Y-m-d H:i:s');
            $expiration_time = date('Y-m-d H:i:s', strtotime($otp_record['created_at'] . ' +5 minute'));

            if ($current_time < $expiration_time) {

                $data['otp'] = $otp_record['otp'];
                $data['expiration_time'] = $expiration_time;
            } else {

                $data['otp'] = null;
                $data['expiration_time'] = $expiration_time;
                $this->User_model->delete_otp($user_id);
                $this->session->set_flashdata('error', 'OTP has expired. Please request a new OTP.');
                redirect('admin/forgot-password');
            }
        } else {

            $this->session->set_flashdata('error', 'No OTP found. Please request a new OTP.');
            redirect('admin/forgot-password');
        }


        $this->load->view('admin/otp', $data);
    }




    public function verify_otp()
    {

        $otp_digit1 = $this->input->post('otp_digit1');
        $otp_digit2 = $this->input->post('otp_digit2');
        $otp_digit3 = $this->input->post('otp_digit3');
        $otp_digit4 = $this->input->post('otp_digit4');


        $otp = $otp_digit1 . $otp_digit2 . $otp_digit3 . $otp_digit4;


        $user_id = $this->session->userdata('back_user_id');
        $is_valid_otp = $this->User_model->verify_otp($user_id, $otp);

        if ($is_valid_otp) {
            $this->session->set_flashdata('success', 'OTP verified successfully.');
            redirect('admin/change-password');
        } else {

            $this->session->set_flashdata('error', 'Invalid OTP. Please try again.');
            redirect('admin/otp');
        }
    }


    public function change_password()
    {

        $this->load->view('admin/change-password');
    }


    public function update_password()
    {

        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[8]');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('admin/change-password');
        } else {

            $new_password = $this->input->post('new_password');


            $user_id = $this->session->userdata('back_user_id');

            if (!$user_id) {
                $this->session->set_flashdata('error', 'Session expired. Please log in again.');
                redirect('admin/login');
                return;
            }


            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            $update_success = $this->User_model->update_password($user_id, $hashed_password);
            if ($update_success) {
                $user = $this->User_model->get_user_by_id($user_id);  // Ensure this method returns user details
                if ($user) {
                    // Email configuration
                    $config = array(
                        'protocol' => 'smtp',
                        'smtp_host' => 'smtp.gmail.com', // Replace with your SMTP server
                        'smtp_port' => 587, // Typically 587 for TLS, 465 for SSL
                        'smtp_user' => 'smcstore110096@gmail.com', // Your SMTP username
                        'smtp_pass' => 'oksoccfzromepkis', // Your SMTP password
                        'mailtype'  => 'html', // or 'text' for plain text emails
                        'charset'   => 'utf-8',
                        'newline'   => "\r\n",
                        'smtp_crypto' => 'tls', // or 'ssl'
                        'SMTPDebug' => 2, // Enable verbose debug output
                    );

                    $this->email->initialize($config);

                    $this->email->from('smcstore110096@gmail.com', 'Hierarchy Sels');
                    $this->email->to($user['email']);
                    $this->email->subject('Your Password Has Been Changed');

                    $message = "
                        <p>Dear {$user['username']},</p>
                        <p>Your password has been successfully changed.</p>
                        <p>If you did not request this change, please contact us immediately.</p>
                        <p>Thank you,<br>crazibrain Team</p>
                    ";

                    $this->email->message($message);

                    if ($this->email->send()) {
                        $this->session->set_flashdata('success', 'Password updated successfully Changed.');
                    } else {
                        $this->session->set_flashdata('error', 'Password updated but email not send');
                    }
                }
                redirect('admin/login');
            } else {
                $this->session->set_flashdata('error', 'Failed to update password. Please try again.');
                $this->load->view('admin/change-password');
            }
        }
    }



    public function update_pjp_code($level, $pjp_code_old, $set_pjp_code)
    {

        $data = [
            'pjp_code' => $set_pjp_code
        ];


        $this->db->where('level', $level);
        $this->db->where('pjp_code', $pjp_code_old);
        $this->db->update('mapping', $data);


        return ($this->db->affected_rows() > 0);
    }
}
