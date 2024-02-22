<?php
class Necessity extends Controller {
    private $middleware;

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

    public function viewAdminMonetaryDonation(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/necessity/viewMonetaryDonation', $data);
    }

    public function adminGood(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/necessity/physicalGood', $data);
    }

    public function viewAdminGood(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/necessity/viewGood', $data);
    }

    public function viewAdminGoodDonation(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/necessity/viewGoodDonation', $data);
    }

    public function superAdminMonetary(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/necessity/monetary', $data);
    }

    public function viewSuperAdminMonetary(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/necessity/viewMonetary', $data);
    }

    public function viewSuperAdminMonetaryDonation(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/necessity/viewMonetaryDonation', $data);
    }

    public function superAdminGood(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('super admin/necessity/physicalGood', $data);
    }

    public function addmonetarynecessity(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'necessityMonetary' => trim($_POST['necessityMonetary']),
                'necessityType' => trim($_POST['necessityType']),
                'monetarynecessitydes' => trim($_POST['monetarynecessitydes']),
                'requestedamount' => trim($_POST['requestedamount']),
                'necessityMonetary_err' => '',
                'monetarynecessitydes_err' => '',
                'requestedamount_err' => ''
            ];

            //change the getting input according to necessity type
            if ($data['necessityType'] === 'recurring') {
                $data['recurringstartdate'] = trim($_POST['recurringstartdate']);
                $data['recurringenddate'] = trim($_POST['recurringenddate']);
            } else {
                $data['recurringstartdate'] = null;
                $data['recurringenddate'] = null;
            }


            //check wheather field are empty or not
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
                
            }

            if(empty($data['requestedamount'])){
                $data['requestedamount_err']='Please enter the Requested Amount';
            }

            print_r($_POST);

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