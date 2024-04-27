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

    public function editprofile(){
        $data = [
            'title' => 'Home page'
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('organization/editprofile', $data, $other_data);
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

    public function viewdonors(){
        $data = [
            'title' => 'Home page'
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('organization/viewdonors', $data, $other_data);
    }
}