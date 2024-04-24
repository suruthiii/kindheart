<?php
class Notification extends Controller {
    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only admins are allowed to access admin pages
        $this->middleware->checkAccess(['admin', 'superadmin', 'student', 'donor', 'organization']);
        $this->notificationModel = $this->model('NotificationModel');
    }


    public function deleteNotification() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->notificationModel->deleteNotification($_POST['notificationID']);
        }

        redirect($_SESSION['user_type'].'/index');
    }
}