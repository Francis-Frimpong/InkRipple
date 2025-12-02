<?php
namespace App\Models;

USE PDO;

class CreatePost{
    private $pdo;
    
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function createNewPost($userId, $title, $content){
        $stmt = $this->pdo->prepare("INSERT INTO posts (user_id, title, content)VALUES(?, ?, ?)");
        $stmt->execute([$userId, $title, $content]);
        return $stmt;
    }
}