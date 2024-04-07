<?php
class Benefaction extends Controller {
    private $middleware;

    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only organizations are allowed to access organization pages
        $this->middleware->checkAccess(['donor']);
        $this->donorModel = $this->model('DonorModel');
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
                'quantityBenfaction' => trim($_POST['quantityBenfaction']),
                'benefactionDescription' => trim($_POST['benefactionDescription']),

                'photoBenfaction1' => $this->imgUpload('photoBenfaction1'),                
                'photoBenfaction2' => $this->imgUpload('photoBenfaction2'),
                'photoBenfaction3' => $this->imgUpload('photoBenfaction3'),
                'photoBenfaction4' => $this->imgUpload('photoBenfaction4'),

                'availabilityStatus' => '1',
                'availability' => 'pending',

                'itemBenefaction_err' => '',
                'quantityBenfaction_err' => '',
                'benefactionDescription_err' => '',
                'photoBenfaction_err' => ''
            ];
            // die(print_r($this->imgUpload('photoBenfaction1')));

            //validate the input fields seperately
            if(empty($data['itemBenefaction'])){
                $data['itemBenefaction_err']='Please enter the Item';
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

            if(empty($data['itemBenefaction_err']) && empty($data['quantityBenfaction_err']) && empty($data['benefactionDescription_err']) && empty($data['photoBenfaction_err'])){
                if($this->donorModel->addBenefaction($data)){
                    // die(print_r(123));
                    // die(print_r($this->imgUpload('photoBenfaction1')));
                    $this->view('donor/donorPostDonations', $data);
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
                'quantityBenfaction' => '',
                'benefactionDescription' => '',
                'photoBenfaction1' => '',
                'photoBenfaction2' => '',
                'photoBenfaction3' => '',
                'photoBenfaction4' => '',

                'itemBenefaction_err' => '',
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
            
            'completedBenefaction' => $this->donorModel->getCompletedBenefaction()
        ];

        //Load View
        $this->view('donor/postedBenefactions', $data);
    }

    public function viewPostedBenefactions() {
        // Check if benefactionID is set in the POST request
        if(isset($_POST['view'])) {
            // Get the benefactionID from the POST request
            $benefactionID = $_POST['view'];            

            // Load the view with data
            $data = [
                'title' => 'View Posted Benefactions',
                'benefaction_details' => $this->donorModel->getBenefaction($benefactionID)
            ];
    
            // Load View
            $this->view('donor/viewPostedBenefactions', $data);
        } else {
            // Handle the case where benefactionID is not set
            // Redirect or show an error message
        }
    }
    
    public function editPostedBenefactions(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'itemBenefaction' => trim($_POST['itemBenefaction']),
                'quantityBenfaction' => trim($_POST['quantityBenfaction']),
                'benefactionDescription' => trim($_POST['benefactionDescription']),
                'photoBenfaction1' => trim($_POST['photoBenfaction1']),
                'photoBenfaction2' => trim($_POST['photoBenfaction2']),
                'photoBenfaction3' => trim($_POST['photoBenfaction3']),
                'photoBenfaction4' => trim($_POST['photoBenfaction4']),
                'availabilityStatus' => '1',
                'availability' => 'pending',

                'itemBenefaction_err' => '',
                'quantityBenfaction_err' => '',
                'benefactionDescription_err' => '',
                'photoBenfaction_err' => ''
            ];

            //validate the input fields seperately
            if(empty($data['itemBenefaction'])){
                $data['itemBenefaction_err']='Please enter the Item';
            }

            if(empty($data['quantityBenfaction'])){
                $data['quantityBenfaction_err']='Please enter the Quantity';
            }

            if(empty($data['benefactionDescription'])){
                $data['benefactionDescription_err']='Please enter a small description about the item explaing it\'s condition and other details';
            }

            if(empty($data['photoBenfaction1']) && empty($data['photoBenfaction2'])){
                $data['photoBenfaction_err']='Please upload at least 2 photos of the item';
            }

            if(empty($data['itemBenefaction_err']) && empty($data['quantityBenfaction_err']) && empty($data['benefactionDescription_err']) && empty($data['photoBenfaction_err'])){
                if($this->donorModel->updateBenefaction($data)){
                    $this->view('donor/viewPostedBenefactions', $data);
                    // die(print_r(123));
                }else{
                    die('Something Went Wrong');
                }
            }else{
                //Load View
                $backend_data = $this->donorModel->getBenefaction($benefactionID);

                $data = [
                    'itemBenefaction' => $backend_data->itemName,
                    'quantityBenfaction' => $backend_data->itemQuantity,
                    'benefactionDescription' => $backend_data->description,
                    'photoBenfaction1' => $backend_data->itemPhoto1,
                    'photoBenfaction2' => $backend_data->itemPhoto2,
                    'photoBenfaction3' => $backend_data->itemPhoto3,
                    'photoBenfaction4' => $backend_data->itemPhoto4,
        
                    'itemBenefaction_err' => '',
                    'quantityBenfaction_err' => '',
                    'benefactionDescription_err' => '',
                    'photoBenfaction_err' => ''
                ];


                $this->view('donor/editPostedBenefactions', $data);
            }

        }else{
            $backend_data = $this->donorModel->getBenefaction($benefactionID);

            $data = [
                'itemBenefaction' => $backend_data->itemName,
                'quantityBenfaction' => $backend_data->itemQuantity,
                'benefactionDescription' => $backend_data->description,
                'photoBenfaction1' => $backend_data->itemPhoto1,
                'photoBenfaction2' => $backend_data->itemPhoto2,
                'photoBenfaction3' => $backend_data->itemPhoto3,
                'photoBenfaction4' => $backend_data->itemPhoto4,
    
                'itemBenefaction_err' => '',
                'quantityBenfaction_err' => '',
                'benefactionDescription_err' => '',
                'photoBenfaction_err' => ''
            ];


            $this->view('donor/editPostedBenefactions', $data);
        }
    }
}