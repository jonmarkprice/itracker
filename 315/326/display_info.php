<?php
  require_once("../../../cs315/db_login.php");

  // connect to database
  $db = new PDO(
    "mysql:host=$db_hostname;dbname=jmp3748;charset=utf8",
    $db_username, $db_password,
    array(PDO::ATTR_EMULATE_PREPARES => false,
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  // get usernames, emails and fullnames of all users
  $query = 'select username, firstname, lastname, email from users;';
  $stmt = $db->prepare( $query );
  $stmt->execute();
  $rows = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Manage users :: view</title>
  </head>
  <body>
    <h1>View users</h1>
    <?php if( count($rows) == 0): ?>
      <p>No users created yet. <a href="enter_info.html">Create some!</a></p>
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
    <p><a href="enter_info.html">Create another user</a></p>
  <?php endif; ?>
  </body>
</html>
