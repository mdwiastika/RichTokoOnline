<?php
include_once './../connection/connection.php';
$search = $_GET['search'];
$parent_categories = $pdo->query("SELECT * FROM parent_categories WHERE name_parent_category LIKE '%$search%'")->fetchAll();
echo json_encode($parent_categories);
