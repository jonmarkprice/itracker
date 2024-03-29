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

  $loggedin = isset( $_SESSION['username'] ) && isset( $_SESSION['fullname'] );

  # connect to database
  $db = new PDO(
    "mysql:host=$db_hostname;dbname=jmp3748;charset=utf8",
    $db_username, $db_password,
    array(PDO::ATTR_EMULATE_PREPARES => false,
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  # get all items owned by user
  $get_items = $db->prepare('select id, name, description, quantity, unit 
    from item where owner = :username;');
  $get_items->bindParam(':username', $username);
  $get_items->execute();
  $rows = $get_items->fetchAll();

  $get_name = $db->prepare('select firstname, lastname from user where username = :username;');
  $get_name->bindParam(':username', $username);
  $get_name->execute();
  $users = $get_name->fetchAll();
  $firstname = $users[0]['firstname'];
  $lastname = $users[0]['lastname'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style/itracker.css" />
    <title>Home</title>
  </head>
  <body>
    <h1>CL Inventory Tracker</h1>
    <ul id="nav">
      <li>Hello <?= $firstname ?>!</li>
      <li><a href="contact.html">Contact Us</a></li>
      <li><a href="profile.php">View Profile</a></li>
      <li><a href="lib/logout.php">Logout</a></li>
    </ul>
    <?php if (isset($_SESSION['error_message'])): ?>
    <div id="errors">
      <p id="message">Error: <?= $_SESSION['error_message'] ?></p>
    </div>
    <?php unset($_SESSION['error_message']); endif; ?>
    <p>
      Welcome to the inventory tracker created by Cindy and Jon.  This is
      a tool to help you organize your business as easily and efficiently
      as possible.
    </p>

    <?php if( count($rows) == 0): ?>
      <p>No items added yet. <a href="enter_item.php">Add some!</a></p>
    <?php else: ?>
    <table>
      <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Quantity</th>
        <th>Unit</th>
        <th colspan="2">Actions</th>
      </tr>
      <?php foreach($rows as $row): ?>
      <tr>
        <td><?= $row['name'] ?></td>
        <td><?= $row['description'] ?></td>
        <td><?= $row['quantity'] ?></td>
        <td><?= $row['unit'] ?></td>
        <td>
          <form action="edit_item.php?pid=<?= $row['id'] ?>" method="POST">
            <button type="submit">Edit</button>
          </form>
        </td>
        <td>
          <form action="lib/delete_item.php?pid=<?= $row['id'] ?>" method="POST">
            <button type="submit">Delete</button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
    <p><a href="enter_item.php">Add another item</a>.</p>
    <?php endif; ?>

    <footer>
      &copy;2015, CL Inventory Tracker
    </footer>
  </body>
</html>
