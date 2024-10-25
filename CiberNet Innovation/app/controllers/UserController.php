<?php
require_once(dirname(__FILE__) . "/../../config/config.php");
require_once(dirname(__FILE__) . "/../../core/database.php");
require_once(dirname(__FILE__) . "/../models/UserModel.php");

class UserController
{
    private $db;
    private $user;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();

        $this->user = new UserModel($this->db);
    }

    public function index()
    {
        $result = $this->user->getUsers();
        $users = $result->fetchAll(PDO::FETCH_ASSOC);
        include(dirname(__FILE__) . '/../views/user/userList.php');
    }

    public function create()
    {
        if ($_POST) {
            $this->user->userName = $_POST['userName'];
            $this->user->userGender = $_POST['userGender'];
            $this->user->userNickname = $_POST['userNickname'];
            $this->user->userEmail = $_POST['userEmail'];
            $this->user->userPassword = $_POST['userPassword'];
            $this->user->RolID = $_POST['RolID'];

            header("Location: ?pages=user");
            return $this->user->create();
        }
        $rolesResult = $this->user->getRoles();
        $roles = $rolesResult->fetchAll(PDO::FETCH_ASSOC);
        include(dirname(__FILE__) . '/../views/user/userCreate.php');
    }

    public function edit($id)
    {
        $this->user->UserID = $id;
        $this->user->getUserByID();

        if ($_POST) {
            $this->user->userName = $_POST['userName'];
            $this->user->userGender = $_POST['userGender'];
            $this->user->userNickname = $_POST['userNickname'];
            $this->user->userEmail = $_POST['userEmail'];
            $this->user->userPassword = $_POST['userPassword'];
            $this->user->RolID = $_POST['RolID'];

            header("Location: ?pages=user");
            return $this->user->update();
        }
        $rolesResult = $this->user->getRoles();
        $roles = $rolesResult->fetchAll(PDO::FETCH_ASSOC);
        $users = $this->user;
        include(dirname(__FILE__) . '/../views/user/userUpdate.php');
    }

    public function delete($id)
    {
        $this->user->UserID = $id;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['confirmDelete'])) {
                $this->user->delete();
                header("Location: ?pages=user");
            } else {
                header("Location: ?pages=user");
            }
            exit();
        }

        $this->user->getUserByID();
        $user = $this->user;

        include(dirname(__FILE__) . '/../views/user/userDelete.php');
    }
}
