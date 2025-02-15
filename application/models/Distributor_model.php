<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Distributor_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }



    public function get_distributor_with_employees()
    {
        $this->db->select('d.DB_Code, e.Level_1, e.Level_2, e.Level_3, e.Level_4, e.Level_5, e.Level_6, e.Level_7');
        $this->db->from('distributors d');
        $this->db->join('employees e', 'd.DB_Code = e.Level_1', 'left');
        $this->db->where('e.Level_2 = d.Level_2');
        $this->db->where('e.Level_3 = d.Level_3');
        $this->db->where('e.Level_4 = d.Level_4');
        $this->db->where('e.Level_5 = d.Level_5');
        $this->db->where('e.Level_6 = d.Level_6');
        $this->db->where('e.Level_7 = d.Level_7');
        $query = $this->db->get();
        return $query->result_array();
    }



    public function get_all_Distributors()
    {
        $query = $this->db->get('distributors');
        return $query->result_array();
    }
    public function get_all_zones()
    {
        $this->db->select('Zone_Code, Zone');
        $this->db->group_by('Zone_Code');
        $query = $this->db->get('distributors');

        return $query->result_array();
    }

    public function get_unique_zones()
    {
        $this->db->distinct();
        $this->db->select('Zone');
        $query = $this->db->get('distributors');
        return $query->result_array();
    }



    public function getTotal_division($search = '')
    {
        $this->db->select('COUNT(DISTINCT Division_Code) as total_divisions');
        $this->db->from('distributors');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('Division_Code', $search);
            $this->db->or_like('Division_Name', $search);
            $this->db->group_end();
        }

        $query = $this->db->get();
        return $query->row()->total_divisions;
    }


    public function get_division($start, $length, $search = '')
    {
        $this->db->select('Division_Code, Division_Name');
        $this->db->from('distributors');
        $this->db->group_by('Division_Code');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('Division_Code', $search);
            $this->db->or_like('Division_Name', $search);
            $this->db->group_end();
        }

        $this->db->limit($length, $start);
        $query = $this->db->get();
        return $query;
    }

    public function get_unique_Division_Name()
    {


        $this->db->select('Division_Code, Division_Name');
        $this->db->group_by('Division_Code');
        $query = $this->db->get('distributors');

        return $query->result_array();
    }

    public function get_unique_Distribution_Channel_Name()
    {
        $this->db->distinct();
        $this->db->select('Distribution_Channel_Name,Distribution_Channel_Code');
        $query = $this->db->get('distributors');
        return $query->result_array();
    }
    public function get_unique_Sales_Name()
    {

        $this->db->select('Sales_Code, Sales_Name');
        $this->db->group_by('Sales_Code');
        $query = $this->db->get('distributors');


        $result = $query->result_array();


        return $result;
    }


    public function get_distributors_by_zone_ids($zone_ids)
    {
        if (empty($zone_ids)) {



            return [];
        }
        $this->db->where_in('Zone_Code', $zone_ids);
        $this->db->group_by('Sales_Code');

        $query = $this->db->get('distributors');

        return $query->result_array();
    }






    public function get_distributors_by_code($dbCodes)
    {
        $this->db->select('mp.DB_Code, ds.Customer_Name, GROUP_CONCAT(DISTINCT CONCAT(emp.employee_id, \':\', emp.name, \'(\', emp.designation, \')\') SEPARATOR \', \') AS employee_data');
        $this->db->from('maping mp');
        $this->db->join('distributors ds', 'ds.Customer_Code = mp.DB_Code', 'inner');
        $this->db->join('employee emp', 'emp.pjp_code IN (mp.Level_1, mp.Level_2, mp.Level_3, mp.Level_4, mp.Level_5, mp.Level_6, mp.Level_7)', 'left');
        $this->db->where_in('mp.DB_Code', $dbCodes);
        $this->db->group_by('mp.DB_Code, ds.Customer_Name');
        $query = $this->db->get();
        return $query->result_array();
    }








    public function get_data_by_level($dbCode)
    {
        $this->db->select('*');
        $this->db->from('distributors');
        $this->db->where('Customer_Code', $dbCode);

        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_sales_hierarchy($dbCode, $id)
    {

        $usermaster_data = $this->db->get('usermaster')->result_array();
        $mapping_data = $this->db->get('maping')->result_array();

        $user_data = null;
        $mappings = [];


        $matching_map = null;
        foreach ($mapping_data as $map) {
            if ($map['id'] === $id) {
                $matching_map = $map;
                break;
            }
        }


        if ($matching_map && $matching_map['DB_Code'] === $dbCode) {

            foreach ($usermaster_data as $user) {
                if ($user['Pjp_Code'] === $matching_map['Level_1']) {
                    $user_data = $user;
                    break;
                }
            }


            $levels = [];

            for ($i = 1; $i <= 7; $i++) {
                $level_key = 'Level_' . $i;
                $level_code = $matching_map[$level_key] ?? 'Vacant';


                $level_user = $this->db->get_where('usermaster', ['Pjp_Code' => $level_code])->row_array();


                $levels[$level_key] = [
                    'Pjp_Code' => $level_code,
                    'Name' => $level_user['Name'] ?? 'Vacant',
                    'Designation' => $level_user['Designation'] ?? 'Vacant'
                ];
            }


            $mappings[] = [
                'id' => $matching_map['id'],
                'DB_Code' => $matching_map['DB_Code'],

                'Levels' => $levels
            ];
        }


        $hierarchy = [
            'user' => $user_data ?? [],
            'mappings' => $mappings
        ];

        return $hierarchy;
    }



    public function get_unic_Distributors(
        $Sales_Code,
        $Distribution_Channel_Code,
        $Division_Code,
        $Customer_Type_Code,
        $Customer_Group_Code,
        $Population_Strata_2,
        $Zone,
        $limit,
        $offset
    ) {

        $this->db->select('d.*');
        $this->db->from('distributors d');

        if ($Sales_Code) {
            $this->db->where('d.Sales_Code', $Sales_Code);
        }
        if ($Distribution_Channel_Code) {
            $this->db->where('d.Distribution_Channel_Code', $Distribution_Channel_Code);
        }
        if ($Division_Code) {
            $this->db->where('d.Division_Code', $Division_Code);
        }
        if ($Customer_Type_Code) {
            $this->db->where('d.Customer_Type_Code', $Customer_Type_Code);
        }
        if ($Customer_Group_Code) {
            $this->db->where('d.Customer_Group_Code', $Customer_Group_Code);
        }
        if ($Population_Strata_2) {
            $this->db->where('d.Population_Strata_2', $Population_Strata_2);
        }
        if ($Zone) {
            $this->db->where('d.Zone_Code', $Zone);
        }

        $this->db->limit($limit, $offset);


        $query = $this->db->get();


        return $query->result();
    }



    public function get_total_unic_Distributors(
        $Sales_Code,
        $Distribution_Channel_Code,
        $Division_Code,
        $Customer_Type_Code,
        $Customer_Group_Code,
        $Population_Strata_2,
        $Zone
    ) {

        $this->db->select('COUNT(*) as total_count');
        $this->db->from('distributors d');

        if ($Sales_Code) {
            $this->db->where('d.Sales_Code', $Sales_Code);
        }
        if ($Distribution_Channel_Code) {
            $this->db->where('d.Distribution_Channel_Code', $Distribution_Channel_Code);
        }
        if ($Division_Code) {
            $this->db->where('d.Division_Code', $Division_Code);
        }
        if ($Customer_Type_Code) {
            $this->db->where('d.Customer_Type_Code', $Customer_Type_Code);
        }
        if ($Customer_Group_Code) {
            $this->db->where('d.Customer_Group_Code', $Customer_Group_Code);
        }
        if ($Population_Strata_2) {
            $this->db->where('d.Population_Strata_2', $Population_Strata_2);
        }
        if ($Zone) {
            $this->db->where('d.Zone_Code', $Zone);
        }

        $query = $this->db->get();

        return $query->row()->total_count;
    }












    public function get_unic_Sales_Code()
    {

        $this->db->select('id, Sales_Code');
        $this->db->group_by('Sales_Code');
        $query = $this->db->get('distributors');

        return $query->result_array();
    }


    public function get_unic_Distribution_Channel_Code()
    {

        $this->db->select('id, Distribution_Channel_Code');
        $this->db->group_by('Distribution_Channel_Code');
        $query = $this->db->get('distributors');

        return $query->result_array();
    }

    public function get_unic_Division_Code()
    {
        $this->db->select('id, Division_Code');
        $this->db->group_by('Division_Code');
        $query = $this->db->get('distributors');

        return $query->result_array();
    }

    public function get_unic_Customer_Type_Code()
    {

        $this->db->select('id, Customer_Type_Code');
        $this->db->group_by('Customer_Type_Code');
        $query = $this->db->get('distributors');

        return $query->result_array();
    }

    public function get_unic_Customer_Group_Code()
    {
        $this->db->select('id, Customer_Group_Code');
        $this->db->group_by('Customer_Group_Code');
        $query = $this->db->get('distributors');

        return $query->result_array();
    }

    public function get_unic_Customer_Code()
    {
        $this->db->select('id, Customer_Code');
        $this->db->group_by('Customer_Code');
        $query = $this->db->get('distributors');

        return $query->result_array();
    }


    public function get_unique_zone_code_with_name()
    {

        $this->db->select('Zone_Code, Zone');
        $this->db->group_by('Zone_Code');
        $query = $this->db->get('distributors');

        return $query->result_array();
    }


    public function get_zone_details_by_codes($zone_codes)
    {

        if (!empty($zone_codes)) {
            $this->db->select('Zone_Code, Zone');
            $this->db->where_in('Zone_Code', $zone_codes);
            $query = $this->db->get('distributors');

            return $query->result_array();
        }

        return [];
    }



    public function get_unique_cities()
    {
        $this->db->distinct();
        $this->db->select('City');
        $this->db->from('distributors');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_unique_State()
    {
        $this->db->distinct();
        $this->db->select('State');
        $this->db->from('distributors');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_unique_zone()
    {
        $this->db->distinct();
        $this->db->select('Zone');
        $this->db->from('distributors');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_cities_by_state($state)
    {

        $this->db->select('City, Zone, Zone_Code');
        $this->db->from('distributors');
        $this->db->where('State', $state);

        $this->db->group_by('City');

        $query = $this->db->get();

        return $query->result_array();
    }





    public function count_all_distributors()
    {
        return $this->db->count_all('distributors');
    }

    public function get_distributors_paginated($limit, $offset)
    {
        $query = $this->db->get('distributors', $limit, $offset);
        return $query->result_array();
    }




    public function get_distributors($start, $length, $search = '', $zone_ids = [], $order_column = '', $order_direction = '', $filters = [])
    {
        // Start building the query
        $this->db->from('distributors'); // Specify the table name

        // Filter by zone if zone_ids are provided
        if (!empty($zone_ids)) {
            $this->db->where_in('Zone_Code', $zone_ids);
        }

        // Apply filters if provided
        if (!empty($filters)) {
            if (isset($filters['Sales_Code']) && $filters['Sales_Code']) {
                $this->db->where('Sales_Code', $filters['Sales_Code']);
            }
            if (isset($filters['Distribution_Channel_Code']) && $filters['Distribution_Channel_Code']) {
                $this->db->where('Distribution_Channel_Code', $filters['Distribution_Channel_Code']);
            }
            if (isset($filters['Division_Code']) && $filters['Division_Code']) {
                $this->db->where('Division_Code', $filters['Division_Code']);
            }
            if (isset($filters['Customer_Type_Code']) && $filters['Customer_Type_Code']) {
                $this->db->where('Customer_Type_Code', $filters['Customer_Type_Code']);
            }
            if (isset($filters['Customer_Group_Code']) && $filters['Customer_Group_Code']) {
                $this->db->where('Customer_Group_Code', $filters['Customer_Group_Code']);
            }
            if (isset($filters['Population_Strata_2']) && $filters['Population_Strata_2']) {
                $this->db->where('Population_Strata_2', $filters['Population_Strata_2']);
            }
            if (isset($filters['Zone']) && $filters['Zone']) {
                $this->db->where('Zone_Code', $filters['Zone']);
            }
        }

        // Search filter: If a search term is provided, apply `like` conditions for various columns
        if ($search) {
            $this->db->group_start();
            $this->db->like('Customer_Name', $search);
            $this->db->or_like('Customer_Code', $search);
            $this->db->or_like('Pin_Code', $search);
            $this->db->or_like('City', $search);
            $this->db->or_like('District', $search);
            $this->db->or_like('Contact_Number', $search);
            $this->db->or_like('Country', $search);
            $this->db->or_like('Zone', $search);
            $this->db->or_like('State', $search);
            $this->db->or_like('Population_Strata_1', $search);
            $this->db->or_like('Population_Strata_2', $search);
            $this->db->or_like('Country_Group', $search);
            $this->db->or_like('GTM_TYPE', $search);
            $this->db->or_like('SUPERSTOCKIST', $search);
            $this->db->or_like('STATUS', $search);
            $this->db->or_like('Customer_Type_Code', $search);
            $this->db->or_like('Sales_Code', $search);
            $this->db->or_like('Customer_Type_Name', $search);
            $this->db->or_like('Customer_Group_Code', $search);
            $this->db->or_like('Customer_Creation_Date', $search);
            $this->db->or_like('Division_Code', $search);
            $this->db->or_like('Sector_Code', $search);
            $this->db->or_like('State_Code', $search);
            $this->db->or_like('Zone_Code', $search);
            $this->db->or_like('Distribution_Channel_Code', $search);
            $this->db->or_like('Distribution_Channel_Name', $search);
            $this->db->or_like('Customer_Group_Name', $search);
            $this->db->or_like('Sales_Name', $search);
            $this->db->or_like('Division_Name', $search);
            $this->db->or_like('Sector_Name', $search);
            $this->db->group_end();
        }

        // Define valid columns for sorting
        $valid_columns = ['Customer_Name', 'Customer_Code', 'Pin_Code', 'City', 'District', 'Zone', 'State', 'Population_Strata_1', 'Population_Strata_2', 'Country_Group', 'GTM_TYPE', 'SUPERSTOCKIST', 'STATUS', 'Sales_Code', 'Customer_Type_Name'];

        // Validate the order column, default to 'Customer_Name' if not valid
        if (!in_array($order_column, $valid_columns)) {
            $order_column = 'Customer_Name';
        }

        // Apply sorting
        $this->db->order_by($order_column, $order_direction);

        // Limit the results based on pagination
        $this->db->limit($length, $start);

        // Execute the query and return the result as an object
        return $this->db->get();
    }





    public function getTotal_distributors($search = '', $zone_ids = [], $filters = [])
    {
        $this->db->from('distributors');

        // Filter by zone if zone_ids are provided
        if (!empty($zone_ids)) {
            $this->db->where_in('Zone_Code', $zone_ids);
        }

        // Apply filters if provided
        if (!empty($filters)) {
            if (isset($filters['Sales_Code']) && $filters['Sales_Code']) {
                $this->db->where('Sales_Code', $filters['Sales_Code']);
            }
            if (isset($filters['Distribution_Channel_Code']) && $filters['Distribution_Channel_Code']) {
                $this->db->where('Distribution_Channel_Code', $filters['Distribution_Channel_Code']);
            }
            if (isset($filters['Division_Code']) && $filters['Division_Code']) {
                $this->db->where('Division_Code', $filters['Division_Code']);
            }
            if (isset($filters['Customer_Type_Code']) && $filters['Customer_Type_Code']) {
                $this->db->where('Customer_Type_Code', $filters['Customer_Type_Code']);
            }
            if (isset($filters['Customer_Group_Code']) && $filters['Customer_Group_Code']) {
                $this->db->where('Customer_Group_Code', $filters['Customer_Group_Code']);
            }
            if (isset($filters['Population_Strata_2']) && $filters['Population_Strata_2']) {
                $this->db->where('Population_Strata_2', $filters['Population_Strata_2']);
            }
            if (isset($filters['Zone']) && $filters['Zone']) {
                $this->db->where('Zone_Code', $filters['Zone']);
            }
        }

        // Apply search if provided
        if ($search) {
            $this->db->group_start();
            $this->db->like('Customer_Name', $search);
            $this->db->or_like('Customer_Code', $search);
            $this->db->or_like('Pin_Code', $search);
            $this->db->or_like('City', $search);
            $this->db->or_like('District', $search);
            $this->db->or_like('Contact_Number', $search);
            $this->db->or_like('Country', $search);
            $this->db->or_like('Zone', $search);
            $this->db->or_like('State', $search);
            $this->db->or_like('Population_Strata_1', $search);
            $this->db->or_like('Population_Strata_2', $search);
            $this->db->or_like('Country_Group', $search);
            $this->db->or_like('GTM_TYPE', $search);
            $this->db->or_like('SUPERSTOCKIST', $search);
            $this->db->or_like('STATUS', $search);
            $this->db->or_like('Customer_Type_Code', $search);
            $this->db->or_like('Sales_Code', $search);
            $this->db->or_like('Customer_Type_Name', $search);
            $this->db->or_like('Customer_Group_Code', $search);
            $this->db->or_like('Customer_Creation_Date', $search);
            $this->db->or_like('Division_Code', $search);
            $this->db->or_like('Sector_Code', $search);
            $this->db->or_like('State_Code', $search);
            $this->db->or_like('Zone_Code', $search);
            $this->db->or_like('Distribution_Channel_Code', $search);
            $this->db->or_like('Distribution_Channel_Name', $search);
            $this->db->or_like('Customer_Group_Name', $search);
            $this->db->or_like('Sales_Name', $search);
            $this->db->or_like('Division_Name', $search);
            $this->db->or_like('Sector_Name', $search);
            $this->db->group_end();
        }

        return $this->db->count_all_results();
    }




    public function get_distributors_unmapped($start, $length, $search = '', $zone_ids = [], $order_column = '', $order_direction = '')
    {
        // Ensure $zone_ids is an array
        if (!is_array($zone_ids)) {
            $zone_ids = [];
        }

        // Ensure $search is a string
        $search = is_string($search) ? $search : '';


        $this->db->select('d.*');
        $this->db->from('distributors d');

        // Filter by zone
        if (!empty($zone_ids)) {
            $this->db->where_in('d.Zone_Code', $zone_ids);
        }

        // Apply search filters
        if (!empty($search)) {
            $this->db->group_start(); // Start grouping conditions
            $this->db->like('d.Customer_Name', $search);
            $this->db->or_like('d.Customer_Code', $search);
            $this->db->or_like('d.Pin_Code', $search);
            $this->db->or_like('d.City', $search);
            $this->db->or_like('d.District', $search);
            $this->db->or_like('d.Contact_Number', $search);
            $this->db->or_like('d.Zone', $search);
            $this->db->or_like('d.State', $search);
            $this->db->or_like('d.Population_Strata_1', $search);
            $this->db->or_like('d.Population_Strata_2', $search);
            $this->db->or_like('d.Country_Group', $search);
            $this->db->or_like('d.GTM_TYPE', $search);
            $this->db->or_like('d.SUPERSTOCKIST', $search);
            $this->db->or_like('d.Customer_Type_Code', $search);
            $this->db->or_like('d.Sales_Code', $search);
            $this->db->or_like('d.Customer_Type_Name', $search);
            $this->db->or_like('d.Customer_Group_Code', $search);
            $this->db->or_like('d.Customer_Creation_Date', $search);
            $this->db->or_like('d.Division_Code', $search);
            $this->db->or_like('d.Sector_Code', $search);
            $this->db->or_like('d.State_Code', $search);
            $this->db->or_like('d.Zone_Code', $search);
            $this->db->or_like('d.Distribution_Channel_Code', $search);
            $this->db->or_like('d.Distribution_Channel_Name', $search);
            $this->db->or_like('d.Customer_Group_Name', $search);
            $this->db->or_like('d.Sales_Name', $search);
            $this->db->or_like('d.Division_Name', $search);
            $this->db->or_like('d.Sector_Name', $search);
            $this->db->group_end(); // End grouping
        }

        // Apply sorting (ensure valid sorting column)
        $valid_columns = ['Customer_Name', 'Customer_Code', 'Pin_Code', 'City', 'District', 'Zone', 'State', 'Population_Strata_1', 'Population_Strata_2', 'Country_Group', 'GTM_TYPE', 'SUPERSTOCKIST', 'STATUS', 'Sales_Code', 'Customer_Type_Name'];
        if (!in_array($order_column, $valid_columns)) {
            $order_column = 'Customer_Name'; // Default to Customer_Name if invalid column is provided
        }

        // Apply sorting
        $this->db->order_by($order_column, $order_direction);

        // Limit the results
        $this->db->limit($length, $start);

        // Fetch data
        $query = $this->db->get();

        // Debugging: Check the SQL query being executed
        log_message('debug', 'SQL Query: ' . $this->db->last_query());

        // Return the result
        return $query;
    }



    public function getTotal_distributors_unmapped($search = '', $zone_ids = [])
    {
        $this->db->select('d.*');

        $this->db->from('distributors d');

        $this->db->where('d.Customer_Code NOT IN (SELECT DB_Code FROM maping)');

        if (!empty($zone_ids)) {
            $this->db->where_in('d.Zone_Code', $zone_ids);
        }

        if ($search) {
            $this->db->like('d.Customer_Name', $search);
            $this->db->or_like('d.Customer_Code', $search);
            $this->db->or_like('d.Pin_Code', $search);
            $this->db->or_like('d.City', $search);
            $this->db->or_like('d.District', $search);
            $this->db->or_like('d.Contact_Number', $search);
            $this->db->or_like('d.Country', $search);
            $this->db->or_like('d.Zone', $search);
            $this->db->or_like('d.State', $search);
            $this->db->or_like('d.Population_Strata_1', $search);
            $this->db->or_like('d.Population_Strata_2', $search);
            $this->db->or_like('d.Country_Group', $search);
            $this->db->or_like('d.GTM_TYPE', $search);
            $this->db->or_like('d.SUPERSTOCKIST', $search);
            $this->db->or_like('d.STATUS', $search);
            $this->db->or_like('d.Customer_Type_Code', $search);
            $this->db->or_like('d.Sales_Code', $search);
            $this->db->or_like('d.Customer_Type_Name', $search);
            $this->db->or_like('d.Customer_Group_Code', $search);
            $this->db->or_like('d.Customer_Creation_Date', $search);
            $this->db->or_like('d.Division_Code', $search);
            $this->db->or_like('d.Sector_Code', $search);
            $this->db->or_like('d.State_Code', $search);
            $this->db->or_like('d.Zone_Code', $search);
            $this->db->or_like('d.Distribution_Channel_Code', $search);
            $this->db->or_like('d.Distribution_Channel_Name', $search);
            $this->db->or_like('d.Customer_Group_Name', $search);
            $this->db->or_like('d.Sales_Name', $search);
            $this->db->or_like('d.Division_Name', $search);
            $this->db->or_like('d.Sector_Name', $search);
        }


        $query = $this->db->select('COUNT(*) as total_get_distributors')->get();
        $result = $query->row();
        if ($result) {
            return $result->total_get_distributors;
        }
        return 0;
    }



    public function get_states_by_zone__($zone_code)
    {
        $zone_code = $this->db->escape_str($zone_code);
        $this->db->select('State_Code, State');
        $this->db->from('distributors');
        $this->db->where('Zone_Code', $zone_code);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $states = $query->result_array();

            foreach ($states as $state) {
            }


            $unique_states = [];
            foreach ($states as $state) {
                if (!isset($unique_states[$state['State_Code']])) {
                    $unique_states[$state['State_Code']] = $state;
                }
            }

            return array_values($unique_states);
        }

        return [];
    }




    public function get_cities_by_state___($state_code)
    {
        $this->db->select('City');
        $this->db->from('distributors');
        $this->db->where('State_Code', $state_code);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return [];
    }



    public function get_unmapped_distributors()
    {
        // Select all distributor fields
        $this->db->select('d.*');
        $this->db->from('distributors d');

        // Condition to fetch unmapped distributors
        $this->db->where('d.Customer_Code NOT IN (SELECT DB_Code FROM maping)');

        $query = $this->db->get();
        return $query->result_array();
    }



    public function get_distributors_inactive($start, $length, $search = '', $zone_ids = [], $order_column = '', $order_direction = '')
    {
        // Start building the query
        $this->db->from('distributors'); // Specify the table name

        // Add condition to filter distributors with STATUS = 'INACTIVE'
        $this->db->where('STATUS', 'INACTIVE');
        // Filter by zone if zone_ids are provided
        if (!empty($zone_ids)) {
            $this->db->where_in('Zone_Code', $zone_ids);
        }

        // Search filter: If a search term is provided, apply `like` conditions for various columns
        if ($search) {
            $this->db->group_start(); // Group all OR LIKE conditions together to avoid ambiguity
            $this->db->like('Customer_Name', $search);
            $this->db->or_like('Customer_Code', $search);
            $this->db->or_like('Pin_Code', $search);
            $this->db->or_like('City', $search);
            $this->db->or_like('District', $search);
            $this->db->or_like('Contact_Number', $search);
            $this->db->or_like('Country', $search);
            $this->db->or_like('Zone', $search);
            $this->db->or_like('State', $search);
            $this->db->or_like('Population_Strata_1', $search);
            $this->db->or_like('Population_Strata_2', $search);
            $this->db->or_like('Country_Group', $search);
            $this->db->or_like('GTM_TYPE', $search);
            $this->db->or_like('SUPERSTOCKIST', $search);
            $this->db->or_like('Customer_Type_Code', $search);
            $this->db->or_like('Sales_Code', $search);
            $this->db->or_like('Customer_Type_Name', $search);
            $this->db->or_like('Customer_Group_Code', $search);
            $this->db->or_like('Customer_Creation_Date', $search);
            $this->db->or_like('Division_Code', $search);
            $this->db->or_like('Sector_Code', $search);
            $this->db->or_like('State_Code', $search);
            $this->db->or_like('Zone_Code', $search);
            $this->db->or_like('Distribution_Channel_Code', $search);
            $this->db->or_like('Distribution_Channel_Name', $search);
            $this->db->or_like('Customer_Group_Name', $search);
            $this->db->or_like('Sales_Name', $search);
            $this->db->or_like('Division_Name', $search);
            $this->db->or_like('Sector_Name', $search);
            $this->db->group_end(); // Close the OR group
        }

        // Define valid columns for sorting
        $valid_columns = ['Customer_Name', 'Customer_Code', 'Pin_Code', 'City', 'District', 'Zone', 'State', 'Population_Strata_1', 'Population_Strata_2', 'Country_Group', 'GTM_TYPE', 'SUPERSTOCKIST', 'STATUS', 'Sales_Code', 'Customer_Type_Name'];

        // Validate the order column, default to 'Customer_Name' if not valid
        if (!in_array($order_column, $valid_columns)) {
            $order_column = 'Customer_Name';
        }

        // Apply sorting
        $this->db->order_by($order_column, $order_direction);

        // Limit the results based on pagination
        $this->db->limit($length, $start);

        // Execute the query and return the result as an object, not an array
        return $this->db->get();
    }





    public function getTotal_distributors_inactive($search = '', $zone_ids = [])
    {
        // Specify the table name
        $this->db->from('distributors');

        // Add condition to filter distributors with STATUS = 'INACTIVE'
        $this->db->where('STATUS', 'INACTIVE');

        // Filter by zone if zone_ids are provided
        if (!empty($zone_ids)) {
            $this->db->where_in('Zone_Code', $zone_ids);
        }

        // Apply search filter
        if ($search) {
            $this->db->group_start(); // Start grouping for OR conditions
            $this->db->like('Customer_Name', $search);
            $this->db->or_like('Customer_Code', $search);
            $this->db->or_like('Pin_Code', $search);
            $this->db->or_like('City', $search);
            $this->db->or_like('District', $search);
            $this->db->or_like('Contact_Number', $search);
            $this->db->or_like('Country', $search);
            $this->db->or_like('Zone', $search);
            $this->db->or_like('State', $search);
            $this->db->or_like('Population_Strata_1', $search);
            $this->db->or_like('Population_Strata_2', $search);
            $this->db->or_like('Country_Group', $search);
            $this->db->or_like('GTM_TYPE', $search);
            $this->db->or_like('SUPERSTOCKIST', $search);
            $this->db->or_like('Customer_Type_Code', $search);
            $this->db->or_like('Sales_Code', $search);
            $this->db->or_like('Customer_Type_Name', $search);
            $this->db->or_like('Customer_Group_Code', $search);
            $this->db->or_like('Customer_Creation_Date', $search);
            $this->db->or_like('Division_Code', $search);
            $this->db->or_like('Sector_Code', $search);
            $this->db->or_like('State_Code', $search);
            $this->db->or_like('Zone_Code', $search);
            $this->db->or_like('Distribution_Channel_Code', $search);
            $this->db->or_like('Distribution_Channel_Name', $search);
            $this->db->or_like('Customer_Group_Name', $search);
            $this->db->or_like('Sales_Name', $search);
            $this->db->or_like('Division_Name', $search);
            $this->db->or_like('Sector_Name', $search);
            $this->db->group_end(); // Close grouping
        }

        // Execute the query to count total inactive distributors
        $query = $this->db->select('COUNT(*) as total_get_distributors')->get();
        $result = $query->row();
        if ($result) {
            return $result->total_get_distributors;
        }

        return 0; // Return 0 if no results found
    }
}
