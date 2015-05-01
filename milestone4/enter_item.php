<?php
  # Authors: Jonathan Price, Cindy La  
  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  # redirect if user not logged in
  session_start();
  if (!isset($_SESSION['username'])):
    header("Location: login.php");
    exit;
  endif;

  # TODO: move to User class (User->[field]->check_format())
  $regex = ["pid" => "^\d{5}$", "quant" => "\d+"];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="author" content="Cindy La and Jonathan Price" />
  <link rel="stylesheet" href="style/itracker.css" />
  <title>Add Item</title>
</head>
<body>
  <h1>Add a new item to your inventory!</h1>
  <?php if (isset($_GET['error'])): ?>
    <p class="error"><?= $_GET['error'] ?></p>
  <?php endif; ?>
  <form method="POST" action="lib/add_item.php">
    <p>
      <label>Product ID:</label>
      <input type="text" id="pid" name="pid" 
             pattern="<?= $regex['pid'] ?>" autofocus="autofocus" />
      <span id="pid_error"></span>
    </p>
    <p>
      <label>Name:</label>
      <input type="text" id="name" name="name" 
             pattern=".{2,}"/>
    </p>
    <p>
      <label>Flavor/Size/Collection:</label>
      <input type="text" id="desc" name="desc" />
    </p>
    <p>
      <label>Quantity:</label>
      <input type="text" id="qaunt" name="quant" 
             pattern="<?= $regex['quant'] ?>" />
    </p>
    <p>
      <label>Unit:</label>
      <select name="unit">
        <option value="Each">Each</option>
        <option value="6-pack">6-Pack</option>
      </select>
    </p>
    <input type="hidden" name="data_entered" value="true" />
    <button type="submit" name="addItem">Add Item</button>
  </form>
  <p><a href="home.php">Return to Home</a></p>
  <script type="text/javascript" src="lib/check_pid.js"></script>
</body>
</html>
