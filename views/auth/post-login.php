<?php
include_once './../connection/connection.php';
$email = $_POST['email'];
$password = md5($_POST['password']);
$user = $pdo->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'")->fetch();
if ($user) {
    session_start();
    $_SESSION['user'] = $user;
    if ($user['role'] == 'admin' || $user['role'] == 'super admin') {
        header('Location: /admin/dashboard');
    } else {
        header('Location: /');
    }
} else {
    header('Location: /auth/login.php');
}
