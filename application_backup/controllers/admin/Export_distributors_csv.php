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


    public function export_distributors_csv()
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
}
