<?php
class BenefactionModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }


// viewbenefaction
public function getBenefactions($criteria = null) { 
        
    $this->db->query('SELECT b.benefactionID, b.description, b.itemName, b.itemPhoto1, b.itemPhoto2, b.itemPhoto3 , b.itemPhoto4, b.donorID, b.postedDate, availabilityStatus, u.username FROM benefaction b JOIN user u ON u.userID = b.donorID WHERE availabilityStatus = 0;');
    $result = $this->db->resultSet();
    // die(print_r($result));
    // Return an array of story data
    return array_reverse($result); 
  
    }

    public function getBenefaction($benefactionID) {
        // Prepare statement
        $this->db->query('SELECT * FROM benefaction b JOIN user u ON u.userID = b.donorID WHERE benefactionID = :benefactionID');
        $this->db->bind(':benefactionID', $benefactionID);
        
        // Execute
        $row = $this->db->single();

        // Fetch result set
        return $row;
    }




    public function addAppliedBenefaction($data){
        // Prepare statement
        $this->db->query('INSERT INTO donee_benefaction (benefactionID, doneeID, reason, requestedQuantity, status) VALUES (:benefactionID, :doneeID, :reason, :requestedQuantity, :status)');

        // Bind values
        $this->db->bind(':benefactionID', $data['benefactionID']);
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        $this->db->bind(':requestedQuantity', $data['requestedQuantity']);
        $this->db->bind(':reason', $data['reason']);
        $this->db->bind(':status', 1);
    
        // Execute
        if ($this->db->execute()){
            return true;
        }
        else {
            return false;
        }
    }

    public function getAppliedBenefactions($criteria = null) { 
        
        $this->db->query('SELECT b.benefactionID, b.itemName, d.requestedQuantity FROM benefaction b JOIN donee_benefaction d ON b.benefactionID = d.benefactionID WHERE doneeID = :doneeID');
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        $result = $this->db->resultSet();
        // die(print_r($result));
        // Return an array of story data
        return array_reverse($result); 
      
        }
    



}