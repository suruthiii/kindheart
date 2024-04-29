<?php
class donorModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getTotalActiveDonors() {
        // Prepare statement
        $this->db->query('SELECT COUNT(*) AS total_active_donors FROM user WHERE status = 1 AND userType = :userType');
    
        // Bind parameter
        $this->db->bind(':userType', 'donor');
    
        // Fetch the result
        $result = $this->db->single();
    
        if ($result) {
            // Return the total count of active donors
            return $result->total_active_donors;
        } else {
            // Return 0 or handle the error based on your application's requirements
            return 0;
        }
    }

    public function getTotalActiveDonees() {
        // Prepare statement
        $this->db->query('SELECT COUNT(*) AS total_active_donees FROM user WHERE status = 1 AND userType = :userType');
    
        // Bind parameter
        $this->db->bind(':userType', 'organization');
        $this->db->bind(':userType', 'student');
    
        // Fetch the result
        $result = $this->db->single();
    
        if ($result) {
            // Return the total count of active donors
            return $result->total_active_donees;
        } else {
            // Return 0 or handle the error based on your application's requirements
            return 0;
        }
    }

    public function getTotalDonationCount($user_id) {
        // Prepare statement
        $this->db->query('SELECT COUNT(*) AS total_donations FROM benefaction WHERE availabilityStatus = 2 AND user_id = :user_id
                            UNION 
                            SELECT COUNT(*) AS total_donations FROM gooddonation WHERE verificationStatus = 2 AND donorID = :donorID
                            UNION 
                            SELECT COUNT(*) AS total_donations FROM onetimedonation WHERE verificationStatus = 1 AND donorID = :donorID
                            UNION 
                            SELECT COUNT(*) AS total_donations FROM onetimedonation WHERE verificationStatus = 1 AND donorID = :donorID
                            ');
    
        // Bind parameter
        $this->db->bind(':userType', 'organization');
        $this->db->bind(':userType', 'student');
    
        // Fetch the result
        $result = $this->db->single();
    
        if ($result) {
            // Return the total count of active donors
            return $result->total_active_donees;
        } else {
            // Return 0 or handle the error based on your application's requirements
            return 0;
        }
    }
    

    // public function getTotalMonetaryDonations($userId) {
    //     $this->db->query('SELECT SUM(m.receivedAmount) AS total FROM money m 
    //                     JOIN recurringdonation rd ON m.monetaryNecessityID = rd.monetaryNecessityID 
    //                     WHERE rd.donorID = :userId
    //                     UNION
    //                     SELECT SUM(amount) AS total FROM onetimedonation 
    //                     WHERE donorID = :userId
    //                     UNION
    //                     SELECT SUM(amount) AS total FROM scholarship 
    //                     WHERE donorID = :userId
    //                     UNION
    //                     SELECT SUM(amount) AS total FROM fund 
    //                     WHERE donorID = :userId
    // ');

    //     $this->db->bind(':userId', $userId);

    //     // Execute the query
    //     if ($this->db->execute()) {
    //         return true; // Update successful
    //     } else {
    //         return false; // Update failed
    //     }
    // }


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