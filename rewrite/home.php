<?php
  # standard header
  # Authors: Jonathan Price, Cindy La
  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  # redirect to log-in page not logged in
  session_start();
  if (!isset($_SESSION['username'])):
    header("Location: login.php");
    exit;
  else:
    $username = $_SESSION['username'];
  endif;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="../milestone3/style/session.css" />
    <title>Session Demo</title>
  </head>
  <body>
    <p>Hello <a href="profile.php"><?= $username ?></a>!</p>
  </body>
</html>

