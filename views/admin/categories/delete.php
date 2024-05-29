<?php
session_start();
include_once './../../connection/connection.php';
$id = $_GET['id'];
$sql = "DELETE FROM categories WHERE id_category = '$id'";
$result = $pdo->query($sql);
if ($result) {
    $_SESSION['success'] = 'Category successfully deleted';
} else {
    $_SESSION['error'] = 'Failed to delete category';
}
header('Location: /admin/categories');
