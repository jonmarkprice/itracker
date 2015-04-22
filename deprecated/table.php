<html>
<?php
  #load with example data
  $field_names = ["Name", "Desc", "Type", "#", "Date"];
  $items = [
    [
      "Name" => "A",
      "Desc" => "some A",
      "Type" => "type A",
      "#" => "1",
      "Date" => "1/1/2015"
    ],
    [
      "Name" => "B",
      "Desc" => "some B",
      "Type" => "type B",
      "#" => "2",
      "Date" => "2/2/2015"
    ]
  ];
?>
<table>
  <tr>
  <?php foreach( $field_names as $field ): ?>
    <th><?= $field ?></th>
  <?php endforeach; ?>
  </tr>
  <?php foreach( $items as $item ): ?>
  <tr>
    <?php foreach( $items[ $item ] as $datum ): ?>
    <td><?= $datum ?></td>
    <?php endforeach; ?>
  </tr>
  <?php endforeach; ?>
</table>
</html>
