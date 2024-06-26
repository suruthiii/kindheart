<?php
class Users extends Controller{
    public function __construct(){
        $this->userModel = $this->model('UserModel');
    }

    public function home(){
        $this->view('pages/index');
    }

    public function registerLanding(){
        $this->view('users/registerLanding');
    }

    //---------------------------------------------

    public function studentAcountCreationPage1(){
        if(isset($_SESSION['account_status'])){
            redirect('pages/404');
        }

        $data = [
            'email' => '',
            'email_err' => '',
            'otp_err' => ''
        ];
        
        if(isset($_SESSION['user_email'])){
            $data['email'] = $_SESSION['user_email'];
        }

        if(isset($_GET['email'])){
            $data = [
                'email' => trim($_GET['email']),
                'email_err' => '',
                'otp_err' => ''
            ];

            if(empty($data['email'])){
                $data['email_err'] = 'Please enter email';
            }else{
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err'] = 'Email is already taken';
                }
            }
            

            if(empty($data['email_err'])){
                $_SESSION['user_email'] = $data['email'];

                // $this->userModel->sendOTP($data['email']);

                redirect('users/studentAcountCreationPage1');
            }
            else{
                $this->view('users/studentRegistration/studentAcountCreationPage1', $data);
            }
        }

        $this->view('users/studentRegistration/studentAcountCreationPage1', $data);
    }   

    public function OTPstudentAcountCreationPage1(){
        $data = [
            'digit' => trim($_GET['digit']),
            'otp_err' => ''
        ];

        if(empty($data['digit'])){
            $data['otp_err'] = 'Please enter the verification code';
        }

        $otp = $data['digit'];

        //if($this->userModel->verifyOTP($otp)){
        if($otp == '1234567'){
            redirect('Users/studentAcountCreationPage2');
        }
        else{
            $data['otp_err'] = 'Invalid OTP';
            $this->view('users/studentRegistration/studentAcountCreationPage1', $data);
        }
    }

    public function studentAcountCreationPage2(){
        if(isset($_SESSION['account_status'])){
            redirect('pages/404');
        }

        $data = [
            'username' => '',
            'password' => '',
            'username_err' => '',
            'password_err' => '',
            'confirmPassword_err' => '',

        ];    
        
        if(isset($_SESSION['username'])){
            $data['username'] = $_SESSION['username'];
        }

        if(isset($_SESSION['password'])){
            $data['password'] = $_SESSION['password'];
        }

        if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirmPassword'])){   
            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'username_err' => '',
                'password_err' => '',
                'confirmPassword_err' => ''
            ];

            if(empty($data['username'])){
                $data['username_err'] = 'Please enter username';
            }

            else{
                if($this->userModel->findUserByUsername($data['username'])){
                    $data['username_err'] = 'Username is already taken';
                }
            }

            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter a password';
            } else if (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            } else if (!preg_match('/[a-z]/', $data['password']) || !preg_match('/[A-Z]/', $data['password'])) {
                $data['password_err'] = 'Password must include both lowercase and uppercase letters';
            } else if (!preg_match('/\d/', $data['password'])) {
                $data['password_err'] = 'Password must include at least one digit';
            } else if (!preg_match('/[!@#?]/', $data['password'])) {
                $data['password_err'] = 'Password must include at least one special character (@, #, ?, !)';
            } else if (strpos($data['password'], '<') !== false || strpos($data['password'], '>') !== false) {
                $data['password_err'] = 'Password must not include < or >';
            }

            else if($data['password'] != $data['confirmPassword']){
                $data['confirmPassword_err'] = 'Passwords do not match';
            }            

            if(empty($data['username_err']) && empty($data['password_err']) && empty($data['confirmPassword_err'])){
                $_SESSION['username'] = $data['username'];
                $_SESSION['password'] = $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                $_SESSION['user_type'] = "student";

                $_SESSION['account_status'] = 0;
                
                $this->userModel->accountCreation();

                redirect('users/studentAcountCreationPage3');
            }
            else{
                $this->view('users/studentRegistration/studentAcountCreationPage2', $data);
            }
        }


        $this->view('users/studentRegistration/studentAcountCreationPage2', $data);
    }

    public function studentAcountCreationPage3(){
        session_destroy();
        $this->view('users/studentRegistration/studentAcountCreationPage3');
    }

    public function login(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            // Form is submitting

            // Input data
            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'remember_me' => isset($_POST['remember_me']),
                'username_err' => '',
                'password_err' => ''
            ];

            // Validate data
            // Validate email
            if (empty($data['username'])){
                $data['username_err'] = 'Please enter username';
            }
            else{
                if ($this->userModel->findUserByUsername($data['username'])) {
                    if($this->userModel->checkStatus($data['username']) == 5){
                        $details = $this->userModel->bannedDetails($data['username']);

                        $duration = $details['totalDays'];
                        $banCount = $details['banCount'];

                        if (($banCount == 1 && $duration >= 1) || ($banCount == 2 && $duration >= 3)) {
                            $this->userModel->unbanUser($data['username']);
                        }

                        else {
                            $data['username_err'] = 'You have been banned'; 
                        }
                    }

                    else if($this->userModel->checkStatus($data['username']) == 10) {
                        $data['username_err'] = 'User Not Found'; 
                    }

                }
                else{
                    // User not found
                    $data['username_err'] = 'User Not Found'; 
                }
            }

            // Validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter a password';
            }
            //  else if (strlen($data['password']) < 6) {
            //     $data['password_err'] = 'Password must be at least 6 characters';
            // } else if (!preg_match('/[a-z]/', $data['password']) || !preg_match('/[A-Z]/', $data['password'])) {
            //     $data['password_err'] = 'Password must include both lowercase and uppercase letters';
            // } else if (!preg_match('/\d/', $data['password'])) {
            //     $data['password_err'] = 'Password must include at least one digit';
            // } else if (!preg_match('/[!@#?]/', $data['password'])) {
            //     $data['password_err'] = 'Password must include at least one special character (@, #, ?, !)';
            // } else if (strpos($data['password'], '<') !== false || strpos($data['password'], '>') !== false) {
            //     $data['password_err'] = 'Password must not include < or >';
            // }

            // Check if error is empty
            if (empty($data['username_err']) && empty($data['password_err'])){
                // log the user
                $loggedInUser = $this->userModel->login($data['username'], $data['password']);
                $user_status = $this->userModel->checkStatus($data['username']);
                if ($loggedInUser){
                   
                    // Create session
                    $this->createUserSession($loggedInUser, $user_status);
                }
                else{
                    $data['password_err'] = 'Password incorrect';

                    // Load view with errors
                    $this->view('users/login', $data);
                }
            }
            else{
                // Load view with errors
                $this->view('users/login', $data);
            }
        }
        else{
            unset($_SESSION['username']);
            unset($_SESSION['password']);
            unset($_SESSION['user_email']);

            session_destroy();
            
            // Initial form load
            $data = [
                'username' => '',
                'password' => '',
                'username_err' => '',
                'password_err' => ''
            ];

            // Load view
            $this->view('users/login', $data);
        }
    }

    // Create the session
    public function createUserSession($user, $status){
        if($status == 1){
            $_SESSION['user_id'] = $user->userID;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->username;
            $_SESSION['user_type'] = $user->userType;
    
            redirect($_SESSION['user_type'].'/index');
        }
        else{
            $_SESSION['user_id'] = $user->userID;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->username;
            $_SESSION['user_type'] = $user->userType;

            redirect('users/studentProfileCreation1');
        }
    }
    
    // Logout function
    public function logout(){

        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_type']);

        session_destroy();

        redirect('pages/index');
    }

    // Check if user is logged in
    public function isLoggedIn(){
        if (isset($_SESSION['user_id'])){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function forgetPassword0(){
        $data = [
            'username' => '',
            'username_err' => '',
        ];

        if(isset($_SESSION['username'])){
            $data['username'] = $_SESSION['username'];
        }

        if(isset($_GET['username'])){
            $data = [
                'username' => trim($_GET['username']),
                'username_err' => ''
            ];

            if(empty($data['username'])){
                $data['username_err'] = 'Please enter username';
            }else{
                if(!($this->userModel->findUserByUsername($data['username']))){
                    $data['username_err'] = 'This username is not registered';
                }
            }

            if(empty($data['username_err'])){
                $_SESSION['username'] = $data['username'];

                redirect('users/forgetPassword1');
            }
            else{
                $this->view('users/forgetPassword0', $data);
            }
        }

        $this->view('users/forgetPassword0', $data);
    }

    public function forgetPassword1(){
        // if(isset($_SESSION['account_status'])){
        //     redirect('pages/404');
        // }

        $data = [
            'email' => '',
            'username' => '',
            'email_err' => '',
            'otp_err' => ''
        ];

        if(isset($_SESSION['user_email'])){
            $data['email'] = $_SESSION['user_email'];
        }

        if(isset($_SESSION['username'])){
            $data['username'] = $_SESSION['username'];

            // Fetch the email associated with the username
            $userEmail = $this->userModel->getEmailByUsername($data['username']);

            if($userEmail){
                $data['email'] = $userEmail;
            }            
        } 
        $this->view('users/forgetPassword1', $data);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle form submission when the "Verify" button is pressed
            $otp = $_POST['digit-1'] . $_POST['digit-2'] . $_POST['digit-3'] . $_POST['digit-4'] . $_POST['digit-5'] . $_POST['digit-6'] . $_POST['digit-7'];
    
            die(print_r($otp));
            if (empty($otp)) {
                $data['otp_err'] = 'Please enter OTP';
                $this->view('users/forgetPassword1', $data);
            } else {
                // Check the OTP (you may need to implement this logic)
                // For example, validate the OTP against a stored value or send it for verification
    
                // Assuming the OTP is validated or verified successfully
                $_SESSION['user_email'] = $data['email']; // Set the user_email session
    
                redirect('users/forgetPassword2');
            }
        }

    }

    public function OTPforgetPassword1(){
        $data = [
            'digit-1' => trim($_GET['digit-1']),
            'digit-2' => trim($_GET['digit-2']),
            'digit-3' => trim($_GET['digit-3']),
            'digit-4' => trim($_GET['digit-4']),
            'digit-5' => trim($_GET['digit-5']),
            'digit-6' => trim($_GET['digit-6']),
            'digit-7' => trim($_GET['digit-7']),
            'otp_err' => ''
        ];

        if(empty($data['digit-1']) || empty($data['digit-2']) || empty($data['digit-3']) || empty($data['digit-4']) || empty($data['digit-5']) || empty($data['digit-6']) || empty($data['digit-7'])){
            $data['otp_err'] = 'Please enter the verification code';
        }

        $otp = $data['digit-1'].$data['digit-2'].$data['digit-3'].$data['digit-4'].$data['digit-5'].$data['digit-6'].$data['digit-7'];

        //if($this->userModel->verifyOTP($otp)){
        if($otp == '1234567'){
            redirect('users/forgetPassword2');
        }
        else{
            $data['otp_err'] = 'Invalid OTP';
            $this->view('users/forgetPassword1', $data);
        }
    }

    public function forgetPassword2(){
        // if(isset($_SESSION['account_status'])){
        //     redirect('pages/404');
        // }

        $data = [
            'password' => '',
            'password_err' => '',
            'confirmPassword_err' => '',

        ]; 

        if(isset($_SESSION['password'])){
            $data['password'] = $_SESSION['password'];
        }

        if(isset($_GET['password']) && isset($_GET['confirmPassword'])){   
            $data = [
                'password' => trim($_GET['password']),
                'confirmPassword' => trim($_GET['confirmPassword']),
                'password_err' => '',
                'confirmPassword_err' => ''
            ];

            if(empty($data['password'])){
                $data['password_err'] = 'Please enter password';
            }

            if(empty($data['password'])){
                $data['password_err'] = 'Please enter password';
            }else if ( strlen($data['password']) < 8 ){
                $data['password_err'] = 'Password must be at least 8 characters';            
            } else if ( preg_match('/[a-z]/', ($data['password'])) || preg_match('/[A-Z]/', ($data['password'])) ) {
                $data['password_err'] = 'Password must include both lowercase and uppercase letters';
            } else if ( preg_match('/[a-zA-Z]/', ($data['password'])) || preg_match('/\d/', ($data['password'])) ) {
                $data['password_err'] = 'Password must include both numbers and letters';
            } else if ( preg_match('/[!@#?]/', ($data['password'])) ) {
                $data['password_err'] = 'Password must include at least one special charater (@, #, ?, !)';
            } else if ( strpos(($data['password']), '<') == false || strpos(($data['password']), '>') == false ) {
                $data['password_err'] = 'Password must not include < or >';
            }

            else if($data['password'] != $data['confirmPassword']){
                $data['confirmPassword_err'] = 'Passwords do not match';
            }            

            if(empty($data['password_err']) && empty($data['confirmPassword_err'])){
                $_SESSION['password'] = $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                $_SESSION['user_id'] = $this->userModel->findUserByUsername($data['username']);

                $this->userModel->updatePassword($_SESSION['user_id']);

                redirect('users/login');
            }
            else{
                $this->view('users/forgetPassword2', $data);
            }
        }

        $this->view('users/forgetPassword2', $data);
    }
    
    public function studentProfileCreation1(){
        $data = [
            'firstName' => '',
            'lastName' => '',
            'address' => '',
            'dob' => '',
            'gender' => '',
            'studentType' => '',
            
            'firstName_err' => '',
            'lastName_err' => '',
            'address_err' => '',
            'dob_err' => '',
            'gender_err' => '',
            'studentType_err' => '',
        ];

        if(isset($_SESSION['firstName'])){
            $data['firstName'] = $_SESSION['firstName'];
        }

        if(isset($_SESSION['lastName'])){
            $data['lastName'] = $_SESSION['lastName'];
        }

        if(isset($_SESSION['address'])){
            $data['address'] = $_SESSION['address'];
        }

        if(isset($_SESSION['dob'])){
            $data['dob'] = $_SESSION['dob'];
        }

        if(isset($_SESSION['gender'])){
            $data['gender'] = $_SESSION['gender'];
        }

        if(isset($_SESSION['studentType'])){
            $data['studentType'] = $_SESSION['studentType'];
        }

        if(isset($_GET['firstName']) && isset($_GET['lastName']) && isset($_GET['address']) && isset($_GET['dob']) && isset($_GET['gender']) && isset($_GET['studentType'])){
            $data = [
                'firstName' => trim($_GET['firstName']),
                'lastName' => trim($_GET['lastName']),
                'address' => trim($_GET['address']),
                'dob' => trim($_GET['dob']),
                'gender' => trim($_GET['gender']),
                'studentType' => trim($_GET['studentType']),

                'firstName_err' => '',
                'lastName_err' => '',
                'address_err' => '',
                'dob_err' => '',
                'gender_err' => '',
                'studentType_err' => ''
            ];

            if(empty($data['firstName'])){
                $data['firstName_err'] = 'Please enter first name';
            }

            else if(!preg_match("/^[a-zA-Z]+$/", $data['firstName'])){
                $data['firstName_err'] = 'Only letters are allowed';
            }

            if(empty($data['lastName'])){
                $data['lastName_err'] = 'Please enter last name';
            }

            else if(!preg_match("/^[a-zA-Z]+$/", $data['lastName'])){
                $data['lastName_err'] = 'Only letters are allowed';
            }

            if(empty($data['address'])){
                $data['address_err'] = 'Please enter address';
            }

            if(empty($data['dob'])){
                $data['dob_err'] = 'Please select date of birth';
            }

            else{
                $dob = DateTime::createFromFormat('Y-m-d', $data['dob']);
                $presentDate = new DateTime();

                if($dob > $presentDate){
                    $data['dob_err'] = 'Date of birth cannot be after the present date';
                }
            }

            if(empty($data['gender'])){
                $data['gender_err'] = 'Please select gender';
            }

            if(empty($data['studentType'])){
                $data['studentType_err'] = 'Please select student type';
            }

            

            if(empty($data['firstName_err']) && empty($data['lastName_err']) && empty($data['address_err']) && empty($data['dob_err']) && empty($data['gender_err']) && empty($data['studentType_err'])){
                $_SESSION['firstName'] = $data['firstName'];
                $_SESSION['lastName'] = $data['lastName'];
                $_SESSION['address'] = $data['address'];
                $_SESSION['dob'] = $data['dob'];
                $_SESSION['gender'] = $data['gender'];
                $_SESSION['studentType'] = $data['studentType'];
                

                // die(print_r($_SESSION));

                redirect('Users/studentProfileCreation2');
            }
            else{
                $this->view('users/studentRegistration/studentProfileCreation1', $data);
            }

        }

        $this->view('users/studentRegistration/studentProfileCreation1', $data);
    }

    public function studentProfileCreation2(){
        $data = [
            'orgName' => '',
            'acaYear' => '',
            'schol' => '',
            'orgName_err' => '',
            'acaYear_err' => '',
            'schol_err' => '',
        ];

        if(isset($_SESSION['orgName'])){
            $data['orgName'] = $_SESSION['orgName'];
        }

        if(isset($_SESSION['acaYear'])){
            $data['acaYear'] = $_SESSION['acaYear'];
        }   

        if(isset($_SESSION['schol'])){
            $data['schol'] = $_SESSION['schol'];
        }

        if(isset($_GET['orgName']) && isset($_GET['acaYear']) && isset($_GET['schol'])){
            $data = [
                'orgName' => trim($_GET['orgName']),
                'acaYear' => trim($_GET['acaYear']),
                'schol' => trim($_GET['schol']),
                'orgName_err' => '',
                'acaYear_err' => '',
                'schol_err' => ''
            ];

            if(empty($data['orgName'])){
                $data['orgName_err'] = 'Please enter name of the university / school';
            }

            if(empty($data['acaYear'])){
                $data['acaYear_err'] = 'Please enter academic year / grade';
            }elseif (!is_numeric($data['acaYear'])) {
                $data['acaYear_err'] = 'Academic Year should be a valid number';
            } elseif ($data['acaYear'] <= 0) {
                $data['acaYear_err'] = 'Academic Year should be a positive number';
            }

            if(empty($data['schol'])){
                $data['schol_err'] = 'Please mention currently receiving scholarships';
            }

            if(empty($data['orgName_err']) && empty($data['acaYear_err']) && empty($data['schol_err'])){
                $_SESSION['orgName'] = $data['orgName'];
                $_SESSION['acaYear'] = $data['acaYear'];
                $_SESSION['schol'] = $data['schol'];

                redirect('Users/studentProfileCreation3');
            }
            else{
                $this->view('users/studentRegistration/studentProfileCreation2', $data);
            }
        }

        $this->view('users/studentRegistration/studentProfileCreation2', $data);
    }

    public function studentProfileCreation3(){
        $data = [
            'careType' => '',
            'careName' => '',
            'careOccu' => '',
            'careRealat' => '',
            'careType_err' => '',
            'careName_err' => '',
            'careOccu_err' => ''
            // 'careRealat_err' => ''
        ];

        if(isset($_SESSION['careType'])){
            $data['careType'] = $_SESSION['careType'];
        }

        if(isset($_SESSION['careName'])){
            $data['careName'] = $_SESSION['careName'];
        }

        if(isset($_SESSION['careOccu'])){
            $data['careOccu'] = $_SESSION['careOccu'];
        }

        if(isset($_SESSION['careRealat'])){
            $data['careRealat'] = $_SESSION['careRealat'];
        }

        if(isset($_GET['careType']) && isset($_GET['careName']) && isset($_GET['careOccu'])){
            $data = [
                'careType' => trim($_GET['careType']),
                'careName' => trim($_GET['careName']),
                'careOccu' => trim($_GET['careOccu']),
                'careType_err' => '',
                'careName_err' => '',
                'careOccu_err' => ''
                // 'careRealat_err' => ''
            ];

            // Check if careRealat is provided, otherwise set it to null
            $data['careRealat'] = isset($_GET['careRealat']) ? trim($_GET['careRealat']) : null;

            if(empty($data['careType'])){
                $data['careType_err'] = 'Please select caregiver type';
            }

            if(empty($data['careName'])){
                $data['careName_err'] = 'Please enter caregiver name';
            }

            if(empty($data['careOccu'])){
                $data['careOccu_err'] = 'Please enter caregiver occupation';
            }

            // if(empty($data['careRealat'])){
            //     $data['careRealat_err'] = 'Please enter relationship to the student';
            // }

            if(empty($data['careType_err']) && empty($data['careName_err']) && empty($data['careOccu_err'])){
                $_SESSION['careType'] = $data['careType'];
                $_SESSION['careName'] = $data['careName'];
                $_SESSION['careOccu'] = $data['careOccu'];
                $_SESSION['careRealat'] = $data['careRealat'];

                redirect('Users/studentProfileCreation4');
            }
            else{
                $this->view('users/studentRegistration/studentProfileCreation3', $data);
            }
        }
        $this->view('users/studentRegistration/studentProfileCreation3', $data);
    }

    public function studentProfileCreation4(){
        $data = [
            'accHolderName' => '',
            'accNumber' => '',
            'bankName' => '',
            'branchName' => '',
            'accHolderName_err' => '',
            'accNumber_err' => '',
            'bankName_err' => '',
            'branchName_err' => ''
        ];

        if(isset($_SESSION['accHolderName'])){
            $data['accHolderName'] = $_SESSION['accHolderName'];
        }

        if(isset($_SESSION['accNumber'])){
            $data['accNumber'] = $_SESSION['accNumber'];
        }

        if(isset($_SESSION['bankName'])){
            $data['bankName'] = $_SESSION['bankName'];
        }

        if(isset($_SESSION['branchName'])){
            $data['branchName'] = $_SESSION['branchName'];
        }

        if(isset($_GET['accHolderName']) && isset($_GET['accNumber']) && isset($_GET['bankName']) && isset($_GET['branchName'])){
            $data = [
                'accHolderName' => trim($_GET['accHolderName']),
                'accNumber' => trim($_GET['accNumber']),
                'bankName' => trim($_GET['bankName']),
                'branchName' => trim($_GET['branchName']),
                'accHolderName_err' => '',
                'accNumber_err' => '',
                'bankName_err' => '',
                'branchName_err' => ''
            ];

            if(empty($data['accHolderName'])){
                $data['accHolderName_err'] = 'Please enter account holder name';
            }

            if(empty($data['accNumber'])){
                $data['accNumber_err'] = 'Please enter account number';
            }elseif (!is_numeric($data['accNumber'])) {
                $data['accNumber_err'] = 'Account Number should be a valid number';
            } elseif ($data['accNumber'] <= 0) {
                $data['accNumber_err'] = 'Account Number should be a positive number';
            }

            if(empty($data['bankName'])){
                $data['bankName_err'] = 'Please enter name of the bank';
            }

            if(empty($data['branchName'])){
                $data['branchName_err'] = 'Please enter branch name';
            }

            if(empty($data['accHolderName_err']) && empty($data['accNumber_err']) && empty($data['bankName_err']) && empty($data['branchName_err'])){
                $_SESSION['accHolderName'] = $data['accHolderName'];
                $_SESSION['accNumber'] = $data['accNumber'];
                $_SESSION['bankName'] = $data['bankName'];
                $_SESSION['branchName'] = $data['branchName'];

                redirect('Users/studentProfileCreation5');
            }
            else{
                $this->view('users/studentRegistration/studentProfileCreation5', $data);
            }
        }
        $this->view('users/studentRegistration/studentProfileCreation5', $data);
    }

    public function studentProfileCreation5(){
        $data = [
            'contactNo' => '',
            'nic' => '',
            'contactNo_err' => '',
            'nic_err' => '',
        ];

        if(isset($_SESSION['contactNo'])){
            $data['contactNo'] = $_SESSION['contactNo'];
        }

        if(isset($_SESSION['nic'])){
            $data['nic'] = $_SESSION['nic'];
        }

        if(isset($_GET['contactNo']) && isset($_GET['nic'])){
            $data = [
                'contactNo' => trim($_GET['contactNo']),
                'nic' => trim($_GET['nic']),

                'contactNo_err' => '',
                'nic_err' => '',
            ];

            if (empty($data['contactNo'])){
                $data['contactNo_err'] = 'Please enter contactNo';
            } 
            
            else if(!preg_match('/^(0\d{9}|[1-9]\d{8}|\+94\d{7})$/', $data['contactNo'])) {
                $data['contactNo_err'] = 'Invalid contact number format';
            }

            if (empty($data['nic'])) {
                $data['nic_err'] = 'Please enter NIC';
            } elseif (!preg_match('/^(?:[0-9]{9}[vVxX]|[0-9]{12})$/', $data['nic'])) {
                $data['nic_err'] = 'Invalid NIC format';
            }

            if(empty($data['contactNo_err']) && empty($data['nic_err'])){
                $_SESSION['contactNo'] = $data['contactNo'];
                $_SESSION['nic'] = $data['nic'];

                redirect('users/studentProfileCreation6');
            }
            else{
                $this->view('users/studentRegistration/studentProfileCreation6', $data);
            }
        }
        $this->view('users/studentRegistration/studentProfileCreation6', $data);
    }

    public function studentProfileCreation6(){
        $data = [
            'remember1' => '',
            'remember2' => '',
            'remember3' => '',  
            'remember4' => '',
            'remember5' => '',
            'err' => '',
        ];

        if(isset($_SESSION['remember1'])){
            $data['remember1'] = $_SESSION['remember1'];
        }

        if(isset($_SESSION['remember2'])){
            $data['remember2'] = $_SESSION['remember2'];
        }

        if(isset($_SESSION['remember3'])){
            $data['remember3'] = $_SESSION['remember3'];
        }

        if(isset($_SESSION['remember4'])){
            $data['remember4'] = $_SESSION['remember4'];
        }

        if(isset($_SESSION['remember5'])){
            $data['remember5'] = $_SESSION['remember5'];
        }


        if(isset($_GET['remember1']) || isset($_GET['remember2']) || isset($_GET['remember3']) || isset($_GET['remember4']) || isset($_GET['remember5'])){
            if(isset($_GET['remember1'])){
                $data['remember1'] = trim($_GET['remember1']);
            }

            if(isset($_GET['remember2'])){
                $data['remember2'] = trim($_GET['remember2']);
            }

            if(isset($_GET['remember3'])){
                $data['remember3'] = trim($_GET['remember3']);
            }

            if(isset($_GET['remember4'])){
                $data['remember4'] = trim($_GET['remember4']);
            }

            if(isset($_GET['remember5'])){
                $data['remember5'] = trim($_GET['remember5']);
            }

            $_SESSION['remember1'] = $data['remember1'];
            $_SESSION['remember2'] = $data['remember2'];
            $_SESSION['remember3'] = $data['remember3'];
            $_SESSION['remember4'] = $data['remember4'];
            $_SESSION['remember5'] = $data['remember5'];

            redirect('Users/studentProfileCreation7');
        }else{
            $data['err'] = 'One of the above must be chosen';
        }
        
        $this->view('users/studentRegistration/studentProfileCreation7', $data);
    }

    public function imgUpload($file){
        $file_name = $_FILES[$file]['name'];
        $file_size = $_FILES[$file]['size'];
        $tmp_name = $_FILES[$file]['tmp_name'];
        $error = $_FILES[$file]['error'];

        if ($error === 0){
            $file_ex = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_ex_lc = strtolower($file_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($file_ex_lc, $allowed_exs)){
                // Move into benefactionUploads folder
                $new_file_name = uniqid("IMG-", true).'.'.$file_ex_lc;
                $file_upload_path = PUBLICROOT.'/registrationPhotos/'.$new_file_name;

                move_uploaded_file($tmp_name, $file_upload_path);
                return $new_file_name;
            }

            else{
                $data['photoBenfaction_err'] = "You can't upload files of this type";
                return $data;
            }
        }
    }

    public function studentProfileCreation7(){
        $data = [
            'letterimage1' => '',
            'letterimage2' => '',
            'letterimage3' => '',
            'letterimage4' => '',
            'letterimage1_err' => '',
            'letterimage2_err' => '',
            'letterimage3_err' => '',
            'letterimage4_err' => '',
        ];

        if(isset($_FILES['letterimage1']['name']) && isset($_FILES['letterimage2']['name']) && isset($_FILES['letterimage3']['name']) && isset($_FILES['letterimage4']['name'])){
            $data = [
                'letterimage1' => $this->imgUpload('letterimage1'),
                'letterimage2' => $this->imgUpload('letterimage2'),
                'letterimage3' => $this->imgUpload('letterimage3'),
                'letterimage4' => $this->imgUpload('letterimage4'),

                'letterimage1_err' => '',
                'letterimage2_err' => '',
                'letterimage3_err' => '',
                'letterimage4_err' => ''
            ];

            if(empty($data['letterimage1'])){
                $data['letterimage1_err'] = 'Please upload GS Certificate';
            }

            if(empty($data['letterimage2'])){
                $data['letterimage2_err'] = 'Please upload GS Certificate';
            }

            if(empty($data['letterimage3'])){
                $data['letterimage3_err'] = 'Please upload NIC - front';
            }

            if(empty($data['letterimage4'])){
                $data['letterimage4_err'] = 'Please upload NIC - back';
            } 

            if(empty($data['err'])){
                $_SESSION['letterimage1'] = $data['letterimage1'];
                $_SESSION['letterimage2'] = $data['letterimage2'];
                $_SESSION['letterimage3'] = $data['letterimage3'];
                $_SESSION['letterimage4'] = $data['letterimage4'];

                $this->userModel->studentRegister();

                redirect('users/studentProfileCreation8');
            }
            else{
                $this->view('users/studentRegistration/studentProfileCreation4', $data);
            }
        }

        $this->view('users/studentRegistration/studentProfileCreation4', $data);
    }

    public function studentProfileCreation8(){
        $this->view('users/studentRegistration/studentProfileCreation8');
    }

    //------------------------------------------------
    

}