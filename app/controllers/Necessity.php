<?php
class Necessity extends Controller {
    private $middleware;

    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only admins are allowed to access admin pages
        $this->middleware->checkAccess(['admin', 'superAdmin', 'student', 'organization', 'donor']);
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
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'necessityMonetary' => trim($_POST['necessityMonetary']),
                'necessityType' => trim($_POST['necessityType']),
                'recurringstartdate' => trim($_POST['recurringstartdate']),
                'recurringenddate' => trim($_POST['recurringenddate']),
                'monetarynecessitydes' => trim($_POST['monetarynecessitydes']),
                'requestedamount' => trim($_POST['requestedamount']),
                'necessityMonetary_err' => '',
                'monetarynecessitydes_err' => '',
                'requestedamount_err' => '',
                'recurringstartdate_err' => '',
                'recurringenddate_err' => ''

            ];

            if(empty($data['necessityMonetary'])){
                $data['necessityMonetary_err']='Please enter the Necessity about Monetary';
            }

            if(empty($data['monetarynecessitydes'])){
                $data['monetarynecessitydes_err']='Please enter the Description about Requested Necessity';
            }

            if($data['necessityType']== 'recurring'){
                if(empty($data['recurringstartdate'])){
                    $data['recurringstartdate_err']='Please enter the Recurring Start Date';
                }

                if(empty($data['recurringenddate'])){
                    $data['recurringenddate_err']='Please enter the Recurring End Date';
                }   
            }elseif($data['necessityType']== 'onetime'){
                
            }

            if(empty($data['requestedamount'])){
                $data['requestedamount_err']='Please enter the Requested Amount';
            }

            $this->view('organization/addmonetarynecessity', $data);

        }else{
            $data = [
                'necessityMonetary' => '',
                'necessityType' => '',
                'recurringstartdate' => '',
                'recurringenddate' => '',
                'monetarynecessitydes' => '',
                'requestedamount' => '',
                'necessityMonetary_err' => '',
                'monetarynecessitydes_err' => '',
                'requestedamount_err' => '',
                'recurringstartdate_err' => '',
                'recurringenddate_err' => ''
            ];

            $this->view('organization/addmonetarynecessity', $data);
        }

    }

}