<?php
include_once './../../connection/connection.php';
session_start();
$id = $_GET['id'];
$status = $_GET['status'];
$sql = "UPDATE transactions SET status = '$status' WHERE id_transaction = $id";
$result = $pdo->query($sql);
if ($result) {
    $_SESSION['success'] = 'Status successfully updated';
} else {
    $_SESSION['error'] = 'Failed to update status';
}
header('Location: /admin/transactions/show.php?id=' . $id);
