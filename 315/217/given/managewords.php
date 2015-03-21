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
       if( $_POST ):
         # logic to deal with button actions here
       endif;
    ?>

    <form method="post" action="managewords.php">

      <p>
        <button type="submit" name="add" value="1">
          Add A New Word
        </button>
      </p>

      <hr />

      <?php $lines = get_a_file( DEFINITION_FILENAME ); ?>
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
    </form>
  </body>
</html>