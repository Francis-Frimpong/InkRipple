<?php
  session_start();
  session_regenerate_id(true);



  if (!isset($_SESSION['user_id'])){
    header("Location:login.php");
    exit;
  }
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

      <div class="post-grid">
        <div class="post-card">
          <h3>My First Blog Post</h3>
          <p>
            This is a short preview of my first blog post. It’s amazing to start
            sharing my thoughts on InkRipple.
          </p>
        </div>
        <div class="post-card">
          <h3>Why Writing Every Day Matters</h3>
          <p>
            Daily writing sharpens your creativity and discipline. Small steps
            lead to big ideas.
          </p>
        </div>
        <div class="post-card">
          <h3>Lessons from My Coding Journey</h3>
          <p>
            Every bug is a lesson, every project a milestone. Coding is a story
            of growth.
          </p>
        </div>
      </div>
    </div>
  </body>
</html>
