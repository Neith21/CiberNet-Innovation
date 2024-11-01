<?php
include '../templates/header.php';
if (!isset($_SESSION["RolID"]) || $_SESSION["RolID"] != 1) {
    header("Location: ../../../index.php");
    exit();
}
?>

<div class="container">
    <div class="card mt-5 p-4">
        <h2 class="mb-4">Lista de Ventas</h2>
        <div class="table-responsive">
            <table id="exportTable" class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Empleado</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Total</th>
                        <th scope="col" class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sales as $sale) : ?>
                        <tr>
                            <td><?= htmlspecialchars($sale['SaleID']); ?></td>
                            <td><?= htmlspecialchars($sale['customerName']); ?></td>
                            <td><?= htmlspecialchars($sale['userName']); ?></td>
                            <td><?= htmlspecialchars($sale['saleDate']); ?></td>
                            <td><?= htmlspecialchars($sale['saleTotal']); ?></td>
                            <td class="text-center">
                                <a href="?action=details&id=<?= $sale['SaleID'] ?>" class="btn btn-warning btn-sm">Ver detalles</a>
                                <a href="?action=delete&id=<?= $sale['SaleID'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../templates/footer.php'; ?>