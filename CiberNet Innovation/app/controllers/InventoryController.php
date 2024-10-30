<?php
require_once(dirname(__FILE__) . "/../../config/config.php");
require_once(dirname(__FILE__) . "/../../core/database.php");
require_once(dirname(__FILE__) . "/../models/InventoryModel.php");


class InventoryController{
    private $db;
    private $inventory;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();

        $this->inventory = new InventoryModel($this->db);
    }

    public function index()
    {
        $result = $this->inventory->getInventory();
        $inventories = $result->fetchAll(PDO::FETCH_ASSOC);
        include(dirname(__FILE__) . '/../views/inventory/inventoryList.php');
    }

    public function create()
    {
        if ($_POST) {
            $this->inventory->inventoryQty = $_POST['inventoryQty'];
            $this->inventory->typeMovement = $_POST['typeMovement'];
            $this->inventory->UserID = $_POST['UserID'];
            $this->inventory->ProductID = $_POST['ProductID'];
            
            if ($this->inventory->create()) {
                header("Location: ?pages=inventory");
                exit();
            } else {
                echo "Error al crear el rol.";
            }
        }
        $usersResult = $this->inventory->getUsers();
        $users = $usersResult->fetchAll(PDO::FETCH_ASSOC);
        $productsResult = $this->inventory->getProducts();
        $products = $productsResult->fetchAll(PDO::FETCH_ASSOC);
        include(dirname(__FILE__) . '/../views/inventory/inventoryCreate.php');
    }

    public function edit($id)
    {
        $this->inventory->InventoryID = $id;
        $this->inventory->getInventoryByID();

        if ($_POST) {
            $this->inventory->inventoryQty = $_POST['inventoryQty'];
            $this->inventory->typeMovement = $_POST['typeMovement'];
            $this->inventory->UserID = $_POST['UserID'];
            $this->inventory->ProductID = $_POST['ProductID'];

            if ($this->inventory->update()) {
                header("Location: ?pages=inventory");
                exit();
            } else {
                echo "Error al actualizar el inventario.";
            }
        }
        $usersResult = $this->inventory->getUsers();
        $users = $usersResult->fetchAll(PDO::FETCH_ASSOC);
        $productsResult = $this->inventory->getProducts();
        $products = $productsResult->fetchAll(PDO::FETCH_ASSOC);
        $inventories = $this->inventory;
        include(dirname(__FILE__) . '/../views/inventory/inventoryUpdate.php');
    }

    public function delete($id)
    {
        $this->inventory->InventoryID = $id;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['confirmDelete'])) {
                $this->inventory->delete();
                header("Location: ?pages=inventory");
                exit();
            } else {
                header("Location: ?pages=inventory");
                exit();
            }
        }
        
        $this->inventory->getInventoryByID();
        $inventories = $this->inventory;

        include(dirname(__FILE__) . '/../views/inventory/inventoryDelete.php');
    }

}