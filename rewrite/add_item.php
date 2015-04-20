<?php
  # standard header
  # Authors: Jonathan Price, Cindy La
  require_once("../../../cs315/db_login.php");
  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  session_start();
  if (!isset($_SESSION['username'])):
    header("Location: login.php");
    exit;
  endif;
  $username = $_SESSION['username'];

  if(!isset($_POST['data_entered'])):
    header("Location: enter_item.php");
    exit;
  endif;

  # sanitize inputs
  if (preg_match('|^\d{5}$|', $_POST['pid'])):
    $id = $_POST['pid'];
  endif;
  $name = htmlspecialchars($_POST['name']);
  $subname = htmlspecialchars($_POST['subname']);
  $unit = htmlspecialchars($_POST['unit']);

  # connect to database
  $db = new PDO(
    "mysql:host=$db_hostname;dbname=jmp3748;charset=utf8",
    $db_username, $db_password,
    array(PDO::ATTR_EMULATE_PREPARES => false,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  # add new user to database
  $statement = $db->prepare('insert into item (id, owner, name, description, unit)
    values(:pid, :owner, :name, :description, :unit);');
  $statement->bindParam(':pid', $pid, PDO::PARAM_INT);
  $statement->bindParam(':owner', $username, PDO::PARAM_STR);
  $statement->bindParam(':name', $name, PDO::PARAM_STR);
  $statement->bindParam(':description', $subname, PDO::PARAM_STR);
  $statement->bindParam(':unit', $unit, PDO::PARAM_STR);
  $statement->execute();
?>