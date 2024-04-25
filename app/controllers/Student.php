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

    // public function necessityRequest(){
    //     $data = [
    //         'title' => 'Home page'
    //     ];
    //     $this->view('student/necessityRequest', $data);
    // }

    // public function monetoryfundingRequest(){
    //     $data = [
    //         'title' => 'Home page'
    //     ];
    //     $this->view('student/monetoryfundingRequest', $data);
    // }

    // public function physicalgoodsRequest(){
    //     $data = [
    //         'title' => 'Home page'
    //     ];
    //     $this->view('student/physicalgoodsRequest', $data);
    // }

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

    // public function editStory(){
    //     $data = [
    //         'title' => 'Home page'
    //     ];
    //     $this->view('student/editStory', $data);
    // }

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

    public function benefactions(){

        $data = [
            'title' => 'Home page',
            'benefactions' => $this->benefactionModel->getBenefactions(),
            'appliedBenefactions' => $this->benefactionModel->getAppliedBenefactions(),
        ];

        // die(print_r($data['benefactions']));

        // die(print_r($data['benefactions']));

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('student/benefactions', $data, $other_data);
    }

    public function scholarships(){

        $data = [
            'title' => 'Home page'
            // 'benefactions' => $this->BenefactionModel->getBenefactions()
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('student/scholarships', $data, $other_data);
    }

    public function benefactionview(){

        $benefactionID = $_GET['benefactionID'];

        $data = [
            'title' => 'Home page',
            'benefactions' => $this->benefactionModel->getBenefaction($benefactionID)
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('student/benefactionview', $data, $other_data);
    }

    public function ApplyForBenefaction(){

        $benefactionID = $_GET['benefactionID'];

        $data = [
            'title' => 'Home page',
            'benefactionID' => $benefactionID,
            'appliedBenefactions' => $this->benefactionModel->getAppliedBenefactions(),
            'benefactions' => $this->benefactionModel->getBenefaction($benefactionID)
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


    

    
    
}