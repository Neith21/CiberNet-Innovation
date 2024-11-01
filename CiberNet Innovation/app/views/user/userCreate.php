<?php
include '../templates/header.php';
require_once(dirname(__FILE__) . "/../../../core/authRol.php");
?>

<div class="container mt-5">
    <div class="card p-4 shadow">
        <h2 class="mb-4 text-center">Creación de usuario</h2>
        <form action="" method="POST" name="frmCreate" novalidate>
            <div class="mb-3">
                <label for="userName" class="form-label">Nombre:</label>
                <input type="text" id="userName" name="userName" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="userGender" class="form-label">Género:</label>
                <select id="userGender" name="userGender" class="form-select" required>
                    <option value="">Seleccione género</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="userNickname" class="form-label">Nombre de usuario:</label>
                <input type="text" id="userNickname" name="userNickname" class="form-control" required pattern="^\S+$" title="No se permiten espacios">
            </div>
            <div class="mb-3">
                <label for="userEmail" class="form-label">Correo:</label>
                <input type="email" id="userEmail" name="userEmail" class="form-control" required>
            </div>   
            <div class="mb-3 input-group">
                <label for="userPassword" class="form-label">Contraseña:</label>
                <input type="password" id="userPassword" name="userPassword" class="form-control" required>
                <button type="button" class="password-toggle" onclick="togglePassword()">
                    <i id="password-icon" class="fa fa-eye"></i>
                </button>
            </div>
            <div class="mb-3">
                <label for="RolID" class="form-label">Rol:</label>
                <select id="RolID" name="RolID" class="form-select" required>
                    <option value="">Seleccione un rol</option>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?php echo $role['RolID']; ?>"><?php echo $role['rolName']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="?pages=user" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<script>
    function togglePassword() {
        var passwordInput = document.getElementById('userPassword');
        var icon = document.getElementById('password-icon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>

<?php include '../templates/footer.php'; ?>