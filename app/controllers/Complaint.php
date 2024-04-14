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

    public function viewComplaint() {
        
    }
}