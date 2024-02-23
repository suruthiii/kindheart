<?php
class donorModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function addBenefaction($data){
        // Prepare statement
        $this->db->query('INSERT INTO benefaction (itemName, itemQuantity, description, postedDate, donorID) VALUES (:itemName, :itemQuantity, :description, :postedDate, :donorID)');

        // Bind values
        $this->db->bind(':itemName', $data['itemBenefaction']);
        $this->db->bind(':itemQuantity', $data['quantityBenfaction']);
        $this->db->bind(':description', $data['benefactionDescription']);
        $this->db->bind(':postedDate', date('Y-m-d')); // Automatically set the posted date
        $this->db->bind(':donorID', $_SESSION['user_id']);

        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getUser(){
        $this->db->query('SELECT * FROM user');

        return $this->db->resultSet();
    }
}