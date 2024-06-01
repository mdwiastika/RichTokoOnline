<?php
session_start();
include_once './../connection/connection.php';
$cart_id = $_POST['id_cart'];
$user_id = $_SESSION['user']['id'];
$remove_cart = $pdo->query("DELETE FROM carts WHERE id_cart = $cart_id AND user_id = $user_id");
if ($remove_cart) {
    echo json_encode(['status' => 'success', 'message' => 'Product removed from cart']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to remove product from cart']);
}
