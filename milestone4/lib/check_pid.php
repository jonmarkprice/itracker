<?php
  # standard header
  # Authors: Jonathan Price, Cindy La
  require_once("../../../../cs315/db_login.php");
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  
  session_start();
  if (!isset($_SESSION['username'])):
#    header("Location: ../login.php");
    exit;
  endif;
  $username = $_SESSION['username'];
/*  
  if(!isset($_POST['data_entered'])):
    header("Location: ../login.php");
    exit;
  endif;
*/
  # sanitize inputs
  $field = "pid";
  if (!isset($_GET[$field])):
    echo "Error: $field not set!";
    exit;
  endif;

  # check correct format
    if (!preg_match("/^\d{5}$/", $field)):
      $error = "Error: $field not in correct format!";
      exit;
    endif;

  # connect to database
  $db = new PDO(
    "mysql:host=$db_hostname;dbname=jmp3748;charset=utf8",
    $db_username, $db_password,
    array(PDO::ATTR_EMULATE_PREPARES => false,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  
  # add new user to database
  $statement = $db->prepare('select id from item 
    where owner = :owner and id = :pid;');
  $statement->bindParam(':pid', $item['pid']);
  $statement->bindParam(':owner', $username);
  $statement->execute();

  $rows = $statement->fetchAll();

  # id already exists in db
  if ($rows != null):?>
    Product already in database.
  <?php endif;

?>Error<?php

?>

