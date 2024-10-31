<?php include '../templates/header.php'; ?>

<div class="container mt-5">
    <div class="card p-4">
        <h2 class="mb-4">Eliminar Proveedor</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="supplierID" class="form-label">ID del Proveedor:</label>
                <input type="text" id="supplierID" name="supplierID" value="<?= htmlspecialchars($supplier->SupplierID) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="supplierName" class="form-label">Nombre del Proveedor:</label>
                <input type="text" id="supplierName" name="supplierName" value="<?= htmlspecialchars($supplier->supplierName) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="supplierPhone" class="form-label">Teléfono:</label>
                <input type="text" id="supplierPhone" name="supplierPhone" value="<?= htmlspecialchars($supplier->supplierPhone) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="supplierAddress" class="form-label">Dirección:</label>
                <textarea id="supplierAddress" name="supplierAddress" class="form-control" rows="3" disabled><?= htmlspecialchars($supplier->supplierAddress) ?></textarea>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="confirmDelete" name="confirmDelete" required>
                <label class="form-check-label" for="confirmDelete">
                    He leído que esta acción no es reversible.
                </label>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-danger" id="deleteButton" disabled>Eliminar</button>
                <a href="?pages=supplier" class="btn btn-secondary">Cancelar</a>
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