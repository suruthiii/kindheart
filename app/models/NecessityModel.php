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
            $this->db->query('INSERT INTO money(monetaryNecessityID ,requestedAmount,monthlyAmount,monetaryNecessityType,startDate,duration) 
            VALUES (:monetaryNecessityID, :requestedamount, :monthlyrequestedamount,:necessityType, :recurringstartdate, :donationduration)');

            // Binding values with array value
            $this->db->bind(':monetaryNecessityID', $_SESSION['monetaryNecessityID']);
            $this->db->bind(':monthlyrequestedamount', $data['monthlyrequestedamount']);

            if ($data['necessityType'] === 'recurring') {
                $this->db->bind(':requestedamount', $data['monthlyrequestedamount'] * $data['donationduration']);
            } else {
                $this->db->bind(':requestedamount', $data['requestedamount']);
            }

            $this->db->bind(':necessityType', $data['necessityType']);
            $this->db->bind(':recurringstartdate', $data['recurringstartdate']);
            $this->db->bind(':donationduration', $data['donationduration']);

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

    public function editrecurringmonetarynecessitytodb($data){
        //sql statement for Update recurring monetary necessity, necessity table
        $this->db->query('UPDATE necessity SET necessityName = :necessityMonetary ,description =:monetarynecessitydes
                        WHERE necessityID = :necessityID');

        // Binding values with array value
        $this->db->bind(':necessityMonetary', $data['necessityMonetary']);
        $this->db->bind(':monetarynecessitydes', $data['monetarynecessitydes']);
        $this->db->bind(':necessityID', $data['necessityID']);
        
        $result = $this->db->execute();

        return $result;
    }

    public function editonetimemonetarynecessitytodb($data){
        //sql statement for Update recurring monetary necessity, necessity table
        $this->db->query('UPDATE necessity SET necessityName = :necessityMonetary ,description =:monetarynecessitydes
                        WHERE necessityID = :necessityID');

        // Binding values with array value
        $this->db->bind(':necessityMonetary', $data['necessityMonetary']);
        $this->db->bind(':monetarynecessitydes', $data['monetarynecessitydes']);
        $this->db->bind(':necessityID', $data['necessityID']);
        
        $result = $this->db->execute();

        return $result;
    }

    //get the monthlyAmount for update necessity
    public function getTheMonthlyAmount($necessityID){
        $this->db->query('SELECT money.monthlyAmount FROM money WHERE money.monetaryNecessityID = :necessityID' );
        $this->db->bind(':necessityID', $necessityID);
        $result = $this->db->single();
        return $result;
    }
    
    ///////////////////////////////////////////////////////////////
    public function getaddedMonetaryNecessities(){
        $this->db->query("SELECT necessity.*, money.* FROM necessity JOIN money ON necessity.necessityID = money.monetaryNecessityID 
            WHERE necessityType = 'Monetary Funding' AND (fulfillmentStatus = 0 OR fulfillmentStatus = 1) AND doneeID = :doneeID");
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        
        $result = $this->db->resultSet();
    
        foreach($result as $necessity){
            if($necessity->monetaryNecessityType == "onetime"){

                // DELETE the rows that donation where current date is over
                $this->db->query("UPDATE onetimedonation SET verificationStatus = 10 
                    WHERE DATEDIFF(CURDATE(), onetimedonation.confirmedDate) > 2 AND onetimedonation.paymentSlip IS NULL AND
                     onetimedonation.monetaryNecessityID = :necessityID;");
                $this->db->bind(':necessityID', $necessity->necessityID);
                $this->db->execute();

                // then get the count of donation a necessity got
                $this->db->query("SELECT COUNT(*) AS donationCount FROM onetimedonation
                    WHERE onetimedonation.monetaryNecessityID = :necessityID");
    
                $this->db->bind(':necessityID', $necessity->necessityID);

                $donationCountResult = $this->db->single();

                // then change the necessity status of the database
                if($donationCountResult->donationCount > 0){
                    $this->db->query("UPDATE necessity SET fulfillmentStatus = 1 WHERE necessityID = :necessityID");
                    $this->db->bind(':necessityID', $necessity->necessityID);
                    $this->db->execute();
                }elseif($donationCountResult->donationCount == 0){
                    $this->db->query("UPDATE necessity SET fulfillmentStatus = 0 WHERE necessityID = :necessityID");
                    $this->db->bind(':necessityID', $necessity->necessityID);
                    $this->db->execute();
                }

                

            } else {
                $this->db->query("SELECT COUNT(*) AS donationCount FROM recurringdonation
                    WHERE recurringdonation.monetaryNecessityID = :necessityID");
    
                $this->db->bind(':necessityID', $necessity->necessityID); 

                $donationCountResult = $this->db->single();
    
                if($donationCountResult->donationCount > 0){
                    $this->db->query("UPDATE necessity SET fulfillmentStatus = 1 WHERE necessityID = :necessityID");
                    $this->db->bind(':necessityID', $necessity->necessityID);
                    $this->db->execute();
                }
            }
    
        }

        $this->db->query("SELECT n.necessityID, n.necessityName, n.description, m.requestedAmount, m.receivedAmount, (m.requestedAmount - m.receivedAmount) AS amount_due, m.startDate, m.monetaryNecessityType, m.monthlyAmount, m.duration , n.fulfillmentStatus 
            FROM necessity n JOIN money m ON n.necessityID = m.monetaryNecessityID 
            WHERE necessityType = 'Monetary Funding' AND fulfillmentStatus = 0 AND doneeID = :doneeID");
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        
        $result = $this->db->resultSet();
    
        return $result;
    }
    ///////////////////////////////////////////////////////////////

    public function getaddedCompletedMonetaryNecessities(){

        $this->db->query("SELECT necessity.*, money.* FROM necessity JOIN money ON necessity.necessityID = money.monetaryNecessityID 
            WHERE necessityType = 'Monetary Funding' AND fulfillmentStatus = 1 AND doneeID = :doneeID");
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        

        $necessities = $this->db->resultSet();

        foreach ($necessities as $necessity) {
            if($necessity->monetaryNecessityType == "onetime"){
                $this->getDonordWhoDonatedForthisNecessity($necessity->necessityID);

                //find the if the total donation that done to necessities is fill the requested amount
                $this->db->query("SELECT SUM(amount) AS totalAmount FROM onetimedonation WHERE monetaryNecessityID = :necessityID");
                $this->db->bind(':necessityID', $necessity->necessityID);
                $onetimedonations = $this->db->single();
                $totalAmount = $onetimedonations->totalAmount;

                $this->db->query("SELECT * FROM onetimedonation WHERE monetaryNecessityID = :necessityID");
                $this->db->bind(':necessityID', $necessity->necessityID);
                $verificationStatus = $this->db->single();

                if($totalAmount >= $necessity->requestedAmount && $verificationStatus->verificationStatus == 2 && $verificationStatus->paymentSlip !== NULL){
                    $this->db->query("UPDATE necessity SET fulfillmentStatus = 2 WHERE necessityID = :necessityID");
                    $this->db->bind(':necessityID', $necessity->necessityID);
                    $this->db->execute();
                }
            }else{

                $this->db->query("UPDATE money m
                JOIN recurringdonation rd ON m.monetaryNecessityID = rd.monetaryNecessityID
                SET m.receivedAmount = m.receivedAmount + m.monthlyAmount,
                    rd.verificationStatus = 3
                WHERE rd.verificationStatus = 0
                AND rd.monetaryNecessityID = :necessityID");

                    $this->db->bind(':necessityID', $necessity->necessityID);
                    $this->db->execute();

                $this->db->query("UPDATE necessity n
                                    JOIN recurringdonation rd ON n.necessityID = rd.monetaryNecessityID
                                    JOIN money m ON rd.monetaryNecessityID = m.monetaryNecessityID
                                    SET n.fulfillmentStatus = 2
                                    WHERE rd.slipCount = rd.acknowledgementCount 
                                    AND rd.verificationStatus = 2
                                    AND rd.acknowledgementCount = m.duration AND necessityID = :necessityID");
                $this->db->bind(':necessityID', $necessity->necessityID);
                $this->db->execute();
                
                

            }
        }

        $this->db->query("SELECT n.necessityID, n.necessityName, n.description, m.requestedAmount, m.receivedAmount, (m.requestedAmount - m.receivedAmount) AS amount_due, m.startDate, m.monetaryNecessityType, m.monthlyAmount, m.duration , n.fulfillmentStatus
            FROM necessity n JOIN money m ON n.necessityID = m.monetaryNecessityID 
            WHERE necessityType = 'Monetary Funding' AND fulfillmentStatus = 2 AND doneeID = :doneeID");
        $this->db->bind(':doneeID', $_SESSION['user_id']);
        
        $result = $this->db->resultSet();
    
        return $result;
    }

    ///////////////////////////////////////////////////////////////////////

    public function getDonordWhoDonatedForthisNecessity($necessityID){
        $this->db->query("SELECT necessity.*, money.*, SUM(onetimedonation.amount) AS totalAmountReceived, onetimedonation.verificationStatus
                          FROM necessity 
                          LEFT JOIN money ON necessity.necessityID = money.monetaryNecessityID 
                          LEFT JOIN onetimedonation ON money.monetaryNecessityID = onetimedonation.monetaryNecessityID 
                          WHERE necessity.necessityID = :necessityID
                          GROUP BY necessity.necessityID");
    
        $this->db->bind(':necessityID', $necessityID);
    
        $result = $this->db->single();
    
        if ($result->requestedAmount > $result->receivedAmount && $result->verificationStatus == 0) {
            // Update verification status to 3 as for commenting (read the necessity)
            $this->db->query("UPDATE onetimedonation 
                              SET verificationStatus = 3 
                              WHERE monetaryNecessityID = :necessityID 
                              AND verificationStatus = 0");
    
            $this->db->bind(':necessityID', $necessityID);
            $this->db->execute();
    
            // Update received amount in the money table
            $result->receivedAmount += $result->totalAmountReceived;
            $this->db->query("UPDATE money 
                              SET receivedAmount = :receivedAmount 
                              WHERE monetaryNecessityID = :necessityID");
    
            $this->db->bind(':necessityID', $necessityID);
            $this->db->bind(':receivedAmount', $result->receivedAmount);
            $this->db->execute();
        }
    }

    public function recurringDonationDetails($necessityID){
        $this->db->query("SELECT 
                        u.userID,
                        u.username,
                        rd.updatedMonth,
                        m.monthlyAmount,
                        CASE
                            WHEN rd.paymentSlip IS NOT NULL AND rd.verificationStatus = 2 AND rd.acknowledgement IS NOT NULL THEN 'paid and confirmed'
                            WHEN rd.paymentSlip IS NOT NULL AND rd.verificationStatus = 1 THEN 'paid but not verified'
                            ELSE 'not paid'
                        END AS paymentStatus
                    FROM 
                        user u
                    INNER JOIN donor d ON u.userID = d.donorID
                    INNER JOIN recurringdonation rd ON d.donorID = rd.donorID
                    INNER JOIN money m ON rd.monetaryNecessityID = m.monetaryNecessityID
                    WHERE m.monetaryNecessityID = $necessityID");

        $this->db->execute();

        $result = $this->db->resultSet();

        return $result;
    }
    
    public function findtheMonthsINTHERECORD($necessityID){
        $this->db->query("SELECT rd.confirmedDate,
                        CASE
                            WHEN DAY(LAST_DAY(rd.confirmedDate)) - DAY(rd.confirmedDate) > 15 THEN MONTH(rd.confirmedDate)
                            ELSE MONTH(DATE_ADD(rd.confirmedDate, INTERVAL 1 MONTH))
                        END AS chosenMonth,
                        CASE
                            WHEN DAY(LAST_DAY(rd.confirmedDate)) - DAY(rd.confirmedDate) > 15 THEN LAST_DAY(rd.confirmedDate)
                            ELSE LAST_DAY(DATE_ADD(rd.confirmedDate, INTERVAL 1 MONTH))
                        END AS endDateOfMonth
                    FROM 
                        recurringdonation rd
                    INNER JOIN money m ON rd.monetaryNecessityID = m.monetaryNecessityID
                    INNER JOIN necessity n ON m.monetaryNecessityID = n.necessityID
                    WHERE n.necessityID = :necessityID");
                    $this->db->bind(':necessityID', $necessityID);
                    $MonthofDOnation = $this->db->single();
                    return $MonthofDOnation->chosenMonth;
    }

    //////////////////////////////////////////////////////////////////////

    public function getstillnotCompleteNecessities(){
        $this->db->query("SELECT necessity.necessityID,necessity.necessityName,necessity.description,money.requestedAmount,money.receivedAmount,money.monetaryNecessityType FROM necessity JOIN money ON necessity.necessityID = money.monetaryNecessityID 
        WHERE necessityType = 'Monetary Funding' AND fulfillmentStatus = 1 AND doneeID = :doneeID;");
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
        $this->db->query("SELECT n.necessityID, n.necessityName, n.description, m.requestedAmount, m.receivedAmount, (m.requestedAmount - m.receivedAmount) AS amount_due, m.startDate, m.monetaryNecessityType, m.monthlyAmount, m.duration , n.fulfillmentStatus 
            FROM necessity n 
            JOIN money m ON n.necessityID = m.monetaryNecessityID 
            WHERE necessityType = 'Monetary Funding' AND fulfillmentStatus = 0 AND n.necessityID = :necessityID");
            
        $this->db->bind(':necessityID', $necessityID);
    
        $result = $this->db->single();
        return $result;
    }

    //this is the necessities that donors start to donate
    public function stilnotcompleteNecessities(){
        $this->db->query("SELECT n.necessityID, n.necessityName, n.description, m.requestedAmount, m.receivedAmount, (m.requestedAmount - m.receivedAmount) AS amount_due, m.startDate, m.monetaryNecessityType, m.monthlyAmount, m.duration , n.fulfillmentStatus 
            FROM necessity n 
            JOIN money m ON n.necessityID = m.monetaryNecessityID 
            WHERE necessityType = 'Monetary Funding' AND fulfillmentStatus = 1 AND doneeID = :doneeID");
            
            $this->db->bind(':doneeID', $_SESSION['user_id']);

            $result = $this->db->resultSet();
            return $result;
    }

    public function getdonationstartNecessity($necessityID){
        $this->db->query("SELECT n.necessityID, n.necessityName, n.description, m.requestedAmount, m.receivedAmount, (m.requestedAmount - m.receivedAmount) AS amount_due, m.startDate, m.monetaryNecessityType, m.monthlyAmount, m.duration , n.fulfillmentStatus 
            FROM necessity n 
            JOIN money m ON n.necessityID = m.monetaryNecessityID 
            WHERE necessityType = 'Monetary Funding' AND fulfillmentStatus = 1 AND n.necessityID = :necessityID");
            
        $this->db->bind(':necessityID', $necessityID);
    
        $result = $this->db->single();
        return $result;
    }

    public function getdonateddonordetails($necessity){
        $this->db->query("SELECT user.username, onetimedonation.* FROM user
            INNER JOIN donor ON user.UserID = donor.donorID
            INNER JOIN onetimedonation ON donor.donorID = onetimedonation.donorId
            WHERE onetimedonation.verificationStatus=3 AND onetimedonation.monetaryNecessityID = $necessity");

        $result = $this->db->resultSet();

        return $result;

    }
///////////////////////////////////////////////////////////////////

    public function getCompletedMonetaryNecessities($necessityID){
        $this->db->query("SELECT n.necessityID, n.necessityName, n.description, m.requestedAmount, m.receivedAmount, (m.requestedAmount - m.receivedAmount) AS amount_due, m.startDate, m.monetaryNecessityType, m.monthlyAmount, m.duration , n.fulfillmentStatus 
            FROM necessity n 
            JOIN money m ON n.necessityID = m.monetaryNecessityID 
            WHERE necessityType = 'Monetary Funding' AND fulfillmentStatus = 2 AND n.necessityID = :necessityID");
            
        $this->db->bind(':necessityID', $necessityID);
    
        $result = $this->db->single();
        return $result;
    }

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

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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

    public function compairrequestedAmountandrecievedAmount(){
        $this->db->query("SELECT necessity.*, physicalgood.* FROM necessity JOIN physicalgood ON necessity.necessityID = physicalgood.goodNecessityID;");

        $result = $this->db->resultSet();

        foreach($result as $necessity){
            $this->db->query("SELECT COUNT(*) as donationcount FROM gooddonation WHERE gooddonation.goodDonationID = :goodNecessityID");
            $this->db->bind(':goodNecessityID', $necessity->goodNecessityID);
            $donationCount = $this->db->single();


            if($donationCount->donationcount >0){

            }
        }
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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

    public function editphysicalgoodsnecessitytodb($data){
        //sql statement for Updating Goods necessity, necessity table
        $this->db->query('UPDATE necessity SET description = :goodsnecessitydes WHERE necessityID = :necessityID');

        // Binding values with array value
        $this->db->bind(':necessityID', $data['necessityID']);
        $this->db->bind(':goodsnecessitydes', $data['goodsnecessitydes']);
        
        $result = $this->db->execute();

        if($result){
            
            //sql statement for Updating monetary necessity, physical goods table
            $this->db->query('UPDATE physicalgood SET requestedQuantity = :requestedgoodsquantity WHERE goodNecessityID = :necessityID');

            // Binding values with array value
            $this->db->bind(':necessityID', $data['necessityID']);
            $this->db->bind(':requestedgoodsquantity', $data['requestedgoodsquantity']);

            $result2 = $this->db->execute();

            var_dump($result2);

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

    public function getTotalReceivedAmount() {
        $this->db->query("SELECT SUM(money.receivedAmount) AS total_received FROM money JOIN necessity ON necessity.necessityID = money.monetaryNecessityID 
        WHERE necessityType = 'Monetary Funding' AND doneeID = :doneeID;");

        $this->db->bind(':doneeID', $_SESSION['user_id']);
        $row = $this->db->single();
        
        return $row->total_received;
    }

    public function getTotalReceivedQuantity() {
        $this->db->query("SELECT SUM(physicalgood.receivedQuantity) AS total_received FROM physicalgood JOIN necessity ON necessity.necessityID = physicalgood.goodNecessityID 
        WHERE  necessityType = 'Physical Goods' AND doneeID = :doneeID;");

        $this->db->bind(':doneeID', $_SESSION['user_id']);
        $row = $this->db->single();
        
        return $row->total_received;
    }

    public function getALLthedetailsofMonetaryNecessityByID($necessityID){
        $this->db->query("SELECT n.necessityID, n.necessityName, n.description, m.requestedAmount, m.receivedAmount, (m.requestedAmount - m.receivedAmount) AS amount_due, m.startDate, m.monetaryNecessityType, m.monthlyAmount, m.duration , n.fulfillmentStatus 
            FROM necessity n 
            JOIN money m ON n.necessityID = m.monetaryNecessityID 
            WHERE n.necessityID = :necessityID");
        $this->db->bind(':necessityID', $necessityID);

        $result = $this->db->single();

        return $result;
    }

    public function getALLthedetailsofPhysicalGoodsNecessityByID($necessityID){
        $this->db->query("SELECT n.necessityID, n.necessityName,n.necessityType, n.description, n.fulfillmentStatus,(p.requestedQuantity - p.receivedQuantity) AS quantity_due,p.requestedQuantity,p.receivedQuantity,p.itemCategory
            FROM necessity n 
            JOIN physicalgood p ON n.necessityID = p.goodNecessityID 
            WHERE n.necessityID = :necessityID");
            
        $this->db->bind(':necessityID', $necessityID);
    
        $result = $this->db->single();
        return $result;
    }

    // public function getDonorsWhoDonatedForThisNecessity($necessityID) {
    //     // Selecting data
    //     $this->db->query("SELECT user.username, onetimedonation.* FROM user
    //                         INNER JOIN donor ON user.UserID = donor.donorID
    //                         INNER JOIN onetimedonation ON donor.donorID = onetimedonation.donorId
    //                         WHERE onetimedonation.monetaryNecessityID = :necessityID");
    //     $this->db->bind(':necessityID', $necessityID);
    //     $result = $this->db->resultSet();
    
    //     // Create an empty array to store the rows that meet the condition
    //     $rows = [];
    
    //     // Loop through each row in the result set
    //     foreach ($result as $row) {
    //         // Check if onetimedonation.amount is equal to or less than money.requestedAmount
    //         $this->db->query("SELECT money.*, necessity.fulfillmentStatus
    //                             FROM money
    //                             INNER JOIN necessity ON money.monetaryNecessityID = necessity.necessityID
    //                             WHERE money.monetaryNecessityID = :necessityID");
    //         $this->db->bind(':necessityID', $necessityID);
    //         $moneyResult = $this->db->single();

    
    //         if ($row->amount >= $moneyResult->requestedAmount) {
    //             // Update money table as onetimedonation.amount is equal to or more than requestedAmount
    //             $receivedAmount = $moneyResult->receivedAmount + $row->amount;
    //             $this->db->query("UPDATE money SET receivedAmount = :receivedAmount WHERE monetaryNecessityID = :necessityID");
    //             $this->db->bind(':receivedAmount', $receivedAmount);
    //             $this->db->bind(':necessityID', $necessityID);
    //             $this->db->execute();
    
    //             // Add the row to the result array
    //             $rows[] = $row;

    //         } else {
    //             // Update money table as onetimedonation.amount is less than requestedAmount
    //             $receivedAmount = $moneyResult->receivedAmount + $row->amount;
    //             $this->db->query("UPDATE money SET receivedAmount = :receivedAmount WHERE monetaryNecessityID = :necessityID");
    //             $this->db->bind(':receivedAmount', $receivedAmount);
    //             $this->db->bind(':necessityID', $necessityID);
    //             $this->db->execute();
    
    //             // Add the row to the result array
    //             $rows[] = $row;
    //         }

    //         if($receivedAmount == $moneyResult->requestedAmount){
    //             $this->db->query("UPDATE necessity SET fulfillmentStatus = 1 WHERE necessityID = :necessityID");
    //             $this->db->bind(':necessityID', $necessityID);
    //             $this->db->execute();

    //             break;
    //         }
    //     }
    
    //     // Return the array of rows
    //     return $rows;
    // }
    
    public function getDonorsWhoDonatedForThisNecessity($necessityID){
        // Fetching donors who donated for the specified necessity and their donation details
        $this->db->query("SELECT user.username, user.UserID,  onetimedonation.*, money.requestedAmount 
                          FROM user
                          INNER JOIN donor ON user.UserID = donor.donorID
                          INNER JOIN onetimedonation ON donor.donorID = onetimedonation.donorId
                          INNER JOIN money ON onetimedonation.monetaryNecessityID = money.monetaryNecessityID
                          WHERE onetimedonation.monetaryNecessityID = :necessityID");
        $this->db->bind(':necessityID', $necessityID);
        $result = $this->db->resultSet();
        
        // Fetching the received amount for the specified necessity
        $this->db->query("SELECT requestedAmount, startDate 
                          FROM money
                          WHERE monetaryNecessityID = :necessityID");
        $this->db->bind(':necessityID', $necessityID);
        $moneyResult = $this->db->single();
        
        $requestedAmount = $moneyResult->requestedAmount;
        $startDate = strtotime($moneyResult->startDate);
        $today = strtotime(date("Y-m-d"));
        
        // Array to hold the filtered results
        $filteredResults = array();
        $amountsum = 0;
    
        foreach ($result as $row) {
            $amountsum += $row->amount;

            // Comparing the total donated amount to the requested amount
            if ($amountsum <= $requestedAmount) {
                $filteredResults[] = $row;
            }else{
                $filteredResults[] = $row;
                break;
            }
        }

        if($amountsum >= $requestedAmount){
            $this->db->query("UPDATE necessity SET fulfillmentStatus = 1 WHERE necessityID = :necessityID");
            $this->db->bind(':necessityID', $necessityID);
            $this->db->execute();
        }

        return $filteredResults;
    }

    /* ------------------------------- Admin and Super Admin ------------------------------------------ */

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
        $this->db->query("SELECT n.necessityName AS 'Necessity Name', n.description AS 'Description', n.doneeID, CONCAT(s.fName, ' ', s.lName) AS 'Student Name', m.monetaryNecessityType AS 'Necessity Type', m.requestedAmount AS 'Requested Amount', m.receivedAmount AS 'Received Amount', m.monthlyAmount AS 'Monthly Amount', m.startDate AS 'Start Date', m.duration AS 'Duration' FROM necessity n JOIN money m ON n.necessityID = m.monetaryNecessityID JOIN student s ON n.doneeID = s.studentID WHERE m.monetaryNecessityType = 'recurring' AND n.necessityID = :necessityID;");
        $this->db->bind(':necessityID', $necessity_ID);

        $row = $this->db->single();

        return $row;
    }

    public function getStudentGoodDetails($necessity_ID) {
        $this->db->query("SELECT n.necessityName AS 'Necessity Name', n.description AS 'Description', n.doneeID, CONCAT(s.fName, ' ', s.lName) AS 'Student Name', p.itemCategory AS 'Item Category', p.requestedQuantity AS 'Requested Quantity', p.receivedQuantity AS 'Received Quantity' FROM necessity n JOIN physicalgood p ON n.necessityID = p.goodNecessityID JOIN student s ON n.doneeID = s.studentID WHERE n.necessityID = :necessityID;");
        $this->db->bind(':necessityID', $necessity_ID);

        $row = $this->db->single();

        return $row;
    }

    public function getOrganizationGoodDetails($necessity_ID) {
        $this->db->query("SELECT n.necessityName AS 'Necessity Name', n.description AS 'Description', n.doneeID, o.orgName AS 'Organization Name', p.itemCategory AS 'Item Category', p.requestedQuantity AS 'Requested Quantity', p.receivedQuantity AS 'Received Quantity' FROM necessity n JOIN physicalgood p ON n.necessityID = p.goodNecessityID JOIN organization o ON n.doneeID = o.orgID WHERE n.necessityID = :necessityID;");
        $this->db->bind(':necessityID', $necessity_ID);

        $row = $this->db->single();

        return $row;
    }

    public function getOrganizationRecurringMonetaryDetails($necessity_ID) {
        $this->db->query("SELECT n.necessityName AS 'Necessity Name', n.description AS 'Description', n.doneeID, o.orgName AS 'Organization Name', m.monetaryNecessityType AS 'Necessity Type', m.requestedAmount AS 'Requested Amount', m.receivedAmount AS 'Received Amount', m.monthlyAmount AS 'Monthly Amount', m.startDate AS 'Start Date', m.duration AS 'Duration' FROM necessity n JOIN money m ON n.necessityID = m.monetaryNecessityID JOIN organization o ON n.doneeID = o.orgID WHERE m.monetaryNecessityType = 'recurring' AND n.necessityID = :necessityID;");
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

    public function getOrganizationDetails($org_ID) {
        $this->db->query('SELECT u.email, u.username, d.*, o.* FROM user u JOIN donee d ON u.userID = d.doneeID JOIN organization o ON d.doneeID = o.orgID WHERE orgID = :orgID;');
        $this->db->bind(':orgID', $org_ID);

        $row = $this->db->single();

        return $row;
    }

    public function getStudentDetails($student_ID) {
        $this->db->query('SELECT u.email, u.username, d.*, s.* FROM user u JOIN donee d ON u.userID = d.doneeID JOIN student s ON d.doneeID = s.studentID WHERE studentID = :studentID;');
        $this->db->bind(':studentID', $student_ID);

        $row = $this->db->single();

        return $row;
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

    public function getDonorType($donor_ID) {
        $this->db->query('SELECT donorType FROM donor WHERE donorID = :donorID');
        $this->db->bind(':donorID', $donor_ID);

        $donorType = $this->db->single()->donorType;

        return $donorType;
    }

    public function getDonorName($donor_ID) {
        $donorType = $this->getDonorType($donor_ID);

        if ($donorType == 'individual') {
            $this->db->query('SELECT fName, lName AS name FROM individual WHERE individualID = :individualID');
            $this->db->bind(':individualID', $donor_ID);
        }

        else if ($donorType == 'company') {
            $this->db->query('SELECT companyName AS name FROM company WHERE companyID = :companyID');
            $this->db->bind(':companyID', $donor_ID);
        }

        $donorName = $this->db->single()->name;

        return $donorName;
    }

    public function getOneTimeDonationCardDetails($necessity_ID) {
        $this->db->query('SELECT oneTimeDonationID, amount, donorID, verificationStatus FROM oneTimeDonation WHERE monetaryNecessityID = :monetaryNecessityID;');
        $this->db->bind(':monetaryNecessityID', $necessity_ID);

        $result = $this->db->resultSet();

        foreach($result as $item) {
            $item->donorName = $this->getDonorName($item->donorID);
        }

        return $result;
    }

    public function getRecurringDonationCardDetails($necessity_ID) {
        $this->db->query('SELECT monetaryNecessityID, updatedMonth, donorID, verificationStatus FROM recurringDonation WHERE monetaryNecessityID = :monetaryNecessityID;');
        $this->db->bind(':monetaryNecessityID', $necessity_ID);

        $result = $this->db->resultSet();

        foreach($result as $item) {
            $item->donorName = $this->getDonorName($item->donorID);
        }

        return $result;
    }

    // Getting Monetary Necessity ID using One Time Donation ID
    public function getMonetaryNecessityID($oneTimeDonation_ID) {
        $this->db->query('SELECT monetaryNecessityID FROM oneTimeDonation WHERE oneTimeDonationID = :oneTimeDonationID');
        $this->db->bind(':oneTimeDonationID', $oneTimeDonation_ID);

        $necessity_ID = $this->db->single()->monetaryNecessityID;

        return $necessity_ID;
    }

    
    // Getting Monetary Necessity ID using One Time Donation ID
    public function getGoodNecessityID($goodDonation_ID) {
        $this->db->query('SELECT goodNecessityID FROM goodDonation WHERE goodDonationID = :goodDonationID');
        $this->db->bind(':goodDonationID', $goodDonation_ID);

        $necessity_ID = $this->db->single()->goodNecessityID;

        return $necessity_ID;
    }

    public function getOneTimeDonationDetails($oneTimeDonation_ID) {
        $this->db->query('SELECT donorID, amount, paymentSlip, verificationStatus, acknowledgement FROM oneTimeDonation WHERE oneTimeDonationID = :oneTimeDonationID;');
        $this->db->bind(':oneTimeDonationID', $oneTimeDonation_ID);

        $donationDetails = $this->db->single();

        $donationDetails->donorName = $this->getDonorName($donationDetails->donorID);

        return $donationDetails;
    }

    public function getRecurringDonationDetails($monetaryNecessity_ID) {
        $this->db->query("SELECT r.donorID, r.acknowledgementCount, r.paymentSlip, r.updatedMonth, r.verificationStatus, r.slipCount, r.acknowledgement, m.monthlyAmount FROM recurringDonation r JOIN money m ON r.monetaryNecessityID = m.monetaryNecessityID WHERE r.monetaryNecessityID = :monetaryNecessityID;");
        $this->db->bind(':monetaryNecessityID', $monetaryNecessity_ID);

        $donationDetails = $this->db->single();

        $donationDetails->donorName = $this->getDonorName($donationDetails->donorID);

        return $donationDetails;
    }

    public function getGoodDonationCardDetails($goodNecessity_ID) {
        $this->db->query('SELECT goodDonationID, quantity, donorID, verificationStatus FROM goodDonation WHERE goodNecessityID = :goodNecessityID;');
        $this->db->bind(':goodNecessityID', $goodNecessity_ID);

        $result = $this->db->resultSet();

        foreach($result as $item) {
            $item->donorName = $this->getDonorName($item->donorID);
        }

        return $result;
    }

    public function getGoodDonationDetails($goodDonation_ID) {
        $this->db->query('SELECT donorID, quantity, deliveryReceipt, verificationStatus, acknowledgement FROM goodDonation WHERE goodDonationID = :goodDonationID;');
        $this->db->bind(':goodDonationID', $goodDonation_ID);

        $donationDetails = $this->db->single();

        $donationDetails->donorName = $this->getDonorName($donationDetails->donorID);

        return $donationDetails;
    }

    public function getDoneeID($necessity_ID) {
        $this->db->query('SELECT doneeID FROM necessity WHERE necessityID = :necessityID;');
        $this->db->bind(':necessityID', $necessity_ID);

        $doneeID = $this->db->single()->doneeID;

        return $doneeID;
    }

    public function verifyOneTimeSlip($donation_ID) {
        $this->db->query("UPDATE oneTimeDonation SET verificationStatus = 2, acknowledgement = 'Pending' WHERE oneTimeDonationID = :oneTimeDonationID;");
        $this->db->bind(':oneTimeDonationID', $donation_ID);

        if($this->db->execute()) {
            return true;
        }
        else {
            return false;
        }
    }

    public function verifyRecurringSlip($necessity_ID) {
        $this->db->query("UPDATE recurringDonation SET verificationStatus = 2 , acknowledgement = 'Pending' WHERE monetaryNecessityID = :monetaryNecessityID;");
        $this->db->bind(':monetaryNecessityID', $necessity_ID);

        if($this->db->execute()) {
            return true;
        }

        else {
            return false;
        }
    }

    public function verifyGoodReceipt($donation_ID) {
        $this->db->query("UPDATE goodDonation SET verificationStatus = 2 , acknowledgement = 'Pending' WHERE goodDonationID = :goodDonationID;");
        $this->db->bind(':goodDonationID', $donation_ID);

        if($this->db->execute()) {
            return true;
        }

        else {
            return false;
        }
    }

    public function restrictNecessity($necessity_ID) {
        $this->db->query('UPDATE necessity SET fulfillmentStatus = 5 WHERE necessityID = :necessityID');
        $this->db->bind(':necessityID', $necessity_ID);

        if($this->db->execute()) {
            return true;
        }

        else {
            return false;
        }
    }

    // Get Donee ID By oneTimeDonationID
    public function getDoneeIDByOneTimeDonation($donation_ID) {
        $this->db->query('SELECT n.doneeID FROM necessity n JOIN oneTimeDonation o ON n.necessityID = o.monetaryNecessityID WHERE oneTimeDonationID = :oneTimeDonationID;');
        $this->db->bind(':oneTimeDonationID', $donation_ID);

        $doneeID  = $this->db->single();

        return $doneeID->doneeID;
    }

    // Get Donee ID By monetary necessity ID of recurring donation table
    public function getDoneeIDByRecurringMonetaryNecessity($monetaryNecessity_ID) {
        $this->db->query('SELECT n.doneeID FROM necessity n JOIN recurringDonation r ON n.necessityID = r.monetaryNecessityID WHERE r.monetaryNecessityID = :monetaryNecessityID;');
        $this->db->bind(':monetaryNecessityID', $monetaryNecessity_ID);

        $doneeID = $this->db->single();

        return $doneeID->doneeID;
    }

    // Get Donee ID By GoodDonationID
    public function getDoneeIDByGoodDonation($donation_ID) {
        $this->db->query('SELECT n.doneeID FROM necessity n JOIN goodDonation g ON n.necessityID = g.goodNecessityID WHERE g.goodDonationID = :goodDonationID');
        $this->db->bind(':goodDonationID', $donation_ID);

        $doneeID = $this->db->single();

        return $doneeID->doneeID;
    }

    // Get Donor ID By oneTimeDonationID
    public function getDonorIDByOneTimeDonation($donation_ID) {
        $this->db->query('SELECT donorID FROM oneTimeDonation WHERE oneTimeDonationID = :oneTimeDonationID;');
        $this->db->bind(':oneTimeDonationID', $donation_ID);

        $donorID = $this->db->single();

        return $donorID->donorID;
    }

    // Get Donor ID By monetary necessity ID of recurring donation table
    public function getDonorIDByRecurringMonetaryNecessity($monetaryNecessity_ID) {
        $this->db->query('SELECT donorID FROM recurringDonation WHERE monetaryNecessityID = :monetaryNecessityID;');
        $this->db->bind(':monetaryNecessityID', $monetaryNecessity_ID);

        $donorID = $this->db->single();

        return $donorID->donorID;
    }

    // Get Donee ID By GoodDonationID
    public function getDonorIDByGoodDonation($donation_ID) {
        $this->db->query('SELECT donorID FROM goodDonation WHERE goodDonationID = :goodDonationID;');
        $this->db->bind(':goodDonationID', $donation_ID);

        $donorID = $this->db->single();

        return $donorID->donorID;
    }



    // -----------------------Donor---------------------------
    public function getNecessitiesForDonor(){
        // Prepare statement
        $this->db->query('SELECT n.necessityID , n.necessityName, n.necessityType, n.fulfillmentStatus, n.description, n.doneeID  
                            FROM necessity n
                            JOIN user u ON u.userID = n.doneeID 
                            WHERE availabilityStatus = 0;');

        $result = $this->db->resultSet();
        
        return array_reverse($result); 
    }



    // public function getNecessitiesForDonor($necessityID) {
    //     // Prepare statement
    //     $this->db->query('SELECT * FROM necessity WHERE necessityID = :necessityID');

    //     //Bind
    //     $this->db->bind(':necessityID', $necessityID);
    
    //     // Execute
    //     $row = $this->db->single();
    
    //     // Fetch result set
    //     return $row;
    // }
}
