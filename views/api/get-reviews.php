<?php
include_once './../connection/connection.php';
$search = $_GET['search'];
$reviews = $pdo->query("SELECT * FROM reviews r 
INNER JOIN users u ON r.user_id = u.id
WHERE u.name LIKE '%$search%'")->fetchAll();
echo json_encode($reviews);
