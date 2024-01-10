<?php

require_once 'entities/Category.php';

class CategoryDAO
{
    private $conn;
    private Category $category;

    public function __construct()
    {
        $this->conn = Connection::getInstance()->getConnection();
        $this->category = new Category();
    }

    public function checkCategory($value)
    {
        $stmt = $this->conn->prepare("SELECT * FROM categories WHERE categoryName = :categoryname");
        $stmt->bindParam(':categoryname', $value);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (count($row)) {
            return $row['categoryId'];
        } else return false;
    }

    public function addCategory(Category $category)
    {
        $name = $category->getName();
        $date = date('Y-m-d H:i:s');
        $result = $this->checkCategory($name);
        if ($result) {
            return 'Category already exists';
        } else {
            $stmt = $this->conn->prepare("INSERT INTO categories VALUES (null,?,?)");
            $stmt->bindParam(1, $name, PDO::PARAM_STR_CHAR);
            $stmt->bindParam(2, $date, PDO::PARAM_STR_CHAR);
            if ($stmt->execute()) {
                return 1;
            } else
                return 'Database error';
        }
    }

    public function updateCategory(Category $category)
    {
        $name = $category->getName();
        $id = $category->getId();
        $date = date('Y-m-d H:i:s');
        $result = $this->checkCategory($name);
        if ($result) {
            return 'Category already exists';
        } else {
            $stmt = $this->conn->prepare("UPDATE categories SET categoryname = ?, categoryDate = ? WHERE categoryId = ?");
            $stmt->bindParam(1, $name, PDO::PARAM_STR);
            $stmt->bindParam(2, $date, PDO::PARAM_STR);
            $stmt->bindParam(3, $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return 1;
            } else
                return 'Database error';
        }
    }
    /**
     * Get the value of category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
