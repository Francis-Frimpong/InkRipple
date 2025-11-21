<?php
  session_start();
  session_regenerate_id(true);
  include './db/database.php';
  $userId = $_SESSION['user_id'];



  if (!isset($userId)){
    header("Location:login.php");
    exit;
  }

  $perPage = 5;
  
  $stmt = $pdo->query("SELECT COUNT(*) AS cnt FROM posts");
  $totalRows = (int)$stmt->fetchColumn();
  $totalPages = ($totalRows > 0) ? (int) ceil($totalRows/ $perPage) : 1;

  $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
  if ($page < 1) $page = 1;
  if ($page > $totalPages) $page = $totalPages;

  $offset = ($page - 1) * $perPage;

  $sql = "SELECT id, title, content FROM posts  WHERE user_id = :userId
   ORDER BY id DESC LIMIT :offset, :perPage";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
  $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
  $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // $stmt = $pdo->prepare("SELECT * FROM posts WHERE user_id = ?");
  // $stmt->execute([$userId]);
  // $posts = $stmt->fetchAll(PDO::FETCH_ASSOC)

  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>InkRipple | Dashboard</title>
    <style>
      :root {
        --primary: #1e1e2f;
        --accent: #4f46e5;
        --light: #ffffff;
        --gray: #f5f5f7;
        --text: #333;
      }

      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: "Segoe UI", sans-serif;
        background: var(--gray);
        color: var(--text);
        line-height: 1.6;
      }

      /* NAVBAR */
      nav {
        background: var(--light);
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.5rem;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        position: sticky;
        top: 0;
        z-index: 10;
      }

      .logo {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--accent);
      }

      .nav-links {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
      }

      .nav-links a {
        text-decoration: none;
        color: var(--text);
        font-weight: 500;
        padding: 0.4rem 0.8rem;
        border-radius: 5px;
        transition: background 0.3s ease;
      }

      .nav-links a:hover {
        background: #e0e0ff;
      }

      .logout-btn {
        background: #ef4444;
        color: var(--light);
        padding: 0.5rem 1rem;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        transition: background 0.3s ease, transform 0.2s ease;
      }

      .logout-btn:hover {
        background: #b91c1c;
        transform: translateY(-2px);
      }

      /* DASHBOARD SECTION */
      .container {
        max-width: 900px;
        margin: 1.5rem auto;
        padding: 0 1rem;
      }

      .welcome {
        background: var(--light);
        padding: 1rem;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        margin-bottom: 1.5rem;
        text-align: center;
      }

      .welcome h2 {
        color: var(--accent);
        margin-bottom: 0.3rem;
      }

      /* POSTS GRID */
      .post-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
      }

      .post-card {
        background: var(--light);
        border-radius: 8px;
        padding: 1rem;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease;
      }

      .post-card:hover {
        transform: translateY(-3px);
      }

      .post-card h3 {
        color: var(--accent);
        margin-bottom: 0.5rem;
      }

      .post-card p {
        font-size: 0.95rem;
        color: #555;
      }

    .article {
      text-decoration: none;
      color: inherit;
    }
       /* PAGINATION */
      .pagination {
        display: flex;
        justify-content: center;
        margin: 2rem 0;
        gap: 0.5rem;
      }

      .pagination button {
        border: none;
        background: var(--light);
        padding: 0.5rem 0.9rem;
        border-radius: 6px;
        cursor: pointer;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: 0.3s ease;
      }

      .pagination button.active,
      .pagination button:hover {
        background: var(--accent);
        color: var(--light);
      }

      @media (min-width: 600px) {
        .post-grid {
          grid-template-columns: repeat(2, 1fr);
        }
      }

      @media (min-width: 900px) {
        .post-grid {
          grid-template-columns: repeat(3, 1fr);
        }
      }
    </style>
  </head>
  <body>
    <!-- NAVBAR -->
    <nav>
      <div class="logo">InkRipple</div>
      <div class="nav-links">
        <a href="home.php">Home</a>
        <a href="createPost.php">Create Post</a>
        <a href="#">Profile</a>
        <a href="#" class="logout-btn">Logout</a>
      </div>
    </nav>

    <!-- DASHBOARD CONTENT -->
    <div class="container">
      <div class="welcome">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_name'])?>👋</h2>
        <p>Here are your recent posts on InkRipple.</p>
      </div>
      <?php if(!empty($row)): ?>

        <?php foreach($rows AS $row): ?>

          <div class="post-grid">
              <a href="dashboardArticleView.php?<?php echo http_build_query(['id' => $row['id']])?>" class="article">
                <div class="post-card">
                  <h3><?php echo htmlspecialchars($row['title'])?></h3>
                  <p>
                    <?php echo htmlspecialchars($row['content'])?>
                  </p>
                </div>
              </a>  
              <?php endforeach?>
        <?php else: ?>
          <h2 style="text-align: center; color:#4f46e5"><?php echo 'No post has been created.'?></h2>
        <?php endif?>
      </div>
    </div>
     <!-- PAGINATION -->
           <div class="pagination">
           <!-- Previous button -->
        <form method="get" style="display:inline;">
          <button name="page" value="<?=$page - 1?>" <?=($page <= 1) ? 'disabled' : ''?>>&laquo;</button>
        </form>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
          <form method="get" style="display:inline;">
            <button name="page" value="<?=$i?>" class="<?=($i == $page) ? 'active' : ''?>"><?=$i?></button>
          </form>
        <?php endfor; ?>

        <!-- Next button -->
        <form method="get" style="display:inline;">
          <button name="page" value="<?=$page + 1?>" <?=($page >= $totalPages) ? 'disabled' : ''?>>&raquo;</button>
        </form>
      </div>
  </body>
</html>
