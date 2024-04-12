<?php
class Organization extends Controller {
    private $middleware;
    private $organizationModel;

    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only organizations are allowed to access organization pages
        $this->middleware->checkAccess(['organization']);
        $this->organizationModel = $this->model('organizationModel');
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

    public function addmonetarynecessity(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('organization/addmonetarynecessity', $data);
    }

    public function viewOrganizationMonetarynecessity(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('organization/viewOrganizationMonetarynecessity', $data);
    }

    public function addgoodsnecessity(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('organization/addgoodsnecessity', $data);
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
}