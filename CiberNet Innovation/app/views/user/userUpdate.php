<div class="container mt-5">
    <div class="card p-4 shadow-lg">
        <h2 class="mb-4 text-center">Actualizar usuario</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="userName" class="form-label">Nombre:</label>
                <input type="text" id="userName" name="userName" value="<?= htmlspecialchars($users->userName) ?>" class="form-control" required pattern="[A-Za-z\s]+" title="El nombre solo debe contener letras.">
            </div>
            <div class="mb-3">
                <label for="userGender" class="form-label">Género:</label>
                <select id="userGender" name="userGender" class="form-select" required>
                    <option value="">Seleccione género</option>
                    <option value="Masculino" <?= ($users->userGender == 'Masculino') ? 'selected' : '' ?>>Masculino</option>
                    <option value="Femenino" <?= ($users->userGender == 'Femenino') ? 'selected' : '' ?>>Femenino</option>
                    <option value="Otro" <?= ($users->userGender == 'Otro') ? 'selected' : '' ?>>Otro</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="userNickname" class="form-label">Nombre de usuario:</label>
                <input type="text" id="userNickname" name="userNickname" value="<?= htmlspecialchars($users->userNickname) ?>" class="form-control" required pattern="^\S+$" title="No se permiten espacios en blanco en el nombre de usuario.">
            </div>
            <div class="mb-3">
                <label for="userEmail" class="form-label">Correo electrónico:</label>
                <input type="email" id="userEmail" name="userEmail" value="<?= htmlspecialchars($users->userEmail) ?>" class="form-control" required>
            </div>
            <div class="mb-3 input-group">
                <label for="userPassword" class="form-label">Contraseña:</label>
                <input type="password" id="userPassword" name="userPassword" value="<?= htmlspecialchars($users->userPassword) ?>" class="form-control" required>
                <button type="button" class="password-toggle" onclick="togglePassword()">
                    <i id="password-icon" class="fa fa-eye"></i>
                </button>
            </div>
            <div class="mb-3">
                <label for="RolID" class="form-label">Rol:</label>
                <select id="RolID" name="RolID" class="form-select" required>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= $role['RolID'] ?>" <?= ($role['RolID'] == $users->RolID) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($role['rolName']) ?>
                        </option>
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