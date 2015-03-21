<!DOCTYPE html>
<html>
  <head>
    <title>Add A Word</title>
    <meta name="author" content="Jonathan Price" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="managewords.css" />
  </head>
  <body>
    <form method="POST" action="managewords.php">
      <input type="text" name="word" />
      <select name="part_of_speech">
        <option value="noun">noun</option>
        <option value="verb">verb</option>
        <option value="adjective">adjective</option>
      </select>
      <input type="text" name="def" />
      <button type="submit">Add</button>
    </form>
  </body>
</html>
