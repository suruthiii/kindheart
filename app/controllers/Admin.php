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
    }

    public function index(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/index', $data);
    }

    public function necessity() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/necessity', $data);
    }

    public function project() {
        $data = [
            'title' => 'Home page',
            // 'pending' => $this->projectModel->getAllPendingProjects(),
            // 'confirmed' => $this->projectModel->getAllConfirmedProjects(),
            // 'ongoing' => $this->projectModel->getAllOngoingProjects()
        ];
        $this->view('admin/project', $data);
    }

    public function scholarship() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/scholarship', $data);
    }

    public function benefaction() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/benefaction', $data);
    }

    public function successStory() {
        $data = [
            'title' => 'Home page',
            'successstories' => $this->successStoryModel->getSuccessStories()
        ];
        
        $this->view('admin/successStory', $data);
    }

    public function user() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/user', $data);
    }

    public function request() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/request', $data);
    }

    public function report() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/report', $data);
    }

    public function complaint() {
        $data = [
            'title' => 'Home page'
        ];
        $this->view('admin/complaint', $data);
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