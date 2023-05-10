<?php
session_start();
require_once 'functions.php';

if (!isAuthenticated()) {
    header("Location: login.php");
    exit();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $dish_id = $_POST['dish_id'];
    $quantity = $_POST['quantity'];

    $orderSuccessful = createOrder($user_id, $dish_id, $quantity);

    if ($orderSuccessful) {
        $message = "Your order was placed successfully!";

        // if(isset($_POST['rating']) && !empty($_POST['rating'])) {

        //     $rating = $_POST['rating'];
        //     createRating($user_id, $rating, $dish_id); 
        // }
    } else {
        $message = "There was a problem placing your order. Please try again.";
    }
} else if (isset($_GET['dish_id'])) {
    $dish_id = $_GET['dish_id'];
    $dish = getDish($dish_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
        }
        .alert {
            font-size: 1.2em;
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        form {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
        }
        .btn-primary {
            background-color: #333;
            border-color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-5">Order <?= $dish['name'] ?? '' ?></h1>
        <?php if ($message): ?>
            <div class="alert alert-success mt-5">
                <?= $message ?>
            </div>
            <h2 class="mt-5">Please rate our application:</h2>
            <form action="handle_rating.php" method="post" class="mt-3">
                <div class="form-group">
                <input type="hidden" name="dish_id" value="<?= $dish['id'] ?? '' ?>">

                    <label for="rating">Rating (1-5)</label>
                    <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit Rating</button>
            </form>
        <?php else: ?>
            <form action="order.php" method="post" class="mt-5">
                <input type="hidden" name="dish_id" value="<?= $dish['id'] ?? '' ?>">
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Place Order</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>

