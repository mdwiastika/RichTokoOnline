<?php
session_start();
include_once './../../connection/connection.php';
$id = $_GET['id'];
$sql = "DELETE FROM users WHERE id = '$id'";
$result = $pdo->query($sql);
if ($result) {
    $_SESSION['success'] = 'User successfully deleted';
} else {
    $_SESSION['error'] = 'Failed to delete user';
}
header('Location: /admin/users');
