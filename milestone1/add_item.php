
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
<?php
  $filename = "input.txt";
  $lines = get_a_file($filename);

    if( isset($_POST['addItem']) ):
      $new_line = $_POST['itemName'] . "\t"
      . $_POST['desc'] . "\t"
      . $_POST['type'] . "\t"
      . $_POST['qaunt'] . "\t"
      . $_POST['date'] . PHP_EOL;
      array_push($lines, $new_line);
      write_to_file($lines, $filename);
    endif;
?>

