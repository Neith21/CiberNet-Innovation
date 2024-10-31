<?php include '../templates/header.php'; ?>

<div class="container mt-5">
    <div class="card p-4 shadow-lg">
        <h2 class="mb-4 text-center">Actualizar registro</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="ProductID" class="form-label">Producto:</label>
                <select id="ProductID" name="ProductID" class="form-select" required>
                    <?php foreach ($products as $product): ?>
                        <option value="<?= $product['ProductID'] ?>" <?= ($product['ProductID'] == $inventories->ProductID) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($product['productName']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="inventoryQty" class="form-label">Cantidad:</label>
                <input type="number" id="inventoryQty" name="inventoryQty" value="<?= htmlspecialchars($inventories->inventoryQty) ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="typeMovement" class="form-label">Movimiento:</label>
                <select id="typeMovement" name="typeMovement" class="form-select" required>
                    <option value="">Seleccione el movimiento</option>
                    <option value="Entrada" <?= ($inventories->typeMovement == 'Entrada') ? 'selected' : '' ?>>Entrada</option>
                    <option value="Salida" <?= ($inventories->typeMovement == 'Salida') ? 'selected' : '' ?>>Salida</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="UserID" class="form-label">Usuario:</label>
                <select id="UserID" name="UserID" class="form-select" required>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user['UserID'] ?>" <?= ($user['UserID'] == $inventories->UserID) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($user['userName']) ?>
                        </option>
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

<?php include '../templates/footer.php'; ?>