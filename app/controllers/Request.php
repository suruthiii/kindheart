<?php
class Request extends Controller {
    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only admins are allowed to access admin pages
        // $this->middleware->checkAccess(['admin']);
    }

    public function adminStudentRequest(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/request/studentRequest', $data);
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
        $this->view('superAdmin/request/studentRequest', $data);
    }
    public function organizationRequest(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('superAdmin/request/organizationRequest', $data);
    }

}