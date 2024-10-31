<?php
require_once(dirname(__FILE__) . "/../../config/config.php");
require_once(dirname(__FILE__) . "/../../core/database.php");
require_once(dirname(__FILE__) . "/../models/ChartModel.php");

class ChartController {
    private $db;
    private $chartModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->chartModel = new ChartModel($this->db);
    }

    public function index() {
        $products = $this->chartModel->getProducts();
        include(dirname(__FILE__) . '/../views/charts/compareSalesChart.php');
    }

    public function generateCompareChart() {
        if (isset($_POST['product1']) && isset($_POST['product2'])) {
            $PID_1 = $_POST['product1'];
            $PID_2 = $_POST['product2'];
            $salesData = $this->chartModel->getSalesDataForComparison($PID_1, $PID_2);
            $products = $this->chartModel->getProducts();

            include(dirname(__FILE__) . '/../views/charts/compareSalesChart.php');
        }
    }
}