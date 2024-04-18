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

            if (empty($data['deadlineScholarship'])) {
                $data['deadlineScholarship_err'] = 'Please select the Deadline';
            } elseif (strtotime($data['deadlineScholarship']) < strtotime($data['startDateScholarship'])) {
                $data['deadlineScholarship_err'] = 'Deadline cannot be before the Start Date';
            } elseif (strtotime($data['deadlineScholarship']) < strtotime('today')) {
                $data['deadlineScholarship_err'] = 'Deadline cannot be in the past';
            }

            if (empty($data['scholarshipDescription'])) {
                $data['scholarshipDescription_err'] = 'Please enter a Description for the Scholarship';
            }

            if(empty($data['titleScholarship_err']) && empty($data['amountScholarship_err']) && empty($data['startDateScholarship_err']) && empty($data['durationScholarship_err']) && empty($data['deadlineScholarship_err']) && empty($data['scholarshipDescription_err'])){
                if($this->scholarshipModel->addScholarship($data)){
                    // $data = [
                    //     // 'pendingScholarship' => $this->donorModel->getPendingScholarship(), //get all the pending scholarships

                    //     // 'onProgressScholarship' => $this->donorModel->getOnProgressScholarship(), //get all the on progress scholarships

                    //     // 'completedScholarship' => $this->donorModel->getCompletedScholarship() //get all the completed scholarships

                    //     'pendingBenefaction' => $this->donorModel->getPendingBenefaction(),

                    //     'onProgressBenefaction' => $this->donorModel->getOnProgressBenefaction(),
                        
                    //     'completedBenefaction' => $this->donorModel->getCompletedBenefaction()
                    // ];

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
}