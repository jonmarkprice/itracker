<?php
session_start();  
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Edit A Word</title>
    <meta name="author" content="Jonathan Price" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="managewords.css" />
  </head>
  <body>
    <p><?= $_SESSION['word'] ?></p>
    <form method="POST" action="managewords.php">
      <select name="part_of_speech">
        <option value="noun">noun</option>
        <option value="verb">verb</option>
        <option value="adjective">adjective</option>
      </select>
      <input type="text" name="def" />
    </form>
  </body>
</html>
