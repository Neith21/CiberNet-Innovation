<?php
require_once(dirname(__FILE__) . "/../../config/config.php");
require_once(dirname(__FILE__) . "/../../core/database.php");
require_once(dirname(__FILE__) . "/../models/ChartInventoryModel.php");

class ChartInventoryController {
    private $db;
    private $chartInventoryModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->chartInventoryModel = new ChartInventoryModel($this->db);
    }

    public function index() {
        $products = $this->chartInventoryModel->getProducts();
        include(dirname(__FILE__) . '/../views/chartInventory/chartInventoryMovement.php');
    }

    public function generateInventoryChart() {
        if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
            $startDate = $_POST['start_date'];
            $endDate = $_POST['end_date'];

            $inventoryData = $this->chartInventoryModel->getInventoryDataByDateRange($startDate, $endDate);
            $products = $this->chartInventoryModel->getProducts();

            $productNames = [];
            $netInventoryMovements = [];

            foreach ($inventoryData as $row) {
                $productNames[] = $row['productName'];
                $netInventoryMovements[] = (int)$row['netMovement'];
            }

            header('Content-Type: application/json');
            echo json_encode([
                'productNames' => $productNames,
                'netInventoryMovements' => $netInventoryMovements
            ]);
        }
    }
}
