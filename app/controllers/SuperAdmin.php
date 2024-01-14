<?php

class SuperAdmin extends Controller {
    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only super admin is allowed to access superadmin pages
        $this->middleware->checkAccess(['superAdmin']);
        $this->userModel = $this->model('UserModel');
    }

    public function index(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/index', $data);
    }

    public function admin($other_data = null){
        $data = [
            'title' => 'Home page',
            'admins' => $this->userModel->viewAdmins()
        ];

        $this->view('super admin/admin', $data, $other_data);
    }

    public function necessity() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/necessity', $data);
    }

    public function project() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/project', $data);
    }

    public function scholarship() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/scholarship', $data);
    }

    public function benefaction() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/benefaction', $data);
    }

    public function successStory(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/successStory', $data);
    }

    public function user(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/user', $data);
    }

    public function request() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/request', $data);
    }

    public function report() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/report', $data);
    }


    public function complaint(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/complaint', $data);
    }

    public function createAdmin(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'user_type' => 'admin',
                'err' => ''
            ];

            // Validate username
            if (empty($data['username'])) {
                $data['err'] = 'Please enter username';
            } else {
                // Check if username exists
                if ($this->userModel->findUserByUsername($data['username'])) {
                    $data['err'] = 'Username is already taken';
                }
            }

            // Validate name
            if (empty($data['name'])) {
                $data['err'] = 'Please enter name';
            }

            // Validate email
            if (empty($data['email'])) {
                $data['err'] = 'Please enter email';
            } else {
                // Check if email exists
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['err'] = 'Email is already taken';
                }
            }

            // Validate password
            if (empty($data['password'])) {
                $data['err'] = 'Please enter password';
            } elseif (strlen($data['password']) < 6) {
                $data['err'] = 'Password must be at least 6 characters';
            }

            // Validate confirm password
            if (empty($data['confirm_password'])) {
                $data['err'] = 'Please confirm password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['err'] = 'Passwords do not match';
                }
            }

            // die(print_r($data));

            // Make sure errors are empty
            if (empty($data['err'])) {
                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // die(print_r($data));
                // Register user
                if ($this->userModel->register($data)) {
                    redirect('superadmin/admin');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->admin($data);
            }
        }
    }

}    