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
  
  if(!isset($_POST['data_entered'])):
    header("Location: ../login.php");
    exit;
  endif;

  # sanitize inputs
  $fields = ["pid", "name", "desc", "quant", "unit"];
  $item = [];
  foreach ($fields as $field):
    if (!isset($_POST[$field])):
      $error = "Error: $field not set!";
      header("Location: ../enter_item.php?error=$error");
      exit;
    else:
      $item[$field] = htmlspecialchars($_POST[$field]);
    endif;
  endforeach;

  # TODO: move to User class (User->[field]->check_format())
  # note that html wont work with (some?) delimiters while php requires them
  $regex = ["pid" => "/^\d{5}$/", 
    "unit" => "/^Each|6\-pack$/",
    "quant" => "|^\d+$|"];

  # check correct format
  foreach ($regex as $field => $exp):
    if (!preg_match($exp, $item[$field])):
      $error = "Error: $field not in correct format!";
      header("Location: ../enter_item.php?error=$error");
      exit;
    endif;
  endforeach;
  
  # connect to database
  $db = new PDO(
    "mysql:host=$db_hostname;dbname=jmp3748;charset=utf8",
    $db_username, $db_password,
    array(PDO::ATTR_EMULATE_PREPARES => false,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  
  # add new user to database
  $statement = $db->prepare('update item 
    set name = :name,
        description = :desc,
        quantity = :quant,
        unit = :unit,
    where (owner = :owner) and (id = :pid);');
  $statement->bindParam(':pid', $item['pid']);
  $statement->bindParam(':owner', $username);
  $statement->bindParam(':name', $item['name']);
  $statement->bindParam(':desc', $item['desc']);
  $statement->bindParam(':quant', $item['quant']);
  $statement->bindParam(':unit', $item['unit']);
  $statement->execute();

  # return to home
  header("Location: ../home.php?status=ok");
  exit;
?>
