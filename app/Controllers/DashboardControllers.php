<?php
namespace App\Controllers;

use App\Models\UserDashboard;
use App\Database\Database;

class DashboardController{
    private $dashboardModel;

    public function __construct()
    {
        $pdo = Database::getConnection();
        $this->dashboardModel = new UserDashboard($pdo);
    }

    public function userArticle($userId){
        return $this->dashboardModel->userPost($userId);
    }

    public function viewUserArticle($id){
        return $this->dashboardModel->userPostDetail($id);
    }
    public function deleteUserArticle($id, $userId){
        return $this->dashboardModel->deleteuserPost($id, $userId);
    }
}