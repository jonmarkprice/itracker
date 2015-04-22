<?php
require_once("../../../cs315/db_login.php");

// connect to database
$db = new PDO(
  "mysql:host=$db_hostname;dbname=jmp3748;charset=utf8",
  $db_username, $db_password,
  array(PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if(!isset($_POST['data_entered'])):
  header("Location: enter_info.html");

else:

  //echo "<p>username is set</p>";
	
  // sanitize inputs and assign
  $username = htmlspecialchars($_POST['username']);
  $firstname = htmlspecialchars($_POST['firstname']);
  $lastname = htmlspecialchars($_POST['lastname']);
  $email = htmlspecialchars($_POST['email']);
  $pwhash = password_hash($_POST['password'], PASSWORD_DEFAULT);

  //echo "<p>data in...</p>";

  // prepare insert 
  $sql = 'insert into users (username, firstname, lastname, email, pwhash)
          values (:username, :firstname, :lastname, :email, :pwhash);';
  $insert_statement = $db->prepare( $sql );

  //echo "<p>statement prepared</p>";

  $insert_statement->bindParam( ':username', $username );
  $insert_statement->bindParam( ':firstname', $firstname );
  $insert_statement->bindParam( ':lastname', $lastname );
  $insert_statement->bindParam( ':email', $email );
  $insert_statement->bindParam( ':pwhash', $pwhash );

  //echo 'parameters bound\n';

  $insert_statement->execute();

  //echo 'statement executed\n';

  header("Location: display_info.php");

endif;
?>
