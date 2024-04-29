<?php
class Donor extends Controller {
    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only donors are allowed to access donor pages
        $this->middleware->checkAccess(['donor']);
        $this->userModel = $this->model('UserModel');
        $this->donorModel = $this->model('DonorModel');
        $this->notificationModel = $this->model('NotificationModel');
    }

    public function index(){
        // Check if the user is logged in (session check)
        if (!isset($_SESSION['user_id'])) {
            redirect('users/login'); // Redirect to login page if not logged in
        }

        // Get donor-specific data from the model
        // $userId = $_SESSION['user_id'];
        $userId = '5';
        // $username = $_SESSION['username'];
        $username = 'donor1';

        $data = [
            'title' => 'Welcome Back ' . $username,
            'active_donors' => $this->donorModel->getTotalActiveDonors(),
            'active_donees' => $this->donorModel->getTotalActiveDonees(),
            'total_goods_quantity' => $this->donorModel->getTotalGoodsDonationQuantity($userId),
            'total_monetary_quantity' => $this->donorModel->getTotalMonetaryDonationQuantity($userId),
            // 'total_helped_donees' => $this->donorModel->getTotalHelpedDonees($userId),
        ];

        // die(print_r($data['total_monetary_donations']));

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];
    
        // Load the view with data
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
    
}