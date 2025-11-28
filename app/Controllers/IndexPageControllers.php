<?php
namespace App\Controllers;

use App\Models\IndexPage;
use App\Database\Database;

class IndexController{
    private $indexModel;

    public function __construct()
    {
        $pdo = Database::getConnection();
        $this->indexModel = new IndexPage($pdo);
    }

    public function index(){
        return $this->indexModel->fetchAll();
    }

    public function showPostDetail(){
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            exit("Invalid article request.");
        }
        $articleId = $_GET['id'];

        return $this->indexModel->detailPost($articleId);
    }
}