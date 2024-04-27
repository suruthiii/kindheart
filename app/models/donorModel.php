<?php
class donorModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getTotalMonetaryDonations($userId) {
        $this->db->query('SELECT SUM(m.receivedAmount) AS total FROM money m 
                        JOIN recurringdonation rd ON m.monetaryNecessityID = rd.monetaryNecessityID 
                        WHERE rd.donorID = :userId
                        UNION
                        SELECT SUM(amount) AS total FROM onetimedonation 
                        WHERE donorID = :userId
                        UNION
                        SELECT SUM(amount) AS total FROM scholarship 
                        WHERE donorID = :userId
                        UNION
                        SELECT SUM(amount) AS total FROM fund 
                        WHERE donorID = :userId
    ');

        $this->db->bind(':userId', $userId);

        // Execute the query
        if ($this->db->execute()) {
            return true; // Update successful
        } else {
            return false; // Update failed
        }
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