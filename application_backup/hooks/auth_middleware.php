<?php
defined('BASEPATH') or exit('No direct script access allowed');

function auth_middleware()
{
    $CI = &get_instance();

    // Get the current route
    $current_controller = $CI->router->fetch_class();
    $current_method = $CI->router->fetch_method();

    // Routes that don't require authentication
    $public_routes = [
        'login/index',
        'login/forgot_password',
        'register/index'
    ];

    $current_route = $current_controller . '/' . $current_method;

    // Check if the user is logged in or if the route is public
    if (!in_array($current_route, $public_routes) && !$CI->session->userdata('user_id')) {
        // If not authenticated, redirect to the login page
        redirect('login/index');
    }
}
