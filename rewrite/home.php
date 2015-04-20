<?php
# standard header
  # Authors: Jonathan Price, Cindy La
  require_once("../../../cs315/db_login.php");
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

  # connect to database
  $db = new PDO(
    "mysql:host=$db_hostname;dbname=jmp3748;charset=utf8",
    $db_username, $db_password,
    array(PDO::ATTR_EMULATE_PREPARES => false,
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  # get all items owned by user
  $stmt = $db->prepare('select name, description, quantity, unit, in_date 
    from item where owner = :username;');
  $stmt->bindParam(':username', $username);
  $stmt->execute();
  $rows = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style/itracker.css" />
    <title>Home</title>
  </head>
  <body>
    <p>Hello <a href="profile.php"><?= $username ?></a>!</p>
    <h1>View users</h1>
    <?php if( count($rows) == 0): ?>
      <p>No items added yet.<a href="add_item.php">Add some!</a></p>
    <?php else: ?>
    <table>
      <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Quantity</th>
        <th>Unit</th>
        <th>Date In</th>
      </tr>
      <?php foreach($rows as $row): ?>
      <tr>
        <td><?= $row['name'] ?></td>
        <td><?= $row['description'] ?></td>
        <td><?= $row['quantity'] ?></td>
        <td><?= $row['unit'] ?></td>
        <td><?= $row['date_in'] ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
    <p><a href="enter_item.php">Add another item</a>.</p>
  <?php endif; ?>
  </body>
</html>
