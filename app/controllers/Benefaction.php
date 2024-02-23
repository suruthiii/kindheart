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

                'itemBenefaction_err' => '',
                'quantityBenfaction_err' => '',
                'benefactionDescription_err' => ''
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

            if(empty($data['itemBenefaction_err']) && empty($data['quantityBenfaction_err']) && empty($data['benefactionDescription_err'])){
                if($this->donorModel->addBenefaction($data)){
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

                'itemBenefaction_err' => '',
                'quantityBenfaction_err' => '',
                'benefactionDescription_err' => ''
            ];

            $this->view('donor/donorAddBenefactions', $data);
        }
    }
}