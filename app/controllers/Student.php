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



    public function successstory(){
        
        $data = [
            'title' => 'Home page',
            'successstories' => $this->studentModel->getSuccessStories()
        ];
        
        $this->view('student/successstory', $data);
    }

    public function imgUpload($file){
        $file_name = $_FILES[$file]['name'];
        $file_size = $_FILES[$file]['size'];
        $tmp_name = $_FILES[$file]['tmp_name'];
        $error = $_FILES[$file]['error'];

        if ($error === 0){
            $file_ex = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_ex_lc = strtolower($file_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($file_ex_lc, $allowed_exs)){
                // Move into ParkingPhotos folder
                $new_file_name = uniqid("IMG-", true).'.'.$file_ex_lc;
                $file_upload_path = PUBLICROOT.'/uploads/'.$new_file_name;

                move_uploaded_file($tmp_name, $file_upload_path);
                return $new_file_name;
            }

            else{
                $data['err'] = "You can't upload files of this type";
                return $data;
            }
        }
    }


    public function addSuccessStory(){  
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           
            $data = [
                'title' => trim($_POST['title']),
                'storyDescription' => trim($_POST['storyDescription']),
                'imagePath' => $this->imgUpload('image'),
                'err' => ''
            ];


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
                die('Something went wrong');
                $this->student($data);
            }
        }else{
            die('incorrect method!');
        }

        // Pass data to the view 
        $successStories = $this->studentModel->getSuccessStories();
         $this->view('student/successstory', $successStories); 
    }

    

    // public function about(){
    //     $users = $this->pagesModel->getUser();
    //     $data = [
    //         'users' => $users
    //     ];
    //     $this->view('about', $data);
    // }
    

    
   
    
    
    
}