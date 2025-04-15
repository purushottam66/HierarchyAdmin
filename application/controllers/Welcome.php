<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Distributor_model');
        $this->load->helper('menu');
        $this->load->model('Employee_model');
        $this->load->model('Maping_model');
        $this->load->library('email');
    }

    // Add this new method for handling 404 errors
    public function page_not_found()
    {
        $this->output->set_status_header('404');
    
        if ($this->session->userdata('logged_in')) {
            // User is logged in, show frontend 404
            $data['user_name'] = $this->session->userdata('user_name');
            $this->load->view('errors/frontend_404', $data);
        } else {
            // Not logged in, redirect to login
            redirect('user/login');
        }
    }

    public function index()
    {

        if (!$this->session->userdata('logged_in')) {

            redirect('user/login');
        } else {

            $session_data = $this->session->all_userdata();
            $Pjp_Code_session = $this->session->userdata('pjp_code');
            $id__session = $this->session->userdata('level');
            $data['user_name'] = $this->session->userdata('user_name');
            $data['pjp_code'] = $Pjp_Code_session;
            $data['level'] = $id__session;
            $data['maping'] = $this->Maping_model->get_all_Maping_table($Pjp_Code_session);

            //$json_data = json_encode($data['maping'], JSON_PRETTY_PRINT);

            $this->load->view('index', $data);
        }
    }


    public function login()
    {
        $this->load->view('login');
    }

    public function forgot_password()
    {

        $this->load->view('forgot-password');
    }

    public function forgotpassword()
    {
        $email_or_mobile = $this->input->post('email_or_mobile');
        $user = $this->Employee_model->find_user_by_email_or_mobile($email_or_mobile);



        if ($user) {
            $otp = rand(1000, 9999); // Generate a 6-digit OTP
            $this->Employee_model->save_otp($user['id'], $otp);

            $this->session->set_userdata('frant_user_id', $user['id']);


            // Send OTP via email
            if (filter_var($email_or_mobile, FILTER_VALIDATE_EMAIL)) {
                // Email configuration
                $config = array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'smtp.gmail.com', // Replace with your SMTP server
                    'smtp_port' => 587, // Typically 587 for TLS, 465 for SSL
                    'smtp_user' => 'smcstore110096@gmail.com', // Your SMTP username
                    'smtp_pass' => 'oksoccfzromepkis', // Your SMTP password
                    'mailtype'  => 'html', // or 'text' for plain text emails
                    'charset'   => 'utf-8',
                    'newline'   => "\r\n",
                    'smtp_crypto' => 'tls', // or 'ssl'
                    'SMTPDebug' => 2, // Enable verbose debug output
                );

                $this->email->initialize($config);

                $this->email->from('smcstore110096@gmail.com', 'Hierarchy Sels');
                $this->email->to($user['email']);
                $this->email->subject('Your OTP for Password Reset');

                $message = "
                    <p>Dear {$user['name']},</p>
                    <p>Your OTP for password reset is: <strong>{$otp}</strong></p>
                    <p>Please use this OTP to reset your password. It is valid for 1 minutes.</p>
                    <p>Thank you,<br>Your Website Team</p>
                ";

                $this->email->message($message);

                if ($this->email->send()) {
                    $this->session->set_flashdata('success', 'OTP has been sent to your email.');

                    redirect('otp');
                } else {
                    $this->session->set_flashdata('error', 'Failed to send OTP. Please try again.');
                    //log_message('error', $this->email->print_debugger());
                }
            } else {
                // Implement SMS sending logic if the input is a mobile number
            }
        } else {
            $this->session->set_flashdata('error', 'User not found with the provided email ');
        }

        redirect('forgot_password');
    }


    public function otp()
    {
        date_default_timezone_set('Asia/Kolkata');

        // Retrieve user ID from the session
        $user_id = $this->session->userdata('frant_user_id');

        if (!$user_id) {
            // No user ID found in session, redirect to the forgot password page
            $this->session->set_flashdata('error', 'Session expired or OTP not requested. Please request a new OTP.');
            redirect('forgot_password'); // Redirect to the forgot password page
        }


        $otp_record = $this->Employee_model->get_otp_by_user_id($user_id);

        if ($otp_record) {
            // Check if OTP is still valid (not expired)
            $current_time = date('Y-m-d H:i:s');
            $expiration_time = date('Y-m-d H:i:s', strtotime($otp_record['created_at'] . ' +1 minute'));

            if ($current_time < $expiration_time) {
                // OTP is valid
                $data['otp'] = $otp_record['otp'];
                $data['expiration_time'] = $expiration_time;
            } else {
                // OTP has expired
                $data['otp'] = null;
                $data['expiration_time'] = $expiration_time;
                $this->Employee_model->delete_otp($user_id); // Optionally delete expired OTPs
                $this->session->set_flashdata('error', 'OTP has expired. Please request a new OTP.');
                redirect('forgot_password'); // Redirect to the forgot password page
            }
        } else {
            // No OTP found for the user
            $this->session->set_flashdata('error', 'No OTP found. Please request a new OTP.');
            redirect('forgot_password'); // Redirect to the forgot password page
        }

        // Load the OTP view with the data
        $this->load->view('otp', $data);
    }


    public function verify_otp()
    {
        // Collect OTP digits from the input fields
        $otp_digit1 = $this->input->post('otp_digit1');
        $otp_digit2 = $this->input->post('otp_digit2');
        $otp_digit3 = $this->input->post('otp_digit3');
        $otp_digit4 = $this->input->post('otp_digit4');

        // Combine OTP digits into a single string
        $otp = $otp_digit1 . $otp_digit2 . $otp_digit3 . $otp_digit4;

        // Debugging: Print the combined OTP


        // Retrieve user ID from session
        $user_id = $this->session->userdata('frant_user_id');

        print_r($user_id);


        // Verify the combined OTP
        $is_valid_otp = $this->Employee_model->verify_otp($user_id, $otp);

        if ($is_valid_otp) {
            // OTP is valid
            $this->session->set_flashdata('success', 'OTP verified successfully.');
            redirect('change-password'); // Redirect to a page where user can reset password
        } else {
            // OTP is invalid
            $this->session->set_flashdata('error', 'Invalid OTP. Please try again.');
            redirect('otp'); // Redirect back to the OTP page
        }
    }


    public function change_password()
    {

        $this->load->view('change-password');
    }

    public function update_password()
    {
        // Validate form input
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[4]');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed, reload the form with errors
            $this->session->set_flashdata('error', 'try again');

            $this->load->view('change-password');
        } else {
            // Get form inputs
            $new_password = $this->input->post('new_password');

            // Retrieve user ID from session
            $user_id = $this->session->userdata('frant_user_id');

            if (!$user_id) {
                $this->session->set_flashdata('error', 'Session expired. Please log in again.');
                redirect('user/login'); // Redirect to the login page
                return;
            }

            // Update password in the database
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            $update_success = $this->Employee_model->update_password($user_id, $hashed_password);

            if ($update_success) {
                $this->session->set_flashdata('success', 'Password updated successfully.');
                redirect('user/login'); // Redirect to login page or another page
            } else {
                $this->session->set_flashdata('error', 'Failed to update password. Please try again.');
                $this->load->view('change-password'); // Reload the form with error
            }
        }
    }


    public function loginuser()
    {
        date_default_timezone_set('Asia/Kolkata'); // Set the time zone
    
        // Retrieve form data
        $email    = $this->input->post('email');
        $password = $this->input->post('password');
        $recaptchaResponse = $this->input->post('g-recaptcha-response');
    
        if (empty($email) || empty($password)) {
            $this->session->set_flashdata('error', 'Email and Password are required.');
            redirect('user/login');
        }
    
        // Validate reCAPTCHA response
        $recaptchaResult = $this->verifyRecaptcha($recaptchaResponse);
        if (!$recaptchaResult['success']) {
            $this->session->set_flashdata('error', 'reCAPTCHA verification failed. Please try again.');
            redirect('user/login');
        }
    
        // Continue with user login (fetch user by email, verify password, etc.)
        $user = $this->Employee_model->get_user_by_email($email);
        if ($user) {
            if ($user->employee_status != 'active') {
                $this->session->set_flashdata('error', 'Your account is inactive. Please contact admin.');
                redirect('user/login');
            }
            if (password_verify($password, $user->password)) {
                // Reset failed attempts on successful login
                $this->Employee_model->reset_login_attempts($user->id);
                // Set session data
                $session_data = array(
                    'frant_user_id' => $user->id,
                    'user_name'     => $user->name,
                    'pjp_code'      => $user->pjp_code,
                    'email'         => $user->email,
                    'level'         => $user->level,
                    'logged_in'     => true
                );
                $this->session->set_userdata($session_data);
                redirect('/user');
            } else {
                // Handle failed login (you can add your failed attempt logic here)
                $this->handle_failed_login($user->id, $user->failed_attempts);
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid email or password.');
            redirect('user/login');
        }
    }
    
    /**
     * Verify reCAPTCHA token using Google's siteverify endpoint.
     */
    private function verifyRecaptcha($token)
    {
        $secretKey = '6LeBggIrAAAAADdgzrYnYjdRokkHTPPG-jwRatGw'; // Replace with your reCAPTCHA secret key
        $verifyUrl = 'https://www.google.com/recaptcha/api/siteverify';
    
        // Prepare POST data
        $postData = http_build_query([
            'secret'   => $secretKey,
            'response' => $token
        ]);
    
        // Use file_get_contents with a stream context to POST the data
        $contextOptions = [
            'http' => [
                'method'  => 'POST',
                'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
                'content' => $postData
            ]
        ];
        $context = stream_context_create($contextOptions);
        $response = file_get_contents($verifyUrl, false, $context);
        return json_decode($response, true);
    }
    
    

    private function handle_failed_login($user_id, $failed_attempts)
    {
        date_default_timezone_set('Asia/Kolkata'); // Set timezone
        $new_attempts = $failed_attempts + 1;
        $lock_time = null;
        $status = 'active'; // Default status remains active
    
        if ($new_attempts >= 3 && $new_attempts < 6) {
            $lock_time = date('Y-m-d H:i:s', strtotime('+1 hour')); // Lock for 1 hour
        } elseif ($new_attempts >= 6 && $new_attempts < 9) {
            $lock_time = date('Y-m-d H:i:s', strtotime('+4 hours')); // Lock for 4 hours
        } elseif ($new_attempts >= 9 && $new_attempts < 12) {
            $lock_time = date('Y-m-d H:i:s', strtotime('+24 hours')); // Lock for 24 hours
        } elseif ($new_attempts >= 12) {
            $status = 'inactive'; // Permanently lock the account
        }
    
        // Update failed attempts, lock time, and status
        $this->Employee_model->update_login_attempts($user_id, $new_attempts, $lock_time, $status);
    
        $this->session->set_flashdata('error', 'Invalid email or password.');
        redirect('user/login');
    }
    





    public function enterpass()
    {


        $this->load->view('enterpass');
    }



    public function Usermaster_data()
    {
        $level = $this->input->get('level');
        $dbCode = $this->input->get('db_code');
        $id = $this->input->get('id');

        // Load the database library
        $this->load->database();

        // Validate inputs
        if (!$level || !$dbCode) {
            echo json_encode(['error' => 'Level or db_code not provided']);
            return;
        }

        // Fetch distributor data based on dbCode
        $distributor_data = $this->Distributor_model->get_data_by_level($dbCode);

        // Fetch usermaster and sales hierarchy data
        $get_sales_hierarchy = $this->Distributor_model->get_sales_hierarchy($dbCode, $id);

        // Combine all data into a single array
        $data = [
            'distributor' => $distributor_data,
            'usermaster' => $usermaster_data,
            'get_sales_hierarchy' => $get_sales_hierarchy
        ];

        // Return the combined data as JSON
        echo json_encode($data);
    }




    public function ajax_endpoint()
    {
        // Log to ensure the function is being called
        $Pjp_Code = $this->session->userdata('pjp_code');
        $id__ = $this->session->userdata('level');

        // Get the POST data (in JSON format)
        $postData = json_decode(file_get_contents('php://input'), true);

        // Check if the required POST data is present
        if (isset($postData['level']) && isset($postData['id'])) {
            // Assign the posted level and id, fallback to session data if necessary
            $level = $postData['level'] ?? $Pjp_Code;
            $id = $postData['id'] ?? $id__;

            // Fetch the result from the model using the ID and level
            $result = $this->Maping_model->get_all_Maping_table_ajex($id, $level);

            // Return the result as JSON
            echo json_encode($result);
        } else {
            // Log an error message if the required data is not present
            echo json_encode(['error' => 'Invalid ID or Level']);
        }
    }

    public function treeajexsave()
    {
        // Get the Pjp_Code from the session
        $Pjp_Code = $this->session->userdata('pjp_code');

        try {

            $postData = json_decode(file_get_contents('php://input'), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Invalid JSON format');
            }

            if (!empty($postData)) {
                $dbCodes = array_column($postData, 'DB_Code');
                $this->db->select("
                    mp.DB_Code,
                    ds.Customer_Name,
                    ds.Customer_Code,
                    ds.Pin_Code,
                    ds.City,
                    ds.District,
                    ds.Contact_Number,
                    ds.Country,
                    ds.Zone,
                    ds.State,
                    ds.Population_Strata_1,
                    ds.Population_Strata_2,
                    ds.Country_Group,
                    ds.GTM_TYPE,
                    ds.SUPERSTOCKIST,
                    ds.STATUS,
                    ds.Customer_Type_Code,
                    ds.Sales_Code,
                    ds.Customer_Type_Name,
                    ds.Customer_Group_Code,
                    ds.Customer_Creation_Date,
                    ds.Division_Code,
                    ds.Sector_Code,
                    ds.State_Code,
                    ds.Zone_Code,
                    ds.Distribution_Channel_Code,
                    ds.Distribution_Channel_Name,
                    ds.Customer_Group_Name,
                    ds.Sales_Name,
                    ds.Division_Name,
                    ds.Sector_Name,
                    emp1.name as emp1_name,
                    emp1.designation_label_name as emp1_employee_id,

                    emp2.name as emp2_name,
                    emp2.designation_label_name as emp2_employee_id,

                    emp3.name as emp3_name,
                    emp3.designation_label_name as emp3_employee_id,

                    emp4.name as emp4_name,
                    emp4.designation_label_name as emp4_employee_id,

                    emp5.name as emp5_name,
                    emp5.designation_label_name as emp5_employee_id,

                    emp6.name as emp6_name,
                    emp6.designation_label_name as emp6_employee_id,

                    emp7.name as emp7_name, 
                    emp7.designation_label_name as emp7_employee_id,
                    
                    
                ");
                $this->db->from('maping mp');
                $this->db->join('distributors ds', 'ds.Customer_Code = mp.DB_Code
                 AND ds.Sales_Code = mp.Sales_Code
                 AND ds.Distribution_Channel_Code = mp.Distribution_Channel_Code
                 AND ds.Division_Code = mp.Division_Code
                 AND ds.Customer_Type_Code = mp.Customer_Type_Code
                 AND ds.Customer_Group_Code = mp.Customer_Group_Code
                 ');

                $this->db->join('employee emp1', 'emp1.pjp_code = mp.Level_1', 'left');
                $this->db->join('employee emp2', 'emp2.pjp_code = mp.Level_2', 'left');
                $this->db->join('employee emp3', 'emp3.pjp_code = mp.Level_3', 'left');
                $this->db->join('employee emp4', 'emp4.pjp_code = mp.Level_4', 'left');
                $this->db->join('employee emp5', 'emp5.pjp_code = mp.Level_5', 'left');
                $this->db->join('employee emp6', 'emp6.pjp_code = mp.Level_6', 'left');
                $this->db->join('employee emp7', 'emp7.pjp_code = mp.Level_7', 'left');

                // Check if Pjp_Code exists in any of the levels
                $this->db->where_in('mp.DB_Code', $dbCodes);

                $this->db->group_start()
                    ->or_where('mp.Level_1', $Pjp_Code)
                    ->or_where('mp.Level_2', $Pjp_Code)
                    ->or_where('mp.Level_3', $Pjp_Code)
                    ->or_where('mp.Level_4', $Pjp_Code)
                    ->or_where('mp.Level_5', $Pjp_Code)
                    ->or_where('mp.Level_6', $Pjp_Code)
                    ->or_where('mp.Level_7', $Pjp_Code)
                    ->group_end();
                $this->db->group_by('mp.DB_Code, ds.Customer_Name, ds.Customer_Code, ds.Pin_Code, ds.City, ds.District, ds.Contact_Number, ds.Country, ds.Zone, ds.State, ds.Population_Strata_1, ds.Population_Strata_2, ds.Country_Group, ds.GTM_TYPE, ds.SUPERSTOCKIST, ds.STATUS, ds.Customer_Type_Code, ds.Sales_Code, ds.Customer_Type_Name, ds.Customer_Group_Code, ds.Customer_Creation_Date, ds.Division_Code, ds.Sector_Code, ds.State_Code, ds.Zone_Code, ds.Distribution_Channel_Code, ds.Distribution_Channel_Name, ds.Customer_Group_Name, ds.Sales_Name, ds.Division_Name, ds.Sector_Name');

                $query = $this->db->get();
                $data = $query->result_array();

                // Return the data with a success message
                echo json_encode([
                    'status' => 'success',
                    'data' => $data
                ]);
            } else {
                echo json_encode([
                    'status' => 'success',
                    'data' => NULL
                ]);
            }
        } catch (Exception $e) {
            // Return error message in JSON format
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
            // Log the exception message
            //log_message('error', $e->getMessage());
        }
    }










    public function distributorsAll()
    {
        // $data['hierarchy_json'] = $this->generate_json($data['sales_hierarchy']);
        $data['users'] = $this->Distributor_model->get_all_Distributors();




        // Loading the view with the data
        $this->load->view('index', $data);
    }

    public function logout()
    {
        // Destroy the session
        $this->session->sess_destroy();

        // Redirect to the login page
        redirect('user');
    }
}
