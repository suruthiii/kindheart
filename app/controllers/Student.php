<?php

class Student extends Controller {
    private $middleware;

    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only students are allowed to access student pages
        $this->middleware->checkAccess(['student']);
        $this->studentModel = $this->model('StudentModel');
        $this->successStoryModel = $this->model('SuccessStoryModel');
    }

    public function index(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('student/index', $data);
    }

    // public function necessityRequest(){
    //     $data = [
    //         'title' => 'Home page'
    //     ];
    //     $this->view('student/necessityRequest', $data);
    // }

    // public function monetoryfundingRequest(){
    //     $data = [
    //         'title' => 'Home page'
    //     ];
    //     $this->view('student/monetoryfundingRequest', $data);
    // }

    // public function physicalgoodsRequest(){
    //     $data = [
    //         'title' => 'Home page'
    //     ];
    //     $this->view('student/physicalgoodsRequest', $data);
    // }

    public function necessities(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('student/necessities', $data);
    }

    // public function editStory(){
    //     $data = [
    //         'title' => 'Home page'
    //     ];
    //     $this->view('student/editStory', $data);
    // }

    public function successstory(){
        
        $data = [
            'title' => 'Home page',
            'successstories' => $this->successStoryModel->getSuccessStories()
        ];
        
        $this->view('student/successstory', $data);
    }


    
    
}