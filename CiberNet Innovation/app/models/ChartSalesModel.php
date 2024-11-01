<?php
require_once(dirname(__FILE__) . "/../../core/database.php");

class ChartSalesModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getTopSales($DateID_1, $DateID_2) {
        $query = "CALL sp_GraphMostSelledProducts(:startDate, :endDate);";
        $result = $this->conn->prepare($query);
        $result->bindParam(':startDate', $DateID_1, PDO::PARAM_STR);
        $result->bindParam(':endDate', $DateID_2, PDO::PARAM_STR);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProducts() {
        $query = "SELECT ProductID, productName FROM product";
        $result = $this->conn->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
