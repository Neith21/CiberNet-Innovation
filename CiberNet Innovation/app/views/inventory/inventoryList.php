<div class="container">
    <div class="card mt-5 p-4">
        <h2 class="mb-4">Inventario</h2>
        <div class="d-flex justify-content-between mb-3">
            <a href="?pages=inventory&action=create" class="btn btn-success">Crear registro</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Ultimo movimiento</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Usuario</th>
                        <th scope="col" class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inventories as $inventory) : ?>
                        <tr>
                            <td><?= htmlspecialchars($inventory['InventoryID']); ?></td>
                            <td><?= htmlspecialchars($inventory['productName']); ?></td>
                            <td><?= htmlspecialchars($inventory['inventoryQty']); ?></td>
                            <td><?= htmlspecialchars($inventory['typeMovement']); ?></td>
                            <td><?= htmlspecialchars($inventory['inventoryDate']); ?></td>
                            <td><?= htmlspecialchars($inventory['userName']); ?></td>
                            <td class="text-center">
                                <a href="?pages=inventory&action=edit&id=<?= $inventory['InventoryID'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="?pages=inventory&action=delete&id=<?= $inventory['InventoryID'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
