 <?php
# adapted from Stepp, Miller, and Kirst 6.5
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

# take a tab-separated array of lines consisting of a word, a part
# of speech, and a definition
# randomly choose one part of speech
# randomly choose 5 lines of the array that match that part of speech
function get_5_choices( $lines )
{
  $parts = array();
  foreach( $lines as $line ):
    list( $word, $part_of_speech, $definition ) = explode( "\t", $line );
    $parts[ $part_of_speech ] = 1;
  endforeach;

  $all_parts = array_keys( $parts );
  shuffle( $all_parts );
  $chosen_part = array_pop( $all_parts );

  shuffle( $lines );

  $choices = array();
  while( count( $choices ) < 5 ):
    $line = array_pop( $lines );
    list( $word, $part_of_speech, $definition ) = explode( "\t", $line );
    if( $part_of_speech == $chosen_part ):
      array_push( $choices, $line );
    endif;
  endwhile;

  return $choices;
}

# take a tab-separated array of lines consisting of a word, a part
# of speech, and a definition, and one word
# return the definition that matches that word
function get_definition( $lines, $searchword )
{
  foreach( $lines as $line ):
    list( $word, $part_of_speech, $definition ) = explode( "\t", $line );
    if( $searchword == $word ):
      return $definition;
    endif;
  endforeach;
  return ''; # word not found; should be impossible to get here
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>GRE Vocab Quiz</title>
    <meta name="author" content="Jon Beck" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="quiz.css" />
  </head>

  <body>
    <h1>Zelda&rsquo;s GRE Vocabulary Quiz</h1>

    <?php
      $lines = get_a_file( DEFINITION_FILENAME );
      $correct = 0;
      $total = 0;

      if( isset( $_POST['guess'] )):
        $realword = $_POST['word'];
        $guess = $_POST['guess'];
        $correct = $_POST['correct'];
        $total = $_POST['total'];
        $total++;

        $definition = get_definition( $lines, $realword );
        if( $definition == $guess ):
          $correct++;
          ?>

          <h2 class="correct">Correct!</h2>

          <?php
        else:
          ?>

          <h2 class="incorrect">Incorrect!</h2>
          <p class="incorrect">
            The definition of <?= $realword ?> is: <?= $definition ?>
          </p>

          <?php
        endif;
        ?>

        <h3>Your score: <?= $correct ?> / <?= $total ?> </h3>

        <?php
      endif;

      $choices = get_5_choices( $lines );
      list( $answer, $part_of_speech, $definition ) =
        explode( "\t", $choices[0] );
      shuffle( $choices );
    ?>

    <h2>
      <?= $answer ?> &mdash;
      <span class="partofspeech"><?= $part_of_speech ?></span>
    </h2>

    <form action="quiz.php" method="post">
      <ul id="choices">

        <?php
        $item = 0;
        foreach( $choices as $line ):
          list( $word, $part_of_speech, $definition ) =
            explode( "\t", $line );
            ?>
            <li>
              <input type="radio" name="guess" value="<?= $definition ?>" 
                     id="item<?= $item ?>" />
              <label for="item<?= $item ?>">
                <?= $definition ?>
              </label>
            </li>
            <?php
            $item++;
         endforeach;
         ?>

      </ul>

      <div>
        <input type="hidden" name="word" value="<?= $answer ?>" />
        <input type="hidden" name="total" value="<?= $total ?>" />
        <input type="hidden" name="correct" value="<?= $correct ?>" />
        <button id="submit" type="submit">Submit </button>
      </div>

    </form>
  </body>
</html>

