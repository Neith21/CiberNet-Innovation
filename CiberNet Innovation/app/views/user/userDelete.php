<div class="container mt-5">
    <div class="card p-4">
        <h2 class="mb-4">Eliminar usuario</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="userCode" class="form-label">ID:</label>
                <input type="text" id="userCode" name="userCode" value="<?= htmlspecialchars($user->UserID) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="userName" class="form-label">Nombre de usuario:</label>
                <input type="text" id="userName" name="userName" value="<?= htmlspecialchars($user->userName) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="userEmail" class="form-label">Correo electrónico:</label>
                <input type="text" id="userEmail" name="userEmail" value="<?= htmlspecialchars($user->userEmail) ?>" class="form-control" disabled>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="confirmDelete" name="confirmDelete" required>
                <label class="form-check-label" for="confirmDelete">
                    He leído que esta acción no es reversible.
                </label>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-danger" id="deleteButton" disabled>Eliminar</button>
                <a href="?pages=user" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('confirmDelete').addEventListener('change', function() {
        document.getElementById('deleteButton').disabled = !this.checked;
    });
</script>