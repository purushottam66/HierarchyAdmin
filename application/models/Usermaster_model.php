<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usermaster_model extends CI_Model
{

    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->load->database();
    // }

    // public function get_all_maping()
    // {
    //     $query = $this->db->get('maping');
    //     return $query->result_array();
    // }


    // public function get_all_sales_usermaster()
    // {
    //     $query = $this->db->get('usermaster');
    //     return $query->result_array(); 
    // }


    // public function get_sales_hierarchy($Pjp_Code)
    // {
    //     $Pjp_Code = $Pjp_Code;

    //     $usermaster_data = $this->db->get('employee')->result_array();
    //     $mapping_data = $this->db->get('maping')->result_array();

    //     $user_data = null;
    //     $mappings = [];


    //     foreach ($usermaster_data as $user) {
    //         if ($user['pjp_code'] === $Pjp_Code) {
    //             $user_data = $user;
    //             break;
    //         }
    //     }

    //     if ($user_data) {
    //         foreach ($mapping_data as $map) {
    //             if ($map['Level_1'] === $Pjp_Code) {

    //                 $mappings[] = [
    //                     'id' => $map['id'],
    //                     'DB_Code' => $map['DB_Code'],
    //                     'Level_1' => $map['Level_1'] ?? 'Vacant',
    //                     'Level_2' => $map['Level_2'] ?? 'Vacant',
    //                     'Level_3' => $map['Level_3'] ?? 'Vacant',
    //                     'Level_4' => $map['Level_4'] ?? 'Vacant',
    //                     'Level_5' => $map['Level_5'] ?? 'Vacant',
    //                     'Level_6' => $map['Level_6'] ?? 'Vacant',
    //                     'Level_7' => $map['Level_7'] ?? 'Vacant'
    //                 ];
    //             }
    //         }


    //         $hierarchy = [
    //             'user' => $user_data,
    //             'mappings' => $mappings
    //         ];
    //     } else {

    //         $hierarchy = [
    //             'user' => [],
    //             'mappings' => []
    //         ];
    //     }

    //     return $hierarchy;
    // }






    // public function get_maping_by_id($id)
    // {
    //     $query = $this->db->get_where('maping', array('Employer_Code' => $id));
    //     return $query->row_array();
    // }



    // public function get_data_by_level($level)
    // {
    //     $this->db->select('*');
    //     $this->db->from('usermaster');
    //     $this->db->where('Pjp_Code', $level);

    //     $query = $this->db->get();
    //     return $query->result_array();
    // }






    // public function get_sales_hierarchy_ajex($id, $level)
    // {
    //     $Pjp_Code = 'BH1995';

    //     $usermaster_data = $this->db->get('employee')->result_array();
    //     $mapping_data = $this->db->get('maping')->result_array();

    //     $user_data = null;
    //     $mappings = [];

    //     foreach ($usermaster_data as $user) {
    //         if ($user['pjp_code'] === $Pjp_Code) {
    //             $user_data = $user;
    //             break;
    //         }
    //     }

    //     if ($user_data) {
    //         foreach ($mapping_data as $map) {
    //             if ($map['Level_1'] === $Pjp_Code) {

    //                 $mappings[] = [
    //                     'id' => $map['id'],
    //                     'DB_Code' => $map['DB_Code'],
    //                     'Level_1' => $map['Level_1'] ?? 'Vacant',
    //                     'Level_2' => $map['Level_2'] ?? 'Vacant',
    //                     'Level_3' => $map['Level_3'] ?? 'Vacant',
    //                     'Level_4' => $map['Level_4'] ?? 'Vacant',
    //                     'Level_5' => $map['Level_5'] ?? 'Vacant',
    //                     'Level_6' => $map['Level_6'] ?? 'Vacant',
    //                     'Level_7' => $map['Level_7'] ?? 'Vacant'
    //                 ];
    //             }
    //         }


    //         $hierarchy = [
    //             'user' => $user_data,
    //             'mappings' => $mappings
    //         ];
    //     } else {

    //         $hierarchy = [
    //             'user' => [],
    //             'mappings' => []
    //         ];
    //     }

    //     return $hierarchy;
    // }
}
