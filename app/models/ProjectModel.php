<?php
class ProjectModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAllPendingProjects() {
        $this->db->query('SELECT projectID, title, (budget - receivedAmount) AS amount, description FROM project WHERE status = 0; ');
        
        $result = $this->db->resultSet();

        return $result;
    }

    public function getAllConfirmedProjects() {
        $this->db->query('SELECT projectID, title, budget AS amount, description FROM project WHERE status = 1; ');
        
        $result = $this->db->resultSet();
        
        return $result;
    }

    public function getAllOngoingProjects() {
        $this->db->query('SELECT projectID, title, budget AS amount, description FROM project WHERE status = 3; ');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
}    