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
$quantity = $_POST['quantity'];
$check_cart = $pdo->query("SELECT * FROM carts WHERE user_id = $user_id AND variant_product_id = $variant_product_id")->fetch();
$check_stock = $pdo->query("SELECT stock_variant_product FROM variant_products WHERE id_variant_product = $variant_product_id")->fetchColumn();
if (isset($check_cart['id_cart'])) {
    if ($check_cart['quantity'] + $quantity > $check_stock) {
        echo json_encode(['status' => 'error', 'message' => 'The quantity exceeds the stock']);
        return;
    }
}
if (isset($check_cart['id_cart'])) {
    $result = $pdo->query("UPDATE carts SET quantity = quantity + $quantity WHERE user_id = $user_id AND variant_product_id = $variant_product_id");
} else {
    $result = $pdo->query("INSERT INTO carts (user_id, variant_product_id, quantity) VALUES ($user_id, $variant_product_id, $quantity)");
}
if ($result) {
    echo json_encode(['status' => 'success', 'message' => 'Product added to cart']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to add product to cart']);
}
