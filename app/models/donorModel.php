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

    //View Benefaction Requests
    public function getBenefactionRequests($benefactionID) {
        
        // Prepare statement
        $this->db->query('  SELECT db.*, CONCAT(s.fname, " ", s.lname) AS studentName, o.orgName, u.userType
                            FROM donee_benefaction db 
                            LEFT JOIN student s ON db.doneeID = s.studentID 
                            LEFT JOIN organization o ON db.doneeID = o.orgID
                            LEFT JOIN user u ON db.doneeID = u.userID
                            WHERE db.benefactionID = :benefactionID');
        // $this->db->query('SELECT * FROM donee_benefaction WHERE benefactionID = :benefactionID');
        $this->db->bind(':benefactionID', $benefactionID);
        
        // Execute
        $results = $this->db->resultSet();

        // Check if results were retrieved
        if ($results) {
            return $results;
        } else {
            return []; // Return empty array if no results found
        }
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
}