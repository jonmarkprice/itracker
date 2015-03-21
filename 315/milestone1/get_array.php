<?php
$lines = file( $filename, FILE_IGNORE_NEW_LINES );
$i = 0;
foreach( $lines as $line):
  list($name, $desc, $type, $n, $date) = explode("\t", $line);
  $items[$i]["Name"] = $name;
  $items[$i]["Desc"] = $desc;
  $items[$i]["Type"] = $type;
  $items[$i]["#"] = $n;
  $items[$i]["Date"] = $date;
endforeach;
?>
