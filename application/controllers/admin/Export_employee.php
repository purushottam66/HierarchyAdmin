<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Export_employee extends CI_Controller
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


    public function Unmapped_Employee_csv()
    {

        $data = $this->Employee_model->Unmapped_Employee_csv();
        $fileName = 'employee_data' . date('Ymd') . '.csv';

        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=$fileName");

        $output = fopen('php://output', 'w');
        fputcsv($output, [
            'ID',
            'Name',
            'Email',
            'Mobile',
            'Employee ID',
            'Level',
            'City',
            'Designation',
            'Designation Label',
            'Gender',
            'Employee Status',

     
        ]);

        // Write data rows
        foreach ($data as $row) {
            fputcsv($output, [
                $row['id'],
                $row['name'],
                $row['email'],
                $row['mobile'],
                $row['employee_id'],
                $row['level'],
                $row['city'],
                $row['designation_name'],
                $row['designation_label_name'],
                $row['gender'],
                $row['employee_status'],
    
            ]);
        }

      
        fclose($output);
        exit;
    }




}
