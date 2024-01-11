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

    public function checkCategory($column, $value)
    {
        $stmt = $this->conn->prepare("SELECT * FROM categories WHERE `$column` = ?");
        $stmt->bindParam(1, $value);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return true;
        } else return false;
    }

    public function addCategory(Category $category)
    {
        $name = $category->getName();
        $date = date('Y-m-d H:i:s');
        $result = $this->checkCategory('categoryName', $name);
        if ($result) {
            return 'Category already exists';
        } else {
            $stmt = $this->conn->prepare("INSERT INTO categories VALUES (null,?,?)");
            $stmt->bindParam(1, $name, PDO::PARAM_STR);
            $stmt->bindParam(2, $date, PDO::PARAM_STR);
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
        $result = $this->checkCategory('categoryName', $name);
        if ($result) {
            return 'Category already exists';
        } else {
            $stmt = $this->conn->prepare("UPDATE categories SET categoryname = ?, categoryDate = ? WHERE categoryId = ?");
            $stmt->bindParam(1, $name, PDO::PARAM_STR);
            $stmt->bindParam(2, $date, PDO::PARAM_STR);
            $stmt->bindParam(3, $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return 2;
            } else
                return 'Database error';
        }
    }

    public function deleteCategory(Category $category)
    {
        $id = $category->getId();
        $result = $this->checkCategory('categoryId', $id);
        if ($result) {
            $stmt = $this->conn->prepare("DELETE FROM categories WHERE categoryId = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return 3;
            } else
                return 'Database error';
        } else {
            return "Category doesn't exist";
        }
    }

    public function getAllCategories()
    {
        $stmt = $this->conn->prepare("SELECT * FROM categories");
        $stmt->execute();
        $categories = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $category = new Category();
            $category->setId($row['categoryId']);
            $category->setName($row['categoryName']);
            $category->setDate($row['categoryDate']);
            array_push($categories, $category);
        }
        return $categories;
    }
    /**
     * Get the value of category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
