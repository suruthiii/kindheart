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

    public function superAdminStudentRequest(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/request/studentRequest', $data);
    }

    public function superAdminOrganizationRequest(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/request/organizationRequest', $data);
    }

}