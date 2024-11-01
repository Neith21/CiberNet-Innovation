<?php
include '../templates/header.php';
if (!isset($_SESSION["RolID"]) || $_SESSION["RolID"] != 1) {
    header("Location: ../../../index.php");
    exit();
}
?>

<div class="container">
    <div class="card mt-5 p-4">
        <h2 class="mb-4">Lista de Detalles de Ventas</h2>
        <div class="d-flex justify-content-between mb-3">
            <a href="./index.php" class="btn btn-success">Regresar</a>
        </div>
        <div class="table-responsive">
            <table id="genericTable" class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Venta ID</th>
                        <th scope="col">Detalle ID</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($saleDetails as $saleDetail) : ?>
                        <tr>
                            <td><?= htmlspecialchars($saleDetail['SaleID']); ?></td>
                            <td><?= htmlspecialchars($saleDetail['SaleDetailID']); ?></td>
                            <td><?= htmlspecialchars($saleDetail['productName']); ?></td>
                            <td><?= htmlspecialchars($saleDetail['unitPrice']); ?></td>
                            <td><?= htmlspecialchars($saleDetail['saleDetailQty']); ?></td>
                            <td><?= htmlspecialchars($saleDetail['subtotal']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../templates/footer.php'; ?>