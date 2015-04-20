<?php
  # standard header
  # Authors: Jonathan Price, Cindy La
  require_once("../../../cs315/db_login.php");
  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  # must be logged on to view profile
  session_start();
  if (!isset($_SESSION['username'])):
    header("Location: login.php");
    exit;
  endif;

  # connect to database
  $db = new PDO(
    "mysql:host=$db_hostname;dbname=jmp3748;charset=utf8",
    $db_username, $db_password,
    array(PDO::ATTR_EMULATE_PREPARES => false,
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  # get username, email and full name of user
  $stmt = $db->prepare('select username, firstname, lastname, email from user where username = :username;');
  $stmt->bindParam(':username', $_SESSION['username']);
  $stmt->execute();
  $result = $stmt->fetchAll();
  $user = $result[0]; 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Profile</title>
  </head>
  <body>
    <h1>Your Profile</h1>
    <table>
      <tr>
        <th>Username</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
      </tr>
      <tr>
        <td><?= $user['username'] ?></td>
        <td><?= $user['firstname'] ?></td>
        <td><?= $user['lastname'] ?></td>
        <td><?= $user['email'] ?></td>
      </tr>
    </table>
  </body>
</html>
