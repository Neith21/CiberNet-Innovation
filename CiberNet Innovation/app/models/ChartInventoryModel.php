<?php
require_once(dirname(__FILE__) . "/../../core/database.php");

class ChartInventoryModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getInventoryDataByDateRange($startDate, $endDate) {
        $query = "
            SELECT 
                product.productName, 
                SUM(CASE WHEN inventory.typeMovement = 'Entrada' THEN inventory.inventoryQty ELSE -inventory.inventoryQty END) as netMovement
            FROM inventory
            JOIN product ON product.ProductID = inventory.ProductID
            WHERE inventory.inventoryDate BETWEEN :startDate AND :endDate
            GROUP BY product.productName
        ";
        
        $result = $this->conn->prepare($query);
        $result->bindParam(':startDate', $startDate);
        $result->bindParam(':endDate', $endDate);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para obtener la lista de productos
    public function getProducts() {
        $query = "SELECT ProductID, productName FROM product";
        $result = $this->conn->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
