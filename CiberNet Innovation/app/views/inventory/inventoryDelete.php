<div class="container mt-5">
    <div class="card p-4">
        <h2 class="mb-4">Eliminar registro</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="productName" class="form-label">Producto:</label>
                <input type="text" id="productName" name="productName" value="<?= htmlspecialchars($inventories->productName) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="inventoryQty" class="form-label">Cantidad:</label>
                <input type="number" id="inventoryQty" name="inventoryQty" value="<?= htmlspecialchars($inventories->inventoryQty) ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="typeMovement" class="form-label">Tipo de movimiento:</label>
                <input type="text" id="typeMovement" name="typeMovement" value="<?= htmlspecialchars($inventories->typeMovement) ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="inventoryDate" class="form-label">Fecha:</label>
                <input type="text" id="inventoryDate" name="inventoryDate" value="<?= htmlspecialchars($inventories->inventoryDate) ?>" disabled>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="confirmDelete" name="confirmDelete" required>
                <label class="form-check-label" for="confirmDelete">
                    He leído que esta acción no es reversible.
                </label>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-danger" id="deleteButton" disabled>Eliminar</button>
                <a href="?pages=inventory" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('confirmDelete').addEventListener('change', function() {
        document.getElementById('deleteButton').disabled = !this.checked;
    });
</script>
