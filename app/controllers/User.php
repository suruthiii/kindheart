<?php
class User extends Controller {
    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only admins are allowed to access admin/superadmin pages
        $this->middleware->checkAccess(['superAdmin', 'admin']);
        $this->userModel = $this->model('UserModel');
    }

    public function student(){
        $data = [
            'title' => 'Home page',
            'students' => $this->userModel->viewStudents()
        ];

        $this->view($_SESSION['user_type'].'/user/student', $data);
    }

    public function viewStudent($student_ID = null){
        if(empty($student_ID)) {
            redirect('pages/404');
        }

        $data = [
            'title' => 'Home page',
            'student_details' => $this->userModel->getStudent($student_ID)
        ];

        $this->view($_SESSION['user_type'].'/user/viewStudent', $data);
    }

    public function organization(){
        $data = [
            'title' => 'Home page',
            'organizations' => $this->userModel->viewOrganizations()
        ];

        $this->view($_SESSION['user_type'].'/user/organization', $data);
    }

    public function viewOrganization($org_ID = null){
        if(empty($org_ID)) {
            redirect('pages/404');
        }

        $data = [
            'title' => 'Home page',
            'organization_details' => $this->userModel->getOrganization($org_ID)
        ];
        $this->view($_SESSION['user_type'].'/user/viewOrganization', $data);
    }

    public function donor(){
        $data = [
            'title' => 'Home page',
            'donors' => $this->userModel->viewDonors()
        ];
        
        $this->view($_SESSION['user_type'].'/user/donor', $data);
    }

    public function viewDonor(){
        $data = [
            'title' => 'Home page'
        ];

        $this->view($_SESSION['user_type'].'/user/viewDonor', $data);
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

                else if($userType = 'donor') {
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