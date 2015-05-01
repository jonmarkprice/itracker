<?php
  # standard header
  # Authors: Jonathan Price, Cindy La
  require_once("../../../../cs315/db_login.php");
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  
  session_start();
  if (!isset($_SESSION['username'])):
    exit;
  endif;
  $username = $_SESSION['username'];

  # sanitize input
  if (!isset($_GET['pid'])):
    echo "Error: ". $_GET['pid'] ." not set!";
    exit;
  endif;

  # check correct format
    if (!preg_match('/^\d{5}$/', $_GET['pid'])):
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
  $statement->bindParam(':pid', $_GET['pid']);
  $statement->bindParam(':owner', $username);
  $statement->execute();

  $rows = $statement->fetchAll();

  # id already exists in db
  if ($rows != null):
?>
  Product already in database.
<?php endif;?>

