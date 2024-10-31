<?php
require_once(dirname(__FILE__) . "/../../config/config.php");
require_once(dirname(__FILE__) . "/../../core/database.php");
require_once(dirname(__FILE__) . "/../models/CategoryModel.php");

class CategoryController
{
    private $db;
    private $category;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();

        $this->category = new CategoryModel($this->db);
    }

    public function index()
    {
        $result = $this->category->getCategories();
        $categories = $result->fetchAll(PDO::FETCH_ASSOC);
        include(dirname(__FILE__) . '/../views/category/categoryList.php');
    }

    public function create()
    {
        if ($_POST) {
            $this->category->categoryName = $_POST['categoryName'];
            $this->category->categoryInfo = $_POST['categoryInfo'];

            if ($this->category->create()) {
                header("Location: ?pages=category");
                exit();
            } else {
                echo "Error al crear la categoría.";
            }
        }
        include(dirname(__FILE__) . '/../views/category/categoryCreate.php');
    }

    public function edit($id)
    {
        $this->category->CategoryID = $id;
        $this->category->getCategoryByID();

        if ($_POST) {
            $this->category->categoryName = $_POST['categoryName'];
            $this->category->categoryInfo = $_POST['categoryInfo'];

            if ($this->category->update()) {
                header("Location: ?pages=category");
                exit();
            } else {
                echo "Error al actualizar la categoría.";
            }
        }
        
        $category = $this->category;
        include(dirname(__FILE__) . '/../views/category/categoryUpdate.php');
    }

    public function delete($id)
    {
        $this->category->CategoryID = $id;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['confirmDelete'])) {
                $this->category->delete();
                header("Location: ?pages=category");
                exit();
            } else {
                header("Location: ?pages=category");
                exit();
            }
        }

        $this->category->getCategoryByID();
        $category = $this->category;

        include(dirname(__FILE__) . '/../views/category/categoryDelete.php');
    }
}
