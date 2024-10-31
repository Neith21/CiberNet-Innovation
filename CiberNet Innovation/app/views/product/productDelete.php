<?php include '../templates/header.php'; ?>

<div class="container mt-5">
    <div class="card p-4">
        <h2 class="mb-4">Eliminar Producto</h2>
        <form action="" method="POST">
        <div class="mb-3">
                <label for="productName" class="form-label">Nombre del Producto:</label>
                <input type="text" id="productName" name="productName" class="form-control" value="<?= htmlspecialchars($products->productName) ?>"  disable>
            </div>
            <div class="mb-3">
                <label for="productInfo" class="form-label">Descripción:</label>
                <textarea id="productInfo" name="productInfo" class="form-control" rows="3" disable><?= htmlspecialchars($products->productInfo) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="productPrice" class="form-label">Precio del Producto:</label>
                <input type="text" id="productPrice" name="productPrice" class="form-control" value="<?= htmlspecialchars($products->productPrice) ?>" disable>
            </div>
            <div class="mb-3">
                <label for="productPresentation" class="form-label">Presentacion del Producto:</label>
                <input type="text" id="productPresentation" name="productPresentation" class="form-control" value="<?= htmlspecialchars($products->productPresentation) ?>" disable>
            </div>
            <div class="mb-3">
                <label for="CategoryID" class="form-label">Categoria del Producto:</label>
                <select id="CategoryID" name="CategoryID" class="form-select" disable>
                    <option value="">Seleccione la Categoria del Producto</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['CategoryID']; ?>" <?= ($category['CategoryID'] == $products->CategoryID) ? 'selected' : '' ?>>
                            <?php echo $category['categoryName']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="SupplierID" class="form-label">Proveedor del Producto:</label>
                <select id="SupplierID" name="SupplierID" class="form-select" disable>
                    <option value="">Seleccione el Proveedor del Producto</option>
                    <?php foreach ($suppliers as $supplier): ?>
                        <option value="<?php echo $supplier['SupplierID']; ?>" <?= ($supplier['SupplierID'] == $products->SupplierID) ? 'selected' : '' ?>>
                            <?php echo $supplier['supplierName']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="confirmDelete" name="confirmDelete" required>
                <label class="form-check-label" for="confirmDelete">
                    He leído que esta acción no es reversible.
                </label>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-danger" id="deleteButton" disabled>Eliminar</button>
                <a href="?pages=product" class="btn btn-secondary">Cancelar</a>
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