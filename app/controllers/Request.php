<?php
class Request extends Controller {
    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only admins are allowed to access admin pages
        $this->middleware->checkAccess(['admin', 'superAdmin']);
        $this->requestModel = $this->model('RequestModel');
    }

    public function studentRequest(){
        if($_SESSION['user_type'] == 'admin') {
            $data = [
                'title' => 'Home page',
                'unassigned' => $this->requestModel->getAllUnassignedStudentRequests(),
                'assigned' => $this->requestModel->getAssignedStudentRequests()
            ];

            $this->view('admin/request/studentRequest', $data);
        }

        else if($_SESSION['user_type'] == 'superAdmin') {
            $data = [
                'title' => 'Home page',
                'unassigned' => $this->requestModel->getAllUnassignedStudentRequests(),
                'assigned' => $this->requestModel->getAllAssignedStudentRequests()
            ];

            $this->view('superAdmin/request/studentRequest', $data);
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

            $this->view('admin/request/organizationRequest', $data);
        }

        else if($_SESSION['user_type'] == 'superAdmin') {
            $data = [
                'title' => 'Home page',
                'unassigned' => $this->requestModel->getAllUnassignedOrganizationRequests(),
                'assigned' => $this->requestModel->getAllAssignedOrganizationRequests()
            ];

            $this->view('superAdmin/request/organizationRequest', $data);
        }

        else {
            die('User Type Not Found');
        }
    }

    public function viewUnassignedStudentRequest($student_ID = null) {
        if(empty($student_ID)) {
            redirect('pages/404');
        }

        $data = [
            'title' => 'Home page',
            'student_details' => $this->requestModel->getStudent($student_ID)
        ];

        $this->view($_SESSION['user_type'].'/request/viewUnassignedStudentRequest', $data);
    }

    public function viewAssignedStudentRequest($student_ID = null) {
        if(empty($student_ID)) {
            redirect('pages/404');
        }

        $data = [
            'title' => 'Home page',
            'student_details' => $this->requestModel->getStudent($student_ID)
        ];

        $this->view($_SESSION['user_type'].'/request/viewAssignedStudentRequest', $data);
    }

    public function viewUnassignedOrganizationRequest($org_ID = null){
        if(empty($org_ID)) {
            redirect('pages/404');
        }

        $data = [
            'title' => 'Home page',
            'organization_details' => $this->requestModel->getOrganization($org_ID)
        ];
        $this->view($_SESSION['user_type'].'/request/viewunassignedOrganizationRequest', $data);
    }

    public function viewAssignedOrganizationRequest($org_ID = null){
        if(empty($org_ID)) {
            redirect('pages/404');
        }

        $data = [
            'title' => 'Home page',
            'organization_details' => $this->requestModel->getOrganization($org_ID)
        ];
        $this->view($_SESSION['user_type'].'/request/viewAssignedOrganizationRequest', $data);
    }

    public function unassignAdmin() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($this->requestModel->unassignAdmin($_POST['user_ID'])) {
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
}