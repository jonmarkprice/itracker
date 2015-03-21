<?php
# Jonathan Price
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

$error_msg = '';
$already_logged_in = false;

//TODO: move to 'central' location
function read_file()
{
  $lines = file( "users.csv", FILE_IGNORE_NEW_LINES );
  return $lines;
}

//tmp
//$hash = '$2y$10$tchOFY8.cxdHnA1L8S1.WeOqz1KpxPW69pP6j/PtxdcrPOP7Rg4ta';

if( !( isset( $_SESSION['username']) && isset( $_SESSION['fullname'] )))
{
  if( isset( $_POST['submit'] ))
  {
    if( isset( $_POST['username'] ) && 
        preg_match( '|^\w+$|', $_POST['username'] ) &&
        isset( $_POST['password'] ) && 
        preg_match( '|^\S+$|', $_POST['password'] ))
    {
      $lines = read_file();
      foreach ($lines as $line)
      {
        list($username, $fullname, $hash) = explode("\t", $line);
        if( $_POST['username'] == $username)
        {
          #check password
          if( password_verify( $_POST['password'], $hash ) )
          {
            header( 'Location: home.php' );
            exit;
          }
          else
          {
            $error_msg = 'Username-password pair is invalid';

            //not in orig
            header( 'Location: login.php' );
            exit;
          }
        }
      }
    }
    else
    {
      $error_msg = 'You must enter a valid username-password pair';
    }
  }
}
else 
{
  $already_logged_in = true;
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="session.css" />
    <title>Session Demo</title>
  </head>

  <body>
    <header>
      <h1>
        ACME Website
      </h1>
    </header>

    <section>

    <?php if( $already_logged_in ): ?>
      <p>
        You are already logged in as <?= $_SESSION['fullname'] ?>
      </p>

      <p>
        <a href="home.php">OK</a>
      </p>

    <?php else:

      if( !empty( $error_msg )): ?>
        <p id="error"><?= $error_msg ?></p> 
      <?php endif; ?>
        <form action="login.php" method="post">
          <fieldset><legend>Log In</legend>
            <p>
              <label for="username">Username: </label>
              <input type="text" pattern="\w+" required="required" 
                     name="username" autofocus="autofocus" 
                     placeholder="letters, digits, underscore" 
                     id="username" />
            </p>

            <p>
              <label for="password">Password: </label>
              <input type="password" required="required" name="password"
                     placeholder="minimum length 5" pattern="[^ ]{5,}" 
                     id="password" />
            </p>

            <p>
              <button type="submit" name="submit">Log In</button>
            </p>
          </fieldset>
        </form>
        <p>Need an account? <a href="profile.php">Sign up here</a>!</p>
      <?php endif; ?>
    </section>
  </body>
</html>

