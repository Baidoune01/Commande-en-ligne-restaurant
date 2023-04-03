<?php
session_start();
require_once 'pdo.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Commander un plat</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      padding: 20px;
    }
  </style>
</head>
<body>
  <h1>Commander un plat</h1>
  <?php

    $sql = "SELECT * FROM dishes";
    $stmt = $pdo->query($sql);

    if ($stmt->rowCount() > 0) {
      ?>
      <form action="place_order.php" method="POST">
        <div class="form-group">
          <label for="dish">Plat:</label>
          <select class="form-control" id="dish" name="dish">
            <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              ?>
              <option value="<?php echo $row['did']; ?>"><?php echo $row['dname'] . ' (' . $row['price'] . '€)'; ?></option>
              <?php
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="quantity">Quantité:</label>
          <input type="number" class="form-control" id="quantity" name="quantity" value="1">
        </div>
        <button type="submit" class="btn btn-primary">Commander</button>
      </form>
      <?php
    } else {
      echo "Aucun plat n'est disponible pour le moment.";
    }

    $pdo = null;
  ?>
</body>
</html>
