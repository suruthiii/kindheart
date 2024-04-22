<?php
class Complaint extends Controller {
    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only admins are allowed to access admin/superadmin pages
        $this->middleware->checkAccess(['superAdmin', 'admin']);
        $this->complaintModel = $this->model('ComplaintModel');
        $this->userModel = $this->model('UserModel');
    }

    public function unassignAdmin() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($this->complaintModel->unassignAdmin($_POST['complaint_ID'])) {
                redirect($_SESSION['user_type'].'/complaint');
            }
        }
    }

    public function assignAdmin() {
        if($_SESSION['user_type'] != 'superAdmin') {
            redirect('pages/404');
        }

        else {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if($this->complaintModel->assignAdmin($_POST['admin_ID'], $_POST['complaint_ID'])) {
                    redirect('superadmin/complaint');
                }
            }
        }
    }

    public function assignMe() {
        if($_SESSION['user_type'] != 'admin') {
            redirect('pages/404');
        }

        else {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if($this->complaintModel->assignMe($_POST['complaint_ID'])) {
                    redirect('admin/complaint');
                }
            }
        }    
    }

    public function viewComplaint() {
        $complaint_people = $this->complaintModel->getIDs($_GET['complaint_ID']);
        $complainer_ID = $complaint_people->complainerID;
        $complainee_ID = $complaint_people->complaineeID;
        
        $data = [
            'complaint_ID' => $_GET['complaint_ID'],
            'complainer_ID' => $complainer_ID,
            'complainee_ID' => $complainee_ID,
            'complainee_name' => $this->complaintModel->getName($complainee_ID)->name,
            'complainer_name' => $this->complaintModel->getName($complainer_ID)->name,
            'complaint_description' => $this->complaintModel->getComplaintDetails($_GET['complaint_ID'])->description,
            'complaint_adminID' => $this->complaintModel->getComplaintDetails($_GET['complaint_ID'])->adminID,
            'admins' => $this->userModel->viewAdmins(),
            'past_complaints' =>  $this->complaintModel->getPastComplaints($complainee_ID)
        ];

        $this->view($_SESSION['user_type'].'/complaint/viewComplaint', $data);
    }

    public function banComplainee() {
        if($this->userModel->banUser($_POST['complainee_ID'])) {
            redirect('complaint/viewComplaint?complaint_ID='.$data['complaint_ID']);
       }
    }

    public function viewComplainerProfile() {
        $complainerType = $this->complaintModel->getUserType($_GET['complainer_ID']);

        $data = [
            'title' => 'Home Page',
            'details' => $this->complaintModel->getUserDetails($_GET['complainer_ID'], $complainerType),
        ];

        if ($complainerType == 'student') {
            $this->view($_SESSION['user_type'].'/complaint/viewStudentProfile', $data);
        }

        else if ($complainerType == 'organization') {
            $this->view($_SESSION['user_type'].'/complaint/viewOrganizationProfile', $data);
        }
        
        else if ($complainerType == 'company') {
            $this->view($_SESSION['user_type'].'/complaint/viewDonorComProfile', $data);
        }

        else if ($complainerType == 'individual') {
            $this->view($_SESSION['user_type'].'/complaint/viewDonorIndProfile', $data);
        }
    }

    public function viewComplaineeProfile() {
        $complaineeType = $this->complaintModel->getUserType($_GET['complainee_ID']);

        $data = [
            'title' => 'Home Page',
            'details' => $this->complaintModel->getUserDetails($_GET['complainee_ID'], $complaineeType)
        ];

        if ($complaineeType == 'student') {
            $this->view($_SESSION['user_type'].'/complaint/viewStudentProfile', $data);
        }

        else if ($complaineeType == 'organization') {
            $this->view($_SESSION['user_type'].'/complaint/viewOrganizationProfile', $data);
        }
        
        else if ($complaineeType == 'company') {
            $this->view($_SESSION['user_type'].'/complaint/viewDonorComProfile', $data);
        }

        else if ($complaineeType == 'individual') {
            $this->view($_SESSION['user_type'].'/complaint/viewDonorIndProfile', $data);
        }
    }

}