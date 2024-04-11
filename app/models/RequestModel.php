<?php
class RequestModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAllUnassignedStudentRequests() {
        $this->db->query("SELECT u.userID, u.username FROM user u JOIN donee d ON u.userID = d.doneeID WHERE u.status = 0 AND d.adminID = 0 AND d.doneeType = 'student';");

        $result = $this->db->resultSet();

        return $result;
    }

    public function getAllAssignedStudentRequests() {
        $this->db->query("SELECT u.userID, u.username, d.adminID, a.adminName FROM user u JOIN donee d ON u.userID = d.doneeID LEFT JOIN admin a ON d.adminID = a.adminID WHERE u.status = 0 AND d.adminID != 0 AND d.doneeType = 'student';");

        $result = $this->db->resultSet();

        return $result;
    }

    public function getAllUnassignedOrganizationRequests() {
        $this->db->query("SELECT u.userID, u.username FROM user u JOIN donee d ON u.userID = d.doneeID WHERE u.status = 0 AND d.adminID = 0 AND d.doneeType = 'organization';");

        $result = $this->db->resultSet();

        return $result;
    }

    public function getAllAssignedOrganizationRequests() {
        $this->db->query("SELECT u.userID, u.username, d.adminID, a.adminName FROM user u JOIN donee d ON u.userID = d.doneeID LEFT JOIN admin a ON d.adminID = a.adminID WHERE u.status = 0 AND d.adminID != 0 AND d.doneeType = 'organization';");

        $result = $this->db->resultSet();

        return $result;
    }

    public function getAssignedStudentRequests() {
        $this->db->query("SELECT u.userID, u.username, a.adminName FROM user u JOIN donee d ON u.userID = d.doneeID LEFT JOIN admin a ON d.adminID = a.adminID WHERE u.status = 0 AND d.doneeType = 'student' AND d.adminID = :adminID;");
        $this->db->bind(':adminID', $_SESSION['user_id']);

        $result = $this->db->resultSet();

        return $result;
    }

    public function getAssignedOrganizationRequests() {
        $this->db->query("SELECT u.userID, u.username, a.adminName FROM user u JOIN donee d ON u.userID = d.doneeID LEFT JOIN admin a ON d.adminID = a.adminID WHERE u.status = 0 AND d.doneeType = 'organization' AND d.adminID = :adminID;");
        $this->db->bind(':adminID', $_SESSION['user_id']);

        $result = $this->db->resultSet();

        return $result;
    }

    public function getStudent($student_ID) {
        $this->db->query('SELECT u.email, u.username, d.*, s.* FROM user u JOIN donee d ON u.userID = d.doneeID JOIN student s ON d.doneeID = s.studentID WHERE studentID = :studentID;');
        $this->db->bind(':studentID', $student_ID);

        $row = $this->db->single();

        return $row;
    }

    public function getOrganization($org_ID) {
        $this->db->query('SELECT u.email, u.username, d.*, o.* FROM user u JOIN donee d ON u.userID = d.doneeID JOIN organization o ON d.doneeID = o.orgID WHERE orgID = :orgID;');
        $this->db->bind(':orgID', $org_ID);

        $row = $this->db->single();

        return $row;
    }

    public function getDoneeType($donee_ID) {
        $this->db->query('SELECT doneeType FROM donee WHERE doneeID = :doneeID;');
        $this->db->bind(':doneeID', $donee_ID);

        $result = $this->db->single();

        return $result;
    }

    public function unassignAdmin($donee_ID) {
        $this->db->query('UPDATE donee SET adminID = 0 WHERE doneeID = :doneeID');
        $this->db->bind(':doneeID', $donee_ID);

        if($this->db->execute()) {
            return true;
        }

        else {
            return false;
        }
    }
}    
