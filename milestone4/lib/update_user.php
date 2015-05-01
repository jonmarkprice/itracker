<?php
  # standard header
  # Authors: Jonathan Price, Cindy La
  require_once("../../../../cs315/db_login.php");
  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  session_start();
  if (isset($_SESSION['username'])):
    header("Location: ../home.php");
    exit;
  endif;

  if(!isset($_POST['data_entered'])):
    header("Location: ../home.html");
    exit;
  endif;
  	
  # sanitize inputs
  $username = htmlspecialchars($_POST['username']);
  $firstname = htmlspecialchars($_POST['firstname']);
  $lastname = htmlspecialchars($_POST['lastname']);
  $email = htmlspecialchars($_POST['email']);
  $pwhash = password_hash($_POST['password'], PASSWORD_DEFAULT);

  # connect to database
  $db = new PDO(
    "mysql:host=$db_hostname;dbname=jmp3748;charset=utf8",
    $db_username, $db_password,
    array(PDO::ATTR_EMULATE_PREPARES => false,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  # TODO
  # make sure the username does not already exist

  # update user in database
  $stmt = $db->prepare('update user set
    firstname = :firstname,
    lastname = :lastname,
    email = :email
    where username = :username;');
  $stmt->bindParam( ':username', $username );
  $stmt->bindParam( ':firstname', $firstname );
  $stmt->bindParam( ':lastname', $lastname );
  $stmt->bindParam( ':email', $email );
  $stmt->execute();

  # return to home
  $_SESSION['username'] = $username;
  header("Location: ../home.php");
  exit;
?>
