<?php
class User extends Controller {
    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only admins are allowed to access admin pages
        // $this->middleware->checkAccess(['admin']);
    }

    public function adminStudent(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/user/student', $data);
    }

    public function adminOrganization(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/user/organization', $data);
    }

    public function adminDonor(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/user/donor', $data);
    }

    public function superAdminStudent(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/user/student', $data);
    }

    public function superAdminOrganization(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/user/organization', $data);
    }
}