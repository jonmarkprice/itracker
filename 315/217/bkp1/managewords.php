<?php
# Jonathan Price
error_reporting(E_ALL);
ini_set('display_errors', '1');
define( 'DEFINITION_FILENAME', 'words.txt' );

#session_start();


# read a file of text, strip newlines
# return the file as an array of lines
function get_a_file( $filename )
{
  $lines = file( $filename, FILE_IGNORE_NEW_LINES );
  return $lines;
}

# overwrite file
function rewrite_file($lines)
{
  $file = fopen("copy.txt", "w");
  foreach($lines as $line):
    fwrite($file, $line . PHP_EOL);
  endforeach;
  fclose($file);
}

if( isset($_POST['del']) ):
 
endif;

if( isset($_POST['add']) ):

endif;


?>
<!DOCTYPE html>
<html>
  <head>
    <title>Manage Vocab</title>
    <meta name="authors" content="Jon Beck, Jonathan Price" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="managewords.css" />
 </head>
<body>
  <h1>Manage GRE Vocabulary Words</h1>
  <?php
    $lines = get_a_file( DEFINITION_FILENAME );
    if( isset($_POST['ed']) ):
      $line_num = $_POST['ed'];
      $to_edit = $lines[$line_num];
      list($word, $part_of_speech, $def ) = explode( "\t", $to_edit );
  ?>
  <div class="edit_pane">
    <p><?= $word ?>
      <form method="POST" action="managewords.php">
        <select name="part_of_speech">
          <option value="noun">noun</option>
          <option value="verb">verb</option>
          <option value="adj">adjective</option>
        </select>
        <input type="text" name="def" />
        <input type="hidden" name="word_edited" value="<?= $word ?>" />
        <input type="hidden" name="line_edited" value="<?= $line_num ?>" />
        <button type="submit">Edit</button>
      </form>
    </p>
  </div>

  <?php
    endif;
    if(isset($_POST['part_of_speech']) && isset($_POST['def'])): 
  ?>
  <!-- TESTING ONLY --> 
  <p>P.edited: O.S: <?= $_POST['part_of_speech'] ?> 
     new def: <?= $_POST['def'] ?></p>
  <?php
      $line_num = $_POST['line_edited'];
      $lines[$line_num] = $_POST['word_edited'] . "\t" 
                        .  $_POST['part_of_speech'] . "\t"
                        . $_POST['def'] . PHP_EOL;
      rewrite_file($lines);
    endif;
  ?>

  <p>
    <form method="POST" action="managewords.php">
      <button type="submit" name="add">Add A New Word</button>
    </form>
  </p>
  <?php if( isset($_POST['add']) ): ?>
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
  <?php endif; ?>
  <hr />
  <?php
    $line_count = 0;
    foreach( $lines as $line ):
      list( $word, $part_of_speech, $definition ) = explode( "\t", $line );
  ?> 
  <form method="POST" action="managewords.php">
    <button type="submit" class="delbut" value="<?= $line_count ?>"
            name="del">
      Delete
    </button>
    <button type="submit" class="edbut" value="<?= $line_count ?>"
            name="ed">
      Edit
    </button>
    <dt id="def<?= $line_count ?>">
      <?= $word ?>:
      <span class="partofspeech"><?= $part_of_speech ?></span>
    </dt>
    <dd><?= $definition ?></dd>
  </form>
  <?php
      $line_count++;
  endforeach;
  ?>
</body>
</html>