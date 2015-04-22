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
  $get_items = $db->prepare('select name, description, quantity, unit 
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
    <p>Hello <a href="profile.php"><?= $username ?></a>!</p>

    <h1>
      <img id="logo" src="itrack_logo.png" alt="logo" />
    </h1>
    <aside>
        <p>
          Hello <?= $firstname ?> <?= $lastname ?>!
        </p>
        <p>
          <a href="profile.php">Edit Profile</a>
        </p>
        <p>
          <a href="logout.php">Logout</a>
        </p>
    </aside>
    <ul id="nav">
      <li><a href="enter_item.php">Add New Item</a></li>
      <li><a href="contact.html">Contact Us</a></li>
      <li>
        Search for your inventory here! &#40;Insert search bar here&#41;
        <!--<form method="get" action="itracker.php">
          <input type="search" />
        </form>-->
      </li>
    </ul>

    <p>
      Welcome to the inventory tracker created by Cindy and Jon.  This is
      a tool to help you organize your business as easily and efficiently
      as possible.  You are able to add and delete items, see your whole
      inventory in tables or graphs, and find items by table sorting and
      search bar.  With the click of an item, see its sales trends
      or observe the overall incoming and outgoing items over time on
      the front page.
    </p>

    <p class="side">
      This is a work in progress, so if you have any suggestions for
      improvement please don&rsquo;t hesitate to contact us.  Any questions,
      comments, or concerns are also encouraged.
    </p>


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
    <p><a href="add_item.php">Add another item</a>.</p>
    <?php endif; ?>

    <footer>
      &copy;2015, CL Inventory Tracker
    </footer>
  </body>
</html>
