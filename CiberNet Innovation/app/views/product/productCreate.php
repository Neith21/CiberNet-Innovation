<?php include '../templates/header.php'; ?>

<div class="container mt-5">
    <div class="card p-4 shadow">
        <h2 class="mb-4 text-center">Creación de Productos</h2>
        <form action="" method="POST" name="frmCreateProduct" novalidate>
            <div class="mb-3">
                <label for="productName" class="form-label">Nombre del Producto:</label>
                <input type="text" id="productName" name="productName" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="productInfo" class="form-label">Descripción:</label>
                <textarea id="productInfo" name="productInfo" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="productPrice" class="form-label">Precio del Producto:</label>
                <input type="text" id="productPrice" name="productPrice" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="productPresentation" class="form-label">Presentacion del Producto:</label>
                <input type="text" id="productPresentation" name="productPresentation" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="CategoryID" class="form-label">Categoria del Producto:</label>
                <select id="CategoryID" name="CategoryID" class="form-select" required>
                    <option value="">Seleccione la Categoria del Producto</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['CategoryID']; ?>"><?php echo $category['categoryName']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="SupplierID" class="form-label">Proveedor del Producto:</label>
                <select id="SupplierID" name="SupplierID" class="form-select" required>
                    <option value="">Seleccione el Proveedor del Producto</option>
                    <?php foreach ($suppliers as $supplier): ?>
                        <option value="<?php echo $supplier['SupplierID']; ?>"><?php echo $supplier['supplierName']; ?></option>
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

<?php include '../templates/footer.php'; ?>