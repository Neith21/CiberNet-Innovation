<div class="container">
    <div class="card mt-5 p-4">
        <h2 class="mb-4">Lista de usuarios</h2>
        <div class="d-flex justify-content-between mb-3">
            <a href="?pages=user&action=create" class="btn btn-success">Crear usuario</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Género</th>
                        <th scope="col">UserName</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Contraseña</th>
                        <th scope="col">Rol</th>
                        <th scope="col" class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?= htmlspecialchars($user['UserID']); ?></td>
                            <td><?= htmlspecialchars($user['userName']); ?></td>
                            <td><?= htmlspecialchars($user['userGender']); ?></td>
                            <td><?= htmlspecialchars($user['userNickname']); ?></td>
                            <td><?= htmlspecialchars($user['userEmail']); ?></td>
                            <td>
                                <span id="password-<?= $user['UserID'] ?>" class="password-value">********</span>
                                <button type="button" class="btn password-toggle" onclick="togglePassword(<?= $user['UserID'] ?>)">
                                    <i id="password-icon-<?= $user['UserID'] ?>" class="fa fa-eye"></i>
                                </button>
                                <input type="hidden" id="password-raw-<?= $user['UserID'] ?>" value="<?= htmlspecialchars($user['userPassword']); ?>">
                            </td>
                            <td><?= htmlspecialchars($user['rolName']); ?></td>
                            <td class="text-center">
                                <a href="?pages=user&action=edit&id=<?= $user['UserID'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="?pages=user&action=delete&id=<?= $user['UserID'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function togglePassword(userId) {
        var passwordElement = document.getElementById('password-' + userId);
        var passwordInput = document.getElementById('password-raw-' + userId);
        var button = document.getElementById('password-icon-' + userId);

        if (passwordElement.textContent === '********') {
            passwordElement.textContent = hex_md5(passwordInput.value);
            button.classList.remove('fa-eye');
            button.classList.add('fa-eye-slash');
        } else {
            passwordElement.textContent = '********';
            button.classList.remove('fa-eye-slash');
            button.classList.add('fa-eye');
        }
    }

    function hex_md5(str) {
        return str;
    }
</script>