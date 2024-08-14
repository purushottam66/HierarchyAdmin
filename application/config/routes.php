<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'welcome/login';
$route['forgot_password'] = 'welcome/forgot_password';
$route['otp'] = 'welcome/otp';
$route['enterpass'] = 'welcome/enterpass';