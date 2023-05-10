<?php
session_start();
require_once 'functions.php';

if (!isAuthenticated()) {
    header("Location: login.php");
    exit();
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['dish'])) {
        setDishOfTheDay($_POST['dish']);
    }
}

$dishes = getDishes();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Dish of The Day</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-5">Set Dish of The Day</h1>
        <?php if ($message): ?>
            <div class="alert alert-success mt-5">
                <?= $message ?>
            </div>
        <?php endif; ?>
        <form action="set_dish_of_day.php" method="post" class="mt-5">
            <div class="form-group">
                <label for="dish_id">Select Dish</label>
                <select class="form-control" id="dish_id" name="dish_id" required>
                    <?php foreach ($dishes as $dish): ?>
                        <option value="<?= $dish['id'] ?>"><?= $dish['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Set Dish of The Day</button>
        </form>
    </div>
</body>
</html>
