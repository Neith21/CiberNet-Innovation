<?php include '../templates/header.php'; ?>

<div class="container mt-5">
    <div class="card p-4 shadow-lg">
        <h2 class="mb-4 text-center">Actualizar Proveedor</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="supplierName" class="form-label">Nombre del Proveedor:</label>
                <input type="text" id="supplierName" name="supplierName" value="<?= htmlspecialchars($supplier->supplierName) ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="supplierPhone" class="form-label">Teléfono:</label>
                <input type="text" id="supplierPhone" name="supplierPhone" value="<?= htmlspecialchars($supplier->supplierPhone) ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="supplierAddress" class="form-label">Dirección:</label>
                <textarea id="supplierAddress" name="supplierAddress" class="form-control" rows="3" required><?= htmlspecialchars($supplier->supplierAddress) ?></textarea>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="?pages=supplier" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?php include '../templates/footer.php'; ?>