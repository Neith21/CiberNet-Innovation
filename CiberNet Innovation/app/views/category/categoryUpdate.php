<?php include '../templates/header.php'; ?>

<div class="container mt-5">
    <div class="card p-4 shadow-lg">
        <h2 class="mb-4 text-center">Actualizar Categoría</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="categoryName" class="form-label">Nombre de la Categoría:</label>
                <input type="text" id="categoryName" name="categoryName" value="<?= htmlspecialchars($category->categoryName) ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="categoryInfo" class="form-label">Información:</label>
                <textarea id="categoryInfo" name="categoryInfo" class="form-control" rows="3" required><?= htmlspecialchars($category->categoryInfo) ?></textarea>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="?pages=category" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?php include '../templates/footer.php'; ?>