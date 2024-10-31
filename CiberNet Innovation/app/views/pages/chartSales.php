<?php
require_once __DIR__ . '/../../../app/controllers/ChartSalesController.php';

$action = isset($_POST['action']) ? $_POST['action'] : 'index';
$controller = new ChartSalesController();

switch ($action) {
    case 'generateChart':
        $controller->generateChart();
        break;
    default:
        $controller->index();
        break;
}