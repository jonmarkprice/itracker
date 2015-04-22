<?php
  # standard header
  # Authors: Jonathan Price, Cindy La
  require_once("../../../../cs315/db_login.php");
  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  # don't let user create account if already logged in
  session_start();
  if (isset($_SESSION['username'])):
    header("Location: ../home.php");
    exit;
  endif;

  if(!isset($_POST['data_entered'])):
    header("Location: ../signup.html");
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

  # add new user to database
  $stmt = $db->prepare('insert into user (username, firstname, lastname, email, password_hash) values (:username, :firstname, :lastname, :email, :pwhash);');
  $stmt->bindParam( ':username', $username );
  $stmt->bindParam( ':firstname', $firstname );
  $stmt->bindParam( ':lastname', $lastname );
  $stmt->bindParam( ':email', $email );
  $stmt->bindParam( ':pwhash', $pwhash );
  $stmt->execute();

  #log new user in
  $_SESSION['username'] = $username;
  header("Location: ../home.php");
  exit;
?>
