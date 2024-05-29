<?php
session_start();
include_once './../../connection/connection.php';
$id = $_GET['id'];
$sql = "DELETE FROM variant_products WHERE product_id = '$id'";
$pdo->query($sql);
$sql = "DELETE FROM products WHERE id_product = '$id'";
$result = $pdo->query($sql);
if ($result) {
    $_SESSION['success'] = 'Product successfully deleted';
} else {
    $_SESSION['error'] = 'Failed to delete product';
}
header('Location: /admin/products');
