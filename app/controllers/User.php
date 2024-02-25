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

    public function superAdminViewStudent(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/user/viewStudent', $data);
    }

    public function superAdminOrganization(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/user/organization', $data);
    }

    public function superAdminViewOrganization(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/user/viewOrganization', $data);
    }


    public function superAdminDonor(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/user/donor', $data);
    }
   public function superAdminViewDonor(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/user/viewDonor', $data);
    }
}