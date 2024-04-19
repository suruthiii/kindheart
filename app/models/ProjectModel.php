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

    public function getaddedongoingprojects(){
        $this->db->query('SELECT projectID, title, budget, description FROM project WHERE status = 0; ');

        $result = $this->db->resultSet();

        return $result;
    }

    public function getaddedcompletedprojects(){
        $this->db->query('SELECT projectID, title, budget, description FROM project WHERE status = 2; ');

        $result = $this->db->resultSet();

        return $result;
    }

    public function getProjectDetails($project_ID) {
        $this->db->query('SELECT p.title, p.budget, p.receivedAmount, p.description, o.orgName FROM project p JOIN organization o ON p.orgID = o.orgID WHERE p.projectID = :projectID;');
        $this->db->bind(':projectID', $project_ID);

        $row = $this->db->single();

        return $row;
    }

    public function getAllComments($project_ID) {
        $this->db->query("SELECT c.postID, c.comment, a.adminName FROM comment c JOIN admin a ON c.adminID = a.adminID WHERE c.postID = :postID AND c.postType = 'project' ORDER BY time DESC;");
        $this->db->bind(':postID', $project_ID);

        $result = $this->db->resultSet();

        return $result;
    }

    public function addComment($data) {
        $this->db->query("INSERT INTO comment (postID, adminID, time, postType, comment) VALUES (:postID, :adminID, :time, 'project', :comment);");
        $this->db->bind(':postID', $data['project_ID']);
        $this->db->bind(':adminID', $_SESSION['user_id']);
        $this->db->bind(':time', date("Y-m-d H:i:s"));
        $this->db->bind(':comment', $data['comment']);

        if($this->db->execute()) {
            return true;
        }

        else {
            return false;
        }
    }

    public function getUserType($user_ID) {
        $this->db->query('SELECT userType FROM user WHERE userID = :userID;');
        $this->db->bind(':userID', $user_ID);

        $row = $this->db->single();

        return $row->userType;
    }

}    