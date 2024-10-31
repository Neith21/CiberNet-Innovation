<?php
require_once(dirname(__FILE__) . "/../../core/database.php");

class ChartModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getSalesDataForComparison($PID_1, $PID_2) {
        $query = "
            SELECT product.productName, SUM(saledetail.saleDetailQty) as totalSales
            FROM saledetail
            JOIN product ON product.ProductID = saledetail.ProductID
            JOIN sale ON sale.SaleID = saledetail.SaleID
            WHERE saledetail.ProductID IN (:PID_1, :PID_2)
              AND sale.saleDate >= DATE_SUB(CURRENT_DATE, INTERVAL 3 MONTH)
            GROUP BY product.productName
        ";
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
