<?php
require_once 'config.php';
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $registerSuccess = registerUser($email, $password, $role);

    if ($registerSuccess) {
        header('Location: login.php?success=Registration successful');
    } else {
        header('Location: register.php?error=Registration failed');
    }
} else {
    header('Location: register.php');
}
