<?php
require_once __DIR__ . '/../../../app/controllers/ChartController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$controller = new ChartController();

switch ($action) {
    case 'generateChart':
        $controller->generateCompareChart();
        break;
    default:
        $controller->index();
        break;
}