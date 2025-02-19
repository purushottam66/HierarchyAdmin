<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Zone_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_Zone()
    {
        $query = $this->db->get('zones');
        return $query->result_array();
    }

    public function get_zone_permissions_by_user_id($user_id)
    {
        $this->db->select('zone_id'); // Adjust columns as needed
        $this->db->from('zone_permissions'); // Table where permissions are stored
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();

        return $query->result_array();
    }
}
