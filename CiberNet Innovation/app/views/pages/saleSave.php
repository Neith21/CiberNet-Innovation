<?php
require_once(dirname(__FILE__) . "/../../../config/config.php");
require_once(dirname(__FILE__) . "/../../../core/database.php");
require_once(dirname(__FILE__) . "/../../models/SaleModel.php");
require_once(dirname(__FILE__) . "/../../models/SaleDetailModel.php");

header("Content-Type: application/json");

$db = $database->getConnection();
$sale = new SaleModel($db);
$saleDetail = new SaleDetailModel($db);

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Datos no válidos']);
    exit;
}

try {
    // Guardar la venta
    $sale->customerName = $data['customerName'];
    $sale->saleTotal = $data['saleTotal'];
    $sale->UserID = $_SESSION["UserID"];
    
    if ($sale->create()) {
        $SaleID = $sale->getSaleID();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al crear la venta.']);
        exit;
    }

    // Guardar los detalles de la venta
    foreach ($data['saleDetails'] as $detail) {
        $saleDetail->ProductID = $detail['productId'];
        $saleDetail->saleDetailQty = $detail['qty'];
        $saleDetail->unitPrice = $detail['unitPrice'];
        $saleDetail->SaleID = $SaleID;

        if (!$saleDetail->Create()) {
            throw new Exception('Error al crear el detalle de la venta.');
        }
    }

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
