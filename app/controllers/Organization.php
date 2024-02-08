<?php
class Organization extends Controller {
    private $middleware;

    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only organizations are allowed to access organization pages
        $this->middleware->checkAccess(['organization']);
    }

    public function index(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('organization/index', $data);
    }

    public function choosethenecessityType(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('organization/choosethenecessityType', $data);
    }

    public function monetoryfundingRequest(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('organization/monetoryfundingRequest', $data);
    }

    public function physicalgoodsRequest(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('organization/physicalgoodsRequest', $data);
    }

    public function postednecessities(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('organization/postednecessities', $data);
    }

    public function editprofile(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('organization/editprofile', $data);
    }

    public function addProject(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('organization/addProject', $data);
    }

    public function successstory(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('organization/successstory', $data);
    }

    public function complaint(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('organization/complaint', $data);
    }

    public function viewdonors(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('organization/viewdonors', $data);
    }


    // public function about(){
    //     $users = $this->pagesModel->getUser();
    //     $data = [
    //         'users' => $users
    //     ];
    //     $this->view('about', $data);
    // }
}