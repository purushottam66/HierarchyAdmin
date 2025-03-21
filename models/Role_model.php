<?php

class Role_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function get_user_permissions($user_id)
    {
        $this->db->select('modules.module_name, permissions.permission_name, role_permissions.view, role_permissions.edit');
        $this->db->from('role_permissions');
        $this->db->join('roles', 'role_permissions.role_id = roles.id');
        $this->db->join('modules', 'role_permissions.module_id = modules.id');
        $this->db->join('permissions', 'role_permissions.permission_id = permissions.id');
        $this->db->where('roles.user_id', $user_id);

        $query = $this->db->get();
        return $query->result_array();
    }


    public function update_module_permissions($user_id, $module_id, $module_name, $view_permission, $edit_permission)
    {

        $data = array(
            'user_id' => $user_id,
            'module_id' => $module_id,
            'module_name' => $module_name,
            'view' => $view_permission,
            'edit' => $edit_permission
        );


        $this->db->from('role_permissions');
        $this->db->where('user_id', $user_id);
        $this->db->where('module_id', $module_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            $this->db->where('user_id', $user_id);
            $this->db->where('module_id', $module_id);
            $this->db->update('role_permissions', $data);
        } else {

            $this->db->insert('role_permissions', $data);
        }
    }


    public function update_zone_permissions($user_id, $zone_ids_json)
    {

        $zone_ids_json = !empty($zone_ids_json) ? $zone_ids_json : json_encode([NULL]);

        $data = array(
            'user_id' => $user_id,
            'zone_id' => $zone_ids_json
        );


        $this->db->from('zone_permissions');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            $this->db->where('user_id', $user_id);
            $this->db->update('zone_permissions', $data);
        } else {

            $this->db->insert('zone_permissions', $data);
        }
    }



    public function get_user_zones($user_id)
    {

        $this->db->select('zone_id');
        $this->db->from('zone_permissions');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();

        return $query->result_array();
    }






    public function get_role_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('roles');
        return $query->row_array();
    }

    public function get_permissions_by_role($user_id)
    {

        $this->db->select('rp.user_id, rp.view, rp.edit, m.module_name,m.id, r.role_name');
        $this->db->from('role_permissions rp');
        $this->db->join('modules m', 'rp.module_id = m.id', 'left');
        $this->db->join('users u', 'rp.user_id = u.id', 'left');
        $this->db->join('roles r', 'u.role_id = r.id', 'left');
        $this->db->where('rp.user_id', $user_id);
        $query = $this->db->get();

        return $query->result_array();
    }






    public function get_user_by_id($user_id)
    {

        $this->db->where('id', $user_id);
        $query = $this->db->get('users');
        return $query->row_array();
    }


    public function update_user($user_id, $data)
    {
        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);
    }




    public function delete_role($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }




    public function get_all_roles()
    {
        $query = $this->db->get('roles');
        return $query->result_array();
    }


    public function get_roles()
    {
        $query = $this->db->get('roles');
        return $query->result_array();
    }

    public function get_modules()
    {

        $this->db->select('*');
        $this->db->from('modules');
        $modules_query = $this->db->get();


        $this->db->select('*');
        $this->db->from('permissions');
        $permissions_query = $this->db->get();


        return [
            'modules' => $modules_query->result_array(),
            'permissions' => $permissions_query->result_array()
        ];
    }

    public function get_users()
    {

        $this->db->select('users.id, users.name, users.email, users.mobile, users.created_date, roles.role_name');
        $this->db->from('users');
        $this->db->join('roles', 'users.role_id = roles.id');
        $query = $this->db->get();


        return $query->result_array();
    }



    public function create_user($data)
    {

        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }






    public function insert_user($data)
    {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function update_user_role($user_id, $data)
    {
        $this->db->where('id', $user_id);
        return $this->db->update('users', $data);
    }



    public function is_email_exists($email, $user_id)
    {
        $this->db->where('email', $email);
        $this->db->where('id !=', $user_id);
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }



    public function has_permission($user_id, $module_name, $permission_type = 'view')
    {

        $this->db->select($permission_type);
        $this->db->from('permissions');
        $this->db->where('user_id', $user_id);
        $this->db->where('module_name', $module_name);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            return $result[$permission_type] === 'yes';
        }
        return false;
    }


    public function getInactiveMappings($zone_ids, $search = '', $orderColumnIndex = 0, $orderDirection = 'asc', $length = 10, $start = 0)
    {





        $columns = [
            'a.DB_Code',
            'a.Distribution_Channel_Code',
            'a.Division_Code',
            'a.Sales_Code',
            'a.Customer_Type_Code',
            'a.Customer_Group_Code',
        ];

        $this->db->select('*');
        $this->db->from('archived_maping a');

        $this->db->where_in('a.Zone_Code', $zone_ids);


        if (!empty($search)) {
            $this->db->group_start()
                ->like('a.DB_Code', $search)
                ->or_like('a.Distribution_Channel_Code', $search)
                ->or_like('a.Division_Code', $search)
                ->or_like('a.Sales_Code', $search)
                ->or_like('a.Customer_Type_Code', $search)
                ->or_like('a.Customer_Group_Code', $search)
                ->or_like('a.City', $search)
                ->or_like('a.District', $search)
                ->or_like('a.GTM_TYPE', $search)
                ->or_like('a.STATUS', $search)
                ->or_like('a.Customer_Type_Name', $search)
                ->or_like('a.Sector_Code', $search)

                ->group_end();
        }


        $this->db->order_by($columns[$orderColumnIndex], $orderDirection);
        $this->db->limit($length, $start);
        return $this->db->get()->result_array();
    }

    public function getTotalRecords( $zone_ids)
    {
        $this->db->from('archived_maping');

        $this->db->where_in('archived_maping.Zone_Code', $zone_ids);
        return $this->db->count_all_results();   


    }

    public function getFilteredRecords( $zone_ids ,$search = '')
    {
        $this->db->from('archived_maping');
        $this->db->where_in('archived_maping.Zone_Code', $zone_ids);
     
        if (!empty($search)) {
            $this->db->group_start()
                ->like('DB_Code', $search)
                ->or_like('Distribution_Channel_Code', $search)
                ->or_like('Division_Code', $search)
                ->or_like('Sales_Code', $search)
                ->or_like('Customer_Type_Code', $search)
                ->or_like('Customer_Group_Code', $search)
                ->or_like('Level_1', $search)
                ->or_like('Level_1_employee_code', $search)
                ->or_like('Level_3', $search)
                ->or_like('Level_4', $search)
                ->or_like('Level_5', $search)
                ->or_like('Level_6', $search)
                ->or_like('Level_7', $search)
                ->group_end();
        }

        return $this->db->count_all_results();
    }
}
