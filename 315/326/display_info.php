<?php
  require_once("../../../cs315/db_login.php");

  // connect to database
  $db = new PDO(
    "mysql:host=$db_hostname;dbname=jmp3748;charset=utf8",
    $db_username, $db_password,
    array(PDO::ATTR_EMULATE_PREPARES => false,
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  // get usernames, emails and fullnames of all users
  $rows = $db->query('select username, firstname, lastname, email 
                      from users;');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <!-- <link rel="stylesheet" href="session.css" /> -->
    <title>Enter data</title>
  </head>
  <body>
    <?php if( $rows !== false ): ?>
      <p>No users created yet. <a href="enter_data.php">Create some!</a></p>
    <?php else: ?>
    <table>
      <tr>
        <th>Username</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
      </tr>
      <?php foreach($rows as $row): ?>
      <tr>
        <td><?= $row['username'] ?></td>
        <td><?= $row['firstname'] ?></td>
        <td><?= $row['lastname'] ?></td>
        <td><?= $row['email'] ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
  <?php endif; ?>
  </body>
</html>
