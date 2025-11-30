<?php
namespace App\Controllers;

use App\Models\LoginSignup;
use App\Database\Database;

class LoginSignupController{
    private $loginSignup;


    public function __construct()
    {
    
        $pdo = Database::getConnection();
        $this->loginSignup = new LoginSignup($pdo);
    }

    public function login($email, $password){
        $user = $this->loginSignup->getUserByEmail($email);

        if(!$user){
            echo "Invalid email or password.";
            exit;
        }

        if(password_verify($password, $user['password'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];

            header("Location:home.php");
            exit;
        }

        
        
    } 
    public function signup($name, $email, $password){
        return  $this->loginSignup->registerUser($name, $email, $password);
    }
}