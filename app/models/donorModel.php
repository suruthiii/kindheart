<?php
class donorModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function addBenefaction($data){
        // Prepare statement
        $this->db->query('INSERT INTO benefaction (itemName, itemQuantity, description, postedDate, donorID, availabilityStatus) VALUES (:itemName, :itemQuantity, :description, :postedDate, :donorID, :availabilityStatus)');

        // Bind values
        $this->db->bind(':itemName', $data['itemBenefaction']);
        $this->db->bind(':itemQuantity', $data['quantityBenfaction']);
        $this->db->bind(':description', $data['benefactionDescription']);
        $this->db->bind(':postedDate', date('Y-m-d')); // Automatically set the posted date
        $this->db->bind(':donorID', $_SESSION['user_id']);
        $this->db->bind(':availabilityStatus', $data['availabilityStatus']);

        // if($data['availability'] == 'pending'){
        //     $this->db->bind(':availabilityStatus', 1);
        // }
        // else{
        //     $this->db->bind(':availabilityStatus', 0);
        // }
        
        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Get pending benefactions
    public function getPendingBenefaction() {
        // Prepare statement
        $this->db->query('SELECT * FROM benefaction');
    
        // // Bind the availabilityStatus parameter
        // $this->db->bind(':availabilityStatus', 1);
        
        // Return result set
        return $this->db->resultSet();
    }


    public function getUser(){
        $this->db->query('SELECT * FROM user');

        return $this->db->resultSet();
    }
    
}

