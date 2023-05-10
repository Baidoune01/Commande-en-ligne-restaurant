<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-5">Manager Dashboard</h1>
        <div class="row mt-5">
            <div class="col-md-4">
                <a href="set_dish_of_day.php" class="btn btn-primary btn-block">Set Dish of The Day</a>
            </div>
            <div class="col-md-4">
                <a href="manage_orders.php" class="btn btn-primary btn-block">Manage Orders</a>
            </div>
        </div>
        <div class="col-md-2 text-right mt-2">
            <form action="logout.php" method="post" style="display: inline;">
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>

    </div>
</body>
</html>
