<?php
class NotificationModel {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function createNotification($title, $notificationType, $senderID, $receiverID, $description, $data = '') {
        $this->db->query("INSERT INTO notification (title, notificationType, senderID, receiverID, description, time, data) VALUES(:title, :notificationType, :senderID, :receiverID, :description, :time, :data)");
        $this->db->bind(':title', $title);
        $this->db->bind(':notificationType', $notificationType);
        $this->db->bind(':senderID', $senderID);
        $this->db->bind(':receiverID', $receiverID);
        $this->db->bind(':description', $description);
        $this->db->bind(':time', date("Y-m-d H:i:s"));
        $this->db->bind(':data', $data);

        if($this->db->execute()) {
            return true;
        }

        else {
            return false;
        }
    
    }

    public function getUserType($user_ID){
        $this->db->query('SELECT userType FROM user WHERE userID = :userID;');
        $this->db->bind(':userID', $user_ID);

        $userType = $this->db->single()->userType;
    
        if ($userType == 'donor') {
            $this->db->query('SELECT donorType FROM donor WHERE donorID = :donorID;');
            $this->db->bind(':donorID', $user_ID);

            $userType =  $this->db->single()->donorType;
        }

        return $userType;
    }

    public function getName($user_ID){
        $userType = $this->getUserType($user_ID);

        if ($userType == 'company'){
            $this->db->query('SELECT companyName AS name FROM company WHERE companyID = :companyID;');
            $this->db->bind(':companyID', $user_ID);
        }

        else if ($userType == 'individual'){
            $this->db->query('SELECT CONCAT(fName, " ", lName) AS name FROM individual WHERE individualID = :individualID;');
            $this->db->bind(':individualID', $user_ID);
        }

        else if ($userType == 'organization'){
            $this->db->query('SELECT orgName AS name FROM organization WHERE orgID = :orgID;');
            $this->db->bind(':orgID', $user_ID);
        }

        else if ($userType == 'student'){
            $this->db->query('SELECT CONCAT(fName, " ", lName) AS name FROM student WHERE studentID = :studentID;');
            $this->db->bind(':studentID', $user_ID); 
        }

        else if($userType == 'admin') {
            $this->db->query('SELECT adminName AS name FROM admin WHERE adminID = :adminID;');
            $this->db->bind(':adminID', $user_ID);
        }

        else if($userType == 'superAdmin') {
            $this->db->query('SELECT adminName AS name FROM admin WHERE adminID = :adminID;');
            $this->db->bind(':adminID', $user_ID);
        }

        $name = $this->db->single();

        return $name;
    }

    public function getNotificationCount() {
        $userType = $this->getUserType($_SESSION['user_id']);

        if($userType == 'admin' || $userType == 'superAdmin') {
            $this->db->query('SELECT COUNT(*) AS count FROM notification WHERE receiverID = 0;');
            // $this->db->bind(':receiverID', $_SESSION['user_id']);
        }

        else {
            $this->db->query('SELECT COUNT(*) AS count FROM notification WHERE receiverID = :receiverID;');
            $this->db->bind(':receiverID', $_SESSION['user_id']);
        }

        $result = $this->db->single();

        return $result->count;
    }

    public function viewNotifications() {
        $userType = $this->getUserType($_SESSION['user_id']);

        if($userType == 'admin' || $userType == 'superAdmin') {
            $this->db->query('SELECT * FROM notification WHERE receiverID = 0 ORDER BY time DESC;');
            // $this->db->bind(':receiverID', $_SESSION['user_id']);
        }

        else {
            $this->db->query('SELECT * FROM notification WHERE receiverID = :receiverID ORDER BY time DESC;');
            $this->db->bind(':receiverID', $_SESSION['user_id']);
        }
       
        $result = $this->db->resultSet();

        foreach($result as $item) {
            $item->name = $this->getName($item->senderID)->name;
        }

        return $result;
    }

    public function markAsRead($notification_ID) {
        $this->db->query('UPDATE notification SET status = 1 WHERE notificationID = :notificationID');
        $this->db->bind(':notificationID', $notification_ID);

        if($this->db->execute()){
            return true;
        }

        else {
            return false;
        }   
    }

    public function deleteNotification($notification_ID) {
        $this->db->query('DELETE FROM notification WHERE notificationID = :notificationID;');
        $this->db->bind(':notificationID', $notification_ID);

        if($this->db->execute()){
            return true;
        }

        else {
            return false;
        }    
    }


}