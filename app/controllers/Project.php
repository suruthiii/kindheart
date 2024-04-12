<?php
class Project extends Controller {
    private $middleware;

    public function __construct(){
        $this->middleware = new AuthMiddleware();
        $this->middleware->checkAccess(['admin', 'superAdmin', 'donor', 'organization']);
        $this->projectModel = $this->model('ProjectModel');
    }

    public function manageProject($project_ID = null) {
        if(($_SESSION['user_type'] != 'admin' && $_SESSION['user_type'] != 'superAdmin') || empty($project_ID)) {
            redirect('pages/404');
        }

        else {
            $data = [
                'title' => 'Home Page'
                // 'project_details' => $this->projectModel->getMonetaryDetails($project_ID),
                // 'comments' => $this->projectModel->getAllComments($necessity_ID)
            ];

            $this->view($_SESSION['user_type'].'/project/manageproject', $data);
        }
    }
}