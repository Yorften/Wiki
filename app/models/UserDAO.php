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

    public function findByUsername(string $username)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE userName = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData) {
            $user = new User();
            $user->setId($userData['userId']);
            $user->setName($userData['userName']);
            $user->setEmail($userData['userEmail']);
            $user->setPassword($userData['userPassword']);
            $user->setRole($userData['userRole']);
            return $user;
        } else return false;
    }

    public function findByEmailadress(string $email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE userEmail = :useremail");
        $stmt->bindParam(':useremail', $email);
        $stmt->execute();
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData) {
            $user = new User();
            $user->setId($userData['userId']);
            $user->setName($userData['userName']);
            $user->setEmail($userData['userEmail']);
            $user->setPassword($userData['userPassword']);
            $user->setRole($userData['userRole']);
            return $user;
        } else return false;
    }

    public function signup(User $user)
    {
        $username = $user->getName();
        $email = $user->getEmail();
        $password = $user->getPassword();
        if ($this->findByUsername($user->getName())) {
            $msg[] = 'User name already exists';
            return $msg;
        } elseif ($this->findByEmailadress($user->getEmail())) {
            $msg[] = 'Email already exists';
            return $msg;
        } else {
            $stmt = $this->conn->prepare("INSERT INTO users (userName, userEmail,userPassword) VALUES (:name, :email, :password)");

            $stmt->bindParam(':name', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);

            $stmt->execute();
            return true;
        }
    }

    /**
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }
}
