<?php
class Benefaction extends Controller {
    private $middleware;

    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only organizations are allowed to access organization pages
        $this->middleware->checkAccess(['student','donor']);

        $this->donorModel = $this->model('DonorModel');
        $this->benefactionModel = $this->model('BenefactionModel');
        $this->userModel = $this->model('UserModel');
        $this->notificationModel = $this->model('NotificationModel');
    }

    public function index(){
        $data = [
            'title' => 'Home page'
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('donor/index', $data, $other_data);
    }

    // ------------Donor--------------------

    // View all benefactions
    public function viewAllBenefactions(){
        $data = [
            'title' => 'All Benefcation Posted Page'
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('donor/viewAllBenefactions', $data, $other_data);
    }

    // IMage Uploads Fro Benfaction
    public function imgUpload($file){
        $file_name = $_FILES[$file]['name'];
        $file_size = $_FILES[$file]['size'];
        $tmp_name = $_FILES[$file]['tmp_name'];
        $error = $_FILES[$file]['error'];

        if ($error === 0){
            $file_ex = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_ex_lc = strtolower($file_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($file_ex_lc, $allowed_exs)){
                // Move into benefactionUploads folder
                $new_file_name = uniqid("IMG-", true).'.'.$file_ex_lc;
                $file_upload_path = PUBLICROOT.'/benefactionUploads/'.$new_file_name;

                move_uploaded_file($tmp_name, $file_upload_path);
                return $new_file_name;
            }

            else{
                $data['photoBenfaction_err'] = "You can't upload files of this type";
                return $data;
            }
        }
    }

    // Add Benefactions
    public function donorAddBenefactions(){
        //other actors' redirection
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'itemBenefaction' => trim($_POST['itemBenefaction']),
                'benefactionCategory' => trim($_POST['benefactionCategory']),
                'quantityBenfaction' => trim($_POST['quantityBenfaction']),
                'benefactionDescription' => trim($_POST['benefactionDescription']),

                'photoBenfaction1' => $this->imgUpload('photoBenfaction1'),                
                'photoBenfaction2' => $this->imgUpload('photoBenfaction2'),
                'photoBenfaction3' => $this->imgUpload('photoBenfaction3'),
                'photoBenfaction4' => $this->imgUpload('photoBenfaction4'),

                'availabilityStatus' => '0',

                'itemBenefaction_err' => '',
                'benefactionCategory_err' => '',
                'quantityBenfaction_err' => '',
                'benefactionDescription_err' => '',
                'photoBenfaction_err' => ''
            ];

            // Map category value to category string
            if (!empty($_POST['benefactionCategory']) && $_POST['benefactionCategory'] != '0') {
                $categoryMap = [
                    '1' => 'Educational Supplies and Tools',
                    '2' => 'Clothing and Accessories',
                    '3' => 'Recreation and Sports Equipment',
                    '4' => 'Furniture and Appliances',
                    '5' => 'Health and Wellness Products',
                    '6' => 'Transportation and Mobility',
                    '7' => 'Literature and Reading Materials',
                    '8' => 'Others'
                ];

                $selectedCategoryId = $_POST['benefactionCategory'];
                $data['benefactionCategory'] = $categoryMap[$selectedCategoryId] ?? ''; // Get corresponding category string
            }
            // die(print_r($this->imgUpload('photoBenfaction1')));

            //validate the input fields seperately
            if(empty($data['itemBenefaction'])){
                $data['itemBenefaction_err']='Please enter the Item';
            }

            if (empty($_POST['benefactionCategory']) || $_POST['benefactionCategory'] == '0') {
                $data['benefactionCategory_err'] = 'Please select a category.';
            }

            if(empty($data['quantityBenfaction'])){
                $data['quantityBenfaction_err']='Please enter the Quantity';
            }

            if(empty($data['benefactionDescription'])){
                $data['benefactionDescription_err']='Please enter a small description about the item explaing it\'s condition and other details';
            }

            $uploadedFields = array_filter([$data['photoBenfaction1'], $data['photoBenfaction2'], $data['photoBenfaction3'], $data['photoBenfaction4']]);
           
            if (count($uploadedFields) < 2) {
                $data['photoBenfaction_err'] = 'Please upload at least 2 photos of the item';
            }

            if(empty($data['itemBenefaction_err']) && empty($data['quantityBenfaction_err']) && empty($data['benefactionDescription_err']) && empty($data['photoBenfaction_err']) && empty($data['benefactionCategory_err'])){
                if($this->benefactionModel->addBenefaction($data)){
                    $data = [
                        'pendingBenefaction' => $this->benefactionModel->getPendingBenefaction(),

                        'onProgressBenefaction' => $this->benefactionModel->getOnProgressBenefaction(),
                        
                        'completedBenefaction' => $this->benefactionModel->getCompletedBenefaction()
                    ];

                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];

                    $this->view('donor/postedBenefactions', $data, $other_data);
                }else{
                    die('Something Went Wrong');
                }
            }else{
                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];
                
                //Load View
                $this->view('donor/donorAddBenefactions', $data, $other_data);
            }

        }else{
            $data = [
                'itemBenefaction' => '',
                'benefactionCategory' => '',
                'quantityBenfaction' => '',
                'benefactionDescription' => '',
                'photoBenfaction1' => '',
                'photoBenfaction2' => '',
                'photoBenfaction3' => '',
                'photoBenfaction4' => '',

                'itemBenefaction_err' => '',
                'benefactionCategory_err' => '',
                'quantityBenfaction_err' => '',
                'benefactionDescription_err' => '',
                'photoBenfaction_err' => ''
            ];

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view('donor/donorAddBenefactions', $data, $other_data);
        }
    }

    // Get Details of Posted Benefaction
    public function postedBenefactions(){
        // Load the view with data
        $data = [
            'pendingBenefaction' => $this->benefactionModel->getPendingBenefaction(),

            'onProgressBenefaction' => $this->benefactionModel->getOnProgressBenefaction(),
            
            'completedBenefaction' => $this->benefactionModel->getCompletedBenefaction()
        ];

        // die(print_r($data['onProgressBenefaction'][0]->acknowledgedDonatedQuantity));

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        //Load View
        $this->view('donor/postedBenefactions', $data, $other_data);
    }

    // Get Details of One Selected Benefaction
    public function viewPostedBenefactions() {
        // Check if benefactionID is set in the POST request
        if(isset($_GET['benefactionID'])) {
            // Get the benefactionID from the POST request
            $benefactionID = $_GET['benefactionID'];            

            // Load the view with data
            $data = [
                'title' => 'View Posted Benefactions',
                'benefaction_details' => $this->benefactionModel->getBenefactionForDonor($benefactionID),
                'benefaction_requests' => $this->benefactionModel->getBenefactionRequests($benefactionID)
            ];   
            
            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];           

            // Determine the availability status
            $availabilityStatus = $data['benefaction_details']->availabilityStatus;

            // Define the view file based on the availability status
            $viewFile = '';

            switch ($availabilityStatus) {
                case 0:
                    // Pending requests view
                    $viewFile = 'donor/viewPostedBenefactionsPending';
                    break;
                case 1:
                    // Accepted requests view
                    $viewFile = 'donor/viewPostedBenefactionsRequested';
                    break;
                case 2:
                    // Completed requests view
                    $viewFile = 'donor/viewPostedBenefactionsCompleted';
                    break;
                default:
                    // Default view for unknown status
                    $viewFile = 'donor/viewPostedBenefactionsPending';
                    break;
            }

            $this->view($viewFile, $data, $other_data);
        } else {
            // Handle the case where benefactionID is not set
            // Redirect or show an error message
            echo "Benefaction ID is missing.";
        }
    }

    // Edit Posted Benefactions
    public function editPostedBenefactions(){
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'benefactionID' => $_POST['benefactionID'],
                'itemBenefaction' => trim($_POST['itemBenefaction']),
                'benefactionCategory' => trim($_POST['benefactionCategory']),
                'quantityBenfaction' => trim($_POST['quantityBenfaction']),
                'benefactionDescription' => trim($_POST['benefactionDescription']),

                'availabilityStatus' => '0',
                'availability' => 'pending',

                'itemBenefaction_err' => '',
                'benefactionCategory_err' => '',
                'quantityBenfaction_err' => '',
                'benefactionDescription_err' => ''
            ];
            
            // Map category value to category string
            if (!empty($_POST['benefactionCategory']) && $_POST['benefactionCategory'] != '0') {
                $categoryMap = [
                    '1' => 'Educational Supplies and Tools',
                    '2' => 'Clothing and Accessories',
                    '3' => 'Recreation and Sports Equipment',
                    '4' => 'Furniture and Appliances',
                    '5' => 'Health and Wellness Products',
                    '6' => 'Transportation and Mobility',
                    '7' => 'Literature and Reading Materials',
                    '8' => 'Others'
                ];

                $selectedCategoryId = $_POST['benefactionCategory'];
                $data['benefactionCategory'] = $categoryMap[$selectedCategoryId] ?? ''; // Get corresponding category string
            }
            // die(print_r($this->imgUpload('photoBenfaction1')));

            //validate the input fields seperately
            if(empty($data['itemBenefaction'])){
                $data['itemBenefaction_err']='Please enter the Item';
            }

            if (empty($_POST['benefactionCategory']) || $_POST['benefactionCategory'] == '0') {
                $data['benefactionCategory_err'] = 'Please select a category.';
            }

            if(empty($data['quantityBenfaction'])){
                $data['quantityBenfaction_err']='Please enter the Quantity';
            }

            if(empty($data['benefactionDescription'])){
                $data['benefactionDescription_err']='Please enter a small description about the item explaing it\'s condition and other details';
            }

            if (empty($data['itemBenefaction_err']) && empty($data['quantityBenfaction_err']) && empty($data['benefactionDescription_err']) && empty($data['benefactionCategory_err'])) {
                if ($this->benefactionModel->updateBenefaction($data)) {
                    $data = [
                        'title' => 'Edit Posted Benefactions',
                        'benefactionID' => $_POST['benefactionID'],
                        'benefaction_details' => $this->benefactionModel->getBenefactionForDonor($_POST['benefactionID']),
                        'success' => true
                    ];

                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];

                    $this->view('donor/editPostedBenefactions', $data, $other_data);

                }else{
                    $data = [
                        'fail' => true
                    ];
                    
                    die('Something Went Wrong');
                }
            }else{
                $data = [
                    'title' => 'Edit Posted Benefactions',
                    'benefaction_details' => $this->benefactionModel->getBenefactionForDonor($benefactionID)
                ];

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];

                $this->view('donor/editPostedBenefactions', $data, $other_data);
            }

        } else {
            //Pass data to the view
            $data = [
                'title' => 'Edit Posted Benefactions',
                'benefactionID' => $_GET['benefactionID'],
                'benefaction_details' => $this->benefactionModel->getBenefactionForDonor($_GET['benefactionID']),
            ];

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view('donor/editPostedBenefactions', $data, $other_data);
        }

    }

    // Delete Benefactions
    public function deleteBenefactions() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['benefactionID'])) {
                $benefactionID = $_POST['benefactionID'];
                
                // Call model method to delete benefaction
                if ($this->benefactionModel->deleteBenefaction($benefactionID)) {
                    // Deletion successful, redirect or reload data

                    // Fetch updated benefactions data
                    $data = [
                        'pendingBenefaction' => $this->benefactionModel->getPendingBenefaction(),

                        'onProgressBenefaction' => $this->benefactionModel->getOnProgressBenefaction(),
                        
                        'completedBenefaction' => $this->benefactionModel->getCompletedBenefaction()
                    ];

                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];

                    // Pass the updated data to the view
                    $this->view('donor/postedBenefactions', $data, $other_data);
                } else {
                    // Handle deletion failure (e.g., show error message)
                    die('Failed to delete benefaction.');
                }
            }
        }
    }

    public function viewBenefactionRequest($doneeID = null, $benefactionID = null) {
        if (empty($doneeID || empty($benefactionID))) {
            redirect('pages/404');           
        }

        $data = [
            'title' => 'View Benefaction Request',
            'benefactionRequest_details' => $this->benefactionModel->getBenefactionRequestDetails($benefactionID, $doneeID),
            'user_profile' => $this->benefactionModel->getUserProfile($doneeID, $benefactionID)
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        if (!$data['benefactionRequest_details'][0]) {
            redirect('pages/404');
        }

        // Get verificationStatus from benefactionRequest_details
        $acceptanceStatus = $data['benefactionRequest_details'][0]->acceptanceStatus;

        // Determine which view to load based on verificationStatus
        if ($acceptanceStatus == 0) {
            $this->view('donor/viewBenefactionRequestPending', $data, $other_data);
        } elseif ($acceptanceStatus == 1) {
            $this->view('donor/viewBenefactionRequestAccepted', $data, $other_data);
        // } elseif ($acceptanceStatus == 3) {
        //     $this->view('donor/viewBenefactionRequestOngoing', $data, $other_data);
        } elseif ($acceptanceStatus == 2) {
            $this->view('donor/viewBenefactionRequestCompleted', $data, $other_data);
        } elseif ($acceptanceStatus == 10) {
            $this->view('donor/viewBenefactionRequestDeclined', $data, $other_data);
        } else {
            redirect('pages/404'); // Redirect to 404 page for unknown status
        }
    }

    //Get Details of One Selected Benefaction Request
    public function viewBenefactionRequestPending($doneeID = null, $benefactionID = null) {
        if (empty($doneeID || empty($benefactionID))) {
            redirect('pages/404');           
        }

        // die(print_r($benefactionID));

        $data = [
            'title' => 'View Benefaction Request',
            'benefactionRequest_details' => $this->benefactionModel->getBenefactionRequestDetails($benefactionID, $doneeID),
            'user_profile' => $this->benefactionModel->getUserProfile($doneeID, $benefactionID)
        ];

        die(print_r($data['user_profile']));

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        // die(print_r($data['benefactionRequest_details']));

        $this->view('donor/viewBenefactionRequestPending', $data, $other_data);
    }

    public function viewBenefactionRequestAccepted($doneeID = null, $benefactionID = null) {
        if (empty($doneeID || empty($benefactionID))) {
            redirect('pages/404');           
        }

        // die(print_r($benefactionID));

        $data = [
            'title' => 'View Benefaction Request',
            'benefactionRequest_details' => $this->benefactionModel->getBenefactionRequestDetails($benefactionID, $doneeID)
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        // die(print_r($data['benefactionRequest_details']));

        $this->view('donor/viewBenefactionRequestAccepted', $data, $other_data);
    }

    public function viewBenefactionRequestCompleted($doneeID = null, $benefactionID = null) {
        if (empty($doneeID || empty($benefactionID))) {
            redirect('pages/404');           
        }

        // die(print_r($benefactionID));

        $data = [
            'title' => 'View Benefaction Request',
            'benefactionRequest_details' => $this->benefactionModel->getBenefactionRequestDetails($benefactionID, $doneeID)
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        // die(print_r($data['benefactionRequest_details']));

        $this->view('donor/viewBenefactionRequestAccepted', $data, $other_data);
    }

    public function benefactionRequestDonationSubmit($doneeID = null, $benefactionID = null){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'benefactionID' => $benefactionID,
                'doneeID' => $doneeID,
                'donationQuantity' => trim($_POST['donationQuantity']),
                'deliveryReceipt' => $this->imgUpload('deliveryReceipt'),

                'donationQuantity_err' => '',
                'deliveryReceipt_err' => ''                              
            ];   
            
            if (empty($data['donationQuantity'])) {
                $data['donationQuantity_err'] = 'Please enter the quantity of donation.';
            }
            
            if (empty($data['deliveryReceipt'])) {
                $data['deliveryReceipt_err'] = 'Please upload the delivery receipt.';
            }

            if (empty($data['donationQuantity_err']) && empty($data['deliveryReceipt_err'])) {
                if ($this->benefactionModel->benefactionRequestDonationSubmit($data)) {
                    // Load the view with data
                    $viewData  = [
                        'title' => 'View Benefaction Request',
                        'benefactionRequest_details' => $this->benefactionModel->getBenefactionRequestDetails($benefactionID, $doneeID)
                    ];         

                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];                                
            
                    // Load View
                    $this->view('donor/viewBenefactionRequestAccepted', $viewData, $other_data);
                } else {
                    die('Something went wrong.');
                }
            } else {
                // Load view with errors

                $viewData  = [
                    'title' => 'View Benefaction Request',
                    'benefactionRequest_details' => $this->benefactionModel->getBenefactionRequestDetails($benefactionID, $doneeID),
                    'data' => $data
                ];         

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];

                $this->view('donor/viewBenefactionRequestAccepted', $viewData, $other_data);
            }

        }else{

            $viewData = [
                'donationQuantity' => '',

                'deliveryReceipt' => '',
    
                'donationQuantity_err' => '',
                'deliveryReceipt_err' => '',

                'benefactionRequest_details' => $this->benefactionModel->getBenefactionRequestDetails($benefactionID, $doneeID)
            ];


            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view('donor/viewBenefactionRequestAccepted', $viewData, $other_data);

        }

    }

    public function acceptBenefactionRequest() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['benefactionID']) && isset($_POST['doneeID'])) {
                
                $benefactionID = $_POST['benefactionID'];
                $doneeID = $_POST['doneeID'];
                
                // Update the status of the benefaction request
                if($this->benefactionModel->acceptBenefactionRequest($doneeID, $benefactionID)) {          

                    // Load the view with data
                    $data = [
                        'title' => 'View Posted Benefactions',
                        'benefaction_details' => $this->benefactionModel->getBenefactionForDonor($benefactionID),
                        'benefaction_requests' => $this->benefactionModel->getBenefactionRequests($benefactionID)
                    ];         
                    
                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];                                
            
                    // Load View
                    $this->view('donor/viewPostedBenefactionsPending', $data, $other_data);
                } else {
                    die('Benefaction ID or Donee ID not found.');
                }
            }
        }
    }

    public function declineBenefactionRequest() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['benefactionID']) && isset($_POST['doneeID'])) {
                
                $benefactionID = $_POST['benefactionID'];
                $doneeID = $_POST['doneeID'];
                
                // Update the status of the benefaction request
                if($this->benefactionModel->declineBenefactionRequest($doneeID, $benefactionID)) {          

                    // Load the view with data
                    $data = [
                        'title' => 'View Posted Benefactions',
                        'benefaction_details' => $this->benefactionModel->getBenefactionForDonor($benefactionID),
                        'benefaction_requests' => $this->benefactionModel->getBenefactionRequests($benefactionID)
                    ];         
                    
                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];                                
            
                    // Load View
                    $this->view('donor/viewPostedBenefactionsPending', $data, $other_data);
                } else {
                    die('Benefaction ID or Donee ID not found.');
                }
            }
        }
    }


    

    // ---------------------Student--------------------------

    public function addAppliedBenefaction(){  
        // die(print_r($_POST));

        if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization') {
            redirect('pages/404');
        }

        else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
                $data = [
                    'requestedQuantity' => trim($_POST['requestedQuantity']),
                    'reason' => trim($_POST['reason']),
                    'benefactionID' => trim($_POST['benefactionID']),
                    'err' => ''
                ];

                // Make sure errors are empty
                if (empty($data['err'])) {
                    
                
                    // Add Data to DB
                    if ($this->benefactionModel->addAppliedBenefaction($data)) {
                        if($_SESSION['user_type'] == 'student') {
                            redirect('student/benefactions');
                        }
                        else if ($_SESSION['user_type'] == 'organization') {
                        }
                        else {
                            die('User Type Not Found');
                        }
                    } else {
                        die('Something went wrong1');

                    }
                } else {
                    // Load view with errors
                    die(print_r($data));
                }
            }else{
                die('incorrect method!');
            }

        }
    }
}