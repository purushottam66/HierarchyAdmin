<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RoleController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Role_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Zone_model');
        $this->load->model('Distributor_model');
    }


    public function role()
    {
        $back_user_id = $this->session->userdata('back_user_id');

        if (!$back_user_id) {

            redirect('admin/login');
        }


        $data['users'] = $this->Role_model->get_users();


        $user_id = $this->session->userdata('back_user_id');

        if ($user_id) {
            $data['user'] = $this->Role_model->get_user_by_id($user_id);
            if ($data['user']) {

                $role_id = $data['user']['role_id'];
                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
        }

        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('admin/footer', $data);
    }


    public function Rolelist()
    {
        $back_user_id = $this->session->userdata('back_user_id');

        if (!$back_user_id) {

            redirect('admin/login');
        }


        $data['users'] = $this->Role_model->get_users();
        $user_id = $this->session->userdata('back_user_id');

        if ($user_id) {
            $data['user'] = $this->Role_model->get_user_by_id($user_id);
            if ($data['user']) {

                $role_id = $data['user']['role_id'];
                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
        }

        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/Rolelist', $data);
        $this->load->view('admin/footer', $data);
    }






    public function Addrole($user_id = null)
    {
        $back_user_id = $this->session->userdata('back_user_id');

        if (!$back_user_id) {

            redirect('admin/login');
        }

        $data = [];
        $data['zone'] = $this->Distributor_model->get_unique_zone_code_with_name();
        $selected_zones_array = [];
        $data['modules'] = $this->Role_model->get_modules();
        if ($user_id) {
            $selected_zones = $this->Role_model->get_user_zones($user_id);
            $selected_zones_json = $selected_zones[0]['zone_id'] ?? '[]';
            $selected_zones_array = json_decode($selected_zones_json, true);
            $data['user'] = $this->Role_model->get_user_by_id($user_id);
            if ($data['user']) {
                $role_id = $data['user']['role_id'];
                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
        }

        $data['selected_zones_array'] = $selected_zones_array;
        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/addrole', $data);
        $this->load->view('admin/footer', $data);
    }








    public function Rolelistedit($user_id = null)
    {
        $back_user_id = $this->session->userdata('back_user_id');

        if (!$back_user_id) {

            redirect('admin/login');
        }

        $data = [];
        $data['zone'] = $this->Distributor_model->get_unique_zone_code_with_name();
        $selected_zones_array = [];
        $data['modules'] = $this->Role_model->get_modules();
        if ($user_id) {
            $selected_zones = $this->Role_model->get_user_zones($user_id);
            $selected_zones_json = $selected_zones[0]['zone_id'] ?? '[]';
            $selected_zones_array = json_decode($selected_zones_json, true);
            $data['user'] = $this->Role_model->get_user_by_id($user_id);
            if ($data['user']) {

                $role_id = $data['user']['role_id'];
                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
        }

        $data['selected_zones_array'] = $selected_zones_array;
        $data['roles'] = $this->Role_model->get_roles();
        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/Rolelistedit', $data);
        $this->load->view('admin/footer', $data);
    }






    public function edit($user_id = null)
    {

        $back_user_id = $this->session->userdata('back_user_id');

        if (!$back_user_id) {

            redirect('admin/login');
        }

        if ($user_id) {
            $data['user'] = $this->Role_model->get_user_by_id($user_id);
            if ($data['user']) {

                $role_id = $data['user']['role_id'];
                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
        }
        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';


        $this->load->view('admin/header', $data);
        $this->load->view('admin/view', $data);
        $this->load->view('admin/footer', $data);
    }






    public function save_role()
    {


        $back_user_id = $this->session->userdata('back_user_id');

        if (!$back_user_id) {

            redirect('admin/login');
        }

        $back_user_id = $this->session->userdata('back_user_id');

        if (!$back_user_id) {

            redirect('admin/login');
        }
        $permissions = $this->input->post('permissions');
        $modules = $this->input->post('modules');
        $zones = $this->input->post('zones');
        $user_id = $this->input->post('user_id');
        $zones = is_array($zones) ? $zones : [];


        if ($user_id) {

            $zone_ids_json = json_encode($zones);

            foreach ($permissions as $module_id => $permission) {
                $view_permission = isset($permission['view']) ? $permission['view'] : 'no';
                $edit_permission = isset($permission['edit']) ? $permission['edit'] : 'no';
                $module_name = isset($modules[$module_id]['name']) ? $modules[$module_id]['name'] : '';


                $this->Role_model->update_module_permissions($user_id, $module_id, $module_name, $view_permission, $edit_permission);
            }

            $this->Role_model->update_zone_permissions($user_id, $zone_ids_json);


            $this->session->set_flashdata('success', 'Role permissions updated successfully.');
            redirect('admin/role');
        } else {
            $this->session->set_flashdata('error', 'User ID is required.');
            redirect('admin/Addrole');
        }
    }




    public function Adduser()
    {

        $back_user_id = $this->session->userdata('back_user_id');

        if (!$back_user_id) {

            redirect('admin/login');
        }

        $user_id = $this->session->userdata('back_user_id');
        if ($user_id) {
            $data['user'] = $this->Role_model->get_user_by_id($user_id);
            if ($data['user']) {

                $role_id = $data['user']['role_id'];
                $data['permissions'] = $this->Role_model->get_permissions_by_role($user_id);
            } else {
                $data['permissions'] = [];
            }
        } else {
            $data['user'] = null;
            $data['permissions'] = [];
        }

        $data['roles'] = $this->Role_model->get_roles();

        $data['user_name'] = $this->session->userdata('user_name') ?? 'Guest';

        $this->load->view('admin/header', $data);
        $this->load->view('admin/adduser', $data);
        $this->load->view('admin/footer', $data);
    }



    public function create_user()
    {

        $back_user_id = $this->session->userdata('back_user_id');

        if (!$back_user_id) {

            redirect('admin/login');
        }

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == FALSE) {

            redirect('admin/role');
        } else {

            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
                'address' => $this->input->post('address'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT), // Hash the password
                'role_id' => $this->input->post('role')
            ];


            $user_id = $this->Role_model->create_user($data);

            if ($user_id) {

                redirect('admin/role');
            } else {

                show_error('User creation failed.');
            }
        }
    }


    public function update_role_user()
    {

        $back_user_id = $this->session->userdata('back_user_id');
        if (!$back_user_id) {
            log_message('error', 'Unauthorized access attempt to update_role_user.');
            redirect('admin/login');
        }


        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|max_length[10]');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == FALSE) {

            $validation_errors = validation_errors();


            $this->session->set_flashdata('error', $validation_errors);
            redirect('admin/role');
        } else {

            $user_id = $this->input->post('user_id');
            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
                'address' => $this->input->post('address'),
                'role_id' => $this->input->post('role'),
                'updated_at' => date('Y-m-d H:i:s')
            ];


            $is_updated = $this->Role_model->update_user_role($user_id, $data);

            if ($is_updated) {
                log_message('info', 'User ID ' . $user_id . ' updated successfully.');
                $this->session->set_flashdata('success', 'User updated successfully.');
                redirect('admin/role');
            } else {
                log_message('error', 'Failed to update user with ID ' . $user_id . '.');
                $this->session->set_flashdata('error', 'Failed to update user.');
                redirect('admin/role');
            }
        }
    }






    public function roledelete($id)
    {
        $back_user_id = $this->session->userdata('back_user_id');
        if (!$back_user_id) {
            redirect('admin/login');
        }

        $this->load->model('Role_model');


        $this->db->where('user_id', $id);
        $this->db->delete('zone_permissions');

        if ($this->Role_model->delete_role($id)) {
            $this->session->set_flashdata('message', 'Role successfully deleted.');
            $this->session->set_flashdata('message_type', 'success');
        } else {
            $this->session->set_flashdata('message', 'Failed to delete role. Please try again.');
            $this->session->set_flashdata('message_type', 'error');
        }
        redirect('admin/role');
    }
}
