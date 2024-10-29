<div class="container mt-5">
    <div class="card p-4">
        <h2 class="mb-4">Eliminar Rol</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="rolCode" class="form-label">ID del Rol:</label>
                <input type="text" id="rolCode" name="rolCode" value="<?= htmlspecialchars($rol->RolID) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="rolName" class="form-label">Nombre del Rol:</label>
                <input type="text" id="rolName" name="rolName" value="<?= htmlspecialchars($rol->rolName) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="rolInfo" class="form-label">Descripción:</label>
                <textarea id="rolInfo" name="rolInfo" class="form-control" rows="3" disabled><?= htmlspecialchars($rol->rolInfo) ?></textarea>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="confirmDelete" name="confirmDelete" required>
                <label class="form-check-label" for="confirmDelete">
                    He leído que esta acción no es reversible.
                </label>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-danger" id="deleteButton" disabled>Eliminar</button>
                <a href="?pages=rol" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('confirmDelete').addEventListener('change', function() {
        document.getElementById('deleteButton').disabled = !this.checked;
    });
</script>
