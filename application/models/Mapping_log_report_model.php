<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapping_log_report_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function get_all_Maping()
    {
        $query = $this->db->get('employee');

        return $query->result_array();
    }



}
