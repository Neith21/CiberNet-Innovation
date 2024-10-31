<?php
require_once(dirname(__FILE__) . "/../../config/config.php");
require_once(dirname(__FILE__) . "/../../core/database.php");
require_once(dirname(__FILE__) . "/../models/SupplierModel.php");

class SupplierController
{
    private $db;
    private $supplier;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();

        $this->supplier = new SupplierModel($this->db);
    }

    public function index()
    {
        $result = $this->supplier->getSuppliers();
        $suppliers = $result->fetchAll(PDO::FETCH_ASSOC);
        include(dirname(__FILE__) . '/../views/supplier/supplierList.php');
    }

    public function create()
    {
        if ($_POST) {
            $this->supplier->supplierName = $_POST['supplierName'];
            $this->supplier->supplierPhone = $_POST['supplierPhone'];
            $this->supplier->supplierAddress = $_POST['supplierAddress'];

            if ($this->supplier->create()) {
                header("Location: ?pages=supplier");
                exit();
            } else {
                echo "Error al crear el proveedor.";
            }
        }
        include(dirname(__FILE__) . '/../views/supplier/supplierCreate.php');
    }

    public function edit($id)
    {
        $this->supplier->SupplierID = $id;
        $this->supplier->getSupplierByID();

        if ($_POST) {
            $this->supplier->supplierName = $_POST['supplierName'];
            $this->supplier->supplierPhone = $_POST['supplierPhone'];
            $this->supplier->supplierAddress = $_POST['supplierAddress'];

            if ($this->supplier->update()) {
                header("Location: ?pages=supplier");
                exit();
            } else {
                echo "Error al actualizar el proveedor.";
            }
        }
        
        $supplier = $this->supplier;
        include(dirname(__FILE__) . '/../views/supplier/supplierUpdate.php');
    }

    public function delete($id)
    {
        $this->supplier->SupplierID = $id;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['confirmDelete'])) {
                $this->supplier->delete();
                header("Location: ?pages=supplier");
                exit();
            } else {
                header("Location: ?pages=supplier");
                exit();
            }
        }

        $this->supplier->getSupplierByID();
        $supplier = $this->supplier;

        include(dirname(__FILE__) . '/../views/supplier/supplierDelete.php');
    }
}
?>
