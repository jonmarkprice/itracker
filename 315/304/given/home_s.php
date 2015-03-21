<?php
// this is the home.php file from class 19, re-written to not use cookies
// but to use sessions instead
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

$loggedin = isset( $_SESSION['username'] ) && isset( $_SESSION['fullname'] );

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

    <aside>
      <?php if( $loggedin ): ?>
        <p>
          Hello <?= $_SESSION['fullname'] ?>
        </p>
        <p>
          <a href="logout_s.php">Logout</a>
        </p>
      <?php else: ?>
        <p>
          <a href="login_s.php">Login</a>
        </p>
      <?php endif; ?>
    </aside>

    <section>
      <h2>
        <?php if( $loggedin ): ?>
          Manage
        <?php else: ?>
          Here is
        <?php endif; ?>
        Our Public Data
      </h2>

      <?php $data = array( 'Foo', 'Bar', 'Bim', 'Bam' ); ?>
      <ul>
        <?php foreach( $data as $item ): ?>
          <li>
            <?php if( $loggedin ): ?>
              <a href="<?= $item ?>.php"><?= $item ?></a>
            <?php else: ?>
              <?= $item ?>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>

    </section>
  </body>
</html>

