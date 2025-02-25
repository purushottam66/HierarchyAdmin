<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('get_user_permissions')) {
    function get_user_permissions()
    {
        $CI = &get_instance();
        $CI->load->library('session'); 
        $CI->load->model('Role_model');

        $user_id = $CI->session->userdata('back_user_id');

        if (!$user_id) {
            return []; // Return empty array if the user is not logged in
        }

        // Check if permissions are already stored in session
        if (!$CI->session->userdata('permissions')) {
            $user = $CI->Role_model->get_user_by_id($user_id);

            if ($user) {
                $permissions = $CI->Role_model->get_permissions_by_role($user['role_id']);
                $CI->session->set_userdata('permissions', $permissions);
            } else {
                $CI->session->set_userdata('permissions', []);
            }
        }

        return $CI->session->userdata('permissions') ?? [];
    }
}

if (!function_exists('has_permission')) {
    function has_permission($module, $action = 'view')
    {
        $permissions = get_user_permissions();

        if (!is_array($permissions)) {
            return false; // Ensure it's always an array
        }

        foreach ($permissions as $p) {
            if (isset($p['module_name'], $p[$action]) &&
                $p['module_name'] === $module &&
                $p[$action] === "yes") {
                return true;
            }
        }

        return false;
    }
}
