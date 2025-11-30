<?php
namespace App\Models;

USE PDO;

class LoginSignup{
    private $pdo;
    

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    function getUserByEmail($email){
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    function registerUser($name, $email, $password){
        // verify is email already exist
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if($stmt->fetch()){
            header("Location:signup.php?error=empty");
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $hashedPassword]);
        header("Location:login.php?success=registered");
    }
}