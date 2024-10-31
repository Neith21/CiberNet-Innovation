<?php
class CategoryModel
{
    private $conn;
    private $table_name = "category";

    public $CategoryID;
    public $categoryName;
    public $categoryInfo;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "CALL sp_CreateCategory(:categoryName, :categoryInfo);";
        $result = $this->conn->prepare($query);

        $this->categoryName = htmlspecialchars(strip_tags($this->categoryName));
        $this->categoryInfo = htmlspecialchars(strip_tags($this->categoryInfo));

        $result->bindParam(":categoryName", $this->categoryName);
        $result->bindParam(":categoryInfo", $this->categoryInfo);

        return $result->execute();
    }

    public function getCategories()
    {
        $query = "CALL sp_SelectCategory();";
        $result = $this->conn->prepare($query);
        $result->execute();
        return $result;
    }

    public function getCategoryByID()
    {
        $query = "CALL sp_SelectCategoryByID(:CategoryID);";
        $result = $this->conn->prepare($query);

        $result->bindParam(":CategoryID", $this->CategoryID);

        $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);

        $this->categoryName = $row["categoryName"];
        $this->categoryInfo = $row["categoryInfo"];
    }

    public function update()
    {
        $query = "CALL sp_UpdateCategory(:CategoryID, :categoryName, :categoryInfo);";

        $this->CategoryID = htmlspecialchars(strip_tags($this->CategoryID));
        $this->categoryName = htmlspecialchars(strip_tags($this->categoryName));
        $this->categoryInfo = htmlspecialchars(strip_tags($this->categoryInfo));

        $result = $this->conn->prepare($query);
        $result->bindParam(":CategoryID", $this->CategoryID);
        $result->bindParam(":categoryName", $this->categoryName);
        $result->bindParam(":categoryInfo", $this->categoryInfo);

        return $result->execute();
    }

    public function delete()
    {
        $query = "CALL sp_DeleteCategory(:CategoryID);";
        $result = $this->conn->prepare($query);
        $result->bindParam(":CategoryID", $this->CategoryID);
        return $result->execute();
    }
}
