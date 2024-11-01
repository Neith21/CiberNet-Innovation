<?php
if (!isset($_SESSION["RolID"]) || $_SESSION["RolID"] != 1) {
    header("Location: index.php");
    exit();
}
