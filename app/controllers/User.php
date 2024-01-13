<?php
class User extends Controller {
    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only admins are allowed to access admin pages
        // $this->middleware->checkAccess(['admin']);
    }

    public function viewStudent(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/user/viewStudent', $data);
    }

    public function viewOrganization(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/user/viewOrganization', $data);
    }

    public function viewDonor(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/user/viewDonor', $data);
    }
}