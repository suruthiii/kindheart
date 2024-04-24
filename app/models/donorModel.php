<?php
class donorModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }


    // public function getGraphData($donorID) {
    //     $this->db->query('SELECT COUNT(*) AS rowCountBenefaction FROM benefaction
    //                         UNION 
    //                         SELECT COUNT(*) AS rowCountScholarship FROM scholarship
    //                         UNION
    //                         SELECT COUNT(*) AS rowCountMonetary  FROM scholarship
    //                         WHERE donorID = 5');
    //     $this->db->bind(':donorID', $donorID);
    
    //     // Execute the query
    //     if ($this->db->execute()) {
    //         return true; // Update successful
    //     } else {
    //         return false; // Update failed
    //     }
    // }
    
}