<?php
  # standard header
  # Authors: Jonathan Price, Cindy La
  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  # don't let the user try to log-in again, if already logged in
  session_start();
  if (isset($_SESSION['username'])):
    header("Location: home.php");
    exit;
  endif;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="../style/session.css" />
    <title>Session Demo</title>
  </head>

  <body>
    <header>
      <h1>
        CL Inventory Tracker
      </h1>
    </header>
    <section>
      <?php if (isset($_GET['error']) && isset($_GET['user'])): ?>
      <p id="error">
        Error: <?= $_GET['error'] ?> for user <?= $_GET['user'] ?>
      </p> 
      <?php endif; ?>      
        <form action="verify_user.php" method="POST">
          <fieldset><legend>Log In</legend>
            <p>
              <label for="username">Username: </label>
              <input type="text" pattern="\w+" required="required" 
                     name="username" autofocus="autofocus" 
                     placeholder="letters, digits, underscore" 
                     id="username" />
            </p>

            <p>
              <label for="password">Password: </label>
              <input type="password" required="required" name="password"
                     placeholder="minimum length 5" pattern="[^ ]{5,}" 
                     id="password" />
            </p>

            <p>
              <button type="submit" name="submit">Log In</button>
            </p>
            <a href="reset_pwd.php">Forgot Password</a>
          </fieldset>
        </form>
        <p>Need an account? <a href="profile.php">Sign up here</a>!</p>
    </section>
  </body>
</html>
