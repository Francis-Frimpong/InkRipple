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
      <a href="login.html" class="login-btn">Login</a>
    </nav>

    <!-- BLOG POSTS -->
    <div class="container">
      <div class="blog-grid">
        <div class="blog-card">
          <h3>Exploring Creativity Through Writing</h3>
          <p>
            Writing lets your thoughts ripple outward — shaping ideas and
            connecting minds.
          </p>
        </div>
        <div class="blog-card">
          <h3>The Power of Simplicity</h3>
          <p>
            Learn why keeping things simple makes your message stronger and more
            memorable.
          </p>
        </div>
        <div class="blog-card">
          <h3>Why You Should Start a Blog Today</h3>
          <p>
            Sharing your experiences is the best way to learn, grow, and inspire
            others.
          </p>
        </div>
        <div class="blog-card">
          <h3>Balancing Design and Functionality</h3>
          <p>Good design supports great content — not the other way around.</p>
        </div>
      </div>

      <!-- PAGINATION -->
      <div class="pagination">
        <button>&laquo;</button>
        <button class="active">1</button>
        <button>2</button>
        <button>3</button>
        <button>&raquo;</button>
      </div>
    </div>
  </body>
</html>
