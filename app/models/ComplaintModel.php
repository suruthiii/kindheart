<?php
class ComplaintModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAllUnassignedComplaints() {
        $this->db->query('SELECT c.complaintID, u.username FROM complaint c JOIN user u ON c.complainerID = u.userID WHERE c.adminID = 0;');
        
        $result = $this->db->resultSet();

        return $result;
    }

    public function getAllAssignedComplaints() {
        $this->db->query('SELECT c.complaintID, u.username, a.adminName FROM complaint c JOIN user u ON c.complainerID = u.userID JOIN admin a ON c.adminID = a.adminId WHERE c.adminID != 0 AND handlingStatus = 0;');
        
        $result = $this->db->resultSet();

        return $result;
    }

    public function getAssignedComplaints() {
        $this->db->query('SELECT c.complaintID, u.username FROM complaint c JOIN user u ON c.complainerID = u.userID WHERE c.adminID = :adminID;');
        $this->db->bind(':adminID', $_SESSION['user_id']);
        
        $result = $this->db->resultSet();

        return $result;
    }

    public function assignMe($complaint_ID) {
        $this->db->query('UPDATE complaint SET adminID = :adminID WHERE complaintID = :complaintID;');
        $this->db->bind(':complaintID', $complaint_ID);
        $this->db->bind(':adminID', $_SESSION['user_id']);

        if($this->db->execute()) {
            return true;
        }

        else {
            return false;
        }
    }

    public function assignAdmin($admin_ID, $complaint_ID) {
        $this->db->query('UPDATE complaint SET adminID = :adminID WHERE complaintID = :complaintID');
        $this->db->bind(':adminID', $admin_ID);
        $this->db->bind(':complaintID', $complaint_ID);

        if($this->db->execute()) {
            return true;
        }

        else {
            return false;
        }
    }

    public function unassignAdmin($complaint_ID) {
        $this->db->query('UPDATE complaint SET adminID = 0 WHERE complaintID = :complaintID;');
        $this->db->bind(':complaintID', $complaint_ID);

        if($this->db->execute()) {
            return true;
        }

        else {
            return false;
        }
    }

    // Function to get Complainee and Complainer IDs
    public function getIDs($complaint_ID) {
        $this->db->query('SELECT complainerID, complaineeID FROM complaint WHERE complaintID = :complaintID;');
        $this->db->bind(':complaintID', $complaint_ID);

        $ids = $this->db->single();

        return $ids;
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

    public function getUserDetails($user_ID) {
        $userType = $this->getUserType($user_ID);

        if ($userType == 'company'){
            $this->db->query('SELECT u.email, u.username, d.*, c.* FROM user u JOIN donor d ON u.userID = d.donorID JOIN company c ON d.donorID = c.companyID WHERE donorID = :donorID;');
            $this->db->bind(':donorID', $user_ID);
        }

        else if ($userType == 'individual'){
            $this->db->query('SELECT u.email, u.username, d.*, i.* FROM user u JOIN donor d ON u.userID = d.donorID JOIN individual i ON d.donorID = i.individualID WHERE donorID = :donorID;');
            $this->db->bind(':donorID', $user_ID);
        }

        else if ($userType == 'organization'){
            $this->db->query('SELECT u.email, u.username, d.*, o.* FROM user u JOIN donee d ON u.userID = d.doneeID JOIN organization o ON d.doneeID = o.orgID WHERE orgID = :orgID;');
            $this->db->bind(':orgID', $user_ID);
        }

        else if ($userType == 'student'){
            $this->db->query('SELECT u.email, u.username, d.*, s.* FROM user u JOIN donee d ON u.userID = d.doneeID JOIN student s ON d.doneeID = s.studentID WHERE studentID = :studentID;');
            $this->db->bind(':studentID', $user_ID);
        }

        $userDetails = $this->db->single();

        return $userDetails;
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

    public function getComplaintDetails($complaint_ID){
        $this->db->query('SELECT adminID, description FROM complaint WHERE complaintID = :complaintID');
        $this->db->bind(':complaintID', $complaint_ID);

        $details = $this->db->single();

        return $details;
    }

    public function getPastComplaints($complainee_ID){
        $this->db->query('SELECT * FROM complaint WHERE complaineeID = :complaineeID');
        $this->db->bind(':complaineeID', $complainee_ID);

        $result = $this->db->resultSet();

        foreach($result as $item){
            $item->complainerName = $this->getName($item->complainerID)->name;
        }

        return $result;
    }
}    

