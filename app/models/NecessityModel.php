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
        $this->db->query("SELECT necessity.necessityName,necessity.description,money.requestedAmount,money.monetaryNecessityType FROM necessity JOIN money ON necessity.necessityID = money.monetaryNecessityID 
        WHERE necessityType = 'Monetary Funding' AND fulfillmentStatus = 0 AND doneeID = :doneeID;");
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        
        $result = $this->db->resultSet();
        return $result;
    }

    public function getaddedCompletedMonetaryNecessities(){
        $this->db->query("SELECT necessity.necessityName,necessity.description,money.requestedAmount,money.monetaryNecessityType FROM necessity JOIN money ON necessity.necessityID = money.monetaryNecessityID 
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
        $this->db->query("SELECT necessity.necessityName, necessity.description,physicalgood.requestedQuantity FROM necessity JOIN physicalgood ON necessity.necessityID = physicalgood.goodNecessityID 
        WHERE necessityType = 'Physical Goods' AND fulfillmentStatus = 0 AND doneeID = :doneeID;");
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        $result = $this->db->resultSet();
        return $result;
    }

    public function getaddedCompletedGoodsNecessities(){
        $this->db->query("SELECT necessity.necessityName, necessity.description,physicalgood.requestedQuantity FROM necessity JOIN physicalgood ON necessity.necessityID = physicalgood.goodNecessityID 
        WHERE necessityType = 'Physical Goods' AND fulfillmentStatus = 2 AND doneeID = :doneeID;");
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        $result = $this->db->resultSet();
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
        //sql statement for adding Goods necessity, necessity table
        $this->db->query('INSERT INTO necessity(necessityName,necessityType,fulfillmentStatus,description,doneeID) 
        VALUES (:necessitygoods, :necessityType,:fulfillmentStatus, :goodsnecessitydes, :doneeID)');

        // Binding values with array value
        $this->db->bind(':necessitygoods', $data['necessitygoods']);
        $this->db->bind(':necessityType', 'Physical Goods');
        $this->db->bind(':fulfillmentStatus','Pending');
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
            $this->db->query('INSERT INTO physicalgood(goodNecessityID ,requestedQuantity) 
            VALUES (:goodNecessityID, :requestedgoodsquantity)');

            // Binding values with array value
            $this->db->bind(':goodNecessityID', $_SESSION['goodNecessityID']);
            $this->db->bind(':requestedgoodsquantity', $data['requestedgoodsquantity']);

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
}