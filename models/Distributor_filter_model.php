<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Distributor_filter_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    /**
     * Get unique values for hierarchy filters based on current selections
     * 
     * @param array $current_filters Current filter selections
     * @return array Unique values for hierarchy filters
     */

    public function get_filtered_distributors($zone_ids, $params = [])
    {

        if (empty($zone_ids) || !is_array($zone_ids)) {
            return ['data' => [], 'total_count' => 0];
        }
        $this->db->select('Sales_Code, Sales_Name, Distribution_Channel_Code, Distribution_Channel_Name, Division_Code, Division_Name, Customer_Type_Code, Customer_Type_Name, Customer_Group_Code, Customer_Group_Name, Population_Strata_2,Zone_Code,Zone , State_Code, State, City');
        $this->db->from('distributors');

        $this->db->where_in('distributors.Zone_Code', $zone_ids);


        if (empty($params)) {
            $this->db->select('Sales_Code, Sales_Name');
            $this->db->group_by('Sales_Code, Sales_Name');
            $query = $this->db->get();
            return $query->result_array();
        }




        if (!empty($params['Sales_Code'])) {
            if (is_array($params['Sales_Code'])) {
                $this->db->where_in('Sales_Code', $params['Sales_Code']);
            } else {
                $this->db->where('Sales_Code', $params['Sales_Code']);
            }
        }

        if (!empty($params['Distribution_Channel_Code'])) {
            if (is_array($params['Distribution_Channel_Code'])) {
                $this->db->where_in('Distribution_Channel_Code', $params['Distribution_Channel_Code']);
            } else {
                $this->db->where('Distribution_Channel_Code', $params['Distribution_Channel_Code']);
            }
        }

        if (!empty($params['Division_Code'])) {
            if (is_array($params['Division_Code'])) {
                $this->db->where_in('Division_Code', $params['Division_Code']);
            } else {
                $this->db->where('Division_Code', $params['Division_Code']);
            }
        }

        if (!empty($params['Customer_Type_Code'])) {
            if (is_array($params['Customer_Type_Code'])) {
                $this->db->where_in('Customer_Type_Code', $params['Customer_Type_Code']);
            } else {
                $this->db->where('Customer_Type_Code', $params['Customer_Type_Code']);
            }
        }

        if (!empty($params['Customer_Group_Code'])) {
            if (is_array($params['Customer_Group_Code'])) {
                $this->db->where_in('Customer_Group_Code', $params['Customer_Group_Code']);
            } else {
                $this->db->where('Customer_Group_Code', $params['Customer_Group_Code']);
            }
        }

        if (!empty($params['Population_Strata_2'])) {
            if (is_array($params['Population_Strata_2'])) {
                $this->db->where_in('Population_Strata_2', $params['Population_Strata_2']);
            } else {
                $this->db->where('Population_Strata_2', $params['Population_Strata_2']);
            }
        }





        if (empty($params)) {
            $this->db->select('Zone_Code, Zone');
            $this->db->group_by('Zone_Code, Zone');
            $query = $this->db->get();
            return $query->result_array();
        }

        if (empty($params)) {
            $this->db->select('State_Code, State');
            $this->db->group_by('State_Code, State');
            $query = $this->db->get();
            return $query->result_array();
        }


        if (!empty($params['State_Code'])) {
            if (is_array($params['State_Code'])) {
                $this->db->where_in('State_Code', $params['State_Code']);
            } else {
                $this->db->where('State_Code', $params['State_Code']);
            }
        }


        if (!empty($params['city'])) {
            if (is_array($params['city'])) {
                $this->db->where_in('city', $params['city']);
            } else {
                $this->db->where('city', $params['city']);
            }
        }




        $query = $this->db->get();

        return $query->result_array();
    }
}
