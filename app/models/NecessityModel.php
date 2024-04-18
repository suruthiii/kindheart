<?php
class NecessityModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    
    public function addmonetarynecessitytodb($data){
        //sql statement for adding monetary necessity, necessity table
        $this->db->query('INSERT INTO necessity(necessityName,necessityType,fulfillmentStatus,description,doneeID) 
        VALUES (:necessityMonetary, :necessityType, :fulfillmentStatus, :monetarynecessitydes, :doneeID)');

        // Binding values with array value
        $this->db->bind(':necessityMonetary', $data['necessityMonetary']);
        $this->db->bind(':necessityType', 'Monetary Funding');
        $this->db->bind(':fulfillmentStatus','Pending');
        $this->db->bind(':monetarynecessitydes', $data['monetarynecessitydes']);
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        
        $result = $this->db->execute();

        if($result){
            //get the last Inserted Id from the database
            $result1 = $this->db->query('SELECT LAST_INSERT_ID() as last_id;');
            $row = $this->db->single();
            $monetaryNecessityID = $row->last_id;

            //store monetaryId in the session
            $_SESSION['monetaryNecessityID'] = $monetaryNecessityID;

            //sql statement for adding monetary necessity, money table
            $this->db->query('INSERT INTO money(monetaryNecessityID ,requestedAmount,monetaryNecessityType,startDate,endDate,frequency) 
            VALUES (:monetaryNecessityID, :requestedamount, :necessityType, :recurringstartdate, :recurringenddate, :frequency)');

            // Binding values with array value
            $this->db->bind(':monetaryNecessityID', $_SESSION['monetaryNecessityID']);
            $this->db->bind(':requestedamount', $data['requestedamount']);
            $this->db->bind(':necessityType', $data['necessityType']);
            $this->db->bind(':recurringstartdate', $data['recurringstartdate']);
            $this->db->bind(':recurringenddate', $data['recurringenddate']);
            $this->db->bind(':frequency', $data['frequency']);

            $result2 = $this->db->execute();



            if ($result2) {
                return true;
            } else {
                // Print error message for debugging
                printf("Error: %s\n", $this->db->getError());
                return false;
            }
        }else{
            return false;
        }
     
    }
    
    public function getaddedMonetaryNecessities(){
        $this->db->query("SELECT necessity.necessityID, necessity.necessityName,necessity.description,money.requestedAmount,money.monetaryNecessityType FROM necessity JOIN money ON necessity.necessityID = money.monetaryNecessityID 
        WHERE necessityType = 'Monetary Funding' AND fulfillmentStatus = 0 AND doneeID = :doneeID;");
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        
        $result = $this->db->resultSet();
        return $result;
    }

    public function getaddedCompletedMonetaryNecessities(){
        $this->db->query("SELECT necessity.necessityID,necessity.necessityName,necessity.description,money.requestedAmount,money.monetaryNecessityType FROM necessity JOIN money ON necessity.necessityID = money.monetaryNecessityID 
        WHERE necessityType = 'Monetary Funding' AND fulfillmentStatus = 2 AND doneeID = :doneeID;");
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        
        $result = $this->db->resultSet();
        return $result;
    }

    public function getAllPendingMonetaryNecessities(){
        $this->db->query("SELECT n.necessityID, n.necessityName, n.description, (m.requestedAmount - m.receivedAmount) AS amount FROM necessity n JOIN money m ON n.necessityID = m.monetaryNecessityID 
        WHERE necessityType = 'Monetary Funding' AND fulfillmentStatus = 0;");
        
        $result = $this->db->resultSet();
        return $result;
    }

    public function getPendingMonetaryNecessities($necessityID){
        $this->db->query("SELECT n.necessityID, n.necessityName, n.description, m.requestedAmount, m.receivedAmount, (m.requestedAmount - m.receivedAmount) AS amount_due, m.startDate, m.endDate, m.frequency, m.monetaryNecessityType, n.fulfillmentStatus 
            FROM necessity n 
            JOIN money m ON n.necessityID = m.monetaryNecessityID 
            WHERE necessityType = 'Monetary Funding' AND fulfillmentStatus = 0 AND n.necessityID = :necessityID");
            
        $this->db->bind(':necessityID', $necessityID);
    
        $result = $this->db->single();
        return $result;
    }

    public function getCompletedMonetaryNecessities($necessityID){
        $this->db->query("SELECT n.necessityID, n.necessityName, n.description, m.requestedAmount, m.receivedAmount, (m.requestedAmount - m.receivedAmount) AS amount_due, m.startDate, m.endDate, m.frequency,m.monetaryNecessityType, n.fulfillmentStatus 
            FROM necessity n 
            JOIN money m ON n.necessityID = m.monetaryNecessityID 
            WHERE necessityType = 'Monetary Funding' AND fulfillmentStatus = 2 AND n.necessityID = :necessityID");
            
        $this->db->bind(':necessityID', $necessityID);
    
        $result = $this->db->single();
        return $result;
    }

    // public function updatemonetarynecessitytodb($data){
    //     if (!isset($data['necessityMonetary'], $data['monetarynecessitydes'], $data['requestedamount'], $data['recurringstartdate'], $data['recurringenddate'], $data['frequency'], $data['necessityID'])) {
    //         // If any key is missing, return false or handle the error as needed
    //         return false;
    //     }

    //     //sql statement for update monetary necessity, necessity table
    //     $this->db->query('UPDATE necessity SET necessityName = :necessityMonetary, description = :monetarynecessitydes
    //     WHERE necessityID = :necessityID');

    //     // Binding values with array value
    //     $this->db->bind(':necessityMonetary', $data['necessityMonetary']);
    //     $this->db->bind(':monetarynecessitydes', $data['monetarynecessitydes']);
    //     $this->db->bind(':necessityID', $data['necessityID']);
        
    //     // execut query
    //     $result1 = $this->db->execute();

    //     //Update the money table
    //     $this->db->query('UPDATE money SET requestedAmount = :requestedamount, startDate = :recurringstartdate, endDate = :recurringenddate, frequency = :frequency
    //     WHERE monetaryNecessityID = :monetaryNecessityID');

    //     // Binding values with array value
    //     $this->db->bind(':requestedamount', $data['requestedamount']);
    //     $this->db->bind(':recurringstartdate', $data['recurringstartdate']);
    //     $this->db->bind(':recurringenddate', $data['recurringenddate']);
    //     $this->db->bind(':frequency', $data['frequency']);
    //     $this->db->bind(':monetaryNecessityID', $data['necessityID']);

    //     // execut query
    //     $result2 = $this->db->execute();

    //     //if both updates were successfull
    //     if($result1 && $result2){
    //         return true;
    //     }else{
    //         // Print error message for debugging
    //         printf("Error: %s\n", $this->db->getError());
    //         return false;
    //     }
    // }

    // Deleting necessities
    public function deleteNecessity($necessityID){
        // Query statement
        $this->db->query('UPDATE necessity SET fulfillmentStatus = 10 WHERE necessityID = :necessityID');
        $this->db->bind(':necessityID', $necessityID);

        // Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getAllConfirmedMonetaryNecessities(){
        $this->db->query("SELECT n.necessityID, n.necessityName, n.description, requestedAmount AS amount FROM necessity n JOIN money m ON n.necessityID = m.monetaryNecessityID 
        WHERE necessityType = 'Monetary Funding' AND fulfillmentStatus = 1;");
        
        $result = $this->db->resultSet();
        return $result;
    }

    public function getAllOngoingMonetaryNecessities(){
        $this->db->query("SELECT n.necessityID, n.necessityName, n.description, requestedAmount AS amount FROM necessity n JOIN money m ON n.necessityID = m.monetaryNecessityID 
        WHERE necessityType = 'Monetary Funding' AND fulfillmentStatus = 3;");
        
        $result = $this->db->resultSet();
        return $result;
    }

    public function getaddedGoodsNecessities(){
        $this->db->query("SELECT necessity.necessityID,necessity.necessityName,necessity.necessityType, necessity.description,necessity.fulfillmentStatus,physicalgood.requestedQuantity,physicalgood.receivedQuantity,physicalgood.itemCategory FROM necessity JOIN physicalgood ON necessity.necessityID = physicalgood.goodNecessityID 
        WHERE necessityType = 'Physical Goods' AND fulfillmentStatus = 0 AND doneeID = :doneeID;");
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        $result = $this->db->resultSet();
        return $result;
    }

    public function getaddedCompletedGoodsNecessities(){
        $this->db->query("SELECT necessity.necessityID,necessity.necessityName,necessity.necessityType, necessity.description,necessity.fulfillmentStatus,physicalgood.requestedQuantity,physicalgood.receivedQuantity,physicalgood.itemCategory FROM necessity JOIN physicalgood ON necessity.necessityID = physicalgood.goodNecessityID 
        WHERE necessityType = 'Physical Goods' AND fulfillmentStatus = 2 AND doneeID = :doneeID;");
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        $result = $this->db->resultSet();
        return $result;
    }

    public function getPendingGoodsNecessities($necessityID){
        $this->db->query("SELECT n.necessityID, n.necessityName,n.necessityType, n.description, n.fulfillmentStatus,(p.requestedQuantity - p.receivedQuantity) AS quantity_due,p.requestedQuantity,p.receivedQuantity,p.itemCategory
            FROM necessity n 
            JOIN physicalgood p ON n.necessityID = p.goodNecessityID 
            WHERE necessityType = 'Physical Goods' AND fulfillmentStatus = 0 AND n.necessityID = :necessityID");
            
        $this->db->bind(':necessityID', $necessityID);
    
        $result = $this->db->single();
        return $result;
    }

    public function getCompletedGoodsNecessities($necessityID){
        $this->db->query("SELECT n.necessityID, n.necessityName,n.necessityType, n.description, n.fulfillmentStatus,(p.requestedQuantity - p.receivedQuantity) AS quantity_due,p.requestedQuantity,p.receivedQuantity,p.itemCategory
            FROM necessity n 
            JOIN physicalgood p ON n.necessityID = p.goodNecessityID 
            WHERE necessityType = 'Physical Goods' AND fulfillmentStatus = 2 AND n.necessityID = :necessityID");
            
        $this->db->bind(':necessityID', $necessityID);
    
        $result = $this->db->single();
        return $result;
    }

    public function getAllPendingPhysicalGoods(){
        $this->db->query("SELECT n.necessityID, n.necessityName, n.description, (p.requestedQuantity - p.receivedQuantity) AS quantity FROM necessity n JOIN physicalgood p ON n.necessityID = p.goodNecessityID 
        WHERE necessityType = 'Physical Goods' AND fulfillmentStatus = 0;");
        
        $result = $this->db->resultSet();
        return $result;
    }

    public function getAllConfirmedPhysicalGoods(){
        $this->db->query("SELECT n.necessityID, n.necessityName, n.description, p.requestedQuantity AS quantity FROM necessity n JOIN physicalgood p ON n.necessityID = p.goodNecessityID 
        WHERE necessityType = 'Physical Goods' AND fulfillmentStatus = 1;");
        
        $result = $this->db->resultSet();
        return $result;
    }

    public function addgoodsnecessitytodb($data){
        print_r($data);
        //sql statement for adding Goods necessity, necessity table
        $this->db->query('INSERT INTO necessity(necessityName,necessityType,fulfillmentStatus,description,doneeID) 
        VALUES (:neccessityitem, :necessityType,:fulfillmentStatus, :goodsnecessitydes, :doneeID)');

        // Binding values with array value
        $this->db->bind(':neccessityitem', $data['neccessityitem']);
        $this->db->bind(':necessityType', 'Physical Goods');
        $this->db->bind(':fulfillmentStatus', 0);
        $this->db->bind(':goodsnecessitydes', $data['goodsnecessitydes']);
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        
        $result = $this->db->execute();

        if($result){
            //get the last Inserted Id from the database
            $result1 = $this->db->query('SELECT LAST_INSERT_ID() as last_id;');
            $row = $this->db->single();
            $goodNecessityID = $row->last_id;

            //store monetaryId in the session
            $_SESSION['goodNecessityID'] = $goodNecessityID;

            //sql statement for adding monetary necessity, money table
            $this->db->query('INSERT INTO physicalgood(goodNecessityID ,itemCategory, requestedQuantity) 
            VALUES (:goodNecessityID,:necessityCategory, :requestedgoodsquantity)');

            // Binding values with array value
            $this->db->bind(':goodNecessityID', $_SESSION['goodNecessityID']);
            $this->db->bind(':requestedgoodsquantity', $data['requestedgoodsquantity']);
            $this->db->bind(':necessityCategory', $data['necessityCategory']);

            $result2 = $this->db->execute();

            if ($result2) {
                return true;
            } else {
                // Print error message for debugging
                printf("Error: %s\n", $this->db->getError());
                return false;
            }
        }else{
            return false;
        }
    }

    public function getMonetaryNecessityType($necessity_ID) {
        $this->db->query('SELECT monetaryNecessityType FROM money WHERE monetaryNecessityID = :monetaryNecessityID;');
        $this->db->bind(':monetaryNecessityID', $necessity_ID);

        $row = $this->db->single();

        return $row->monetaryNecessityType;
    }

    public function getStudentOnetimeMonetaryDetails($necessity_ID) {
        $this->db->query("SELECT n.necessityName AS 'Necessity Name', n.description AS 'Description', n.doneeID, CONCAT(s.fName, ' ', s.lName) AS 'Student Name', m.monetaryNecessityType AS 'Necessity Type', m.requestedAmount AS 'Requested Amount', m.receivedAmount AS 'Received Amount' FROM necessity n JOIN money m ON n.necessityID = m.monetaryNecessityID JOIN student s ON n.doneeID = s.studentID WHERE m.monetaryNecessityType = 'onetime' AND n.necessityID = :necessityID;");
        $this->db->bind(':necessityID', $necessity_ID);

        $row = $this->db->single();

        return $row;
    }

    public function getOrganizationOnetimeMonetaryDetails($necessity_ID) {
        $this->db->query("SELECT n.necessityName AS 'Necessity Name', n.description AS 'Description', n.doneeID, o.orgName AS 'Organization Name', m.monetaryNecessityType AS 'Necessity Type', m.requestedAmount AS 'Requested Amount', m.receivedAmount AS 'Received Amount' FROM necessity n JOIN money m ON n.necessityID = m.monetaryNecessityID JOIN organization o ON n.doneeID = o.orgID WHERE m.monetaryNecessityType = 'onetime' AND n.necessityID = :necessityID;");
        $this->db->bind(':necessityID', $necessity_ID);

        $row = $this->db->single();

        return $row;
    }

    public function getStudentRecurringMonetaryDetails($necessity_ID) {
        $this->db->query("SELECT n.necessityName AS 'Necessity Name', n.description AS 'Description', n.doneeID, CONCAT(s.fName, ' ', s.lName) AS 'Student Name', m.monetaryNecessityType AS 'Necessity Type', m.requestedAmount AS 'Requested Amount', m.receivedAmount AS 'Received Amount', m.startDate AS 'Start Date', m.endDate AS 'End Date', m.frequency AS 'Frequency' FROM necessity n JOIN money m ON n.necessityID = m.monetaryNecessityID JOIN student s ON n.doneeID = s.studentID WHERE m.monetaryNecessityType = 'recurring' AND n.necessityID = :necessityID;");
        $this->db->bind(':necessityID', $necessity_ID);

        $row = $this->db->single();

        return $row;
    }

    public function getOrganizationRecurringMonetaryDetails($necessity_ID) {
        $this->db->query("SELECT n.necessityName AS 'Necessity Name', n.description AS 'Description', n.doneeID, o.orgName AS 'Organization Name', m.monetaryNecessityType AS 'Necessity Type', m.requestedAmount AS 'Requested Amount', m.receivedAmount AS 'Received Amount', m.startDate AS 'Start Date', m.endDate AS 'End Date', m.frequency AS 'Frequency' FROM necessity n JOIN money m ON n.necessityID = m.monetaryNecessityID JOIN organization o ON n.doneeID = o.orgID WHERE m.monetaryNecessityType = 'recurring' AND n.necessityID = :necessityID;");
        $this->db->bind(':necessityID', $necessity_ID);

        $row = $this->db->single(); 

        return $row;
    }

    public function getDoneeType($necessity_ID) {
        $this->db->query('SELECT doneeType FROM donee d JOIN necessity n ON d.doneeID = n.doneeID WHERE n.necessityID = :necessityID;');
        $this->db->bind(':necessityID', $necessity_ID);

        $row = $this->db->single();

        return $row->doneeType;
    }

    public function getAllComments($necessity_ID) {
        $this->db->query("SELECT c.postID, c.comment, a.adminName FROM comment c JOIN admin a ON c.adminID = a.adminID WHERE c.postID = :postID AND c.postType = 'necessity' ORDER BY time DESC;");
        $this->db->bind(':postID', $necessity_ID);

        $result = $this->db->resultSet();

        return $result;
    }

    public function addComment($data) {
        $this->db->query("INSERT INTO comment (postID, adminID, time, postType, comment) VALUES (:postID, :adminID, :time, 'necessity', :comment);");
        $this->db->bind(':postID', $data['necessity_ID']);
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

    public function getNecessityType($necessity_ID) {
        $this->db->query('SELECT necessityType FROM necessity WHERE necessityID = :necessityID;');
        $this->db->bind(':necessityID', $necessity_ID);

        $row = $this->db->single();

        return $row->necessityType;
    }
}