<?php

require_once 'entities/Wiki.php';

class WikiDAO
{
    private $conn;
    private Wiki $wiki;

    public function __construct()
    {
        $this->conn = Connection::getInstance()->getConnection();
        $this->wiki = new Wiki();
    }

    /**
     * Get the value of wiki
     */ 
    public function getWiki()
    {
        return $this->wiki;
    }
}