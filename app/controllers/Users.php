<?php
class Users extends Controller{
    public function __construct(){
        $this->userModel = $this->model('UserModel');
    }

    public function home(){
        $this->view('users/index');
    }

    public function registerLanding(){
        $this->view('users/registerLanding');
    }

    public function forgetPassword1(){
        $this->view('users/forgetPassword1');
    }

    public function forgetPassword2(){
        $this->view('users/forgetPassword2');
    }

    public function passwordResetSuccessful(){
        $this->view('users/passwordResetSuccessful');
    }

    public function studentRegistration(){
        $this->view('users/studentRegistration');
    }

    public function setPassword(){
        $this->view('users/setPassword');
    }
    
    public function accountCreationSuccessful(){
        $this->view('users/accountCreationSuccessful');
    }

    public function organizationRegistration(){
        $this->view('users/organizationRegistration');
    }

    public function donorRegistration(){
        $this->view('users/donorRegistration');
    }

    public function studentCreatingProfile1(){
        $this->view('users/studentCreatingProfile1');
    }

    public function studentOrganizationCreatingProfile2(){
        $this->view('users/studentOrganizationCreatingProfile2');
    }

    public function studentCreatingProfile3(){
        $this->view('users/studentCreatingProfile3');
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

    public function login(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Form is submitting
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Input data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'remember_me' => isset($_POST['remember_me']),
                'err' => ''
            ];

            // Validate data
            // Validate email
            if (empty($data['email'])){
                $data['err'] = 'Please enter email';
            }
            else{
                if ($this->userModel->findUserByEmail($data['email'])){
                    // User found
                }
                else{
                    // User not found
                    $data['err'] = 'No user found';
                }
            }

            // Validate password
            if (empty($data['password'])){
                $data['err'] = 'Please enter password';
            }

            // Check if error is empty
            if (empty($data['err'])){
                // log the user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
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
            // Initial form load
            $data = [
                'email' => '',
                'password' => '',
                'err' => ''
            ];

            // Load view
            $this->view('users/login', $data);
        }
    }

    // Create the session
    public function createUserSession($user){
        // die(print_r($user));
        $_SESSION['user_id'] = $user->userID;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->username;
        $_SESSION['user_type'] = $user->userType;

        // die(print_r($_SESSION));

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