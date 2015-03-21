<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Your Name Here" />
    <title>Movies By Year</title>
  </head>

  <body>

<?php
require_once( '../../cs315/dblogin.php' );

$db = new PDO( "mysql:host=$db_hostname;dbname=imdb;charset=utf8",
    $db_username, $db_password,
    array(PDO::ATTR_EMULATE_PREPARES => false,
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$year = 2003;

$query = 'select name, format( rank, 2 ) as rank
          from movie 
          where year = :year 
          order by name asc';
$statement = $db->prepare( $query );
$statement->bindParam( ':year', $year, PDO::PARAM_INT );
$statement->execute();
$result = $statement->fetchAll();
?>
    <h1>Movies Made in <?= $year ?></h1>
    <?php if( count( $result ) == 0 ): ?>

      <p>There were no movies made in <?= $year ?></p>

    <?php else: ?>

      <?php foreach( $result as $row ): ?>
        <dl>
          <dt><?= $row['name'] ?></dt>
          <dd>had a rank of <?= $row['rank'] ?></dd>
        </dl>
      <?php endforeach; ?>

    <?php endif; ?>

  </body>
</html>
