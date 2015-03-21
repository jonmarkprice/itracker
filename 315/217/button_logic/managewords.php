<?php
# Jonathan Price
error_reporting(E_ALL);
ini_set('display_errors', '1');

define( 'DEFINITION_FILENAME', 'words.txt' );

# read a file of text, strip newlines
# return the file as an array of lines
function get_a_file( $filename )
{
  $lines = file( $filename, FILE_IGNORE_NEW_LINES );
  return $lines;
}

function add_word()
{
  echo "you chose to add a new word.<br />";
  $word_list = get_a_file(DEFINITION_FILENAME);
  
  #TODO get input from user:
  $word = "";
  $part_of_speech = "";
  $def = "";

  $new_line = $word . '\t' . $part_of_speech . '\t' . $def . PHP_EOL;
  array_push($word_list, $new_line);
  sort($word_list);
  #TODO write new array to file;

  #foreach($lines as $line){
  #  arr
  #}
}

function delete_word($index)
{
  echo "you chose to delete word $index.<br />";
  #unset()
}

function edit_word($index)
{
  echo "you chose to edit word $index.<br />";
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Manage Vocab</title>
    <meta name="author" content="Jon Beck" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="managewords.css" />
  </head>

  <body>
    <h1>Manage GRE Vocabulary Words</h1>

    <?php
      #TODO fix indent from a decent editor
      $lines = get_a_file( DEFINITION_FILENAME );

      if( $_POST ):
	$keys = array_keys( $_POST );
	$button = array_pop( $keys );
	echo "you pushed $button." . PHP_EOL;
	# echo substr($button, 0, 2);
	if($button == "add"):
	  $lines = add_word($lines);	
	elseif(substr($button, 0, 2) == "ed"):

	  $lines = edit_word(substr($button, 2));

	elseif(substr($button, 0, 3) == "del"):
	  $index = substr($button, 3);
	  $lines = delete_word($index, $lines);
	else:
		echo "error";
	endif;
       endif;
    ?>

    <form method="post" action="managewords.php">

      <p>
        <button type="submit" name="add" value="1">
          Add A New Word
        </button>
      </p>

      <hr />

      <!-- php $lines = get_a_file( DEFINITION_FILENAME ); -->
        <dl>

        <?php
           $line_count = 0;
           foreach( $lines as $line ):
           list( $word, $part_of_speech, $definition ) =
              explode( "\t", $line ); ?>

           <button type="submit" class="delbut" value="1"
                   name="del<?= $line_count ?>">
             Delete
           </button>

           <button type="submit" class="edbut" value="1"
                   name="ed<?= $line_count ?>">
             Edit
           </button>

           <dt>
             <?= $word ?>:
               <span class="partofspeech"><?= $part_of_speech ?></span>
           </dt>

           <dd><?= $definition ?></dd>

           <?php
           $line_count++;
           endforeach;
        ?>
        </dl>
	<div>
	  <input type="hidden" name="op" value="<?= $op ?>" />
	  <input type="hidden" name="index" value="<?= $index ?>" />
	</div>
    </form>
  </body>
</html>
