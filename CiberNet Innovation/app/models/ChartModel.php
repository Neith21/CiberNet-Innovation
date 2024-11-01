<?php
require_once(dirname(__FILE__) . "/../../core/database.php");

class ChartModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getSalesDataForComparison($PID_1, $PID_2) {
        $query = "CALL sp_GraphCompareSalesLast3Months(:PID_1, :PID_2)";
        $result = $this->conn->prepare($query);
        $result->bindParam(':PID_1', $PID_1, PDO::PARAM_INT);
        $result->bindParam(':PID_2', $PID_2, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProducts() {
        $query = "SELECT ProductID, productName FROM product";
        $result = $this->conn->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
