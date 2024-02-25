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
    public function addSuccessStory($data){
        // Prepare statement
        $this->db->query('INSERT INTO successstory (title,description) VALUES (:title, :storyDescription)');

        // Bind values
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':storyDescription', $data['storyDescription']);
       

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
       
    }

}