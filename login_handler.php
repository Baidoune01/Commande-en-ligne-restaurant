<?php
require_once 'config.php';
require_once 'functions.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $loggedIn = loginUser($email, $password);

    if ($loggedIn) {
        header('Location: index.php'); 
        exit();
    } else {
        header('Location: login.php?error=Invalid email or password');
        exit();
    }
} 

?>