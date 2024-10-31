<?php include '../templates/header.php'; ?>

<div class="container">
    <div class="card mt-5 p-4">
        <h2 class="mb-4">Proveedores</h2>
        <div class="d-flex justify-content-between mb-3">
            <a href="?pages=supplier&action=create" class="btn btn-success">Crear Proveedor</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Dirección</th>
                        <th scope="col" class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($suppliers as $supplier) : ?>
                        <tr>
                            <td><?= htmlspecialchars($supplier['SupplierID']); ?></td>
                            <td><?= htmlspecialchars($supplier['supplierName']); ?></td>
                            <td><?= htmlspecialchars($supplier['supplierPhone']); ?></td>
                            <td><?= htmlspecialchars($supplier['supplierAddress']); ?></td>
                            <td class="text-center">
                                <a href="?pages=supplier&action=edit&id=<?= $supplier['SupplierID'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="?pages=supplier&action=delete&id=<?= $supplier['SupplierID'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../templates/footer.php'; ?>