<?php
class SupplierModel
{
    private $conn;
    private $table_name = "supplier";

    public $SupplierID;
    public $supplierName;
    public $supplierPhone;
    public $supplierAddress;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "CALL sp_CreateSupplier(:supplierName, :supplierPhone, :supplierAddress);";
        $result = $this->conn->prepare($query);

        $this->supplierName = htmlspecialchars(strip_tags($this->supplierName));
        $this->supplierPhone = htmlspecialchars(strip_tags($this->supplierPhone));
        $this->supplierAddress = htmlspecialchars(strip_tags($this->supplierAddress));

        $result->bindParam(":supplierName", $this->supplierName);
        $result->bindParam(":supplierPhone", $this->supplierPhone);
        $result->bindParam(":supplierAddress", $this->supplierAddress);

        return $result->execute();
    }

    public function getSuppliers()
    {
        $query = "CALL sp_SelectSupplier();";
        $result = $this->conn->prepare($query);
        $result->execute();
        return $result;
    }

    public function getSupplierByID()
    {
        $query = "CALL sp_SelectSupplierByID(:SupplierID);";
        $result = $this->conn->prepare($query);

        $result->bindParam(":SupplierID", $this->SupplierID);

        $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);

        $this->supplierName = $row["supplierName"];
        $this->supplierPhone = $row["supplierPhone"];
        $this->supplierAddress = $row["supplierAddress"];
    }

    public function update()
    {
        $query = "CALL sp_UpdateSupplier(:SupplierID, :supplierName, :supplierPhone, :supplierAddress);";

        $this->SupplierID = htmlspecialchars(strip_tags($this->SupplierID));
        $this->supplierName = htmlspecialchars(strip_tags($this->supplierName));
        $this->supplierPhone = htmlspecialchars(strip_tags($this->supplierPhone));
        $this->supplierAddress = htmlspecialchars(strip_tags($this->supplierAddress));

        $result = $this->conn->prepare($query);
        $result->bindParam(":SupplierID", $this->SupplierID);
        $result->bindParam(":supplierName", $this->supplierName);
        $result->bindParam(":supplierPhone", $this->supplierPhone);
        $result->bindParam(":supplierAddress", $this->supplierAddress);

        return $result->execute();
    }

    public function delete()
    {
        $query = "CALL sp_DeleteSupplier(:SupplierID);";
        $result = $this->conn->prepare($query);
        $result->bindParam(":SupplierID", $this->SupplierID);
        return $result->execute();
    }
}
