<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermaster_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_maping() {
        $query = $this->db->get('maping');
        return $query->result_array();
    }


    public function get_all_sales_usermaster() {
        $query = $this->db->get('usermaster');
        return $query->result_array(); // Change this to return arrays
    }
    
    // public function get_all_userkey() {
    //     $query = $this->db->get('userkey');
    //     return $query->result_array(); // Change this to return arrays
    // }
    public function get_sales_hierarchy() {
        $Pjp_Code = 'BH1995';
        
        $usermaster_data = $this->db->get('usermaster')->result_array();
        $mapping_data = $this->db->get('maping')->result_array();
        
        $user_data = null;
        $mappings = [];
        
        // Find the user with the specific Pjp_Code
        foreach ($usermaster_data as $user) {
            if ($user['Pjp_Code'] === $Pjp_Code) {
                $user_data = $user;
                break;
            }
        }
        
        // If user data is found, find all mappings associated with this user
        if ($user_data) {
            foreach ($mapping_data as $map) {
                if ($map['Level_1'] === $Pjp_Code) {
                    // Handle null levels by providing default values if necessary
                    $mappings[] = [
                        'id' => $map['id'],
                        'DB_Code' => $map['DB_Code'],
                        'Distinct_Column' => $map['Distinct_Column'],
                        'Level_1' => $map['Level_1'] ?? 'Vacand',
                        'Level_2' => $map['Level_2'] ?? 'Vacand',
                        'Level_3' => $map['Level_3'] ?? 'Vacand',
                        'Level_4' => $map['Level_4'] ?? 'Vacand',
                        'Level_5' => $map['Level_5'] ?? 'Vacand',
                        'Level_6' => $map['Level_6'] ?? 'Vacand',
                        'Level_7' => $map['Level_7'] ?? 'Vacand'
                    ];
                }
            }
            
            // Construct the final hierarchy
            $hierarchy = [
                'user' => $user_data,
                'mappings' => $mappings
            ];
        } else {
            // If no user data found, return an empty result or handle accordingly
            $hierarchy = [
                'user' => [],
                'mappings' => []
            ];
        }
        
        return $hierarchy;
    }
    
    
    
    


    public function get_maping_by_id($id) {
        $query = $this->db->get_where('maping', array('Employer_Code' => $id));
        return $query->row_array();
    }



    public function get_data_by_level($level) {
        $this->db->select('*');
        $this->db->from('usermaster'); 
        $this->db->where('Pjp_Code', $level); 

        $query = $this->db->get();
        return $query->result_array();
    }


}