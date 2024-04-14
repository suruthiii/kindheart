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
        $this->db->query('SELECT c.complaintID, u.username, a.adminName FROM complaint c JOIN user u ON c.complainerID = u.userID JOIN admin a ON c.adminID = a.adminId WHERE c.adminID != 0;');
        
        $result = $this->db->resultSet();

        return $result;
    }

    public function getAssignedComplaints() {
        $this->db->query('SELECT c.complaintID, u.username FROM complaint c JOIN user u ON c.complainerID = u.userID WHERE c.adminID = :adminID;');
        $this->db->bind(':adminID', $_SESSION['user_id']);
        
        $result = $this->db->resultSet();

        return $result;
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
}    