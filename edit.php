<?php
session_start();
include './db/database.php';
$userId = $_SESSION['user_id'];


if (!isset($_SESSION['user_id'])){
    die("You must be logged in");
}

$userId = $_SESSION['user_id'];

if(!isset($_GET['id'])){
    die("No post selected");
}

$id = $_GET['id'];


$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $userId]);
$post = $stmt->fetch();

if(!$post){
    die("Post not found or you cannot edit this post.");
}



if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = trim($_POST['title']);
    $content = $_POST['content'];
    

    $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ? AND user_id = ?");
    $stmt->execute([$title, $content, $id, $userId]);

    $_SESSION['updated'] = "Post updated successfully!";
    header("Location:dashboard.php");
    exit;



}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Post | InkRipple</title>

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
      padding: 1rem;
    }

    /* NAVBAR */
    nav {
      background: var(--light);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 2rem;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
      margin-bottom: 2rem;
    }

    .logo {
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--accent);
    }

    .logout-btn {
      background: var(--accent);
      color: var(--light);
      padding: 0.6rem 1rem;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 500;
      transition: 0.3s ease;
    }

    .logout-btn:hover {
      background: #3730a3;
    }

    /* PAGE CONTAINER */
    .container {
      max-width: 650px;
      margin: auto;
      background: var(--light);
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    }

    .container h2 {
      color: var(--accent);
      margin-bottom: 1.5rem;
      text-align: center;
    }

    label {
      font-weight: 600;
      display: block;
      margin: 1rem 0 0.4rem;
    }

    input,
    textarea {
      width: 100%;
      padding: 0.8rem;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 1rem;
      background: #fafafa;
      transition: border 0.2s ease;
    }

    input:focus,
    textarea:focus {
      border-color: var(--accent);
      outline: none;
    }

    textarea {
      min-height: 180px;
      resize: vertical;
    }

    .btn-submit {
      width: 100%;
      background: var(--accent);
      color: var(--light);
      border: none;
      padding: 0.9rem 1.2rem;
      border-radius: 6px;
      font-size: 1rem;
      font-weight: 500;
      margin-top: 1.5rem;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .btn-submit:hover {
      background: #3730a3;
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav>
    <div class="logo">InkRipple</div>
    <a href="logout.php" class="logout-btn">Logout</a>
  </nav>

  <!-- EDIT POST FORM -->
  <div class="container">
    <h2>Edit Your Post</h2>

    <form action="edit.php?id=<?php echo $id ?>" method="POST">
      <!-- Title -->
      <label for="title">Title</label>
      <input 
        type="text" 
        id="title"
        name="title"
        value="<?php echo htmlspecialchars($post['title'] ?? '') ?>"
        required
      />

      <!-- Content -->
      <label for="content">Content</label>
      <textarea 
        id="content" 
        name="content"
        required
      ><?php echo htmlspecialchars($post['content'] ?? '') ?></textarea>

      <!-- Update Button -->
      <button type="submit" class="btn-submit">Update Post</button>
    </form>
  </div>

</body>
</html>
