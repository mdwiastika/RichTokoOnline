<?php
session_start();
include_once './../connection/connection.php';
include_once './../admin/validation/validation-form.php';
$user_id = $_SESSION['user']['id'];
$name = isset($_POST['name']) ? $_POST['name'] : '';
$username = isset($_POST['username']) ? $_POST['username'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = !empty($_POST['password']) ? md5($_POST['password']) : '';
$province = isset($_POST['province']) ? $_POST['province'] : '';
$city = isset($_POST['city']) ? $_POST['city'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
validation_form($name, 'Name Field is required', '/my-profile');
validation_form($username, 'Username Field is required', '/my-profile');
validation_form($email, 'Email Field is required', '/my-profile');
validation_form($province, 'Province Field is required', '/my-profile');
validation_form($city, 'City Field is required', '/my-profile');
validation_form($address, 'Address Field is required', '/my-profile');
validation_form($phone_number, 'Phone Number Field is required', '/my-profile');
$check_email = $pdo->query("SELECT * FROM users WHERE email = '$email' AND id != $user_id")->fetch();
if ($check_email) {
    $_SESSION['error'] = 'Email already exists';
    header('Location: /profile');
    exit;
}
if ($password == '') {
    $sql = "UPDATE users SET name = '$name', username = '$username', email = '$email', province = '$province', city = '$city', address = '$address', phone_number = '$phone_number' WHERE id = $user_id";
} else {
    $sql = "UPDATE users SET name = '$name', username = '$username', email = '$email', password = '$password', province = '$province', city = '$city', address = '$address', phone_number = '$phone_number' WHERE id = $user_id";
}
$result = $pdo->query($sql);
if ($result) {
    $_SESSION['user']['name'] = $name;
    $_SESSION['user']['username'] = $username;
    $_SESSION['user']['email'] = $email;
    $_SESSION['user']['password'] = $password;
    $_SESSION['user']['province'] = $province;
    $_SESSION['user']['city'] = $city;
    $_SESSION['user']['address'] = $address;
    $_SESSION['user']['phone_number'] = $phone_number;
    $_SESSION['success'] = 'Profile updated successfully';
} else {
    $_SESSION['error'] = 'Failed to update profile';
}
header('Location: /my-profile');
