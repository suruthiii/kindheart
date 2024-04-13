<?php

class Necessity extends Controller {
    private $middleware;
    private $necessityModel;

    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only admins are allowed to access admin pages
        $this->middleware->checkAccess(['admin', 'superAdmin', 'student', 'organization', 'donor']);
        $this->necessityModel = $this->model('NecessityModel');
    }

    public function monetary(){
        if ($_SESSION['user_type'] == 'admin') {
            $data = [
                'pending' => $this->necessityModel->getAllPendingMonetaryNecessities(),
                'confirmed' => $this->necessityModel->getAllConfirmedMonetaryNecessities(),
                'ongoing' => $this->necessityModel->getAllOngoingMonetaryNecessities()
            ];

            $this->view('admin/necessity/monetary', $data);
        }

        else if ($_SESSION['user_type'] == 'superAdmin') {
            $data = [
                'pending' => $this->necessityModel->getAllPendingMonetaryNecessities(),
                'confirmed' => $this->necessityModel->getAllConfirmedMonetaryNecessities(),
                'ongoing' => $this->necessityModel->getAllOngoingMonetaryNecessities()
            ];

            $this->view('superAdmin/necessity/monetary', $data);
        }

        else if ($_SESSION['user_type'] == 'student') {
            $data = [
                'pendingtablerow' => $this->necessityModel->getaddedMonetaryNecessities()
            ];

            $this->view('student/necessity/postedmonetarynecessity', $data);
        }

        else if ($_SESSION['user_type'] == 'organization') {
            $data = [
                'pendingtablerow' => $this->necessityModel->getaddedMonetaryNecessities(),
                'completetablerow' => $this->necessityModel->getaddedCompletedMonetaryNecessities()
            ];

            $this->view('organization/postedmonetarynecessity', $data);
        }

        else if ($_SESSION['user_type'] == 'donor') {

        }
        
        else {
            die('User Type Not Found');
        }
    }

    public function physicalGood(){
        if ($_SESSION['user_type'] == 'admin') {
            $data = [
                'pending' => $this->necessityModel->getAllPendingPhysicalGoods(),
                'confirmed' => $this->necessityModel->getAllConfirmedPhysicalGoods()
            ];

            $this->view('admin/necessity/physicalgood', $data);
        }

        else if ($_SESSION['user_type'] == 'superAdmin') {
            $data = [
                'pending' => $this->necessityModel->getAllPendingPhysicalGoods(),
                'confirmed' => $this->necessityModel->getAllConfirmedPhysicalGoods()
            ];

            $this->view('superAdmin/necessity/physicalgood', $data);
        }

        else if ($_SESSION['user_type'] == 'student') {
            $data = [
                'pendingtablerow' => $this->necessityModel->getaddedGoodsNecessities()
            ];

            $this->view('student/necessity/postedphysicalgoodsnecessity', $data);
        }

        else if ($_SESSION['user_type'] == 'organization') {
            $data = [
                'pendingtablerow' => $this->necessityModel->getaddedGoodsNecessities(),
                'completetablerow' => $this->necessityModel->getaddedCompletedGoodsNecessities()
            ];

            $this->view('organization/postedphysicalgoodsnecessity', $data);
        }

        else if ($_SESSION['user_type'] == 'donor') {

        }
        
        else {
            die('User Type Not Found');
        }   
    }

    //Add monetary necessity
    public function addmonetarynecessity(){
        if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization') {
            redirect('pages/404');
        }

        else {
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
                    'recurringdate_err' => '',
                    'frequency_err' => ''
                ];

                //change the getting input according to necessity type
                if ($data['necessityType'] === 'recurring') {
                    $data['recurringstartdate'] = trim($_POST['recurringstartdate']);
                    $data['recurringenddate'] = trim($_POST['recurringenddate']);
                } else {
                    $data['recurringstartdate'] = null;
                    $data['recurringenddate'] = null;
                }

                if ($data['necessityType'] === 'recurring') {
                    $startDate = new DateTime($data['recurringstartdate']);
                    $endDate = new DateTime($data['recurringenddate']);
                    
                    // Calculate the difference in days
                    $dateDiff = $startDate->diff($endDate)->days;
                
                    if ($dateDiff < 7) {
                        $data['frequency_err'] = 'please enter dates at least have 7days difference';
                    } else {
                        $data['frequency'] = trim($_POST['frequency']);
                    }
                } elseif($data['necessityType'] === 'onetime' && !empty($data['necessityMonetary'])){
                    $data['frequency'] = null;
                }else {
                    $data['frequency'] = null;
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
                if(empty($data['necessityMonetary_err']) && empty($data['monetarynecessitydes_err']) && empty($data['requestedamount_err']) && empty($data['recurringstartdate_err']) && empty($data['recurringenddate_err']) && empty($data['recurringdate_err']) && empty($data['frequency_err'])){
                    if($this->necessityModel->addmonetarynecessitytodb($data)){
                        redirect('necessity/monetary');
                    }else{
                        error_log('Error: Failed to insert data into the database.');
                        die('something went wrong');
                    }
                }else{

                    if ($_SESSION['user_type'] == 'student') {
                        $this->view('student/necessity/addmonetarynecessity', $data);
                    }else if ($_SESSION['user_type'] == 'organization') {
                        $this->view('organization/addmonetarynecessity', $data);
                    }else {
                        die('User Type Not Found');
                    }
                    
                }

                //$this->view('organization/addmonetarynecessity', $data);

            }else{
                $data = [
                    'necessityMonetary' => '',
                    'necessityType' => '',
                    'recurringstartdate' => '',
                    'recurringenddate' => '',
                    'frequency' => '',
                    'monetarynecessitydes' => '',
                    'requestedamount' => '',
                    'necessityMonetary_err' => '',
                    'monetarynecessitydes_err' => '',
                    'requestedamount_err' => '',
                    'recurringstartdate_err' => '',
                    'recurringenddate_err' => '',
                    'recurringdate_err' => '',
                    'frequency_err' =>''
                ];

                if ($_SESSION['user_type'] == 'student') {
                    $this->view('student/necessity/addmonetarynecessity', $data);
                }else if ($_SESSION['user_type'] == 'organization') {
                    $this->view('organization/addmonetarynecessity', $data);
                }else {
                    die('User Type Not Found');
                }
            }

        }
    }    

    //Add Physical goods Necessity
    public function addGoodsNecessity(){
        if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization') {
            redirect('pages/404');
        }

        else {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'necessityCategory' => trim($_POST['necessityCategory']),
                    'requestedgoodsquantity' => trim($_POST['requestedgoodsquantity']),
                    'goodsnecessitydes' => trim($_POST['goodsnecessitydes']),
                    'neccessityitem' => trim($_POST['neccessityitem']),
                    'necessityCategory_err' => '',
                    'requestedgoodsquantity_err' => '',
                    'goodsnecessitydes_err' => '',
                    'neccessityitem_err' => ''
                ];

                //check wheather field are empty or not

                //necessity category field
                if(empty($data['necessityCategory'])){
                    $data['necessityCategory_err']='Please Select the Necessity Category';
                }

                //necessity item field
                if(empty($data['neccessityitem'])){
                    $data['neccessityitem_err']='Please make sure the appropriate need is entered in the appropriate category.';
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
                if(empty($data['necessityCategory_err']) && empty($data['neccessityitem_err']) && empty($data['requestedgoodsquantity_err']) && empty($data['goodsnecessitydes_err'])){
                    if($this->necessityModel->addgoodsnecessitytodb($data)){
                        redirect('necessity/physicalgood');
                    }else{
                        error_log('Error: Failed to insert data into the database.');
                        die('something went wrong');
                    }
                }else{

                    if ($_SESSION['user_type'] == 'student') {
                        $this->view('student/necessity/addmonetarynecessity', $data);
                    }else if ($_SESSION['user_type'] == 'organization') {
                        $this->view('organization/addgoodsnecessity', $data);
                    }else {
                        die('User Type Not Found');
                    }
                }

            }else{
                $data = [
                    'necessityCategory' => '',
                    'requestedgoodsquantity' => '',
                    'goodsnecessitydes' => '',
                    'neccessityitem' => '',
                    'necessityCategory_err' => '',
                    'requestedgoodsquantity_err' => '',
                    'goodsnecessitydes_err' => '',
                    'neccessityitem_err' => ''
                ];

                if ($_SESSION['user_type'] == 'student') {
                    $this->view('student/necessity/addmonetarynecessity', $data);
                }else if ($_SESSION['user_type'] == 'organization') {
                    $this->view('organization/addgoodsnecessity', $data);
                }else {
                    die('User Type Not Found');
                }
            }
        }
    } 
    
    // public function viewOrganizationMonetarynecessity(){
    //     $data = [
    //         'title' => 'Home page'
    //     ];
    //     $this->view('organization/viewOrganizationMonetarynecessity', $data);
    // }

    public function viewAdminMonetary(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/necessity/viewMonetary', $data);
    }

    public function viewPendingMonetarynecessity(){
        if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization') {
            redirect('pages/404');
        } else {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                if(isset($_POST['necessityID']) && !empty($_POST['necessityID'])) {
                    // Get 'necessityID' from POST data
                    $necessityID = trim($_POST['necessityID']);
    
                    // Get pending necessity details
                    $pendingNecessityDetails = $this->necessityModel->getPendingMonetaryNecessities($necessityID);
    
                    // Prepare data to pass to the view
                    $data = [
                        'necessityID' => $necessityID,
                        'pendingNecessityDetails' => $pendingNecessityDetails
                    ];
    
                    // Pass data to the view
                    $this->view('organization/necessity/viewOrganizationPendingMonetarynecessity', $data);
    
                } else {
                    // display an error message here
                    die('User Necessity is Not Found');
                }
    
            } else {
                // If it's not a POST request, prepare empty data and pass it to the view
                $data = [
                    'necessityID' => '',
                    'pendingNecessityDetails' => [] // Assuming this should be an array
                ];
                $this->view('organization/necessity/viewOrganizationPendingMonetarynecessity', $data);
            }
        }
    }
    

    public function viewAdminMonetaryDonation(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/necessity/viewMonetaryDonation', $data);
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

    public function manageMonetary($necessity_ID = null) {
        if(($_SESSION['user_type'] != 'admin' && $_SESSION['user_type'] != 'superAdmin') || empty($necessity_ID)) {
            redirect('pages/404');
        }

        else {
            $data = [
                'title' => 'Home Page'
                // 'necessity_details' => $this->necessityModel->getMonetaryDetails($necessity_ID),
                // 'comments' => $this->necessityModel->getAllComments($necessity_ID)
            ];

            $this->view($_SESSION['user_type'].'/necessity/managemonetary', $data);
        }
    }

    public function manageGood($necessity_ID = null) {
        if(($_SESSION['user_type'] != 'admin' && $_SESSION['user_type'] != 'superAdmin') || empty($necessity_ID)) {
            redirect('pages/404');
        }

        else {
            $data = [
                'title' => 'Home Page'
                // 'necessity_details' => $this->necessityModel->getMonetaryDetails($necessity_ID),
                // 'comments' => $this->necessityModel->getAllComments($necessity_ID)
            ];

            $this->view($_SESSION['user_type'].'/necessity/managegood', $data);
        }
    }

    public function addComment() {
        if(($_SESSION['user_type'] != 'admin' && $_SESSION['user_type'] != 'superAdmin')) {
            redirect('pages/404');
        }

        else {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = [
                    'comment' => trim($_POST['comment']),
                    'err' => ''
                ];

                if(empty($data['comment'])) {
                    $data['err'] = 'Please enter your comment';
                }

                else {
                    if($this->necessityModel->addComment($data)) {
                        // redirect('necessity/')
                    }
                }
            }
        }
    }
}