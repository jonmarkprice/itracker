<?php
# TODO:
# - consider creating a database object
# - consider create an error object

  # Authors: Jonathan Price, Cindy La  
  require_once("../../../cs315/db_login.php");
  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  # redirect if user not logged in
  session_start();
  if (!isset($_SESSION['username'])):
    header("Location: login.php");
    exit;
  endif;
  $username = $_SESSION['username'];

  # connect to database
  $db = new PDO(
    "mysql:host=$db_hostname;dbname=jmp3748;charset=utf8",
    $db_username, $db_password,
    array(PDO::ATTR_EMULATE_PREPARES => false,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    
  # get username, email and full name of user
  $stmt = $db->prepare('select firstname, lastname, email from user where username = :username;');
  $stmt->bindParam(':username', $_SESSION['username']);
  $stmt->execute();
  $result = $stmt->fetchAll();
  $user = $result[0];

  # check if info returned
  if ($item == null):
    $_SESSION['error_message'] = "user not found";
    $_SESSION['error_data'][0] = $_SESSION['username'];
    header("Location: home.php?status=error&from=edit_user");
    exit;
  endif;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="author" content="Cindy La and Jonathan Price" />
  <link rel="stylesheet" href="style/itracker.css" />
  <title>Edit Profile</title>
</head>
<body>
  <h1>Edit your profile!</h1>
  <?php if (isset($_GET['error'])): ?>
    <p class="error"><?= $_SESSION['error_message'] ?></p>
  <?php endif; ?>
  <form action="lib/update_user.php" method="POST">
    <p>
      <label>Username: </label>
      <?= $_SESSION['username'] ?>
    </p>

    <p>
      <label for="firstname">First name: </label>
      <input type="text" pattern="\w+" required="required" name="firstname" 
             id="firstname" value="<?= $user['firstname'] ?>" />
    </p>

    <p>
      <label for="lastname">Last name: </label>
      <input type="text" pattern="\w+" required="required" name="lastname" 
             id="lastname" value="<?= $user['lastname'] ?>" />
    </p>

    <p>
      <label for="email">Email address: </label>
      <input type="text" pattern="\w+@\w+\.\w+" required="required" name="email" 
             id="email" value="<?= $user['email'] ?>" />
    </p>

  <button type="submit" name="submit">Edit Account</button>

  <input type="hidden" name="data_entered" value="true" />
  
  <p><a href="home.php">Return to Home</a></p>
</body>
</html>
