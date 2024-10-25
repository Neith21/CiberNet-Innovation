<?php
class UserModel
{
    private $conn;
    private $table_name = "User";

    public $UserID;
    public $userName;
    public $userGender;
    public $userNickname;
    public $userEmail;
    public $userPassword;
    public $RolID;
    public $rolName; //Para el nombre del rol

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function Create()
    {
        $query = "CALL sp_CreateUser (:userName, :userGender, :userNickname, :userEmail, :userPassword, :RolID);";
        $result = $this->conn->prepare($query);

        $this->userName = htmlspecialchars(strip_tags($this->userName));
        $this->userGender = htmlspecialchars(strip_tags($this->userGender));
        $this->userNickname = htmlspecialchars(strip_tags($this->userNickname));
        $this->userEmail = htmlspecialchars(strip_tags($this->userEmail));
        $this->userPassword = htmlspecialchars(strip_tags($this->userPassword));
        $this->RolID = htmlspecialchars(strip_tags($this->RolID));

        $this->userPassword = md5($this->userPassword);

        $result->bindParam(":userName", $this->userName);
        $result->bindParam(":userGender", $this->userGender);
        $result->bindParam(":userNickname", $this->userNickname);
        $result->bindParam(":userEmail", $this->userEmail);
        $result->bindParam(":userPassword", $this->userPassword);
        $result->bindParam(":RolID", $this->RolID);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getRoles()
    {
        $query = "SELECT RolID, rolName FROM Rol";
        $result = $this->conn->prepare($query);
        $result->execute();
        return $result;
    }

    public function getUsers()
    {
        $query = "CALL sp_SelectUsers();";
        $result = $this->conn->prepare($query);
        $result->execute();
        return $result;
    }

    public function getUserByID()
    {
        $query = "CALL sp_SelectUserById(:UserID);";
        $result = $this->conn->prepare($query);


        $result->bindParam("UserID", $this->UserID);

        $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);

        $this->userName = $row["userName"];
        $this->userGender = $row["userGender"];
        $this->userNickname = $row["userNickname"];
        $this->userEmail = $row["userEmail"];
        $this->userPassword = $row["userPassword"];
        $this->RolID = $row["RolID"];
    }

    public function update()
    {
        $query = "CALL sp_UpdateUser(:UserID, :userName, :userGender, :userNickname, :userEmail, :userPassword, :RolID);";

        $this->UserID = htmlspecialchars(strip_tags($this->UserID));
        $this->userName = htmlspecialchars(strip_tags($this->userName));
        $this->userGender = htmlspecialchars(strip_tags($this->userGender));
        $this->userNickname = htmlspecialchars(strip_tags($this->userNickname));
        $this->userEmail = htmlspecialchars(strip_tags($this->userEmail));
        $this->userPassword = htmlspecialchars(strip_tags($this->userPassword));
        $this->RolID = htmlspecialchars(strip_tags($this->RolID));

        $this->userPassword = md5($this->userPassword);

        $result = $this->conn->prepare($query);
        $result->bindParam(":UserID", $this->UserID);
        $result->bindParam(":userName", $this->userName);
        $result->bindParam(":userGender", $this->userGender);
        $result->bindParam(":userNickname", $this->userNickname);
        $result->bindParam(":userEmail", $this->userEmail);
        $result->bindParam(":userPassword", $this->userPassword);
        $result->bindParam(":RolID", $this->RolID);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete()
    {
        $query = "CALL sp_DeleteUser(:UserID);";
        $result = $this->conn->prepare($query);
        $result->bindParam("UserID", $this->UserID);
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
}