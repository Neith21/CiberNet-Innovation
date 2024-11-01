<?php
require_once(dirname(__FILE__) . "/../../config/config.php");
require_once(dirname(__FILE__) . "/../../core/database.php");
require_once(dirname(__FILE__) . "/../models/SaleModel.php");
require_once(dirname(__FILE__) . "/../models/SaleDetailModel.php");

class SaleController
{
    private $db;
    private $sale;
    private $saleDetail;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();

        $this->sale = new SaleModel($this->db);
        $this->saleDetail = new SaleDetailModel($this->db);
    }

    public function index()
    {
        $result = $this->sale->getSales();
        $sales = $result->fetchAll(PDO::FETCH_ASSOC);
        include(dirname(__FILE__) . '/../views/sale/saleList.php');
    }

    public function getProducts()
    {
        $productsResult = $this->sale->getProducts();
        $products = $productsResult->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }

    public function getSaleDetails($id)
    {
        $SaleID = $id;
        $saleDetailsResult = $this->saleDetail->getSaleDetails($SaleID);

        if ($saleDetailsResult) {
            $saleDetails = $saleDetailsResult->fetchAll(PDO::FETCH_ASSOC);
            include(dirname(__FILE__) . '/../views/sale/saleDetailList.php');
        } else {
            echo "No se encontraron detalles para esta venta.";
        }
    }


    public function delete($id)
    {
        $this->sale->SaleID = $id;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['confirmDelete'])) {
                $this->sale->delete();
                header("Location: sale.php");
            } else {
                header("Location: sale.php");
            }
            exit();
        }

        $this->sale->getSaleByID();
        $sale = $this->sale;

        include(dirname(__FILE__) . '/../views/sale/saleDelete.php');
    }
}
