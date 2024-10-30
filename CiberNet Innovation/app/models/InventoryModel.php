<?php

class InventoryModel{
    private $conn;
    private $table_name = "inventory";
    public $InventoryID;
    public $inventoryQty;
    public $typeMovement;
    public $inventoryDate;
    public $UserID;
    public $userName;
    public $ProductID;
    public $productName;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "CALL sp_CreateInventory(:iQty, :iTypeMovement, :UID, :PID);";
        $result = $this->conn->prepare($query);

        $this->inventoryQty = htmlspecialchars(strip_tags($this->inventoryQty));
        $this->typeMovement = htmlspecialchars(strip_tags($this->typeMovement));
        $this->UserID = htmlspecialchars(strip_tags($this->UserID));
        $this->ProductID = htmlspecialchars(strip_tags($this->ProductID));

        $result->bindParam(":iQty", $this->inventoryQty);
        $result->bindParam(":iTypeMovement", $this->typeMovement);
        $result->bindParam(":UID", $this->UserID);
        $result->bindParam(":PID", $this->ProductID);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getInventory()
    {
        $query = "CALL sp_SelectInventory();";
        $result = $this->conn->prepare($query);
        $result->execute();
        return $result;
    }

    //Para los datos referenciados
    public function getUsers()
    {
        $query = "SELECT UserID, userName FROM user";
        $result = $this->conn->prepare($query);
        $result->execute();
        return $result;
    }
    public function getProducts()
    {
        $query = "SELECT ProductID, productName FROM product";
        $result = $this->conn->prepare($query);
        $result->execute();
        return $result;
    }

    public function getInventoryByID()
    {
        $query = "CALL sp_SelectInventoryByID(:IID);";
        $result = $this->conn->prepare($query);

        $result->bindParam(":IID", $this->InventoryID);

        $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);

        $this->InventoryID = $row["InventoryID"];
        $this->inventoryQty = $row["inventoryQty"];
        $this->typeMovement = $row["typeMovement"];
        $this->inventoryDate = $row["inventoryDate"];
        $this->UserID = $row["UserID"];
        $this->userName = $row["userName"];
        $this->ProductID = $row["ProductID"];
        $this->productName = $row["productName"];
    }

    public function update()
    {
        $query = "CALL sp_UpdateInventory(:IID, :iQty, :iTypeMovement, :UID, :PID);";

        $this->inventoryQty = htmlspecialchars(strip_tags($this->inventoryQty));
        $this->typeMovement = htmlspecialchars(strip_tags($this->typeMovement));
        $this->UserID = htmlspecialchars(strip_tags($this->UserID));
        $this->ProductID = htmlspecialchars(strip_tags($this->ProductID));

        $result = $this->conn->prepare($query);
        $result->bindParam(":IID", $this->InventoryID);
        $result->bindParam(":iQty", $this->inventoryQty);
        $result->bindParam(":iTypeMovement", $this->typeMovement);
        $result->bindParam(":UID", $this->UserID);
        $result->bindParam(":PID", $this->ProductID);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete()
    {
        $query = "CALL sp_DeleteInventory(:IID);";
        $result = $this->conn->prepare($query);
        $result->bindParam(":IID", $this->InventoryID);
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }

}