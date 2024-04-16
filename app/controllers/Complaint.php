<?php
class Complaint extends Controller {
    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only admins are allowed to access admin/superadmin pages
        $this->middleware->checkAccess(['superAdmin', 'admin']);
        $this->complaintModel = $this->model('ComplaintModel');
    }

    public function unassignAdmin() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($this->complaintModel->unassignAdmin($_POST['complaint_ID'])) {
                redirect($_SESSION['user_type'].'/complaint');
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

    public function viewUnassignedComplaint($complaint_ID) {
        $data = [
            'title' => 'Home Page',
            // 'complaint_details' => $this->complaintModel->getComplaintDetails($complaint_ID),
            // 'past_complaints' => $this->complaintModel->getPastComplaints($complaint_ID)
        ];

        $this->view($_SESSION['user_type'].'/complaint/viewUnassignedComplaint', $data);
    }




}