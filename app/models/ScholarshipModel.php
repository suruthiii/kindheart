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

    public function getComScholarshipDetails($scholarship_ID) {
        $this->db->query('SELECT s.title, s.amount, s.startDate, s.description, c.companyID AS donorID, c.companyName AS name FROM scholarship s JOIN company c ON s.donorID = c.companyID WHERE s.scholarshipID = :scholarshipID;');
        $this->db->bind(':scholarshipID', $scholarship_ID);

        $row = $this->db->single();

        return $row;
    }

    public function getIndScholarshipDetails($scholarship_ID) {
        $this->db->query('SELECT s.title, s.amount, s.startDate, s.description, i.individualID AS donorID, CONCAT(i.fName, " ", i.lName) AS name FROM scholarship s JOIN individual i ON s.donorID = i.individualID WHERE s.scholarshipID = :scholarshipID;');
        $this->db->bind(':scholarshipID', $scholarship_ID);

        $row = $this->db->single();

        return $row;
    }

    public function getDonorType($scholarship_ID) {
        $this->db->query('SELECT donorType FROM donor d JOIN scholarship s ON d.donorID = s.donorID WHERE s.scholarshipID = :scholarshipID;');
        $this->db->bind(':scholarshipID', $scholarship_ID);

        $row = $this->db->single();

        return $row->donorType;
    }

    public function getAllComments($scholarship_ID) {
        $this->db->query("SELECT c.postID, c.comment, a.adminName FROM comment c JOIN admin a ON c.adminID = a.adminID WHERE c.postID = :postID AND c.postType = 'scholarship' ORDER BY time DESC;");
        $this->db->bind(':postID', $scholarship_ID);

        $result = $this->db->resultSet();

        return $result;
    }

    public function addComment($data) {
        $this->db->query("INSERT INTO comment (postID, adminID, time, postType, comment) VALUES (:postID, :adminID, :time, 'scholarship', :comment);");
        $this->db->bind(':postID', $data['scholarship_ID']);
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

    public function getDonorID($scholarship_ID) {
        $this->db->query('SELECT donorID FROM scholarship WHERE scholarshipID = :scholarshipID;');
        $this->db->bind(':scholarshipID', $scholarship_ID);

        $donorID = $this->db->single()->donorID;

        return $donorID;
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

    // View Scholarship
    public function getScholarship($scholarshipID) {
        // Prepare statement
        $this->db->query('SELECT * FROM scholarship WHERE scholarshipID = :scholarshipID');
        $this->db->bind(':scholarshipID', $scholarshipID);
        
        // Execute
        $row = $this->db->single();

        // Fetch result set
        return $row;
    }

    //View Scholarship Requests
    public function getScholarshipApplications($scholarshipID) {
        $this->db->query('SELECT u.userType AS userType,
                            CASE
                                WHEN u.userType = "student" THEN s.studentID
                                WHEN u.userType = "organization" THEN o.orgID
                            END AS doneeID,
                            CASE
                                WHEN u.userType = "student" THEN CONCAT(s.fname, " ", s.lname)
                                WHEN u.userType = "organization" THEN o.orgName
                            END AS doneeName,
                            sh.reason,
                            sh.requestedQuantity,
                            db.benefactionID,
                            db.verificationStatus
                        FROM 
                            donee_benefaction db
                        JOIN 
                            user u ON db.doneeID = u.userID
                        LEFT JOIN 
                            student s ON u.userType = "student" AND s.studentID = db.doneeID
                        LEFT JOIN 
                            organization o ON u.userType = "organization" AND o.orgID = db.doneeID
                        WHERE 
                            u.status != 10
                            AND sh.scholarshipID = :scholarshipID;)');   

        $this->db->bind(':scholarshipID', $scholarshipID);

        $result = $this->db->resultSet();

        return $result;
    }

    //Edit Scholarship
    public function updateScholarship($data){
        // Prepare statement
        $this->db->query('UPDATE scholarship SET title = :title, amount = :amount, startDate = :startDate, duration = :duration, deadline = :deadline, description = :description WHERE scholarshipID = :scholarshipID');

        // Bind values
        $this->db->bind(':title', $data['titleScholarship']);
        $this->db->bind(':amount', $data['amountScholarship']);
        $this->db->bind(':startDate', $data['startDateScholarship']);
        $this->db->bind(':duration', $data['durationScholarship']);
        $this->db->bind(':deadline', $data['deadlineScholarship']);
        $this->db->bind(':description', $data['scholarshipDescription']);
        $this->db->bind(':scholarshipID', $data['scholarshipID']);
        
        // Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    //Delete Scholarship
    public function deleteScholarship($scholarshipID){
        // Prepare statement
        $this->db->query('UPDATE scholarship SET availabilityStatus = 10 WHERE scholarshipID = :scholarshipID');
        $this->db->bind(':scholarshipID', $scholarshipID);

        // Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

 // ----------------------Student/organization Controllers(scolaship data retriev)------------------



public function getAppliedScholarships() { 
        
    $this->db->query('SELECT *
    FROM scholarship_request sr 
    LEFT JOIN student_scholarship ss ON sr.scholarshipID = ss.scholarshipID AND sr.studentID = ss.studentID
    LEFT JOIN scholarship s ON sr.scholarshipID = s.scholarshipID 
    WHERE sr.studentID = :studentID ;');


    $this->db->bind(':studentID', $_SESSION['user_id']);
    $result = $this->db->resultSet();
    // die(print_r($result));
    // Return an array of story data
    return array_reverse($result); 
  
    }


    public function getScholarships() { 
    
        $this->db->query('SELECT s.scholarshipID, s.title, s.amount, s.startDate, s.duration, s.description, s.donorID , s.postedDate, s.deadline, s.availabilityStatus, u.username, sr.studentID 
        FROM scholarship s 
        JOIN user u ON u.userID = s.donorID 
        LEFT JOIN scholarship_request sr ON sr.scholarshipID = s.scholarshipID AND sr.studentID = :userID 
        WHERE s.availabilityStatus = 0;');

        $this->db->bind(':userID',$_SESSION['user_id'] );

        $result = $this->db->resultSet();
        // Return an array of applied benefaction data
        return array_reverse($result); 
      
    }

    


public function addAppliedScholarship($data){
    // Prepare statement
    $this->db->query('INSERT INTO scholarship_request (scholarshipID, studentID, reason) VALUES (:scholarshipID, :studentID, :reason)');

    // Bind values
   
    $this->db->bind(':reason', $data['reason']);
    $this->db->bind(':studentID', $_SESSION['user_id']);
    $this->db->bind(':scholarshipID', $data['scholarshipID']);

    // Execute
    if($this->db->execute()){
        return true;
    }else{
        return false;
    }
}



public function getScholarshipNotApplied($scholarshipID) {
    // Prepare statement
    $this->db->query('SELECT * FROM scholarship s JOIN user u WHERE scholarshipID = :scholarshipID');
    $this->db->bind(':scholarshipID', $scholarshipID);

    
    // Execute
    $row = $this->db->single();

    // Fetch result set
    return $row;
}


    public function getAppliedScholarship($scholarshipID) {
        // Prepare statement
        $this->db->query('SELECT * 
        FROM scholarship s
        JOIN scholarship_request sr ON sr.scholarshipID = s.scholarshipID 
        LEFT JOIN student_scholarship ss ON ss.scholarshipID= s.scholarshipID 
        JOIN user u ON u.userID = s.donorID
        WHERE s.scholarshipID = :scholarshipID
        AND sr.studentID = :studentID;
        AND (ss.studentID = :studentID OR ss.studentID IS NULL);
        ');
        $this->db->bind(':scholarshipID', $scholarshipID);
        $this->db->bind(':studentID', $_SESSION['user_id']);
    
        // Execute
        $row = $this->db->single();

        // Fetch result set
        return $row;
    }

   


}





