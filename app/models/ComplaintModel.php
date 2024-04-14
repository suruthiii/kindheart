<?php
class ComplaintModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAllUnassignedComplaints() {
        $this->db->query('SELECT c.complaintID, c.complainerID, u.username FROM complaint c JOIN user u WHERE c.complainerID = u.userID AND c.adminID = 0;');
        
        $result = $this->db->resultSet();

        return $result;
    }

    public function getAllAssignedComplaints() {
        $this->db->query('SELECT c.complaintID, c.complainerID, u.username FROM complaint c JOIN user u WHERE c.complainerID = u.userID AND c.adminID != 0;');
        
        $result = $this->db->resultSet();

        return $result;
    }
}    