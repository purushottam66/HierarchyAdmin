<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Export_distributors_csv extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        ini_set('memory_limit', '1024M');

        $this->load->model('User_model');
        $this->load->model('Role_model');
        $this->load->model('Employee_model');
        $this->load->library('email');

        $this->load->model('Maping_model');
        $this->load->model('Distributor_model');
    }


    public function unmapped_distributors_csv()
    {

        $data = $this->Distributor_model->unmapped_Distributors_csv();
        $fileName = 'distributor_data' . date('Ymd') . '.csv';

        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=$fileName");

        $output = fopen('php://output', 'w');
        fputcsv($output, [
            'ID',
            'Customer Name',
            'Customer Code',
            'Pin Code',
            'City',
            'District',
            'Contact Number',
            'Country',
            'Zone',
            'State',
            'Population Strata 1',
            'Population Strata 2',
            'Country Group',
            'GTM TYPE',
            'SUPERSTOCKIST',
            'STATUS',
            'Customer Type Code',
            'Sales Code',
            'Customer Type Name',
            'Customer Group Code',
            'Customer Creation Date',
            'Division Code',
            'Sector Code',
            'State Code',
            'Zone Code',
            'Distribution Channel Code',
            'Distribution Channel Name',
            'Customer Group Name',
            'Sales Name',
            'Division Name',
            'Sector Name'
        ]);

        // Write data rows
        foreach ($data as $row) {
            fputcsv($output, [
                $row['id'],
                $row['Customer_Name'],
                $row['Customer_Code'],
                $row['Pin_Code'],
                $row['City'],
                $row['District'],
                $row['Contact_Number'],
                $row['Country'],
                $row['Zone'],
                $row['State'],
                $row['Population_Strata_1'],
                $row['Population_Strata_2'],
                $row['Country_Group'],
                $row['GTM_TYPE'],
                $row['SUPERSTOCKIST'],
                $row['STATUS'],
                $row['Customer_Type_Code'],
                $row['Sales_Code'],
                $row['Customer_Type_Name'],
                $row['Customer_Group_Code'],
                $row['Customer_Creation_Date'],
                $row['Division_Code'],
                $row['Sector_Code'],
                $row['State_Code'],
                $row['Zone_Code'],
                $row['Distribution_Channel_Code'],
                $row['Distribution_Channel_Name'],
                $row['Customer_Group_Name'],
                $row['Sales_Name'],
                $row['Division_Name'],
                $row['Sector_Name'],
            ]);
        }

      
        fclose($output);
        exit;
    }



    public function distributors_csv()
    {

        $data = $this->Distributor_model->get_all_distributors();
        $fileName = 'distributor_data' . date('Ymd') . '.csv';

        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=$fileName");

        $output = fopen('php://output', 'w');
        fputcsv($output, [
            'ID',
            'Customer Name',
            'Customer Code',
            'Pin Code',
            'City',
            'District',
            'Contact Number',
            'Country',
            'Zone',
            'State',
            'Population Strata 1',
            'Population Strata 2',
            'Country Group',
            'GTM TYPE',
            'SUPERSTOCKIST',
            'STATUS',
            'Customer Type Code',
            'Sales Code',
            'Customer Type Name',
            'Customer Group Code',
            'Customer Creation Date',
            'Division Code',
            'Sector Code',
            'State Code',
            'Zone Code',
            'Distribution Channel Code',
            'Distribution Channel Name',
            'Customer Group Name',
            'Sales Name',
            'Division Name',
            'Sector Name'
        ]);

        // Write data rows
        foreach ($data as $row) {
            fputcsv($output, [
                $row['id'],
                $row['Customer_Name'],
                $row['Customer_Code'],
                $row['Pin_Code'],
                $row['City'],
                $row['District'],
                $row['Contact_Number'],
                $row['Country'],
                $row['Zone'],
                $row['State'],
                $row['Population_Strata_1'],
                $row['Population_Strata_2'],
                $row['Country_Group'],
                $row['GTM_TYPE'],
                $row['SUPERSTOCKIST'],
                $row['STATUS'],
                $row['Customer_Type_Code'],
                $row['Sales_Code'],
                $row['Customer_Type_Name'],
                $row['Customer_Group_Code'],
                $row['Customer_Creation_Date'],
                $row['Division_Code'],
                $row['Sector_Code'],
                $row['State_Code'],
                $row['Zone_Code'],
                $row['Distribution_Channel_Code'],
                $row['Distribution_Channel_Name'],
                $row['Customer_Group_Name'],
                $row['Sales_Name'],
                $row['Division_Name'],
                $row['Sector_Name'],
            ]);
        }

        // Close output stream
        fclose($output);
        exit;
    }


    public function export_distributors_csv()
    {
       
        $customer_group_code = $this->input->get('Customer_Group_Code');
        $customer_type_code = $this->input->get('Customer_Type_Code');
        $distribution_channel_code = $this->input->get('Distribution_Channel_Code');
        $division_code = $this->input->get('Division_Code');
        $population_strata_2 = $this->input->get('Population_Strata_2');
        $sales_code = $this->input->get('Sales_Code');

        $zone = $this->input->get('zoneSelect');
        $state_code = $this->input->get('State_Code');
        $city = $this->input->get('City');

        $search = $this->input->get('dt-search-0');


        

        $customer_group_code = $customer_group_code ? json_decode($customer_group_code, true) : [];
        $customer_type_code = $customer_type_code ? json_decode($customer_type_code, true) : [];
        $distribution_channel_code = $distribution_channel_code ? json_decode($distribution_channel_code, true) : [];
        $division_code = $division_code ? json_decode($division_code, true) : [];
        $population_strata_2 = $population_strata_2 ? json_decode($population_strata_2, true) : [];
        $sales_code = $sales_code ? json_decode($sales_code, true) : [];
        $zone = $zone ? json_decode($zone, true) : [];
        $state_code = $state_code ? json_decode($state_code, true) : [];
        $city = $city ? json_decode($city, true) : [];
        $search = $search ? json_decode($search, true) : [];

        $data = $this->Distributor_model->get_all_distributors_filtered(
            $customer_group_code,
            $customer_type_code,
            $distribution_channel_code,
            $division_code,
            $population_strata_2,
            $sales_code,
            $zone,
            $state_code,
            $city,
            $search
        );

        $fileName = 'distributor_data_' . date('Ymd') . '.csv';

        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=$fileName");

        $output = fopen('php://output', 'w');
        fputcsv($output, [
            'ID',
            'DB Code',
            'Level 1',
            'Level 1 Name',
            'Level 1 Employer Code',
            'Level 1 Designation Name',
            'Emp_id1',
            'Level 2',
            'Level 2 Name',
            'Level 2 Employer Code',
            'Level 2 Designation Name',
            'Emp_id2',
            'Level 3',
            'Level 3 Name',
            'Level 3 Employer Code',
            'Level 3 Designation Name',
            'Emp_id3',
            'Level 4',
            'Level 4 Name',
            'Level 4 Employer Code',
            'Level 4 Designation Name',
            'Emp_id4',
            'Level 5',
            'Level 5 Name',
            'Level 5 Employer Code',
            'Level 5 Designation Name',
            'Emp_id5',
            'Level 6',
            'Level 6 Name',
            'Level 6 Employer Code',
            'Level 6 Designation Name',
            'Emp_id6',
            'Level 7',
            'Level 7 Name',
            'Level 7 Employer Code',
            'Level 7 Designation Name',
            'Emp_id7',
            'Customer Name',
            'Customer Code',
            'Sales Code',
            'Distribution Channel Code',
            'Division Code',
            'Customer Type Code',
            'Customer Group Code',
            'Pin Code',
            'City',
            'District',
            'Contact Number',
            'Country',
            'Zone',
            'State',
            'Population Strata 1',
            'Population Strata 2',
            'Country Group',
            'GTM TYPE',
            'SUPERSTOCKIST',
            'STATUS',
            'Customer Type Name',
            'Customer Creation Date',
            'Division Name',
            'Sector Code',
            'State Code',
            'Zone Code',
            'Distribution Channel Name',
            'Customer Group Name',
            'Sales Name',
            'Division Name',
            'Sector Name'
        ]);


  
        foreach ($data as $row) {
            fputcsv($output, [
                $row['id'],
                $row['DB_Code'],
                $row['Level_1'],
                $row['Level_1_Name'],
                $row['Level_1_Employer_Code'],
                $row['Level_1_Designation_Name'],
                $row['Emp_id1'],
                $row['Level_2'],
                $row['Level_2_Name'],
                $row['Level_2_Employer_Code'],
                $row['Level_2_Designation_Name'],
                $row['Emp_id2'],
                $row['Level_3'],
                $row['Level_3_Name'],
                $row['Level_3_Employer_Code'],
                $row['Level_3_Designation_Name'],
                $row['Emp_id3'],
                $row['Level_4'],
                $row['Level_4_Name'],
                $row['Level_4_Employer_Code'],
                $row['Level_4_Designation_Name'],
                $row['Emp_id4'],
                $row['Level_5'],
                $row['Level_5_Name'],
                $row['Level_5_Employer_Code'],
                $row['Level_5_Designation_Name'],
                $row['Emp_id5'],
                $row['Level_6'],
                $row['Level_6_Name'],
                $row['Level_6_Employer_Code'],
                $row['Level_6_Designation_Name'],
                $row['Emp_id6'],
                $row['Level_7'],
                $row['Level_7_Name'],
                $row['Level_7_Employer_Code'],
                $row['Level_7_Designation_Name'],
                $row['Emp_id7'],
                $row['Customer_Name'],
                $row['Customer_Code'],
                $row['Sales_Code'],
                $row['Distribution_Channel_Code'],
                $row['Division_Code'],
                $row['Customer_Type_Code'],
                $row['Customer_Group_Code'],
                $row['Pin_Code'],
                $row['City'],
                $row['District'],
                $row['Contact_Number'],
                $row['Country'],
                $row['Zone'],
                $row['State'],
                $row['Population_Strata_1'],
                $row['Population_Strata_2'],
                $row['Country_Group'],
                $row['GTM_TYPE'],
                $row['SUPERSTOCKIST'],
                $row['STATUS'],
                $row['Customer_Type_Name'],
                $row['Customer_Creation_Date'],
                $row['Division_Name'],
                $row['Sector_Code'],
                $row['State_Code'],
                $row['Zone_Code'],
                $row['Distribution_Channel_Name'],
                $row['Customer_Group_Name'],
                $row['Sales_Name'],
                $row['Division_Name'],
                $row['Sector_Name']
            ]);
        }


        fclose($output);
        exit;
    }




    public function export_unmaped_distributors_csv()
    {

        $data = $this->Distributor_model->get_unmapped_distributors();
        $fileName = 'unmapped_distributors_export_' . date('Ymd') . '.csv';

        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=$fileName");

        $output = fopen('php://output', 'w');
        fputcsv($output, [
            'ID',
            'Customer Name',
            'Customer Code',
            'Pin Code',
            'City',
            'District',
            'Contact Number',
            'Country',
            'Zone',
            'State',
            'Population Strata 1',
            'Population Strata 2',
            'Country Group',
            'GTM TYPE',
            'SUPERSTOCKIST',
            'STATUS',
            'Customer Type Code',
            'Sales Code',
            'Customer Type Name',
            'Customer Group Code',
            'Customer Creation Date',
            'Division Code',
            'Sector Code',
            'State Code',
            'Zone Code',
            'Distribution Channel Code',
            'Distribution Channel Name',
            'Customer Group Name',
            'Sales Name',
            'Division Name',
            'Sector Name'
        ]);

      
        foreach ($data as $row) {
            fputcsv($output, [
                $row['id'],
                $row['Customer_Name'],
                $row['Customer_Code'],
                $row['Pin_Code'],
                $row['City'],
                $row['District'],
                $row['Contact_Number'],
                $row['Country'],
                $row['Zone'],
                $row['State'],
                $row['Population_Strata_1'],
                $row['Population_Strata_2'],
                $row['Country_Group'],
                $row['GTM_TYPE'],
                $row['SUPERSTOCKIST'],
                $row['STATUS'],
                $row['Customer_Type_Code'],
                $row['Sales_Code'],
                $row['Customer_Type_Name'],
                $row['Customer_Group_Code'],
                $row['Customer_Creation_Date'],
                $row['Division_Code'],
                $row['Sector_Code'],
                $row['State_Code'],
                $row['Zone_Code'],
                $row['Distribution_Channel_Code'],
                $row['Distribution_Channel_Name'],
                $row['Customer_Group_Name'],
                $row['Sales_Name'],
                $row['Division_Name'],
                $row['Sector_Name'],
            ]);
        }

       
        fclose($output);
        exit;
    }





    public function export_distributors_tree_csv()
    {
       
        $id = $this->input->get('id');
        $level = $this->input->get('level');


        $search = $this->input->get('dt-search-0');


        

        $id = $id ? json_decode($id, true) : [];
        $level = $level ? json_decode($level, true) : [];

        $search = $search ? json_decode($search, true) : [];

        $data = $this->Distributor_model->get_all_distributors_filtered(
            $id,
            $level,
            $search
        );

        $fileName = 'distributor_data_' . date('Ymd') . '.csv';

        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=$fileName");

        $output = fopen('php://output', 'w');
        fputcsv($output, [
            'ID',
            'DB Code',
            'Level 1',
            'Level 1 Name',
            'Level 1 Employer Code',
            'Level 1 Designation Name',
            'Emp_id1',
            'Level 2',
            'Level 2 Name',
            'Level 2 Employer Code',
            'Level 2 Designation Name',
            'Emp_id2',
            'Level 3',
            'Level 3 Name',
            'Level 3 Employer Code',
            'Level 3 Designation Name',
            'Emp_id3',
            'Level 4',
            'Level 4 Name',
            'Level 4 Employer Code',
            'Level 4 Designation Name',
            'Emp_id4',
            'Level 5',
            'Level 5 Name',
            'Level 5 Employer Code',
            'Level 5 Designation Name',
            'Emp_id5',
            'Level 6',
            'Level 6 Name',
            'Level 6 Employer Code',
            'Level 6 Designation Name',
            'Emp_id6',
            'Level 7',
            'Level 7 Name',
            'Level 7 Employer Code',
            'Level 7 Designation Name',
            'Emp_id7',
            'Customer Name',
            'Customer Code',
            'Sales Code',
            'Distribution Channel Code',
            'Division Code',
            'Customer Type Code',
            'Customer Group Code',
            'Pin Code',
            'City',
            'District',
            'Contact Number',
            'Country',
            'Zone',
            'State',
            'Population Strata 1',
            'Population Strata 2',
            'Country Group',
            'GTM TYPE',
            'SUPERSTOCKIST',
            'STATUS',
            'Customer Type Name',
            'Customer Creation Date',
            'Division Name',
            'Sector Code',
            'State Code',
            'Zone Code',
            'Distribution Channel Name',
            'Customer Group Name',
            'Sales Name',
            'Division Name',
            'Sector Name'
        ]);


  
        foreach ($data as $row) {
            fputcsv($output, [
                $row['id'],
                $row['DB_Code'],
                $row['Level_1'],
                $row['Level_1_Name'],
                $row['Level_1_Employer_Code'],
                $row['Level_1_Designation_Name'],
                $row['Emp_id1'],
                $row['Level_2'],
                $row['Level_2_Name'],
                $row['Level_2_Employer_Code'],
                $row['Level_2_Designation_Name'],
                $row['Emp_id2'],
                $row['Level_3'],
                $row['Level_3_Name'],
                $row['Level_3_Employer_Code'],
                $row['Level_3_Designation_Name'],
                $row['Emp_id3'],
                $row['Level_4'],
                $row['Level_4_Name'],
                $row['Level_4_Employer_Code'],
                $row['Level_4_Designation_Name'],
                $row['Emp_id4'],
                $row['Level_5'],
                $row['Level_5_Name'],
                $row['Level_5_Employer_Code'],
                $row['Level_5_Designation_Name'],
                $row['Emp_id5'],
                $row['Level_6'],
                $row['Level_6_Name'],
                $row['Level_6_Employer_Code'],
                $row['Level_6_Designation_Name'],
                $row['Emp_id6'],
                $row['Level_7'],
                $row['Level_7_Name'],
                $row['Level_7_Employer_Code'],
                $row['Level_7_Designation_Name'],
                $row['Emp_id7'],
                $row['Customer_Name'],
                $row['Customer_Code'],
                $row['Sales_Code'],
                $row['Distribution_Channel_Code'],
                $row['Division_Code'],
                $row['Customer_Type_Code'],
                $row['Customer_Group_Code'],
                $row['Pin_Code'],
                $row['City'],
                $row['District'],
                $row['Contact_Number'],
                $row['Country'],
                $row['Zone'],
                $row['State'],
                $row['Population_Strata_1'],
                $row['Population_Strata_2'],
                $row['Country_Group'],
                $row['GTM_TYPE'],
                $row['SUPERSTOCKIST'],
                $row['STATUS'],
                $row['Customer_Type_Name'],
                $row['Customer_Creation_Date'],
                $row['Division_Name'],
                $row['Sector_Code'],
                $row['State_Code'],
                $row['Zone_Code'],
                $row['Distribution_Channel_Name'],
                $row['Customer_Group_Name'],
                $row['Sales_Name'],
                $row['Division_Name'],
                $row['Sector_Name']
            ]);
        }


        fclose($output);
        exit;
    }
}
