<?php
session_start();
include_once './../connection/connection.php';
$user_id = $_POST['user_id'];
$variant_product_id = $_POST['variant_product_id'];
$star = $_POST['star'];
$description_review = $_POST['description_review'];
$result = $pdo->query("INSERT INTO reviews (user_id, variant_product_id, star, description_review) VALUES ($user_id, $variant_product_id, '$star', '$description_review')");
if ($result) {
    echo json_encode(['status' => 'success', 'message' => 'Review added successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to add review']);
}
