<?php
session_start();
include_once './../../connection/connection.php';
$id = $_GET['id'];
$sql = "DELETE FROM parent_categories WHERE id_parent_category = '$id'";
$result = $pdo->query($sql);
if ($result) {
    $_SESSION['success'] = 'Parent Category successfully deleted';
} else {
    $_SESSION['error'] = 'Failed to delete parent category';
}
header('Location: /admin/parent-categories');
