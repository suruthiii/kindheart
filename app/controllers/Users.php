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
        // if(isset($_SESSION['account_status'])){
        //     redirect('pages/404');
        // }

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
            'otp_err' => ''
        ];

        if(empty($data['digit-1']) || empty($data['digit-2']) || empty($data['digit-3']) || empty($data['digit-4']) || empty($data['digit-5']) || empty($data['digit-6']) || empty($data['digit-7'])){
            $data['otp_err'] = 'Please enter the verification code';
        }

        $otp = $data['digit-1'].$data['digit-2'].$data['digit-3'].$data['digit-4'].$data['digit-5'].$data['digit-6'].$data['digit-7'];

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
        // if(isset($_SESSION['account_status'])){
        //     redirect('pages/404');
        // }

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

        if(isset($_GET['username']) && isset($_GET['password']) && isset($_GET['confirmPassword'])){   
            $data = [
                'username' => trim($_GET['username']),
                'password' => trim($_GET['password']),
                'confirmPassword' => trim($_GET['confirmPassword']),
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

            if(empty($data['password'])){
                $data['password_err'] = 'Please enter password';
            }

            else if(strlen($data['password']) < 6){
                $data['password_err'] = 'Password must be at least 6 characters';
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
            if (empty($data['password'])){
                $data['password_err'] = 'Please enter password';
            }

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

    public function forgetPassword1(){
        // if(isset($_SESSION['account_status'])){
        //     redirect('pages/404');
        // }

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

                redirect('users/forgetPassword1');
            }
            else{
                $this->view('users/forgetPassword1', $data);
            }
        }

        $this->view('users/forgetPassword1', $data);
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

            else if(strlen($data['password']) < 6){
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            else if($data['password'] != $data['confirmPassword']){
                $data['confirmPassword_err'] = 'Passwords do not match';
            }            

            if(empty($data['password_err']) && empty($data['confirmPassword_err'])){
                $_SESSION['password'] = $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                $_SESSION['user_type'] = "student";

                $_SESSION['account_status'] = 0;
                
                $this->userModel->accountCreation();

                redirect('users/studentAcountCreationPage3');
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
            'err' => ''
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
                'err' => ''
            ];

            if(empty($data['orgName'])){
                $data['err'] = 'Please enter name of the university / school';
            }

            if(empty($data['acaYear'])){
                $data['err'] = 'Please enter academic year / grade';
            }

            if(empty($data['schol'])){
                $data['err'] = 'Please mention currently receiving scholarships';
            }

            if(empty($data['err'])){
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
            'err' => ''
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

        if(isset($_GET['careType']) && isset($_GET['careName']) && isset($_GET['careOccu']) && isset($_GET['careRealat'])){
            $data = [
                'careType' => trim($_GET['careType']),
                'careName' => trim($_GET['careName']),
                'careOccu' => trim($_GET['careOccu']),
                'careRealat' => trim($_GET['careRealat']),
                'err' => ''
            ];

            if(empty($data['careType'])){
                $data['err'] = 'Please select caregiver type';
            }

            if(empty($data['careName'])){
                $data['err'] = 'Please enter caregiver name';
            }

            if(empty($data['careOccu'])){
                $data['err'] = 'Please enter caregiver occupation';
            }

            if(empty($data['careRealat'])){
                $data['err'] = 'Please enter relationship to the student';
            }

            if(empty($data['err'])){
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
            'err' => ''
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
                'err' => ''
            ];

            if(empty($data['accHolderName'])){
                $data['err'] = 'Please enter account holder name';
            }

            if(empty($data['accNumber'])){
                $data['err'] = 'Please enter account number';
            }

            if(empty($data['bankName'])){
                $data['err'] = 'Please enter name of the bank';
            }

            if(empty($data['branchName'])){
                $data['err'] = 'Please enter branch name';
            }

            if(empty($data['err'])){
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
            ];

            if (empty($data['contactNo'])){
                $data['err'] = 'Please enter contactNo';
            } 
            
            else if(!preg_match('/^(0\d{9}|[1-9]\d{8}|\+94\d{7})$/', $data['contactNo'])) {
                $data['err'] = 'Invalid contact number format';
            }

            if (empty($data['nic'])) {
                $data['err'] = 'Please enter NIC';
            } elseif (!preg_match('/^(?:[0-9]{9}[vVxX]|[0-9]{12})$/', $data['nic'])) {
                $data['err'] = 'Invalid NIC format';
            }

            if(empty($data['err'])){
                $_SESSION['contactNo'] = $data['contactNo'];
                $_SESSION['nic'] = $data['nic'];

                redirect('users/studentProfileCreation6');
            }
            else{
                $this->view('users/studentRegistration/studentProfileCreation5', $data);
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
            'remember5' => ''
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
            'err' => ''
        ];

        if(isset($_FILES['letterimage1']['name']) && isset($_FILES['letterimage2']['name']) && isset($_FILES['letterimage3']['name']) && isset($_FILES['letterimage4']['name'])){
            $data = [
                'letterimage1' => $this->imgUpload('letterimage1'),
                'letterimage2' => $this->imgUpload('letterimage2'),
                'letterimage3' => $this->imgUpload('letterimage3'),
                'letterimage4' => $this->imgUpload('letterimage4'),
                'err' => ''
            ];

            if(empty($data['letterimage1'])){
                $data['err'] = 'Please upload GS Certificate';
            }

            if(empty($data['letterimage2'])){
                $data['err'] = 'Please upload GS Certificate';
            }

            if(empty($data['letterimage3'])){
                $data['err'] = 'Please upload NIC - front';
            }

            if(empty($data['letterimage4'])){
                $data['err'] = 'Please upload NIC - back';
            } 

            if(empty($data['err'])){
                $_SESSION['letterimage1'] = $data['letterimage1'];
                $_SESSION['letterimage2'] = $data['letterimage2'];
                $_SESSION['letterimage3'] = $data['letterimage3'];
                $_SESSION['letterimage4'] = $data['letterimage4'];

                $this->userModel->studentRegister();

                redirect('Users/logout');
            }
            else{
                $this->view('users/studentRegistration/studentProfileCreation4', $data);
            }
        }


        $this->view('users/studentRegistration/studentProfileCreation4', $data);
    }

    //------------------------------------------------
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

}