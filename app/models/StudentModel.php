<?php
class StudentModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getUser(){
        $this->db->query('SELECT * FROM user');

        return $this->db->resultSet();
    }

    

    // add SuceessStory
    public function addSuceessStory($data){
        die(print_r($data));
        // Prepare statement
        $this->db->query('INSERT INTO successstory (title) VALUES (:title)');

        // Bind values
        $this->db->bind(':title', $data['title']);
       

        // if($data['user_type'] == 'admin'){
        //     $this->db->bind(':status', 1);
        // }
        // else{
        //     $this->db->bind(':status', 0);
        // }

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
       
    }

}