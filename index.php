<?php
session_start();
require_once 'functions.php';

if (!isAuthenticated()) {
    header("Location: login.php");
    exit();
}
if (isAuthenticated()) {
    if ($_SESSION['role'] == 'restaurateur') {
        header("Location: manager_dashboard.php");
        exit();
    }
}
$dishes = [
    [
        'id' => 1,
        'name' => 'Spaghetti Bolognese',
        'price' => 12.99,
        'image' => 'images/spaghetti.jpg',
        'description' => 'A classic Italian pasta dish with a delicious meat sauce.'
    ],
    [
        'id' => 2,
        'name' => 'Margherita Pizza',
        'price' => 10.99,
        'image' => 'images/pizza.webp',
        'description' => 'A simple and delicious pizza with tomato, mozzarella, and basil.'
    ],
    [
        'id' => 3,
        'name' => 'Grilled Salmon',
        'description' => 'Fresh salmon fillet, grilled to perfection.',
        'image' => 'images/grilled-salmon-final-2.jpg',
        'price' => 15.99,
    ],
    [
        'id' => 4,
        'name' => 'Caesar Salad',
        'description' => 'Crispy romaine lettuce, parmesan cheese, and homemade Caesar dressing.',
        'image' => 'images/Caesar.jpg',
        'price' => 7.99,
    ],
    [
        'id' => 5,
        'name' => 'Chicken Sandwich',
        'description' => 'Grilled chicken breast with lettuce, tomato, and mayo on a toasted bun.',
        'image' => 'images/chicken-burg.jpg',
        'price' => 9.99,
    ],
    [
        'id' => 6,
        'name' => 'Beef Burger',
        'description' => 'Juicy beef patty with lettuce, tomato, pickles, and our special sauce on a toasted bun.',
        'image' => 'images/beef.jpg',
        'price' => 10.99,
    ]
];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .dish-card {
            margin-bottom: 20px;
        }
        .dish-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between mt-3">
            <h2>Welcome, <?php echo $_SESSION['email']; ?></h2>
            <form action="logout.php" method="post">
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
        <h1 class="text-center mt-3 mb-5">Our Menu</h1>
        <div class="row">
        <?php foreach ($dishes as $dish): ?>
                <div class="col-md-4 col-sm-6">
                    <div class="card dish-card">
                        <img src="<?= $dish['image'] ?>" alt="<?= $dish['name'] ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?= $dish['name'] ?></h5>
                            <p class="card-text"><?= $dish['description'] ?></p>
                            <p class="text-muted">Price: $<?= number_format($dish['price'], 2) ?></p>
                            <a href="order.php?dish_id=<?= $dish['id'] ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
