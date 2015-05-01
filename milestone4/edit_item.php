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

  # TODO: move to User class (User->[field]->check_format())
  $regex = ["pid" => "^\d{5}$",  "quant" => "\d+"];

  # connect to database
  $db = new PDO(
    "mysql:host=$db_hostname;dbname=jmp3748;charset=utf8",
    $db_username, $db_password,
    array(PDO::ATTR_EMULATE_PREPARES => false,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  
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

  # get info from database
  $getitem = $db->prepare('select name, unit, description, quantity from item 
    where (owner = :owner) and (id = :pid);');
  $getitem->bindParam(':pid', $pid);
  $getitem->bindParam(':owner', $username);
  $getitem->execute();
  $rows = $getitem->fetchAll();
  $item = $rows[0];

  # check if info returned
  if ($item == null):
    $_SESSION['error_message'] = "item not found";
    $_SESSION['error_data'][0] = $pid;
    $_SESSION['error_data'][1] = $username;
    header("Location: home.php?status=error&from=edit_item");
    exit;
  endif;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="author" content="Cindy La and Jonathan Price" />
  <link rel="stylesheet" href="style/itracker.css" />
  <title>Edit Item</title>
</head>
<body>
  <h1>Edit an item in your inventory!</h1>
  <?php if (isset($_GET['error'])): ?>
    <p class="error"><?= $_SESSION['error_message'] ?></p>
  <?php endif; ?>
  <form method="POST" action="lib/update_item.php">
    <p>
      <label>Product ID:</label>
      <?= $pid ?>
    </p>
    <p>
      <label>Name:</label>
      <input type="text" id="name" name="name" value="<?= $item['name'] ?>" />
    </p>
    <p>
      <label>Flavor/Size/Collection:</label>
      <input type="text" id="desc" name="desc" 
             value="<?= $item['description'] ?>" />
    </p>
    <p>
      <label>Quantity:</label>
      <input type="text" id="qaunt" name="quant" value="<?= $item['quantity'] ?>"
             pattern="<?= $regex['quant'] ?>"/>
    </p>
    <p>
      <?php #TODO: set as the current value as 'selected' ?>
      <label>Unit:</label>
      <select name="unit">
        <option value="Each">Each</option>
        <option value="6-pack">6-Pack</option>
      </select>
    </p>
    <input type="hidden" name="data_entered" value="true" />
    <button type="submit" name="addItem">Edit Item</button>
  </form>
  <p><a href="home.php">Return to Home</a></p>
</body>
</html>
