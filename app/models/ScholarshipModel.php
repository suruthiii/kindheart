<?php
class ScholarshipModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAllPendingScholarships() {
        $this->db->query('SELECT scholarshipID, title, amount, description FROM scholarship WHERE availabilityStatus = 0;');

        $result = $this->db->resultSet();

        return $result;
    }

    public function getAllConfirmedScholarships() {
        $this->db->query('SELECT scholarshipID, title, amount, description FROM scholarship WHERE availabilityStatus = 1;');

        $result = $this->db->resultSet();

        return $result;
    }

    public function getAllOngoingScholarships() {
        $this->db->query('SELECT scholarshipID, title, amount, description FROM scholarship WHERE availabilityStatus = 3;');

        $result = $this->db->resultSet();

        return $result;
    }

    // ----------------------Donor Controllers------------------

    //Add Scholarship
    public function addScholarship($data){
        // Prepare statement
        $this->db->query('INSERT INTO scholarship (title, amount, startDate, duration, deadline, description, availabilityStatus, postedDate, donorID) VALUES (:title, :amount, :startDate, :duration, :deadline, :description, :availabilityStatus, :postedDate, :donorID)');

        // Bind values
        $this->db->bind(':title', $data['titleScholarship']);
        $this->db->bind(':amount', $data['amountScholarship']);
        $this->db->bind(':startDate', $data['startDateScholarship']);
        $this->db->bind(':duration', $data['durationScholarship']);
        $this->db->bind(':deadline', $data['deadlineScholarship']);
        $this->db->bind(':description', $data['scholarshipDescription']);
        $this->db->bind(':availabilityStatus', $data['availabilityStatus']);
        $this->db->bind(':postedDate', date('Y-m-d'));
        $this->db->bind(':donorID', $_SESSION['user_id']);

        // Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    // Get pending Scholarships
    public function getPendingScholarship() {
        // Prepare statement
        $this->db->query('SELECT * FROM scholarship WHERE availabilityStatus = 0');
        
        // Execute
        $this->db->execute();

        // Fetch result set
        return $this->db->resultSet();
    }

    // Get onProgress Scholarships
    public function getOnProgressScholarship() {
        // Prepare statement
        $this->db->query('SELECT * FROM scholarship WHERE availabilityStatus = 1');
        
        // Execute
        $this->db->execute();

        // Fetch result set
        return $this->db->resultSet();
    }
    

    // Get completed Scholarships
    public function getCompletedScholarship() {
        // Prepare statement
        $this->db->query('SELECT * FROM scholarship WHERE availabilityStatus = 2');
        
        // Execute
        $this->db->execute();

        // Fetch result set
        return $this->db->resultSet();
    }
}
