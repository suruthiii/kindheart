<?php
class BenefactionModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }


// viewbenefaction
public function getBenefactions($criteria = null) { 
        
    $this->db->query('SELECT b.benefactionID, b.description, b.itemName, b.itemPhoto1, b.itemPhoto2, b.itemPhoto3 , b.itemPhoto4, b.donorID, b.postedDate, availabilityStatus, u.username FROM benefaction b JOIN user u ON u.userID = b.donorID WHERE availabilityStatus = 1;');
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



}