<?php
class Complaint extends Controller {
    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only admins are allowed to access admin/superadmin pages
        $this->middleware->checkAccess(['superAdmin', 'admin']);
        $this->complaintModel = $this->model('ComplaintModel');
    }

    public function viewComplaint() {
        
    }
}