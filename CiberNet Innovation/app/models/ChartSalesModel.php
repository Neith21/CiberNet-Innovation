<?php
require_once(dirname(__FILE__) . "/../../core/database.php");

class ChartSalesModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getTopSales($DateID_1, $DateID_2) {
        $query = "
            SELECT product.productName, SUM(saledetail.saleDetailQty) as totalSales
            FROM saledetail
            JOIN product ON product.ProductID = saledetail.ProductID
            JOIN sale ON sale.SaleID = saledetail.SaleID
            WHERE sale.saleDate BETWEEN :start_date AND :end_date
            GROUP BY product.productName
            LIMIT 10;
        ";
        $result = $this->conn->prepare($query);
        $result->bindParam(':start_date', $DateID_1, PDO::PARAM_STR);
        $result->bindParam(':end_date', $DateID_2, PDO::PARAM_STR);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProducts() {
        $query = "SELECT ProductID, productName FROM product";
        $result = $this->conn->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
