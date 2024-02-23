<?php


class organizationModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getUser(){
        $this->db->query('SELECT * FROM user');

        return $this->db->resultSet();
    }

    public function addmonetarynecessitytodb($data){
        //sql statement for adding monetary necessity
        $this->db->query('INSERT INTO necessity(name,necessaryType,description,doneeID) 
        VALUES (:necessityMonetary, :necessityType, :monetarynecessitydes, :doneeID)');

        // Binding values with array value
        $this->db->bind(':necessityMonetary', $data['necessityMonetary']);
        $this->db->bind(':necessityType', $data['necessityType']);
        $this->db->bind(':monetarynecessitydes', $data['monetarynecessitydes']);
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        

        // Execute 
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
            
    }
}