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
        $productsResult = $this->sale->getProducts();
        $products = $productsResult->fetchAll(PDO::FETCH_ASSOC);
        
        return $products;
    }

    public function create() {
        $data = json_decode(file_get_contents("php://input"), true);
    
        $this->sale->customerName = $data['customerName'];
        $this->sale->saleTotal = $data['saleTotal'];
        $this->sale->UserID = $_SESSION["UserID"];
        $this->sale->create();
    
        $SaleID = $this->sale->getSaleID();
    
        foreach ($data['saleDetails'] as $detail) {
            $this->saleDetail->ProductID = $detail['productId'];
            $this->saleDetail->saleDetailQty = $detail['qty'];
            $this->saleDetail->unitPrice = $detail['unitPrice'];
            $this->saleDetail->SaleID = $SaleID;
            
            if (!$this->saleDetail->Create()) {
                echo json_encode(['success' => false, 'message' => 'Error al crear el detalle de la venta.']);
                return;
            }
        }
    
        echo json_encode(['success' => true]);
    }
}
