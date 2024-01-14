<?php

class SuperAdmin extends Controller {
    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only super admin is allowed to access superadmin pages
        $this->middleware->checkAccess(['superAdmin']);
    }

    public function index(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/index', $data);
    }

    public function admin(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/admin', $data);
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
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/complaint', $data);
    }

}    