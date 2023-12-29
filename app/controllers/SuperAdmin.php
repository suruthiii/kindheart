<?php

class SuperAdmin extends Controller {
    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only admins are allowed to access admin pages
        $this->middleware->checkAccess(['super_admin']);
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

    public function successStory(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/successStory', $data);
    }

    public function complaint(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/complaint', $data);
    }

    public function logOut(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/logOut', $data);
    }

}    