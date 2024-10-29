<?php
class RolModel
{
    private $conn;
    private $table_name = "rol";

    public $RolID;
    public $rolName;
    public $rolInfo;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "CALL sp_CreateRol(:rolName, :rolInfo);";
        $result = $this->conn->prepare($query);

        $this->rolName = htmlspecialchars(strip_tags($this->rolName));
        $this->rolInfo = htmlspecialchars(strip_tags($this->rolInfo));

        $result->bindParam(":rolName", $this->rolName);
        $result->bindParam(":rolInfo", $this->rolInfo);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getRoles()
    {
        $query = "CALL sp_SelectRol();";
        $result = $this->conn->prepare($query);
        $result->execute();
        return $result;
    }

    public function getRolByID()
    {
        $query = "CALL sp_SelectRolByID(:RolID);";
        $result = $this->conn->prepare($query);

        $result->bindParam(":RolID", $this->RolID);

        $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);

        $this->rolName = $row["rolName"];
        $this->rolInfo = $row["rolInfo"];
    }

    public function update()
    {
        $query = "CALL sp_UpdateRol(:RolID, :rolName, :rolInfo);";

        $this->RolID = htmlspecialchars(strip_tags($this->RolID));
        $this->rolName = htmlspecialchars(strip_tags($this->rolName));
        $this->rolInfo = htmlspecialchars(strip_tags($this->rolInfo));

        $result = $this->conn->prepare($query);
        $result->bindParam(":RolID", $this->RolID);
        $result->bindParam(":rolName", $this->rolName);
        $result->bindParam(":rolInfo", $this->rolInfo);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete()
    {
        $query = "CALL sp_DeleteRol(:RolID);";
        $result = $this->conn->prepare($query);
        $result->bindParam(":RolID", $this->RolID);
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
