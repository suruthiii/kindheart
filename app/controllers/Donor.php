<?php
class Donor extends Controller {
    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only donors are allowed to access donor pages
        $this->middleware->checkAccess(['donor']);
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

    public function donorSelectDonation(){
        $data = [
            'title' => 'Donation Selection Page'
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('donor/donorSelectDonation', $data, $other_data);
    }

    // public function getDonorDashboard(){
    //     $data = [
    //         'graph' => $this->donor->getGraphData()
    //     ];

    //     $this->view('index', $data);
    // }

    
}