<?php
require_once(dirname(__FILE__) . "/../config/config.php");
require_once(dirname(__FILE__) . "/database.php");
require_once(dirname(__FILE__) . "/../app/models/UserModel.php");

class Auth
{
    private $db;
    private $user;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new UserModel($this->db);
    }

    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userNickname = htmlspecialchars(strip_tags($_POST['userNickname']));
            $userPassword = md5(htmlspecialchars(strip_tags($_POST['userPassword'])));

            $query = "SELECT * FROM User WHERE userNickname = :userNickname AND userPassword = :userPassword";
            $result = $this->db->prepare($query);
            $result->bindParam(":userNickname", $userNickname);
            $result->bindParam(":userPassword", $userPassword);
            $result->execute();

            if ($result->rowCount() == 1) {
                $userData = $result->fetch(PDO::FETCH_ASSOC);

                session_start();
                $_SESSION["UserID"] = $userData['UserID'];
                $_SESSION["userName"] = $userData['userName'];
                $_SESSION["RolID"] = $userData['RolID'];
                $_SESSION["LAST_ACTIVITY"] = time();
                header("Location: /CiberNet%20Innovation/index.php");
                exit();
            } else {
                $error = "Inicio de sesión fallido";
            }
        }
    }
}
