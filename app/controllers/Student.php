<?php
class Student extends Controller {
    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only students are allowed to access student pages
        $this->middleware->checkAccess(['student']);
    }

    public function index(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('student/index', $data);
    }

    public function about(){
        $users = $this->pagesModel->getUser();
        $data = [
            'users' => $users
        ];
        $this->view('about', $data);
    }
}