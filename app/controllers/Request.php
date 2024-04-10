<?php
class Request extends Controller {
    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only admins are allowed to access admin pages
        $this->middleware->checkAccess(['admin', 'superAdmin']);
    }

    public function adminStudentRequest(){
        $data = [
            'title' => 'Home page'
        ];
        
    }

    public function adminOrganizationRequest(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/request/organizationRequest', $data);
    }

    public function studentRequest(){
        $data = [
            'title' => 'Home page'
        ];

        if($_SESSION['user_type'] == 'admin') {
            $this->view('admin/request/studentRequest', $data);
        }

        else if($_SESSION['user_type'] == 'superAdmin') {
            $this->view('superAdmin/request/studentRequest', $data);
        }

        else {
            die('User Type Not Found');
        }
    }
    public function organizationRequest(){
        $data = [
            'title' => 'Home page'
        ];

        if($_SESSION['user_type'] == 'admin') {
            $this->view('admin/request/organizationRequest', $data);
        }

        else if($_SESSION['user_type'] == 'superAdmin') {
            $this->view('superAdmin/request/organizationRequest', $data);
        }

        else {
            die('User Type Not Found');
        }

        
    }

}