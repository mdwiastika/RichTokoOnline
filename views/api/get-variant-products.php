<?php
include_once './../connection/connection.php';
$search = $_GET['search'];
$variant_products = $pdo->query("SELECT vp.id_variant_product, vp.name_variant_product, p.name_product FROM variant_products vp 
    INNER JOIN products p ON vp.product_id = p.id_product 
    WHERE name_variant_product LIKE '%$search%'")->fetchAll();
echo json_encode($variant_products);
