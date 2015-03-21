<?php
# Jonathan Price
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

$error_msg = '';
$already_logged_in = false;

if(isset($_SESSION['username']) && isset($_SESSION['fullname']))
{
  $already_logged_in = true;
}

function read_file()
{
  $lines = file( "users.csv", FILE_IGNORE_NEW_LINES );
  return $lines;
}

function user_exists( $username )
{
  # goal: check that username is unique
  $lines = read_file();
  foreach ($lines as $line)
  {
    $users = explode("\t", $line);
    if($users[0] == $username)
    {
      return true;
    }
  }
  return false;
}

function add_user( $username, $fullname, $password )
{
  $string = "$username\t$fullname\t$password" . PHP_EOL;
  file_put_contents("users.csv", $string, FILE_APPEND);
}

/*
function over_write()
{
  # read file into $lines
  # find $line where $username = $_POST['new_username']
  # 
}*/

if( $already_logged_in == false && isset($_POST['new_username'])
    && isset($_POST['new_username']) && isset($_POST['new_username']) )
{
  $username = $_POST['new_username'];
  if( user_exists( $username) )
  {
    $error_msg = "The username $username alredy exists. Please choose a new one.";
  }
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

    <!-- TODO: redo this ... adding an edit pane ... -->
    <?php if( $already_logged_in ): ?>
        <form action="profile.php" method="post">
          <fieldset>
            <legend>Update Your Account</legend>
            <p>
              Username: <?= $_SESSION['username'] ?>
              <!--
              <label for="new_username">Username: </label>
              <input type="text" pattern="\w+" required="required" 
                     name="new_username" autofocus="autofocus" 
                     placeholder="letters, digits, underscore" 
                     id="new_username" />
              -->
            </p>
              
            <p>
              Full name: <?= $_SESSION['fullname'] ?>
              
              <!--
              <label for="new_fullname">Full name: </label>
              <input type="text" pattern="\w+ \w+" required="required" 
                     name="new_fullname"
                     placeholder="John Doe" 
                     id="new_fullname" />
              -->

            </p>

            <p>
              
              <!--
              <label for="new_password">Password: </label>
              <input type="password" required="required" name="new_password"
                     placeholder="minimum length 5" pattern="[^ ]{5,}" 
                     id="new_password" />
              -->
            </p>
              
            <p>
              <button type="submit" name="submit">Update accont information</button>
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
              <button type="submit" name="submit">Create accont</button>
            </p>
          </fieldset>
        </form>
      <?php endif; ?>
    </section>
  </body>
</html>

