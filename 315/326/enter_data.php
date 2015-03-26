<?php
require_once("../../../cs315/db_login.php");

if (isset($_POST['data_entered']) 
    && $_POST['data_entered']) {

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
}?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <!-- <link rel="stylesheet" href="session.css" /> -->
    <title>Enter data</title>
  </head>
  <body>
  	<section>
  		<form action="enter_data.php" method="POST">
        <fieldset>
          <legend>Create an Account</legend>
    		  <p>
            <label for="username">Username: </label>
            <input type="text" pattern="\w+" required="required" 
                   name="username" autofocus="autofocus" 
                   placeholder="jdoe93" id="username" />
          </p>

          <p>
            <label for="firstname">First name: </label>
            <input type="text" pattern="\w+" required="required" name="firstname" 
                   placeholder="Jane" id="firstname" />
          </p>

          <p>
            <label for="lastname">Last name: </label>
            <input type="text" pattern="\w+" required="required" 
                   name="lastname" placeholder="Doe" 
                   id="lastname" />
          </p>

          <p>
            <label for="email">Email address: </label>
            <input type="text" pattern="\w+@\w+\.\w+" required="required" 
                   name="email" 
                   placeholder="janedoe@gmail.com" 
                   id="email" />
          </p>

          <p>
            <label for="password">Temporary password: </label>
            <input type="text" required="required" 
                   name="password" id="password" />
          </p>

          <p>
    			 <button type="submit" name="submit">Submit</button>
          </p>
        </fieldset>
        <input type="hidden" name="data_entered" value="true" />
  		</form>
  	</section>
  </body>
 </html>
