<?php

session_start();

if (!isset($_SESSION['userName']) || $_SESSION['userName'] == "") {
    header("Location: ../../../index.php");
    exit();
}


require_once(dirname(__FILE__) . "/../../../config/config.php");
require_once(dirname(__FILE__) . "/../../../core/database.php");
require_once(dirname(__FILE__) . "/../../models/SaleModel.php");
require_once(dirname(__FILE__) . "/../../models/SaleDetailModel.php");

$database = new Database();
$db = $database->getConnection();
$sale = new SaleModel($db);
$saleDetail = new SaleDetailModel($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibe los datos
    $customerName = $_POST['customerName'];
    $saleTotal = $_POST['total']; // Ahora debería tener un valor válido
    $UserID = $_SESSION["UserID"];

    // Asegúrate de que $saleTotal sea un número decimal válido
    if (empty($saleTotal) || !is_numeric($saleTotal)) {
        // Manejo de error: puedes redirigir o mostrar un mensaje
        die("Error: El total de la venta no es válido.");
    }

    // Crea la venta
    $sale->customerName = $customerName;
    $sale->saleTotal = (float) $saleTotal; // Convierte a float
    $sale->UserID = $UserID;

    $sale->create();
    $SaleID = $sale->getSaleID();

    // Procesa los detalles de venta
    $saleDetails = json_decode($_POST['saleDetails'], true); // Decodifica el JSON recibido
    foreach ($saleDetails as $detail) {
        $saleDetail->ProductID = $detail['productId'];
        $saleDetail->saleDetailQty = $detail['productQty'];
        $saleDetail->unitPrice = $detail['productPrice'];
        $saleDetail->SaleID = $SaleID;

        $saleDetail->Create();
    }

    // Redirigir o mostrar un mensaje de éxito
    header("Location: sale.php");
        exit();
}

?>
