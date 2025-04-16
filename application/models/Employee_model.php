<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function insert_employee($data)
    {
        return $this->db->insert('employee', $data);
    }


    public function get_all_employees()
    {
        $this->db->select('e.*, l.level_name, d1.Designation as designation_name, d2.Designation_Label as designation_label_name');
        $this->db->from('employee e');
        $this->db->join('levels l', 'e.level = l.level_id', 'left');
        $this->db->join('designations d1', 'e.designation = d1.id', 'left');
        $this->db->join('designations d2', 'e.designation_label = d2.id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function email_exists($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('employee');
        return $query->num_rows() > 0;
    }


    public function get_mapping_by_id($id)
    {
        log_message('debug', "Fetching mapping by ID: $id");
    
        $this->db->where('id', $id);
        $query = $this->db->get('employee');
    
        if ($query->num_rows() == 0) {
            log_message('error', "No mapping found for ID: $id");
            return null;
        }
    
        log_message('debug', "Mapping data found for ID: $id");
    
        return $query->row_array();  // returns associative array
    }



    public function get_all_levels()
    {
        $this->db->select('id, level_name, level_id');
        $query = $this->db->get('levels');
        return $query->result_array();
    }

    public function get_all_emp_state()
    {
        $this->db->select('state, ');
        $query = $this->db->get('employee');
        return $query->result_array();
    }



    public function get_all_designations()
    {
        $query = $this->db->get('designations');
        return $query->result_array();
    }

    public function get_Employee_by_level($level, $limit, $offset, $search = null, $sort_by = 'id', $sort_order = 'ASC')
    {
        $this->db->select('id, name, email, mobile, designation, level, pjp_code, employer_code, district, state, designation_name, city');
        $this->db->from('employee');
        $this->db->where('level', $level);

        // Apply search filter
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('name', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('mobile', $search);
            $this->db->or_like('employer_code', $search);
            $this->db->or_like('designation_name', $search);
            $this->db->or_like('state', $search);
            $this->db->or_like('city', $search);
            $this->db->group_end();
        }


        $this->db->order_by($sort_by, $sort_order);


        $this->db->limit($limit, $offset);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_total_employees_by_level($level, $search = null)
    {
        $this->db->from('employee');
        $this->db->where('level', $level);

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('name', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('mobile', $search);
            $this->db->or_like('employer_code', $search);
            $this->db->or_like('designation_name', $search);
            $this->db->or_like('state', $search);
            $this->db->or_like('city', $search);
            $this->db->group_end();
        }

        return $this->db->count_all_results();
    }


    public function get_employees_by_Emp_id($Emp_id)
    {

        $this->db->select('id, name, email, pjp_code, employee_id, designation_name, designation_label_name, employee_status, state, level,City');
        $this->db->from('employee');
        $this->db->where('id', $Emp_id);
        $query = $this->db->get();

        $employee = $query->row_array();


        return  $employee;
    }

    public function get_employees_by_city_and_level($city)
    {
        $this->db->select('d.Zone, d.Zone_Code');
        $this->db->from('distributors d');
        $this->db->where('d.City', $city);
        $this->db->group_by('d.Zone, d.Zone_Code');


        $zone_query = $this->db->get();


        $result = $zone_query->result_array();

        return $result;
    }





    public function get_employees_by_city_and_level_zone_all_distubuter($state, $city, $zone)
    {

        $this->db->select('m.*, d.*');
        $this->db->from('maping m');
        $this->db->join(
            'distributors d',
            'm.DB_Code = d.Customer_Code 
             AND m.Sales_Code = d.Sales_Code 
             AND m.Distribution_Channel_Code = d.Distribution_Channel_Code 
             AND m.Division_Code = d.Division_Code 
             AND m.Customer_Type_Code = d.Customer_Type_Code 
             AND m.Customer_Group_Code = d.Customer_Group_Code',
            'inner'
        );


        if ($state) {
            $this->db->where('d.State', $state);
        }
        if ($city) {
            $this->db->where('d.City', $city);
        }
        if ($zone) {
            $this->db->where('d.Zone_Code', $zone);
        }


        $employee_query = $this->db->get();


        return $employee_query->result_array();
    }













    public function get_employees_by_Emp_level($level, $pjpCode, $search, $limit, $offset)
    {
        $this->db->select('id, name, vacant_status, email, pjp_code, employer_code, employee_id, designation_name, designation_label_name, employee_status, state, level, City');
        $this->db->from('employee');
        $this->db->where('level', $level);

        if (!empty($pjpCode)) {
            $this->db->where('pjp_code !=', $pjpCode);
        }

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('id', $search);
            $this->db->or_like('name', $search);
            $this->db->or_like('vacant_status', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('pjp_code', $search);
            $this->db->or_like('employer_code', $search);
            $this->db->or_like('employee_id', $search);
            $this->db->or_like('designation_name', $search);
            $this->db->or_like('designation_label_name', $search);
            $this->db->or_like('employee_status', $search);
            $this->db->or_like('state', $search);
            $this->db->or_like('level', $search);
            $this->db->or_like('City', $search);
            $this->db->group_end();
        }

        $this->db->limit($limit, $offset);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_employees_by_Emp_level_emp_Promoted($level, $pjpCode, $search, $limit, $offset)
    {
        $this->db->select('id, name, vacant_status, email, pjp_code, employer_code, employee_id, designation_name, designation_label_name, employee_status, state, level, City');
        $this->db->from('employee');
        $this->db->where_in('level', [$level, $level + 1]);

        if (!empty($pjpCode)) {
            $this->db->where('pjp_code !=', $pjpCode);
        }

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('id', $search);
            $this->db->or_like('name', $search);
            $this->db->or_like('vacant_status', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('pjp_code', $search);
            $this->db->or_like('employer_code', $search);
            $this->db->or_like('employee_id', $search);
            $this->db->or_like('designation_name', $search);
            $this->db->or_like('designation_label_name', $search);
            $this->db->or_like('employee_status', $search);
            $this->db->or_like('state', $search);
            $this->db->or_like('level', $search);
            $this->db->or_like('City', $search);
            $this->db->group_end();
        }

        $this->db->limit($limit, $offset);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_employees_count($level, $pjpCode, $search)
    {
        $this->db->from('employee');
        $this->db->where('level', $level);

        if (!empty($pjpCode)) {
            $this->db->where('pjp_code !=', $pjpCode);
        }

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('id', $search);
            $this->db->or_like('name', $search);
            $this->db->or_like('vacant_status', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('pjp_code', $search);
            $this->db->or_like('employer_code', $search);
            $this->db->or_like('employee_id', $search);
            $this->db->or_like('designation_name', $search);
            $this->db->or_like('designation_label_name', $search);
            $this->db->or_like('employee_status', $search);
            $this->db->or_like('state', $search);
            $this->db->or_like('level', $search);
            $this->db->or_like('City', $search);
            $this->db->group_end();
        }

        return $this->db->count_all_results();
    }



    public function get_pjp_code_by_employee_id($employee_id)
    {
        $this->db->select('pjp_code');
        $this->db->from('employee');
        $this->db->where('id', $employee_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->pjp_code;
        } else {
            return null;
        }
    }




    public function get_employee_by_id($id)
    {
        $this->db->select('e.*, l.level_name, d1.Designation as designation_name, d2.Designation_Label as designation_label_name');
        $this->db->from('employee e');
        $this->db->join('levels l', 'e.level = l.id', 'left');
        $this->db->join('designations d1', 'e.designation = d1.id', 'left');
        $this->db->join('designations d2', 'e.designation_label = d2.id', 'left');
        $this->db->where('e.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_employee($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('employee', $data);
    }


    public function delete_employee($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('employee');
    }


    public function get_user_by_email_password($email, $password)
    {

        $this->db->where('email', $email);
        $query = $this->db->get('employee');

        if ($query->num_rows() == 1) {
            $user = $query->row();


            if (password_verify($password, $user->password)) {
                return $user;
            }
        }


        return false;
    }




    public function get_employees_by_pjp_codes($pjpCodes)
    {

        $this->db->where_in('pjp_code', $pjpCodes);
        $query = $this->db->get('employee');
        return $query->result_array();
    }



    public function get_employees_by_levels($levelCodes)
    {

        if (!empty($levelCodes) && is_array($levelCodes)) {

            $this->db->where_in('pjp_code', $levelCodes);
            $query = $this->db->get('employee');


            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return NULL;
            }
        }
        return NULL;
    }



    public function find_user_by_email_or_mobile($email_or_mobile)
    {
        $this->db->where('email', $email_or_mobile);

        $query = $this->db->get('employee');

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }



    public function save_otp($user_id, $otp)
    {

        date_default_timezone_set('Asia/Kolkata');


        $current_time = date('Y-m-d H:i:s');


        $data = array(
            'user_id' => $user_id,
            'otp' => $otp,
            'created_at' => $current_time
        );


        return $this->db->insert('employee_otp', $data);
    }




    public function verify_otp($user_id, $otp)
    {

        date_default_timezone_set('Asia/Kolkata');


        $expiry_time = date('Y-m-d H:i:s', strtotime('-1 minute'));


        $this->db->where('user_id', $user_id);
        $this->db->where('otp', $otp);
        $this->db->where('created_at >=', $expiry_time);
        $query = $this->db->get('employee_otp');

        if ($query->num_rows() == 1) {

            return true;
        } else {

            $this->db->where('user_id', $user_id);
            $this->db->where('otp', $otp);
            $this->db->delete('employee_otp');



            return false;
        }
    }


    public function cleanup_expired_otps()
    {

        date_default_timezone_set('Asia/Kolkata');


        $expiration_time = date('Y-m-d H:i:s', strtotime('-1 minute'));


        $this->db->where('created_at <', $expiration_time);
        $this->db->delete('employee_otp');


        $deleted_rows = $this->db->affected_rows();
    }











    public function get_otp_by_user_id($user_id)
    {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('employee_otp');
        return $query->row_array();
    }

    public function delete_otp($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->delete('employee_otp');
    }

    public function update_password($user_id, $hashed_password)
    {

        if (empty($user_id) || empty($hashed_password)) {
            return false;
        }


        $this->db->where('id', $user_id);
        $this->db->update('employee', ['password' => $hashed_password]);


        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }



    public function get_employees($start, $length, $search = '', $order_column = 'name', $order_dir = 'asc')
    {
        $this->db->from('employee');


        if ($search) {

            $this->db->group_start()
                ->like('name', $search)
                ->or_like('email', $search)
                ->or_like('mobile', $search)
                ->or_like('pjp_code', $search)
                ->or_like('employee_id', $search)
                ->or_like('level', $search)
                ->or_like('designation_name', $search)
                ->or_like('designation_label_name', $search)
                ->or_like('gender', $search)
                ->or_like('employee_status', $search)
                ->or_like('vacant_status', $search)
                ->or_like('dob', $search)
                ->or_like('employer_code', $search)
                ->or_like('employer_name', $search)
                ->or_like('adhar_card', $search)
                ->or_like('designation', $search)
                ->or_like('created_at', $search)
                ->or_like('updated_at', $search)
                ->or_like('active_date', $search)
                ->or_like('inactive_date', $search)
                ->or_like('town', $search)
                ->or_like('district_code', $search)
                ->or_like('district', $search)
                ->or_like('city', $search)
                ->or_like('state', $search)
                ->or_like('region', $search)
                ->or_like('address', $search)
                ->group_end();
        }


        $valid_columns = [
            'name',
            'employer_name',
            'email',
            'mobile',
            'employee_id',
            'level',
            'state',
            'city',
            'region',
            'designation',
            'designation_name',
            'gender',
            'employee_status',
        ];
        if (!in_array($order_column, $valid_columns)) {
            $order_column = 'name';
        }


        if (in_array($order_dir, ['asc', 'desc'], true)) {
            $this->db->order_by($order_column, $order_dir);
        } else {

            $this->db->order_by('name', 'asc');
        }

        return $this->db->limit($length, $start)->get();
    }



    public function getTotal_employees($search = '')
    {
        if ($search) {

            $this->db->like('name', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('mobile', $search);
            $this->db->or_like('pjp_code', $search);
            $this->db->or_like('employee_id', $search);
            $this->db->or_like('level', $search);
            $this->db->or_like('designation_name', $search);
            $this->db->or_like('designation_label_name', $search);
            $this->db->or_like('gender', $search);
            $this->db->or_like('employee_status', $search);
            $this->db->or_like('vacant_status', $search);
            $this->db->or_like('dob', $search);
            $this->db->or_like('employer_code', $search);
            $this->db->or_like('employer_name', $search);
            $this->db->or_like('adhar_card', $search);
            $this->db->or_like('designation', $search);
            $this->db->or_like('created_at', $search);
            $this->db->or_like('updated_at', $search);
            $this->db->or_like('active_date', $search);
            $this->db->or_like('inactive_date', $search);
            $this->db->or_like('town', $search);
            $this->db->or_like('district_code', $search);
            $this->db->or_like('district', $search);
            $this->db->or_like('city', $search);
            $this->db->or_like('state', $search);
            $this->db->or_like('region', $search);
            $this->db->or_like('address', $search);
        }

        $query = $this->db->select('COUNT(*) as total_get_employee')->get('employee');
        $result = $query->row();
        if ($result) {
            return $result->total_get_employee;
        }
        return 0;
    }


    public function Unmapped_Employee_csv()
    {

        $this->db->select('e.*')
            ->from('employee e')
            ->where('e.employee_status', 'active')
            ->join('maping m', 'e.pjp_code = m.Level_1 OR e.pjp_code = m.Level_2 OR e.pjp_code = m.Level_3 OR e.pjp_code = m.Level_4 OR e.pjp_code = m.Level_5 OR e.pjp_code = m.Level_6 OR e.pjp_code = m.Level_7', 'left')
            ->where('m.Level_1 IS NULL')
            ->where('m.Level_2 IS NULL')
            ->where('m.Level_3 IS NULL')
            ->where('m.Level_4 IS NULL')
            ->where('m.Level_5 IS NULL')
            ->where('m.Level_6 IS NULL')
            ->where('m.Level_7 IS NULL');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function employee_csv($search = '')
    {
        $this->db->select('id, name, email, mobile, employee_id, level,designation_name, designation_label_name, gender,   city, state, region')
            ->from('employee e');

        if ($search) {
            $this->db->group_start();
            $this->db->like('e.name', $search);
            $this->db->or_like('e.email', $search);
            $this->db->or_like('e.mobile', $search);
            $this->db->or_like('e.pjp_code', $search);
            $this->db->or_like('e.employee_id', $search);
            $this->db->or_like('e.level', $search);
            $this->db->or_like('e.designation_name', $search);
            $this->db->or_like('e.designation_label_name', $search);
            $this->db->or_like('e.gender', $search);
            $this->db->or_like('e.adhar_card', $search);
            $this->db->or_like('e.district_code', $search);
            $this->db->or_like('e.district', $search);
            $this->db->or_like('e.city', $search);
            $this->db->or_like('e.state', $search);
            $this->db->or_like('e.region', $search);
            $this->db->group_end();
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_employees_unmaped($start, $length, $search = '', $order_column = 'name', $order_dir = 'asc')
    {
        $this->db->select('e.*')
            ->from('employee e')
            ->where('e.employee_status', 'active')
            ->join('maping m', 'e.pjp_code = m.Level_1 OR e.pjp_code = m.Level_2 OR e.pjp_code = m.Level_3 OR e.pjp_code = m.Level_4 OR e.pjp_code = m.Level_5 OR e.pjp_code = m.Level_6 OR e.pjp_code = m.Level_7', 'left')
            ->where('m.Level_1 IS NULL')
            ->where('m.Level_2 IS NULL')
            ->where('m.Level_3 IS NULL')
            ->where('m.Level_4 IS NULL')
            ->where('m.Level_5 IS NULL')
            ->where('m.Level_6 IS NULL')
            ->where('m.Level_7 IS NULL');

        if ($search) {
            $this->db->group_start();
            $this->db->like('e.name', $search);
            $this->db->or_like('e.email', $search);
            $this->db->or_like('e.mobile', $search);
            $this->db->or_like('e.pjp_code', $search);
            $this->db->or_like('e.employee_id', $search);
            $this->db->or_like('e.level', $search);
            $this->db->or_like('e.designation_name', $search);
            $this->db->or_like('e.designation_label_name', $search);
            $this->db->or_like('e.gender', $search);
            $this->db->or_like('e.adhar_card', $search);
            $this->db->or_like('e.district_code', $search);
            $this->db->or_like('e.district', $search);
            $this->db->or_like('e.city', $search);
            $this->db->or_like('e.state', $search);
            $this->db->or_like('e.region', $search);
            $this->db->group_end();
        }



        $valid_columns = [
            'name',
            'employer_name',
            'email',
            'mobile',
            'employee_id',
            'level',
            'state',
            'city',
            'region',
            'designation',
            'designation_name',
            'gender',
            'employee_status',
        ];
        if (!in_array($order_column, $valid_columns)) {
            $order_column = 'name';
        }


        if (in_array($order_dir, ['asc', 'desc'], true)) {
            $this->db->order_by($order_column, $order_dir);
        } else {

            $this->db->order_by('name', 'asc');
        }


        return $this->db->limit($length, $start)->get();
    }


    public function getTotal_employees_unmaped($search = '')
    {
        $this->db->select('COUNT(*) as total_get_employee')
            ->from('employee e')

            ->where('e.employee_status', 'active')
            ->join('maping m', 'e.pjp_code = m.Level_1 OR e.pjp_code = m.Level_2 OR e.pjp_code = m.Level_3 OR e.pjp_code = m.Level_4 OR e.pjp_code = m.Level_5 OR e.pjp_code = m.Level_6 OR e.pjp_code = m.Level_7', 'left')
            ->where('m.Level_1 IS NULL')
            ->where('m.Level_2 IS NULL')
            ->where('m.Level_3 IS NULL')
            ->where('m.Level_4 IS NULL')
            ->where('m.Level_5 IS NULL')
            ->where('m.Level_6 IS NULL')
            ->where('m.Level_7 IS NULL');

        if ($search) {
            $this->db->like('e.name', $search);
            $this->db->or_like('e.email', $search);
            $this->db->or_like('e.mobile', $search);
            $this->db->or_like('e.pjp_code', $search);
            $this->db->or_like('e.employee_id', $search);
            $this->db->or_like('e.level', $search);
            $this->db->or_like('e.designation_name', $search);
            $this->db->or_like('e.designation_label_name', $search);
            $this->db->or_like('e.gender', $search);
            $this->db->or_like('e.adhar_card', $search);
            $this->db->or_like('e.district_code', $search);
            $this->db->or_like('e.district', $search);
            $this->db->or_like('e.city', $search);
            $this->db->or_like('e.state', $search);
            $this->db->or_like('e.region', $search);
        }

        $query = $this->db->get();
        $result = $query->row();
        if ($result) {
            return $result->total_get_employee;
        }
        return 0;
    }




    public function get_user_by_email($email)
    {
        return $this->db->where('email', $email)->get('employee')->row();
    }

    public function update_login_attempts($user_id, $failed_attempts, $lock_time, $status)
    {
        $data = [
            'failed_attempts' => $failed_attempts,
            'lock_until' => $lock_time,
            'employee_status' => $status // Update status if necessary
        ];

        $this->db->where('id', $user_id)->update('employee', $data);
    }

    public function reset_login_attempts($user_id)
    {
        $this->db->where('id', $user_id)->update('employee', [
            'failed_attempts' => 0,
            'lock_until' => null
        ]);
    }
}
