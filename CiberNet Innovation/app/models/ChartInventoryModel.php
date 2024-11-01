<?php
require_once(dirname(__FILE__) . "/../../core/database.php");

class ChartInventoryModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getInventoryDataByDateRange($startDate, $endDate) {
        $query = "CALL sp_GraphProductsMovement(:startDate, :endDate);";
        
        $result = $this->conn->prepare($query);
        $result->bindParam(':startDate', $startDate);
        $result->bindParam(':endDate', $endDate);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProducts() {
        $query = "SELECT ProductID, productName FROM product";
        $result = $this->conn->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
