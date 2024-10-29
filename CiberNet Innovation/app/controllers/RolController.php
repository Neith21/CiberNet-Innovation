<?php
require_once(dirname(__FILE__) . "/../../config/config.php");
require_once(dirname(__FILE__) . "/../../core/database.php");
require_once(dirname(__FILE__) . "/../models/RolModel.php");

class RolController
{
    private $db;
    private $rol;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();

        $this->rol = new RolModel($this->db);
    }

    public function index()
    {
        $result = $this->rol->getRoles();
        $roles = $result->fetchAll(PDO::FETCH_ASSOC);
        include(dirname(__FILE__) . '/../views/rol/rolList.php');
    }

    public function create()
    {
        if ($_POST) {
            $this->rol->rolName = $_POST['rolName'];
            $this->rol->rolInfo = $_POST['rolInfo'];

            if ($this->rol->create()) {
                header("Location: ?pages=rol");
                exit();
            } else {
                echo "Error al crear el rol.";
            }
        }
        include(dirname(__FILE__) . '/../views/rol/rolCreate.php');
    }

    public function edit($id)
    {
        $this->rol->RolID = $id;
        $this->rol->getRolByID();

        if ($_POST) {
            $this->rol->rolName = $_POST['rolName'];
            $this->rol->rolInfo = $_POST['rolInfo'];

            if ($this->rol->update()) {
                header("Location: ?pages=rol");
                exit();
            } else {
                echo "Error al actualizar el rol.";
            }
        }
        
        $rol = $this->rol;
        include(dirname(__FILE__) . '/../views/rol/rolUpdate.php');
    }

    public function delete($id)
    {
        $this->rol->RolID = $id;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['confirmDelete'])) {
                $this->rol->delete();
                header("Location: ?pages=rol");
                exit();
            } else {
                header("Location: ?pages=rol");
                exit();
            }
        }

        $this->rol->getRolByID();
        $rol = $this->rol;

        include(dirname(__FILE__) . '/../views/rol/rolDelete.php');
    }
}
