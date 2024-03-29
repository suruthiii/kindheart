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
        $this->view('organization/index', $data);
    }

    public function donorAddBenefactions(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
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
                if($this->donorModel->addBenefaction($data)){
                    $this->view('donor/donorPostDonations', $data);
                    // die(print_r(123));
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


    public function viewPostedBenefactions(){

        // Get benefactionID from POST request
        $benefactionID = $_POST['benefactionID'] ?? null;
        $benefactionID = '13';

        // Check if benefactionID is provided
        if ($benefactionID === null) {
            die('Benefaction ID is missing.');
        }

        // Load the view with data
        $data = [
            'title' => 'View Posted Benefactions',
            'benefaction_details' => $this->donorModel->getBenefaction($benefactionID)
        ];
    
        //Load View
        $this->view('donor/viewPostedBenefactions', $data);
    }

}