<?php
session_start();
require 'app/Database/Database.php';
require 'app/Models/LoginSignupModel.php';
require 'app/Controllers/LoginSignupControllers.php';

use App\Controllers\LoginSignupController;

$controller = new LoginSignupController();


  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = trim($_POST['email']);
    $password = $_POST['password'];

     if (empty($email) || empty($password)) {
        header("Location: login.php?error=empty");
        exit;
     }

    $controller->login($email, $password);

    
  }


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>InkRipple | Login</title>
    <style>
      :root {
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
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 1rem;
      }

      .form-container {
        background: var(--light);
        padding: 2.5rem;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        width: 100%;
        max-width: 400px;
        text-align: center;
      }

      h2 {
        color: var(--accent);
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
      }

      form {
        display: flex;
        flex-direction: column;
      }

      input {
        width: 100%;
        padding: 0.9rem;
        margin-bottom: 1rem;
        border: 1px solid #ddd;
        border-radius: 6px;
        outline: none;
        font-size: 1rem;
        transition: border 0.3s ease;
      }

      input:focus {
        border-color: var(--accent);
      }

      button {
        width: 100%;
        background: var(--accent);
        color: var(--light);
        border: none;
        padding: 0.9rem;
        border-radius: 6px;
        cursor: pointer;
        font-size: 1rem;
        transition: 0.3s ease;
      }

      button:hover {
        background: #3730a3;
      }

      p {
        margin-top: 1rem;
        color: #555;
        font-size: 0.95rem;
      }

      a {
        color: var(--accent);
        text-decoration: none;
        font-weight: 500;
      }

      a:hover {
        text-decoration: underline;
      }

      @media (max-width: 480px) {
        .form-container {
          padding: 1.5rem;
        }
        h2 {
          font-size: 1.3rem;
        }
        input,
        button {
          font-size: 0.95rem;
          padding: 0.8rem;
        }
      }
    </style>
  </head>
  <body>
     <?php if(isset($_GET['success'])): ?>
        <p style="color:green; margin-bottom:10px;">
           New user registered.
        </p>
    <?php endif; ?>
    <?php if(isset($_GET['error'])): ?>
        <p style="color:red; margin-bottom:10px;">
          Invalid email or password.
        </p>
    <?php endif; ?>
    <div class="form-container">
      <h2>Welcome Back to InkRipple</h2>
      <form action="login.php" method="POST">
        <input type="email" name='email' placeholder="Email" required />
        <input type="password" name='password' placeholder="Password" required />
        <button type="submit">Login</button>
      </form>
      <p>Not signed up yet? <a href="signup.php">Create an account</a></p>
    </div>
  </body>
</html>
