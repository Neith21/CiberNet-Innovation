<?php
session_start();

if (isset($_SESSION['userName'])) {
    session_unset();
    session_destroy();

    header('Location: ./app/views/pages/login.php');
    exit();
} else {
    header('Location: ./app/views/pages/login.php');
    exit();
}
?>