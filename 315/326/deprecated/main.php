<?php
  require_once("../../../cs315/db_login.php");

  // connect to database
  $db = new PDO(
    "mysql:host=$db_hostname;dbname=jmp3748;charset=utf8",
    $db_username, $db_password,
    array(PDO::ATTR_EMULATE_PREPARES => false,
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  // test query
  // $db->query('select * from test;');

?>
<html>
  <form>
    
  </form>
</html>
