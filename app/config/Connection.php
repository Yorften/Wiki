<?php


ini_set('session.cookie_secure', 1);
ini_set('session.cookie_httponly', 1);
session_start();

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}


class Connection
{
    private static $instance;
    private $conn;
    // private $stmt;

    public function __construct()
    {
        try {
            $dbh = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
            $this->conn = new PDO($dbh, DB_USER, DB_PASS);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public static function getInstance()
    {
        if (!self::$instance) {
            // self for class
            Connection::$instance = new Connection();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
