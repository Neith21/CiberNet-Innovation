<div class="container">
    <div class="card mt-5 p-4">
        <h2 class="mb-4">Productos</h2>
        <div class="d-flex justify-content-between mb-3">
            <a href="?pages=product&action=create" class="btn btn-success">Crear registro</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID Producto</th>
                        <th scope="col">Nombre Producto</th>
                        <th scope="col">Informacion Producto</th>
                        <th scope="col">Precio Producto</th>
                        <th scope="col">Presentacion Producto</th>
                        <th scope="col">Categoria Producto</th>
                        <th scope="col">Proveedor Producto</th>
                        <th scope="col" class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product) : ?>
                        <tr>
                            <td><?= htmlspecialchars($product['ProductID']); ?></td>
                            <td><?= htmlspecialchars($product['productName']); ?></td>
                            <td><?= htmlspecialchars($product['productInfo']); ?></td>
                            <td><?= htmlspecialchars($product['productPrice']); ?></td>
                            <td><?= htmlspecialchars($product['productPresentation']); ?></td>
                            <td><?= htmlspecialchars($product['categoryName']); ?></td>
                            <td><?= htmlspecialchars($product['supplierName']); ?></td>
                            <td class="text-center">
                                <a href="?pages=product&action=edit&id=<?= $product['ProductID'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="?pages=product&action=delete&id=<?= $product['ProductID'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
