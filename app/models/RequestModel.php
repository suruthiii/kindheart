<?php
class RequestModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAllUnassignedStudentRequests() {
        $this->db->query("SELECT r.userID, u.username FROM request r JOIN user u ON r.userID = u.userID WHERE assignedStatus = 0 AND userType = 'student';");

        $result = $this->db->resultSet();

        return $result;
    }

    public function getAllAssignedStudentRequests() {
        $this->db->query("SELECT r.userID, r.adminID, u.username FROM request r JOIN user u ON r.userID = u.userID WHERE assignedStatus = 1 AND userType = 'student';");

        $result = $this->db->resultSet();

        return $result;
    }

    public function getAllUnassignedOrganizationRequests() {
        $this->db->query("SELECT r.userID, u.username FROM request r JOIN user u ON r.userID = u.userID WHERE assignedStatus = 0 AND userType = 'organization';");

        $result = $this->db->resultSet();

        return $result;
    }

    public function getAllAssignedOrganizationRequests() {
        $this->db->query("SELECT r.userID, r.adminID, u.username FROM request r JOIN user u ON r.userID = u.userID WHERE assignedStatus = 1 AND userType = 'organization';");

        $result = $this->db->resultSet();

        return $result;
    }

    public function getAssignedStudentRequests() {
        $this->db->query("SELECT r.userID, u.username FROM request r JOIN user u ON r.userID = u.userID WHERE assignedStatus = 0 AND userType = 'student' AND adminID = :adminID;");
        $this->db->bind(':adminID', $_SESSION['user_id']);

        $result = $this->db->resultSet();

        return $result;
    }

    public function getAssignedOrganizationRequests() {
        $this->db->query("SELECT r.userID, r.adminID, u.username FROM request r JOIN user u ON r.userID = u.userID WHERE assignedStatus = 1 AND userType = 'organization' AND adminID = :adminID;");
        $this->db->bind(':adminID', $_SESSION['user_id']);

        $result = $this->db->resultSet();

        return $result;
    }

}    
