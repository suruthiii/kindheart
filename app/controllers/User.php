<?php
class User extends Controller {
    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only admins are allowed to access admin/superadmin pages
        $this->middleware->checkAccess(['superAdmin', 'admin']);
        $this->userModel = $this->model('UserModel');
        $this->notificationModel = $this->model('NotificationModel');
    }

    public function student(){
        $data = [
            'title' => 'Home page',
            'students' => $this->userModel->viewStudents()
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view($_SESSION['user_type'].'/user/student', $data, $other_data);
    }

    public function viewStudent($student_ID = null){
        if(empty($student_ID)) {
            redirect('pages/404');
        }

        $data = [
            'title' => 'Home page',
            'student_details' => $this->userModel->getStudent($student_ID)
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view($_SESSION['user_type'].'/user/viewStudent', $data, $other_data);
    }

    public function organization(){
        $data = [
            'title' => 'Home page',
            'organizations' => $this->userModel->viewOrganizations()
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view($_SESSION['user_type'].'/user/organization', $data, $other_data);
    }

    public function viewOrganization($org_ID = null){
        if(empty($org_ID)) {
            redirect('pages/404');
        }

        $data = [
            'title' => 'Home page',
            'organization_details' => $this->userModel->getOrganization($org_ID)
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view($_SESSION['user_type'].'/user/viewOrganization', $data, $other_data);
    }

    public function donor(){
        $data = [
            'title' => 'Home page',
            'donors' => $this->userModel->viewDonors()
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];
        
        $this->view($_SESSION['user_type'].'/user/donor', $data, $other_data);
    }

    public function viewDonor($donor_ID = null){
        if(empty($donor_ID)) {
            redirect('pages/404');
        }

        $donorType = $this->userModel->getDonorType($donor_ID);

        if ($donorType == 'individual') {
            $data = [
                'title' => 'Home page',
                'donor_details' => $this->userModel->getDonorInd($donor_ID)
            ];

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view($_SESSION['user_type'].'/user/viewDonorInd', $data, $other_data);
        }

        else if ($donorType == 'company') {
            $data = [
                'title' => 'Home page',
                'donor_details' => $this->userModel->getDonorCom($donor_ID)
            ];

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view($_SESSION['user_type'].'/user/viewDonorCom', $data, $other_data);
        }

        else {
            die('Donor Type Not Found');
        }
    }

    public function deleteUser() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($this->userModel->deleteUser($_POST['user_ID'])) {
                $userType = $this->userModel->getUserType($_POST['user_ID']);

                if($userType == 'student') {
                    redirect('user/student');
                }

                else if($userType == 'organization') {
                    redirect('user/organization');
                }

                else if($userType == 'donor') {
                    redirect('user/donor');
                }

                else {
                    die('User Type Not Found');
                }
            }
        }
    }

    public function banUser() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($this->userModel->banUser($_POST['user_ID'])) {
                $userType = $this->userModel->getUserType($_POST['user_ID']);

                if($userType == 'student') {
                    redirect('user/student');
                }

                else if($userType == 'organization') {
                    redirect('user/organization');
                }

                else if($userType == 'donor') {
                    redirect('user/donor');
                }

                else {
                    die('User Type Not Found');
                }

            }

            else {
                die('User Not Found');
            }
        }
    }
}