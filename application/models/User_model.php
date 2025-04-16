<?php

class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function validate_user($email, $password)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        $user = $query->row_array();
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }


    


    public function find_user_by_email_or_mobile($email_or_mobile)
    {
        $this->db->where('email', $email_or_mobile);
        $this->db->or_where('mobile', $email_or_mobile);
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function save_otp($user_id, $otp)
    {
        date_default_timezone_set('Asia/Kolkata');
        $current_time = date('Y-m-d H:i:s');

        $data = array(
            'otp' => $otp,
            'created_at' => $current_time
        );

        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user_otp');

        if ($query->num_rows() > 0) {
            $this->db->where('user_id', $user_id);
            return $this->db->update('user_otp', $data);
        } else {
            $data['user_id'] = $user_id;
            return $this->db->insert('user_otp', $data);
        }
    }



    public function verify_otp($user_id, $otp)
    {
        date_default_timezone_set('Asia/Kolkata');
        $expiry_time = date('Y-m-d H:i:s', strtotime('-5 minute'));
        $this->db->where('user_id', $user_id);
        $this->db->where('otp', $otp);
        $this->db->where('created_at >=', $expiry_time);
        $query = $this->db->get('user_otp');

        if ($query->num_rows() == 1) {
            return true;
        } else {
            $this->db->where('user_id', $user_id);
            $this->db->where('otp', $otp);
            $this->db->delete('user_otp');
            return false;
        }
    }


    public function cleanup_expired_otps()
    {
        date_default_timezone_set('Asia/Kolkata');
        $expiration_time = date('Y-m-d H:i:s', strtotime('-5 minute'));
        $this->db->where('created_at <', $expiration_time);
        $this->db->delete('user_otp');
        $deleted_rows = $this->db->affected_rows();
    }



    public function get_user_by_id($user_id)
    {
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');
        return $query->row_array();
    }

    public function get_otp_by_user_id($user_id)
    {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user_otp');
        return $query->row_array();
    }

    public function delete_otp($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->delete('user_otp');
    }



    public function update_password($user_id, $hashed_password)
    {

        if (empty($user_id) || empty($hashed_password)) {
            return false;
        }
        $this->db->where('id', $user_id);
        $this->db->update('users', ['password' => $hashed_password]);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }



    public function get_all_user()
    {

        $this->db->select('users.*, roles.role_name');
        $this->db->from('users');
        $this->db->join('roles', 'users.role_id = roles.id');
        $this->db->where('roles.id', 5);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_user_by_email($email)
{
    return $this->db->where('email', $email)->get('users')->row_array();
}

public function update_login_attempts($user_id, $failed_attempts, $lock_time, $status)
{
    $data = [
        'failed_attempts' => $failed_attempts,
        'status' => $status // Update account status (0 = disabled)
    ];

    if ($lock_time) {
        $data['lock_until'] = date('Y-m-d H:i:s', strtotime($lock_time));
    }

    $this->db->where('id', $user_id)->update('users', $data);
}


public function reset_login_attempts($user_id)
{
    $this->db->where('id', $user_id)->update('users', [
        'failed_attempts' => 0,
        'lock_until' => null
    ]);
}

}
