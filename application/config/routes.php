<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller'] = 'admin/login';


// Add this line to specify the 404 override controller
$route['404_override'] = 'welcome/page_not_found';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'admin/Login/index';

$route['user/login'] = 'welcome/login';
$route['user'] = 'welcome/index';



// $route['(.+)'] = 'errors/custom_404';
$route['forgot_password'] = 'welcome/forgot_password';
$route['otp'] = 'welcome/otp';
$route['change-password'] = 'welcome/change_password';
$route['ajax_endpoint'] = 'maping/ajax_endpoint';

$route['forgotpassword'] = 'welcome/forgotpassword';
$route['verifyotp'] = 'welcome/verify_otp';
$route['update-password'] = 'welcome/update_password';





 $route['admin/login'] = 'admin/Login/index'; 
 $route['admin'] = 'admin/Login'; 


$route['admin/forgot-password'] = 'admin/Login/forgot_password';
$route['admin/forgotpassword'] = 'admin/Login/forgotpassword';

$route['admin/verifyotp'] = 'admin/Login/verify_otp';
$route['admin/resetpassword'] = 'admin/Login/reset_password';
$route['admin/update-password'] = 'admin/Login/update_password';



$route['admin/otp'] = 'admin/Login/otp';
$route['admin/change-password'] = 'admin/Login/change_password';



 $route['admin'] = 'admin/dashboard';
$route['admin/masters'] = 'admin/dashboard/masters';
$route['admin/zone'] = 'admin/dashboard/zone';
$route['admin/ZoneHierarchy'] = 'admin/dashboard/ZoneHierarchy';

$route['admin/InactiveDistributors'] = 'admin/dashboard/InactiveDistributors';
$route['admin/distributors'] = 'admin/dashboard/distributors';

$route['admin/distributors_db'] = 'admin/dashboard/distributors_db';
$route['admin/distributors_db_unmppd'] = 'admin/dashboard/distributors_db_unmppd';

$route['admin/export_distributors_csv'] = 'admin/Export_distributors_csv/export_distributors_csv';
$route['admin/export_unmaped_distributors_csv'] = 'admin/Export_distributors_csv/export_unmaped_distributors_csv';
$route['admin/distributors_csv'] = 'admin/Export_distributors_csv/distributors_csv';
$route['admin/unmapped_distributors_csv'] = 'admin/Export_distributors_csv/unmapped_distributors_csv';





$route['admin/salesorg'] = 'admin/dashboard/salesorg';
$route['admin/distributionchannel'] = 'admin/dashboard/distributionchannel';
$route['admin/division'] = 'admin/dashboard/division';
$route['admin/division_Ajex_Load_Data'] = 'admin/dashboard/division_Ajex_Load_Data';
$route['admin/maping'] = 'admin/Maping/maping';
$route['admin/mapingajex'] = 'admin/Maping/mapingajex';


$route['admin/mapinglist'] = 'admin/Maping/mapinglist';


$route['admin/submit_maping'] = 'admin/Maping/submit_maping';
$route['admin/gcpdata'] = 'admin/dashboard/gcpdata';
$route['admin/logreport'] = 'admin/dashboard/logreport';
$route['admin/hierarchydata'] = 'admin/dashboard/hierarchydata';
$route['admin/UserMovement'] = 'admin/dashboard/hierarchydata__';

$route['admin/ZoneHierarchy_ajex_tree'] = 'admin/dashboard/ZoneHierarchy_ajex_tree';



$route['admin/designation-save'] = 'admin/dashboard/designation_save';
$route['admin/designation-create'] = 'admin/dashboard/designation_create';
$route['admin/designation-edit/(:num)'] = 'admin/dashboard/designation_edit/$1';
$route['admin/designation-update'] = 'admin/dashboard/designation_update';


$route['admin/designation-list'] = 'admin/dashboard/designation_list';
$route['admin/designations_ajex'] = 'admin/dashboard/designations_ajex';


$route['admin/designationdelete/(:num)'] = 'admin/dashboard/designationdelete/$1';



$route['admin/geography'] = 'admin/dashboard/geography';
$route['admin/geographyajex'] = 'admin/dashboard/geographyajex';
$route['admin/replacedataajex'] = 'admin/dashboard/replacedataajex';


$route['admin/zonewisegetdata_ajex'] = 'admin/dashboard/zonewisegetdata_ajex';
$route['admin/treezoneajex'] = 'admin/dashboard/treezoneajex';
$route['admin/ajax_endpoint'] = 'admin/dashboard/ajax_endpoint';






$route['admin/hierarchydata_AJEX_LOAD'] = 'admin/dashboard/hierarchydata_AJEX_LOAD';
$route['admin/hierarchyedit'] = 'admin/dashboard/hierarchyedit';
$route['admin/hierarchydelete/(:num)'] = 'admin/dashboard/hierarchydelete/$1';
$route['admin/update_maping'] = 'admin/dashboard/update_maping';

$route['admin/ajex_method_filter'] = 'admin/dashboard/ajex_method_filter';
$route['admin/hierarchydata_ajex'] = 'admin/dashboard/hierarchydata_ajex';
$route['admin/usermovement_ajex'] = 'admin/dashboard/usermovement_ajex';





$route['admin/report'] = 'admin/dashboard/report';
$route['admin/cron'] = 'admin/dashboard/cron';
$route['admin/role'] = 'admin/RoleController/role';
$route['admin/Rolelist'] = 'admin/RoleController/Rolelist';
$route['admin/update_role_user'] = 'admin/RoleController/update_role_user';

$route['admin/Rolelistedit/(:num)'] = 'admin/RoleController/Rolelistedit/$1'; // For passing an ID



$route['admin/roledelete/(:num)'] = 'admin/RoleController/roledelete/$1';

$route['admin/Addrole/(:num)'] = 'admin/RoleController/Addrole/$1'; // For passing an ID
$route['admin/Adduser'] = 'admin/RoleController/Adduser';
$route['admin/create'] = 'admin/RoleController/create_user';

$route['admin/save_role'] = 'admin/RoleController/save_role';

$route['admin/edit/(:num)'] = 'admin/RoleController/edit/$1';

$route['admin/get_cities_by_state'] = 'admin/Employee/get_cities_by_state';

$route['admin/Employee'] = 'admin/Employee/Employee';
$route['admin/empreplace'] = 'admin/Employee/empreplace';
$route['admin/empreplace_level'] = 'admin/Employee/empreplace_level';
$route['admin/empreplace_level_Promoted'] = 'admin/Employee/empreplace_level_Promoted';

$route['admin/get_employees_by_city'] = 'admin/Employee/get_employees_by_city';
$route['admin/get_employees_by_city_t'] = 'admin/Employee/get_employees_by_city_t';

$route['admin/get_employees_by_city_and_level_zone_all_distubuter'] = 'admin/Employee/get_employees_by_city_and_level_zone_all_distubuter';




$route['admin/emp_Left'] = 'admin/Employee/emp_Left';
$route['admin/emp_Promoted'] = 'admin/Employee/emp_Promoted';
$route['admin/emp_Transfer'] = 'admin/Employee/emp_Transfer';
$route['admin/Save_Replace'] = 'admin/Employee/Save_Replace';

$route['admin/pjp_code_emp_Left'] = 'admin/Employee/pjp_code_emp_Left';

$route['admin/Save_Replace_emp_Promoted'] = 'admin/Employee/Save_Replace_emp_Promoted';
$route['admin/Save_Replace_emp_Transfer'] = 'admin/Employee/Save_Replace_emp_Transfer';





$route['admin/Unmapped_Employee_ajex_load'] = 'admin/Employee/Unmapped_Employee_ajex_load';
$route['admin/Unmapped_Employee'] = 'admin/Employee/Unmapped_Employee';

$route['admin/Unmapped_Employee_csv'] = 'admin/Export_employee/Unmapped_Employee_csv';

$route['admin/employee_csv'] = 'admin/Export_employee/employee_csv';

$route['admin/employeedata'] = 'admin/Employee/employeedata';


$route['admin/submit_employee'] = 'admin/Employee/submit_employee';

$route['admin/Employeeedit/(:num)'] = 'admin/Employee/edit_employee/$1';
$route['admin/Employeeview/(:num)'] = 'admin/Employee/view_employee/$1';
$route['admin/Employeedelete/(:num)'] = 'admin/Employee/delete_employee/$1';
$route['admin/submit_employee_edit/(:num)'] = 'admin/Employee/submit_employee_edit/$1';
$route['admin/updateEmployeeStatus'] = 'admin/Employee/updateEmployeeStatus';

$route['admin/checkAndDeleteDistributor'] = 'admin/Employee/checkAndDeleteDistributor';

$route['admin/dummmymaping'] = 'admin/Employee/dummmymaping';







$route['admin/userdetails'] = 'admin/Employee/userdetails';
$route['admin/Employee_ajex_load'] = 'admin/Employee/Employee_ajex_load';
$route['admin/mapinginactive'] = 'admin/dashboard/mapinginactive';

// Distributor Hierarchy Filter Routes
$route['admin/distributor-hierarchy-filter'] = 'admin/Distributor_filter/index';
$route['admin/filter-hierarchy-distributors'] = 'admin/Distributor_filter/filter_hierarchy_distributors';
$route['admin/get-hierarchy-filter-options'] = 'admin/Distributor_filter/get_hierarchy_filter_options';
$route['admin/export-hierarchy-distributors'] = 'admin/Distributor_filter/export_distributors';

// Dynamic Hierarchy Filter Routes
$route['admin/get-distribution-channels'] = 'admin/Distributor_filter/get_distribution_channels';
$route['admin/get-division-codes'] = 'admin/Distributor_filter/get_division_codes';

// Dynamic Hierarchy Filter Routes for Deeper Levels
$route['admin/get-customer-types'] = 'admin/Distributor_filter/get_customer_types';
$route['admin/get-customer-groups'] = 'admin/Distributor_filter/get_customer_groups';

// Population Strata Filter Route
$route['admin/get-population-strata-details'] = 'admin/Distributor_filter/get_population_strata_details';

// Authentication routes
$route['admin/login'] = 'admin/auth/login'; // Route for the login page
$route['admin/logout'] = 'admin/auth/logout'; // Route for logging out

$route['admin/dashboard'] = 'admin/dashboard'; 
$route['admin/fetchInactiveMappings'] = 'admin/dashboard/fetchInactiveMappings';

// Add this new route for handling undefined admin routes



$route['admin/userlogreport'] = 'admin/User_log_report/list'; 
$route['admin/User_log_report/get_logs_ajax'] = 'admin/User_log_report/get_logs_ajax'; 

$route['admin/mapping_log_report'] = 'admin/Mapping_log_report/list'; 
$route['admin/Mapping_log_report/get_logs_ajax'] = 'admin/Mapping_log_report/get_logs_ajax'; 

$route['admin/UserMovement_log_report'] = 'admin/UserMovement_log_report/list'; 
$route['admin/UserMovement_log_report_ajex'] = 'admin/UserMovement_log_report/UserMovement_log_report_ajex'; 



$route['admin/(.+)'] = 'admin/errors/admin_404';

