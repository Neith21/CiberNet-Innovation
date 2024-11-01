<?php
require_once __DIR__ . '/../../../app/controllers/SaleController.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

$controller = new SaleController();

switch ($action) {
    case 'details':
        if ($id) {
            $controller->getSaleDetails($id);
        } else {
            $controller->index();
        }
        break;

    case 'delete':
        if ($id) {
            $controller->delete($id);
        } else {
            $controller->index();
        }
        break;

    default:
        $controller->index();
        break;
}
