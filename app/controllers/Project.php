<?php
class Project extends Controller {
    private $middleware;
    private $projectModel;
    private $userModel;
    private $notificationModel;

    public function __construct(){
        $this->middleware = new AuthMiddleware();
        $this->middleware->checkAccess(['admin', 'superAdmin', 'donor', 'organization']);
        $this->projectModel = $this->model('ProjectModel');
        $this->userModel = $this->model('UserModel');
        $this->notificationModel = $this->model('NotificationModel');
    }

    public function postedprojects(){
        $data = [
            'title' => 'Home Page',
            'pendingtablerow' => $this->projectModel->getaddedongoingprojects(),
            'completetablerow' => $this->projectModel->getaddedcompletedprojects()
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];
    
        $this->view('organization/project/postedprojects', $data, $other_data);
    }

    public function addprojects(){
        if($_SESSION['user_type'] != 'organization') {
            redirect('pages/404');
        }else{
            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                $data = [
                    'projectTitle' => trim($_POST['projectTitle']),
                    'projectDescription' => trim($_POST['projectDescription']),
                    'projectsmilestones' => $_POST['projectsmilestones'],
                    'milestonebudget' => $_POST['milestonebudget'],
                    'milestonedescription' => $_POST['milestonedescription'],
                    'projectTitle_err' => '',
                    'MilestoneInputblock_err' => '',
                    'projectDescription_err' => ''

                ];

                //Handle file uploads
                if(isset($_FILES['firstprojectImages']) && isset($_FILES['seconprojectImages'])){
                    // Define arrays to holds image paths
                    $firstprojectImagesPath = [];
                    $seconprojectImagesPath = [];

                    // Process first project milestone uploaded images
                    foreach($_FILES['firstprojectImages']['name'] as $key => $Imagenamewithextention){
                        // Check for upload errors
                        if($_FILES['firstprojectImages']['error'][$key] === UPLOAD_ERR_OK) {
                            $firstImagesPath = PUBLICROOT.'/projectmilestoneuploadedimages/'.$Imagenamewithextention;
                            move_uploaded_file($_FILES['firstprojectImages']['tmp_name'][$key], $firstImagesPath);
                            $firstprojectImagesPath[] = $Imagenamewithextention;
                        } else {
                            // Handle upload error
                            $data['upload_error'] = "Error uploading first project images";
                        }
                    }

                    // Process second project milestone uploaded images
                    foreach($_FILES['seconprojectImages']['name'] as $key => $Imagenamewithextention){
                        // Check for upload errors
                        if($_FILES['seconprojectImages']['error'][$key] === UPLOAD_ERR_OK) {
                            $secondImagePath  = PUBLICROOT.'/projectmilestoneuploadedimages/'.$Imagenamewithextention;
                            move_uploaded_file($_FILES['seconprojectImages']['tmp_name'][$key], $secondImagePath);
                            $seconprojectImagesPath[] = $Imagenamewithextention;
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

                if(empty($data['projectDescription'])){
                    $data['projectDescription_err']='Please enter the description about overall project';
                }

                // Check for duplicate file paths between first and second project images
                foreach ($firstprojectImagesPath as $firstImagePath) {
                    foreach ($seconprojectImagesPath as $secondImagePath) {
                        if ($firstImagePath === $secondImagePath) {
                            $data['MilestoneInputblock_err']= "Duplicate file path detected: '{$firstImagePath}'";
                        }
                    }
                }

                // Calculate total milestone budget
                $totalMilestoneBudget = array_sum($data['milestonebudget']);

                //check whether there any errors
                if(empty($data['MilestoneInputblock_err']) && empty($data['projectTitle_err']) && empty($data['projectDescription_err']) && !empty($data['projectsmilestones']) && !empty($data['milestonebudget']) && !empty($data['milestonedescription']) && !empty($data['firstprojectImagesPath']) && !empty($data['seconprojectImagesPath'])){
                    $data['totalMilestoneBudget'] = $totalMilestoneBudget;

                    if($this->projectModel->addprojectstodb($data)){
                        redirect('project/postedprojects');
                    }else{
                        error_log('Error: Failed to insert data into the database.');
                        die('something went wrong');
                    }
                }else{

                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];

                    if ($_SESSION['user_type'] == 'organization') {
                        $this->view('organization/project/addprojects', $data, $other_data);
                    }else {
                        die('User Type Not Found');
                    }
                    
                }
                
            }else{

                $data = [
                    'projectTitle' => '',
                    'projectDescription' => '',
                    'projectsmilestones' => [],
                    'milestonebudget' => [],
                    'milestonedescription' => [],
                    'firstprojectImagesPath' => [],
                    'seconprojectImagesPath' => [],
                    'projectTitle_err' => '',
                    'MilestoneInputblock_err' => '',
                    'projectDescription_err' => ''
                ];

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];

                $this->view('organization/project/addprojects', $data, $other_data);

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

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];

                // If the comment is empty load view with errors
                if(empty($data['comment'])) {
                    $data['err'] = 'Please Enter Your Comment';
                    $data['comments'] = $this->projectModel->getAllComments($data['project_ID']);

                    $this->view($_SESSION['user_type'].'/project/manageproject', $data, $other_data);
                }

                // If the comment is not empty insert comment to the database and redirect to Manage Montary view
                else {
                    if($this->projectModel->addComment($data)) {
                        $orgID = $this->projectModel->getOrganizationID($data['project_ID']);

                        $this->notificationModel->createNotification('Manage Project', 'manageProject', $_SESSION['user_id'], $orgID, $data['comment'], $data['project_ID']);

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
    
                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];

                $this->view($_SESSION['user_type'].'/project/manageproject', $data, $other_data);
            }
        }
    }

    public function viewProject() {
        $data = [
            'title' => 'Home Page',
            'project_ID' => $_GET['project_ID'],
            'project_details' => $this->projectModel->getProjectDetails($_GET['project_ID']),
            'milestones' => $this->projectModel->getMilestoneCardDetails($_GET['project_ID'])
        ];

        $other_data = [
            'notification_count' => $this->notificationModel->getNotificationCount(),
            'notifications' => $this->notificationModel->viewNotifications()
        ];

        $userType = $this->projectModel->getUserType($_SESSION['user_id']);

        if($userType == 'admin') {
            $this->view('admin/project/viewProject', $data, $other_data);
        }

        else if($userType == 'superAdmin') {
            $this->view('superAdmin/project/viewProject', $data, $other_data);
        }

        else {
            die('User Type Not Found');
        }
    }

    public function viewMilestoneDetails() {
        
    }

    public function deleteProject() {
        if($_SESSION['user_type'] == 'donor') {
            redirect('pages/404');
        }

        else {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if($this->projectModel->deleteProjects($_POST['project_ID'])) {
                    redirect($_SESSION['user_type'].'/project');
                }
            }
        }
    }

    //Delete  ongoing and completed projects 
    public function deleteOngoingandCompleteProjects(){
        if($_SESSION['user_type'] != 'organization') {
            redirect('pages/404');
        }

        else {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                if(isset($_POST['projectID']) && !empty($_POST['projectID'])) {
                    // Get 'projectID' from POST data
                    $projectID = trim($_POST['projectID']);
    
                    //  if the Deleting project is succed   
                    if($this->projectModel->deleteProjects($projectID)){

                        //update project data
                        $data = [
                            'pendingtablerow' => $this->projectModel->getaddedongoingprojects(),
                            'completetablerow' => $this->projectModel->getaddedcompletedprojects()
                        ];

                        $other_data = [
                            'notification_count' => $this->notificationModel->getNotificationCount(),
                            'notifications' => $this->notificationModel->viewNotifications()
                        ];

                        // Pass data to the view
                        if ($_SESSION['user_type'] == 'organization') {
                            $this->view('organization/project/postedprojects', $data, $other_data);
                        }else {
                            die('User Type Not Found');
                        }

                    }else{
                        // Handle deletion failure (e.g., show error message)
                        die('Failed to delete Projects.');
                    }
    
                } else {
                    // display an error message here
                    die('User Necessity is Not Found');
                }
    
            } else {
                // If it's not a POST request, then empty data pass to the view
                $data = [
                    'pendingtablerow' => [] ,
                    'completetablerow' => [] // this is an array
                ];

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];
                
                // Pass data to the view
                if ($_SESSION['user_type'] == 'organization') {
                    $this->view('organization/project/postedprojects', $data, $other_data);
                }else {
                    die('User Type Not Found');
                }
            }
        }
    }

    // View added ongoing project's further information
    public function viewOngoingProjectDetails(){
        if($_SESSION['user_type'] != 'organization') {
            redirect('pages/404');
        } else {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                if(isset($_POST['projectID']) && !empty($_POST['projectID'])) {
                    // Get 'necessityID' from POST data
                    $projectID = trim($_POST['projectID']);
    
                    // Get pending necessity details
                    $ongingProjectDetails = $this->projectModel->getallProjectDetils($projectID);
                    $ongoingmilestonedetails = $this->projectModel->getAllMilestoneDetails($projectID);
    
                    // Prepare data to pass to the view
                    $data = [
                        'projectID' => $projectID,
                        'ongingProjectDetails' => $ongingProjectDetails,
                        'ongoingmilestonedetails' => $ongoingmilestonedetails
                    ];

                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];
    
                    // Pass data to the view
                    if ($_SESSION['user_type'] == 'organization') {
                        $this->view('organization/project/viewPendingprojectsdetails', $data, $other_data);
                    }else {
                        die('User Type Not Found');
                    }
    
                } else {
                    // display an error message here
                    die('User Necessity is Not Found');
                }
    
            } else {
                // If it's not a POST request, then empty data pass to the view
                $data = [
                    'projectID' => '',
                    'ongingProjectDetails' => [],
                    'ongoingmilestonedetails' => []
                ];

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];
                
                // Pass data to the view
                if ($_SESSION['user_type'] == 'organization') {
                    $this->view('organization/project/viewPendingprojectsdetails', $data, $other_data);
                    die('User Type Not Found');
                }
            }
        }
    }

    // View added project's further information
    public function viewCompletedProjectDetails(){
        if($_SESSION['user_type'] != 'organization') {
            redirect('pages/404');
        } else {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                if(isset($_POST['projectID']) && !empty($_POST['projectID'])) {
                    // Get 'necessityID' from POST data
                    $projectID = trim($_POST['projectID']);
    
                    // Get pending necessity details
                    $ongingProjectDetails = $this->projectModel->getallCompletedProjectDetils($projectID);
                    $ongoingmilestonedetails = $this->projectModel->getAllMilestoneDetails($projectID);
    
                    // Prepare data to pass to the view
                    $data = [
                        'projectID' => $projectID,
                        'ongingProjectDetails' => $ongingProjectDetails,
                        'ongoingmilestonedetails' => $ongoingmilestonedetails
                    ];

                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];
    
                    // Pass data to the view
                    if ($_SESSION['user_type'] == 'organization') {
                        $this->view('organization/project/viewCompletedprojectsdetails', $data, $other_data);
                    }else {
                        die('User Type Not Found');
                    }
    
                } else {
                    // display an error message here
                    die('User Necessity is Not Found');
                }
    
            } else {
                // If it's not a POST request, then empty data pass to the view
                $data = [
                    'projectID' => '',
                    'ongingProjectDetails' => [],
                    'ongoingmilestonedetails' => []
                ];

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];
                
                // Pass data to the view
                if ($_SESSION['user_type'] == 'organization') {
                    $this->view('organization/project/viewCompletedprojectsdetails', $data, $other_data);
                }else {
                    die('User Type Not Found');
                }
            }
        }
    }

    // This is the function that pass necessity Id to edit one-time necessity page
    public function editPostedProjects(){
        if($_SESSION['user_type'] != 'organization') {
            redirect('pages/404');
        }

        else {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                if(isset($_POST['projectID']) && !empty($_POST['projectID'])) {
                    // Get 'necessityID' from POST data
                    $projectID = trim($_POST['projectID']);

                    $existingData = $this->projectModel->getallProjectDetils($projectID);
                    

                    $data = [
                        'projectID' => $projectID,
                        'projectTitle' => $existingData->title,
                        'projectDescription' => $existingData->project_description   
                    ];

                    $other_data = [
                        'notification_count' => $this->notificationModel->getNotificationCount(),
                        'notifications' => $this->notificationModel->viewNotifications()
                    ];

                    if ($_SESSION['user_type'] == 'organization') {
                        $this->view('organization/project/editpostedProjectsInterface', $data, $other_data);
                    }else {
                        die('User Type Not Found');
                    }

                    
                }
            }
        }
    }

    public function updatepostedprojects(){
        if($_SESSION['user_type'] != 'organization') {
            redirect('pages/404');
        }

        else {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


                if(isset($_POST['projectID']) && !empty($_POST['projectID'])) {
                    // Get 'necessityID' from POST data
                    $projectID = trim($_POST['projectID']);


                    $data = [
                        'projectID' => $projectID,
                        'projectTitle' => isset($_POST['projectTitle']) ? trim($_POST['projectTitle']) : '',
                        'projectDescription' => isset($_POST['projectDescription']) ? trim($_POST['projectDescription']) : '',
                        'projectTitle_err' => '',
                        'projectDescription_err' => '',
                    ];

                    //check wheather field are empty or not

                    //necessity field
                    if(empty($data['projectTitle'])){
                        $data['projectTitle_err']='Please enter the Project Title';
                    }

                    //necessity description field
                    if(empty($data['projectDescription'])){
                        $data['projectDescription_err']='Please enter the Description about posted overall project';
                    }

                    //check whether there any errors
                    if(empty($data['projectTitle_err']) && empty($data['projectDescription_err'])){
                        if($this->projectModel->editprojectdetailstodb($data)){
                            redirect('project/postedprojects');
                        }else{
                            error_log('Error: Failed to insert data into the database.');
                            die('something went wrong');
                        }
                    }else{
                        $other_data = [
                            'notification_count' => $this->notificationModel->getNotificationCount(),
                            'notifications' => $this->notificationModel->viewNotifications()
                        ];

                        if ($_SESSION['user_type'] == 'organization') {
                            $this->view('organization/project/editpostedProjectsInterface', $data, $other_data);
                        }else {
                            die('User Type Not Found');
                        }
                        
                    }
                }else{
                    die('projects is not found');
                }

            }else{

                $data = [
                    'projectID' => '',
                    'projectTitle' => '',
                    'projectDescription' => '',
                    'projectTitle_err' => '',
                    'projectDescription_err' => ''
                ];

                $other_data = [
                    'notification_count' => $this->notificationModel->getNotificationCount(),
                    'notifications' => $this->notificationModel->viewNotifications()
                ];

                if ($_SESSION['user_type'] == 'organization') {
                    $this->view('organization/project/editpostedProjectsInterface', $data, $other_data);
                }else {
                    die('User Type Not Found');
                }
            }

        }
    }

    // viewCompletedProjectDetails

    public function viewDoneeProfile($project_ID = null, $org_ID = null) {
        if($_SESSION['user_type'] == 'organization') {
            redirect('pages/404');
        }

        else {
            $data = [
                'title' => 'Home Page',
                'project_ID' => $project_ID,
                'details' => $this->userModel->getOrganization($org_ID)
            ];

            $other_data = [
                'notification_count' => $this->notificationModel->getNotificationCount(),
                'notifications' => $this->notificationModel->viewNotifications()
            ];

            $this->view($_SESSION['user_type'].'/project/viewOrganizationProfile', $data, $other_data);
        }
    }

}