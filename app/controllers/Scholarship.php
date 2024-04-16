<?php
class Scholarship extends Controller {
    private $middleware;

    public function __construct(){
        $this->middleware = new AuthMiddleware();
        $this->middleware->checkAccess(['admin', 'superAdmin', 'donor', 'student']);
        $this->scholarshipModel = $this->model('ScholarshipModel');
    }

    public function manageScholarship($scholarship_ID = null) {
        if(($_SESSION['user_type'] != 'admin' && $_SESSION['user_type'] != 'superAdmin') || empty($scholarship_ID)) {
            redirect('pages/404');
        }

        else {
            $data = [
                'title' => 'Home Page'
                // 'scholarship_details' => $this->scholarshipModel->getScholarshipDetails($scholarship_ID),
                // 'comments' => $this->scholarshipModel->getAllComments($scholarship_ID)
            ];

            $this->view($_SESSION['user_type'].'/scholarship/managescholarship', $data);
        }
    }
}