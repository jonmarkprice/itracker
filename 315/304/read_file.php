<?php
# Jonathan Price
# Read three-field .csv file and display contents

# read a file of text, strip newlines
# return the file as an array of lines
function read_file( $filename )
{
  $lines = file( $filename, FILE_IGNORE_NEW_LINES );
  return $lines;
}
?>
<!DOCTYPE html>
<?php
  $filename = "users.csv";
  $lines = read_file($filename);
?>
<html>
	<body>
    <?php foreach ($lines as $line):
      list( $username, $display_name, $pw_hash) = explode("\t", $line);
    ?>
    <p>
      <?= $username ?> <?= $display_name ?> <?= $pw_hash ?>
    </p>
    <?php endforeach ?>
  </body>
</html>