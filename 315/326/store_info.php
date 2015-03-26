<?php
require_once("../../../cs315/db_login.php");

// connect to database
$db = new PDO(
  "mysql:host=$db_hostname;dbname=jmp3748;charset=utf8",
  $db_username, $db_password,
  array(PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

// sanitize inputs and assign
$username = htmlspecialchars($_POST['username']);
$firstname = htmlspecialchars($_POST['firstname']);
$lastname = htmlspecialchars($_POST['lastname']);
$email = htmlspecialchars($_POST['email']);
$pwhash = password_hash($_POST['password'], PASSWORD_DEFAULT);

// prepare insert 
$sql = 'insert into user (username, firstname, lastname, email, pwhash)
        values (:username, :firstname, :lastname, :email, :pwhash)';
$insert_statement = $db->prepare( $sql );
$insert_statement->bindParam( ':username', $username );
$insert_statement->bindParam( ':firstname', $firstname );
$insert_statement->bindParam( ':lastname', $lastname );
$insert_statement->bindParam( ':email', $email );
$insert_statement->bindParam( ':pwhash', $pwhash );
$insert_statement->execute();

header("location: display_info.php");
?>