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

    public function getName($user_ID){
        $userType = $this->getUserType($user_ID);

        if ($userType == 'company'){
            $this->db->query('SELECT companyName AS name FROM company WHERE companyID = :companyID;');
            $this->db->bind(':companyID', $user_ID);

            $name = $this->db->single();
        }

        else if ($userType == 'individual'){
            $this->db->query('SELECT CONCAT(fName, " ", lName) AS name FROM individual WHERE individualID = :individualID;');
            $this->db->bind(':individualID', $user_ID);

            $name = $this->db->single();
        }

        else if ($userType == 'organization'){
            $this->db->query('SELECT orgName AS name FROM organization WHERE orgID = :orgID;');
            $this->db->bind(':orgID', $user_ID);

            $name = $this->db->single();
        }

        else if ($userType == 'student'){
            $this->db->query('SELECT CONCAT(fName, " ", lName) AS name FROM student WHERE studentID = :studentID;');
            $this->db->bind(':studentID', $user_ID);

            $name = $this->db->single();
        }

        return $name;
    }

    public function getComplaintDetails($complaint_ID){
        $this->db->query('SELECT adminID, description FROM complaint WHERE complaintID = :complaintID');
        $this->db->bind(':complaintID', $complaint_ID);

        $details = $this->db->single();

        return $details;
    }

    public function getComplaineeType($complaint_ID) {
        $this->db->query('SELECT complaineeType FROM complaint WHERE complaintID = :complaintID');
        $this->db->bind(':complaintID', $complaint_ID);

        $complaineeType = $this->db->single();

        return $complaineeType;
    }

    public function getPastComplaintsOthers($complainee_ID){
        // complaineeType = getComplaineeType($complainee_ID)

        // if complaineeType == 'student' OR complaineeType == 'organization'
        // SELECT c.complaint, CONCAT(i.fName, " ", i.lName) AS name FROM complaint c JOIN individual i ON c.complainerID = i.individualID WHERE c.complaineeID = :complaineeID
        // SELECT c.complaint, cn.companyName AS name FROM complaint c JOIN company cn ON c.complainerID = cn.companyID WHERE c.complaineeID = :complaineeID 

        // else if complaineeType == 'donor'
        // SELECT c.complaint, CONCAT(s.fName, " ", s.lName) AS name FROM complaint c JOIN student s ON c.complainerID = s.studentID WHERE c.complaineeID = :complaineeID
        // SELECT c.complaint, o.orgName AS name FROM complaint c JOIN organization o ON c.complainerID = o.orgID WHERE c.complaineeID = :complaineeID 

        // $history = $this->db->resultSet();

        // return $history;
    }
}    

