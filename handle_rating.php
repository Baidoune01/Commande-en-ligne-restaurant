<?php
session_start();
require_once 'functions.php';

if (!isAuthenticated()) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $rating = $_POST['rating'];
    $dish_id = $_POST['dish_id'];

    createRating($user_id, $rating, $dish_id);

    header("Location: index.php");
    exit();
}
?>