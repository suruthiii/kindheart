<?php
class Benefaction extends Controller {
    private $middleware;

    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only organizations are allowed to access organization pages
        $this->middleware->checkAccess(['student','donor']);

        $this->donorModel = $this->model('DonorModel');
        $this->BenefactionModel = $this->model('BenefactionModel');
    }

    public function index(){
        $data = [
            'title' => 'Home page'
        ];
        $this->view('donor/index', $data);
    }

    public function viewAllBenefactions(){
        $data = [
            'title' => 'All Benefcation Posted Page'
        ];
        $this->view('donor/viewAllBenefactions', $data);
    }

    public function imgUpload($file){
        $file_name = $_FILES[$file]['name'];
        $file_size = $_FILES[$file]['size'];
        $tmp_name = $_FILES[$file]['tmp_name'];
        $error = $_FILES[$file]['error'];

        if ($error === 0){
            $file_ex = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_ex_lc = strtolower($file_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($file_ex_lc, $allowed_exs)){
                // Move into benefactionUploads folder
                $new_file_name = uniqid("IMG-", true).'.'.$file_ex_lc;
                $file_upload_path = PUBLICROOT.'/benefactionUploads/'.$new_file_name;

                move_uploaded_file($tmp_name, $file_upload_path);
                return $new_file_name;
            }

            else{
                $data['photoBenfaction_err'] = "You can't upload files of this type";
                return $data;
            }
        }
    }

    public function donorAddBenefactions(){
        //other actors' redirection
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'itemBenefaction' => trim($_POST['itemBenefaction']),
                'benefactionCategory' => trim($_POST['benefactionCategory']),
                'quantityBenfaction' => trim($_POST['quantityBenfaction']),
                'benefactionDescription' => trim($_POST['benefactionDescription']),

                'photoBenfaction1' => $this->imgUpload('photoBenfaction1'),                
                'photoBenfaction2' => $this->imgUpload('photoBenfaction2'),
                'photoBenfaction3' => $this->imgUpload('photoBenfaction3'),
                'photoBenfaction4' => $this->imgUpload('photoBenfaction4'),

                'availabilityStatus' => '0',
                'availability' => 'pending',

                'itemBenefaction_err' => '',
                'benefactionCategory_err' => '',
                'quantityBenfaction_err' => '',
                'benefactionDescription_err' => '',
                'photoBenfaction_err' => ''
            ];

            // Map category value to category string
            if (!empty($_POST['benefactionCategory']) && $_POST['benefactionCategory'] != '0') {
                $categoryMap = [
                    '1' => 'Educational Supplies and Tools',
                    '2' => 'Clothing and Accessories',
                    '3' => 'Recreation and Sports Equipment',
                    '4' => 'Furniture and Appliances',
                    '5' => 'Health and Wellness Products',
                    '6' => 'Transportation and Mobility',
                    '7' => 'Literature and Reading Materials',
                    '8' => 'Others'
                ];

                $selectedCategoryId = $_POST['benefactionCategory'];
                $data['benefactionCategory'] = $categoryMap[$selectedCategoryId] ?? ''; // Get corresponding category string
            }
            // die(print_r($this->imgUpload('photoBenfaction1')));

            //validate the input fields seperately
            if(empty($data['itemBenefaction'])){
                $data['itemBenefaction_err']='Please enter the Item';
            }

            if (empty($_POST['benefactionCategory']) || $_POST['benefactionCategory'] == '0') {
                $data['benefactionCategory_err'] = 'Please select a category.';
            }

            if(empty($data['quantityBenfaction'])){
                $data['quantityBenfaction_err']='Please enter the Quantity';
            }

            if(empty($data['benefactionDescription'])){
                $data['benefactionDescription_err']='Please enter a small description about the item explaing it\'s condition and other details';
            }

            $uploadedFields = array_filter([$data['photoBenfaction1'], $data['photoBenfaction2'], $data['photoBenfaction3'], $data['photoBenfaction4']]);
           
            if (count($uploadedFields) < 2) {
                $data['photoBenfaction_err'] = 'Please upload at least 2 photos of the item';
            }

            if(empty($data['itemBenefaction_err']) && empty($data['quantityBenfaction_err']) && empty($data['benefactionDescription_err']) && empty($data['photoBenfaction_err']) && empty($data['benefactionCategory_err'])){
                if($this->donorModel->addBenefaction($data)){
                    $data = [
                        'pendingBenefaction' => $this->donorModel->getPendingBenefaction(),

                        'onProgressBenefaction' => $this->donorModel->getOnProgressBenefaction(),
                        
                        'completedBenefaction' => $this->donorModel->getCompletedBenefaction()
                    ];

                    $this->view('donor/postedBenefactions', $data);
                }else{
                    die('Something Went Wrong');
                }
            }else{
                //Load View
                $this->view('donor/donorAddBenefactions', $data);
            }

        }else{
            $data = [
                'itemBenefaction' => '',
                'benefactionCategory' => '',
                'quantityBenfaction' => '',
                'benefactionDescription' => '',
                'photoBenfaction1' => '',
                'photoBenfaction2' => '',
                'photoBenfaction3' => '',
                'photoBenfaction4' => '',

                'itemBenefaction_err' => '',
                'benefactionCategory_err' => '',
                'quantityBenfaction_err' => '',
                'benefactionDescription_err' => '',
                'photoBenfaction_err' => ''
            ];

            $this->view('donor/donorAddBenefactions', $data);
        }
    }

    public function postedBenefactions(){
        // Load the view with data
        $data = [
            'pendingBenefaction' => $this->donorModel->getPendingBenefaction(),

            'onProgressBenefaction' => $this->donorModel->getOnProgressBenefaction(),
            
            'completedBenefaction' => $this->donorModel->getCompletedBenefaction()
        ];

        //Load View
        $this->view('donor/postedBenefactions', $data);
    }

    public function viewPostedBenefactions() {
        // Check if benefactionID is set in the POST request
        if(isset($_GET['benefactionID'])) {
            // Get the benefactionID from the POST request
            $benefactionID = $_GET['benefactionID'];            

            // Load the view with data
            $data = [
                'title' => 'View Posted Benefactions',
                'benefaction_details' => $this->donorModel->getBenefaction($benefactionID),
                'benefaction_requests' => $this->donorModel->getBenefactionRequests($benefactionID)
            ];

            // die(print_r($data));            
    
            // Load View
            $this->view('donor/viewPostedBenefactions', $data);
        } else {
            // Handle the case where benefactionID is not set
            // Redirect or show an error message
            echo "Benefaction ID is missing.";
        }
    }
    
    public function editPostedBenefactions(){
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'benefactionID' => $_POST['benefactionID'],
                'itemBenefaction' => trim($_POST['itemBenefaction']),
                'benefactionCategory' => trim($_POST['benefactionCategory']),
                'quantityBenfaction' => trim($_POST['quantityBenfaction']),
                'benefactionDescription' => trim($_POST['benefactionDescription']),

                'availabilityStatus' => '0',
                'availability' => 'pending',

                'itemBenefaction_err' => '',
                'benefactionCategory_err' => '',
                'quantityBenfaction_err' => '',
                'benefactionDescription_err' => ''
            ];
            
            // Map category value to category string
            if (!empty($_POST['benefactionCategory']) && $_POST['benefactionCategory'] != '0') {
                $categoryMap = [
                    '1' => 'Educational Supplies and Tools',
                    '2' => 'Clothing and Accessories',
                    '3' => 'Recreation and Sports Equipment',
                    '4' => 'Furniture and Appliances',
                    '5' => 'Health and Wellness Products',
                    '6' => 'Transportation and Mobility',
                    '7' => 'Literature and Reading Materials',
                    '8' => 'Others'
                ];

                $selectedCategoryId = $_POST['benefactionCategory'];
                $data['benefactionCategory'] = $categoryMap[$selectedCategoryId] ?? ''; // Get corresponding category string
            }
            // die(print_r($this->imgUpload('photoBenfaction1')));

            //validate the input fields seperately
            if(empty($data['itemBenefaction'])){
                $data['itemBenefaction_err']='Please enter the Item';
            }

            if (empty($_POST['benefactionCategory']) || $_POST['benefactionCategory'] == '0') {
                $data['benefactionCategory_err'] = 'Please select a category.';
            }

            if(empty($data['quantityBenfaction'])){
                $data['quantityBenfaction_err']='Please enter the Quantity';
            }

            if(empty($data['benefactionDescription'])){
                $data['benefactionDescription_err']='Please enter a small description about the item explaing it\'s condition and other details';
            }

            if (empty($data['itemBenefaction_err']) && empty($data['quantityBenfaction_err']) && empty($data['benefactionDescription_err']) && empty($data['photoBenfaction_err']) && empty($data['benefactionCategory_err'])) {
                if ($this->donorModel->updateBenefaction($data)) {
                    $data = [
                        'title' => 'Edit Posted Benefactions',
                        'benefactionID' => $_POST['benefactionID'],
                        'benefaction_details' => $this->donorModel->getBenefaction($_POST['benefactionID']),
                    ];
                    $this->view('donor/editPostedBenefactions', $data);

                }else{
                    die('Something Went Wrong');
                }
            }else{
                $data = [
                    'title' => 'Edit Posted Benefactions',
                    'benefaction_details' => $this->donorModel->getBenefaction($benefactionID)
                ];

                $this->view('donor/editPostedBenefactions', $data);
            }

        } else {
            //Pass data to the view
            $data = [
                'title' => 'Edit Posted Benefactions',
                'benefactionID' => $_GET['benefactionID'],
                'benefaction_details' => $this->donorModel->getBenefaction($_GET['benefactionID']),
            ];

            $this->view('donor/editPostedBenefactions', $data);
        }

    }

    public function deleteBenefactions() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['benefactionID'])) {
                $benefactionID = $_POST['benefactionID'];
                
                // Call model method to delete benefaction
                if ($this->donorModel->deleteBenefaction($benefactionID)) {
                    // Deletion successful, redirect or reload data

                    // Fetch updated benefactions data
                    $data = [
                        'pendingBenefaction' => $this->donorModel->getPendingBenefaction(),

                        'onProgressBenefaction' => $this->donorModel->getOnProgressBenefaction(),
                        
                        'completedBenefaction' => $this->donorModel->getCompletedBenefaction()
                    ];

                    // Pass the updated data to the view
                    $this->view('donor/postedBenefactions', $data);
                } else {
                    // Handle deletion failure (e.g., show error message)
                    die('Failed to delete benefaction.');
                }
            }
        }
    }


    public function addAppliedBenefaction(){  
        // die(print_r($_POST));

        if($_SESSION['user_type'] != 'student' && $_SESSION['user_type'] != 'organization') {
            redirect('pages/404');
        }

        else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
                $data = [
                    'requestedQuantity' => trim($_POST['requestedQuantity']),
                    'reason' => trim($_POST['reason']),
                    'benefactionID' => trim($_POST['benefactionID']),
                    'err' => ''
                ];

                // Make sure errors are empty
                if (empty($data['err'])) {
                    
                
                    // Add Data to DB
                    if ($this->BenefactionModel->addAppliedBenefaction($data)) {
                        if($_SESSION['user_type'] == 'student') {
                            redirect('student/benefactions');
                        }
                        else if ($_SESSION['user_type'] == 'organization') {
                        }
                        else {
                            die('User Type Not Found');
                        }
                    } else {
                        die('Something went wrong1');

                    }
                } else {
                    // Load view with errors
                    die('Something went wrong2');
                    $this->story($data);
                }
            }else{
                die('incorrect method!');
            }

        }
    }
}