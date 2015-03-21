<?php
	$file = fopen("words.txt", "w") or die("Can't open words.txt!");
	$text = "whatever";
	fwrite($file, $text);
	fclose($file);
?>
