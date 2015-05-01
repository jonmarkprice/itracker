<?php
  # standard header
  # Authors: Jonathan Price, Cindy La
  require_once("../../../cs315/db_login.php");
  error_reporting(E_ALL);
  ini_set('display_errors', '1');

  function gen_password($length){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz'
                   . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++):
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    endfor;
    return $randomString;
  }

  # check and sanitize username from POST
  if (!isset($_POST['username'])):
    header("Location: ../login.php");
    exit;
  endif;
  $username = htmlspecialchars($_POST['username']);

  # connect to database
  $db = new PDO(
    "mysql:host=$db_hostname;dbname=jmp3748;charset=utf8",
    $db_username, $db_password,
    array(PDO::ATTR_EMULATE_PREPARES => false,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  # get email from database
  $get_email = $db->prepare('select email from user
    where username = :username;');
  $get_email->bindParam(':username', $username);
  $get_email->execute();
  $result = $get_email->fetchAll();

  if (empty($result)):
    header("Location: ../login.php?user=$username&error=no_user");
    exit;
  else:
    $email = $result[0]['email'];
  endif;

  # generate new password
  $new_password = gen_password(10);
  $new_hash = password_hash($new_password, PASSWORD_DEFAULT);

  # update in database
  $update_pw = $db->prepare('update user 
    set password_hash = :new_hash
    where username = :username;');
  $update_pw->bindParam(':new_hash', $new_hash);
  $update_pw->bindParam(':username', $username);
  $update_pw->execute();
  
  # email user
  $subject = "Inventory tracker password reset";
  $from = "jmp3748@truman.edu";
  $msg = "Your new password for $username is $new_password \n";
  mail( $email, $subject, $msg, 'From:' . $from);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Jonathan Price, Cindy La" />
    <link rel="stylesheet" href="style/itracker.css" />
    <title>Forgot Password</title>
  </head>
  <body>
    <h1>Forgot Password</h1>
    <p>We&rsquo;ve sent an temporary password to your email at <?= $email ?>.</p>
    <p><a href="login.php">Log in</a>!</p>
  </body>
 </html>
