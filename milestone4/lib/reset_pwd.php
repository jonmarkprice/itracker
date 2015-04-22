<?php
# Jonathan Price Cindy La
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
include("functions.php");

$error_msg = '';

if(isset($_POST['reset_username'])
   && isset($_POST['reset_email'])
){
  $username = $_POST['reset_username'];
  $new_password = gen_password(10);
  $new_hash = password_hash($new_password, PASSWORD_DEFAULT);

    //TODO edit password in file
    //edit_password($username, $new_hash);

  //email user
  $to = $_POST['reset_email'];
  $subject = "Inventory tracker password reset";
  $email = "jmp3748@truman.edu";
  $msg = "Your new password for $username is $new_password \n";
  mail( $to, $subject, $msg, 'From:' . $email );

  if( ! user_exists( $username) )
  {
    $error_msg = "The username $username does not exist.";
  }
}
/*
  else
  {
    # write to file
    $fullname = $_POST['new_fullname'];
    $password = $_POST['new_password'];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    add_user($username, $fullname, $hash);

    # add to session
    $_SESSION['username'] = $username;
    $_SESSION['fullname'] = $fullname;
    $_SESSION['password'] = $hash;

    # log user in
    $already_logged_in = true;
  }
*/



?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="session.css" />
    <title>Session Demo</title>
  </head>

  <body>
    <header>
      <h1>
        CL Inventory Tracker
      </h1>
    </header>

    <section>

    <!-- TODO: redo this ... adding an edit pane ... -->

        <form action="reset_pwd.php" method="post">
            <legend>Reset Your Password</legend>
            <p>
              <label for="reset_username">Username: </label>
              <input type="text" pattern="\w+" required="required" 
                     name="reset_username" autofocus="autofocus" 
                     placeholder="Enter your username" 
                     id="reset_username" />
            </p>

                        <p>
              To reset password, please enter your e-mail address:
              <input type="email" pattern="\w+@\w+\.\w+"
                     name="reset_email" placeholder="john.doe@email.com"
                     id="reset_email" />
            
            <p>
              <button type="submit" name="submit">
                Reset password
              </button>
            </p>
          </fieldset>
        </form>
      <p>
        <a href="login.php">Return to login</a>
      </p>

     <?php if( !empty( $error_msg )): ?>
        <p id="error"><?= $error_msg ?></p> 
     <?php endif; ?>

    </section>
  </body>
</html>

