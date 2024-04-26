<?php
class organizationModel{
    private $db;

    public function __construct(){
        $this->db = new Database();
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

}