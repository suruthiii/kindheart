<?php
class donorModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

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
            // $this->db->bind(':availability', $data['availability']);

            // // if the benefaction is pending it's availabitySTatus is 1
            // if($data['availability'] == 'pending'){
            //     $this->db->query('UPDATE benefaction SET availabilityStatus = 1 WHERE benefactionID = :benefactionID');
            //     $this->db->bind(':benefactionID', $data['benefactionID']);
            //     if($this->db->execute()){
            //         return true;
            //     }else{
            //         return false;
            //     }
            // }else{
            //     $this->db->query('UPDATE benefaction SET availabilityStatus = 0 WHERE benefactionID = :benefactionID');
            //     $this->db->bind(':benefactionID', $data['benefactionID']);
            //     if($this->db->execute()){
            //         return true;
            //     }else{
            //         return false;
            //     }
            // }
        
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
        $this->db->query('SELECT * FROM benefaction WHERE availabilityStatus = 0');
        
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
    public function getBenefaction($benefactionID) {
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
        // $this->db->query('SELECT o.orgID AS doneeID, o.orgName AS doneeName FROM organization o JOIN donee_benefaction db ON o.orgID = db.doneeID JOIN user u ON db.doneeID = u.userID WHERE u.status != 10 AND db.benefactionID = :benefactionID
        //                     UNION
        //                     SELECT s.studentID, CONCAT(s.fname, " ", s.lname) FROM student s JOIN donee_benefaction db ON s.studentID = db.doneeID JOIN user u ON db.doneeID = u.userID WHERE u.status != 10 AND db.benefactionID = :benefactionID;');
        

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
                            db.benefactionID
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
                            AND db.benefactionID = :benefactionID;)');   

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
                            db.requestedQuantity
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
                            AND db.doneeID = :doneeID
                            AND db.benefactionID = :benefactionID;)');   

        $this->db->bind(':doneeID', $doneeID);
        $this->db->bind(':benefactionID', $benefactionID);

        $result = $this->db->resultSet();

        return $result;
    }

    public function updateBenefactionRequestStatus($doneeID, $benefactionID, $newStatus) {
        $this->db->query('UPDATE donee_benefaction SET verificationStatus = :newStatus WHERE doneeID = :doneeID AND benefactionID = :benefactionID;');
        $this->db->bind(':doneeID', $doneeID);
        $this->db->bind(':benefactionID', $benefactionID);
        $this->db->bind(':newStatus', $newStatus);
    
        // Execute the query
        if ($this->db->execute()) {
            return true; // Update successful
        } else {
            return false; // Update failed
        }
    }
    
}