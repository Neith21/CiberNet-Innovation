<div class="container mt-5">
    <div class="card p-4 shadow">
        <h2 class="mb-4 text-center">Registro de inventario</h2>
        <form action="" method="POST" name="frmCreateInventory" novalidate>
            <div class="mb-3">
                <label for="ProductID" class="form-label">Producto:</label>
                    <select id="ProductID" name="ProductID" class="form-select" required>
                        <option value="">Seleccione un producto</option>
                        <?php foreach ($products as $product): ?>
                            <option value="<?php echo $product['ProductID']; ?>"><?php echo $product['productName']; ?></option>
                        <?php endforeach; ?>
                </select>      
            </div>
            <div class="mb-3">
                <label for="inventoryQty" class="form-label">Cantidad:</label>
                <input type="number" id="inventoryQty" name="inventoryQty" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="typeMovement" class="form-label">Tipo de movimiento:</label>
                <select id="typeMovement" name="typeMovement" class="form-select" required>
                    <option value="">Seleccione el tipo de movimiento</option>
                    <option value="Entrada">Entrada</option>
                    <option value="Salida">Salida</option>
                </select>
            </div>
            <div class="mb-3">
                    <label for="UserID" class="form-label">Usuario:</label>
                    <select id="UserID" name="UserID" class="form-select" required>
                        <option value="">Seleccione un usuario</option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?php echo $user['UserID']; ?>"><?php echo $user['userName']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="?pages=inventory" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</div>
