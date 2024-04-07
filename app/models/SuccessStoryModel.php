<?php
class SuccessStoryModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

   // view success story 
   public function getSuccessStories($criteria = null) { 
        
    $this->db->query('SELECT s.title, s.image, s.description, u.username , NOW() AS addDate FROM successstory s JOIN user u ON u.userID = s.doneeID;');
    $result = $this->db->resultSet();
    
    // Return an array of story data
    return array_reverse($result); 
    }

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

    public function getUserSuccessStories($criteria = null) { 
        $this->db->query('SELECT title,storyID FROM successstory WHERE doneeID = :doneeID');
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        $result = $this->db->resultSet();
        
        // Return an array of story data
        return  array_reverse($result); 
    }

    public function getStoryEditData($storyID) { 
        
        
        $this->db->query('SELECT s.title, s.image, s.storyID, s.description, u.username , NOW() AS addDate FROM successstory s JOIN user u ON u.userID = s.doneeID WHERE storyID = :storyID;');
        $this->db->bind(':storyID', $storyID);
        $row = $this->db->single();
        
        // Return an array of story data
        return $row; 
    }

    public function editSuccessStory($data){
       
        if (!empty($data['imagePath'])) {
           // Prepare statement with image path
           $this->db->query('UPDATE successstory SET title = :title, description = :storyDescription, image = :imagePath WHERE storyID = :storyID;');
   
           // Bind values
           $this->db->bind(':title', $data['title']);
           $this->db->bind(':storyDescription', $data['storyDescription']);
           $this->db->bind(':imagePath', $data['imagePath']);
           $this->db->bind(':storyID', $data['storyID']);

       } else {
           // Prepare statement without image path
           $this->db->query('UPDATE successstory SET title = :title, description = :storyDescription WHERE storyID = :storyID;');
   
           // Bind values
           $this->db->bind(':title', $data['title']);
           $this->db->bind(':storyDescription', $data['storyDescription']);
           $this->db->bind(':storyID', $data['storyID']);
       }
   
           // Execute
           if ($this->db->execute()) {
               return true;
           } else {
               return false;
           }
    }

    // Delete success story
    public function deleteStory($data) { 
        $this->db->query('DELETE FROM successstory WHERE storyID = :storyID');
        
        $this->db->bind(':storyID', $data['storyID']);

        if($this->db->execute()) {
            return true;
        }
        else {
            return false;
        }

    }

}