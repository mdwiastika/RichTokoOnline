<?php
include_once './../../connection/connection.php';
$id = $_GET['id'];
$sql = "DELETE FROM users WHERE id = '$id'";
$pdo->query($sql);
header('Location: /admin/users');
