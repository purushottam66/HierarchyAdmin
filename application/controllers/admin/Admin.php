<?php
defined('BASEPATH') or exit('No direct script access allowed');

public function distributors($page = 0)
{
$user_id = $this->session->userdata('back_user_id');

if (!$user_id) {
redirect('admin/login');
}

// Load pagination library
$this->load->library('pagination');

// Pagination configuration
$config['base_url'] = base_url('admin/distributors'); // Base URL for pagination links
$config['total_rows'] = $this->Distributor_model->count_all_distributors(); // Total number of records
$config['per_page'] = 10; // Number of records per page
$config['uri_segment'] = 3; // URI segment for page number

// Pagination styling (optional)
$config['full_tag_open'] = '<ul class="pagination justify-content-end">';
    $config['full_tag_close'] = '</ul>';
$config['first_tag_open'] = '<li class="page-item">';
    $config['first_tag_close'] = '</li>';
$config['last_tag_open'] = '<li class="page-item">';
    $config['last_tag_close'] = '</li>';
$config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';
$config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';
$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
$config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';
$config['attributes'] = array('class' => 'page-link');

// Initialize pagination
$this->pagination->initialize($config);

// Calculate the offset for the current page
$offset = ($page) ? $page : 0;

// Fetch paginated distributors
$data['distributors'] = $this->Distributor_model->get_distributors_paginated($config['per_page'], $offset);

// Pass pagination links to the view
$data['pagination'] = $this->pagination->create_links();

// Pass the total number of records
$data['total_records'] = $config['total_rows'];

// User and permissions data
$data['user'] = $this->Role_model->get_user_by_id($user_id);
$data['permissions'] = $data['user'] ? $this->Role_model->get_permissions_by_role($user_id) : [];

// Load views
$this->load->view('admin/header', $data);
$this->load->view('admin/distributors', $data);
$this->load->view('admin/footer', $data);
}