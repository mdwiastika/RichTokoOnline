<?php
session_start();
include_once './../../connection/connection.php';
include_once './../validation/validation-form.php';
$id = $_POST['id'];
$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$check_email = $pdo->query("SELECT * FROM users WHERE email = '$email' AND id != '$id'")->fetch();
if ($check_email) {
    $_SESSION['error'] = 'Email already exists';
    header("Location: /admin/users/edit.php?id=$id");
    exit;
}
$password = empty($_POST['password']) ? '' : md5($_POST['password']);
$role = $_POST['role'];
$province = $_POST['province'];
$city = $_POST['city'];
$address = $_POST['address'];
validation_form($name, 'Name Field is required', "/admin/users/edit.php?id=$id");
validation_form($username, 'Username Field is required', "/admin/users/edit.php?id=$id");
validation_form($email, 'Email Field is required', "/admin/users/edit.php?id=$id");
validation_form($role, 'Role Field is required', "/admin/users/edit.php?id=$id");
validation_form($province, 'Province Field is required', "/admin/users/edit.php?id=$id");
validation_form($city, 'City Field is required', "/admin/users/edit.php?id=$id");
validation_form($address, 'Address Field is required', "/admin/users/edit.php?id=$id");
if (empty($password)) {
    $sql = "UPDATE users SET name = '$name', username = '$username', email = '$email', role = '$role', province = '$province', city = '$city', address = '$address' WHERE id = '$id'";
} else {
    $sql = "UPDATE users SET name = '$name', username = '$username', email = '$email', password = '$password', role = '$role', province = '$province', city = '$city', address = '$address' WHERE id = '$id'";
}
$pdo->query($sql);
header('Location: /admin/users');
