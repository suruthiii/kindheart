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

}    