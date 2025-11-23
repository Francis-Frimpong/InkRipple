<?php
  session_start();
  session_regenerate_id(true);
  include './db/database.php';
  $userId = $_SESSION['user_id'];

  if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
   exit("Invalid article request.");
}

$article = $_GET['id'];

$stmt = $pdo->prepare("SELECT posts.title, posts.content, posts.updated_at AS 'published' , users.full_name FROM posts LEFT JOIN users ON posts.user_id = users.id WHERE posts.id = ?");
$stmt->execute([$article]);
$post = $stmt->fetch();




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

   /* Button container */
.action-buttons {
  display: flex;
  gap: 0.7rem;
  margin-top: 1rem;
}

/* Base button style */
.btn {
  display: inline-block;
  text-decoration: none;
  border-radius: 6px;
  font-weight: 500;
  transition: 0.2s ease;
  
  /* Make buttons same size */
  padding: 0.6rem 0;      /* controls height */
  min-width: 100px;        /* makes both same width */
  text-align: center;      /* centers the text */
  cursor: pointer;
}

/* Edit button */
.edit-btn {
  background: #4f46e5;
  color: white;
}
.edit-btn:hover {
  background: #3d38b6;
}

/* Delete button */
.delete-btn {
  background: #dc2626;
  color: white;
  border: none; /* for button in form */
}
.delete-btn:hover {
  background: #a81c1c;
}

.modal-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.4);
  display: none;   
  justify-content: center;
  align-items: center;
}

.modal-box {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);

  background: #fff;
  padding: 20px;
  width: 350px;
  border-radius: 8px;
  text-align: center;
  box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}


.modal-actions {
  margin-top: 20px;
  display: flex;
  justify-content: space-between;
}

.btn {
  padding: 8px 15px;
  border: none;
  cursor: pointer;
  border-radius: 4px;
}

.delete-btn {
  background: #d9534f;
  color: #fff;
}

.cancel-btn {
  background: #eee;
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
      <div class="nav-links">
        <a href="home.php">Home</a>
        <a href="createPost.php">Create Post</a>
        <a href="#">Profile</a>
        <a href="#" class="logout-btn">Logout</a>
      </div>
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

    <div class="action-buttons">

  <!-- EDIT BUTTON -->
  <a href="edit.php?id=POST_ID" class="btn edit-btn">Edit</a>

  <!-- DELETE FORM -->
    <button class="btn delete-btn">Delete</button>

</div>

<div class="modal-overlay" id="modal">
  <div class="modal-box">
    <h3>Delete Post?</h3>
    <p>Are you sure you want to delete this post?</p>

    <div class="modal-actions">
      <form action="delete.php" method="POST">
        <input type="hidden" name="id" value="POST_ID">
        <button type="submit" class="btn delete-btn delete">Delete</button>
      </form>

      <button class="btn cancel-btn">Cancel</button>
    </div>
  </div>
</div>




    <a href="dashboard.php" class="back-link">&larr; Back to Dashboard</a>
  </div>
    
    <script src="js/script.js"></script>
  </body>
</html>
