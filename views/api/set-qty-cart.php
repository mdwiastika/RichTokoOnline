<?php
session_start();
include_once './../connection/connection.php';
$action = $_POST['action'];
$cart_id = $_POST['cartId'];
$check_cart = $pdo->query("SELECT * FROM carts WHERE id_cart = $cart_id")->fetch();
$check_stock = $pdo->query("SELECT stock_variant_product FROM variant_products WHERE id_variant_product = " . $check_cart['variant_product_id'])->fetch();
if ($action === 'increment' && $check_cart['quantity'] >= $check_stock['stock_variant_product']) {
    echo json_encode(['status' => 'error', 'message' => 'The quantity exceeds the stock']);
    return;
}
if ($action === 'increment') {
    $result = $pdo->query("UPDATE carts SET quantity = quantity + 1 WHERE id_cart = $cart_id");
} elseif ($action === 'decrement') {
    if ($check_cart['quantity'] === 1) {
        $result = $pdo->query("DELETE FROM carts WHERE id_cart = $cart_id");
    } else {
        $result = $pdo->query("UPDATE carts SET quantity = quantity - 1 WHERE id_cart = $cart_id");
    }
}
if ($result) {
    echo json_encode(['status' => 'success', 'message' => 'Quantity updated successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update quantity']);
}
