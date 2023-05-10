<?php
require_once 'config.php';


function registerUser($email, $password, $role) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO users (email, password, role) VALUES (:email, :password, :role)");
    $stmt->bindParam(':email', $email);

    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bindParam(':password', $hashed);
    $stmt->bindParam(':role', $role);

    return $stmt->execute();
}

function loginUser($email, $password) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            // Store user data in session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            return true;
        }
    }

    return false;
}


function isAuthenticated() {
    return isset($_SESSION['user_id']);
}

// CRUD functions for dishes, orders, and ratings

function createDish($name, $description, $type, $price, $is_dish_of_the_day) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO dishes (name, description, type, price, is_dish_of_the_day) VALUES (:name, :description, :type, :price, :is_dish_of_the_day)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':is_dish_of_the_day', $is_dish_of_the_day);

    return $stmt->execute();
}

function getDishes() {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM dishes");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getDish($id) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM dishes WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateDish($id, $name, $description, $type, $price, $is_dish_of_the_day) {
    global $conn;

    $stmt = $conn->prepare("UPDATE dishes SET name = :name, description = :description, type = :type, price = :price, is_dish_of_the_day = :is_dish_of_the_day WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':is_dish_of_the_day', $is_dish_of_the_day);

    return $stmt->execute();
}

function deleteDish($id) {
    global $conn;

    $stmt = $conn->prepare("DELETE FROM dishes WHERE id = :id");
    $stmt->bindParam(':id', $id);

    return $stmt->execute();
}

function createOrder($user_id, $dish_id, $quantity) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO orders (user_id, dish_id, quantity, status) VALUES (:user_id, :dish_id, :quantity, 'En attente')");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':dish_id', $dish_id);
    $stmt->bindParam(':quantity', $quantity);

    return $stmt->execute();
}

function getOrders($user_id, $role) {
    global $conn;

    if ($role == 'restaurateur') {
        $stmt = $conn->prepare("SELECT * FROM orders");
    } else {
        $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
    }

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateOrderStatus($id, $status) {
    global $conn;

    $stmt = $conn->prepare("UPDATE orders SET status = :status WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':status', $status);

    return $stmt->execute();
}

function createRating($user_id, $dish_id, $rating) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO ratings (user_id, dish_id, rating) VALUES (:user_id, :dish_id, :rating)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':dish_id', $dish_id);
    $stmt->bindParam(':rating', $rating);

    return $stmt->execute();
}

function getRatings($dish_id) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM ratings WHERE dish_id = :dish_id");
    $stmt->bindParam(':dish_id', $dish_id);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function setDishOfTheDay($dish_id) {
    global $conn; // use the PDO object

    // First, set 'is_dish_of_the_day' to false for all dishes
    $sql = "UPDATE dishes SET is_dish_of_the_day = false";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Then, set 'is_dish_of_the_day' to true for the chosen dish
    $sql = "UPDATE dishes SET is_dish_of_the_day = true WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $dish_id);
    $stmt->execute();
}

?>

