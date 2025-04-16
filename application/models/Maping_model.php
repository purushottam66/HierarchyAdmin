<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Maping_model extends CI_Model
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


    public function get_all_Maping____()
    {
        $query = $this->db->get('maping');

        return $query->result_array();
    }

    public function get_all_Maping_table($Pjp_Code)
    {

        $this->db->group_start();
        for ($i = 1; $i <= 7; $i++) {
            $this->db->or_where("Level_$i", $Pjp_Code);
        }
        $this->db->group_end();

        $this->db->distinct();
        $query = $this->db->get('maping');
        $result = $query->result_array();

        $tree = [];
        foreach ($result as $row) {
            $current_level = &$tree;
            for ($i = 1; $i <= 7; $i++) {
                $level_value = $row["Level_$i"];
                $employee_name = $this->get_employee_name($level_value);

                if (!empty($level_value)) {
                    if (!isset($current_level[$level_value])) {
                        $current_level[$level_value] = [
                            'name' => $employee_name,
                            'children' => []
                        ];
                    }

                    $current_level = &$current_level[$level_value]['children'];
                }
            }
            unset($current_level);
            $current_level = &$tree;
        }

        return $tree;
    }

    private function get_employee_name($pjp_code)
    {

        $this->db->where('pjp_code', $pjp_code);
        $query = $this->db->get('employee');
        $result = $query->row_array();
        return isset($result['name']) ? $result['name'] : '';
    }



    public function get_all_Maping_table_zone()
    {
        $this->db->select('Level_1, Level_2, Level_3, Level_4, Level_5, Level_6, Level_7');
        $this->db->from('maping');
        $mapping_query = $this->db->get();
        $mapping_result = $mapping_query->result_array();

        if (empty($mapping_result)) {
            return [];
        }

        $employees = $this->get_all_employees();

        $tree = [];
        foreach ($mapping_result as $row) {
            $current_level = &$tree;

            for ($i = 1; $i <= 7; $i++) {
                $level_value = !empty($row["Level_$i"]) ? $row["Level_$i"] : null;

                if ($level_value === null) {
                    break;
                }

                $employee_name = isset($employees[$level_value]) ? $employees[$level_value] : 'Unknown';

                if (!isset($current_level[$level_value])) {
                    $current_level[$level_value] = [
                        'name' => $employee_name,
                        'pjp_code' => $level_value,
                        'children' => []
                    ];
                }

                $current_level = &$current_level[$level_value]['children'];
            }

            unset($current_level);
        }

        return $tree;
    }

    private function get_all_employees()
    {
        $this->db->select('pjp_code, name');
        $this->db->from('employee');
        $query = $this->db->get();
        $result = $query->result_array();

        $employees = [];
        foreach ($result as $row) {
            $employees[$row['pjp_code']] = $row['name'];
        }

        return $employees;
    }














    public function get_all_Maping_table_ajex($id, $level)
    {
        $level_field = 'Level_' . $level;
        $this->db->where($level_field, $id);
        $this->db->distinct();
        $this->db->select('DB_Code, Level_1, Level_2, Level_3, Level_4, Level_5, Level_6, Level_7');
        $query = $this->db->get('maping');

        $result = $query->result_array();

        return $result;
    }

    public function get_zone_permissions_by_user($user_id)
    {
        $this->db->select('zone_id');
        $this->db->from('zone_permissions');
        $this->db->where('user_id', $user_id);

        $query = $this->db->get();

        $result = $query->result_array();

        return $result;
    }


    public function get_all_Maping_table_ajex_zone($level = null, $pjp_code = null, $user_id = null)
    {
        $this->db->select('
        mp.id, mp.DB_Code, 
        mp.Level_1, emp1.name AS Level_1_Name, emp1.designation_name AS Level_1_Designation,
        mp.Level_2, emp2.name AS Level_2_Name, emp2.designation_name AS Level_2_Designation,
        mp.Level_3, emp3.name AS Level_3_Name, emp3.designation_name AS Level_3_Designation,
        mp.Level_4, emp4.name AS Level_4_Name, emp4.designation_name AS Level_4_Designation,
        mp.Level_5, emp5.name AS Level_5_Name, emp5.designation_name AS Level_5_Designation,
        mp.Level_6, emp6.name AS Level_6_Name, emp6.designation_name AS Level_6_Designation,
        mp.Level_7, emp7.name AS Level_7_Name, emp7.designation_name AS Level_7_Designation,
        
        ds.Customer_Code, ds.Customer_Name, ds.Pin_Code, ds.City, ds.District,
        ds.Contact_Number, ds.Country, ds.Zone, ds.State, ds.Population_Strata_1,
        ds.Population_Strata_2, ds.Country_Group, ds.GTM_TYPE, ds.SUPERSTOCKIST,
        ds.STATUS, ds.Customer_Type_Code, ds.Sales_Code, ds.Customer_Type_Name,
        ds.Customer_Group_Code, ds.Customer_Creation_Date, ds.Division_Code,
        ds.Sector_Code, ds.State_Code, ds.Zone_Code, ds.Distribution_Channel_Code,
        ds.Distribution_Channel_Name, ds.Customer_Group_Name, ds.Sales_Name,
        ds.Division_Name, ds.Sector_Name,
        mp.distributors_id
    ');

        $this->db->from('maping mp');
        $this->db->join('employee emp1', 'mp.Level_1 = emp1.pjp_code', 'left');
        $this->db->join('employee emp2', 'mp.Level_2 = emp2.pjp_code', 'left');
        $this->db->join('employee emp3', 'mp.Level_3 = emp3.pjp_code', 'left');
        $this->db->join('employee emp4', 'mp.Level_4 = emp4.pjp_code', 'left');
        $this->db->join('employee emp5', 'mp.Level_5 = emp5.pjp_code', 'left');
        $this->db->join('employee emp6', 'mp.Level_6 = emp6.pjp_code', 'left');
        $this->db->join('employee emp7', 'mp.Level_7 = emp7.pjp_code', 'left');

        $this->db->join('distributors ds', 'mp.DB_Code = ds.Customer_Code 
        AND IFNULL(mp.Sales_Code, "") = IFNULL(ds.Sales_Code, "") 
        AND IFNULL(mp.Distribution_Channel_Code, "") = IFNULL(ds.Distribution_Channel_Code, "") 
        AND IFNULL(mp.Division_Code, "") = IFNULL(ds.Division_Code, "") 
        AND IFNULL(mp.Customer_Type_Code, "") = IFNULL(ds.Customer_Type_Code, "") 
        AND IFNULL(mp.Customer_Group_Code, "") = IFNULL(ds.Customer_Group_Code, "")', 'left');

        // Apply Level Filter
        if ($level !== null && $pjp_code !== null) {
            $level_column = "mp.Level_" . intval($level);
            $this->db->where($level_column, $pjp_code);
        }

        // Fetch Zone Permissions for User
        if ($user_id !== null) {
            $this->db->join('zone_permissions zp', 'FIND_IN_SET(ds.Zone_Code, REPLACE(REPLACE(REPLACE(zp.zone_id, "[", ""), "]", ""), "\"", "")) > 0', 'inner');
            $this->db->where('zp.user_id', $user_id);
        }

        $this->db->group_by('
        mp.DB_Code, 
        mp.Level_1, emp1.designation_name,
        mp.Level_2, emp2.designation_name,
        mp.Level_3, emp3.designation_name,
        mp.Level_4, emp4.designation_name,
        mp.Level_5, emp5.designation_name,
        mp.Level_6, emp6.designation_name,
        mp.Level_7, emp7.designation_name,
        ds.Customer_Code, ds.Customer_Name, ds.Pin_Code, ds.City, ds.District,
        ds.Contact_Number, ds.Country, ds.Zone, ds.State, ds.Population_Strata_1,
        ds.Population_Strata_2, ds.Country_Group, ds.GTM_TYPE, ds.SUPERSTOCKIST,
        ds.STATUS, ds.Customer_Type_Code, ds.Sales_Code, ds.Customer_Type_Name,
        ds.Customer_Group_Code, ds.Customer_Creation_Date, ds.Division_Code,
        ds.Sector_Code, ds.State_Code, ds.Zone_Code, ds.Distribution_Channel_Code,
        ds.Distribution_Channel_Name, ds.Customer_Group_Name, ds.Sales_Name,
        ds.Division_Name, ds.Sector_Name, mp.distributors_id
    ');

        $query = $this->db->get();
        return $query->result_array();
    }















    public function get_mapping_by_customer_codes($customerCodes)
    {
        $this->db->where_in('DB_Code', $customerCodes);
        $query = $this->db->get('maping');

        $result = $query->result_array();

        return $result;
    }

    public function editmaping($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('maping');

        $result = $query->row_array();

        return $result;
    }

    public function update_mapping($id, $data)
    {
        $this->db->where('id', $id);
        $result = $this->db->update('maping', $data);

        return $result;
    }





    public function hierarchydelete($id)
    {
        $this->db->where('id', $id);
        $result = $this->db->delete('maping');

        return $result;
    }




    public function get_all_Maping_data($search = '', $filters = '')
    {
        $this->db->select('*');
        $this->db->from('distributors');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('Sales_Code', $search);
            $this->db->or_like('Customer_Code', $search);

            $this->db->group_end();
        }

        if (is_array($filters) && !empty($filters)) {
            foreach ($filters as $key => $values) {
                if (!empty($values)) {

                    $this->db->where_in($key, $values);
                }
            }
        }

        $query = $this->db->get();


        if ($query === FALSE) {

            return false;
        }

        $result = $query->result_array();

        return $result;
    }


    public function get_maping_d_count($zone_ids, $search = '', $filters = [])
    {

        if (empty($zone_ids) || !is_array($zone_ids)) {
            return [];
        }

        $this->db->select('mp.id');
        $this->db->from('maping mp');

        $this->db->join('distributors ds', 'mp.DB_Code = ds.Customer_Code 
                    AND mp.Sales_Code = ds.Sales_Code 
                    AND mp.Distribution_Channel_Code = ds.Distribution_Channel_Code 
                    AND mp.Division_Code = ds.Division_Code 
                    AND mp.Customer_Type_Code = ds.Customer_Type_Code 
                    AND mp.Customer_Group_Code = ds.Customer_Group_Code', 'left');

        for ($i = 1; $i <= 7; $i++) {
            $this->db->join('employee emp' . $i, 'emp' . $i . '.pjp_code = mp.Level_' . $i, 'left');
        }


        if (!empty($zone_ids) && is_array($zone_ids)) {
            $this->db->where_in('ds.Zone_Code', $zone_ids);
        } else {
            // If $zone_ids is empty, do not apply the where_in clause
            // Optionally, you can add a condition that always returns true
            // to ensure the query is valid and returns all records
            $this->db->where('1', '1');
        }



        if (is_array($filters) && !empty($filters)) {
            foreach ($filters as $key => $values) {
                if (!empty($values)) {

                    $this->db->group_start();
                    $this->db->where_in("ds.$key", $values);
                    $this->db->or_where("ds.$key IS NULL");
                    $this->db->group_end();
                }
            }
        }



        if (!empty($search)) {
            $escaped_search = $this->db->escape_like_str($search);
            $this->db->group_start();
            $this->db->like('ds.Customer_Code', $escaped_search);
            $this->db->or_like('ds.Customer_Name', $escaped_search);
            $this->db->or_like('ds.Pin_Code', $escaped_search);
            $this->db->or_like('ds.City', $escaped_search);
            $this->db->or_like('ds.District', $escaped_search);
            $this->db->or_like('ds.Contact_Number', $escaped_search);
            $this->db->or_like('ds.Country', $escaped_search);
            $this->db->or_like('ds.Zone', $escaped_search);
            $this->db->or_like('ds.State', $escaped_search);
            $this->db->or_like('ds.Population_Strata_1', $escaped_search);
            $this->db->or_like('ds.Population_Strata_2', $escaped_search);
            $this->db->or_like('ds.Country_Group', $escaped_search);
            $this->db->or_like('ds.GTM_TYPE', $escaped_search);
            $this->db->or_like('ds.SUPERSTOCKIST', $escaped_search);
            $this->db->or_like('ds.STATUS', $escaped_search);
            $this->db->or_like('ds.Customer_Type_Code', $escaped_search);
            $this->db->or_like('ds.Sales_Code', $escaped_search);
            $this->db->or_like('ds.Customer_Type_Name', $escaped_search);
            $this->db->or_like('ds.Customer_Group_Code', $escaped_search);
            $this->db->or_like('ds.Customer_Creation_Date', $escaped_search);
            $this->db->or_like('ds.Division_Code', $escaped_search);
            $this->db->or_like('ds.Sector_Code', $escaped_search);
            $this->db->or_like('ds.State_Code', $escaped_search);
            $this->db->or_like('ds.Zone_Code', $escaped_search);
            $this->db->or_like('ds.Distribution_Channel_Code', $escaped_search);
            $this->db->or_like('ds.Distribution_Channel_Name', $escaped_search);
            $this->db->or_like('ds.Customer_Group_Name', $escaped_search);
            $this->db->or_like('ds.Sales_Name', $escaped_search);
            $this->db->or_like('ds.Division_Name', $escaped_search);
            $this->db->or_like('ds.Sector_Name', $escaped_search);


            $this->db->or_like('emp1.name', $escaped_search);
            $this->db->or_like('emp2.name', $escaped_search);
            $this->db->or_like('emp3.name', $escaped_search);
            $this->db->or_like('emp4.name', $escaped_search);
            $this->db->or_like('emp5.name', $escaped_search);
            $this->db->or_like('emp6.name', $escaped_search);
            $this->db->or_like('emp7.name', $escaped_search);
            $this->db->group_end();
        }


        $query = $this->db->get();

        $result = $query->result_array();

        return $result;
    }




    public function get_maping_d($zone_ids, $start, $length, $search = '', $filters = [], $order_column = '', $order_dir = 'asc')
    {
        if (empty($zone_ids) || !is_array($zone_ids)) {
            return [];
        }

        // Select the required fields - add coalesce to handle NULL values
        $this->db->select('
        mp.id,
        mp.DB_Code,
        mp.Level_1, 
        COALESCE(emp1.name, "N/A") AS Level_1_Name, 
        COALESCE(emp1.employer_code, "N/A") AS Level_1_Employer_Code, 
        COALESCE(emp1.designation_name, "N/A") AS Level_1_Designation_Name, 
        emp1.id AS Emp_id1,
        
        mp.Level_2, 
        COALESCE(emp2.name, "N/A") AS Level_2_Name, 
        COALESCE(emp2.employer_code, "N/A") AS Level_2_Employer_Code, 
        COALESCE(emp2.designation_name, "N/A") AS Level_2_Designation_Name, 
        emp2.id AS Emp_id2,
        
        mp.Level_3, 
        COALESCE(emp3.name, "N/A") AS Level_3_Name, 
        COALESCE(emp3.employer_code, "N/A") AS Level_3_Employer_Code, 
        COALESCE(emp3.designation_name, "N/A") AS Level_3_Designation_Name, 
        emp3.id AS Emp_id3,
        
        mp.Level_4, 
        COALESCE(emp4.name, "N/A") AS Level_4_Name, 
        COALESCE(emp4.employer_code, "N/A") AS Level_4_Employer_Code, 
        COALESCE(emp4.designation_name, "N/A") AS Level_4_Designation_Name, 
        emp4.id AS Emp_id4,
        
        mp.Level_5, 
        COALESCE(emp5.name, "N/A") AS Level_5_Name, 
        COALESCE(emp5.employer_code, "N/A") AS Level_5_Employer_Code, 
        COALESCE(emp5.designation_name, "N/A") AS Level_5_Designation_Name, 
        emp5.id AS Emp_id5,
        
        mp.Level_6, 
        COALESCE(emp6.name, "N/A") AS Level_6_Name, 
        COALESCE(emp6.employer_code, "N/A") AS Level_6_Employer_Code, 
        COALESCE(emp6.designation_name, "N/A") AS Level_6_Designation_Name, 
        emp6.id AS Emp_id6,
        
        mp.Level_7, 
        COALESCE(emp7.name, "N/A") AS Level_7_Name, 
        COALESCE(emp7.employer_code, "N/A") AS Level_7_Employer_Code, 
        COALESCE(emp7.designation_name, "N/A") AS Level_7_Designation_Name, 
        emp7.id AS Emp_id7,
        
        COALESCE(ds.Customer_Name, "N/A") AS Customer_Name, 
        COALESCE(ds.Customer_Code, mp.DB_Code) AS Customer_Code, 
        COALESCE(ds.Sales_Code, mp.Sales_Code) AS Sales_Code, 
        COALESCE(ds.Distribution_Channel_Code, mp.Distribution_Channel_Code) AS Distribution_Channel_Code, 
        COALESCE(ds.Division_Code, mp.Division_Code) AS Division_Code, 
        COALESCE(ds.Customer_Type_Code, mp.Customer_Type_Code) AS Customer_Type_Code, 
        COALESCE(ds.Customer_Group_Code, mp.Customer_Group_Code) AS Customer_Group_Code,
        
        COALESCE(ds.Pin_Code, "N/A") AS Pin_Code, 
        COALESCE(ds.City, "N/A") AS City, 
        COALESCE(ds.District, "N/A") AS District, 
        COALESCE(ds.Contact_Number, "N/A") AS Contact_Number, 
        COALESCE(ds.Country, "N/A") AS Country, 
        COALESCE(ds.Zone, "N/A") AS Zone, 
        COALESCE(ds.State, "N/A") AS State, 
        COALESCE(ds.Population_Strata_1, "N/A") AS Population_Strata_1, 
        COALESCE(ds.Population_Strata_2, "N/A") AS Population_Strata_2,
        
        COALESCE(ds.Country_Group, "N/A") AS Country_Group, 
        COALESCE(ds.GTM_TYPE, "N/A") AS GTM_TYPE, 
        COALESCE(ds.SUPERSTOCKIST, "N/A") AS SUPERSTOCKIST, 
        COALESCE(ds.STATUS, "N/A") AS STATUS, 
        COALESCE(ds.Customer_Type_Name, "N/A") AS Customer_Type_Name, 
        COALESCE(ds.Customer_Creation_Date, "N/A") AS Customer_Creation_Date, 
        COALESCE(ds.Division_Name, "N/A") AS Division_Name, 
        COALESCE(ds.Sector_Code, "N/A") AS Sector_Code, 
        COALESCE(ds.State_Code, "N/A") AS State_Code, 
        COALESCE(ds.Zone_Code, "N/A") AS Zone_Code, 
        COALESCE(ds.Distribution_Channel_Name, "N/A") AS Distribution_Channel_Name, 
        COALESCE(ds.Customer_Group_Name, "N/A") AS Customer_Group_Name, 
        COALESCE(ds.Sales_Name, "N/A") AS Sales_Name, 
        COALESCE(ds.Division_Name, "N/A") AS Division_Name, 
        COALESCE(ds.Sector_Name, "N/A") AS Sector_Name
    ');

        $this->db->from('maping mp');
        // Change to LEFT JOIN to include all maping entries
        $this->db->join('distributors ds', 'mp.DB_Code = ds.Customer_Code 
                    AND mp.Sales_Code = ds.Sales_Code 
                    AND mp.Distribution_Channel_Code = ds.Distribution_Channel_Code 
                    AND mp.Division_Code = ds.Division_Code 
                    AND mp.Customer_Type_Code = ds.Customer_Type_Code 
                    AND mp.Customer_Group_Code = ds.Customer_Group_Code', 'left');
        $this->db->join('employee emp1', 'emp1.pjp_code = mp.Level_1 AND emp1.level = 1', 'left');

        // For Level_2
        $this->db->join('employee emp2', 'emp2.pjp_code = mp.Level_2 AND emp2.level = 2', 'left');

        // For Level_3
        $this->db->join('employee emp3', 'emp3.pjp_code = mp.Level_3 AND emp3.level = 3', 'left');

        // For Level_4
        $this->db->join('employee emp4', 'emp4.pjp_code = mp.Level_4 AND emp4.level = 4', 'left');

        // For Level_5
        $this->db->join('employee emp5', 'emp5.pjp_code = mp.Level_5 AND emp5.level = 5', 'left');

        // For Level_6
        $this->db->join('employee emp6', 'emp6.pjp_code = mp.Level_6 AND emp6.level = 6', 'left');

        // For Level_7
        $this->db->join('employee emp7', 'emp7.pjp_code = mp.Level_7 AND emp7.level = 7', 'left');


        if (!empty($zone_ids) && is_array($zone_ids)) {
            $this->db->where_in('ds.Zone_Code', $zone_ids);
        } else {
            // If $zone_ids is empty, do not apply the where_in clause
            // Optionally, you can add a condition that always returns true
            // to ensure the query is valid and returns all records
            $this->db->where('1', '1');
        }


        // After the joins
        // Apply filters - modify to work with LEFT JOIN
        if (is_array($filters) && !empty($filters)) {
            foreach ($filters as $key => $values) {
                if (!empty($values)) {
                    // Use where_in with a null check to handle LEFT JOIN
                    $this->db->group_start();
                    $this->db->where_in("ds.$key", $values);
                    $this->db->or_where("ds.$key IS NULL");
                    $this->db->group_end();
                }
            }
        }


        if (!empty($search)) {
            $search = $this->db->escape_like_str($search);

            // log_message('debug', 'Search applied with escaped term: ' . $search);
            // log_message('debug', 'Building search query...');

            $escaped_search = $this->db->escape_like_str($search);
            $this->db->group_start();
            $this->db->like('ds.Customer_Code', $escaped_search);
            $this->db->or_like('ds.Customer_Name', $escaped_search);
            $this->db->or_like('ds.Pin_Code', $escaped_search);
            $this->db->or_like('ds.City', $escaped_search);
            $this->db->or_like('ds.District', $escaped_search);
            $this->db->or_like('ds.Contact_Number', $escaped_search);
            $this->db->or_like('ds.Country', $escaped_search);
            $this->db->or_like('ds.Zone', $escaped_search);
            $this->db->or_like('ds.State', $escaped_search);
            $this->db->or_like('ds.Population_Strata_1', $escaped_search);
            $this->db->or_like('ds.Population_Strata_2', $escaped_search);
            $this->db->or_like('ds.Country_Group', $escaped_search);
            $this->db->or_like('ds.GTM_TYPE', $escaped_search);
            $this->db->or_like('ds.SUPERSTOCKIST', $escaped_search);
            $this->db->or_like('ds.STATUS', $escaped_search);
            $this->db->or_like('ds.Customer_Type_Code', $escaped_search);
            $this->db->or_like('ds.Sales_Code', $escaped_search);
            $this->db->or_like('ds.Customer_Type_Name', $escaped_search);
            $this->db->or_like('ds.Customer_Group_Code', $escaped_search);
            $this->db->or_like('ds.Customer_Creation_Date', $escaped_search);
            $this->db->or_like('ds.Division_Code', $escaped_search);
            $this->db->or_like('ds.Sector_Code', $escaped_search);
            $this->db->or_like('ds.State_Code', $escaped_search);
            $this->db->or_like('ds.Zone_Code', $escaped_search);
            $this->db->or_like('ds.Distribution_Channel_Code', $escaped_search);
            $this->db->or_like('ds.Distribution_Channel_Name', $escaped_search);
            $this->db->or_like('ds.Customer_Group_Name', $escaped_search);
            $this->db->or_like('ds.Sales_Name', $escaped_search);
            $this->db->or_like('ds.Division_Name', $escaped_search);
            $this->db->or_like('ds.Sector_Name', $escaped_search);


            $this->db->or_like('emp1.name', $escaped_search);
            $this->db->or_like('emp2.name', $escaped_search);
            $this->db->or_like('emp3.name', $escaped_search);
            $this->db->or_like('emp4.name', $escaped_search);
            $this->db->or_like('emp5.name', $escaped_search);
            $this->db->or_like('emp6.name', $escaped_search);
            $this->db->or_like('emp7.name', $escaped_search);

            $this->db->group_end();
        }


        // Ordering logic

        $valid_columns = [
            'Customer_Name',
            'Customer_Code',
            'Sales_Code',
            'City',
            'Zone',
            'Pin_Code',
            'District',
            'Contact_Number',
            'Country',
            'State',
            'Population_Strata_1',
            'Population_Strata_2',
            'Country_Group',
            'GTM_TYPE',
            'SUPERSTOCKIST',
            'STATUS',
            'Customer_Type_Code',
            'Customer_Type_Name',
            'Customer_Group_Code',
            'Customer_Creation_Date',
            'Division_Code',
            'Sector_Code',
            'State_Code',
            'Zone_Code',
            'Distribution_Channel_Code',
            'Distribution_Channel_Name',
            'Customer_Group_Name',
            'Sales_Name',
            'Division_Name',
            'Sector_Name'
        ];

        // Check if ordering column is valid
        $order_column = in_array($order_column, $valid_columns) ? $order_column : 'Customer_Name';
        $this->db->order_by("ds.$order_column", $order_dir);

        // if (!in_array($order_column, $valid_columns)) {
        //     $order_column = 'Sales_Code';
        // }

        // if (in_array($order_dir, ['asc', 'desc'], true)) {
        //     $this->db->order_by($order_column, $order_dir);
        // } else {
        //     $this->db->order_by('Sales_Code', 'asc');
        // }

        $this->db->limit($length, $start);
        $query = $this->db->get();

        $result = $query->result_array();

        return $result;
    }




    public function is_pjp_code_mapped_to_levels($pjp_code)
    {
        // Define the levels to check
        $levels = [
            'Level_1',
            'Level_2',
            'Level_3',
            'Level_4',
            'Level_5',
            'Level_6',
            'Level_7'
        ];

        // Build the query to check if the pjp_code exists in any of the level columns
        $this->db->from('maping'); // Ensure table name is correct
        $this->db->group_start();
        foreach ($levels as $level) {
            $this->db->or_where($level, $pjp_code);
        }
        $this->db->group_end();

        $query = $this->db->get();

        return ($query->num_rows() > 0);
    }





    public function get_all_Maping_data_filter($salesCode = null, $customerTypeCode = null, $customerGroupCode = null, $divisionCode = null, $distributionChannelCode = null)
    {
        $conditions = [];

        if (!empty($salesCode)) {
            $conditions[] = "mp.Sales_Code = '" . $this->db->escape_str($salesCode) . "'";
        }
        if (!empty($customerTypeCode)) {
            $conditions[] = "mp.Customer_Type_Code = '" . $this->db->escape_str($customerTypeCode) . "'";
        }
        if (!empty($customerGroupCode)) {
            $conditions[] = "mp.Customer_Group_Code = '" . $this->db->escape_str($customerGroupCode) . "'";
        }
        if (!empty($divisionCode)) {
            $conditions[] = "mp.Division_Code = '" . $this->db->escape_str($divisionCode) . "'";
        }
        if (!empty($distributionChannelCode)) {
            $conditions[] = "mp.Distribution_Channel_Code = '" . $this->db->escape_str($distributionChannelCode) . "'";
        }

        $whereClause = '';
        if (!empty($conditions)) {
            $whereClause = 'WHERE ' . implode(' AND ', $conditions);
        }

        $sql = "
        SELECT DISTINCT
            mp.id,
            mp.DB_Code,
            mp.Level_1,
            emp1.name AS Level_1_Name,
            mp.Level_2,
            emp2.name AS Level_2_Name,
            mp.Level_3,
            emp3.name AS Level_3_Name,
            mp.Level_4,
            emp4.name AS Level_4_Name,
            mp.Level_5,
            emp5.name AS Level_5_Name,
            mp.Level_6,
            emp6.name AS Level_6_Name,
            mp.Level_7,
            emp7.name AS Level_7_Name,
            ds.Customer_Name,
            ds.Customer_Code,
            ds.Sales_Code,
            ds.Sales_Name,
            ds.Distribution_Channel_Code,
            ds.Distribution_Channel_Name,
            ds.Division_Code,
            ds.Division_Name,
            ds.Customer_Type_Code,
            ds.Customer_Group_Code,
            ds.Customer_Group_Name,
            ds.Customer_Type_Name,
            ds.Pin_Code,
            ds.City,
            ds.District,
            ds.Contact_Number,
            ds.Country,
            ds.Zone,
            ds.Zone_Code,
            ds.State,
            ds.State_Code,
            ds.Population_Strata_2,
            mp.distributors_id


FROM 
            maping mp
LEFT JOIN employee emp1 ON mp.Level_1 = emp1.pjp_code
LEFT JOIN employee emp2 ON mp.Level_2 = emp2.pjp_code
LEFT JOIN employee emp3 ON mp.Level_3 = emp3.pjp_code
LEFT JOIN employee emp4 ON mp.Level_4 = emp4.pjp_code
LEFT JOIN employee emp5 ON mp.Level_5 = emp5.pjp_code
LEFT JOIN employee emp6 ON mp.Level_6 = emp6.pjp_code
LEFT JOIN employee emp7 ON mp.Level_7 = emp7.pjp_code
LEFT JOIN distributors ds ON mp.DB_Code = ds.Customer_Code
            AND IFNULL(mp.Sales_Code, '') = IFNULL(ds.Sales_Code, '')
            AND IFNULL(mp.Distribution_Channel_Code, '') = IFNULL(ds.Distribution_Channel_Code, '')
            AND IFNULL(mp.Division_Code, '') = IFNULL(ds.Division_Code, '')
            AND IFNULL(mp.Customer_Type_Code, '') = IFNULL(ds.Customer_Type_Code, '')
            AND IFNULL(mp.Customer_Group_Code, '') = IFNULL(ds.Customer_Group_Code, '')
        $whereClause
        GROUP BY 
            mp.DB_Code, 
            mp.Level_1, 
            mp.Level_2, 
            mp.Level_3, 
            mp.Level_4, 
            mp.Level_5, 
            mp.Level_6, 
            mp.Level_7,
            ds.Customer_Name,
            ds.Customer_Code,
            ds.Sales_Code,
            ds.Sales_Name,
            ds.Distribution_Channel_Code,
            ds.Distribution_Channel_Name,
            ds.Division_Code,
            ds.Division_Name,
            ds.Customer_Type_Code,
            ds.Customer_Group_Code,
            ds.Customer_Group_Name,
            ds.Customer_Type_Name,
            ds.Pin_Code,
            ds.City,
            ds.District,
            ds.Contact_Number,
            ds.Country,
            ds.Zone,
            ds.Zone_Code,
            ds.State_Code,
            ds.State,
            ds.Population_Strata_2,
            mp.distributors_id;

        ";


        $query = $this->db->query($sql);

        $result = $query->result_array();

        return $result;
    }


    public function get_db_code_by_pjp_and_level($pjp_code, $level, $limit = 10, $offset = 0, $search = '')
    {
        if ($level < 1 || $level > 7) {

            return [];
        }

        $level_column = 'Level_' . $level;
        $limit = (int)$limit;
        $offset = (int)$offset;

        // Start building the query
        $this->db->select('maping.*, distributors.*')
            ->from('maping')
            ->join(
                'distributors',
                'distributors.Customer_Code = maping.DB_Code AND 
                distributors.Sales_Code = maping.Sales_Code AND 
                distributors.Distribution_Channel_Code = maping.Distribution_Channel_Code AND 
                distributors.Division_Code = maping.Division_Code AND 
                distributors.Customer_Type_Code = maping.Customer_Type_Code AND 
                distributors.Customer_Group_Code = maping.Customer_Group_Code',
                'inner'
            )
            ->where("maping.$level_column", $pjp_code);

        // Add search conditions if search term is provided
        if (!empty($search)) {
            $search = $this->db->escape_like_str($search);
            $this->db->group_start()
                ->like('distributors.Customer_Name', $search)
                ->or_like('distributors.Customer_Code', $search)
                ->or_like('distributors.Pin_Code', $search)
                ->or_like('distributors.City', $search)
                ->or_like('distributors.District', $search)
                ->or_like('distributors.Contact_Number', $search)
                ->or_like('distributors.Country', $search)
                ->or_like('distributors.Zone', $search)
                ->or_like('distributors.State', $search)
                ->or_like('distributors.Population_Strata_1', $search)
                ->or_like('distributors.Population_Strata_2', $search)
                ->or_like('distributors.Country_Group', $search)
                ->or_like('distributors.GTM_TYPE', $search)
                ->or_like('distributors.SUPERSTOCKIST', $search)
                ->or_like('distributors.STATUS', $search)
                ->or_like('distributors.Customer_Type_Code', $search)
                ->or_like('distributors.Sales_Code', $search)
                ->or_like('distributors.Customer_Type_Name', $search)
                ->or_like('distributors.Customer_Group_Code', $search)
                ->or_like('distributors.Customer_Creation_Date', $search)
                ->or_like('distributors.Division_Code', $search)
                ->or_like('distributors.Sector_Code', $search)
                ->or_like('distributors.State_Code', $search)
                ->or_like('distributors.Zone_Code', $search)
                ->or_like('distributors.Distribution_Channel_Code', $search)
                ->or_like('distributors.Distribution_Channel_Name', $search)
                ->or_like('distributors.Customer_Group_Name', $search)
                ->or_like('distributors.Sales_Name', $search)
                ->or_like('distributors.Division_Name', $search)
                ->or_like('distributors.Sector_Name', $search)
                ->group_end();
        }



        $this->db->group_by([
            'distributors.Customer_Code',
            'distributors.Sales_Code',
            'distributors.Distribution_Channel_Code',
            'distributors.Division_Code',
            'distributors.Customer_Type_Code',
            'distributors.Customer_Group_Code',
            'maping.distributors_id'
        ]);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function get_total_records($pjp_code, $level, $search = '')
    {
        if ($level < 1 || $level > 7) {
            return 0;
        }

        $level_column = 'Level_' . $level;

        $this->db->select('COUNT( distributors.Customer_Code) as total')
            ->from('maping')
            ->join(
                'distributors',
                'distributors.Customer_Code = maping.DB_Code AND 
                distributors.Sales_Code = maping.Sales_Code AND 
                distributors.Distribution_Channel_Code = maping.Distribution_Channel_Code AND 
                distributors.Division_Code = maping.Division_Code AND 
                distributors.Customer_Type_Code = maping.Customer_Type_Code AND 
                distributors.Customer_Group_Code = maping.Customer_Group_Code',
                'inner'
            )
            ->where("maping.$level_column", $pjp_code);

        if (!empty($search)) {
            $search = $this->db->escape_like_str($search);

            // log_message('debug', 'Search applied with escaped term: ' . $search);
            // log_message('debug', 'Building search query...');

            $this->db->group_start()
                ->like('distributors.Customer_Name', $search)
                ->or_like('distributors.Customer_Code', $search)
                ->or_like('distributors.Pin_Code', $search)
                ->or_like('distributors.City', $search)
                ->or_like('distributors.District', $search)
                ->or_like('distributors.Contact_Number', $search)
                ->or_like('distributors.Country', $search)
                ->or_like('distributors.Zone', $search)
                ->or_like('distributors.State', $search)
                ->or_like('distributors.Population_Strata_1', $search)
                ->or_like('distributors.Population_Strata_2', $search)
                ->or_like('distributors.Country_Group', $search)
                ->or_like('distributors.GTM_TYPE', $search)
                ->or_like('distributors.SUPERSTOCKIST', $search)
                ->or_like('distributors.STATUS', $search)
                ->or_like('distributors.Customer_Type_Code', $search)
                ->or_like('distributors.Sales_Code', $search)
                ->or_like('distributors.Customer_Type_Name', $search)
                ->or_like('distributors.Customer_Group_Code', $search)
                ->or_like('distributors.Customer_Creation_Date', $search)
                ->or_like('distributors.Division_Code', $search)
                ->or_like('distributors.Sector_Code', $search)
                ->or_like('distributors.State_Code', $search)
                ->or_like('distributors.Zone_Code', $search)
                ->or_like('distributors.Distribution_Channel_Code', $search)
                ->or_like('distributors.Distribution_Channel_Name', $search)
                ->or_like('distributors.Customer_Group_Name', $search)
                ->or_like('distributors.Sales_Name', $search)
                ->or_like('distributors.Division_Name', $search)
                ->or_like('distributors.Sector_Name', $search)
                ->group_end();
        }

        $result = $this->db->get()->row();


        return $result ? $result->total : 0;
    }





    public function get_common_records($pjp_code, $level)
    {
        if ($level < 1 || $level > 7) {
            // log_message('error', 'Invalid level provided: ' . $level);
            return [];
        }

        $level_column = 'Level_' . $level;
        // log_message('debug', "Level Column: " . $level_column); // Log level column

        // Start building the query to fetch all data without pagination or search
        $this->db->select('maping.*, distributors.*')
            ->from('maping')
            ->join(
                'distributors',
                'distributors.Customer_Code = maping.DB_Code AND 
                distributors.Sales_Code = maping.Sales_Code AND 
                distributors.Distribution_Channel_Code = maping.Distribution_Channel_Code AND 
                distributors.Division_Code = maping.Division_Code AND 
                distributors.Customer_Type_Code = maping.Customer_Type_Code AND 
                distributors.Customer_Group_Code = maping.Customer_Group_Code',
                'inner'
            )
            ->where("maping.$level_column", $pjp_code); // Fetch records based on level and pjp_code

        // No search conditions applied now

        // Group by the necessary fields to avoid duplicates
        $this->db->group_by([
            'distributors.Customer_Code',
            'distributors.Sales_Code',
            'distributors.Distribution_Channel_Code',
            'distributors.Division_Code',
            'distributors.Customer_Type_Code',
            'distributors.Customer_Group_Code',
            'maping.distributors_id'
        ]);

        // Fetch all records without any limit
        $query = $this->db->get();
        // Log the query for debugging
        $result = $query->result_array();

        return $result; // Return all matching records
    }






    public function get_zone_permissions_by_empid($empid)
    {

        $this->db->select('z.zone_id, z.other_columns');
        $this->db->from('zone_permissions z');
        $this->db->where('z.user_id', $empid);
        $query = $this->db->get();




        $zone_permissions = $query->result_array();
        // log_message('debug', 'Fetched Data: ' . print_r($zone_permissions, true));
        if (empty($zone_permissions)) {

            return [];
        }

        return $zone_permissions;
    }

    public function get_all_Maping_table_admin_zone()
    {

        $this->db->select('z.zone_id');
        $this->db->from('zone_permissions z');
        $this->db->where('z.user_id', "12");
        $query = $this->db->get();



        $zone_permissions = $query->result_array();
        // log_message('debug', 'Fetched Data: ' . print_r($zone_permissions, true));
        if (empty($zone_permissions)) {

            return [];
        }


        $zone_ids = [];
        foreach ($zone_permissions as $zone) {
            $zone_ids = array_merge($zone_ids, json_decode($zone['zone_id']));
        }


        $this->db->select('Customer_Code, Zone');
        $this->db->from('distributors d');
        $this->db->where_in('d.Zone_Code', $zone_ids);
        $query = $this->db->get();



        $customer_codes = $query->result_array();
        // log_message('debug', 'Fetched Data: ' . print_r($customer_codes, true));
        if (empty($customer_codes)) {

            return [];
        }


        $customer_codes_list = array_column($customer_codes, 'Customer_Code');
        $this->db->select('m.*, d.Customer_Code, d.Zone');
        $this->db->from('maping m');
        $this->db->join('distributors d', 'm.DB_Code = d.Customer_Code', 'inner');
        $this->db->where_in('m.DB_Code', $customer_codes_list);
        $query = $this->db->get();



        $mapping_data = $query->result_array();
        // log_message('debug', 'Fetched Data: ' . print_r($mapping_data, true));
        if (empty($mapping_data)) {

            return [];
        }


        $tree = [];
        foreach ($mapping_data as $row) {
            $current_level = &$tree;

            for ($i = 1; $i <= 7; $i++) {
                $level_key = "Level_$i";
                $level_value = $row[$level_key];

                if (!empty($level_value)) {
                    if (!isset($current_level[$level_key][$level_value])) {
                        $current_level[$level_key][$level_value] = [
                            'name' => $this->get_employee_name($level_value),
                            'zone' => $row['Zone'],
                            'Customer_Code' => $row['Customer_Code'],
                            'DB_Code' => $row['DB_Code'],
                            'children' => []
                        ];
                    }

                    $current_level = &$current_level[$level_key][$level_value]['children'];
                }
            }
        }

        return $tree;
    }



    public function get_all_Maping_data_zone()
    {
        $sql = "
           SELECT DISTINCT
mp.id,
    mp.DB_Code,
    mp.Level_1,
    emp1.name AS Level_1_Name,
    mp.Level_2,
    emp2.name AS Level_2_Name,
    mp.Level_3,
    emp3.name AS Level_3_Name,
    mp.Level_4,
    emp4.name AS Level_4_Name,
    mp.Level_5,
    emp5.name AS Level_5_Name,
    mp.Level_6,
    emp6.name AS Level_6_Name,
    mp.Level_7,
    emp7.name AS Level_7_Name,
    ds.Customer_Name,
    ds.Customer_Code,
    ds.Sales_Code,
    ds.Sales_Name,
    ds.Distribution_Channel_Code,
    ds.Distribution_Channel_Name,
    ds.Division_Code,
    ds.Division_Name,
    ds.Customer_Type_Code,
    ds.Customer_Group_Code,
       ds.Customer_Group_Name,
    ds.Customer_Type_Name,
    ds.Pin_Code,
    ds.City,
    ds.District,
    ds.Contact_Number,
    ds.Country,
    ds.Zone,
    ds.Zone_Code,
    ds.State,
    ds.State_Code,
    ds.Population_Strata_2,
    mp.distributors_id


FROM 
    maping mp
LEFT JOIN employee emp1 ON mp.Level_1 = emp1.pjp_code
LEFT JOIN employee emp2 ON mp.Level_2 = emp2.pjp_code
LEFT JOIN employee emp3 ON mp.Level_3 = emp3.pjp_code
LEFT JOIN employee emp4 ON mp.Level_4 = emp4.pjp_code
LEFT JOIN employee emp5 ON mp.Level_5 = emp5.pjp_code
LEFT JOIN employee emp6 ON mp.Level_6 = emp6.pjp_code
LEFT JOIN employee emp7 ON mp.Level_7 = emp7.pjp_code
LEFT JOIN distributors ds ON mp.DB_Code = ds.Customer_Code
    AND IFNULL(mp.Sales_Code, '') = IFNULL(ds.Sales_Code, '')
    AND IFNULL(mp.Distribution_Channel_Code, '') = IFNULL(ds.Distribution_Channel_Code, '')
    AND IFNULL(mp.Division_Code, '') = IFNULL(ds.Division_Code, '')
    AND IFNULL(mp.Customer_Type_Code, '') = IFNULL(ds.Customer_Type_Code, '')
    AND IFNULL(mp.Customer_Group_Code, '') = IFNULL(ds.Customer_Group_Code, '')
GROUP BY 
    mp.DB_Code, 
    mp.Level_1, 
    mp.Level_2, 
    mp.Level_3, 
    mp.Level_4, 
    mp.Level_5, 
    mp.Level_6, 
    mp.Level_7,
    ds.Customer_Name,
    ds.Customer_Code,
    ds.Sales_Code,
    ds.Sales_Name,
    ds.Distribution_Channel_Code,
    ds.Distribution_Channel_Name,
    ds.Division_Code,
    ds.Division_Name,
    ds.Customer_Type_Code,
    ds.Customer_Group_Code,
    ds.Customer_Group_Name,
    ds.Customer_Type_Name,
    ds.Pin_Code,
    ds.City,
    ds.District,
    ds.Contact_Number,
    ds.Country,
    ds.Zone,
    ds.Zone_Code,
    ds.State_Code,
    ds.State,
    ds.Population_Strata_2,
    mp.distributors_id;

        ";


        $query = $this->db->query($sql);

        $result = $query->result_array();

        return $result;
    }




    public function check_existing_mapping($data)
    {
        $this->db->where('DB_Code', $data['DB_Code']);
        $this->db->where('Sales_Code', $data['Sales_Code']);
        $this->db->where('Distribution_Channel_Code', $data['Distribution_Channel_Code']);
        $this->db->where('Division_Code', $data['Division_Code']);
        $this->db->where('Customer_Type_Code', $data['Customer_Type_Code']);
        $this->db->where('Customer_Group_Code', $data['Customer_Group_Code']);

        $query = $this->db->get('maping');

        $result = $query->num_rows();

        return $result > 0;
    }

    public function get_mapping_by_id($id)
    {
        log_message('debug', "Fetching mapping by ID: $id");
    
        $this->db->where('id', $id);
        $query = $this->db->get('maping');
    
        if ($query->num_rows() == 0) {
            log_message('error', "No mapping found for ID: $id");
            return null;
        }
    
        log_message('debug', "Mapping data found for ID: $id");
    
        return $query->row_array();  // returns associative array
    }
    



    public function insert_mapping($data)
    {
        $result = $this->db->insert('maping', $data);
        // log_message('debug', 'Inserted Data: ' . print_r($result, true));
        return $result;
    }

    public function update_pjp_code($level, $pjp_code_old, $DB_Code, $set_pjp_code, $Replace_DB_Code = null, $Vacant = null)
    {
        $level_column = 'Level_' . $level;


        if (!empty($DB_Code)) {

            $this->db->where($level_column, $pjp_code_old);
            $this->db->where_in('DB_Code', $DB_Code);
            $this->db->update('maping', [$level_column => $set_pjp_code]);

            if ($this->db->affected_rows() > 0) {

                $old_city = $this->get_employee_city($pjp_code_old);
                $new_city = $this->get_employee_city($set_pjp_code);


                if ($old_city !== $new_city && $Vacant !== null && !empty($Replace_DB_Code)) {

                    $this->db->where($level_column, $set_pjp_code);
                    $this->db->where_in('DB_Code', $Replace_DB_Code);
                    $this->db->update('maping', [$level_column => $Vacant]);
                } else {
                }

                return true;
            } else {

                return false;
            }
        } else {

            return false;
        }
    }


    private function get_employee_city($pjp_code)
    {
        $this->db->select('city');
        $this->db->from('employee');
        $this->db->where('PJP_Code', $pjp_code);
        $query = $this->db->get();


        if ($query->num_rows() > 0) {
            $result = $query->row()->city;

            return $result;
        }

        return null;
    }

    public function get_pjp_code_by_level($level, $pjp_code, $limit = 20, $offset = 0, $search = '')
    {



        // if (empty($zone_ids) || !is_array($zone_ids)) {
        //     return ['data' => [], 'total_count' => 0];
        // }


        $level_column = 'Level_' . intval($level);

        $this->db->select('m.*, d.Customer_Name, d.Customer_Code, d.City, d.Pin_Code, d.District, d.Contact_Number, d.Country, d.Zone, d.State, d.Population_Strata_1, d.Population_Strata_2, d.Country_Group, d.GTM_TYPE, d.SUPERSTOCKIST, d.STATUS, d.Customer_Type_Code, d.Sales_Code, d.Customer_Type_Name, d.Customer_Group_Code, d.Customer_Creation_Date, d.Division_Code, d.Sector_Code, d.State_Code, d.Zone_Code, d.Distribution_Channel_Code, d.Distribution_Channel_Name, d.Customer_Group_Name, d.Sales_Name, d.Division_Name, d.Sector_Name');
        $this->db->from('maping m');
        $this->db->join(
            'distributors d',
            'm.DB_Code = d.Customer_Code
          AND m.Sales_Code = d.Sales_Code
           AND m.Distribution_Channel_Code = d.Distribution_Channel_Code
            AND m.Division_Code = d.Division_Code
             AND m.Customer_Type_Code = d.Customer_Type_Code
             AND m.Customer_Group_Code = d.Customer_Group_Code',
            'left'
        );



        $this->db->where("m.$level_column", $pjp_code);

        // if (!empty($zone_ids)) {
        //     $this->db->where_in('d.Zone_Code', $zone_ids);
        // }

        // Apply search if provided
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('d.Customer_Name', $search);
            $this->db->or_like('d.Customer_Code', $search);
            $this->db->or_like('d.City', $search);
            $this->db->or_like('d.Pin_Code', $search);
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
            $this->db->or_like('d.Sector_Name', $search)
                ->group_end();
        }

        // Get total count before applying limit
        $total_count = $this->db->count_all_results('', false);

        // Apply pagination
        $this->db->limit($limit, $offset);

        // Execute the query
        $query = $this->db->get();

        $result = $query->result_array();

        return [
            'data' => $result,
            'total_count' => $total_count
        ];
    }









    public function Transfer_update_pjp_code($level, $pjp_code_old, $DB_Code, $set_pjp_code, $Replace_DB_Code, $Vacant = null)
    {
        $level_column = 'Level_' . $level;


        if (!empty($DB_Code) && !empty($set_pjp_code)) {
            $this->db->where($level_column, $pjp_code_old);
            $this->db->where_in('DB_Code', $DB_Code);
            $this->db->update('maping', [$level_column => $set_pjp_code]);
        }


        if (!is_null($Vacant) && !empty($Replace_DB_Code)) {
            $this->db->where($level_column, $pjp_code_old);
            $this->db->where_in('DB_Code', $Replace_DB_Code);
            $this->db->update('maping', [$level_column => $Vacant]);
        }


        if (is_null($Vacant)) {
        }

        return true;
    }




    public function Promoted_update_pjp_code($level_pass, $pjp_code_old, $DB_Code, $set_pjp_code, $Replace_DB_Code, $Vacant = null)
    {
        $level_column = 'Level_' . $level_pass;

        if (!empty($DB_Code) && !empty($set_pjp_code)) {
            $this->db->where($level_column, $pjp_code_old);
            $this->db->where_in('DB_Code', $DB_Code);
            $this->db->update('maping', [$level_column => $set_pjp_code]);
        }


        if (!is_null($Vacant) && !empty($Replace_DB_Code)) {
            $this->db->where($level_column, $pjp_code_old);
            $this->db->where_in('DB_Code', $Replace_DB_Code);
            $this->db->update('maping', [$level_column => $Vacant]);
        }


        if (is_null($Vacant)) {
        }

        return true;
    }

    public function get_last_sequence_number($distributor_code)
    {
        // Get today's date
        $today = date('Ymd');

        // Query to get the maximum sequence number for the given distributor for today
        $this->db->select('distributors_id');
        $this->db->where('DB_Code', $distributor_code);
        $this->db->like('distributors_id', $today, 'after');
        $this->db->order_by('distributors_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('maping');


        if ($query->num_rows() > 0) {
            // Extract the sequence number from the last distributors_id
            $last_distributors_id = $query->row()->distributors_id;
            // Extract the last 4 digits as the sequence number
            $last_sequence = intval(substr($last_distributors_id, -4));
            return $last_sequence;
        }

        // If no previous entry exists for today, start from 0
        return 0;
    }

    public function get_next_global_sequence()
    {
        // Get the maximum existing sequence number
        $this->db->select_max('CAST(SUBSTRING_INDEX(distributors_id, "_", -1) AS UNSIGNED)', 'max_sequence');
        $query = $this->db->get('maping');

        $result = $query->row();

        // Increment the sequence
        $new_sequence = $result->max_sequence ? $result->max_sequence + 1 : 1;

        return $new_sequence;
    }
}
