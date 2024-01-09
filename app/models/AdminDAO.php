<?php

require_once 'entities/Admin.php';

class AdminDAO
{
    private $conn;
    private Admin $admin;

    public function __construct()
    {
        $this->conn = Connection::getInstance()->getConnection();
        $this->admin = new Admin();
    }

    /**
     * Get the value of admin
     */ 
    public function getAdmin()
    {
        return $this->admin;
    }
}
