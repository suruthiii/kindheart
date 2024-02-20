<?php
class Student extends Controller {
    private $middleware;

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

    public function necessityRequest(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('student/necessityRequest', $data);
    }

    public function monetoryfundingRequest(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('student/monetoryfundingRequest', $data);
    }

    public function physicalgoodsRequest(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('student/physicalgoodsRequest', $data);
    }

    public function choosethenecessityType(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('student/choosethenecessityType', $data);
    }

    public function successstory(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('student/successstory', $data);
    }

    public function postedmonetarynecessity(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('student/necessity/postedmonetarynecessity', $data);
    }

    // public function about(){
    //     $users = $this->pagesModel->getUser();
    //     $data = [
    //         'users' => $users
    //     ];
    //     $this->view('about', $data);
    // }
    
    
    
}