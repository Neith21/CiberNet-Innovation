<?php
require_once __DIR__ . '/../../../app/controllers/SaleController.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

$controller = new SaleController();

switch ($action) {
    case 'create':
        $controller->create();
        break;

    default:
        $controller->index();
        break;
}
