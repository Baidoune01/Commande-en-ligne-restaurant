<?php
session_start();
require_once 'functions.php';

if (!isAuthenticated() || $_SESSION['role'] != 'restaurateur') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id']) && isset($_POST['status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $result = updateOrderStatus($order_id, $status);

    if ($result) {
        header("Location: manage_orders.php");
        exit();
    } else {
        echo "There was a problem updating the order status. Please try again.";
    }
}
?>
