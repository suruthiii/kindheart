<?php
class Admin extends Controller {
    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only donors are allowed to access admin pages
        $this->middleware->checkAccess(['admin']);
    }

    public function index(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/index', $data);
    }

    public function necessity() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/necessity', $data);
    }

    public function project() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/project', $data);
    }

    public function scholarship() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/scholarship', $data);
    }

    public function benefaction() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/benefaction', $data);
    }

    public function successStory() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/successStory', $data);
    }

    public function user() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/user', $data);
    }

    public function request() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/request', $data);
    }

    public function report() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/report', $data);
    }

    public function complaint() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/complaint', $data);
    }

    public function logOut() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/logOut', $data);
    }
}