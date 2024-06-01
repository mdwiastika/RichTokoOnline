<?php
session_start();
include_once './../connection/connection.php';
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $variant_product_id = $pdo->query("SELECT id_variant_product FROM variant_products WHERE product_id = $product_id LIMIT 1")->fetchColumn();
} elseif (isset($_POST['variant_product_id'])) {
    $variant_product_id = $_POST['variant_product_id'];
}
$user_id = $_SESSION['user']['id'];
$check_cart = $pdo->query("SELECT * FROM carts WHERE user_id = $user_id AND variant_product_id = $variant_product_id")->fetch();
if ($check_cart) {
    $result = $pdo->query("UPDATE carts SET quantity = quantity + 1 WHERE user_id = $user_id AND variant_product_id = $variant_product_id");
} else {
    $result = $pdo->query("INSERT INTO carts (user_id, variant_product_id, quantity) VALUES ($user_id, $variant_product_id, 1)");
}
if ($result) {
    echo json_encode(['status' => 'success', 'message' => 'Product added to cart']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to add product to cart']);
}
