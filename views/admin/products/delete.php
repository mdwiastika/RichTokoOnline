<?php
include_once './../../connection/connection.php';
$id = $_GET['id'];
$sql = "DELETE FROM variant_products WHERE product_id = '$id'";
$pdo->query($sql);
$sql = "DELETE FROM products WHERE id_product = '$id'";
$pdo->query($sql);
header('Location: /admin/products');
