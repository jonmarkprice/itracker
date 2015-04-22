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

  $regex = ["pid" => "^\d{5}$", "unit" => "^Each|6\-pack$"];

if (isset($_POST['data_entered'])):

  # sanitize inputs
  $fields = ["pid", "name", "desc", "unit"];
  foreach ($fields as $field):
    if (!isset($_POST[$field])):
      $_POST['error'] = "Error: $field not set!";
      exit;
    else:
      $_SESSION[$field] = htmlspecialchars($_POST[$field]);
    endif;
  endforeach;

  # check correct format
  foreach ($regex as $field => $exp):
    if (!preg_match($exp, $_SESSION[$field])):
      $_POST['error'] = "Error: $field not in correct format!";
      exit;
    endif;
  endforeach;

  # redirect if submitted
    header("Location: lib/add_item.php");
    exit;
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
    <?php if (isset($_POST['error'])): ?>
      <p class="error"><?= $_POST['error'] ?></p>
    <?php endif; ?>
    <form method="POST" action="lib/add_item.php">
    <p>
      <label>Product ID:</label>
      <input type="text" id="pid" name="pid" 
             pattern="<?= $regex['pid'] ?>" autofocus="autofocus" />
    </p>
    <p>
      <label>Name:</label>
      <input type="text" id="name" name="name" />
    </p>
    <p>
      <label>Flavor/Size/Collection:</label>
      <input type="text" id="desc" name="desc" />
    </p>
    <p>
      <label>Unit:</label>
      <select name="unit">
        <option value="Each">Each</option>
        <option value="6-pack">6-Pack</option>
      </select>
    </p>
    <!-- <p>
      <label>
        Date:
      </label><input type="date" name="date" pattern="/^(19|20)\d{2}[- /.]
         (0[1-9]|1[012][- /.](0[1-9]|[12][0-9]|3[01])$/" />
    </p> -->
    <input type="hidden" name="data_entered" value="true" />
    <p class="button">
      <button type="submit" name="addItem">Add Item</button>
    </p>
    </form>

    <p><a href="home.php">Return to Home</a> </p>
  </body>
</html>
