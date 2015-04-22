<?php
  # standard header
  # Authors: Jonathan Price, Cindy La
  require_once("../../../../cs315/db_login.php");
  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  # don't let the user try to log-in again, if already logged in
  session_start();
  if (isset($_SESSION['username'])):
    header("Location: ../home.php");
    exit;
  endif;

  # check and sanitize username and password from POST
  if (!isset($_POST['username']) || !isset($_POST['password'])):
    header("Location: ../login.php");
    exit;
  endif;
  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars($_POST['password']);

  # connect to database
  $db = new PDO(
    "mysql:host=$db_hostname;dbname=jmp3748;charset=utf8",
    $db_username, $db_password,
    array(PDO::ATTR_EMULATE_PREPARES => false,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  # get password hash from database
  $stmt = $db->prepare('select password_hash from user
    where username = :username;');
  $stmt->bindParam(':username', $username);
  $stmt->execute();
  $result = $stmt->fetchAll();

  if (empty($result)):
    header("Location: ../login.php?user=$username&error=no_user");
    exit;
  endif;
  $password_hash = $result[0]['password_hash'];

  if (password_verify($_POST['password'], $password_hash)):   
    # set session variables and redirect
    $_SESSION['username'] = $username;
    header("Location: ../home.php");
    exit;
  else:
    header("Location: ../login.php?user=$username;error=bad_pw");
    exit;
  endif;
?>
