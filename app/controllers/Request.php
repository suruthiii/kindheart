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

    public function viewStudentRequest($student_ID = null) {
        if(empty($student_ID)) {
            redirect('pages/404');
        }

        $data = [
            'title' => 'Home page',
            'student_details' => $this->requestModel->getStudent($student_ID)
        ];

        $this->view($_SESSION['user_type'].'/request/viewStudentRequest', $data);
    }

    public function viewOrganizationRequest($org_ID = null){
        if(empty($org_ID)) {
            redirect('pages/404');
        }

        $data = [
            'title' => 'Home page',
            'organization_details' => $this->requestModel->getOrganization($org_ID)
        ];
        $this->view($_SESSION['user_type'].'/request/viewOrganizationRequest', $data);
    }
}