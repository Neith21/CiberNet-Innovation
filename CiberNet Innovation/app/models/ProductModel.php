<?php

    class ProductModel{
        private $conn;
        private $table_name = 'product';

        public $ProductID;
        public $productName;
        public $productInfo;
        public $productPrice;
        public $productPresentation;
        public $CategoryID;
        public $categoryName;
        public $SupplierID;
        public $supplierName;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function getProducts()
        {
            $query = "CALL sp_SelectProducts();";
            $result = $this->conn->prepare($query);
            $result->execute();
            return $result;
        }

        //Para los datos referenciados
        public function getCategories()
        {
            $query = "SELECT CategoryID, categoryName FROM category";
            $result = $this->conn->prepare($query);
            $result->execute();
            return $result;
        }
        public function getSuppliers()
        {
            $query = "SELECT SupplierID, supplierName FROM supplier";
            $result = $this->conn->prepare($query);
            $result->execute();
            return $result;
        }

        public function getProductByID()
        {
            $query = "CALL sp_SelectProductByID(:ID);";
            $result = $this->conn->prepare($query);
    
            $result->bindParam(":ID", $this->ProductID);
    
            $result->execute();
            $row = $result->fetch(PDO::FETCH_ASSOC);
    
            $this->ProductID = $row["ProductID"];
            $this->productName = $row["productName"];
            $this->productInfo = $row["productInfo"];
            $this->productPrice = $row["productPrice"];
            $this->productPresentation = $row["productPresentation"];
            $this->CategoryID = $row["CategoryID"];
            $this->categoryName = $row["categoryName"];
            $this->SupplierID = $row["SupplierID"];
            $this->supplierName = $row["supplierName"];

        }

        // metodo para crear nuevo producto
        public function create()
        {
            $query = "CALL sp_CreateProduct(:productName, :productInfo, :productPrice, :productPresentation, :CategoryID, :SupplierID);";
            $result = $this->conn->prepare($query);
    
            $this->productName = htmlspecialchars(strip_tags($this->productName));
            $this->productInfo = htmlspecialchars(strip_tags($this->productInfo));
            $this->productPrice = htmlspecialchars(strip_tags($this->productPrice));
            $this->productPresentation = htmlspecialchars(strip_tags($this->productPresentation));
            $this->CategoryID = htmlspecialchars(strip_tags($this->CategoryID));
            $this->SupplierID = htmlspecialchars(strip_tags($this->SupplierID));
    
            $result->bindParam(":productName", $this->productName);
            $result->bindParam(":productInfo", $this->productInfo);
            $result->bindParam(":productPrice", $this->productPrice);
            $result->bindParam(":productPresentation", $this->productPresentation);
            $result->bindParam(":CategoryID", $this->CategoryID);
            $result->bindParam(":SupplierID", $this->SupplierID);
    
            if ($result->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function update()
        {
            $query = "CALL sp_UpdateProduct(:ID, :productName, :productInfo, :productPrice, :productPresentation, :CategoryID, :SupplierID);";
            
            $this->productName = htmlspecialchars(strip_tags($this->productName));
            $this->productInfo = htmlspecialchars(strip_tags($this->productInfo));
            $this->productPrice = htmlspecialchars(strip_tags($this->productPrice));
            $this->productPresentation = htmlspecialchars(strip_tags($this->productPresentation));
            $this->CategoryID = htmlspecialchars(strip_tags($this->CategoryID));
            $this->SupplierID = htmlspecialchars(strip_tags($this->SupplierID));
            
            $result = $this->conn->prepare($query);
            $result->bindParam(":ID", $this->ProductID);
            $result->bindParam(":productName", $this->productName);
            $result->bindParam(":productInfo", $this->productInfo);
            $result->bindParam(":productPrice", $this->productPrice);
            $result->bindParam(":productPresentation", $this->productPresentation);
            $result->bindParam(":CategoryID", $this->CategoryID);
            $result->bindParam(":SupplierID", $this->SupplierID);
    
            if ($result->execute()) {
                return true;
            } else {
                return false;
            }
        }
    
        public function delete()
        {
            $query = "CALL sp_DeleteProduct(:ID);";
            $result = $this->conn->prepare($query);
            $result->bindParam(":ID", $this->ProductID);
            if ($result->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }

?>