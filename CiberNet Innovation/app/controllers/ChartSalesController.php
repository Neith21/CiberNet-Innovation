<?php
require_once(dirname(__FILE__) . "/../../config/config.php");
require_once(dirname(__FILE__) . "/../../core/database.php");
require_once(dirname(__FILE__) . "/../models/ChartSalesModel.php");

class ChartSalesController {
    private $db;
    private $chartSalesModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->chartSalesModel = new ChartSalesModel($this->db);
    }

    public function index() {
        $product = $this->chartSalesModel->getProducts();
        include(dirname(__FILE__) . '/../views/chartSales/chartTopSales.php');
    }

    public function generateChart() {
        if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
            $PID_1 = $_POST['start_date'];
            $PID_2 = $_POST['end_date'];

            $salesData = $this->chartSalesModel->getTopSales($PID_1, $PID_2);
            $products = $this->chartSalesModel->getProducts();

            $categories = [];
            $data = [];
            foreach ($salesData as $row) {
                $categories[] = $row['productName'];
                $data[] = (int)$row['totalSales'];
            }

            // Devolver los datos en formato JSON
            header('Content-Type: application/json');
            echo json_encode([
                'categories' => $categories,
                'data' => $data
            ]);
        }
    }
}