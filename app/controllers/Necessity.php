<?php

class Necessity extends Controller {
    private $middleware;
    private $necessityModel;
    private $userModel;
    private $notificationModel;

    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only admins are allowed to access admin pages
        $this->middleware->checkAccess(['admin', 'superAdmin', 'student', 'organization', 'donor']);
        $this->necessityModel = $this->model('NecessityModel');
        $this->userModel = $this->model('UserModel');
        $this->notificationModel = $this->model('NotificationModel');
    }

    public function monetary(){
        if ($_SESSION['user_type'] == 'admin') {
            $data = [
                'pending' => $this->necessityModel->getAllPendingMonetaryNecessities(),
                'confirmed' => $this->necessityModel->getAllConfirmedMonetaryNecessities(),
                'ongoing' => $this->necessityModel->getAllOngoingMonetaryNecessities()
            ];

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view('admin/necessity/monetary', $data, $other_data);
        }

        else if ($_SESSION['user_type'] == 'superAdmin') {
            $data = [
                'pending' => $this->necessityModel->getAllPendingMonetaryNecessities(),
                'confirmed' => $this->necessityModel->getAllConfirmedMonetaryNecessities(),
                'ongoing' => $this->necessityModel->getAllOngoingMonetaryNecessities()
            ];

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view('superAdmin/necessity/monetary', $data, $other_data);
        }

        else if ($_SESSION['user_type'] == 'student') {
            $data = [
                'pendingtablerow' => $this->necessityModel->getaddedMonetaryNecessities()
            ];

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view('student/necessity/postedmonetarynecessity', $data, $other_data);
        }

        else if ($_SESSION['user_type'] == 'organization') {
            $data = [
                'pendingtablerow' => $this->necessityModel->getaddedMonetaryNecessities(),
                'completetablerow' => $this->necessityModel->getaddedCompletedMonetaryNecessities(),
                'stillnotCompleted' => $this->necessityModel->stilnotcompleteNecessities(),
                'totalReceivedAmount' => $this->necessityModel->getTotalReceivedAmount()
            ];

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view('organization/postedmonetarynecessity', $data, $other_data);

        }

        else if ($_SESSION['user_type'] == 'donor') {

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];
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

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view('admin/necessity/physicalgood', $data, $other_data);
        }

        else if ($_SESSION['user_type'] == 'superAdmin') {
            $data = [
                'pending' => $this->necessityModel->getAllPendingPhysicalGoods(),
                'confirmed' => $this->necessityModel->getAllConfirmedPhysicalGoods()
            ];

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view('superAdmin/necessity/physicalgood', $data, $other_data);
        }

        else if ($_SESSION['user_type'] == 'student') {
            $data = [
                'pendingtablerow' => $this->necessityModel->getaddedGoodsNecessities()
            ];

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view('student/necessity/postedphysicalgoodsnecessity', $data, $other_data);
        }

        else if ($_SESSION['user_type'] == 'organization') {
            $data = [
                'pendingtablerow' => $this->necessityModel->getaddedGoodsNecessities(),
                'completetablerow' => $this->necessityModel->getaddedCompletedGoodsNecessities(),
                'totalReceivedQuantity' => $this->necessityModel->getTotalReceivedQuantity()
            ];

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view('organization/postedphysicalgoodsnecessity', $data, $other_data);
        }

        else if ($_SESSION['user_type'] == 'donor') {
            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];
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
                    'necessityMonetary_err' => '',
                    'monetarynecessitydes_err' => '',
                    'requestedamount_err' => '',
                    'recurringdate_err' => '',
                ];

                //change the getting input according to necessity type
                if ($data['necessityType'] === 'recurring') {
                    $data['recurringstartdate'] = trim($_POST['recurringstartdate']);
                    $data['donationduration'] = trim($_POST['donationduration']);
                    $data['monthlyrequestedamount'] = trim($_POST['monthlyrequestedamount']);
                    $data['requestedamount'] = null;
                } else if ($data['necessityType'] === 'onetime'){
                    $data['requestedamount'] = trim($_POST['requestedamount']);
                    $data['recurringstartdate'] = null;
                    $data['donationduration'] = null;
                    $data['monthlyrequestedamount'] = null;
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

                    if(empty($data['donationduration'])){
                        $data['donationduration_err']='Please enter the time duration';
                    }

                    if(empty($data['monthlyrequestedamount'])){
                        $data['monthlyrequestedamount_err']='Please Monthly requested amount';
                    }elseif ($data['monthlyrequestedamount']<25) {
                        $data['monthlyrequestedamount_err']='Please enter Valid Amount';
                    }
                }else if($data['necessityType']== 'onetime'){
                    //necessity requested amount field
                    if(empty($data['requestedamount'])){
                        $data['requestedamount_err']='Please enter the Requested Amount';
                    }elseif($data['requestedamount']<25){// check the validity of inserted value
                        $data['requestedamount_err']='Please enter Valid Amount';
                    }
                }

                //check whether there any errors
                if(empty($data['necessityMonetary_err']) && empty($data['monetarynecessitydes_err']) && empty($data['requestedamount_err']) && empty($data['recurringstartdate_err']) && empty($data['donationduration_err']) && empty($data['monthlyrequestedamount_err'])){
                    if($this->necessityModel->addmonetarynecessitytodb($data)){
                        redirect('necessity/monetary');
                    }else{
                        error_log('Error: Failed to insert data into the database.');
                        die('something went wrong');
                    }
                }else{
                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];

                    if ($_SESSION['user_type'] == 'student') {
                        $this->view('student/necessity/addmonetarynecessity', $data, $other_data);
                    }else if ($_SESSION['user_type'] == 'organization') {
                        $this->view('organization/addmonetarynecessity', $data, $other_data);
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
                    'donationduration' => '',
                    'monetarynecessitydes' => '',
                    'requestedamount' => '',
                    'monthlyrequestedamount' => '',
                    'necessityMonetary_err' => '',
                    'monetarynecessitydes_err' => '',
                    'requestedamount_err' => '',
                    'recurringstartdate_err' => '',
                    'monthlyrequestedamount_err' => ''
                ];

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];

                if ($_SESSION['user_type'] == 'student') {
                    $this->view('student/necessity/addmonetarynecessity', $data, $other_data);
                }else if ($_SESSION['user_type'] == 'organization') {
                    $this->view('organization/addmonetarynecessity', $data, $other_data);
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

                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];

                    if ($_SESSION['user_type'] == 'student') {
                        $this->view('student/necessity/addmonetarynecessity', $data, $other_data);
                    }else if ($_SESSION['user_type'] == 'organization') {
                        $this->view('organization/addgoodsnecessity', $data, $other_data);
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

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];

                if ($_SESSION['user_type'] == 'student') {
                    $this->view('student/necessity/addmonetarynecessity', $data, $other_data);
                }else if ($_SESSION['user_type'] == 'organization') {
                    $this->view('organization/addgoodsnecessity', $data, $other_data);
                }else {
                    die('User Type Not Found');
                }
            }
        }
    } 

    // View pending necessity's further information
    public function viewPendingMonetarynecessity(){
        if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization' && $_SESSION['user_type'] != 'donor') {
            redirect('pages/404');
        } else {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                if(isset($_POST['necessityID']) && !empty($_POST['necessityID'])) {
                    // Get 'necessityID' from POST data
                    $necessityID = trim($_POST['necessityID']);
    
                    // Get pending necessity details
                    $pendingNecessityDetails = $this->necessityModel->getPendingMonetaryNecessities($necessityID);
                    $donorswhodonated = $this->necessityModel->getDonorsWhoDonatedForThisNecessity($necessityID);
    
                    // Prepare data to pass to the view
                    $data = [
                        'necessityID' => $necessityID,
                        'pendingNecessityDetails' => $pendingNecessityDetails,
                        'donorswhodonated' => $donorswhodonated
                    ];

                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];
    
                    // Pass data to the view
                    if ($_SESSION['user_type'] == 'student') {

                    }else if ($_SESSION['user_type'] == 'organization') {
                        $this->view('organization/necessity/viewOrganizationPendingMonetarynecessity', $data, $other_data);
                    }else {
                        die('User Type Not Found');
                    }
    
                } else {
                    // display an error message here
                    die('User Necessity is Not Found');
                }
    
            } else {
                // If it's not a POST request, then empty data pass to the view
                $data = [
                    'necessityID' => '',
                    'pendingNecessityDetails' => [] // this is an array
                ];

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];
                
                // Pass data to the view
                if ($_SESSION['user_type'] == 'student') {

                }else if ($_SESSION['user_type'] == 'organization') {
                    $this->view('organization/necessity/viewOrganizationPendingMonetarynecessity', $data, $other_data);
                }else {
                    die('User Type Not Found');
                }
            }
        }
    }

    //view completed Monetary necessity's further information
    public function viewCompletedMonetarynecessity(){
        if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization' && $_SESSION['user_type'] != 'donor') {
            redirect('pages/404');
        } else {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                if(isset($_POST['necessityID']) && !empty($_POST['necessityID'])) {
                    // Get 'necessityID' from POST data
                    $necessityID = trim($_POST['necessityID']);
    
                    // Get pending necessity details
                    $pendingNecessityDetails = $this->necessityModel->getCompletedMonetaryNecessities($necessityID);
    
                    // Prepare data to pass to the view
                    $data = [
                        'necessityID' => $necessityID,
                        'pendingNecessityDetails' => $pendingNecessityDetails
                    ];

                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];
    
                    // Pass data to the view
                    if ($_SESSION['user_type'] == 'student') {

                    }else if ($_SESSION['user_type'] == 'organization') {
                        $this->view('organization/necessity/viewOrganizationCompletedMonetarynecessity', $data, $other_data);
                    }else {
                        die('User Type Not Found');
                    }
    
                } else {
                    // display an error message here
                    die('User Necessity is Not Found');
                }
    
            } else {
                // If it's not a POST request, then empty data pass to the view
                $data = [
                    'necessityID' => '',
                    'pendingNecessityDetails' => [] // this is an array
                ];
                
                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];

                // Pass data to the view
                if ($_SESSION['user_type'] == 'student') {

                }else if ($_SESSION['user_type'] == 'organization') {
                    $this->view('organization/necessity/viewOrganizationCompletedMonetarynecessity', $data, $other_data);
                }else {
                    die('User Type Not Found');
                }
            }
        }
    }

    // to view start donations
    public function ViewdonationstartNecessity(){
        if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization' && $_SESSION['user_type'] != 'donor') {
            redirect('pages/404');
        } else {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                if(isset($_POST['necessityID']) && !empty($_POST['necessityID'])) {
                    // Get 'necessityID' from POST data
                    $necessityID = trim($_POST['necessityID']);
    
                    // Get pending necessity details
                    $pendingNecessityDetails = $this->necessityModel->getdonationstartNecessity($necessityID);

                    $donorsdonated = $this->necessityModel->getdonateddonordetails($necessityID);
    
                    // Prepare data to pass to the view
                    $data = [
                        'necessityID' => $necessityID,
                        'pendingNecessityDetails' => $pendingNecessityDetails,
                        'donorsdonated' => $donorsdonated
                    ];

                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];
    
                    // Pass data to the view
                    if ($_SESSION['user_type'] == 'student') {

                    }else if ($_SESSION['user_type'] == 'organization') {
                        $this->view('organization/necessity/viewOrganizationDonationstartMonetarynecessity', $data, $other_data);
                    }else {
                        die('User Type Not Found');
                    }
    
                } else {
                    // display an error message here
                    die('User Necessity is Not Found');
                }
    
            } else {
                // If it's not a POST request, then empty data pass to the view
                $data = [
                    'necessityID' => '',
                    'pendingNecessityDetails' => [] // this is an array
                ];
                
                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];

                // Pass data to the view
                if ($_SESSION['user_type'] == 'student') {

                }else if ($_SESSION['user_type'] == 'organization') {
                    $this->view('organization/necessity/viewOrganizationDonationstartMonetarynecessity', $data, $other_data);
                }else {
                    die('User Type Not Found');
                }
            }
        }
    }

    //view pending Physical Goods necessity's further information
    public function viewPendingPhysicalGoodsnecessity(){
        if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization' && $_SESSION['user_type'] != 'donor') {
            redirect('pages/404');
        } else {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                if(isset($_POST['necessityID']) && !empty($_POST['necessityID'])) {
                    // Get 'necessityID' from POST data
                    $necessityID = trim($_POST['necessityID']);
    
                    // Get pending necessity details
                    $pendingNecessityDetails = $this->necessityModel->getPendingGoodsNecessities($necessityID);
    
                    // Prepare data to pass to the view
                    $data = [
                        'necessityID' => $necessityID,
                        'pendingNecessityDetails' => $pendingNecessityDetails
                    ];
    
                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];

                    // Pass data to the view
                    if ($_SESSION['user_type'] == 'student') {

                    }else if ($_SESSION['user_type'] == 'organization') {
                        $this->view('organization/necessity/viewOrganizationPendingPhysicalGoodsnecessity', $data, $other_data);
                    }else {
                        die('User Type Not Found');
                    }
    
                } else {
                    // display an error message here
                    die('User Necessity is Not Found');
                }
    
            } else {
                // If it's not a POST request, then empty data pass to the view
                $data = [
                    'necessityID' => '',
                    'pendingNecessityDetails' => [] // this is an array
                ];

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];
                
                // Pass data to the view
                if ($_SESSION['user_type'] == 'student') {

                }else if ($_SESSION['user_type'] == 'organization') {
                    $this->view('organization/necessity/viewOrganizationPendingPhysicalGoodsnecessity', $data, $other_data);
                }else {
                    die('User Type Not Found');
                }
            }
        }
    }

    //view completed Physical Goods necessity's further information
    public function viewCompletedPhysicalGoodsnecessity(){
        if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization' && $_SESSION['user_type'] != 'donor') {
            redirect('pages/404');
        } else {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                if(isset($_POST['necessityID']) && !empty($_POST['necessityID'])) {
                    // Get 'necessityID' from POST data
                    $necessityID = trim($_POST['necessityID']);
    
                    // Get pending necessity details
                    $pendingNecessityDetails = $this->necessityModel->getCompletedGoodsNecessities($necessityID);
    
                    // Prepare data to pass to the view
                    $data = [
                        'necessityID' => $necessityID,
                        'pendingNecessityDetails' => $pendingNecessityDetails
                    ];
    
                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];

                    // Pass data to the view
                    if ($_SESSION['user_type'] == 'student') {

                    }else if ($_SESSION['user_type'] == 'organization') {
                        $this->view('organization/necessity/viewOrganizationCompletedphysicalgoodsnecessity', $data, $other_data);
                    }else {
                        die('User Type Not Found');
                    }
    
                } else {
                    // display an error message here
                    die('User Necessity is Not Found');
                }
    
            } else {
                // If it's not a POST request, then empty data pass to the view
                $data = [
                    'necessityID' => '',
                    'pendingNecessityDetails' => [] // this is an array
                ];

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];
                
                // Pass data to the view
                if ($_SESSION['user_type'] == 'student') {

                }else if ($_SESSION['user_type'] == 'organization') {
                    $this->view('organization/necessity/viewOrganizationCompletedphysicalgoodsnecessity', $data, $other_data);
                }else {
                    die('User Type Not Found');
                }
            }
        }
    }
    
    //Delete Monetary pending and completed Necessities
    public function deleteNecessity(){
        if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization') {
            redirect('pages/404');
        }

        else {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                if(isset($_POST['necessityID']) && !empty($_POST['necessityID'])) {
                    // Get 'necessityID' from POST data
                    $necessityID = trim($_POST['necessityID']);
    
                    //  if the Deleting necessity is succed   
                    if($this->necessityModel->deleteNecessity($necessityID)){

                        //update necessity data
                        $data = [
                            'pendingtablerow' => $this->necessityModel->getaddedMonetaryNecessities(),
                            'completetablerow' => $this->necessityModel->getaddedCompletedMonetaryNecessities()
                        ];

                        $other_data = [
                            'notification_count' => $this->notificationModel->getNotificationCount(),
                            'notifications' => $this->notificationModel->viewNotifications()
                        ];

                        // Pass data to the view
                        if ($_SESSION['user_type'] == 'student') {

                        }else if ($_SESSION['user_type'] == 'organization') {
                            $this->view('organization/postedmonetarynecessity', $data, $other_data);
                        }else {
                            die('User Type Not Found');
                        }

                    }else{

                        // Handle deletion failure (e.g., show error message)
                        die('Failed to delete Necessity.');
                    }
    
                } else {
                    // display an error message here
                    die('User Necessity is Not Found');
                }
    
            } else {
                // If it's not a POST request, then empty data pass to the view
                $data = [
                    'pendingtablerow' => [] ,
                    'completetablerow' => [] // this is an array
                ];

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];
                
                // Pass data to the view
                if ($_SESSION['user_type'] == 'student') {

                }else if ($_SESSION['user_type'] == 'organization') {
                    $this->view('organization/postedmonetarynecessity', $data, $other_data);
                }else {
                    die('User Type Not Found');
                }
            }
        }
    }

    //Delete Goods pending and completed Necessities
    public function deleteGoodsNecessity(){
        if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization') {
            redirect('pages/404');
        }

        else {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                if(isset($_POST['necessityID']) && !empty($_POST['necessityID'])) {
                    // Get 'necessityID' from POST data
                    $necessityID = trim($_POST['necessityID']);
    
                    //  if the Deleting necessity is succed   
                    if($this->necessityModel->deleteNecessity($necessityID)){

                        //update necessity data
                        $data = [
                            'pendingtablerow' => $this->necessityModel->getaddedGoodsNecessities(),
                            'completetablerow' => $this->necessityModel->getaddedCompletedGoodsNecessities()
                        ];

                        $other_data = [
                            'notification_count' => $this->notificationModel->getNotificationCount(),
                            'notifications' => $this->notificationModel->viewNotifications()
                        ];

                        // Pass data to the view
                        if ($_SESSION['user_type'] == 'student') {

                        }else if ($_SESSION['user_type'] == 'organization') {
                            $this->view('organization/postedphysicalgoodsnecessity', $data, $other_data);
                        }else {
                            die('User Type Not Found');
                        }

                    }else{

                        // Handle deletion failure (e.g., show error message)
                        die('Failed to delete benefaction.');
                    }
    
                } else {
                    // display an error message here
                    die('User Necessity is Not Found');
                }
    
            } else {
                // If it's not a POST request, then empty data pass to the view
                $data = [
                    'pendingtablerow' => [] ,
                    'completetablerow' => [] // this is an array
                ];

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];
                
                // Pass data to the view
                if ($_SESSION['user_type'] == 'student') {

                }else if ($_SESSION['user_type'] == 'organization') {
                    $this->view('organization/postedphysicalgoodsnecessity', $data, $other_data);
                }else {
                    die('User Type Not Found');
                }
            }
        }
    }


    // This is the function that pass necessity Id to edit recurring necessity page
    public function editRecuringMonetaryNecessity(){
        if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization') {
            redirect('pages/404');
        }

        else {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                if(isset($_POST['necessityID']) && !empty($_POST['necessityID'])) {
                    // Get 'necessityID' from POST data
                    $necessityID = trim($_POST['necessityID']);

                    $existingData = $this->necessityModel->getALLthedetailsofMonetaryNecessityByID($necessityID);
                    

                    $data = [
                        'necessityID' => $necessityID,
                        'necessityMonetary' => $existingData->necessityName,
                        'recurringstartdate' => $existingData->startDate,
                        'monetarynecessitydes' => $existingData->description,
                        'requestedamount' => $existingData->requestedAmount,
                        'monthlyrequestedamount' => $existingData->monthlyAmount,
                        'donationduration' => $existingData->duration 
                    ];

                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];

                    if ($_SESSION['user_type'] == 'student') {

                    }else if ($_SESSION['user_type'] == 'organization') {
                        $this->view('organization/necessity/editpostedrecurringmonetarynecessity', $data, $other_data);
                    }else {
                        die('User Type Not Found');
                    }

                    
                }
            }
        }
    }

    //This function will get the details from edit recurring page and use for update
    public function UpdateRecuringMonetaryNecessity(){
        if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization') {
            redirect('pages/404');
        }

        else {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


                if(isset($_POST['necessityID']) && !empty($_POST['necessityID'])) {
                    // Get 'necessityID' from POST data
                    $necessityID = trim($_POST['necessityID']);


                    $data = [
                        'necessityID' => $necessityID,
                        'necessityMonetary' => isset($_POST['necessityMonetary']) ? trim($_POST['necessityMonetary']) : '',
                        'monetarynecessitydes' => isset($_POST['monetarynecessitydes']) ? trim($_POST['monetarynecessitydes']) : '',
                        'necessityMonetary_err' => '',
                        'monetarynecessitydes_err' => '',
                    ];

                    //check wheather field are empty or not

                    //necessity field
                    if(empty($data['necessityMonetary'])){
                        $data['necessityMonetary_err']='Please enter the Necessity about Monetary';
                    }

                    //necessity description field
                    if(empty($data['monetarynecessitydes'])){
                        $data['monetarynecessitydes_err']='Please enter the Description about Requested Necessity';
                    }

                    //check whether there any errors
                    if(empty($data['necessityMonetary_err']) && empty($data['monetarynecessitydes_err'])){
                        if($this->necessityModel->editrecurringmonetarynecessitytodb($data)){
                            redirect('necessity/monetary');
                        }else{
                            error_log('Error: Failed to insert data into the database.');
                            die('something went wrong');
                        }
                    }else{
                        $other_data = [
                            'notification_count' => $this->notificationModel->getNotificationCount(),
                            'notifications' => $this->notificationModel->viewNotifications()
                        ];

                        if ($_SESSION['user_type'] == 'student') {

                        }else if ($_SESSION['user_type'] == 'organization') {
                            $this->view('organization/necessity/editpostedrecurringmonetarynecessity', $data, $other_data);
                        }else {
                            die('User Type Not Found');
                        }
                        
                    }
                }else{
                    die('Necessity is not found');
                }

            }else{

                $data = [
                    'necessityID' => '',
                    'necessityMonetary' => '',
                    'monetarynecessitydes' => '',
                    'necessityMonetary_err' => '',
                    'monetarynecessitydes_err' => '',
                ];

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];

                if ($_SESSION['user_type'] == 'student') {

                }else if ($_SESSION['user_type'] == 'organization') {
                    $this->view('organization/necessity/editpostedrecurringmonetarynecessity', $data, $other_data);
                }else {
                    die('User Type Not Found');
                }
            }

        }
    }

    // This is the function that pass necessity Id to edit one-time necessity page
    public function editOnetimeMonetaryNecessity(){
        if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization') {
            redirect('pages/404');
        }

        else {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                if(isset($_POST['necessityID']) && !empty($_POST['necessityID'])) {
                    // Get 'necessityID' from POST data
                    $necessityID = trim($_POST['necessityID']);

                    $existingData = $this->necessityModel->getALLthedetailsofMonetaryNecessityByID($necessityID);
                    

                    $data = [
                        'necessityID' => $necessityID,
                        'necessityMonetary' => $existingData->necessityName,
                        'monetarynecessitydes' => $existingData->description,
                        'requestedamount' => $existingData->requestedAmount
                    ];

                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];

                    if ($_SESSION['user_type'] == 'student') {

                    }else if ($_SESSION['user_type'] == 'organization') {
                        $this->view('organization/necessity/editpostedonetimemonetarynecessity', $data, $other_data);
                    }else {
                        die('User Type Not Found');
                    }

                    
                }
            }
        }
    }

    //This function will get the details from edit recurring page and use for update
    public function UpdateonetimeMonetaryNecessity(){
        if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization') {
            redirect('pages/404');
        }

        else {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


                if(isset($_POST['necessityID']) && !empty($_POST['necessityID'])) {
                    // Get 'necessityID' from POST data
                    $necessityID = trim($_POST['necessityID']);


                    $data = [
                        'necessityID' => $necessityID,
                        'necessityMonetary' => isset($_POST['necessityMonetary']) ? trim($_POST['necessityMonetary']) : '',
                        'monetarynecessitydes' => isset($_POST['monetarynecessitydes']) ? trim($_POST['monetarynecessitydes']) : '',
                        'necessityMonetary_err' => '',
                        'monetarynecessitydes_err' => '',
                        'requestedamount_err' => ''
                    ];

                    //check wheather field are empty or not

                    //necessity field
                    if(empty($data['necessityMonetary'])){
                        $data['necessityMonetary_err']='Please enter the Necessity about Monetary';
                    }

                    //necessity description field
                    if(empty($data['monetarynecessitydes'])){
                        $data['monetarynecessitydes_err']='Please enter the Description about Requested Necessity';
                    }


                    //check whether there any errors
                    if(empty($data['necessityMonetary_err']) && empty($data['monetarynecessitydes_err'])){
                        if($this->necessityModel->editonetimemonetarynecessitytodb($data)){
                            redirect('necessity/monetary');
                        }else{
                            error_log('Error: Failed to insert data into the database.');
                            die('something went wrong');
                        }
                    }else{
                        $other_data = [
                            'notification_count' => $this->notificationModel->getNotificationCount(),
                            'notifications' => $this->notificationModel->viewNotifications()
                        ];

                        if ($_SESSION['user_type'] == 'student') {

                        }else if ($_SESSION['user_type'] == 'organization') {
                            $this->view('organization/necessity/editpostedonetimemonetarynecessity', $data, $other_data);
                        }else {
                            die('User Type Not Found');
                        }
                        
                    }
                }else{
                    die('Necessity is not found');
                }

            }else{

                $data = [
                    'necessityID' => '',
                    'necessityMonetary' => '',
                    'monetarynecessitydes' => '',
                    'donationduration' => '',
                    'necessityMonetary_err' => '',
                    'monetarynecessitydes_err' => '',
                ];

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];

                if ($_SESSION['user_type'] == 'student') {

                }else if ($_SESSION['user_type'] == 'organization') {
                    $this->view('organization/necessity/editpostedonetimemonetarynecessity', $data, $other_data);
                }else {
                    die('User Type Not Found');
                }
            }

        }
    }

    // This is the function that pass necessity Id to edit physicall goods necessity page
    public function editYourPhysicalgoodsNecessity(){
        if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization') {
            redirect('pages/404');
        }

        else {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                if(isset($_POST['necessityID']) && !empty($_POST['necessityID'])) {
                    // Get 'necessityID' from POST data
                    $necessityID = trim($_POST['necessityID']);

                    $existingData = $this->necessityModel->getALLthedetailsofPhysicalGoodsNecessityByID($necessityID);
                    

                    $data = [
                        'necessityID' => $necessityID,
                        'necessityCategory' => $existingData->itemCategory, 
                        'neccessityitem' => $existingData->necessityName,
                        'requestedgoodsquantity' => $existingData->requestedQuantity,
                        'goodsnecessitydes' => $existingData->description
                    ];

                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];

                    if ($_SESSION['user_type'] == 'student') {

                    }else if ($_SESSION['user_type'] == 'organization') {
                        $this->view('organization/necessity/editphysicalgoodsnecessity', $data, $other_data);
                    }else {
                        die('User Type Not Found');
                    }

                    
                }
            }
        }
    }

    //This function will get the details from edit physical goods page and use for update
    public function UpdatePhysicalGoodsNecessity(){
        if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization') {
            redirect('pages/404');
        }

        else {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


                if(isset($_POST['necessityID']) && !empty($_POST['necessityID'])) {
                    // Get 'necessityID' from POST data
                    $necessityID = trim($_POST['necessityID']);


                    $data = [
                        'necessityID' => $necessityID,
                        'requestedgoodsquantity' => isset($_POST['requestedgoodsquantity']) ? trim($_POST['requestedgoodsquantity']) : '',
                        'goodsnecessitydes' => isset($_POST['goodsnecessitydes']) ? trim($_POST['goodsnecessitydes']) : '',
                        'requestedgoodsquantity_err' => '',
                        'goodsnecessitydes_err' => ''
                    ];

                    //check wheather field are empty or not

                    //necessity field
                    if(empty($data['requestedgoodsquantity'])){
                        $data['requestedgoodsquantity_err']='Please enter the Necessity quantity you need ';
                    }

                    //necessity description field
                    if(empty($data['goodsnecessitydes'])){
                        $data['goodsnecessitydes_err']='Please enter the Description about Requested Necessity';
                    }

                    //check whether there any errors
                    if(empty($data['requestedgoodsquantity_err']) && empty($data['goodsnecessitydes_err'])){
                        if($this->necessityModel->editphysicalgoodsnecessitytodb($data)){
                            redirect('necessity/physicalgood');
                        }else{
                            error_log('Error: Failed to insert data into the database.');
                            die('something went wrong');
                        }
                    }else{
                        $other_data = [
                            'notification_count' => $this->notificationModel->getNotificationCount(),
                            'notifications' => $this->notificationModel->viewNotifications()
                        ];

                        if ($_SESSION['user_type'] == 'student') {

                        }else if ($_SESSION['user_type'] == 'organization') {
                            $this->view('organization/necessity/editphysicalgoodsnecessity', $data, $other_data);
                        }else {
                            die('User Type Not Found');
                        }
                        
                    }
                }else{
                    die('Necessity is not found');
                }

            }else{

                $data = [
                    'necessityID' => '',
                    'requestedgoodsquantity' => '',
                    'goodsnecessitydes' => '',
                    'requestedgoodsquantity_err' => '',
                    'goodsnecessitydes_err' => ''
                ];

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];

                if ($_SESSION['user_type'] == 'student') {

                }else if ($_SESSION['user_type'] == 'organization') {
                    $this->view('organization/necessity/editphysicalgoodsnecessity', $data, $other_data);
                }else {
                    die('User Type Not Found');
                }
            }

        }
    }


    public function deleteNecessities() {
        if($_SESSION['user_type'] == 'donor') {
            redirect('pages/404');
        }

        else {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if($this->necessityModel->deleteNecessity($_POST['necessity_ID'])) {
                    $necessityType = $this->necessityModel->getNecessityType($_POST['necessity_ID']);

                    if($necessityType == 'Monetary Funding') {
                        redirect('necessity/monetary');
                    }

                    else if($necessityType == 'Physical Goods') {
                        redirect('necessity/physicalgood');
                    }
                }
            }
        }
    }

    public function viewMonetary() {
        $necessity_type = $this->necessityModel->getMonetaryNecessityType($_GET['necessity_ID']);
        $donee_type = $this->necessityModel->getDoneeType($_GET['necessity_ID']);
       
        if ($necessity_type == 'onetime') {
            if($donee_type == 'student') {
                $data = [
                    'title' => 'Home Page',
                    'necessity_ID' => $_GET['necessity_ID'],
                    'necessity_type' => $necessity_type,
                    'necessity_details' => $this->necessityModel->getStudentOnetimeMonetaryDetails($_GET['necessity_ID']),
                    'donations' => $this->necessityModel->getOneTimeDonationCardDetails($_GET['necessity_ID'])
                ];
            }

            else if($donee_type == 'organization') {
                $data = [
                    'title' => 'Home Page',
                    'necessity_ID' => $_GET['necessity_ID'],
                    'necessity_type' => $necessity_type,
                    'necessity_details' => $this->necessityModel->getOrganizationOnetimeMonetaryDetails($_GET['necessity_ID']),
                    'donations' => $this->necessityModel->getOneTimeDonationCardDetails($_GET['necessity_ID'])
                ];

            }

            else {
                die('Donee Type Not Found');
            }
        }

        else if($necessity_type == 'recurring') {
            if($donee_type == 'student') {
                $data = [
                    'title' => 'Home Page',
                    'necessity_ID' => $_GET['necessity_ID'],
                    'necessity_type' => $necessity_type,
                    'necessity_details' => $this->necessityModel->getStudentRecurringMonetaryDetails($_GET['necessity_ID']),
                    'donations' => $this->necessityModel->getRecurringDonationCardDetails($_GET['necessity_ID'])
                ];
            }

            else if($donee_type == 'organization') {
                $data = [
                    'title' => 'Home Page',
                    'necessity_ID' => $_GET['necessity_ID'],
                    'necessity_type' => $necessity_type,
                    'necessity_details' => $this->necessityModel->getOrganizationRecurringMonetaryDetails($_GET['necessity_ID']),
                    'donations' => $this->necessityModel->getRecurringDonationCardDetails($_GET['necessity_ID'])
                ];
            }

            else {
                die('Donee Type Not Found');
            }
        }

        else {
            die('Monetary Necessity Type Not Found');
        }

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view($_SESSION['user_type'].'/necessity/viewmonetary', $data, $other_data);
    }

    public function viewMonetaryDonationDetails() {
        if(isset($_GET['oneTimeDonationID'])){
            $necessity_ID = $this->necessityModel->getMonetaryNecessityID($_GET['oneTimeDonationID']);

            $data = [
                'necessity_ID' => $necessity_ID,
                'necessity_type' => $this->necessityModel->getMonetaryNecessityType($necessity_ID),
                'donation_details' => $this->necessityModel->getOneTimeDonationDetails($_GET['oneTimeDonationID'])
            ];
        }
        else if(isset($_GET['monetaryNecessityID'])){
            $data = [
                'necessity_ID' => $_GET['monetaryNecessityID'],
                'necessity_type' => $this->necessityModel->getMonetaryNecessityType($_GET['monetaryNecessityID']),
                'donation_details' => $this->necessityModel->getRecurringDonationDetails($_GET['monetaryNecessityID'])
            ];
        }

        else{
            die('invalid');
        }

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view($_SESSION['user_type'].'/necessity/viewMonetaryDonationDetails', $data, $other_data);
    }

    public function verifySlip() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_POST['donation_ID'])) {
                if($this->necessityModel->verifyOneTimeSlip($_POST['donation_ID'])) {
                    redirect('necessity/viewmonetarydonationdetails?oneTimeDonationID='.$_POST['donation_ID']);
                }
            }

            else if(isset($_POST['necessity_ID'])) {
                if($this->necessityModel->verifyRecurringSlip($_POST['necessity_ID'])) {
                    redirect('necessity/viewmonetarydonationdetails?monetaryNecessityID='.$_POST['necessity_ID']);
                }
            }
        }
    }

    public function viewGood() {
        $donee_type = $this->necessityModel->getDoneeType($_GET['necessity_ID']);
                
        if($donee_type == 'student') {
            $data = [
                'title' => 'Home Page',
                'necessity_ID' => $_GET['necessity_ID'],
                'necessity_details' => $this->necessityModel->getStudentGoodDetails($_GET['necessity_ID']),
                'donations' => $this->necessityModel->getGoodDonationCardDetails($_GET['necessity_ID'])
            ];
        }

        else if($donee_type == 'organization') {
            $data = [
                'title' => 'Home Page',
                'necessity_ID' => $_GET['necessity_ID'],
                'necessity_details' => $this->necessityModel->getOrganizationGoodDetails($_GET['necessity_ID']),
                'donations' => $this->necessityModel->getGoodDonationCardDetails($_GET['necessity_ID'])
            ];
        }

        else {
            die('Donee Type Not Found');
        }

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];
    
        $this->view($_SESSION['user_type'].'/necessity/viewgood', $data, $other_data);
    }

    public function viewGoodDonationDetails() {
        $necessity_ID = $this->necessityModel->getGoodNecessityID($_GET['goodDonationID']);

        $data = [
            'necessity_ID' => $necessity_ID,
            'donation_details' => $this->necessityModel->getGoodDonationDetails($_GET['goodDonationID'])
        ];
       
        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view($_SESSION['user_type'].'/necessity/viewgooddonation', $data, $other_data);
    }

    public function manageMonetary() {
        if(($_SESSION['user_type'] != 'admin' && $_SESSION['user_type'] != 'superAdmin' || (empty($_GET['necessity_ID']) && empty($_POST['necessity_ID'])))) {
            redirect('pages/404');
        }

        else {
            // When we submit comments
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = [
                    'comment' => trim($_POST['comment']),
                    'necessity_ID' => trim($_POST['necessity_ID']),
                    'err' => ''
                ];

                // If the comment is empty display view with errors
                if(empty($data['comment'])) {
                    $necessity_type = $this->necessityModel->getMonetaryNecessityType($_POST['necessity_ID']);
                    $donee_type = $this->necessityModel->getDoneeType($_POST['necessity_ID']);
                    
                    if ($necessity_type == 'onetime') {
                        if($donee_type == 'student') {
                            $data = [
                                'title' => 'Home Page',
                                'necessity_ID' => $_POST['necessity_ID'],
                                'necessity_details' => $this->necessityModel->getStudentOnetimeMonetaryDetails($_POST['necessity_ID'])
                            ];
                        }

                        else if($donee_type == 'organization') {
                            $data = [
                                'title' => 'Home Page',
                                'necessity_ID' => $_POST['necessity_ID'],
                                'necessity_details' => $this->necessityModel->getOrganizationOnetimeMonetaryDetails($_POST['necessity_ID'])
                            ];
                        }
            
                        else {
                            die('Donee Type Not Found');
                        }
                    }

                    else if($necessity_type == 'recurring') {
                        if($donee_type == 'student') {
                            $data = [
                                'title' => 'Home Page',
                                'necessity_ID' => $_POST['necessity_ID'],
                                'necessity_details' => $this->necessityModel->getStudentRecurringMonetaryDetails($_POST['necessity_ID'])
                            ];

                        }

                        else if($donee_type == 'organization') {
                            $data = [
                                'title' => 'Home Page',
                                'necessity_ID' => $_POST['necessity_ID'],
                                'necessity_details' => $this->necessityModel->getOrganizationRecurringMonetaryDetails($_POST['necessity_ID'])
                            ];
                        }

                        else {
                            die('Donee Type Not Found');
                        }
                    }

                    else {
                        die('Monetary Necessity Type Not Found');
                    }

                    $data['comments'] = $this->necessityModel->getAllComments($_POST['necessity_ID']);

                    $data['err'] = 'Please enter your comment';

                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];

                    $this->view($_SESSION['user_type'].'/necessity/managemonetary', $data, $other_data);
                }

                // If the comment is not empty insert comment to the database and redirect to Manage Montary view
                else {
                    if($this->necessityModel->addComment($data)) {
                        $doneeID = $this->necessityModel->getDoneeID($data['necessity_ID']);

                        $this->notificationModel->createNotification('Manage Necessity', 'manageMonetaryNecessity', $_SESSION['user_id'], $doneeID, $data['comment'], $data['necessity_ID']);

                        $necessityType = $this->necessityModel->getNecessityType($data['necessity_ID']);

                        if($necessityType == 'Monetary Funding') {
                            redirect('necessity/managemonetary?necessity_ID='.$data['necessity_ID']);
                        }

                        else {
                            die('Necessity Type Not Found');
                        }
                    }
                }
            }
            
            // Loading normal view when called with GET method
            else{
                $necessity_type = $this->necessityModel->getMonetaryNecessityType($_GET['necessity_ID']);
                $donee_type = $this->necessityModel->getDoneeType($_GET['necessity_ID']);
                

                if ($necessity_type == 'onetime') {
                    if($donee_type == 'student') {
                        $data = [
                            'title' => 'Home Page',
                            'necessity_ID' => $_GET['necessity_ID'],
                            'necessity_details' => $this->necessityModel->getStudentOnetimeMonetaryDetails($_GET['necessity_ID'])
                        ];


                    }

                    else if($donee_type == 'organization') {
                        $data = [
                            'title' => 'Home Page',
                            'necessity_ID' => $_GET['necessity_ID'],
                            'necessity_details' => $this->necessityModel->getOrganizationOnetimeMonetaryDetails($_GET['necessity_ID'])
                        ];
                    }
    
                    else {
                        die('Donee Type Not Found');
                    }
                }

                else if($necessity_type == 'recurring') {
                    if($donee_type == 'student') {
                        $data = [
                            'title' => 'Home Page',
                            'necessity_ID' => $_GET['necessity_ID'],
                            'necessity_details' => $this->necessityModel->getStudentRecurringMonetaryDetails($_GET['necessity_ID'])
                        ];
                    }

                    else if($donee_type == 'organization') {
                        $data = [
                            'title' => 'Home Page',
                            'necessity_ID' => $_GET['necessity_ID'],
                            'necessity_details' => $this->necessityModel->getOrganizationRecurringMonetaryDetails($_GET['necessity_ID'])
                        ];
                    }

                    else {
                        die('Donee Type Not Found');
                    }
                }

                else {
                    die('Monetary Necessity Type Not Found');
                }

                $data['comments'] = $this->necessityModel->getAllComments($data['necessity_ID']);

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];

                $this->view($_SESSION['user_type'].'/necessity/managemonetary', $data, $other_data);
            }
        }
    }

    public function manageGood($necessity_ID = null) {
        if(($_SESSION['user_type'] != 'admin' && $_SESSION['user_type'] != 'superAdmin') || empty($_GET['necessity_ID']) && empty($_POST['necessity_ID'])) {
            redirect('pages/404');
        }

        else {
            // When we submit comments
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = [
                    'comment' => trim($_POST['comment']),
                    'necessity_ID' => trim($_POST['necessity_ID']),
                    'err' => ''
                ];

                // If the comment is empty load view with errors
                if(empty($data['comment'])) {
                    $donee_type = $this->necessityModel->getDoneeType($_POST['necessity_ID']);
                    
                    if($donee_type == 'student') {
                        $data = [
                            'title' => 'Home Page',
                            'necessity_ID' => $_POST['necessity_ID'],
                            'necessity_details' => $this->necessityModel->getStudentGoodDetails($_POST['necessity_ID'])
                        ];
                    }

                    else if($donee_type == 'organization') {
                        $data = [
                            'title' => 'Home Page',
                            'necessity_ID' => $_POST['necessity_ID'],
                            'necessity_details' => $this->necessityModel->getOrganizationGoodDetails($_POST['necessity_ID'])
                        ];
                    }
        
                    else {
                        die('Donee Type Not Found');
                    }

                    $data['comments'] = $this->necessityModel->getAllComments($_POST['necessity_ID']);

                    $data['err'] = 'Please enter your comment';

                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];

                    $this->view($_SESSION['user_type'].'/necessity/managemonetary', $data, $other_data);
                }

                // If the comment is not empty insert comment to the database and redirect to Manage Montary view
                else {
                    if($this->necessityModel->addComment($data)) {
                        $doneeID = $this->necessityModel->getDoneeID($data['necessity_ID']);

                        $this->notificationModel->createNotification('Manage Necessity', 'manageGoodNecessity', $_SESSION['user_id'], $doneeID, $data['comment'], $data['necessity_ID']);

                        $necessityType = $this->necessityModel->getNecessityType($data['necessity_ID']);

                        if($necessityType == 'Physical Goods') {
                            redirect('necessity/managegood?necessity_ID='.$data['necessity_ID']);
                        }

                        else {
                            die('Necessity Type Not Found');
                        }
                    }
                }
            }
            
            // Loading normal view when called with GET method
            else {
                $donee_type = $this->necessityModel->getDoneeType($_GET['necessity_ID']);
                
                if($donee_type == 'student') {
                    $data = [
                        'title' => 'Home Page',
                        'necessity_ID' => $_GET['necessity_ID'],
                        'necessity_details' => $this->necessityModel->getStudentGoodDetails($_GET['necessity_ID'])
                    ];
                }

                else if($donee_type == 'organization') {
                    $data = [
                        'title' => 'Home Page',
                        'necessity_ID' => $_GET['necessity_ID'],
                        'necessity_details' => $this->necessityModel->getOrganizationGoodDetails($_GET['necessity_ID'])
                    ];
                }

                else {
                    die('Donee Type Not Found');
                }
            }

            $data['comments'] = $this->necessityModel->getAllComments($data['necessity_ID']);

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view($_SESSION['user_type'].'/necessity/managegood', $data, $other_data);
        }
    }

    public function viewMonetaryDoneeProfile($necessity_ID = null, $donee_ID = null) {
        if($_SESSION['user_type'] == 'student' && $_SESSION['user_type'] == 'organization') {
            redirect('pages/404');
        }

        else {
            $doneeType = $this->userModel->getDoneeType($donee_ID);

            if ($doneeType == 'student') {
                $data = [
                    'title' => 'Home Page',
                    'necessity_ID' => $necessity_ID,
                    'details' => $this->necessityModel->getStudentDetails($donee_ID)
                ];

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];

                $this->view($_SESSION['user_type'].'/necessity/viewMonetaryStudentProfile', $data, $other_data);
            }

            else if ($doneeType == 'organization') {
                $data = [
                    'title' => 'Home Page',
                    'necessity_ID' => $necessity_ID,
                    'details' => $this->necessityModel->getOrganizationDetails($donee_ID)
                ];

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];

                $this->view($_SESSION['user_type'].'/necessity/viewMonetaryOrganizationProfile', $data, $other_data);
            }

            else {
                die('Donee Type Not Found');
            }
        }
    }

    public function viewGoodDoneeProfile($necessity_ID = null, $donee_ID = null) {
        if($_SESSION['user_type'] == 'student' && $_SESSION['user_type'] == 'organization') {
            redirect('pages/404');
        }

        else {
            $doneeType = $this->userModel->getDoneeType($donee_ID);

            if ($doneeType == 'student') {
                $data = [
                    'title' => 'Home Page',
                    'necessity_ID' => $necessity_ID,
                    'details' => $this->necessityModel->getStudentDetails($donee_ID)
                ];

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];

                $this->view($_SESSION['user_type'].'/necessity/viewGoodStudentProfile', $data, $other_data);
            }

            else if ($doneeType == 'organization') {
                $data = [
                    'title' => 'Home Page',
                    'necessity_ID' => $necessity_ID,
                    'details' => $this->necessityModel->getOrganizationDetails($donee_ID)
                ];

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];

                $this->view($_SESSION['user_type'].'/necessity/viewGoodOrganizationProfile', $data, $other_data);
            }

            else {
                die('Donee Type Not Found');
            }
        }
    }
}

