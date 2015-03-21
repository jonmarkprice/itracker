<?php
$lines = file("words.txt", FILE_IGNORE_NEW_LINES );

# do something

$op = "ed";
$i = 3;

if($op == "del"):
  unset( $lines[$i] );
endif;

if($op == "ed"):
  $lines[$i] = "some edits";
endif;

if($op == "add"):
  $new_line = "aoeuhaoeunthoaesuh";
  array_push($lines, $new_line);
  sort($lines);
endif;

# (over)write file
$file = fopen("copy.txt", "w");

foreach($lines as $line):
  fwrite($file, $line . PHP_EOL);
endforeach;

fclose($file);
?>
