<?php
require_once(dirname(__FILE__) . "/../../config/config.php");
require_once(dirname(__FILE__) . "/../../core/database.php");
require_once(dirname(__FILE__) . "/../models/ProductModel.php");


class ProductController{
    private $db;
    private $product;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();

        $this->product = new ProductModel($this->db);
    }

    public function index()
    {
        $result = $this->product->getProducts();
        $products = $result->fetchAll(PDO::FETCH_ASSOC);
        include(dirname(__FILE__) . '/../views/product/productList.php');
    }

    public function create()
    {
        if ($_POST) {
            $this->product->productName = $_POST['productName'];
            $this->product->productInfo = $_POST['productInfo'];
            $this->product->productPrice = $_POST['productPrice'];
            $this->product->productPresentation = $_POST['productPresentation'];
            $this->product->CategoryID = $_POST['CategoryID'];
            $this->product->SupplierID = $_POST['SupplierID'];

            
            if ($this->product->create()) {
                header("Location: ../pages/product.php");
                exit();
            } else {
                echo "Error al crear el rol.";
            }
        }
        $categoriesResult = $this->product->getCategories();
        $categories = $categoriesResult->fetchAll(PDO::FETCH_ASSOC);
        $supplierResult = $this->product->getSuppliers();
        $suppliers = $supplierResult->fetchAll(PDO::FETCH_ASSOC);
        include(dirname(__FILE__) . '/../views/product/productCreate.php');
    }

    public function edit($id)
    {
        $this->product->ProductID = $id;
        $this->product->getProductByID();

        if ($_POST) {

            $this->product->productName = $_POST['productName'];
            $this->product->productInfo = $_POST['productInfo'];
            $this->product->productPrice = $_POST['productPrice'];
            $this->product->productPresentation = $_POST['productPresentation'];
            $this->product->CategoryID = $_POST['CategoryID'];
            $this->product->SupplierID = $_POST['SupplierID'];

            if ($this->product->update()) {
                header("Location: ../pages/product.php");
                exit();
            } else {
                echo "Error al actualizar el inventario.";
            }
        }

        $categoriesResult = $this->product->getCategories();
        $categories = $categoriesResult->fetchAll(PDO::FETCH_ASSOC);
        $supplierResult = $this->product->getSuppliers();
        $suppliers = $supplierResult->fetchAll(PDO::FETCH_ASSOC);
        $products = $this->product;
        include(dirname(__FILE__) . '/../views/product/productUpdate.php');
    }

    public function delete($id)
    {
        $this->product->ProductID = $id;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['confirmDelete'])) {
                $this->product->delete();
                header("Location: ../pages/product.php");
                exit();
            } else {
                header("Location: ../pages/product.php");
                exit();
            }
        }
        
        $categoriesResult = $this->product->getCategories();
        $categories = $categoriesResult->fetchAll(PDO::FETCH_ASSOC);
        $supplierResult = $this->product->getSuppliers();
        $suppliers = $supplierResult->fetchAll(PDO::FETCH_ASSOC);
        $this->product->getProductByID();
        $products = $this->product;

        include(dirname(__FILE__) . '/../views/product/ProductDelete.php');
    }

}