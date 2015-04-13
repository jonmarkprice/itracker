 <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Cindy La and Jonathan Price" />
    <link rel="stylesheet" href="itracker.css" />
    <title>Edit Inventory</title>
  </head>
  <body>

    <h1>Update and delete your existing items</h1>

    <form method="post" action="ed.php">

    <p>
      <label>
        Name of item:
      </label><input type="text" autofocus="autofocus" name="itemName" />
    </p>

    <p>
      <label>
        Description:
      </label><input type="text" name="desc" />
    </p>

    <p>
      <label>
        Flavor/Size/Collection:
      </label><input type="text" name="type" />
    </p>

    <p>
      <label>
        Quantity:
      </label><input type="text" name="quant" />
    </p>

    <p>
      <label>
        Date:
      </label><input type="date" name="date" />
    </p>

    <p class="button">
      <button type="submit">Submit Changes</button>
    </p>

    <p class="button">
      <button type="submit">Delete Item</button>
    </p>

    <a href="home.php">Home</a>

    </form>

  </body>
</html>

