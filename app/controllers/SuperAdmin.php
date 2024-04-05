<?php

class SuperAdmin extends Controller {
    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only superAdmin is allowed to access superadmin pages
        $this->middleware->checkAccess(['superAdmin']);
        $this->userModel = $this->model('UserModel');
    }

    public function index(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('superAdmin/index', $data);
    }

    public function admin($other_data = null){
        $data = [
            'title' => 'Home page',
            'admins' => $this->userModel->viewAdmins()
        ];

        $this->view('superAdmin/admin', $data, $other_data);
    }

    public function necessity() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('superAdmin/necessity', $data);
    }

    public function project() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('superAdmin/project', $data);
    }

    public function scholarship() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('superAdmin/scholarship', $data);
    }

    public function benefaction() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('superAdmin/benefaction', $data);
    }

    public function successStory(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('superAdmin/successStory', $data);
    }

    public function user(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('superAdmin/user', $data);
    }

    public function request() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('superAdmin/request', $data);
    }

    public function report() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('superAdmin/report', $data);
    }

    public function complaint(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('superAdmin/complaint', $data);
    }

    public function createAdmin(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $data = [
                'username' => trim($_POST['username']),
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'userType' => 'admin',
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
            if (empty($data['name']) && empty($data['err'])) {
                $data['err'] = 'Please enter name';
            }

            // Validate email
            if (empty($data['email']) && empty($data['err'])) {
                $data['err'] = 'Please enter email';
            } else {
                // Check if email exists
                if (empty($data['err']) && $this->userModel->findUserByEmail($data['email'])) {
                    $data['err'] = 'Email is already taken';
                }
            }

            // Validate password
            if (empty($data['password']) && empty($data['err'])) {
                $data['err'] = 'Please enter password';
            } else if (strlen($data['password']) < 6) {
                $data['err'] = 'Password must be at least 6 characters';
            }

            // Validate confirm password
            if (empty($data['confirmPassword']) && empty($data['err'])) {
                $data['err'] = 'Please confirm password';
            } else {
                if (empty($data['err']) && $data['password'] != $data['confirmPassword']) {
                    $data['err'] = 'Passwords do not match';
                }
            }

            // Make sure errors are empty
            if (empty($data['err'])) {
                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

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

    public function viewAdmin($admin_ID = null) {
        if (empty($admin_ID)) {
            redirect('pages/404');
        }

        $data = [
            'title' => 'View Admin',
            'admin_details' => $this->userModel->getAdmin($admin_ID)
        ];

        $this->view('superAdmin/admin/viewAdmin', $data);
    }

    public function editAdmin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'name' => trim($_POST['name']),
                'user_id' => trim($_POST['user_ID']),
                'old_username' => trim($_POST['old_username']),
                'err' => ''
            ];

            // Validate username
            if (empty($data['username'])) {
                $data['err'] = 'Please enter username';
            } else {
                // Check if username exists
                if ($data['username'] != $data['old_username'] && $this->userModel->findUserByUsername($data['username'])) {
                    $data['err'] = 'Username is already taken';
                }
            }

            // Validate name
            if (empty($data['name']) && empty($data['err'])) {
                $data['err'] = 'Please enter name';
            }

            // Make sure errors are empty
            if (empty($data['err'])) {

                if ($this->userModel->updateAdmin($data)) {
                    redirect('superadmin/editAdmin?admin_ID='.$data['user_id']);
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $backend_data = $this->userModel->getAdmin($data['user_id']);

                $admin_data = [
                    'title' => 'Edit Admin',
                    'admin_details' => [
                        'adminID' => $backend_data->adminID,
                        'adminName' => $backend_data->adminName, 
                        'email' => $backend_data->email,
                        'username' => $backend_data->username
                    ],
                    'err' => $data['err']
                ];
                
                $this->view('superAdmin/admin/editAdmin', $admin_data);
            }
        }
        else{
            if (empty($_GET['admin_ID'])) {
                redirect('pages/404');
            }

            $admin_details = $this->userModel->getAdmin($_GET['admin_ID']);
    
            $data = [
                'title' => 'Edit Admin',
                'admin_details' => [
                    'adminID' => $admin_details->adminID,
                    'adminName' => $admin_details->adminName, 
                    'email' => $admin_details->email,
                    'username' => $admin_details->username
                ]
            ];
    
            $this->view('superAdmin/admin/editAdmin', $data);
        }
    }

    public function deleteAdmin() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->userModel->deleteUser($_POST['admin_ID']);

           redirect('superadmin/admin');      
        }
    }
    
    public function banAdmin() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            if($this->userModel->banUser($_POST['admin_ID'])) {
                redirect('superadmin/admin');
            }
            
            else {
                die('User Not Found');
            }       
        }
    }

    
}   