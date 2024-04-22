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
        if($_SESSION['user_type'] != 'organization') {
            redirect('pages/404');
        }else{
            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                $data = [
                    'projectTitle' => trim($_POST['projectTitle']),
                    'projectsmilestones' => $_POST['projectsmilestones'],
                    'milestonebudget' => $_POST['milestonebudget'],
                    'milestonedescription' => $_POST['milestonedescription'],
                    'projectTitle_err' => '',
                    'MilestoneInputblock_err' => ''

                ];

                //Handle file uploads
                if(isset($_FILES['firstprojectImages']) && isset($_FILES['seconprojectImages'])){
                    // Define arrays to holds image paths
                    $firstprojectImagesPath = [];
                    $seconprojectImagesPath = [];

                    // Process first project milestone uploaded images
                    foreach($_FILES['firstprojectImages']['tmp_name'] as $key => $tmp_name){
                        // Check for upload errors
                        if($_FILES['firstprojectImages']['error'][$key] === UPLOAD_ERR_OK) {
                            $firstImagesPath = PUBLICROOT.'/projectmilestoneuploadedimages/'.$_FILES['firstprojectImages']['name'][$key];
                            move_uploaded_file($tmp_name, $firstImagesPath);
                            $firstprojectImagesPath[] = $firstImagesPath;
                        } else {
                            // Handle upload error
                            $data['upload_error'] = "Error uploading first project images";
                        }
                    }

                    // Process second project milestone uploaded images
                    foreach($_FILES['seconprojectImages']['tmp_name'] as $key => $tmp_name){
                        // Check for upload errors
                        if($_FILES['seconprojectImages']['error'][$key] === UPLOAD_ERR_OK) {
                            $secondImagePath  = PUBLICROOT.'/projectmilestoneuploadedimages/'.$_FILES['seconprojectImages']['name'][$key];
                            move_uploaded_file($tmp_name, $secondImagePath);
                            $seconprojectImagesPath[] = $secondImagePath;
                        } else {
                            // Handle upload error
                            $data['upload_error'] = "Error uploading second project images";
                        }
                    }

                    // Add image paths to $data array
                    $data['firstprojectImagesPath'] = $firstprojectImagesPath;
                    $data['seconprojectImagesPath'] = $seconprojectImagesPath;
                }

                // check project tile field is empty or not
                if(empty($data['projectTitle'])){
                    $data['projectTitle_err']='Please enter the title for the project';
                }

                // Check for duplicate file paths between first and second project images
                foreach ($firstprojectImagesPath as $firstImagePath) {
                    foreach ($seconprojectImagesPath as $secondImagePath) {
                        if ($firstImagePath === $secondImagePath) {
                            $data['MilestoneInputblock_err']= "Duplicate file path detected: '{$firstImagePath}'";
                        }
                    }
                }

                //check whether there any errors
                if(empty($data['MilestoneInputblock_err']) && empty($data['projectTitle_err']) && !empty($data['projectsmilestones']) && !empty($data['milestonebudget']) && !empty($data['milestonedescription']) && !empty($data['firstprojectImagesPath']) && !empty($data['seconprojectImagesPath'])){
                    if($this->projectModel->addprojectstodb($data)){
                        redirect('project/postedprojects');
                    }else{
                        error_log('Error: Failed to insert data into the database.');
                        die('something went wrong');
                    }
                }else{

                    if ($_SESSION['user_type'] == 'organization') {
                        $this->view('organization/project/addprojects', $data);
                    }else {
                        die('User Type Not Found');
                    }
                    
                }
                
            }else{

                $data = [
                    'projectTitle' => '',
                    'projectsmilestones' => [],
                    'milestonebudget' => [],
                    'milestonedescription' => [],
                    'firstprojectImagesPath' => [],
                    'seconprojectImagesPath' => [],
                    'projectTitle_err' => '',
                    'MilestoneInputblock_err' => ''
                ];

                $this->view('organization/project/addprojects', $data);

            }
        }
 
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

    // public function deleteProject() {

    // }
}