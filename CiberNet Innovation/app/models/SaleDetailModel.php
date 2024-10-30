<?php
class SaleDetailModel
{
    private $conn;
    private $table_name = "SaleDetail";

    public $SaleDetailID;
    public $saleDetailQty;
    public $unitPrice;
    public $subtotal;
    public $SaleID;
    public $ProductID;
    public $productName; //Para el nombre del producto

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function Create()
    {
        $query = "CALL sp_CreateSaleDetil (:saleDetailQty, :unitPrice, :SaleID, :ProductID);";
        $result = $this->conn->prepare($query);

        $this->saleDetailQty = htmlspecialchars(strip_tags($this->saleDetailQty));
        $this->unitPrice = htmlspecialchars(strip_tags($this->unitPrice));
        $this->SaleID = htmlspecialchars(strip_tags($this->SaleID));
        $this->ProductID = htmlspecialchars(strip_tags($this->ProductID));

        $result->bindParam(":saleDetailQty", $this->saleDetailQty);
        $result->bindParam(":unitPrice", $this->unitPrice);
        $result->bindParam(":SaleID", $this->SaleID);
        $result->bindParam(":ProductID", $this->ProductID);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /* public function getSaleDetails()
    {
        $query = "CALL sp_SelectSaleDetails(:SaleID);";
        $result = $this->conn->prepare($query);
        $result->execute();
        return $result;
    } */
}