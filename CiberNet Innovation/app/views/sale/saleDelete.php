<?php
include '../templates/header.php';
if (!isset($_SESSION["RolID"]) || $_SESSION["RolID"] != 1) {
    header("Location: ../../../index.php");
    exit();
}
?>

<div class="container mt-5">
    <div class="card p-4">
        <h2 class="mb-4">Eliminar venta</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="userCode" class="form-label">ID:</label>
                <input type="text" id="userCode" name="userCode" value="<?= htmlspecialchars($sale->SaleID) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="userName" class="form-label">Cliente:</label>
                <input type="text" id="userName" name="userName" value="<?= htmlspecialchars($sale->customerName) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="userEmail" class="form-label">Empleado ID:</label>
                <input type="text" id="userEmail" name="userEmail" value="<?= htmlspecialchars($sale->UserID) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="userEmail" class="form-label">Fecha:</label>
                <input type="text" id="userEmail" name="userEmail" value="<?= htmlspecialchars($sale->saleDate) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="userEmail" class="form-label">Total:</label>
                <input type="text" id="userEmail" name="userEmail" value="<?= htmlspecialchars($sale->saleTotal) ?>" class="form-control" disabled>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="confirmDelete" name="confirmDelete" required>
                <label class="form-check-label" for="confirmDelete">
                    He leído que esta acción no es reversible.
                </label>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-danger" id="deleteButton" disabled>Eliminar</button>
                <a href="./index.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('confirmDelete').addEventListener('change', function() {
        document.getElementById('deleteButton').disabled = !this.checked;
    });
</script>

<?php include '../templates/footer.php'; ?>