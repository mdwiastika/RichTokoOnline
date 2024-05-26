<?php
include_once './../connection/connection.php';
$search = $_GET['search'];
$categories = $pdo->query("SELECT * FROM categories WHERE name_category LIKE '%$search%'")->fetchAll();
echo json_encode($categories);
