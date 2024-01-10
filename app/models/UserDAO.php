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

    public function login(User $user)
    {
        $userdb = $this->findByEmailadress($user->getEmail());
        if ($userdb) {
            if (verifyPassword($user->getPassword(), $userdb->getPassword())) {
                $_SESSION['userId'] = $userdb->getId();
                $_SESSION['userName'] = $userdb->getName();
                $_SESSION['userRole'] = $userdb->getRole();
                if($_SESSION['userRole'] == 'author'){
                    return 1;
                }else if($_SESSION['userRole'] == 'admin'){
                    return 2;
                }
            } else {
                $msg[] = 'Incorrect email or password';
                return $msg;
            }
        } else {
            $msg[] = 'Incorrect email or password';
            return $msg;
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        return true;
    }

    /**
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }
}
