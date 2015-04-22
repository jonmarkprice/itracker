<?php
  # standard header
  # Authors: Jonathan Price, Cindy La
  require_once("../../../../cs315/db_login.php");
  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  # insure user is logged in
  session_start();
  if (!isset($_SESSION['username'])):
    header("Location: ../login.php");
    exit;
  endif;
  $username = $_SESSION['username'];

  # connect to database
  $db = new PDO(
    "mysql:host=$db_hostname;dbname=jmp3748;charset=utf8",
    $db_username, $db_password,
    array(PDO::ATTR_EMULATE_PREPARES => false,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  # add new item to database
  $statement = $db->prepare('insert into item (id, owner, name, description, unit)
    values(:id, :owner, :name, :desc, :unit);');
  $statement->bindParam(':id', $_SESSION['pid']);
  $statement->bindParam(':owner', $username);
  $statement->bindParam(':name', $_SESSION['name']);
  $statement->bindParam(':desc', $_SESSION['desc']);
  $statement->bindParam(':unit', $_SESSION['unit']);
  $statement->execute();

  # return home
  header("Location: ../home.php");
  exit;
?>
