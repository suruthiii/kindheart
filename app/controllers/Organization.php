<?php
class Organization extends Controller {
    private $middleware;
    private $organizationModel;

    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only organizations are allowed to access organization pages
        $this->middleware->checkAccess(['organization']);
        $this->organizationModel = $this->model('organizationModel');
        $this->notificationModel = $this->model('NotificationModel');
        $this->successStoryModel = $this->model('SuccessStoryModel');
        $this->benefactionModel = $this->model('BenefactionModel');
        $this->userModel= $this->model('userModel');
    }

    public function index(){
        $data = [
            'title' => 'Home page',
            'totalReceivedAmount' => $this->organizationModel->getTotalReceivedAmount(),
            'totalReceivedQuantity' => $this->organizationModel->getTotalReceivedQuantity()
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('organization/index', $data, $other_data);
    }

    public function choosethenecessityType(){
        $data = [
            'title' => 'Home page'
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('organization/choosethenecessityType', $data, $other_data);
    }

    public function addmonetarynecessity(){
        $data = [
            'title' => 'Home page'
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('organization/addmonetarynecessity', $data, $other_data);
    }

    public function addgoodsnecessity(){
        $data = [
            'title' => 'Home page'
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('organization/addgoodsnecessity', $data, $other_data);
    }

    public function addProject(){
        $data = [
            'title' => 'Home page'
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('organization/addProject', $data, $other_data);
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

        $this->view('organization/successstory', $data, $other_data);
    }

    public function benefactions(){

        $data = [
            'title' => 'Home page',
            'benefactions' => $this->benefactionModel->getBenefactions(),
            'appliedBenefactions' => $this->benefactionModel->getAppliedBenefactions(),

        ];
        // die(print_r($data['appliedBenefactions']));
      
        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('organization/benefactions', $data, $other_data);
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

        $this->view('organization/donorList', $data, $other_data);

    }

    public function viewDonor($donorID = null){
        $data = [
            'title' => 'Home page',
            'donors' => $this->userModel->viewDonors(),
            'donorDetailsInd' => $this->userModel->getDonorInd($donorID),
            'donorDetailsOrg' => $this->userModel->getDonorCom($donorID)
        ];
     
        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('organization/donorView', $data, $other_data);

    }

    public function complaint(){
        $data = [
            'title' => 'Home page'
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('organization/complaint', $data, $other_data);
    }

    public function editProfile(){
        $userID =  $_SESSION['user_id'];

        $data = [
            'title' => 'Home page',
            'studentData' => $this->organizationModel->getStudentDetails($userID)
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('organization/editProfile', $data, $other_data);
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
                'institutionNameVisibility' => (isset($_POST['institutionNameVisibility'])) ? "1":"0",
                'caregiverNameVisibility' => (isset($_POST['caregiverNameVisibility'])) ? "1":"0",
                'caregiverTypeVisibility' => (isset($_POST['caregiverTypeVisibility'])) ? "1":"0",
                'caregiverRelationshipVisibility' => (isset($_POST['caregiverRelationshipVisibility'])) ? "1":"0",
                'caregiverOccupationVisibility' => (isset($_POST['caregiverOccupationVisibility'])) ? "1":"0",
                'studyingYearVisibility' => (isset($_POST['studyingYearVisibility'])) ? "1":"0",
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
                if ($this->organizationModel->editProfileDetails($data)) {
                    if ($_SESSION['user_type'] == 'student') {
                        redirect('student/editProfile');
                    }
                    
                    else if ($_SESSION['user_type'] == 'organization') {
                        redirect('student/editProfile');
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
}