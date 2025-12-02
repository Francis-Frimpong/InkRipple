<?php
namespace App\Controllers;
use App\Models\CreatePost;
use App\Database\Database;

class CreatePostController{
    private $createPostModel;

    public function __construct()
    {
        $pdo = Database::getConnection();
        $this->createPostModel = new CreatePost($pdo);
    }

    public function addPost($userId, $title, $content){
        return $this->createPostModel->createNewPost($userId, $title, $content);
    }
}