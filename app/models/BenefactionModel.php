<?php
class BenefactionModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

// -------------------Donor----------------------

    public function addBenefaction($data){
        // Prepare statement
        $this->db->query('INSERT INTO benefaction (itemName, itemCategory, itemQuantity, itemPhoto1, itemPhoto2, itemPhoto3, itemPhoto4, description, postedDate, donorID, availabilityStatus) VALUES (:itemName, :itemCategory, :itemQuantity, :itemPhoto1, :itemPhoto2, :itemPhoto3, :itemPhoto4, :description, :postedDate, :donorID, :availabilityStatus)');

        // Bind values
        $this->db->bind(':itemName', $data['itemBenefaction']);
        $this->db->bind(':itemCategory', $data['benefactionCategory']);
        $this->db->bind(':itemQuantity', $data['quantityBenfaction']);            
        $this->db->bind(':itemPhoto1', isset($data['photoBenfaction1']) ? $data['photoBenfaction1'] : null);
        $this->db->bind(':itemPhoto2', isset($data['photoBenfaction2']) ? $data['photoBenfaction2'] : null);
        $this->db->bind(':itemPhoto3', isset($data['photoBenfaction3']) ? $data['photoBenfaction3'] : null);
        $this->db->bind(':itemPhoto4', isset($data['photoBenfaction4']) ? $data['photoBenfaction4'] : null);
        $this->db->bind(':description', $data['benefactionDescription']);
        $this->db->bind(':postedDate', date('Y-m-d')); // Automatically set the posted date
        $this->db->bind(':donorID', $_SESSION['user_id']);
        $this->db->bind(':availabilityStatus', $data['availabilityStatus']);

        // Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }

    // Get pending benefactions
    public function getPendingBenefaction() {
        // Prepare statement
        $this->db->query('SELECT b.benefactionID, b.itemName, b.itemCategory, b.itemQuantity, b.itemPhoto1, b.itemPhoto2, b.itemPhoto3, b.itemPhoto4, b.description, b.postedDate,
                            SUM(CASE WHEN br.acceptanceStatus IN (0, 1) THEN br.requestedQuantity ELSE 0 END) AS totalRequestedQuantity
                            FROM benefaction b
                            LEFT JOIN benefaction_request br ON b.benefactionID = br.benefactionID
                            WHERE b.availabilityStatus = 0
                            GROUP BY b.benefactionID, b.itemName, b.itemCategory, b.itemQuantity, b.itemPhoto1, b.itemPhoto2, b.itemPhoto3, b.itemPhoto4, b.description, b.postedDate;
                            ');

        // Execute
        $this->db->execute();

        // Fetch result set
        return $this->db->resultSet();
    }

    // Get onProgress benefactions
    public function getOnProgressBenefaction() {
        // Prepare statement
        $this->db->query('SELECT * FROM benefaction WHERE availabilityStatus = 1');

        // Execute
        $this->db->execute();

        // Fetch result set
        return $this->db->resultSet();
    }


    // Get completed benefactions
    public function getCompletedBenefaction() {
        // Prepare statement
        $this->db->query('SELECT * FROM benefaction WHERE availabilityStatus = 2');

        // Execute
        $this->db->execute();

        // Fetch result set
        return $this->db->resultSet();
    }

    // View Benefaction
    public function getBenefactionForDonor($benefactionID) {
        // Prepare statement
        $this->db->query('SELECT * FROM benefaction WHERE benefactionID = :benefactionID');
        $this->db->bind(':benefactionID', $benefactionID);

        // Execute
        $row = $this->db->single();

        // Fetch result set
        return $row;
    }

    //View Benefaction Requests for a certain beenfaction
    public function getBenefactionRequests($benefactionID) {

        // Prepare statement
        $this->db->query('SELECT u.userType AS userType,
                            CASE
                                WHEN u.userType = "student" THEN s.studentID
                                WHEN u.userType = "organization" THEN o.orgID
                            END AS doneeID,
                            CASE
                                WHEN u.userType = "student" THEN CONCAT(s.fname, " ", s.lname)
                                WHEN u.userType = "organization" THEN o.orgName
                            END AS doneeName,
                            db.reason,
                            db.requestedQuantity,
                            db.acceptanceStatus,
                            db.benefactionID,
                            b.donatedQuantity
                        FROM 
                            benefaction_request db
                        JOIN 
                            user u ON db.doneeID = u.userID
                        LEFT JOIN 
                            student s ON u.userType = "student" AND s.studentID = db.doneeID
                        LEFT JOIN 
                            organization o ON u.userType = "organization" AND o.orgID = db.doneeID
                        LEFT JOIN 
                            benefaction b ON db.benefactionID = b.benefactionID
                        WHERE 
                            u.status != 10
                            AND db.benefactionID = :benefactionID
                    ');   

        $this->db->bind(':benefactionID', $benefactionID);

        $result = $this->db->resultSet();

        return $result;
    }

    //Edit Benefaction
    public function updateBenefaction($data){
        // Prepare statement
        $this->db->query('UPDATE benefaction SET itemName = :itemName, itemCategory = :itemCategory, itemQuantity = :itemQuantity, description = :description, donorID = :donorID WHERE benefactionID = :benefactionID');

        // Bind values
        $this->db->bind(':itemName', $data['itemBenefaction']);
        $this->db->bind(':itemCategory', $data['benefactionCategory']);
        $this->db->bind(':itemQuantity', $data['quantityBenfaction']);            
        $this->db->bind(':description', $data['benefactionDescription']);
        $this->db->bind(':donorID', $_SESSION['user_id']);
        // $this->db->bind(':availabilityStatus', $data['availabilityStatus']);
        $this->db->bind(':benefactionID', $data['benefactionID']);

        // Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    //Delete benefaction
    public function deleteBenefaction($benefactionID){
        // Prepare statement
        $this->db->query('UPDATE benefaction SET availabilityStatus = 10 WHERE benefactionID = :benefactionID');
        $this->db->bind(':benefactionID', $benefactionID);

        // Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    //View Benefaction Request Deatils of a ceratin donee of a certain benefaction
    public function getBenefactionRequestDetails($benefactionID, $doneeID) {
        $this->db->query('SELECT u.userType AS userType,
                            CASE
                                WHEN u.userType = "student" THEN s.studentID
                                WHEN u.userType = "organization" THEN o.orgID
                            END AS doneeID,
                            CASE
                                WHEN u.userType = "student" THEN CONCAT(s.fname, " ", s.lname)
                                WHEN u.userType = "organization" THEN o.orgName
                            END AS doneeName,
                            db.reason,
                            db.requestedQuantity,
                            db.acceptanceStatus,
                            db.benefactionID,
                            b.donatedQuantity
                        FROM 
                            benefaction_request db
                        JOIN 
                            user u ON db.doneeID = u.userID
                        LEFT JOIN 
                            student s ON u.userType = "student" AND s.studentID = db.doneeID
                        LEFT JOIN 
                            organization o ON u.userType = "organization" AND o.orgID = db.doneeID
                        LEFT JOIN 
                            benefaction b ON db.benefactionID = b.benefactionID
                        WHERE 
                            u.status != 10
                            AND db.doneeID = :doneeID
                            AND db.benefactionID = :benefactionID;)');   

        $this->db->bind(':doneeID', $doneeID);
        $this->db->bind(':benefactionID', $benefactionID);

        $result = $this->db->resultSet();

        return $result;
    }

    public function declineBenefactionRequest($doneeID, $benefactionID) {
        $this->db->query('UPDATE donee_benefaction SET verificationStatus = 10 WHERE doneeID = :doneeID AND benefactionID = :benefactionID;');
        $this->db->bind(':doneeID', $doneeID);
        $this->db->bind(':benefactionID', $benefactionID);

        // Execute the query
        if ($this->db->execute()) {
            return true; // Update successful
        } else {
            return false; // Update failed
        }
    }




// -------------------Stundent----------------------

public function getBenefactionNotApplied($benefactionID) {
    // Prepare statement
    $this->db->query('SELECT * FROM benefaction b JOIN user u WHERE benefactionID = :benefactionID');
    $this->db->bind(':benefactionID', $benefactionID);

    
    // Execute
    $row = $this->db->single();

    // Fetch result set
    return $row;
}

    public function getBenefaction($benefactionID) {
        // Prepare statement
        $this->db->query('SELECT * 
        FROM benefaction b 
        JOIN benefaction_request br ON br.benefactionID = b.benefactionID 
        LEFT JOIN donee_benefaction db ON br.benefactionID = db.benefactionID 
        JOIN user u ON u.userID = :userID
        WHERE u.userID = :userID AND b.benefactionID = :benefactionID;
        ');
        $this->db->bind(':benefactionID', $benefactionID);
        $this->db->bind(':userID', $_SESSION['user_id']);
        
        // Execute
        $row = $this->db->single();

        // Fetch result set
        return $row;
    }

   

            //add application details to benefaction-request table
    public function addAppliedBenefaction($data){
        // Prepare statement
        $this->db->query('INSERT INTO benefaction_request (benefactionID, doneeID, reason, requestedQuantity, acceptanceStatus) VALUES (:benefactionID, :doneeID, :reason, :requestedQuantity,  :acceptanceStatus)');

        // Bind values
        $this->db->bind(':benefactionID', $data['benefactionID']);
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        $this->db->bind(':requestedQuantity', $data['requestedQuantity']);
        $this->db->bind(':reason', $data['reason']);
        $this->db->bind(':acceptanceStatus', 0);
    
        // Execute
        if ($this->db->execute()){
            return true;
        }
        else {
            return false;
        }
    }

    public function getAppliedBenefactions($criteria = null) { 
        
        $this->db->query('SELECT b.benefactionID, b.itemName, b.itemQuantity, br.requestedQuantity, br.acceptanceStatus, b.availabilityStatus, db.verificationStatus, db.receivedQuantity FROM benefaction b JOIN benefaction_request br ON br.benefactionID = b.benefactionID AND doneeID = :doneeID LEFT JOIN donee_benefaction db ON br.benefactionID = db.benefactionID ');
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        $result = $this->db->resultSet();
        // die(print_r($result));
        // Return an array of story data
        return array_reverse($result); 
      
        }


        public function getBenefactions($criteria = null) { 
        
            $this->db->query('SELECT b.benefactionID, b.description, b.itemName, b.itemCategory, b.itemPhoto1, b.itemPhoto2, b.itemPhoto3 , b.itemPhoto4, b.donorID, b.postedDate, b.availabilityStatus, u.username, br.requestedQuantity, br.acceptanceStatus, br.doneeID FROM benefaction b JOIN user u ON u.userID = b.donorID LEFT JOIN benefaction_request br ON br.benefactionID = b.benefactionID WHERE availabilityStatus = 0;');
            $result = $this->db->resultSet();
            // Return an array of applied benefaction data
            return array_reverse($result); 
          
        }

        public function sendBenefactionAknowledgement($data) {
            $this->db->query('UPDATE donee_benefaction SET verificationStatus = 2 WHERE doneeID = :doneeID AND benefactionID = :benefactionID;');
            $this->db->bind(':doneeID', $data['doneeID']);
            $this->db->bind(':benefactionID', $data['benefactionID']);
    
            // Execute the query
            if ($this->db->execute()) {
                return true; // Update successful
            } else {
                return false; // Update failed
            }
        }

        public function sendBenefactionComplain($data) {
            $this->db->query('UPDATE donee_benefaction SET verificationStatus = 3 WHERE doneeID = :doneeID AND benefactionID = :benefactionID;');
            $this->db->bind(':doneeID', $data['doneeID']);
            $this->db->bind(':benefactionID', $data['benefactionID']);
    
            // Execute the query
            if ($this->db->execute()) {
                return true; // Update successful
            } else {
                return false; // Update failed
            }
        }
    
    



}