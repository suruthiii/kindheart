<?php
class Request extends Controller {
    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only admins are allowed to access admin pages
        $this->middleware->checkAccess(['admin', 'superAdmin']);
        $this->requestModel = $this->model('RequestModel');
        $this->userModel = $this->model('UserModel');
        $this->notificationModel = $this->model('NotificationModel');
    }

    public function studentRequest(){
        if($_SESSION['user_type'] == 'admin') {
            $data = [
                'title' => 'Home page',
                'unassigned' => $this->requestModel->getAllUnassignedStudentRequests(),
                'assigned' => $this->requestModel->getAssignedStudentRequests()
            ];

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view('admin/request/studentRequest', $data, $other_data);
        }

        else if($_SESSION['user_type'] == 'superAdmin') {
            $data = [
                'title' => 'Home page',
                'unassigned' => $this->requestModel->getAllUnassignedStudentRequests(),
                'assigned' => $this->requestModel->getAllAssignedStudentRequests(),
                'admins' => $this->userModel->viewAdmins()
            ];

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view('superAdmin/request/studentRequest', $data, $other_data);
        }

        else {
            die('User Type Not Found');
        }
    }

    public function organizationRequest(){
        if($_SESSION['user_type'] == 'admin') {
            $data = [
                'title' => 'Home page',
                'unassigned' => $this->requestModel->getAllUnassignedOrganizationRequests(),
                'assigned' => $this->requestModel->getAssignedOrganizationRequests()
            ];

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view('admin/request/organizationRequest', $data, $other_data);
        }

        else if($_SESSION['user_type'] == 'superAdmin') {
            $data = [
                'title' => 'Home page',
                'unassigned' => $this->requestModel->getAllUnassignedOrganizationRequests(),
                'assigned' => $this->requestModel->getAllAssignedOrganizationRequests(),
                'admins' => $this->userModel->viewAdmins()
            ];

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view('superAdmin/request/organizationRequest', $data, $other_data);
        }

        else {
            die('User Type Not Found');
        }
    }

    public function viewUnassignedStudentRequest($student_ID = null) {
        if(empty($student_ID)) {
            redirect('pages/404');
        }

        if($_SESSION['user_type'] == 'admin') {
            $data = [
                'title' => 'Home page',
                'student_details' => $this->requestModel->getStudent($student_ID)
            ];

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view('admin/request/viewUnassignedStudentRequest', $data, $other_data);
        }

        else if($_SESSION['user_type'] == 'superAdmin') {
            $data = [
                'title' => 'Home page',
                'student_details' => $this->requestModel->getStudent($student_ID),
                'admins' => $this->userModel->viewAdmins()
            ];

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view('superAdmin/request/viewUnassignedStudentRequest', $data, $other_data);
        }

        else {
            die('User Type Not Found');
        }
    }

    public function viewAssignedStudentRequest($student_ID = null) {
        if(empty($student_ID)) {
            redirect('pages/404');
        }

        $data = [
            'title' => 'Home page',
            'student_details' => $this->requestModel->getStudent($student_ID),
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view($_SESSION['user_type'].'/request/viewAssignedStudentRequest', $data, $other_data);
    }

    public function viewUnassignedOrganizationRequest($org_ID = null){
        if(empty($org_ID)) {
            redirect('pages/404');
        }

        if($_SESSION['user_type'] == 'admin') {
            $data = [
                'title' => 'Home page',
                'organization_details' => $this->requestModel->getOrganization($org_ID)
            ];

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view($_SESSION['user_type'].'/request/viewunassignedOrganizationRequest', $data, $other_data);
        }
        
        else if($_SESSION['user_type'] == 'superAdmin') {
            $data = [
                'title' => 'Home page',
                'organization_details' => $this->requestModel->getOrganization($org_ID),
                'admins' => $this->userModel->viewAdmins()
    
            ];

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view($_SESSION['user_type'].'/request/viewunassignedOrganizationRequest', $data, $other_data);
        }

        else {
            die('User Type Not Found');
        }
    }

    public function viewAssignedOrganizationRequest($org_ID = null){
        if(empty($org_ID)) {
            redirect('pages/404');
        }

        $data = [
            'title' => 'Home page',
            'organization_details' => $this->requestModel->getOrganization($org_ID)
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $this->view($_SESSION['user_type'].'/request/viewAssignedOrganizationRequest', $data, $other_data);
    }

    public function unassignAdmin() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($this->requestModel->unassignAdmin($_POST['user_ID'])) {
                $doneeType = $this->requestModel->getDoneeType($_POST['user_ID']);
                
                if($doneeType == "student") {
                    redirect('request/studentrequest');
                }

                else if($doneeType == "organization") {
                    redirect('request/organizationrequest');
                }

                else {
                    die('User Type Not Found');
                }
            }
            
        }
    }

    public function assignAdmin() {
        if($_SESSION['user_type'] != 'superAdmin') {
            redirect('pages/404');
        }

        else {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if($this->requestModel->assignAdmin($_POST['admin_ID'], $_POST['user_ID'])) {
                    $doneeType = $this->requestModel->getDoneeType($_POST['user_ID']);
                
                    if($doneeType == "student") {
                        redirect('request/studentrequest');
                    }

                    else if($doneeType == "organization") {
                        redirect('request/organizationrequest');
                    }

                    else {
                        die('User Type Not Found');
                    }
                }
            }
        }
    }

    public function assignMe() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($this->requestModel->assignMe($_POST['user_ID'])) {
                $doneeType = $this->requestModel->getDoneeType($_POST['user_ID']);

                if($doneeType == 'student') {
                    redirect('request/studentrequest');
                }

                else if($doneeType == 'organization') {
                    redirect('request/organizationrequest');
                }

                else {
                    die('User Type Not Found');
                }
            }
        }
    }

    public function acceptDonee() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($this->requestModel->acceptDonee($_POST['user_ID'])) {
                $doneeType = $this->requestModel->getDoneeType($_POST['user_ID']);

                if($doneeType == 'student') {
                    redirect('request/studentrequest');
                }

                else if($doneeType == 'organization') {
                    redirect('request/organizationrequest');
                }

                else {
                    die('User Type Not Found');
                }
            }
        }
    }

    public function rejectDonee() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($this->requestModel->rejectDonee($_POST['user_ID'])) {
                $doneeType = $this->requestModel->getDoneeType($_POST['user_ID']);

                if($doneeType == 'student') {
                    redirect('request/studentrequest');
                }

                else if($doneeType == 'organization') {
                    redirect('request/organizationrequest');
                }

                else {
                    die('User Type Not Found');
                }
            }
        }
    }
}