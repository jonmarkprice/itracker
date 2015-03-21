<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

$error_msg = '';
$already_logged_in = false;
$hash = '$2y$10$tchOFY8.cxdHnA1L8S1.WeOqz1KpxPW69pP6j/PtxdcrPOP7Rg4ta';

if( !( isset( $_SESSION['username']) && isset( $_SESSION['fullname'] ))):
  if( isset( $_POST['submit'] )):
    if( isset( $_POST['username'] ) && 
        preg_match( '|^\w+$|', $_POST['username'] ) &&
        isset( $_POST['password'] ) && 
        preg_match( '|^\S+$|', $_POST['password'] )):
      if( $_POST['username'] == 'jbeck' && 
          password_verify( $_POST['password'], $hash )):
        $_SESSION['username'] =  'jbeck';
        $_SESSION['fullname'] = 'Jon Beck';
        header( 'Location: home_s.php' );
        exit;
      else:
        $error_msg = 'Username-password pair is invalid';
      endif;
    else:
      $error_msg = 'You must enter a valid username-password pair';
    endif;
  endif;
else:
  $already_logged_in = true;
endif; ?>
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
        <a href="home_s.php">OK</a>
      </p>

    <?php else:

      if( !empty( $error_msg )): ?>
        <p id="error"><?= $error_msg ?></p> 
      <?php endif; ?>
        <p>(Username is jbeck; password is myPass)</p>

        <form action="login_s.php" method="post">
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
      <?php endif; ?>
    </section>
  </body>
</html>

