<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modul 3</title>
</head>

<body>
  <?php
  if (isset($_GET["aksi"])) {
    switch ($_GET["aksi"]) {
      case "edit":
        include "edit.php";
        break;
      case "delete":
        include "delete.php";
        break;
    }
  } else {
    include "add.php";
  }

  include "view.php";
  ?>
</body>

<script>

</script>

</html>