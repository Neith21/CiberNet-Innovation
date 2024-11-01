<?php
include '../templates/header.php';
require_once(dirname(__FILE__) . "/../../../core/authRol.php");
?>

<div class="container">
    <div class="card mt-5 p-4">
        <h2 class="mb-4">Lista de Roles</h2>
        <div class="d-flex justify-content-between mb-3">
            <a href="?pages=rol&action=create" class="btn btn-success">Crear Rol</a>
        </div>
        <div class="table-responsive">
            <table id="genericTable" class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre del Rol</th>
                        <th scope="col">Descripción</th>
                        <th scope="col" class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($roles as $rol) : ?>
                        <tr>
                            <td><?= htmlspecialchars($rol['RolID']); ?></td>
                            <td><?= htmlspecialchars($rol['rolName']); ?></td>
                            <td><?= htmlspecialchars($rol['rolInfo']); ?></td>
                            <td class="text-center">
                                <a href="?pages=rol&action=edit&id=<?= $rol['RolID'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="?pages=rol&action=delete&id=<?= $rol['RolID'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../templates/footer.php'; ?>