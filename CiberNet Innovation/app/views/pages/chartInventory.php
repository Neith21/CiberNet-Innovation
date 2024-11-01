<?php
require_once __DIR__ . '/../../../app/controllers/ChartInventoryController.php';

$action = isset($_POST['action']) ? $_POST['action'] : 'index';
$controller = new ChartInventoryController();

switch ($action) {
    case 'generateInventoryChart':
        $controller->generateInventoryChart();
        break;
    default:
        $controller->index();
        break;
}
