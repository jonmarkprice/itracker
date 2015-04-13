 <?php

session_start();
$loggedin = isset( $_SESSION['username'] ) && isset( $_SESSION['fullname'] );

$filename = "input.txt";
$lines = file( $filename, FILE_IGNORE_NEW_LINES );
$field_names = ["Name", "Description", "Type", "Quantity", "Date In"];
$i = 0;
foreach( $lines as $line):
  list($name, $desc, $type, $n, $date) = explode("\t", $line);
  $items[$i]["Name"] = $name;
  $items[$i]["Description"] = $desc;
  $items[$i]["Type"] = $type;
  $items[$i]["Quantity"] = $n;
  $items[$i]["Date In"] = $date;
  $i++;
endforeach;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Cindy La and Jonathan Price" />
    <link rel="stylesheet" href="itracker.css" />
    <title>CL Inventory Tracker</title>
  </head>
  <body>

    <header>
      <img id="logo" src="itrack_logo.png" alt="logo" />
    </header>

    <div id="inventory">
      <img src="inventory.png" alt="inventory" />
    </div>

    <aside class="login">
      <?php if(!$loggedin): ?>
        <p><a href="login.php">Log In</a></p>
      <?php else: ?>
        <p>
          Hello <?= $_SESSION['fullname'] ?>!
        </p>
        <p>
          <a href="profile.php">Edit Profile</a>
        </p>
        <p>
          <a href="logout.php">Logout</a>
        </p>
      <?php endif;?>

    </aside>

    <ul id="nav">
      <li><a href="add.php">Add New Item</a></li>
      <li><a href="contact.html">Contact Us</a></li>
      <li>
        Search for your inventory here! &#40;Insert search bar here&#41;
        <!--<form method="get" action="itracker.php">
          <input type="search" />
        </form>-->
      </li>
    </ul>

    <p>
      Welcome to the inventory tracker created by Cindy and Jon.  This is 
      a tool to help you organize your business as easily and efficiently 
      as possible.  You are able to add and delete items, see your whole 
      inventory in tables or graphs, and find items by table sorting and 
      search bar.  With the click of an item, see its sales trends 
      or observe the overall incoming and outgoing items over time on 
      the front page. 
    </p>

    <p class="side">
      This is a work in progress, so if you have any suggestions for 
      improvement please don&rsquo;t hesitate to contact us.  Any questions, 
      comments, or concerns are also encouraged.
    </p>

    <p>
      Click on the item name to edit!  The edit page will be worked on to 
      reflect the actual item clicked.
    </p>

    <table>
      <tr>
      <?php foreach( $field_names as $field ): ?>
        <th><?= $field ?></th>
      <?php endforeach; ?>
      </tr>
      <?php foreach ($items as $item): ?>
        <tr>
        <?php foreach ($item as $datum):?>
          <td><a href="item.php"><?= $datum ?></a></td>
        <?php endforeach; ?>
        </tr>
      <?php endforeach; ?>
    </table>

    <p>
      Coming soon: Google Analytics pie chart for top sellers, bar graph for 
      quantity in stock of each item, and more!
    </p>

    <footer>
      &copy;2015, CL Inventory Tracker
    </footer>

  </body>
</html>
