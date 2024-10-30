<?php
class SaleModel
{
    private $conn;
    private $table_name = "Sale";

    public $SaleID;
    public $saleDate;
    public $customerName;
    public $saleTotal;
    public $UserID;
    public $userName; //Para el nombre del usuario

    public $ProductID;
    public $productName;
    public $productPrice;
    public $stock;


    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function Create()
    {
        $query = "CALL sp_CreateSale (:customerName, :saleTotal, :UserID);";
        $result = $this->conn->prepare($query);

        $this->customerName = htmlspecialchars(strip_tags($this->customerName));
        $this->saleTotal = htmlspecialchars(strip_tags($this->saleTotal));
        $this->UserID = htmlspecialchars(strip_tags($this->UserID));

        $result->bindParam(":customerName", $this->customerName);
        $result->bindParam(":saleTotal", $this->saleTotal);
        $result->bindParam(":UserID", $this->UserID);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /* public function getUsers()
    {
        $query = "CALL sp_SelectUsers();";
        $result = $this->conn->prepare($query);
        $result->execute();
        return $result;
    } */

    public function getProducts()
    {
        $query = "CALL sp_SelectProducts4Sale();";
        $result = $this->conn->prepare($query);
        $result->execute();
        return $result;
    }

    /* public function getSales()
    {
        $query = "CALL sp_SelectSales();";
        $result = $this->conn->prepare($query);
        $result->execute();
        return $result;
    } */

    public function getSaleID()
    {
        $query = "CALL sp_SelectSaleID();";
        $result = $this->conn->prepare($query);
        $result->execute();

        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            return $row['SaleID'];
        }
        return null;
    }
}
