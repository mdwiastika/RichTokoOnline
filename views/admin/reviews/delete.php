<?php
include './../../connection/connection.php';
$id_review = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM reviews WHERE id_review = :id_review");
$stmt->bindParam(':id_review', $id_review);
$stmt->execute();
header("Location: /admin/reviews");
