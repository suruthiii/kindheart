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
    
                    // Prepare data to pass to the view
                    $data = [
                        'necessityID' => $necessityID,
                        'pendingNecessityDetails' => $pendingNecessityDetails
                    ];
    
                    // Pass data to the view
                    if ($_SESSION['user_type'] == 'student') {

                    }else if ($_SESSION['user_type'] == 'organization') {
                        $this->view('organization/necessity/viewOrganizationPendingMonetarynecessity', $data);
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
                
                // Pass data to the view
                if ($_SESSION['user_type'] == 'student') {

                }else if ($_SESSION['user_type'] == 'organization') {
                    $this->view('organization/necessity/viewOrganizationPendingMonetarynecessity', $data);
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
    

                    // Pass data to the view
                    if ($_SESSION['user_type'] == 'student') {

                    }else if ($_SESSION['user_type'] == 'organization') {
                        $this->view('organization/necessity/viewOrganizationCompletedMonetarynecessity', $data);
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
                
                // Pass data to the view
                if ($_SESSION['user_type'] == 'student') {

                }else if ($_SESSION['user_type'] == 'organization') {
                    $this->view('organization/necessity/viewOrganizationCompletedMonetarynecessity', $data);
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
    

                    // Pass data to the view
                    if ($_SESSION['user_type'] == 'student') {

                    }else if ($_SESSION['user_type'] == 'organization') {
                        $this->view('organization/necessity/viewOrganizationPendingPhysicalGoodsnecessity', $data);
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
                
                // Pass data to the view
                if ($_SESSION['user_type'] == 'student') {

                }else if ($_SESSION['user_type'] == 'organization') {
                    $this->view('organization/necessity/viewOrganizationPendingPhysicalGoodsnecessity', $data);
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
    

                    // Pass data to the view
                    if ($_SESSION['user_type'] == 'student') {

                    }else if ($_SESSION['user_type'] == 'organization') {
                        $this->view('organization/necessity/viewOrganizationCompletedphysicalgoodsnecessity', $data);
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
                
                // Pass data to the view
                if ($_SESSION['user_type'] == 'student') {

                }else if ($_SESSION['user_type'] == 'organization') {
                    $this->view('organization/necessity/viewOrganizationCompletedphysicalgoodsnecessity', $data);
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

                        // Pass data to the view
                        if ($_SESSION['user_type'] == 'student') {

                        }else if ($_SESSION['user_type'] == 'organization') {
                            $this->view('organization/postedmonetarynecessity', $data);
                        }else {
                            die('User Type Not Found');
                        }

                    }else{

                        // Handle deletion failure (e.g., show error message)
                        die('Failed to delete benefaction.');
                    }
    
                } else {
                    // display an error message here
                    print_r($_POST);
                    die('User Necessity is Not Found');
                }
    
            } else {
                // If it's not a POST request, then empty data pass to the view
                $data = [
                    'pendingtablerow' => [] ,
                    'completetablerow' => [] // this is an array
                ];
                
                // Pass data to the view
                if ($_SESSION['user_type'] == 'student') {

                }else if ($_SESSION['user_type'] == 'organization') {
                    $this->view('organization/postedmonetarynecessity', $data);
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

                        // Pass data to the view
                        if ($_SESSION['user_type'] == 'student') {

                        }else if ($_SESSION['user_type'] == 'organization') {
                            $this->view('organization/postedphysicalgoodsnecessity', $data);
                        }else {
                            die('User Type Not Found');
                        }

                    }else{

                        // Handle deletion failure (e.g., show error message)
                        die('Failed to delete benefaction.');
                    }
    
                } else {
                    // display an error message here
                    print_r($_POST);
                    die('User Necessity is Not Found');
                }
    
            } else {
                // If it's not a POST request, then empty data pass to the view
                $data = [
                    'pendingtablerow' => [] ,
                    'completetablerow' => [] // this is an array
                ];
                
                // Pass data to the view
                if ($_SESSION['user_type'] == 'student') {

                }else if ($_SESSION['user_type'] == 'organization') {
                    $this->view('organization/postedphysicalgoodsnecessity', $data);
                }else {
                    die('User Type Not Found');
                }
            }
        }
    }
  
    // //display existing data in edit page
    // public function existingdata(){
    //     if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization') {
    //         redirect('pages/404');
    //     }

    //     else {   
    //         if(isset($_POST['necessityID']) && !empty($_POST['necessityID'])) {
    //             // Get 'necessityID' from POST data
    //             $necessityID = trim($_POST['necessityID']);
    
    //             // Get pending necessity details
    //             $pendingNecessityDetails = $this->necessityModel->getPendingMonetaryNecessities($necessityID);
    
    //             // Prepare data to pass to the view
    //             $data = [
    //                 'necessityID' => $necessityID,
    //                 'pendingNecessityDetails' => $pendingNecessityDetails
    //             ];
    
    //             // Pass data to the view
    //             if ($_SESSION['user_type'] == 'student') {
    
    //             }else if ($_SESSION['user_type'] == 'organization') {
    //                 $this->view('organization/necessity/editpostedmonetarynecessity', $data);
    //             }else {
    //                 die('User Type Not Found');
    //             }
    
    //         } else {
    //             // display an error message here
    //             die('User Necessity is Not Found');
    //         }
    //     }
    // }

    // //edit monetary necessity
    // public function editmonetarynecessity(){
    //     if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization') {
    //         redirect('pages/404');
    //     }

    //     else {
    //         if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //             $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //             // Initialize an empty data array
    //             $data = [];

    //             // Retrieve form data and sanitize it
    //             $data['necessityMonetary'] = isset($_POST['necessityMonetary']) ? trim($_POST['necessityMonetary']) : '';
    //             $data['necessityType'] = isset($_POST['necessityType']) ? trim($_POST['necessityType']) : '';
    //             $data['monetarynecessitydes'] = isset($_POST['monetarynecessitydes']) ? trim($_POST['monetarynecessitydes']) : '';
    //             $data['requestedamount'] = isset($_POST['requestedamount']) ? trim($_POST['requestedamount']) : '';
    //             $data['recurringstartdate'] = isset($_POST['recurringstartdate']) ? trim($_POST['recurringstartdate']) : '';
    //             $data['recurringenddate'] = isset($_POST['recurringenddate']) ? trim($_POST['recurringenddate']) : '';
    //             $data['frequency'] = isset($_POST['frequency']) ? trim($_POST['frequency']) : '';

    //             //change the getting input according to necessity type
    //             if ($data['necessityType'] === 'recurring') {
    //                 $data['recurringstartdate'] = trim($_POST['recurringstartdate']);
    //                 $data['recurringenddate'] = trim($_POST['recurringenddate']);
    //             } else {
    //                 $data['recurringstartdate'] = null;
    //                 $data['recurringenddate'] = null;
    //             }

    //             if ($data['necessityType'] === 'recurring') {
    //                 $startDate = new DateTime($data['recurringstartdate']);
    //                 $endDate = new DateTime($data['recurringenddate']);
                    
    //                 // Calculate the difference in days
    //                 $dateDiff = $startDate->diff($endDate)->days;
                
    //                 if ($dateDiff < 7) {
    //                     $data['frequency_err'] = 'please enter dates at least have 7days difference';
    //                 } else {
    //                     $data['frequency'] = trim($_POST['frequency']);
    //                 }
    //             } elseif($data['necessityType'] === 'onetime' && !empty($data['necessityMonetary'])){
    //                 $data['frequency'] = null;
    //             }else {
    //                 $data['frequency'] = null;
    //             }


    //             //check wheather field are empty or not

    //             //necessity field
    //             if(empty($data['necessityMonetary'])){
    //                 $data['necessityMonetary_err']='Please enter the Necessity about Monetary';
    //             }

    //             //necessity description field
    //             if(empty($data['monetarynecessitydes'])){
    //                 $data['monetarynecessitydes_err']='Please enter the Description about Requested Necessity';
    //             }

    //             //necessity type field
    //             if($data['necessityType']== 'recurring'){
    //                 if(empty($data['recurringstartdate'])){
    //                     $data['recurringstartdate_err']='Please enter the Recurring Start Date';
    //                 }

    //                 if(empty($data['recurringenddate'])){
    //                     $data['recurringenddate_err']='Please enter the Recurring End Date';
    //                 }
    //             }

    //             //recurring start and end date check
    //             if($data['recurringstartdate'] > $data['recurringenddate']){
    //                 $data['recurringdate_err']="Please give a valid dates.";
    //             }

    //             //necessity requested amount field
    //             if(empty($data['requestedamount'])){
    //                 $data['requestedamount_err']='Please enter the Requested Amount';
    //             }elseif($data['requestedamount']<0){// check the validity of inserted value
    //                 $data['requestedamount_err']='Please enter Valid Amount';
    //             }

    //             //check whether there any errors
    //             if(empty($data['necessityMonetary_err']) && empty($data['monetarynecessitydes_err']) && empty($data['requestedamount_err']) && empty($data['recurringstartdate_err']) && empty($data['recurringenddate_err']) && empty($data['recurringdate_err']) && empty($data['frequency_err'])){
    //                 if($this->necessityModel->updatemonetarynecessitytodb($data)){
    //                     redirect('necessity/monetary');
    //                 }else{
    //                     error_log('Error: Failed to update data into the database.');
    //                     redirect('organization/necessity/editpostedmonetarynecessity' . $data['necessityID']);
    //                 }
    //             }else{

    //                 if ($_SESSION['user_type'] == 'student') {
    //                     $this->view('student/necessity/', $data);
    //                 }else if ($_SESSION['user_type'] == 'organization') {
    //                     $this->view('organization/necessity/editpostedmonetarynecessity', $data);
    //                 }else {
    //                     die('User Type Not Found');
    //                 }
                    
    //             }

    //         }else{
    //             $data = [
    //                 'necessityMonetary' => '',
    //                 'necessityType' => '',
    //                 'recurringstartdate' => '',
    //                 'recurringenddate' => '',
    //                 'frequency' => '',
    //                 'monetarynecessitydes' => '',
    //                 'requestedamount' => '',
    //                 'necessityMonetary_err' => '',
    //                 'monetarynecessitydes_err' => '',
    //                 'requestedamount_err' => '',
    //                 'recurringstartdate_err' => '',
    //                 'recurringenddate_err' => '',
    //                 'recurringdate_err' => '',
    //                 'frequency_err' =>''
    //             ];

    //             if ($_SESSION['user_type'] == 'student') {
    //                 $this->view('student/necessity/', $data);
    //             }else if ($_SESSION['user_type'] == 'organization') {
    //                 $this->view('organization/necessity/editpostedmonetarynecessity', $data);
    //             }else {
    //                 die('User Type Not Found');
    //             }
    //         }

    //     }
    // } 

    //edit monetary necessity
//     public function editmonetarynecessity(){
//         if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization') {
//             redirect('pages/404');
//         }

//         else {
//             if($_SERVER['REQUEST_METHOD'] == 'POST'){
//                 $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

//                 $data = [
//                     'necessityMonetary' => trim($_POST['necessityMonetary']),
//                     'necessityType' => trim($_POST['necessityType']),
//                     'monetarynecessitydes' => trim($_POST['monetarynecessitydes']),
//                     'requestedamount' => trim($_POST['requestedamount']),
//                     'necessityMonetary_err' => '',
//                     'monetarynecessitydes_err' => '',
//                     'requestedamount_err' => '',
//                     'recurringdate_err' => '',
//                     'frequency_err' => ''
//                 ];

//                 //change the getting input according to necessity type
//                 if ($data['necessityType'] === 'recurring') {
//                     $data['recurringstartdate'] = trim($_POST['recurringstartdate']);
//                     $data['recurringenddate'] = trim($_POST['recurringenddate']);
//                 } else {
//                     $data['recurringstartdate'] = null;
//                     $data['recurringenddate'] = null;
//                 }

//                 if ($data['necessityType'] === 'recurring') {
//                     $startDate = new DateTime($data['recurringstartdate']);
//                     $endDate = new DateTime($data['recurringenddate']);
                    
//                     // Calculate the difference in days
//                     $dateDiff = $startDate->diff($endDate)->days;
                
//                     if ($dateDiff < 7) {
//                         $data['frequency_err'] = 'please enter dates at least have 7days difference';
//                     } else {
//                         $data['frequency'] = trim($_POST['frequency']);
//                     }
//                 } elseif($data['necessityType'] === 'onetime' && !empty($data['necessityMonetary'])){
//                     $data['frequency'] = null;
//                 }else {
//                     $data['frequency'] = null;
//                 }


//                 //check wheather field are empty or not

//                 //necessity field
//                 if(empty($data['necessityMonetary'])){
//                     $data['necessityMonetary_err']='Please enter the Necessity about Monetary';
//                 }

//                 //necessity description field
//                 if(empty($data['monetarynecessitydes'])){
//                     $data['monetarynecessitydes_err']='Please enter the Description about Requested Necessity';
//                 }

//                 //necessity type field
//                 if($data['necessityType']== 'recurring'){
//                     if(empty($data['recurringstartdate'])){
//                         $data['recurringstartdate_err']='Please enter the Recurring Start Date';
//                     }

//                     if(empty($data['recurringenddate'])){
//                         $data['recurringenddate_err']='Please enter the Recurring End Date';
//                     }
//                 }

//                 //recurring start and end date check
//                 if($data['recurringstartdate'] > $data['recurringenddate']){
//                     $data['recurringdate_err']="Please give a valid dates.";
//                 }

//                 //necessity requested amount field
//                 if(empty($data['requestedamount'])){
//                     $data['requestedamount_err']='Please enter the Requested Amount';
//                 }elseif($data['requestedamount']<0){// check the validity of inserted value
//                     $data['requestedamount_err']='Please enter Valid Amount';
//                 }

//                 //check whether there any errors
//                 if(empty($data['necessityMonetary_err']) && empty($data['monetarynecessitydes_err']) && empty($data['requestedamount_err']) && empty($data['recurringstartdate_err']) && empty($data['recurringenddate_err']) && empty($data['recurringdate_err']) && empty($data['frequency_err'])){
//                     if($this->necessityModel->editmonetarynecessitytodb($data)){
//                         redirect('necessity/monetary');
//                     }else{
//                         error_log('Error: Failed to insert data into the database.');
//                         die('something went wrong');
//                     }
//                 }else{

//                     if ($_SESSION['user_type'] == 'student') {
//                         $this->view('student/necessity/', $data);
//                     }else if ($_SESSION['user_type'] == 'organization') {
//                         $this->view('organization/necessity/editpostedmonetarynecessity', $data);
//                     }else {
//                         die('User Type Not Found');
//                     }
                    
//                 }

//             }else{
//                 $data = [
//                     'necessityMonetary' => '',
//                     'necessityType' => '',
//                     'recurringstartdate' => '',
//                     'recurringenddate' => '',
//                     'frequency' => '',
//                     'monetarynecessitydes' => '',
//                     'requestedamount' => '',
//                     'necessityMonetary_err' => '',
//                     'monetarynecessitydes_err' => '',
//                     'requestedamount_err' => '',
//                     'recurringstartdate_err' => '',
//                     'recurringenddate_err' => '',
//                     'recurringdate_err' => '',
//                     'frequency_err' =>''
//                 ];

//                 if ($_SESSION['user_type'] == 'student') {
//                     $this->view('student/necessity/', $data);
//                 }else if ($_SESSION['user_type'] == 'organization') {
//                     $this->view('organization/necessity/editpostedmonetarynecessity', $data);
//                 }else {
//                     die('User Type Not Found');
//                 }
//             }

//         }
//     } 

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
                                // 'comments' => $this->necessityModel->getAllComments($necessity_ID)
                            ];
                        }

                        else if($donee_type == 'organization') {
                            $data = [
                                'title' => 'Home Page',
                                'necessity_ID' => $_POST['necessity_ID'],
                                'necessity_details' => $this->necessityModel->getOrganizationOnetimeMonetaryDetails($_POST['necessity_ID'])
                                // 'comments' => $this->necessityModel->getAllComments($necessity_ID)
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
                                // 'comments' => $this->necessityModel->getAllComments($necessity_ID)
                            ];

                        }

                        else if($donee_type == 'organization') {
                            $data = [
                                'title' => 'Home Page',
                                'necessity_ID' => $_POST['necessity_ID'],
                                'necessity_details' => $this->necessityModel->getOrganizationRecurringMonetaryDetails($_POST['necessity_ID'])
                                // 'comments' => $this->necessityModel->getAllComments($necessity_ID)
                            ];
                        }

                        else {
                            die('Donee Type Not Found');
                        }
                    }

                    else {
                        die('Monetary Necessity Type Not Found');
                    }

                    $data['err'] = 'Please enter your comment';

                    $this->view($_SESSION['user_type'].'/necessity/managemonetary', $data);
                }

                // If the comment is not empty insert comment to the database and redirect to Manage Montary view
                else {
                    if($this->necessityModel->addComment($data)) {
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
                            // 'comments' => $this->necessityModel->getAllComments($necessity_ID)
                        ];


                    }

                    else if($donee_type == 'organization') {
                        $data = [
                            'title' => 'Home Page',
                            'necessity_ID' => $_GET['necessity_ID'],
                            'necessity_details' => $this->necessityModel->getOrganizationOnetimeMonetaryDetails($_GET['necessity_ID'])
                            // 'comments' => $this->necessityModel->getAllComments($necessity_ID)
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
                            // 'comments' => $this->necessityModel->getAllComments($necessity_ID)
                        ];

                    }

                    else if($donee_type == 'organization') {
                        $data = [
                            'title' => 'Home Page',
                            'necessity_ID' => $_GET['necessity_ID'],
                            'necessity_details' => $this->necessityModel->getOrganizationRecurringMonetaryDetails($_GET['necessity_ID'])
                            // 'comments' => $this->necessityModel->getAllComments($necessity_ID)
                        ];
                    }

                    else {
                        die('Donee Type Not Found');
                    }
                }

                else {
                    die('Monetary Necessity Type Not Found');
                }

                $this->view($_SESSION['user_type'].'/necessity/managemonetary', $data);
            }
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
}