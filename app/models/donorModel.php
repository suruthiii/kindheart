<?php
class donorModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function addBenefaction($data){
        // Prepare statement
        $this->db->query('INSERT INTO benefaction (itemName, itemQuantity, itemPhoto, description, postedDate, donorID, availabilityStatus) VALUES (:itemName, :itemQuantity, :itemPhoto, :description, :postedDate, :donorID, :availabilityStatus)');

        // Bind values
        $this->db->bind(':itemName', $data['itemBenefaction']);
        $this->db->bind(':itemQuantity', $data['quantityBenfaction']);
        $this->db->bind(':itemPhoto', $data['photoBenfaction']);
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
        $this->db->query('SELECT * FROM benefaction WHERE availabilityStatus = 1');
        
        // Execute
        $this->db->execute();

        // Fetch result set
        return $this->db->resultSet();
    }

    // Get completed benefactions
    public function getCompletedBenefaction() {
        // Prepare statement
        $this->db->query('SELECT * FROM benefaction WHERE availabilityStatus = 0');
        
        // Execute
        $this->db->execute();

        // Fetch result set
        return $this->db->resultSet();
    }


    public function getUser(){
        $this->db->query('SELECT * FROM user');

        return $this->db->resultSet();
    }
    
}

