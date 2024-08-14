<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distributor_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_Distributors() {
        $query = $this->db->get('distributors');
        return $query->result_array();
    }

    public function get_data_by_level($dbCode) {
        $this->db->select('*');
        $this->db->from('distributors'); 
        $this->db->where('Customer_Code', $dbCode); 

        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_sales_hierarchy($dbCode, $id) {
        // Fetch usermaster and mapping data from the database
        $usermaster_data = $this->db->get('usermaster')->result_array();
        $mapping_data = $this->db->get('maping')->result_array();
        
        $user_data = null;
        $mappings = [];
    
        // Find the mapping associated with the given id first
        $matching_map = null;
        foreach ($mapping_data as $map) {
            if ($map['id'] === $id) {
                $matching_map = $map;
                break;
            }
        }
    
        // If a matching map is found and its DB_Code matches the given dbCode
        if ($matching_map && $matching_map['DB_Code'] === $dbCode) {
            // Find the user with the specific Pjp_Code in Level_1
            foreach ($usermaster_data as $user) {
                if ($user['Pjp_Code'] === $matching_map['Level_1']) {
                    $user_data = $user;
                    break;
                }
            }
    
            // Create an array to store the level details
            $levels = [];
            // Loop through each level from Level_1 to Level_7
            for ($i = 1; $i <= 7; $i++) {
                $level_key = 'Level_' . $i;
                $level_code = $matching_map[$level_key] ?? 'Vacand';
    
                // Fetch user details for this level's Pjp_Code
                $level_user = $this->db->get_where('usermaster', ['Pjp_Code' => $level_code])->row_array();
    
                // Add the user details to the levels array
                $levels[$level_key] = [
                    'Pjp_Code' => $level_code,
                    'Name' => $level_user['Name'] ?? 'Vacand',
                    'Designation' => $level_user['Designation'] ?? 'Vacand'
                ];
            }
    
            // Add the mapping data along with the levels to the mappings array
            $mappings[] = [
                'id' => $matching_map['id'],
                'DB_Code' => $matching_map['DB_Code'],
                'Distinct_Column' => $matching_map['Distinct_Column'],
                'Levels' => $levels
            ];
        }
    
        // Construct the final hierarchy
        $hierarchy = [
            'user' => $user_data ?? [],
            'mappings' => $mappings
        ];
    
        return $hierarchy;
    }
    
    
    


    // public function get_sales_hierarchy($dbCode) {
    //     $Pjp_Code = 'ZSM2003';
        
    //     // Fetch all usermaster and mapping data
    //     $usermaster_data = $this->db->get('usermaster')->result_array();
    //     $mapping_data = $this->db->get('maping')->result_array();
        
    //     $user_data = null;
    //     $mappings = [];
        
    //     // Find the user with the specific Pjp_Code
    //     foreach ($usermaster_data as $user) {
    //         if ($user['Pjp_Code'] === $Pjp_Code) {
    //             $user_data = $user;
    //             break;
    //         }
    //     }
        
    //     // If user data is found, find all mappings associated with this user
    //     if ($user_data) {
    //         foreach ($mapping_data as $map) {
    //             // Create an array to store the level details
    //             $levels = [];
                
    //             // Loop through each level from Level_1 to Level_7
    //             for ($i = 1; $i <= 7; $i++) {
    //                 $level_key = 'Level_' . $i;
    //                 $level_code = $map[$level_key] ?? 'Vacand';
                    
    //                 // Fetch user details for this level's Pjp_Code
    //                 $level_user = $this->db->get_where('usermaster', ['Pjp_Code' => $level_code])->row_array();
                    
    //                 // Add the user details to the levels array
    //                 $levels[$level_key] = [
    //                     'Pjp_Code' => $level_code,
    //                     'Name' => $level_user['Name'] ?? 'Vacand',
    //                     'Designation' => $level_user['Designation'] ?? 'Vacand'
    //                 ];
    //             }
                
    //             // Add the mapping data along with the levels to the mappings array
    //             $mappings[] = [
    //                 'id' => $map['id'],
    //                 'DB_Code' => $map['DB_Code'],
    //                 'Distinct_Column' => $map['Distinct_Column'],
    //                 'Levels' => $levels
    //             ];
    //         }
            
    //         // Construct the final hierarchy
    //         $hierarchy = [
    //             'user' => $user_data,
    //             'mappings' => $mappings
    //         ];
    //     } else {
    //         // If no user data found, return an empty result or handle accordingly
    //         $hierarchy = [
    //             'user' => [],
    //             'mappings' => []
    //         ];
    //     }
        
    //     return $hierarchy;
    // }
}