<div class="container mt-5">
    <div class="card p-4 shadow">
        <h2 class="mb-4 text-center">Edicion de Productos</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="productName" class="form-label">Nombre del Producto:</label>
                <input type="text" id="productName" name="productName" class="form-control" value="<?= htmlspecialchars($products->productName) ?>"  required>
            </div>
            <div class="mb-3">
                <label for="productInfo" class="form-label">Descripción:</label>
                <textarea id="productInfo" name="productInfo" class="form-control" rows="3" required><?= htmlspecialchars($products->productInfo) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="productPrice" class="form-label">Precio del Producto:</label>
                <input type="text" id="productPrice" name="productPrice" class="form-control" value="<?= htmlspecialchars($products->productPrice) ?>" required>
            </div>
            <div class="mb-3">
                <label for="productPresentation" class="form-label">Presentacion del Producto:</label>
                <input type="text" id="productPresentation" name="productPresentation" class="form-control" value="<?= htmlspecialchars($products->productPresentation) ?>" required>
            </div>
            <div class="mb-3">
                <label for="CategoryID" class="form-label">Categoria del Producto:</label>
                <select id="CategoryID" name="CategoryID" class="form-select" required>
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
                <select id="SupplierID" name="SupplierID" class="form-select" required>
                    <option value="">Seleccione el Proveedor del Producto</option>
                    <?php foreach ($suppliers as $supplier): ?>
                        <option value="<?php echo $supplier['SupplierID']; ?>" <?= ($supplier['SupplierID'] == $products->SupplierID) ? 'selected' : '' ?>>
                            <?php echo $supplier['supplierName']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="?pages=product" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</div>
