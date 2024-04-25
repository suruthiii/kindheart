<?php
class Notification extends Controller {
    public function __construct(){
        $this->middleware = new AuthMiddleware();
        // Only admins are allowed to access admin pages
        $this->middleware->checkAccess(['admin', 'superAdmin', 'student', 'donor', 'organization']);
        $this->notificationModel = $this->model('NotificationModel');
    }

    public function deleteNotification() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->notificationModel->deleteNotification($_POST['notification_ID']);
        }

        redirect($_SESSION['user_type'].'/index');
    }

    public function markAsRead() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->notificationModel->markAsRead($_POST['notification_ID']);
        }

        redirect($_SESSION['user_type'].'/index');
    }
}