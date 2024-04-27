<?php
class Admin extends Controller {
    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only admins are allowed to access admin pages
        $this->middleware->checkAccess(['admin']);
        $this->userModel = $this->model('UserModel');
        $this->successStoryModel = $this->model('SuccessStoryModel');
        $this->scholarshipModel = $this->model('ScholarshipModel');
        $this->projectModel = $this->model('ProjectModel');
        $this->benefactionModel = $this->model('BenefactionModel');
        $this->complaintModel = $this->model('ComplaintModel');
        $this->notificationModel = $this->model('NotificationModel');
    }

    public function index(){
        $data = [
            'title' => 'Home page',
            'requests' => $this->userModel->getAdminRequestCount(),
            'complaints' => $this->userModel->getAdminComplaintCount()
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('admin/index', $data, $other_data);
    }

    public function necessity() {
        $data = [
            'title' => 'Home page'
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('admin/necessity', $data, $other_data);
    }

    public function project() {
        $data = [
            'title' => 'Home page',
            'pending' => $this->projectModel->getAllPendingProjects(),
            'confirmed' => $this->projectModel->getAllConfirmedProjects(),
            'ongoing' => $this->projectModel->getAllOngoingProjects()
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('admin/project', $data, $other_data);
    }

    public function scholarship() {
        $data = [
            'title' => 'Home page',
            'pending' => $this->scholarshipModel->getAllPendingScholarships(),
            'confirmed' => $this->scholarshipModel->getAllConfirmedScholarships(),
            'ongoing' => $this->scholarshipModel->getAllOngoingScholarships()
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('admin/scholarship', $data, $other_data);
    }

    public function benefaction() {
        $data = [
            'title' => 'Home page',
            'pending' => $this->benefactionModel->getAllPendingBenefactions(),
            'on_progress' => $this->benefactionModel->getAllOnProgressBenefactions()
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('admin/benefaction', $data, $other_data);
    }

    public function successStory() {
        $data = [
            'title' => 'Home page',
            'successstories' => $this->successStoryModel->getSuccessStories()
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];
        
        $this->view('admin/successStory', $data, $other_data);
    }

    public function user() {
        $data = [
            'title' => 'Home page'
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('admin/user', $data, $other_data);
    }

    public function request() {
        $data = [
            'title' => 'Home page'
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('admin/request', $data, $other_data);
    }

    public function report() {
        $data = [
            'title' => 'Home page'
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view('admin/report', $data, $other_data);
    }

    public function complaint() {
        $data = [
            'title' => 'Home page',
            'unassigned' => $this->complaintModel->getAllUnassignedComplaints(),
            'assigned' => $this->complaintModel->getAssignedComplaints()
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];
        
        $this->view('admin/complaint', $data, $other_data);
    }

    public function userBan() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            if($this->userModel->userBan($_POST['user_ID'])) {
                $userType = $this->userModel->getUserType($_POST['user_ID']);

                if($userType == 'student') {
                    redirect('user/adminStudent');
                }

                else if($userType == 'organization') {
                    redirect('user/organization');
                }

                else if($userType == 'donor') {
                    redirect('user/adminDonor');
                }

                else
                    die('User Type Not Found');
            }
            
            else
                die('User Not Found');
        }
    }

}