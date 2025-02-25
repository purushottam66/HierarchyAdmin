<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Designation_model extends CI_Model
{
    public function get_all_designations()
    {
        $this->db->select('id, Designation, Designation_Label');
        $this->db->from('designations');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_designation_by_name($name)
    {
        $this->db->where('Designation', $name);
        $query = $this->db->get('designations');
        return $query->row_array();
    }




    public function create_designation($data)
    {
        return $this->db->insert('designations', $data);
    }



    public function save_designation($data)
    {
        return $this->db->insert('designations', $data);
    }


    public function get_designation_by_id($id)
    {
        return $this->db->get_where('designations', ['id' => $id])->row_array();
    }

    public function update_designation($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('designations', $data);
    }
}
