<?php
class BenefactionModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

// -------------------Donor----------------------

    public function addBenefaction($data){
        // Prepare statement
        $this->db->query('INSERT INTO benefaction (itemName, itemCategory, itemQuantity, itemPhoto1, itemPhoto2, itemPhoto3, itemPhoto4, description, postedDate, donorID, availabilityStatus) VALUES (:itemName, :itemCategory, :itemQuantity, :itemPhoto1, :itemPhoto2, :itemPhoto3, :itemPhoto4, :description, :postedDate, :donorID, :availabilityStatus)');

        // Bind values
        $this->db->bind(':itemName', $data['itemBenefaction']);
        $this->db->bind(':itemCategory', $data['benefactionCategory']);
        $this->db->bind(':itemQuantity', $data['quantityBenfaction']);            
        $this->db->bind(':itemPhoto1', isset($data['photoBenfaction1']) ? $data['photoBenfaction1'] : null);
        $this->db->bind(':itemPhoto2', isset($data['photoBenfaction2']) ? $data['photoBenfaction2'] : null);
        $this->db->bind(':itemPhoto3', isset($data['photoBenfaction3']) ? $data['photoBenfaction3'] : null);
        $this->db->bind(':itemPhoto4', isset($data['photoBenfaction4']) ? $data['photoBenfaction4'] : null);
        $this->db->bind(':description', $data['benefactionDescription']);
        $this->db->bind(':postedDate', date('Y-m-d')); // Automatically set the posted date
        $this->db->bind(':donorID', $_SESSION['user_id']);
        $this->db->bind(':availabilityStatus', $data['availabilityStatus']);

        // Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }

        
    // Helper function to update availabilityStatus for a benefaction
    private function updateBenefactionAvailabilityStatus($benefactionID, $newAvailabilityStatus) {
        // Prepare statement to update availabilityStatus
        $this->db->query('UPDATE benefaction SET availabilityStatus = :availabilityStatus WHERE benefactionID = :benefactionID');
    
        // Bind values
        $this->db->bind(':availabilityStatus', $newAvailabilityStatus);
        $this->db->bind(':benefactionID', $benefactionID);
    
        // Execute the update query
        $this->db->execute();
    }

    // Get pending benefactions
    public function getPendingBenefaction() {
        // Prepare statement to select benefactions
        $this->db->query('SELECT b.benefactionID, b.itemName, b.itemCategory, b.itemQuantity, b.itemPhoto1, b.itemPhoto2, b.itemPhoto3, b.itemPhoto4, b.description, b.postedDate, b.donatedQuantity,
                                SUM(CASE WHEN br.acceptanceStatus IN (0, 1) THEN br.requestedQuantity ELSE 0 END) AS totalRequestedQuantity,
                                (b.itemQuantity - b.donatedQuantity) AS remainingQuantity,
                                db.verificationStatus
                                FROM benefaction b
                                LEFT JOIN benefaction_request br ON b.benefactionID = br.benefactionID
                                LEFT JOIN donee_benefaction db ON b.benefactionID = db.benefactionID
                                WHERE b.availabilityStatus = 0
                                GROUP BY b.benefactionID, b.itemName, b.itemCategory, b.itemQuantity, b.itemPhoto1, b.itemPhoto2, b.itemPhoto3, b.itemPhoto4, b.description, b.postedDate, b.donatedQuantity');
    
        // Fetch result set
        $results = $this->db->resultSet();
    
        // Update availabilityStatus for each benefaction
        foreach ($results as $benefaction) {
            // Check if remainingQuantity is zero
            if ($benefaction->remainingQuantity === 0) {
                // Determine the new availabilityStatus based on verificationStatus
                if($benefaction->verificationStatus === 2){
                    $newAvailabilityStatus = 2;
                }else{
                    $newAvailabilityStatus = 1;
                }
    
                // Update the availabilityStatus in the database
                $this->db->query('UPDATE benefaction SET availabilityStatus = :availabilityStatus WHERE benefactionID = :benefactionID');
    
                // Bind values
                $this->db->bind(':availabilityStatus', $newAvailabilityStatus);
                $this->db->bind(':benefactionID', $benefactionID);
            
            }
        }
        
    
        return $results;
    }


    public function getOnProgressBenefaction() {
        // Prepare statement to select benefactions in progress with the sum of acknowledged donated quantity and remaining quantity
        $this->db->query('SELECT b.benefactionID, b.itemName, b.itemCategory, b.itemQuantity, b.itemPhoto1, b.itemPhoto2, b.itemPhoto3, b.itemPhoto4, b.description, b.postedDate, b.donatedQuantity,
                                db.verificationStatus,
                                SUM(CASE WHEN db.verificationStatus IN (2) THEN db.receivedQuantity ELSE 0 END) AS acknowledgedDonatedQuantity,
                                (b.itemQuantity - b.donatedQuantity) AS remainingQuantity
                                FROM benefaction b
                                LEFT JOIN donee_benefaction db ON b.benefactionID = db.benefactionID
                                WHERE b.availabilityStatus = 1
                                GROUP BY b.benefactionID, b.itemName, b.itemCategory, b.itemQuantity, b.itemPhoto1, b.itemPhoto2, b.itemPhoto3, b.itemPhoto4, b.description, b.postedDate, b.donatedQuantity, db.verificationStatus');
    
        // Execute the query
        $this->db->execute();
    
        // Fetch result set
        $results = $this->db->resultSet();
    
        // Update availabilityStatus for each benefaction
        foreach ($results as $benefaction) {
            // Check if remainingQuantity is zero
            if ($benefaction->acknowledgedDonatedQuantity == $benefaction->itemQuantity) {
                // Determine the new availabilityStatus based on verificationStatus
                if($benefaction->verificationStatus === 0){
                    $newAvailabilityStatus = 1;
                }elseif($benefaction->verificationStatus === 1){
                    $newAvailabilityStatus = 1;
                }elseif($benefaction->verificationStatus === 2){
                    $newAvailabilityStatus = 2;
                }elseif($benefaction->verificationStatus === 3){
                    $newAvailabilityStatus = 1;
                }
    
                // Update the availabilityStatus in the database
                $this->updateBenefactionAvailabilityStatus($benefaction->benefactionID, $newAvailabilityStatus);
            }
        }
    
        return $results;
    }
    
    // Get completed benefactions
    public function getCompletedBenefaction() {
        // Prepare statement to select benefactions
        $this->db->query('SELECT b.benefactionID, b.itemName, b.itemCategory, b.itemQuantity, b.itemPhoto1, b.itemPhoto2, b.itemPhoto3, b.itemPhoto4, b.description, b.postedDate, b.donatedQuantity,
                                SUM(CASE WHEN br.acceptanceStatus IN (0, 1) THEN br.requestedQuantity ELSE 0 END) AS totalRequestedQuantity,
                                (b.itemQuantity - b.donatedQuantity) AS remainingQuantity,
                                db.verificationStatus
                                FROM benefaction b
                                LEFT JOIN benefaction_request br ON b.benefactionID = br.benefactionID
                                LEFT JOIN donee_benefaction db ON b.benefactionID = db.benefactionID
                                WHERE b.availabilityStatus = 2
                                GROUP BY b.benefactionID, b.itemName, b.itemCategory, b.itemQuantity, b.itemPhoto1, b.itemPhoto2, b.itemPhoto3, b.itemPhoto4, b.description, b.postedDate, b.donatedQuantity');
    
        // Execute the query
        $this->db->execute();
    
        // Fetch result set
        $results = $this->db->resultSet();
    
        // Update availabilityStatus for each benefaction
        foreach ($results as $benefaction) {
            // Check if remainingQuantity is zero
            if ($benefaction->remainingQuantity === 0) {
                // Determine the new availabilityStatus based on verificationStatus
                if($benefaction->verificationStatus === 2){
                    $newAvailabilityStatus = 2;
                }
    
                // Update the availabilityStatus in the database
                $this->updateBenefactionAvailabilityStatus($benefaction->benefactionID, $newAvailabilityStatus);
            }
        }
    
        return $results;
    }

    // View Benefaction
    public function getBenefactionForDonor($benefactionID) {
        // Prepare statement
        $this->db->query('SELECT * FROM benefaction WHERE benefactionID = :benefactionID');
        $this->db->bind(':benefactionID', $benefactionID);

        // Execute
        $row = $this->db->single();

        // Fetch result set
        return $row;
    }

    //View Benefaction Requests for a certain beenfaction
    public function getBenefactionRequests($benefactionID) {

        // Prepare statement
        $this->db->query('SELECT u.userType AS userType,
                            CASE
                                WHEN u.userType = "student" THEN s.studentID
                                WHEN u.userType = "organization" THEN o.orgID
                            END AS doneeID,
                            CASE
                                WHEN u.userType = "student" THEN CONCAT(s.fname, " ", s.lname)
                                WHEN u.userType = "organization" THEN o.orgName
                            END AS doneeName,
                            db.reason,
                            db.requestedQuantity,
                            db.acceptanceStatus,
                            db.benefactionID,
                            b.donatedQuantity
                        FROM 
                            benefaction_request db
                        JOIN 
                            user u ON db.doneeID = u.userID
                        LEFT JOIN 
                            student s ON u.userType = "student" AND s.studentID = db.doneeID
                        LEFT JOIN 
                            organization o ON u.userType = "organization" AND o.orgID = db.doneeID
                        LEFT JOIN 
                            benefaction b ON db.benefactionID = b.benefactionID
                        WHERE 
                            u.status != 10
                            AND db.benefactionID = :benefactionID
                    ');   

        $this->db->bind(':benefactionID', $benefactionID);

        $result = $this->db->resultSet();

        return $result;
    }

    //Edit Benefaction
    public function updateBenefaction($data){
        // Prepare statement
        $this->db->query('UPDATE benefaction SET itemName = :itemName, itemCategory = :itemCategory, description = :description, donorID = :donorID WHERE benefactionID = :benefactionID');

        // Bind values
        $this->db->bind(':itemName', $data['itemBenefaction']);
        $this->db->bind(':itemCategory', $data['benefactionCategory']);         
        $this->db->bind(':description', $data['benefactionDescription']);
        $this->db->bind(':donorID', $_SESSION['user_id']);
        // $this->db->bind(':availabilityStatus', $data['availabilityStatus']);
        $this->db->bind(':benefactionID', $data['benefactionID']);

        // Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    //Delete benefaction
    public function deleteBenefaction($benefactionID){
        // Prepare statement
        $this->db->query('UPDATE benefaction SET availabilityStatus = 10 WHERE benefactionID = :benefactionID');
        $this->db->bind(':benefactionID', $benefactionID);

        // Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    //View Benefaction Request Deatils of a ceratin donee of a certain benefaction
    public function getBenefactionRequestDetails($benefactionID, $doneeID) {
        $this->db->query('SELECT u.userType AS userType,
                            CASE
                                WHEN u.userType = "student" THEN s.studentID
                                WHEN u.userType = "organization" THEN o.orgID
                            END AS doneeID,
                            CASE
                                WHEN u.userType = "student" THEN CONCAT(s.fname, " ", s.lname)
                                WHEN u.userType = "organization" THEN o.orgName
                            END AS doneeName,
                            br.reason,
                            br.requestedQuantity,
                            br.acceptanceStatus,
                            br.benefactionID,
                            b.itemQuantity,
                            b.donatedQuantity,
                            db.receivedQuantity,
                            db.acknowledgement,
                            db.verificationStatus

                        FROM 
                            benefaction_request br
                        JOIN 
                            user u ON br.doneeID = u.userID
                        LEFT JOIN 
                            student s ON u.userType = "student" AND s.studentID = br.doneeID
                        LEFT JOIN 
                            organization o ON u.userType = "organization" AND o.orgID = br.doneeID
                        LEFT JOIN 
                            benefaction b ON br.benefactionID = b.benefactionID
                        LEFT JOIN 
                            donee_benefaction db ON br.benefactionID = db.benefactionID
                        WHERE 
                            u.status != 10
                            AND br.doneeID = :doneeID
                            AND br.benefactionID = :benefactionID
                    ');   

        $this->db->bind(':doneeID', $doneeID);
        $this->db->bind(':benefactionID', $benefactionID);

        $result = $this->db->resultSet();

        return $result;
    }

    public function acceptBenefactionRequest($doneeID, $benefactionID) {
        $this->db->query('UPDATE benefaction_request SET acceptanceStatus = 1 WHERE doneeID = :doneeID AND benefactionID = :benefactionID;');
        $this->db->bind(':doneeID', $doneeID);
        $this->db->bind(':benefactionID', $benefactionID);

        // Execute the query
        if ($this->db->execute()) {
            return true; // Update successful
        } else {
            return false; // Update failed
        }
    }

    public function declineBenefactionRequest($doneeID, $benefactionID) {
        $this->db->query('UPDATE benefaction_request SET acceptanceStatus = 10 WHERE doneeID = :doneeID AND benefactionID = :benefactionID;');
        $this->db->bind(':doneeID', $doneeID);
        $this->db->bind(':benefactionID', $benefactionID);

        // Execute the query
        if ($this->db->execute()) {
            return true; // Update successful
        } else {
            return false; // Update failed
        }
    }

    public function getUserProfile($doneeID, $benefactionID) {
        $this->db->query('SELECT u.userType AS userType,
                            CASE
                                WHEN u.userType = "student" THEN s.studentID
                                WHEN u.userType = "organization" THEN o.orgID
                            END AS doneeID,
                            CASE
                                WHEN u.userType = "student" THEN CONCAT(s.fname, " ", s.lname)
                                WHEN u.userType = "organization" THEN o.orgName
                            END AS doneeName,
                            CASE
                                WHEN u.userType = "student" THEN s.studentType
                                WHEN u.userType = "organization" THEN o.orgType
                            END AS doneeType,
                            s.gender,
                            s.dateOfBirth,
                            s.institutionName,
                            s.studyingYear,
                            d.address AS doneeAddress,
                            d.phoneNumber AS doneePhoneNumber
                        FROM 
                            benefaction_request br
                        JOIN 
                            user u ON br.doneeID = u.userID
                        LEFT JOIN 
                            student s ON u.userType = "student" AND s.studentID = br.doneeID
                        LEFT JOIN 
                            organization o ON u.userType = "organization" AND o.orgID = br.doneeID
                        LEFT JOIN 
                            donee d ON d.doneeID = br.doneeID
                        WHERE 
                            u.status != 10
                            AND br.doneeID = :doneeID
                            AND br.benefactionID = :benefactionID
                    ');   

        $this->db->bind(':doneeID', $doneeID);
        $this->db->bind(':benefactionID', $benefactionID);

        $result = $this->db->resultSet();

        return $result;
    }

    public function benefactionRequestDonationSubmit($data) {
        // Prepare statement to insert into donee_benefaction
        $this->db->query('INSERT INTO donee_benefaction (benefactionID, doneeID, receivedQuantity, deliveryReceipt, verificationStatus) VALUES (:benefactionID, :doneeID, :receivedQuantity, :deliveryReceipt, :verificationStatus)');
    
        // Bind parameters for the INSERT query
        $this->db->bind(':benefactionID', $data['benefactionID']);
        $this->db->bind(':doneeID', $data['doneeID']);
        $this->db->bind(':receivedQuantity', $data['donationQuantity']);
        $this->db->bind(':deliveryReceipt', $data['deliveryReceipt']); // Handle the case where deliveryReceipt is not set
        $this->db->bind(':verificationStatus', 0); // Assuming verificationStatus is always 0 for new entries
    
        // Execute the INSERT query
        if ($this->db->execute()) {
            // Update donatedQuantity in benefaction table
            $this->db->query('UPDATE benefaction SET donatedQuantity = donatedQuantity + :donationQuantity WHERE benefactionID = :benefactionID');
    
            // Bind parameters for the UPDATE query
            $this->db->bind(':donationQuantity', $data['donationQuantity']);
            $this->db->bind(':benefactionID', $data['benefactionID']);
    
            // Execute the UPDATE query
            if ($this->db->execute()) {
                // Update acceptance state in benefaction-request table
                $this->db->query('UPDATE benefaction_request SET acceptanceStatus = 2 WHERE benefactionID = :benefactionID AND doneeID = :doneeID');
    
                // Bind parameters for the UPDATE query
                $this->db->bind(':benefactionID', $data['benefactionID']);
                $this->db->bind(':doneeID', $data['doneeID']);
    
                // Execute the UPDATE query
                if ($this->db->execute()) {
                    return true; // Insertion, donation quantity update, and acceptance state update successful
                } else {
                    return false; // Acceptance state update failed
                }
            } else {
                return false; // Donation quantity update failed
            }
        } else {
            return false; // Insertion failed
        }
    }
    
    
// -------------------Stundent----------------------

public function getBenefactionNotApplied($benefactionID) {
    // Prepare statement
    $this->db->query('SELECT * FROM benefaction b JOIN user u WHERE benefactionID = :benefactionID');
    $this->db->bind(':benefactionID', $benefactionID);

    
    // Execute
    $row = $this->db->single();

    // Fetch result set
    return $row;
}

    public function getBenefaction($benefactionID) {
        // Prepare statement
        $this->db->query('SELECT * 
        FROM benefaction b 
        JOIN benefaction_request br ON br.benefactionID = b.benefactionID 
        LEFT JOIN donee_benefaction db ON br.benefactionID = db.benefactionID 
        JOIN user u ON u.userID = :userID
        WHERE u.userID = :userID AND b.benefactionID = :benefactionID;
        ');
        $this->db->bind(':benefactionID', $benefactionID);
        $this->db->bind(':userID', $_SESSION['user_id']);
        
        // Execute
        $row = $this->db->single();

        // Fetch result set
        return $row;
    }

   

            //add application details to benefaction-request table
    public function addAppliedBenefaction($data){
        // Prepare statement
        $this->db->query('INSERT INTO benefaction_request (benefactionID, doneeID, reason, requestedQuantity, acceptanceStatus) VALUES (:benefactionID, :doneeID, :reason, :requestedQuantity,  :acceptanceStatus)');

        // Bind values
        $this->db->bind(':benefactionID', $data['benefactionID']);
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        $this->db->bind(':requestedQuantity', $data['requestedQuantity']);
        $this->db->bind(':reason', $data['reason']);
        $this->db->bind(':acceptanceStatus', 0);
    
        // Execute
        if ($this->db->execute()){
            return true;
        }
        else {
            return false;
        }
    }

    public function getAppliedBenefactions($criteria = null) { 
        
        $this->db->query('SELECT b.benefactionID, b.itemName, b.itemQuantity, br.requestedQuantity, br.acceptanceStatus, b.availabilityStatus, db.verificationStatus, db.receivedQuantity FROM benefaction b JOIN benefaction_request br ON br.benefactionID = b.benefactionID AND doneeID = :doneeID LEFT JOIN donee_benefaction db ON br.benefactionID = db.benefactionID ');
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        $result = $this->db->resultSet();
        // die(print_r($result));
        // Return an array of story data
        return array_reverse($result); 
      
        }


        public function getBenefactions($criteria = null) { 
        
            $this->db->query('SELECT b.benefactionID, b.description, b.itemName, b.itemCategory, b.itemPhoto1, b.itemPhoto2, b.itemPhoto3 , b.itemPhoto4, b.donorID, b.postedDate, b.availabilityStatus, u.username, br.requestedQuantity, br.acceptanceStatus, br.doneeID FROM benefaction b JOIN user u ON u.userID = b.donorID LEFT JOIN benefaction_request br ON br.benefactionID = b.benefactionID WHERE availabilityStatus = 0;');
            $result = $this->db->resultSet();
            // Return an array of applied benefaction data
            return array_reverse($result); 
          
        }

        public function sendBenefactionAknowledgement($data) {
            $this->db->query('UPDATE donee_benefaction SET verificationStatus = 2 WHERE doneeID = :doneeID AND benefactionID = :benefactionID;');
            $this->db->bind(':doneeID', $data['doneeID']);
            $this->db->bind(':benefactionID', $data['benefactionID']);
    
            // Execute the query
            if ($this->db->execute()) {
                return true; // Update successful
            } else {
                return false; // Update failed
            }
        }

        public function sendBenefactionComplain($data) {
            $this->db->query('UPDATE donee_benefaction SET verificationStatus = 3 WHERE doneeID = :doneeID AND benefactionID = :benefactionID;');
            $this->db->bind(':doneeID', $data['doneeID']);
            $this->db->bind(':benefactionID', $data['benefactionID']);
    
            // Execute the query
            if ($this->db->execute()) {
                return true; // Update successful
            } else {
                return false; // Update failed
            }
        }
    
    /* --------------------- Admin and Super Admin ----------------------------- */

    public function getAllPendingBenefactions() {
        $this->db->query('SELECT benefactionID, itemName, description, itemCategory, (itemQuantity - donatedQuantity) AS quantity FROM benefaction WHERE availabilityStatus = 0;');
        
        $result = $this->db->resultSet();

        return $result;
    }

    public function getAllOnProgressBenefactions() {
        $this->db->query('SELECT benefactionID, itemName, description, itemCategory, itemQuantity AS quantity FROM benefaction WHERE availabilityStatus = 1;');
        
        $result = $this->db->resultSet();

        return $result;
    }

    public function getBenefactionDetails($benefaction_ID) {
        $this->db->query('SELECT * FROM benefaction WHERE benefactionID = :benefactionID');
        $this->db->bind(':benefactionID', $benefaction_ID);

        $benefactionDetails = $this->db->single();

        $benefactionDetails->donorName = $this->getName($benefactionDetails->donorID)->name;

        return $benefactionDetails;
    }

    public function getDonationCardDetails($benefaction_ID) {
        $this->db->query('SELECT * FROM donee_benefaction WHERE benefactionID = :benefactionID');
        $this->db->bind(':benefactionID', $benefaction_ID);

        $donations = $this->db->resultSet();

        foreach($donations as $item) {
            $item->doneeName = $this->getName($item->doneeID)->name;
        }
        
        return $donations;
    }

    public function getUserType($user_ID){
        $this->db->query('SELECT userType FROM user WHERE userID = :userID;');
        $this->db->bind(':userID', $user_ID);

        $userType = $this->db->single()->userType;
    
        if ($userType == 'donor') {
            $this->db->query('SELECT donorType FROM donor WHERE donorID = :donorID;');
            $this->db->bind(':donorID', $user_ID);

            $userType =  $this->db->single()->donorType;
        }

        return $userType;
    }

    public function getName($user_ID){
        $userType = $this->getUserType($user_ID);

        if ($userType == 'company'){
            $this->db->query('SELECT companyName AS name FROM company WHERE companyID = :companyID;');
            $this->db->bind(':companyID', $user_ID);
        }

        else if ($userType == 'individual'){
            $this->db->query('SELECT CONCAT(fName, " ", lName) AS name FROM individual WHERE individualID = :individualID;');
            $this->db->bind(':individualID', $user_ID);
        }

        else if ($userType == 'organization'){
            $this->db->query('SELECT orgName AS name FROM organization WHERE orgID = :orgID;');
            $this->db->bind(':orgID', $user_ID);
        }

        else if ($userType == 'student'){
            $this->db->query('SELECT CONCAT(fName, " ", lName) AS name FROM student WHERE studentID = :studentID;');
            $this->db->bind(':studentID', $user_ID); 
        }

        $name = $this->db->single();

        return $name;
    }

    public function getComBenefactionDetails($benefaction_ID) {
        $this->db->query('SELECT b.benefactionID, b.description, b.itemName, b.itemCategory, b.itemQuantity, b.donatedQuantity, b.itemPhoto1, b.itemPhoto2, b.itemPhoto3, b.itemPhoto4, c.companyID AS donorID, c.companyName AS name FROM benefaction b JOIN company c ON b.donorID = c.companyID WHERE b.benefactionID = :benefactionID;');
        $this->db->bind(':benefactionID', $benefaction_ID);

        $row = $this->db->single();

        return $row;
    }

    public function getIndBenefactionDetails($benefaction_ID) {
        $this->db->query('SELECT b.benefactionID, b.description, b.itemName, b.itemCategory, b.itemQuantity, b.donatedQuantity, b.itemPhoto1, b.itemPhoto2, b.itemPhoto3, b.itemPhoto4, i.individualID AS donorID, CONCAT(i.fName, " ", i.lName) AS name FROM benefaction b JOIN individual i ON b.donorID = i.individualID WHERE b.benefactionID = :benefactionID;');
        $this->db->bind(':benefactionID', $benefaction_ID);

        $row = $this->db->single();

        return $row;
    }

    public function getDonorType($benefaction_ID) {
        $this->db->query('SELECT donorType FROM donor d JOIN benefaction b ON d.donorID = b.donorID WHERE b.benefactionID = :benefactionID;');
        $this->db->bind(':benefactionID', $benefaction_ID);

        $row = $this->db->single();

        return $row->donorType;
    }

    public function getAllComments($benefaction_ID) {
        $this->db->query("SELECT c.postID, c.comment, a.adminName FROM comment c JOIN admin a ON c.adminID = a.adminID WHERE c.postID = :postID AND c.postType = 'benefaction' ORDER BY time DESC;");
        $this->db->bind(':postID', $benefaction_ID);

        $result = $this->db->resultSet();

        return $result;
    }

    public function addComment($data) {
        $this->db->query("INSERT INTO comment (postID, adminID, time, postType, comment) VALUES (:postID, :adminID, :time, 'benefaction', :comment);");
        $this->db->bind(':postID', $data['benefaction_ID']);
        $this->db->bind(':adminID', $_SESSION['user_id']);
        $this->db->bind(':time', date("Y-m-d H:i:s"));
        $this->db->bind(':comment', $data['comment']);

        if($this->db->execute()) {
            return true;
        }

        else {
            return false;
        }
    }

    public function getDonorID($benefaction_ID) {
        $this->db->query('SELECT donorID FROM benefaction WHERE benefactionID = :benefactionID;');
        $this->db->bind(':benefactionID', $benefaction_ID);

        $donorID = $this->db->single()->donorID;

        return $donorID;
    }


}