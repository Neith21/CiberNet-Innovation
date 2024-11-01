<?php include '../templates/header.php'; ?>

<div class="container">
    <div class="card mt-5 p-4">
        <h2 class="mb-4">Categorías</h2>
        <div class="d-flex justify-content-between mb-3">
            <a href="?pages=category&action=create" class="btn btn-success">Crear Categoría</a>
        </div>
        <div class="table-responsive">
            <table id="genericTable" class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre de la Categoría</th>
                        <th scope="col">Información</th>
                        <th scope="col" class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category) : ?>
                        <tr>
                            <td><?= htmlspecialchars($category['CategoryID']); ?></td>
                            <td><?= htmlspecialchars($category['categoryName']); ?></td>
                            <td><?= htmlspecialchars($category['categoryInfo']); ?></td>
                            <td class="text-center">
                                <a href="?pages=category&action=edit&id=<?= $category['CategoryID'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="?pages=category&action=delete&id=<?= $category['CategoryID'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../templates/footer.php'; ?>