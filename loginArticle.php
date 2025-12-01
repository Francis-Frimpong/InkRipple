<?php
require 'app/Database/Database.php';
require 'app/Models/IndexModel.php';
require 'app/Controllers/IndexPageControllers.php';

use App\Controllers\IndexController;
$controller = new IndexController();


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  exit("Invalid article request.");
}

$article = $_GET['id'];
$post = $controller->showPostDetail();


?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>InkRipple | Article</title>

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
      line-height: 1.7;
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

    /* ARTICLE PAGE */
    .container {
      max-width: 800px;
      margin: 2rem auto;
      background: var(--light);
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .article-title {
      color: var(--accent);
      font-size: 1.9rem;
      margin-bottom: 1rem;
    }

    .article-meta {
      font-size: 0.9rem;
      color: #666;
      margin-bottom: 1.5rem;
    }

    .article-content p {
      margin-bottom: 1.2rem;
      font-size: 1rem;
    }

    /* BACK BUTTON */
    .back-link {
      display: inline-block;
      margin-top: 2rem;
      text-decoration: none;
      color: var(--accent);
      font-weight: 600;
    }

    .back-link:hover {
      text-decoration: underline;
    }

    @media (max-width: 600px) {
      .container {
        margin: 1rem;
        padding: 1.2rem;
      }

      .article-title {
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav>
    <div class="logo">InkRipple</div>
  </nav>

  <!-- ARTICLE CONTENT -->
  <div class="container">

    <h1 class="article-title"><?php echo htmlspecialchars($post['title'])?></h1>
    <div class="article-meta">
        <?php echo htmlspecialchars("By {$post['full_name']} . Published on {$post['published']}")?>
    </div>

    <div class="article-content">
      <p>
        <?php echo htmlentities($post['content'])?>
      </p>

      
    </div>

    <a href="home.php" class="back-link">&larr; Back to Home</a>
  </div>

</body>
</html>
