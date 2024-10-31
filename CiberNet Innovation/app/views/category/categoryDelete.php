<?php include '../templates/header.php'; ?>

<div class="container mt-5">
    <div class="card p-4">
        <h2 class="mb-4">Eliminar Categoría</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="categoryID" class="form-label">ID de la Categoría:</label>
                <input type="text" id="categoryID" name="categoryID" value="<?= htmlspecialchars($category->CategoryID) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="categoryName" class="form-label">Nombre de la Categoría:</label>
                <input type="text" id="categoryName" name="categoryName" value="<?= htmlspecialchars($category->categoryName) ?>" class="form-control" disabled>
            </div>
            <div class="mb-3">
                <label for="categoryInfo" class="form-label">Información:</label>
                <textarea id="categoryInfo" name="categoryInfo" class="form-control" rows="3" disabled><?= htmlspecialchars($category->categoryInfo) ?></textarea>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="confirmDelete" name="confirmDelete" required>
                <label class="form-check-label" for="confirmDelete">
                    He leído que esta acción no es reversible.
                </label>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-danger" id="deleteButton" disabled>Eliminar</button>
                <a href="?pages=category" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('confirmDelete').addEventListener('change', function() {
        document.getElementById('deleteButton').disabled = !this.checked;
    });
</script>

<?php include '../templates/footer.php'; ?>