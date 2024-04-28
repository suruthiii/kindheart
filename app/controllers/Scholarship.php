<?php
class Scholarship extends Controller {
    private $middleware;

    public function __construct(){
        $this->middleware = new AuthMiddleware();
        $this->middleware->checkAccess(['admin', 'superAdmin', 'donor', 'student']);
        $this->scholarshipModel = $this->model('ScholarshipModel');
        $this->userModel = $this->model('UserModel');
        $this->notificationModel = $this->model('NotificationModel');
    }

    public function manageScholarship($scholarship_ID = null) {
        if(($_SESSION['user_type'] != 'admin' && $_SESSION['user_type'] != 'superAdmin') || empty($_GET['scholarship_ID']) && empty($_POST['scholarship_ID'])) {
            redirect('pages/404');
        }

        else {
            // When we submit comments
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = [
                    'comment' => trim($_POST['comment']),
                    'scholarship_ID' => trim($_POST['scholarship_ID']),
                    'err' => ''
                ];


                // If the comment is empty load view with errors
                if(empty($data['comment'])) {
                    $donor_type = $this->scholarshipModel->getDonorType($_POST['scholarship_ID']);
                    
                    if($donor_type == 'company') {
                        $data = [
                            'title' => 'Home Page',
                            'scholarship_ID' => $_POST['scholarship_ID'],
                            'scholarship_details' => $this->scholarshipModel->getComScholarshipDetails($_POST['scholarship_ID'])
                        ];
                    }

                    else if($donor_type == 'individual') {
                        $data = [
                            'title' => 'Home Page',
                            'scholarship_ID' => $_POST['scholarship_ID'],
                            'scholarship_details' => $this->scholarshipModel->getIndScholarshipDetails($_POST['scholarship_ID'])
                        ];
                    }
        
                    else {
                        die('Donor Type Not Found');
                    }

                    $data['comments'] = $this->scholarshipModel->getAllComments($_POST['scholarship_ID']);

                    $data['err'] = 'Please enter your comment';

                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];

                    $this->view($_SESSION['user_type'].'/scholarship/managescholarship', $data, $other_data);
                }

                // If the comment is not empty insert comment to the database and redirect to Manage Montary view
                else {
                    if($this->scholarshipModel->addComment($data)) {
                        $donorID = $this->scholarshipModel->getDonorID($data['scholarship_ID']);

                        $this->notificationModel->createNotification('Manage Scholarship', 'manageScholarship', $_SESSION['user_id'], $donorID, $data['comment'], $data['scholarship_ID']);

                        redirect('scholarship/managescholarship?scholarship_ID='.$data['scholarship_ID']);
                    }
                }
            }    
            
            // Loading normal view when called with GET method
            else {
                $donor_type = $this->scholarshipModel->getDonorType($_GET['scholarship_ID']);
                
                if($donor_type == 'company') {
                    $data = [
                        'title' => 'Home Page',
                        'scholarship_ID' => $_GET['scholarship_ID'],
                        'scholarship_details' => $this->scholarshipModel->getComScholarshipDetails($_GET['scholarship_ID'])
                    ];
                }

                else if($donor_type == 'individual') {
                    $data = [
                        'title' => 'Home Page',
                        'scholarship_ID' => $_GET['scholarship_ID'],
                        'scholarship_details' => $this->scholarshipModel->getIndScholarshipDetails($_GET['scholarship_ID'])
                    ];
                }

                else {
                    die('Donor Type Not Found');
                }
            }

            $data['comments'] = $this->scholarshipModel->getAllComments($data['scholarship_ID']);

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view($_SESSION['user_type'].'/scholarship/managescholarship', $data, $other_data);
        }
    }    


    public function viewScholarship() {
        $donor_type = $this->scholarshipModel->getDonorType($_GET['scholarship_ID']);
            
        if($donor_type == 'company') {
            $data = [
                'title' => 'Home Page',
                'scholarship_ID' => $_GET['scholarship_ID'],
                'scholarship_details' => $this->scholarshipModel->getComScholarshipDetails($_GET['scholarship_ID'])
            ];
        }

        else if($donor_type == 'individual') {
            $data = [
                'title' => 'Home Page',
                'scholarship_ID' => $_GET['scholarship_ID'],
                'scholarship_details' => $this->scholarshipModel->getIndScholarshipDetails($_GET['scholarship_ID'])
            ];
        }

        else {
            die('Donor Type Not Found');
        }

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view($_SESSION['user_type'].'/scholarship/viewscholarship', $data, $other_data);
    }

    public function deleteScholarship() {
        if($_SESSION['user_type'] == 'student') {
            redirect('pages/404');
        }

        else {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if($this->scholarshipModel->deleteScholarship($_POST['scholarship_ID'])) {
                    redirect($_SESSION['user_type'].'/scholarship');
                }
            }
        }
    }

    public function donorAddScholarships(){
        //other actors' redirection
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'titleScholarship' => trim($_POST['titleScholarship']),
                'amountScholarship' => trim($_POST['amountScholarship']),
                'startDateScholarship' => trim($_POST['startDateScholarship']),
                'durationScholarship' => trim($_POST['durationScholarship']),
                'deadlineScholarship' => trim($_POST['deadlineScholarship']),
                'scholarshipDescription' => trim($_POST['scholarshipDescription']),

                'availabilityStatus' => '0',
                'availability' => 'pending',

                'titleScholarship_err' => '',
                'amountScholarship_err' => '',
                'startDateScholarship_err' => '',
                'durationScholarship_err' => '',
                'deadlineScholarship_err' => '',
                'scholarshipDescription_err' => ''
            ];
            // die(print_r($this->imgUpload('photoBenfaction1')));

            //validate the input fields seperately
            if (empty($data['titleScholarship'])) {
                $data['titleScholarship_err'] = 'Please enter the Scholarship Title';
            }

            if (empty($data['amountScholarship'])) {
                $data['amountScholarship_err'] = 'Please enter the Scholarship Amount';
            } elseif (!is_numeric($data['amountScholarship']) || $data['amountScholarship'] <= 0) {
                $data['amountScholarship_err'] = 'Scholarship Amount must be a valid positive number';
            }

            if (empty($data['startDateScholarship'])) {
                $data['startDateScholarship_err'] = 'Please select the Start Date';
            } else {
                $selectedStartDate = strtotime($data['startDateScholarship']);
                $today = strtotime('today');
            
                if ($selectedStartDate < $today) {
                    $data['startDateScholarship_err'] = 'Start Date cannot be in the past';
                }
            }            

            if (empty($data['durationScholarship'])) {
                $data['durationScholarship_err'] = 'Please enter the Duration (in months)';
            } elseif (!is_numeric($data['durationScholarship']) || $data['durationScholarship'] <= 0) {
                $data['durationScholarship_err'] = 'Duration must be a valid positive number';
            }

            date_default_timezone_set('Asia/Colombo');

            $dateObject = new DateTime(date('Y-m-d H:i:s'));

            if (empty($data['deadlineScholarship'])) {
                $data['deadlineScholarship_err'] = 'Please select the Deadline';
            } elseif (strtotime($data['deadlineScholarship']) < strtotime($dateObject->format('Y-m-d\TH:i'))) {
                $data['deadlineScholarship_err'] = 'Deadline cannot be in the past';
            }

            if (empty($data['scholarshipDescription'])) {
                $data['scholarshipDescription_err'] = 'Please enter a Description for the Scholarship';
            }

            if(empty($data['titleScholarship_err']) && empty($data['amountScholarship_err']) && empty($data['startDateScholarship_err']) && empty($data['durationScholarship_err']) && empty($data['deadlineScholarship_err']) && empty($data['scholarshipDescription_err'])){
                if($this->scholarshipModel->addScholarship($data)){
                    $data = [
                        'pendingScholarship' => $this->scholarshipModel->getPendingScholarship(),
            
                        'onProgressScholarship' => $this->scholarshipModel->getOnProgressScholarship(),
                        
                        'completedScholarship' => $this->scholarshipModel->getCompletedScholarship()
                    ];

                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];

                    $this->view('donor/postedScholarships', $data, $other_data);
                }else{
                    die('Something Went Wrong');
                }
            }else{
                //Load View
                $this->view('donor/donorAddScholarships', $data);
            }

        }else{
            $data = [
                'titleScholarship' => '',
                'amountScholarship' => '',
                'startDateScholarship' => '',
                'durationScholarship' => '',
                'deadlineScholarship' => '',
                'scholarshipDescription' => '',

                'titleScholarship_err' => '',
                'amountScholarship_err' => '',
                'startDateScholarship_err' => '',
                'durationScholarship_err' => '',
                'deadlineScholarship_err' => '',
                'scholarshipDescription_err' => ''
            ];

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view('donor/donorAddScholarships', $data, $other_data);
        }
    }

    public function postedScholarships(){
        // Load the view with data
        $data = [
            'pendingScholarship' => $this->scholarshipModel->getPendingScholarship(),

            'onProgressScholarship' => $this->scholarshipModel->getOnProgressScholarship(),
            
            'completedScholarship' => $this->scholarshipModel->getCompletedScholarship()
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        //Load View
        $this->view('donor/postedScholarships', $data, $other_data);
    }

    public function viewPostedScholarships() {
        // Check if scholarshipID is set in the POST request
        if(isset($_GET['scholarshipID'])) {
            // Get the scholarshipID from the POST request
            $scholarshipID = $_GET['scholarshipID'];            

            // Load the view with data
            $data = [
                'title' => 'View Posted Scholarships',
                'scholarship_details' => $this->scholarshipModel->getScholarship($scholarshipID)
                // 'scholarship_applications' => $this->scholarshipModel->getScholarshipApplications($scholarshipID)
            ];

            // die(print_r($data));
            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];
    
            // Load View
            $this->view('donor/viewPostedscholarships', $data, $other_data);
        } else {
            // Handle the case where scholarshipID is not set
            // Redirect or show an error message
            echo "scholarship ID is missing.";
        }
    }

    public function editPostedScholarships(){
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'scholarshipID' => $_POST['scholarshipID'],
                'titleScholarship' => trim($_POST['titleScholarship']),
                'amountScholarship' => trim($_POST['amountScholarship']),
                'startDateScholarship' => trim($_POST['startDateScholarship']),
                'durationScholarship' => trim($_POST['durationScholarship']),
                'deadlineScholarship' => trim($_POST['deadlineScholarship']),
                'scholarshipDescription' => trim($_POST['scholarshipDescription']),

                'availabilityStatus' => '0',
                'availability' => 'pending',

                'titleScholarship_err' => '',
                'amountScholarship_err' => '',
                'startDateScholarship_err' => '',
                'durationScholarship_err' => '',
                'deadlineScholarship_err' => '',
                'scholarshipDescription_err' => ''
            ];
            
            
            //validate the input fields seperately
            if (empty($data['titleScholarship'])) {
                $data['titleScholarship_err'] = 'Please enter the Scholarship Title';
            }

            if (empty($data['amountScholarship'])) {
                $data['amountScholarship_err'] = 'Please enter the Scholarship Amount';
            } elseif (!is_numeric($data['amountScholarship']) || $data['amountScholarship'] <= 0) {
                $data['amountScholarship_err'] = 'Scholarship Amount must be a valid positive number';
            }

            if (empty($data['startDateScholarship'])) {
                $data['startDateScholarship_err'] = 'Please select the Start Date';
            } else {
                $selectedStartDate = strtotime($data['startDateScholarship']);
                $today = strtotime('today');
            
                if ($selectedStartDate < $today) {
                    $data['startDateScholarship_err'] = 'Start Date cannot be in the past';
                }
            }            

            if (empty($data['durationScholarship'])) {
                $data['durationScholarship_err'] = 'Please enter the Duration (in months)';
            } elseif (!is_numeric($data['durationScholarship']) || $data['durationScholarship'] <= 0) {
                $data['durationScholarship_err'] = 'Duration must be a valid positive number';
            }

            if (empty($data['deadlineScholarship'])) {
                $data['deadlineScholarship_err'] = 'Please select the Deadline';
            } elseif (strtotime($data['deadlineScholarship']) < strtotime('today')) {
                $data['deadlineScholarship_err'] = 'Deadline cannot be in the past';
            }

            if (empty($data['scholarshipDescription'])) {
                $data['scholarshipDescription_err'] = 'Please enter a Description for the Scholarship';
            }
            

            if(empty($data['titleScholarship_err']) && empty($data['amountScholarship_err']) && empty($data['startDateScholarship_err']) && empty($data['durationScholarship_err']) && empty($data['deadlineScholarship_err']) && empty($data['scholarshipDescription_err'])){
                // die(print_r($data));
                if($this->scholarshipModel->updateScholarship($data)){
                    $data = [
                        'title' => 'Edit Posted Scholarships',
                        'scholarshipID' => $_POST['scholarshipID'],
                        'scholarship_details' => $this->scholarshipModel->getScholarship($_POST['scholarshipID']),
                        'success' => true
                    ];

                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];
                                        
                    $this->view('donor/editPostedScholarships', $data, $other_data);

                }else{
                    $data = [
                        'fail' => true
                    ];
                    
                    die('Something Went Wrong');
                }
            }else{
                $data = [
                    'title' => 'Edit Posted Scholarships',
                    'scholarship_details' => $this->scholarshipModel->getScholarship($scholarshipID)
                ];

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];

                $this->view('donor/editPostedScholarships', $data, $other_data);
            }

        } else {
            //Pass data to the view
            $data = [
                'title' => 'Edit Posted Scholarships',
                'scholarshipID' => $_GET['scholarshipID'],
                'scholarship_details' => $this->scholarshipModel->getScholarship($_GET['scholarshipID']),
            ];

            // die(print_r($data));

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view('donor/editPostedScholarships', $data, $other_data);
        }

    }

    public function deleteScholarships() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['scholarshipID'])) {
                $scholarshipID = $_POST['scholarshipID'];
                
                // Call model method to delete scholarship
                if ($this->scholarshipModel->deleteScholarship($scholarshipID)) {
                    // Deletion successful, redirect or reload data

                    // Fetch updated scholarships data
                    $data = [
                        'pendingScholarship' => $this->scholarshipModel->getPendingScholarship(),

                        'onProgressScholarship' => $this->scholarshipModel->getOnProgressScholarship(),
                        
                        'completedScholarship' => $this->scholarshipModel->getCompletedScholarship()
                    ];

                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];

                    // Pass the updated data to the view
                    $this->view('donor/postedScholarships', $data, $other_data);
                } else {
                    // Handle deletion failure (e.g., show error message)
                    die('Failed to delete Scholarship.');
                }
            }
        }
    }    

        // $data = [
        //     'title' => 'View Scholarship Application',
        //     'ScholarshipApplication_details' => $this->scholarshipModel->getScholarshipApplicationDetails($scholarshipID, $doneeID)
        // ];

        // $other_data = [
        //     'notification_count' => $this->notificationModel->getNotificationCount(),
        //     'notifications' => $this->notificationModel->viewNotifications()
        // ];

        // // die(print_r($data['benefactionRequest_details']));

        // $this->view('donor/viewScholarshipApplication', $data, $other_data);
        
  
    public function viewDonorProfile($scholarship_ID = null, $donor_ID = null) {
        if($_SESSION['user_type'] == 'donor') {
            redirect('pages/404');
        }

        else {
            $donorType = $this->userModel->getDonorType($donor_ID);
            
            if($donorType == 'company'){
            
                $data = [
                    'title' => 'Home Page',
                    'scholarship_ID' => $scholarship_ID,
                    'details' => $this->userModel->getDonorCom($donor_ID)
                ];

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];

                $this->view($_SESSION['user_type'].'/scholarship/viewDonorComProfile', $data, $other_data);
            }

            else if($donorType == 'individual') {
                $data = [
                    'title' => 'Home Page',
                    'scholarship_ID' => $scholarship_ID,
                    'details' => $this->userModel->getDonorInd($donor_ID)
                ];

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];

                $this->view($_SESSION['user_type'].'/scholarship/viewDonorIndProfile', $data, $other_data);
            }

            else {
                die('Donor Type Not Found');
            }
        }
    }


    //adding student requestst to the db(add applying scholarships)

    // public function addAppliedScholarship(){  
    //     // die(print_r($_POST));

    //     if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization') {
    //         redirect('pages/404');
    //     }

    //     else {
    //         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
    //             $data = [
    //                 'requestedQuantity' => trim($_POST['requestedQuantity']),
    //                 'reason' => trim($_POST['reason']),
    //                 'benefactionID' => trim($_POST['benefactionID']),
    //                 'err' => ''
    //             ];

    //             // Make sure errors are empty
    //             if (empty($data['err'])) {
                    
                
    //                 // Add Data to DB
    //                 if ($this->benefactionModel->addAppliedBenefaction($data)) {
    //                     if($_SESSION['user_type'] == 'student') {
    //                         redirect('student/benefactions');
    //                     }
    //                     else if ($_SESSION['user_type'] == 'organization') {
    //                     }
    //                     else {
    //                         die('User Type Not Found');
    //                     }
    //                 } else {
    //                     die('Something went wrong1');

    //                 }
    //             } else {
    //                 // Load view with errors
    //                 die(print_r($data));
    //             }
    //         }else{
    //             die('incorrect method!');
    //         }

    //     }
    // }





}




  