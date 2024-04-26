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
            'err' => ''
        ];
        
        if(isset($_SESSION['user_email'])){
            $data['email'] = $_SESSION['user_email'];
        }

        if(isset($_GET['email'])){
            $data = [
                'email' => trim($_GET['email']),
                'err' => ''
            ];

            if(empty($data['email'])){
                $data['err'] = 'Please enter email';
            }

            else{
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['err'] = 'Email is already taken';
                }
            }

            if(empty($data['err'])){
                $_SESSION['user_email'] = $data['email'];

                redirect('Users/studentAcountCreationPage1');
            }
            else{
                $this->view('users/studentRegistration/studentAcountCreationPage1', $data);
            }
        }

        $this->view('users/studentRegistration/studentAcountCreationPage1', $data);
    }   

    public function OTPstudentAcountCreationPage1(){
        $data = [
            'digit-1' => trim($_GET['digit-1']),
            'digit-2' => trim($_GET['digit-2']),
            'digit-3' => trim($_GET['digit-3']),
            'digit-4' => trim($_GET['digit-4']),
            'digit-5' => trim($_GET['digit-5']),
            'digit-6' => trim($_GET['digit-6']),
            'digit-7' => trim($_GET['digit-7']),
            'err' => ''
        ];

        if(empty($data['digit-1']) || empty($data['digit-2']) || empty($data['digit-3']) || empty($data['digit-4']) || empty($data['digit-5']) || empty($data['digit-6']) || empty($data['digit-7'])){
            $data['err'] = 'Please enter the verification code';
        }

        $otp = $data['digit-1'].$data['digit-2'].$data['digit-3'].$data['digit-4'].$data['digit-5'].$data['digit-6'].$data['digit-7'];

        //if($this->userModel->verifyOTP($otp)){
        if($otp == '1234567'){
            redirect('Users/studentAcountCreationPage2');
        }
        else{
            $data['err'] = 'Invalid OTP';
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
            'err' => ''
        ];    
        
        if(isset($_SESSION['username'])){
            $data['username'] = $_SESSION['username'];
        }

        if(isset($_SESSION['password'])){
            $data['password'] = $_SESSION['password'];
        }

        if(isset($_GET['username']) && isset($_GET['password']) && isset($_GET['confirmPassword'])){   
            $data = [
                'username' => trim($_GET['username']),
                'password' => trim($_GET['password']),
                'confirmPassword' => trim($_GET['confirmPassword']),
                'err' => ''
            ];

            if(empty($data['username'])){
                $data['err'] = 'Please enter username';
            }

            else{
                if($this->userModel->findUserByUsername($data['username'])){
                    $data['err'] = 'Username is already taken';
                }
            }

            if(empty($data['password'])){
                $data['err'] = 'Please enter password';
            }

            else if(strlen($data['password']) < 6){
                $data['err'] = 'Password must be at least 6 characters';
            }

            else if($data['password'] != $data['confirmPassword']){
                $data['err'] = 'Passwords do not match';
            }            

            if(empty($data['err'])){
                $_SESSION['username'] = $data['username'];
                $_SESSION['password'] = $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                $_SESSION['user_type'] = "student";

                $_SESSION['account_status'] = 0;
                
                $this->userModel->accountCreation();

                redirect('Users/studentAcountCreationPage3');
            }
            else{
                $this->view('users/studentRegistration/studentAcountCreationPage2', $data);
            }
        }


        $this->view('users/studentRegistration/studentAcountCreationPage2', $data);
    }

    public function studentAcountCreationPage3(){
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
                'err' => ''
            ];

            // Validate data
            // Validate email
            if (empty($data['username'])){
                $data['err'] = 'Please enter username';
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
                            $data['err'] = 'You have been banned'; 
                        }
                    }

                    else if($this->userModel->checkStatus($data['username']) == 10) {
                        $data['err'] = 'User Not Found'; 
                    }

                }
                else{
                    // User not found
                    $data['err'] = 'User Not Found'; 
                }
            }

            // Validate password
            if (empty($data['password'])){
                $data['err'] = 'Please enter password';
            }

            // Check if error is empty
            if (empty($data['err'])){
                // log the user
                $loggedInUser = $this->userModel->login($data['username'], $data['password']);
                if ($loggedInUser){
                    // Create session
                    $this->createUserSession($loggedInUser);
                }
                else{
                    $data['err'] = 'Password incorrect';

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
            
            // Initial form load
            $data = [
                'username' => '',
                'password' => '',
                'err' => ''
            ];

            // Load view
            $this->view('users/login', $data);
        }
    }

    public function studentProfileCreation1(){
        $this->view('users/studentRegistration/studentProfileCreation1');
    }

    public function studentProfileCreation2(){
        $this->view('users/studentRegistration/studentProfileCreation2');
    }

    public function studentProfileCreation3(){
        $this->view('users/studentRegistration/studentProfileCreation3');
    }

    public function studentProfileCreation4(){
        $this->view('users/studentRegistration/studentProfileCreation4');
    }

    public function studentProfileCreation5(){
        $this->view('users/studentRegistration/studentProfileCreation5');
    }

    public function studentProfileCreation6(){
        $this->view('users/studentRegistration/studentProfileCreation6');
    }

    public function studentProfileCreation7(){
        $this->view('users/studentRegistration/studentProfileCreation7');
    }
    //------------------------------------------------

    public function forgetPassword1(){
        $this->view('users/forgetPassword1');
    }

    public function forgetPassword2(){
        $this->view('users/forgetPassword2');
    }

    public function passwordResetSuccessful(){
        $this->view('users/passwordResetSuccessful');
    }

    public function studentRegistration($email = null, $pw = null, $cp = null){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Form Submitting

            //Validate Data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Input Data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'userType' => 'student',

                'email_err' => '',
                'password_err' => '',
                'confirmPassword_err' => ''

            ];

            //Validate Each Input
            //Validate Email
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter an email';
            }else{
                //Check email is alreayd registered or not
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err'] = 'Email is Already Registered';
                }
            }

            // Validate password
            if (empty($data['password'])){
                $data['password_err'] = 'Please enter a password';
            } else if ( strlen($data['password']) < 8 ){
                $data['password_err'] = 'Password must be at least 8 characters';
            }
            // } else if ( preg_match('/[a-z]/', ($data['password'])) || preg_match('/[A-Z]/', ($data['password'])) ) {
            //     $data['password_err'] = 'Password must include both lowercase and uppercase letters';
            // } else if ( preg_match('/[a-zA-Z]/', ($data['password'])) || preg_match('/\d/', ($data['password'])) ) {
            //     $data['password_err'] = 'Password must include both numbers and letters';
            // } else if ( preg_match('/[!@#?]/', ($data['password'])) ) {
            //     $data['password_err'] = 'Password must include at least one special charater (@, #, ?, !)';
            // } else if ( strpos(($data['password']), '<') == false || strpos(($data['password']), '>') == false ) {
            //     $data['password_err'] = 'Password must not include < or >';
            // }

            if (empty($data['confirmPassword'])) {
                $data['confirmPassword_err'] = 'Please confirm password';
            } else if ($data['password'] != $data['confirmPassword']) {
                $data['confirmPassword_err'] = 'Passwords do not match';                
            }

            //Validation is completed and no error then register the user
            if(empty($data['email_err']) && empty($data['password_err']) && empty($data['confirmPassword_err']) ){
                //Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Register USer
                if($this->userModel->registerUser($data)) {
                    // $this->view('users/emailVerifyOTP', $data);

                    $_SESSION['user_id'] = $this->userModel->getUserIDByEmail($data['email']);
                    $_SESSION['user_email'] = $data['email'];
                    $_SESSION['user_type'] = 'student';

                    $this->view('users/emailVerifyOTP', $data);
                    
                }else{
                    die('Something Went Wrong');
                }
            }else{
                //Load View
                $this->view('users/studentRegistration', $data);
            }

        }else{
            //Initial Form
            $data = [
                'email' => '',
                'password' => '',
                'confirmPassword' => '',

                'email_err' => '',
                'password_err' => '',
                'confirmPassword_err' => '',
            ];

            //Load View
            $this->view('users/studentRegistration', $data);
        }
    }

    public function emailVerifyOTP(){
        $this->view('users/emailVerifyOTP');
    }

    public function emailVerifyOTPDonor(){
        $this->view('users/emailVerifyOTPDonor');
    }

    public function emailVerifyOTPOrganization(){
        $this->view('users/emailVerifyOTPOrganization');
    }

    // public function setPassword(){
    //     $this->view('users/setPassword');
    // }
    
    public function accountCreationSuccessful(){
        $this->view('users/accountCreationSuccessful');
    }

    public function accountCreationSuccessfulDonor(){
        $this->view('users/accountCreationSuccessfulDonor');
    }

    public function accountCreationSuccessfulOrganization(){
        $this->view('users/accountCreationSuccessfulOrganization');
    }

    public function organizationRegistration(){
        $this->view('users/organizationRegistration');
    }

    public function donorRegistration(){
        $this->view('users/donorRegistration');
    }

    public function studentCreatingProfile1(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Form Submitting

            //Validate Data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Input Data
            $data = [
                'firstName' => trim($_POST['firstName']),
                'lastName' => trim($_POST['lastName']),
                'address' => trim($_POST['address']),
                'dob' => trim($_POST['dob']),
                'gender' => $_POST['gender'] ?? '',
                'studentType' => $_POST['studentType'] ?? '',

                'firstName_err' => '',
                'lastName_err' => '',
                'address_err' => '',
                'dob_err' => '',
                'gender_err' => '',
                'studentType_err' => '',

                'orgName_err' => '',
                'acaYear_err' => '',
                'schol_err' => ''

            ];

            //Validate Each Input

            //Validate FirstName
            if(empty($data['firstName'])){
                $data['firstName_err'] = 'Please enter the first name';
            } elseif(!preg_match("/^[a-zA-Z]+$/", $data['firstName'])){
                $data['firstName_err'] = 'Only letters are allowed';
            }

            //Validate LastName
            if(empty($data['lastName'])){
                $data['lastName_err'] = 'Please enter the last name';
            } elseif(!preg_match("/^[a-zA-Z]+$/", $data['lastName'])){
                $data['lastName_err'] = 'Only letters are allowed';
            }

            //Validate Address
            if(empty($data['address'])){
                $data['address_err'] = 'Please enter an address';
            }

            //Validate DOB
            if(empty($data['dob'])){
                $data['dob_err'] = 'Please select the date of birth';
            } else {
                // Create DateTime objects for the provided date of birth and the present date
                $dob = DateTime::createFromFormat('Y-m-d', $data['dob']);
                $presentDate = new DateTime();

                // Check if the provided date of birth is not after the present date
                if ($dob > $presentDate) {
                    $data['dob_err'] = 'Date of birth cannot be after the present date';
                }
            }
      
            //Validate Gender
            if(empty($data['gender'])){
                $data['gender_err'] = 'Please select the gender';
            }

            //Validate Student TYpe
            if(empty($data['studentType'])){
                $data['studentType_err'] = 'Please select the student type';
            }            


            //Validation is completed and no error then register the user
            if(empty($data['firstName_err']) && empty($data['lastName_err']) && empty($data['address_err']) && empty($data['dob_err']) && empty($data['gender_err']) && empty($data['studentType_err']) ){

                //Register USer
                if($this->userModel->createAccount($data)) {
                    $this->view('users/studentCreatingProfile2', $data);
                }
                else{
                    die('Something Went Wrong');
                }
            }else{
                //Load View
                $this->view('users/studentCreatingProfile1', $data);
            }

        }else{
            //Initial Form
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
                'studentType_err' => ''
            ];

            //Load View
            $this->view('users/studentCreatingProfile1', $data);
        }
    }

    public function studentCreatingProfile2(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Form Submitting

            //Validate Data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Input Data
            $data = [
                'orgName' => trim($_POST['orgName']),
                'acaYear' => trim($_POST['acaYear']),
                'schol' => trim($_POST['schol']),

                'orgName_err' => '',
                'acaYear_err' => '',

                'careType_err' => '',
                'careName_err' => '',
                'careOccu_err' => '',
                'careRealat_err' => ''                
            ];

            //Validate Each Input

            //Validate Organization Name
            if(empty($data['orgName'])){
                $data['orgName_err'] = 'Organization Name Is Required';
            }

            //Validate Academic Year
            if(empty($data['acaYear'])){
                $data['acaYear_err'] = 'Academic Year Is Required';
            }         


            //Validation is completed and no error then register the user
            if(empty($data['orgName_err']) && empty($data['acaYear_err'])){

                //Register USer
                if($this->userModel->updateStudentTable($data)) {

                    $this->view('users/studentCreatingProfile3', $data);
                    
                }else{
                    die('Something Went Wrong');
                }
            }else{
                //Load View
                $this->view('users/studentCreatingProfile2', $data);
            }


        }else{
            //Initial Form
            $data = [
                'orgName' => '',
                'acaYear' => '',
                'schol' => '',

                'orgName_err' => '',
                'acaYear_err' => ''
            ];

            //Load View
            $this->view('users/studentCreatingProfile2', $data);
        }
    }

    public function studentCreatingProfile3(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Form Submitting

            //Validate Data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Input Data
            $data = [
                'careType' => trim($_POST['careType']),
                'careName' => trim($_POST['careName']),
                'careOccu' => trim($_POST['careOccu']),
                'careRealat' => isset($_POST['careRealat']) ? trim($_POST['careRealat']) : '',

                'careType_err' => '',
                'careName_err' => '',
                'careOccu_err' => '',
                'careRealat_err' => ''

            ];

            //Validate Each Input

            //Validate CareTaker Type
            if(empty($data['careType'])){
                $data['careType_err'] = 'Please select a cargiver type';
            }

            //Validate Name
            if (empty($data['careName'])) {
                $data['careName_err'] = 'Caregiver name is required';
            }
      
            //Validate Occupation
            if(empty($data['careOccu'])){
                $data['careOccu_err'] = 'Caregiver occupation is required';
            }

            // //Validate Relationship
            if (!empty($data['careRealat']) && isset($_POST['careRealat'])) {
                if (empty($data['careRealat'])) {
                    $data['careRealat_err'] = 'Relationship to the student is required';
                }
            }
    
            // If no errors, proceed
            if (empty($data['careType_err']) && empty($data['careName_err']) && empty($data['careOccu_err']) && empty($data['careRealat_err'])) {

                //Register USer
                if($this->userModel->updateStudentTableRemain($data)) {

                    $this->view('users/studentCreatingProfile4', $data);
                    
                }else{
                    die('Something Went Wrong');
                }
            }else{
                //Load View
                $this->view('users/studentCreatingProfile3', $data);
            }

        }else{
            //Initial Form
            $data = [
                'careType' => '',
                'careName' => '',
                'careOccu' => '',
                'careRealat' => isset($_POST['careRealat']) ? trim($_POST['careRealat']) : '',

                'careType_err' => '',
                'careName_err' => '',
                'careOccu_err' => '',
                'careRealat_err' => ''
            ];

            //Load View
            $this->view('users/studentCreatingProfile3', $data);
        }
    }


    public function studentCreatingProfile4(){
        $this->view('users/studentCreatingProfile4');
    }

    public function studentCreatingProfile5(){
        $this->view('users/studentCreatingProfile5');
    }

    public function studentCreatingProfile6(){
        $this->view('users/studentCreatingProfile6');
    }

    public function studentOrganizationCreatingProfile2(){
        $this->view('users/studentOrganizationCreatingProfile2');
    }

    public function profile(){
        $this->view('users/profile');
    }    

    public function profileCreationSuccessful(){
        $this->view('users/profileCreationSuccessful');
    }

    public function donorCreateProfile1(){
        $this->view('users/donorCreateProfile1');
    }

    public function donorCreateProfile2(){
        $this->view('users/donorCreateProfile2');
    }

    public function donorCreateProfile3(){
        $this->view('users/donorCreateProfile3');
    }

    public function organizationCreatingProfile1(){
        $this->view('users/organizationCreatingProfile1');
    }

    public function organizationCreatingProfile2(){
        $this->view('users/organizationCreatingProfile2');
    }

    public function organizationCreatingProfile3(){
        $this->view('users/organizationCreatingProfile3');
    }
    

    // public function register(){
    //     // Initial form data
    //     $data = [
    //         'name' => '',
    //         'email' => '',
    //         'password' => '',
    //         'confirm_password' => '',
    //         'user_type' => '',
    //         'err' => '',
    //     ];

    //     // Load view
    //     $this->view('users/registerLand', $data);
    // }

    // public function studentRegister(){
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    //         // Submitted form data
    //         // input data
    //         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //         $data = [
    //             'name' => trim($_POST['name']),
    //             'email' => trim($_POST['email']),
    //             'password' => trim($_POST['password']),
    //             'confirm_password' => trim($_POST['confirm_password']),
    //             'user_type' => trim($_POST['user_type']),
    //             'err' => ''
    //         ];

    //         // Validate data
    //         // Validate name
    //         if (empty($data['name'])){
    //             $data['err'] = 'Please enter name';
    //         }

    //         // Validate email
    //         if (empty($data['email'])){
    //             $data['err'] = 'Please enter email';
    //         } else {
    //             // Check email
    //             if ($this->userModel->findUserByEmail($data['email'])){
    //                 $data['err'] = 'Email is already taken';
    //             }
    //         }

    //         // Validate password
    //         if (empty($data['password'])){
    //             $data['err'] = 'Please enter password';
    //         } elseif (strlen($data['password']) < 6){
    //             $data['err'] = 'Password must be at least 6 characters';
    //         }

    //         // Validate confirm password
    //         if (empty($data['confirm_password'])){
    //             $data['err'] = 'Please confirm password';
    //         } else {
    //             if ($data['password'] != $data['confirm_password']){
    //                 $data['err'] = 'Passwords do not match';
    //             }
    //         }

    //         // Validate user type
    //         if (empty($data['user_type'])){
    //             $data['err'] = 'Please select user type';
    //         }

    //         // Validation is completed and no error found
    //         if (empty($data['err'])){
    //             // Hash password
    //             $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    //             // Register user
    //             if ($this->userModel->register($data)){
    //                 redirect('users/login');
    //             } else {
    //                 die('Something went wrong');
    //             }
    //         } else {
    //             // Load view with errors
    //             $this->view('users/studentRegister', $data);
    //         }

    //     } else {
    //         // Initial form data
    //         $data = [
    //             'name' => '',
    //             'email' => '',
    //             'password' => '',
    //             'confirm_password' => '',
    //             'user_type' => '',
    //             'err' => '',
    //         ];

    //         // Load view
    //         $this->view('users/studentRegister', $data);
    //     }
    // }

    // public function donorRegister(){
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    //         // Submitted form data
    //         // input data
    //         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //         $data = [
    //             'name' => trim($_POST['name']),
    //             'email' => trim($_POST['email']),
    //             'password' => trim($_POST['password']),
    //             'confirm_password' => trim($_POST['confirm_password']),
    //             'user_type' => trim($_POST['user_type']),
    //             'err' => ''
    //         ];

    //         // Validate data
    //         // Validate name
    //         if (empty($data['name'])){
    //             $data['err'] = 'Please enter name';
    //         }

    //         // Validate email
    //         if (empty($data['email'])){
    //             $data['err'] = 'Please enter email';
    //         } else {
    //             // Check email
    //             if ($this->userModel->findUserByEmail($data['email'])){
    //                 $data['err'] = 'Email is already taken';
    //             }
    //         }

    //         // Validate password
    //         if (empty($data['password'])){
    //             $data['err'] = 'Please enter password';
    //         } elseif (strlen($data['password']) < 6){
    //             $data['err'] = 'Password must be at least 6 characters';
    //         }

    //         // Validate confirm password
    //         if (empty($data['confirm_password'])){
    //             $data['err'] = 'Please confirm password';
    //         } else {
    //             if ($data['password'] != $data['confirm_password']){
    //                 $data['err'] = 'Passwords do not match';
    //             }
    //         }

    //         // Validate user type
    //         if (empty($data['user_type'])){
    //             $data['err'] = 'Please select user type';
    //         }

    //         // Validation is completed and no error found
    //         if (empty($data['err'])){
    //             // Hash password
    //             $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    //             // Register user
    //             if ($this->userModel->register($data)){
    //                 redirect('users/login');
    //             } else {
    //                 die('Something went wrong');
    //             }
    //         } else {
    //             // Load view with errors
    //             $this->view('users/donorRegister', $data);
    //         }

    //     } else {
    //         // Initial form data
    //         $data = [
    //             'name' => '',
    //             'email' => '',
    //             'password' => '',
    //             'confirm_password' => '',
    //             'user_type' => '',
    //             'err' => '',
    //         ];

    //         // Load view
    //         $this->view('users/donorRegister', $data);
    //     }
    // }

    // public function organizationRegister(){
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    //         // Submitted form data
    //         // input data
    //         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //         $data = [
    //             'name' => trim($_POST['name']),
    //             'email' => trim($_POST['email']),
    //             'password' => trim($_POST['password']),
    //             'confirm_password' => trim($_POST['confirm_password']),
    //             'user_type' => trim($_POST['user_type']),
    //             'err' => ''
    //         ];

    //         // Validate data
    //         // Validate name
    //         if (empty($data['name'])){
    //             $data['err'] = 'Please enter name';
    //         }

    //         // Validate email
    //         if (empty($data['email'])){
    //             $data['err'] = 'Please enter email';
    //         } else {
    //             // Check email
    //             if ($this->userModel->findUserByEmail($data['email'])){
    //                 $data['err'] = 'Email is already taken';
    //             }
    //         }

    //         // Validate password
    //         if (empty($data['password'])){
    //             $data['err'] = 'Please enter password';
    //         } elseif (strlen($data['password']) < 6){
    //             $data['err'] = 'Password must be at least 6 characters';
    //         }

    //         // Validate confirm password
    //         if (empty($data['confirm_password'])){
    //             $data['err'] = 'Please confirm password';
    //         } else {
    //             if ($data['password'] != $data['confirm_password']){
    //                 $data['err'] = 'Passwords do not match';
    //             }
    //         }

    //         // Validate user type
    //         if (empty($data['user_type'])){
    //             $data['err'] = 'Please select user type';
    //         }

    //         // Validation is completed and no error found
    //         if (empty($data['err'])){
    //             // Hash password
    //             $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    //             // Register user
    //             if ($this->userModel->register($data)){
    //                 redirect('users/login');
    //             } else {
    //                 die('Something went wrong');
    //             }
    //         } else {
    //             // Load view with errors
    //             $this->view('users/organizationRegister', $data);
    //         }

    //     } else {
    //         // Initial form data
    //         $data = [
    //             'name' => '',
    //             'email' => '',
    //             'password' => '',
    //             'confirm_password' => '',
    //             'user_type' => '',
    //             'err' => '',
    //         ];

    //         // Load view
    //         $this->view('users/organizationRegister', $data);
    //     }
    // }



    // Create the session
    public function createUserSession($user){
        $_SESSION['user_id'] = $user->userID;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->username;
        $_SESSION['user_type'] = $user->userType;

        redirect($_SESSION['user_type'].'/index');
    }

    // Logout function
    public function logout(){

        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_type']);

        session_destroy();

        redirect('users/login');
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
}