<?php
  # standard header
  # Authors: Jonathan Price, Cindy La
  require_once("../../../../cs315/db_login.php");
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  
  session_start();
  if (!isset($_SESSION['username'])):
    header("Location: ../login.php");
    exit;
  endif;
  $username = $_SESSION['username'];
 
  # sanitize GET containing pid
  if (!isset($_GET['pid'])):
    $_SESSION['error_message'] = "no pid";
    $_SESSION['error_data'][0] = htmlspecialchars($_GET['pid']);
    header("Location: home.php?status=error&from=edit_item");
    exit;
  elseif (!preg_match('/^\d{5}$/', $_GET['pid'])):
    $_SESSION['error_message'] = "bad pid format";
    $_SESSION['error_data'][0] = htmlspecialchars($_GET['pid']);
    header("Location: home.php?status=error&from=edit_item");
    exit;
  else:
    $pid = $_GET['pid'];
  endif;
  
  # connect to database
  $db = new PDO(
    "mysql:host=$db_hostname;dbname=jmp3748;charset=utf8",
    $db_username, $db_password,
    array(PDO::ATTR_EMULATE_PREPARES => false,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  
  # delete item
  $statement = $db->prepare('delete from item 
    where id = :pid and owner = :owner;');
  $statement->bindParam(':pid', $pid);
  $statement->bindParam(':owner', $username);
  $statement->execute();

  # return to home
  header("Location: ../home.php?status=ok");
  exit;
?>
