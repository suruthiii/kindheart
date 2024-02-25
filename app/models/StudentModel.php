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
        // Check if a file was uploaded
     if (!empty($data['imagePath'])) {
        // Prepare statement with image path
        $this->db->query('INSERT INTO successstory (title, description, image_path) VALUES (:title, :storyDescription, :imagePath)');

        // Bind values
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':storyDescription', $data['storyDescription']);
        $this->db->bind(':imagePath', $data['imagePath']);
    } else {
        // Prepare statement without image path
        $this->db->query('INSERT INTO successstory (title, description) VALUES (:title, :storyDescription)');

        // Bind values
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':storyDescription', $data['storyDescription']);
    }


        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
       
    }


    
    



    

}