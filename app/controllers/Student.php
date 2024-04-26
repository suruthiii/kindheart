<?php

class Student extends Controller {
    private $middleware;

    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only students are allowed to access student pages
        $this->middleware->checkAccess(['student']);
        $this->studentModel = $this->model('StudentModel');
        $this->successStoryModel = $this->model('SuccessStoryModel');
        $this->benefactionModel = $this->model('BenefactionModel');
        $this->notificationModel = $this->model('NotificationModel');
        $this->userModel= $this->model('userModel');
        $this->ScholarshipModel= $this->model('ScholarshipModel');
    }

    public function index(){
        $data = [
            'title' => 'Home page'
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('student/index', $data, $other_data);
    }



    public function necessities(){
        $data = [
            'title' => 'Home page'
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('student/necessities', $data, $other_data);
    }

    

    public function successstory(){
        
        $data = [
            'title' => 'Home page',
            'successstories' => $this->successStoryModel->getSuccessStories()
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];
        
        $this->view('student/successstory', $data, $other_data);
    }





    public function scholarships(){

        $data = [
            'title' => 'Home page',
            'scholarships' => $this->ScholarshipModel->getScholarships()
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('student/scholarships', $data, $other_data);
    }


    public function editProfile(){
        $userID =  $_SESSION['user_id'];

        $data = [
            'title' => 'Home page',
            'studentData' => $this->studentModel->getStudentDetails($userID)
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('student/editProfile', $data, $other_data);
    }


    public function editProfileDetails(){  
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           
            $data = [
                'fName' => trim($_POST['fName']),
                'lName' => trim($_POST['lName']),
                'gender' => trim($_POST['gender']),
                'dateOfBirth' => trim($_POST['dateOfBirth']),
                'nicNumber' => trim($_POST['nicNumber']),
                'institutionName' => trim($_POST['institutionName']),
                'studentType' => trim($_POST['studentType']),
                'caregiverName' => trim($_POST['caregiverName']),
                'caregiverType' => trim($_POST['caregiverType']),
                'caregiverRelationship' => trim($_POST['caregiverRelationship']),
                'caregiverOccupation' => trim($_POST['caregiverOccupation']),
                'studyingYear' => trim($_POST['studyingYear']),
                'phoneNumber' => trim($_POST['phoneNumber']),
                'branchName' => trim($_POST['branchName']),
                'bankName' => trim($_POST['bankName']),
                'accNumber' => trim($_POST['accNumber']),
                'accountHoldersName' => trim($_POST['accountHoldersName']),
                'address' => trim($_POST['address']),
                'receivingScholarships' => trim($_POST['receivingScholarships']),
                'err' => ''
            ];


            // Make sure errors are empty
            if (empty($data['err'])) {
            
                // Add Data to DB
                if ($this->studentModel->editProfileDetails($data)) {
                    if ($_SESSION['user_type'] == 'student') {
                        redirect('student/editProfile');
                    }
                    
                    else if ($_SESSION['user_type'] == 'organization') {
        
                    }
        
                    else {
                        die('User Type Not Found');
                    }
                    
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                die('Something went wrong');
                // $backend_data = $this->SuccessStoryModel->getStoryEditData($data['storyID']);

                // $story_data = [
                //     'title' => 'Edit Admin',
                //     'story_details' => [
                //         'storyID' => $backend_data->storyID,
                //         'title' => $backend_data->title, 
                //         'description' => $backend_data->description,
                //         'username' => $backend_data->username

                //     ],
                //     'err' => $data['err']
                // ];
                
                // $this->view('student/editStory', $story_data);
            }
        }else{
            die('incorrect method!');
        }
    }


    public function benefactions(){

        $data = [
            'title' => 'Home page',
            'benefactions' => $this->benefactionModel->getBenefactions(),
            'appliedBenefactions' => $this->benefactionModel->getAppliedBenefactions(),
            

        ];
        //die(print_r($data['appliedBenefactions']));
        
        // die(print_r($data['completedBenefaction']));

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('student/benefactions', $data, $other_data);
    }

    public function benefactionview(){

        $benefactionID = $_GET['benefactionID'];

        $data = [
            'title' => 'Home page',
            'benefactions' => $this->benefactionModel->getBenefaction($benefactionID),
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications(),
            
        ];

        $this->view('student/benefactionview', $data, $other_data);
    }

    public function benefactionviewNotApplied(){

        $benefactionID = $_GET['benefactionID'];

        $data = [
            'title' => 'Home page',
            'benefactions' => $this->benefactionModel->getBenefactionNotApplied($benefactionID),
           
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications(),
            
        ];

        $this->view('student/benefactionview', $data, $other_data);
    }


    public function ApplyForBenefaction(){

        $benefactionID = $_GET['benefactionID'];

        $data = [
            'title' => 'Home page',
            'benefactionID' => $benefactionID,
            'benefactions' => $this->benefactionModel->getBenefactionNotApplied($benefactionID),
            'appliedBenefactions' => $this->benefactionModel->getAppliedBenefactions(),
           
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('student/ApplyForBenefaction', $data, $other_data);
    }

    public function viewAppliedBenefaction($benefactionID = null){
        $data = [
            'title' => 'Home page',
            'benefactions' => $this->benefactionModel->getBenefaction($benefactionID),

        ];
     

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('student/viewAppliedBenefaction', $data, $other_data);
    }



    public function donors(){

        $data = [
            'title' => 'Home page',
            'donors' => $this->userModel->viewDonors()
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('student/donorList', $data, $other_data);

    }

    public function viewDonor(){

        $data = [
            'title' => 'Home page',
            'donors' => $this->userModel->viewDonors()
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('student/donorView', $data, $other_data);

    }


    public function sendAknowledgement(){  
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
           
            $data = [
                
                'benefactionID' => trim($_GET['benefactionID']),
                'doneeID' => trim($_GET['doneeID']),
                'err' => ''
            ];

            // die(print_r($data));


            // Make sure errors are empty
            if (empty($data['err'])) {
            
                // Add Data to DB
                if ($this->benefactionModel->sendBenefactionAknowledgement($data)) {
                    if ($_SESSION['user_type'] == 'student') {
                        redirect('student/AknowledgementSuccessful');
                    }
                    
                    else if ($_SESSION['user_type'] == 'organization') {
        
                    }
        
                    else {
                        die('User Type Not Found');
                    }
                    
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                die('Something went wrong');
                
            }
        }else{
            die('incorrect method!');
        }
    }

    public function sendBenefactionComplain(){  
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
           
            $data = [
                
                'benefactionID' => trim($_GET['benefactionID']),
                'doneeID' => trim($_GET['doneeID']),
                'err' => ''
            ];

            // die(print_r($data));


            // Make sure errors are empty
            if (empty($data['err'])) {
            
                // Add Data to DB
                if ($this->benefactionModel->sendBenefactionComplain($data)) {
                    if ($_SESSION['user_type'] == 'student') {
                        redirect('student/AknowledgementComplain');
                    }
                    
                    else if ($_SESSION['user_type'] == 'organization') {
        
                    }
        
                    else {
                        die('User Type Not Found');
                    }
                    
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                die('Something went wrong');
                
            }
        }else{
            die('incorrect method!');
        }
    }

    public function AknowledgementSuccessful(){

        $data = [
            'title' => 'Home page',
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('student/AknowledgementSuccessful', $data, $other_data);

    }

    public function AknowledgementComplain(){

        $data = [
            'title' => 'Home page',
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('student/AknowledgementComplain', $data, $other_data);

    }









    

    

    
    
}