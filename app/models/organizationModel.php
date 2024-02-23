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
        // if(isset($_SESSION['doneeID'])){
            $this->db->query('INSERT INTO necessity(name,necessaryType,description,doneeID) 
            VALUES (:necessityMonetary, :necessityType, :monetarynecessitydes, :doneeID)');

            $this->db->bind(':necessityMonetary', $data['necessityMonetary']);
            $this->db->bind(':necessityType', $data['necessityType']);
            $this->db->bind(':monetarynecessitydes', $data['monetarynecessitydes']);
            $this->db->bind(':doneeID', $_SESSION['user_id']);
            

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        // }else{
        //     return false;
        // }
        
            
    }
}