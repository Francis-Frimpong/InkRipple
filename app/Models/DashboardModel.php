<?php
namespace App\Models;

USE PDO;

class UserDashboard{
    private $pdo;

    
    public $page;
    public $perPage;
    public $totalRows;
    public $totalPages;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function userPost($userId){
        $this->perPage = 5;
  
        $stmt = $this->pdo->query("SELECT COUNT(*) AS cnt FROM posts");
        $this->totalRows = (int)$stmt->fetchColumn();
        $this->totalPages = ($this->totalRows > 0) ? (int) ceil($this->totalRows/ $this->perPage) : 1;

        $this->page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        if ($this->page < 1) $this->page = 1;
        if ($this->page > $this->totalPages) $this->page = $this->totalPages;

        $offset = ($this->page - 1) * $this->perPage;

        $sql = "SELECT id, title, content FROM posts WHERE user_id = :userId ORDER BY id DESC LIMIT :offset, :perPage";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':perPage', $this->perPage, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'rows' => $rows,
            'page' => $this->page,
            'totalPages' => $this->totalPages
            
        ];


    }

    public function userPostDetail($id){
        $stmt = $this->pdo->prepare("SELECT posts.title, posts.content, posts.updated_at AS 'published', users.full_name FROM posts LEFT JOIN users ON posts.user_id = users.id WHERE posts.id = ?");
        $stmt->execute([$id]);
        $post = $stmt->fetch();
        return [
            'post' => $post
        ];
    }

    public function deleteUserPost($id, $userId){
        $stmt = $this->pdo->prepare("DELETE FROM posts WHERE id = ? AND user_id = ?");
        $stmt->execute([$id, $userId]);
    }
}