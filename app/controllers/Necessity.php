<?php


class Necessity extends Controller {
    private $middleware;
    private $organizationModel;

    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only admins are allowed to access admin pages
        $this->middleware->checkAccess(['admin', 'superAdmin', 'student', 'organization', 'donor']);
        $this->organizationModel = $this->model('organizationModel');
    }

    // public function monetary(){
    //     $data = [
    //         'title' => 'Home page'
    //     ];

    //     $userType = $_SESSION['user_type'];

    //     if($userType == 'admin') {
    //         $this->view('admin/necessity/monetary', $data);
    //     }

    //     else if($userType == 'superAdmin') {
    //         $this->view('superAdmin/necessity/monetary', $data);
    //     }

    //     else if($userType == 'student') {
    //         $this->view('student/necessity/monetary', $data);
    //     }

    //     else if($userType == 'organization') {
    //         $this->view('organization/necessity/monetary', $data);
    //     }

    //     else if($userType == 'donor') {
    //         $this->view('donor/necessity/monetary', $data);
    //     }

    //     else {
    //         die('User Type Not Found');
    //     }
    // }

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
        $this->view('superAdmin/necessity/monetary', $data);
    }

    public function viewSuperAdminMonetary(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('superAdmin/necessity/viewMonetary', $data);
    }

    public function viewSuperAdminMonetaryDonation(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('superAdmin/necessity/viewMonetaryDonation', $data);
    }

    public function superAdminGood(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('superAdmin/necessity/physicalGood', $data);
    }

    public function viewSuperAdminGood(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('superAdmin/necessity/viewGood', $data);
    }

    public function viewSuperAdminGoodDonation(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('superAdmin/necessity/viewGoodDonation', $data);
    }

    //Add monetary necessity
    public function addingmonetarynecessity(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'necessityMonetary' => trim($_POST['necessityMonetary']),
                'necessityType' => trim($_POST['necessityType']),
                'monetarynecessitydes' => trim($_POST['monetarynecessitydes']),
                'requestedamount' => trim($_POST['requestedamount']),
                'necessityMonetary_err' => '',
                'monetarynecessitydes_err' => '',
                'requestedamount_err' => '',
                'recurringdate_err' => ''
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

            //necessity field
            if(empty($data['necessityMonetary'])){
                $data['necessityMonetary_err']='Please enter the Necessity about Monetary';
            }

            //necessity description field
            if(empty($data['monetarynecessitydes'])){
                $data['monetarynecessitydes_err']='Please enter the Description about Requested Necessity';
            }

            //necessity type field
            if($data['necessityType']== 'recurring'){
                if(empty($data['recurringstartdate'])){
                    $data['recurringstartdate_err']='Please enter the Recurring Start Date';
                }

                if(empty($data['recurringenddate'])){
                    $data['recurringenddate_err']='Please enter the Recurring End Date';
                }  
            }

            //recurring start and end date check
            if($data['recurringstartdate'] > $data['recurringenddate']){
                $data['recurringdate_err']="Please give a valid dates.";
            }

            //necessity requested amount field
            if(empty($data['requestedamount'])){
                $data['requestedamount_err']='Please enter the Requested Amount';
            }elseif($data['requestedamount']<0){// check the validity of inserted value
                $data['requestedamount_err']='Please enter Valid Amount';
            }

            //check whether there any errors
            if(empty($data['necessityMonetary_err']) && empty($data['monetarynecessitydes_err']) && empty($data['requestedamount_err']) && empty($data['recurringstartdate_err']) && empty($data['recurringenddate_err']) && empty($data['recurringdate_err'])){
                if($this->organizationModel->addmonetarynecessitytodb($data)){
                    redirect('organization/postedmonetarynecessity');
                }else{
                    error_log('Error: Failed to insert data into the database.');
                    die('something went wrong');
                }
            }else{
                $this->view('organization/addmonetarynecessity', $data);
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
                'recurringenddate_err' => '',
                'recurringdate_err' => ''
            ];

            $this->view('organization/addmonetarynecessity', $data);
        }

    }

    


    //Add Physcicall goods Necessity
    public function addingGoodsNecessity(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'necessitygoods' => trim($_POST['necessitygoods']),
                'requestedgoodsquantity' => trim($_POST['requestedgoodsquantity']),
                'goodsnecessitydes' => trim($_POST['goodsnecessitydes']),
                'necessitygoods_err' => '',
                'requestedgoodsquantity_err' => '',
                'goodsnecessitydes_err' => ''
            ];

            //check wheather field are empty or not

            //necessity good field
            if(empty($data['necessitygoods'])){
                $data['necessitygoods_err']='Please enter the Necessity about Goods';
            }

            //requested goods quantity
            if(empty($data['requestedgoodsquantity'])){
                $data['requestedgoodsquantity_err']='Please enter the Quantity of Goods wants';
            }elseif($data['requestedgoodsquantity']<0){
                $data['requestedgoodsquantity_err']='Please enter Valid number for quantity of goods';
            }

            //necessity decsription about necessity
            if(empty($data['goodsnecessitydes'])){
                $data['goodsnecessitydes_err']='Please enter the description about the necessity';
            }

            //check whether there any errors
            if(empty($data['necessitygoods_err']) && empty($data['requestedgoodsquantity_err']) && empty($data['goodsnecessitydes_err'])){
                if($this->organizationModel->addgoodsnecessitytodb($data)){
                    redirect('organization/postedphysicalgoodsnecessity');
                }else{
                    error_log('Error: Failed to insert data into the database.');
                    die('something went wrong');
                }
            }else{
                $this->view('organization/addmonetarynecessity', $data);
            }


            $this->view('organization/addgoodsnecessity', $data);

        }else{
            $data = [
                'necessitygoods' => '',
                'requestedgoodsquantity' => '',
                'goodsnecessitydes' => '',
                'necessitygoods_err' => '',
                'requestedgoodsquantity_err' => '',
                'goodsnecessitydes_err' => ''
            ];

            $this->view('organization/addgoodsnecessity', $data);

        }
    }

    

}