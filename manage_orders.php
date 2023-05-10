<?php
session_start();
require_once 'functions.php';

if (!isAuthenticated()) {
    header("Location: login.php");
    exit();
}

$orders = getOrders($_SESSION['user_id'], $_SESSION['role']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <h1>Manage Orders Page</h1>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Dish ID</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order) { ?>
                    <tr>
                        <th scope="row"><?php echo $order['id']; ?></th>
                        <td><?php echo $order['dish_id']; ?></td>
                        <td><?php echo $order['quantity']; ?></td>
                        <td><?php echo $order['status']; ?></td>
                        <?php if($_SESSION['role'] == 'restaurateur') { ?>
                            <td>
                                <form method="POST" action="update_order_status.php">
                                    <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                    <select name="status">
                                        <option value="En attente">En attente</option>
                                        <option value="En cours de préparation">En cours de préparation</option>
                                        <option value="En cours de livraison">En cours de livraison</option>
                                        <option value="Livree">Livree</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">Update Status</button>
                                </form>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>
