 <?php
# read a file of text, strip newlines
# return the file as an array of lines
function get_a_file( $filename )
{
  $lines = file( $filename, FILE_IGNORE_NEW_LINES );
  return $lines;
}

# overwrite file
function write_to_file($lines, $filename)
{
  $file = fopen($filename, "w");
  foreach($lines as $line):
    fwrite($file, $line . PHP_EOL);
  endforeach;
  fclose($file);
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Cindy La and Jonathan Price" />
    <link rel="stylesheet" href="itracker.css" />
    <title>Add Item</title>
  </head>
  <body>

    <h1>Add a new item to your inventory!</h1>

    <form method="post" action="add.php">

    <p>
      <label>
        Name of item:
      </label><input type="text" autofocus="autofocus" name="itemName" />
    </p>

    <p>
      <label>
        Description:
      </label><input type="text" name="desc" />
    </p>

    <p>
      <label>
        Flavor/Size/Collection:
      </label><input type="text" name="type" />
    </p>

    <p>
      <label>
        Quantity:
      </label><input type="text" name="quant" pattern="/^\d+$/" />
    </p>

    <p>
      <label>
        Date:
      </label><input type="date" name="date" pattern="/^(19|20)\d{2}[- /.]
         (0[1-9]|1[012][- /.](0[1-9]|[12][0-9]|3[01])$/" />
    </p>

    <p class="button">
      <button type="submit" name="addItem">Add Item</button>
    </p>

    </form>

<?php
  $filename = "input.txt";
  $lines = get_a_file($filename);

    if( isset($_POST['addItem']) ):
      $new_line = $_POST['itemName'] . "\t"
      . $_POST['desc'] . "\t"
      . $_POST['type'] . "\t"
      . $_POST['quant'] . "\t"
      . $_POST['date'];
      array_push($lines, $new_line);
      write_to_file($lines, $filename);
    endif;
?>

  <a href="home.php">Return to Home</a>

  </body>
</html>
