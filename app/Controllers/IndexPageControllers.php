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
}