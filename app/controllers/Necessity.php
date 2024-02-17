<?php
define('FILTER_SANITIZE_STRING', 513);

class Necessity extends Controller {
    private $middleware;
    private $organizationModel;

    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only admins are allowed to access admin pages
        // $this->middleware->checkAccess(['admin']);
        $this->organizationModel=$this->model('organizationModel');
    }

    public function viewAdminNecessity(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/necessity/viewNecessity', $data);
    }

    public function viewAdminNecessityDonation(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/necessity/viewNecessityDonation', $data);
    }

    public function addingmonetarynecessity(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Validate the data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'necessityMonetary' => trim($_POST['necessityMonetary']),
                'necessityType' => trim($_POST['necessityType']),
                'recurringstartdate' => trim($_POST['recurringstartdate']),
                'recurringenddate' => trim($_POST['recurringenddate']),
                'monetarynecessitydes' => trim($_POST['monetarynecessitydes']),
                'requestedamount' => trim($_POST['requestedamount']),
                'necessityMonetary_err' => ''
            ];

            if(empty($data['necessityMonetary'])){
                $data['necessityMonetary_err']='Please enter the Necessity';
            }

        }else{
           
            $data = [
                'necessityMonetary' => '',
                'necessityType' => '',
                'recurringstartdate' => '',
                'recurringenddate' => '',
                'monetarynecessitydes' => '',
                'requestedamount' => '',
                'necessityMonetary_err' => ''
            ];
            
            $this->view('organization/addmonetarynecessity', $data);
            
        }
           
    }

}