<?php
session_start();
include './../../connection/connection.php';
$id_review = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM reviews WHERE id_review = :id_review");
$stmt->bindParam(':id_review', $id_review);
$result = $stmt->execute();
if ($result) {
    $_SESSION['success'] = 'Review successfully deleted';
} else {
    $_SESSION['error'] = 'Failed to delete review';
}
header("Location: /admin/reviews");
