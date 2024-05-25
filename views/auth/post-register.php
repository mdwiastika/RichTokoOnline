<?php
include_once './../connection/connection.php';
$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$address = $_POST['address'];
$role = 'buyer';
$sql = "INSERT INTO users (name, username, email, password, address, role) VALUES ('$name', '$username', '$email', '$password', '$address', '$role')";
$pdo->query($sql);
header('Location: ../../auth/login.php');
