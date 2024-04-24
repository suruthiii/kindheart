<?php
class NotificationModel {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function createNotification() {
        
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

        $name = $this->db->single();

        return $name;
    }

    public function getNotificationCount() {
        $this->db->query('SELECT COUNT(*) AS count FROM notification WHERE receiverID = :receiverID;');
        $this->db->bind(':receiverID', $_SESSION['user_id']);

        $result = $this->db->single();

        return $result->count;
    }

    public function viewNotifications() {
        $this->db->query('SELECT * FROM notification WHERE receiverID = :receiverID;');
        $this->db->bind(':receiverID', $_SESSION['user_id']);

        $result = $this->db->resultSet();

        foreach($result as $item) {
            $item->name = $this->getName($item->senderID)->name;
        }

        return $result;
    }

    public function markAsRead() {

    }

    public function deleteNotification($notificationID) {
        $this->db->query('DELETE FROM notification WHERE notificationID = :notificationID;');
        $this->db->bind(":notificationID", $notificationID);

        if($this->db->execute()){
            return true;
        }

        else {
            return false;
        }    
    }
    
}