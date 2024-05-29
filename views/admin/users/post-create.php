<?php
session_start();
include_once './../../connection/connection.php';
include_once './../validation/validation-form.php';
$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$check_email = $pdo->query("SELECT * FROM users WHERE email = '$email'")->fetch();
if ($check_email) {
    $_SESSION['error'] = 'Email already exists';
    header('Location: /admin/users/create.php');
    exit;
}
$password = empty($_POST['password']) ? '' : md5($_POST['password']);
$role = $_POST['role'];
$province = $_POST['province'];
$city = $_POST['city'];
$address = $_POST['address'];
validation_form($name, 'Name Field is required', '/admin/users/create.php');
validation_form($username, 'Username Field is required', '/admin/users/create.php');
validation_form($email, 'Email Field is required', '/admin/users/create.php');
validation_form($password, 'Password Field is required', '/admin/users/create.php');
validation_form($role, 'Role Field is required', '/admin/users/create.php');
validation_form($province, 'Province Field is required', '/admin/users/create.php');
validation_form($city, 'City Field is required', '/admin/users/create.php');
validation_form($address, 'Address Field is required', '/admin/users/create.php');
$sql = "INSERT INTO users (name, username, email, password, role, province, city, address) VALUES ('$name', '$username', '$email', '$password', '$role', '$province', '$city', '$address')";
$result =   $pdo->query($sql);
if ($result) {
    $_SESSION['success'] = 'User successfully created';
} else {
    $_SESSION['error'] = 'Failed to create user';
}
header('Location: /admin/users');
