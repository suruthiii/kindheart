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

}