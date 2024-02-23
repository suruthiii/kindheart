<?php

class Student extends Controller {
    private $middleware;

    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only students are allowed to access student pages
        $this->middleware->checkAccess(['student']);
        $this->studentModel = $this->model('StudentModel');
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

    public function neccessities(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('student/neccessities', $data);
    }

    public function successstory(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('student/successstory', $data);
    }

  

    public function addSuccessStory(){  
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $data = [
                'title' => trim($_POST['title']),
                // 'storyDescription' => trim($_POST['storyDescription']),
                'err' => ''
            ];

            // die('hello');


            // Validate name
            // if (empty($data['name'])) {
            //     $data['err'] = 'Please enter a name';
            // } 

            // // Validate success story
            // if (empty($data['storyDescription']) && empty($data['err'])) {
            //     $data['err'] = 'Please enter the story';
            // }


            // Make sure errors are empty
            if (empty($data['err'])) {
                // die(print_r($data));
            
                // Add Data to DB
                if ($this->studentModel->addSuccessStory($data)) {
                    redirect('student/successstory');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                die('2Something went wrong');
                $this->student($data);
            }
        }else{
            die('incorrect method!');
        }
    }

    public function postedmonetarynecessity(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('student/necessity/postedmonetarynecessity', $data);
    }

    public function postedphysicalgoodsnecessity(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('student/necessity/postedphysicalgoodsnecessity', $data);
    }


    public function  addmonetarynecessity(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('student/necessity/addmonetarynecessity', $data);
    }

    public function addgoodsnecessity(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('student/necessity/addgoodsnecessity', $data);
    }

    // public function about(){
    //     $users = $this->pagesModel->getUser();
    //     $data = [
    //         'users' => $users
    //     ];
    //     $this->view('about', $data);
    // }
    

    
   
    
    
    
}