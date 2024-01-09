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

    /**
     * Get the value of category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
