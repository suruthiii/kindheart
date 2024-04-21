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

    public function donorAddScholarships(){
        //other actors' redirection
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'titleScholarship' => trim($_POST['titleScholarship']),
                'amountScholarship' => trim($_POST['amountScholarship']),
                'startDateScholarship' => trim($_POST['startDateScholarship']),
                'durationScholarship' => trim($_POST['durationScholarship']),
                'deadlineScholarship' => trim($_POST['deadlineScholarship']),
                'scholarshipDescription' => trim($_POST['scholarshipDescription']),

                'availabilityStatus' => '0',
                'availability' => 'pending',

                'titleScholarship_err' => '',
                'amountScholarship_err' => '',
                'startDateScholarship_err' => '',
                'durationScholarship_err' => '',
                'deadlineScholarship_err' => '',
                'scholarshipDescription_err' => ''
            ];
            // die(print_r($this->imgUpload('photoBenfaction1')));

            //validate the input fields seperately
            if (empty($data['titleScholarship'])) {
                $data['titleScholarship_err'] = 'Please enter the Scholarship Title';
            }

            if (empty($data['amountScholarship'])) {
                $data['amountScholarship_err'] = 'Please enter the Scholarship Amount';
            } elseif (!is_numeric($data['amountScholarship']) || $data['amountScholarship'] <= 0) {
                $data['amountScholarship_err'] = 'Scholarship Amount must be a valid positive number';
            }

            if (empty($data['startDateScholarship'])) {
                $data['startDateScholarship_err'] = 'Please select the Start Date';
            } else {
                $selectedStartDate = strtotime($data['startDateScholarship']);
                $today = strtotime('today');
            
                if ($selectedStartDate < $today) {
                    $data['startDateScholarship_err'] = 'Start Date cannot be in the past';
                }
            }            

            if (empty($data['durationScholarship'])) {
                $data['durationScholarship_err'] = 'Please enter the Duration (in months)';
            } elseif (!is_numeric($data['durationScholarship']) || $data['durationScholarship'] <= 0) {
                $data['durationScholarship_err'] = 'Duration must be a valid positive number';
            }

            date_default_timezone_set('Asia/Colombo');

            $dateObject = new DateTime(date('Y-m-d H:i:s'));

            if (empty($data['deadlineScholarship'])) {
                $data['deadlineScholarship_err'] = 'Please select the Deadline';
            } elseif (strtotime($data['deadlineScholarship']) < strtotime($dateObject->format('Y-m-d\TH:i'))) {
                $data['deadlineScholarship_err'] = 'Deadline cannot be in the past';
            }

            if (empty($data['scholarshipDescription'])) {
                $data['scholarshipDescription_err'] = 'Please enter a Description for the Scholarship';
            }

            if(empty($data['titleScholarship_err']) && empty($data['amountScholarship_err']) && empty($data['startDateScholarship_err']) && empty($data['durationScholarship_err']) && empty($data['deadlineScholarship_err']) && empty($data['scholarshipDescription_err'])){
                if($this->scholarshipModel->addScholarship($data)){
                    $data = [
                        'pendingScholarship' => $this->scholarshipModel->getPendingScholarship(),
            
                        'onProgressScholarship' => $this->scholarshipModel->getOnProgressScholarship(),
                        
                        'completedScholarship' => $this->scholarshipModel->getCompletedScholarship()
                    ];

                    $this->view('donor/postedScholarships', $data);
                }else{
                    die('Something Went Wrong');
                }
            }else{
                //Load View
                $this->view('donor/donorAddScholarships', $data);
            }

        }else{
            $data = [
                'titleScholarship' => '',
                'amountScholarship' => '',
                'startDateScholarship' => '',
                'durationScholarship' => '',
                'deadlineScholarship' => '',
                'scholarshipDescription' => '',

                'titleScholarship_err' => '',
                'amountScholarship_err' => '',
                'startDateScholarship_err' => '',
                'durationScholarship_err' => '',
                'deadlineScholarship_err' => '',
                'scholarshipDescription_err' => ''
            ];

            $this->view('donor/donorAddScholarships', $data);
        }
    }

    public function postedScholarships(){
        // Load the view with data
        $data = [
            'pendingScholarship' => $this->scholarshipModel->getPendingScholarship(),

            'onProgressScholarship' => $this->scholarshipModel->getOnProgressScholarship(),
            
            'completedScholarship' => $this->scholarshipModel->getCompletedScholarship()
        ];

        //Load View
        $this->view('donor/postedScholarships', $data);
    }

    public function viewPostedScholarships() {
        // Check if scholarshipID is set in the POST request
        if(isset($_GET['scholarshipID'])) {
            // Get the scholarshipID from the POST request
            $scholarshipID = $_GET['scholarshipID'];            

            // Load the view with data
            $data = [
                'title' => 'View Posted Scholarships',
                'scholarship_details' => $this->scholarshipModel->getScholarship($scholarshipID)
                // 'scholarship_applications' => $this->scholarshipModel->getScholarshipApplications($scholarshipID)
            ];

            // die(print_r($data));
            
    
            // Load View
            $this->view('donor/viewPostedscholarships', $data);
        } else {
            // Handle the case where scholarshipID is not set
            // Redirect or show an error message
            echo "scholarship ID is missing.";
        }
    }

    public function editPostedScholarships(){
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'scholarshipID' => $_POST['scholarshipID'],
                'titleScholarship' => trim($_POST['titleScholarship']),
                'amountScholarship' => trim($_POST['amountScholarship']),
                'startDateScholarship' => trim($_POST['startDateScholarship']),
                'durationScholarship' => trim($_POST['durationScholarship']),
                'deadlineScholarship' => trim($_POST['deadlineScholarship']),
                'scholarshipDescription' => trim($_POST['scholarshipDescription']),

                'availabilityStatus' => '0',
                'availability' => 'pending',

                'titleScholarship_err' => '',
                'amountScholarship_err' => '',
                'startDateScholarship_err' => '',
                'durationScholarship_err' => '',
                'deadlineScholarship_err' => '',
                'scholarshipDescription_err' => ''
            ];
            
            
            //validate the input fields seperately
            if (empty($data['titleScholarship'])) {
                $data['titleScholarship_err'] = 'Please enter the Scholarship Title';
            }

            if (empty($data['amountScholarship'])) {
                $data['amountScholarship_err'] = 'Please enter the Scholarship Amount';
            } elseif (!is_numeric($data['amountScholarship']) || $data['amountScholarship'] <= 0) {
                $data['amountScholarship_err'] = 'Scholarship Amount must be a valid positive number';
            }

            if (empty($data['startDateScholarship'])) {
                $data['startDateScholarship_err'] = 'Please select the Start Date';
            } else {
                $selectedStartDate = strtotime($data['startDateScholarship']);
                $today = strtotime('today');
            
                if ($selectedStartDate < $today) {
                    $data['startDateScholarship_err'] = 'Start Date cannot be in the past';
                }
            }            

            if (empty($data['durationScholarship'])) {
                $data['durationScholarship_err'] = 'Please enter the Duration (in months)';
            } elseif (!is_numeric($data['durationScholarship']) || $data['durationScholarship'] <= 0) {
                $data['durationScholarship_err'] = 'Duration must be a valid positive number';
            }

            if (empty($data['deadlineScholarship'])) {
                $data['deadlineScholarship_err'] = 'Please select the Deadline';
            } elseif (strtotime($data['deadlineScholarship']) < strtotime('today')) {
                $data['deadlineScholarship_err'] = 'Deadline cannot be in the past';
            }

            if (empty($data['scholarshipDescription'])) {
                $data['scholarshipDescription_err'] = 'Please enter a Description for the Scholarship';
            }
            

            if(empty($data['titleScholarship_err']) && empty($data['amountScholarship_err']) && empty($data['startDateScholarship_err']) && empty($data['durationScholarship_err']) && empty($data['deadlineScholarship_err']) && empty($data['scholarshipDescription_err'])){
                // die(print_r($data));
                if($this->scholarshipModel->updateScholarship($data)){
                    $data = [
                        'title' => 'Edit Posted Scholarships',
                        'scholarshipID' => $_POST['scholarshipID'],
                        'scholarship_details' => $this->scholarshipModel->getScholarship($_POST['scholarshipID']),
                        'success' => true
                    ];

                    
                    $this->view('donor/editPostedScholarships', $data);

                }else{
                    die('Something Went Wrong');
                }
            }else{
                $data = [
                    'title' => 'Edit Posted Scholarships',
                    'scholarship_details' => $this->scholarshipModel->getScholarship($scholarshipID)
                ];

                $this->view('donor/editPostedScholarships', $data);
            }

        } else {
            //Pass data to the view
            $data = [
                'title' => 'Edit Posted Scholarships',
                'scholarshipID' => $_GET['scholarshipID'],
                'scholarship_details' => $this->scholarshipModel->getScholarship($_GET['scholarshipID']),
            ];

            // die(print_r($data));

            $this->view('donor/editPostedScholarships', $data);
        }

    }

    public function deleteScholarships() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['scholarshipID'])) {
                $scholarshipID = $_POST['scholarshipID'];
                
                // Call model method to delete scholarship
                if ($this->scholarshipModel->deleteScholarship($scholarshipID)) {
                    // Deletion successful, redirect or reload data

                    // Fetch updated scholarships data
                    $data = [
                        'pendingScholarship' => $this->scholarshipModel->getPendingScholarship(),

                        'onProgressScholarship' => $this->scholarshipModel->getOnProgressScholarship(),
                        
                        'completedScholarship' => $this->scholarshipModel->getCompletedScholarship()
                    ];

                    // Pass the updated data to the view
                    $this->view('donor/postedScholarships', $data);
                } else {
                    // Handle deletion failure (e.g., show error message)
                    die('Failed to delete Scholarship.');
                }
            }
        }
    }
}