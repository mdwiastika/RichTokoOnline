<?php
include_once './../../connection/connection.php';
$id = $_GET['id'];
$sql = "DELETE FROM parent_categories WHERE id_parent_category = '$id'";
$pdo->query($sql);
header('Location: /admin/parent-categories');
