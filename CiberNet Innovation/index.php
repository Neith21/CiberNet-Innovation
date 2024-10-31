<?php
session_start();

if (isset($_SESSION['userName']) && !empty($_SESSION['userName'])) {
  header("Location: ./app/views/pages/index.php");
  exit();
}

require_once __DIR__ . '/core/auth.php';

$auth = new Auth();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $auth->authenticate();
}

?>

<!DOCTYPE html>

<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign in Form</title>
  <link rel="stylesheet" href="./public/login/login.css" />
</head>

<body>
  <main>
    <div class="box">
      <div class="inner-box">
        <div class="forms-wrap">
          <form action="" method="POST" autocomplete="off" class="sign-in-form">
            <div class="logo">
              <img src="./public/login/img/logo.png" alt="logo" />
              <h4>CiberNet Innovation</h4>
            </div>

            <div class="heading">
              <h2>Bienvenido de Nuevo</h2>
            </div>

            <div class="actual-form">
              <div class="input-wrap">
                <input type="text" name="userNickname" class="input-field" autocomplete="off" required />
                <label>Usuario</label>
              </div>

              <div class="input-wrap">
                <input type="password" name="userPassword" class="input-field" autocomplete="off" required />
                <label>Contraseña</label>
              </div>

              <input type="submit" value="Iniciar Sesión" class="sign-btn" />
            </div>
            <?php
            if (isset($error)) {
              echo '<p style="color:red;">' . htmlspecialchars($error) . '</p>';
            }
            ?>
          </form>
        </div>

        <div class="carousel">
          <div class="images-wrapper">
            <img src="./public/login/img/image1.png" class="image img-1 show" alt="" />
            <img src="./public/login/img/image2.png" class="image img-2" alt="" />
            <img src="./public/login//img/image3.png" class="image img-3" alt="" />
          </div>

          <div class="text-slider">
            <div class="text-wrap">
              <div class="text-group">
                <h2>Crea tus reportes</h2>
                <h2>Personalizalo a tu manera</h2>
                <h2>Primero eres tú</h2>
              </div>
            </div>

            <div class="bullets">
              <span class="active" data-value="1"></span>
              <span data-value="2"></span>
              <span data-value="3"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="./public/login/login.js"></script>
</body>

</html>