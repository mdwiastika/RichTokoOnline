<?php
include_once './../../connection/connection.php';
$id = $_GET['id'];
$sql = "DELETE FROM categories WHERE id_category = '$id'";
$pdo->query($sql);
header('Location: /admin/categories');
