<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Log_report extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function get_all_Log_report()
    {
        $query = $this->db->get('log_report');

        return $query->result_array();
    }


    public function create_log($data)
    {
        return $this->db->insert('log_report', $data);
    }
    

    public function create_multiple_logs($log_entries)
{
    if (!empty($log_entries)) {
        $this->db->insert_batch('log_report', $log_entries);
    }
}





}
