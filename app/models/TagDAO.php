<?php

require_once 'entities/Tag.php';

class TagDAO
{
    private $conn;
    private Tag $tag;

    public function __construct()
    {
        $this->conn = Connection::getInstance()->getConnection();
        $this->tag = new Tag();
    }

    /**
     * Get the value of tag
     */ 
    public function getTag()
    {
        return $this->tag;
    }
}