<?php
session_start();

if (isset($_SESSION["userName"])) {
    $_SESSION["LAST_ACTIVITY"] = time();
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}
