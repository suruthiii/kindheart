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
        $userId = '4';
        // $username = $_SESSION['username'];
        $username = 'donor1';

        $data = [
            'title' => 'Welcome Back ' . $username,
            'active_donors' => $this->donorModel->getTotalActiveDonors(),
            'active_donees' => $this->donorModel->getTotalActiveDonees(),
            'total_donations' => $this->donorModel->getTotalDonationCount(user_id),
            // 'total_physical_goods_donations' => $this->donorModel->getTotalPhysicalGoodsDonations($userId),
            // 'total_donated_projects' => $this->donorModel->getTotalDonatedProjects($userId),
            // 'total_helped_students' => $this->donorModel->getTotalHelpedStudents($userId),
            // 'total_helped_organizations' => $this->donorModel->getTotalHelpedOrganizations($userId)
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