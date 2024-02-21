<?php
class Necessity extends Controller {
    private $middleware;
    private $data;

    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only admins are allowed to access admin pages
        $this->middleware->checkAccess(['admin', 'superAdmin', 'student', 'organization', 'donor']);
    }

    public function adminMonetary(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/necessity/monetary', $data);
    }

    public function viewAdminMonetary(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/necessity/viewMonetary', $data);
    }

    public function viewAdminNecessityDonation(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/necessity/viewNecessityDonation', $data);
    }

    public function addmonetarynecessity(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // $data = [
            //     'necessityMonetary' => $_POST['necessityMonetary'] ?? '',
            //     'necessityType' => $_POST['necessityType'] ?? '',
            //     'recurringstartdate' => $_POST['recurringstartdate'] ?? '',
            //     'recurringenddate' => $_POST['recurringenddate'] ?? '',
            //     'monetarynecessitydes' => $_POST['monetarynecessitydes'] ?? '',
            //     'requestedamount' => $_POST['requestedamount'] ?? '',
            // ];
        }else{
            $data = [
                'necessityMonetary' => '',
                'necessityType' => '',
                'recurringstartdate' => '',
                'recurringenddate' => '',
                'monetarynecessitydes' => '',
                'requestedamount' => '',
            ];

            $this->view('organization/addmonetarynecessity', $data);
        }

    }

}