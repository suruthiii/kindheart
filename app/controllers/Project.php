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
                'title' => 'Home Page',
                'pendingtablerow' => $this->projectModel->getaddedongoingprojects(),
                'completetablerow' => $this->projectModel->getaddedcompletedprojects()
            ];
      
            $this->view('organization/project/postedprojects', $data);
    }

    public function addprojects(){
        $data = [
            'title' => 'Home Page',
            'pendingtablerow' => $this->projectModel->getaddedongoingprojects(),
            'completetablerow' => $this->projectModel->getaddedcompletedprojects()
        ];
        $this->view('organization/project/addprojects', $data);
}

    public function manageProject($project_ID = null) {
        if(($_SESSION['user_type'] != 'admin' && $_SESSION['user_type'] != 'superAdmin') ||  empty($_GET['project_ID']) && empty($_POST['project_ID'])) {
            redirect('pages/404');
        }

        else {
            // When we submit comments
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = [
                    'comment' => trim($_POST['comment']),
                    'project_ID' => trim($_POST['project_ID']),
                    'err' => ''
                ];

                // If the comment is empty load view with errors
                if(empty($data['comment'])) {
                    $data['err'] = 'Please Enter Your Comment';
                    $data['comments'] = $this->projectModel->getAllComments($data['project_ID']);

                    $this->view($_SESSION['user_type'].'/project/manageproject', $data);
                }

                // If the comment is not empty insert comment to the database and redirect to Manage Montary view
                else {
                    if($this->projectModel->addComment($data)) {
                        redirect('project/manageproject?project_ID='.$data['project_ID']);
                    }
                }
            }
            
            // Loading normal view when called with GET method
            else {
                $data = [
                    'project_ID' => $_GET['project_ID'],
                    'project_details' => $this->projectModel->getProjectDetails($_GET['project_ID']),
                    'comments' => $this->projectModel->getAllComments($_GET['project_ID'])
                ];
    
                $this->view($_SESSION['user_type'].'/project/manageproject', $data);
            }
        }
    }

    public function viewProject() {
        if(($_SESSION['user_type'] == 'student')) {
            redirect('pages/404');
        }

        else {
            $data = [
                'title' => 'Home Page',
                'project_ID' => $_GET['project_ID'],
                'project_details' => $this->projectModel->getProjectDetails($_GET['project_ID'])
            ];

            $userType = $this->projectModel->getUserType($_SESSION['user_id']);

            if($userType == 'admin') {
                $this->view('admin/project/viewProject', $data);
            }

            else if($userType == 'superAdmin') {
                $this->view('superAdmin/project/viewProject', $data);
            }

            else if($userType == 'organization') {

            }

            else if($userType == 'donor') {

            }

            else {
                die('User Type Not Found');
            }
        }
    }
}