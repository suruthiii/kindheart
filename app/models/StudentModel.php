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
       
     if (!empty($data['imagePath'])) {
        // Prepare statement with image path
        $this->db->query('INSERT INTO successstory (doneeID, title, description, image) VALUES (:doneeID, :title, :storyDescription, :imagePath)');

        // Bind values
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':storyDescription', $data['storyDescription']);
        $this->db->bind(':imagePath', $data['imagePath']);
    } else {
        // Prepare statement without image path
        $this->db->query('INSERT INTO successstory (doneeID, title, description) VALUES (:doneeID, :title, :storyDescription)');

        // Bind values
        $this->db->bind(':doneeID', $_SESSION['user_id']);
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

    public function getSuccessStories($criteria = null) { 
        
        
        $this->db->query('SELECT s.title, s.image, s.description, u.username , NOW() AS addDate FROM successstory s JOIN user u ON u.userID = s.doneeID;');
        $result = $this->db->resultSet();
        
        return  array_reverse($result); // Return an array of story data
    }


    
    



    

}