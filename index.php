<?php
  
  include './db/database.php';
 
  $perPage = 5;
  
  $stmt = $pdo->query("SELECT COUNT(*) AS cnt FROM posts");
  $totalRows = (int)$stmt->fetchColumn();
  $totalPages = ($totalRows > 0) ? (int) ceil($totalRows/ $perPage) : 1;

  $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
  if ($page < 1) $page = 1;
  if ($page > $totalPages) $page = $totalPages;

  $offset = ($page - 1) * $perPage;

  $sql = "SELECT id, title, content FROM posts ORDER BY id DESC LIMIT :offset, :perPage";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
  $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
  $stmt->execute();
  $rows = $stmt->fetchAll();

  // $stmt = $pdo->prepare("SELECT * FROM posts ");
  // $stmt->execute();
  // $posts = $stmt->fetchAll(PDO::FETCH_ASSOC)

  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>InkRipple | Home</title>
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
        padding: 1rem 2rem;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        position: sticky;
        top: 0;
        z-index: 10;
      }

      .logo {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--accent);
      }

      .login-btn {
        display: inline-block;
        background: var(--accent);
        color: var(--light);
        text-decoration: none;
        padding: 0.6rem 1.2rem;
        border-radius: 6px;
        font-weight: 500;
        transition: background 0.3s ease, transform 0.2s ease;
      }

      .login-btn:hover {
        background: #3730a3;
        transform: translateY(-2px);
      }

      /* BLOG GRID */
      .container {
        max-width: 1000px;
        margin: 2rem auto;
        padding: 0 1rem;
      }

      .blog-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
      }

      .blog-card {
        background: var(--light);
        border-radius: 10px;
        padding: 1rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease;
      }

      .blog-card:hover {
        transform: translateY(-4px);
      }

      .blog-card h3 {
        color: var(--accent);
        margin-bottom: 0.5rem;
      }

      .blog-card p {
        color: #555;
        font-size: 0.95rem;
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

      @media (max-width: 500px) {
        nav {
          flex-direction: column;
          gap: 0.5rem;
        }
      }
    </style>
  </head>
  <body>
    <!-- NAVBAR -->
    <nav>
      <div class="logo">InkRipple</div>
      <a href="login.php" class="login-btn">Login</a>
    </nav>

    <!-- BLOG POSTS -->
    <div class="container">
      <?php if(empty($rows)): ?>
        <p>No posts found.</p>
      <?php else: ?>
        <?php foreach($rows AS $row): ?>
          <div class="blog-grid">
            <div class="blog-card">
              <h3><?php echo htmlspecialchars($row['title'])?></h3>
              <p>
                <?php echo htmlspecialchars($row['content'])?>
              </p>
            </div>
        <?php endforeach?>
      <?php endif?>
       
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
    </div>
  </body>
</html>
