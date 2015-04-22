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

  $db = new PDO("mysql:host=$db_hostname; dbname=jmp3748; charset=utf8",
      $db_username, $db_password,
      array(PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  $entry = 'insert into item (id, owner, name, description, unit)
           values(:pid, :owner, :name, :description, :unit)';

  $statement = $db->prepare($entry);

  if(isset($_POST['enter'])):

    if(isset($_POST['pid']) && preg_match('|^\d{5}$|', $_POST['pid'])):
      $pid = $_POST['pid'];
      $statement->bindParam(':pid', $pid, PDO::PARAM_INT);
    endif;

    $statement->bindParam(':owner', $username, PDO::PARAM_STR);

    if(isset($_POST['name'])):
      $name = htmlspecialchars($_POST['name']);
      $statement->bindParam(':name', $name, PDO::PARAM_STR);
    endif;

    if(isset($_POST['subname'])):
      $subname = htmlspecialchars($_POST['subname']);
      $statement->bindParam(':description', $subname, PDO::PARAM_STR);
    endif;

    if(isset($_POST['unit'])):
      $unit = htmlspecialchars($_POST['unit']);
      $statement->bindParam(':unit', $unit, PDO::PARAM_STR);
    endif;

    $statement->execute();

  endif;

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

    <form method="post" action="add.php">

    <p>
      <label>
        Product ID:
      </label><input type="text" id="pid" name="pid" 
               pattern="|^\d{5}$|" autofocus="autofocus" />
    </p>

    <p>
      <label>
        Name: 
      </label><input type="text" id="name" name="name" />
    </p>

    <p>
      <label>
        Flavor/Size/Collection:
      </label><input type="text" id="subname" name="subname" />
    </p>

    <p>
      <label>
        Unit: 
      </label><input type="text" id="unit" name="unit" placeholder="Each or 6-pack"
               pattern="|^(Each|6-pack)$|" />
    </p>
<!--
    <p>
      <label>
        Date:
      </label><input type="date" name="date" pattern="/^(19|20)\d{2}[- /.]
         (0[1-9]|1[012][- /.](0[1-9]|[12][0-9]|3[01])$/" />
    </p>
-->
    <p class="button">
      <button type="submit" name="addItem">Add Item</button>
    </p>

    </form>

    <p> <a href="home.php">Return to Home</a> </p>

  </body>
</html>

