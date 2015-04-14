<?php
# Jonathan Price Cindy La
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
include("functions.php");

$error_msg = '';
$already_logged_in = false;

if(isset($_SESSION['username']) &&
    isset($_SESSION['fullname']) )
{
  $already_logged_in = true;
}


if( $already_logged_in == false && isset($_POST['new_username'])
    && preg_match('/^\w+$/', $_POST['new_username']) )
{
  $username = $_POST['new_username'];
  if( user_exists( $username) )
  {
    $error_msg = "The username $username alredy exists. 
    Please choose a new one.";
  }
  else
  {
    if(preg_match('|^\w+$|',$_POST['username']) &&
       preg_match('|^\w+[ ]\w+$|',$_POST['fullname']) )

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
  }
}

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

    <?php if( $already_logged_in ): ?>
        <form action="profile.php" method="post">
          <fieldset>
            <legend>Update Your Account</legend>
            <p>
              <label for="new_username">Username: </label>
              <input type="text" pattern="\w+"  
                     name="new_username" autofocus="autofocus" 
                     placeholder="letters, digits, underscore" 
                     id="new_username" />
            </p>
              
            <p>
              <label for="new_fullname">Full name: </label>
              <input type="text" pattern="\w+ \w+"  
                     name="new_fullname"
                     placeholder="John Doe" 
                     id="new_fullname" />
            </p>

            <p>
              To reset password, please enter your e-mail address:
              <input type="email" pattern="\w+[@]\w+[\.]\w+"
                     name="email" placeholder="john.doe@email.com"
                     id="email" />
             <!--
              <label for="new_password">Password: </label>
              <input type="password" required="required" name="new_password"
                     placeholder="minimum length 5" pattern="[^ ]{5,}" 
                     id="new_password" />
              -->
            </p>
              
            <p>
              <button type="submit" name="submit">
                Update account information
              </button>
            </p>
          </fieldset>
        </form>
      <p>
        <a href="home.php">OK</a>
      </p>
      
    <?php else:
      if( !empty( $error_msg )): ?>
        <p id="error"><?= $error_msg ?></p> 
      <?php endif; ?>
        <form action="profile.php" method="post">
          <fieldset>
            <legend>Create an Account</legend>
            <p>

              <label for="new_username">Username: </label>
              <input type="text" pattern="\w+" required="required" 
                     name="new_username" autofocus="autofocus" 
                     placeholder="letters, digits, underscore" 
                     id="new_username" />
            </p>

            <p>
              <label for="new_fullname">Full name: </label>
              <input type="text" pattern="\w+ \w+" required="required" 
                     name="new_fullname"
                     placeholder="John Doe" 
                     id="new_fullname" />
            </p>

            <p>
              <label for="new_password">Password: </label>
              <input type="password" required="required" name="new_password"
                     placeholder="minimum length 5" pattern="[^ ]{5,}" 
                     id="new_password" />
            </p>

            <p>
              <button type="submit" name="submit">Create account</button>
            </p>
          </fieldset>
        </form>
      <?php endif; ?>
    </section>
  </body>
</html>

