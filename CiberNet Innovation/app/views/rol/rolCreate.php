<?php include '../templates/header.php'; ?>

<div class="container mt-5">
    <div class="card p-4 shadow">
        <h2 class="mb-4 text-center">Creación de Rol</h2>
        <form action="" method="POST" name="frmCreateRol" novalidate>
            <div class="mb-3">
                <label for="rolName" class="form-label">Nombre del Rol:</label>
                <input type="text" id="rolName" name="rolName" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="rolInfo" class="form-label">Descripción:</label>
                <textarea id="rolInfo" name="rolInfo" class="form-control" rows="3" required></textarea>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="?pages=rol" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?php include '../templates/footer.php'; ?>