<?php
class Project extends Controller {
    private $middleware;
    private $projectModel;

    public function __construct(){
        $this->middleware = new AuthMiddleware();
        $this->middleware->checkAccess(['admin', 'superAdmin', 'donor', 'organization']);
        $this->projectModel = $this->model('ProjectModel');
    }

    public function postedprojects(){
            $data = [
                'title' => 'Home Page'
            ];
            $this->view('organization/project/postedprojects', $data);
    }

    public function manageProject($project_ID = null) {
        if(($_SESSION['user_type'] != 'admin' && $_SESSION['user_type'] != 'superAdmin') || empty($project_ID)) {
            redirect('pages/404');
        }

        else {
            $data = [
                'title' => 'Home Page'
                // 'project_details' => $this->projectModel->getMonetaryDetails($project_ID),
                // 'comments' => $this->projectModel->getAllComments($project_ID)
            ];

            $this->view($_SESSION['user_type'].'/project/manageproject', $data);
        }
    }
}