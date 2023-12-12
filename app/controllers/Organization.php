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

    public function necessityRequest(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('organization/necessityRequest', $data);
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

    // public function about(){
    //     $users = $this->pagesModel->getUser();
    //     $data = [
    //         'users' => $users
    //     ];
    //     $this->view('about', $data);
    // }
}