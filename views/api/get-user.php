<?php
include_once './../connection/connection.php';
$users = $pdo->query('SELECT * FROM users')->fetchAll();
