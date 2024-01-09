<?php

require_once 'entities/User.php';

class UserDAO
{
    private $conn;
    private User $user;

    public function __construct()
    {
        $this->conn = Connection::getInstance()->getConnection();
        $this->user = new User();
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }
}