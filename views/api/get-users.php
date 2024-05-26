<?php
include_once './../connection/connection.php';
$search = $_GET['search'];
$users = $pdo->query("SELECT * FROM users WHERE name LIKE '%$search%' AND role != 'super admin'")->fetchAll();
echo json_encode($users);
