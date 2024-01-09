<?php

require_once 'entities/Author.php';

class AuthorDAO
{
    private $conn;
    private Author $author;

    public function __construct()
    {
        $this->conn = Connection::getInstance()->getConnection();
        $this->author = new Author();
    }

    /**
     * Get the value of author
     */ 
    public function getAuthor()
    {
        return $this->author;
    }
}