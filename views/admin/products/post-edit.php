<?php
session_start();
include_once './../../connection/connection.php';
include_once './../validation/validation-form.php';
$upload_directory = '/uploads/variant_products/';
$product_id = $_POST['product_id'];
$category_id = $_POST['category_id'];
$user_id = $_POST['user_id'];
$name = $_POST['name_product'];
$slug = strtolower(str_replace(' ', '-', $name));
$description = $_POST['description_product'];
$check_name = $pdo->query("SELECT * FROM products WHERE name_product = '$name' AND id_product != '$product_id'")->fetch();
$name_variant_products = $_POST['name_variant_product'];
$price_variant_products = $_POST['price_variant_product'];
$price_variant_products = array_map(function ($price) {
    return str_replace(['Rp. ', '.'], '', $price);
}, $price_variant_products);
$stock_variant_products = $_POST['stock_variant_product'];
$img_variant_products = $_FILES['img_variant_product']['name'];
$img_variant_products = array_map(function ($item) {
    if (!is_array($item)) {
        return $item;
    }
    if (!isset($item['name']) || $item['name'] === null) {
        $item['name'] = '';
    }
    return $item['name'];
}, $img_variant_products);
if ($check_name) {
    $_SESSION['error'] = 'Name already exists';
    header("Location: /admin/products/edit.php?id=$product_id");
    exit;
}
validation_form($category_id, 'Category Field is required', "/admin/products/edit.php?id=$product_id");
validation_form($user_id, 'User Field is required', "/admin/products/edit.php?id=$product_id");
validation_form($name, 'Name Field is required', "/admin/products/edit.php?id=$product_id");
validation_form($description, 'Description Field is required', "/admin/products/edit.php?id=$product_id");
for ($i = 0; $i < count($name_variant_products); $i++) {
    validation_form($name_variant_products[$i], 'Name Variant Field is required', "/admin/products/edit.php?id=$product_id");
    validation_form($price_variant_products[$i], 'Price Variant Field is required', "/admin/products/edit.php?id=$product_id");
    validation_form($stock_variant_products[$i], 'Stock Variant Field is required', "/admin/products/edit.php?id=$product_id");
}

$sql = "UPDATE products SET category_id = '$category_id', user_id = '$user_id', name_product = '$name', slug_product = '$slug', description_product = '$description' WHERE id_product = '$product_id'";
$pdo->query($sql);
$variant_product_id_data = $pdo->query("SELECT id_variant_product FROM variant_products WHERE product_id = '$product_id'")->fetchAll();
$variant_product_id_data = array_map(function ($item) {
    return $item['id_variant_product'];
}, $variant_product_id_data);
$variant_product_id = $_POST['variant_product_id'];
for ($i = 0; $i < count($variant_product_id_data); $i++) {
    if (!in_array($variant_product_id_data[$i], $variant_product_id)) {
        $sql = "DELETE FROM variant_products WHERE id_variant_product = '$variant_product_id_data[$i]' AND product_id = '$product_id'";
        $pdo->query($sql);
    }
}
for ($i = 0; $i < count($name_variant_products); $i++) {
    $variant_product_id = $_POST['variant_product_id'][$i];
    if ($variant_product_id == '') {
        if ($img_variant_products[$i] != '') {
            $img_variant_product = $_FILES['img_variant_product'];
            $file_name = hash('sha256', $img_variant_products[$i]) . '_' . $img_variant_products[$i];
            $upload_file = $upload_directory . $file_name;
            $upload_check = move_uploaded_file($img_variant_product['tmp_name'][$i], $_SERVER['DOCUMENT_ROOT'] . $upload_file);
            if ($upload_check) {
                $img_variant_products[$i] = $upload_file;
            } else {
                return var_dump($variant_product_id, 'insert');
                $_SESSION['error'] = 'Failed to upload file';
                header("Location: /admin/products/edit.php?id=$product_id");
                exit;
            }
        } else {
            $_SESSION['error'] = 'Image Field is required';
            header("Location: /admin/products/edit.php?id=$product_id");
        }
        $sql = "INSERT INTO variant_products (product_id, name_variant_product, price_variant_product, stock_variant_product, img_variant_product) VALUES ('$product_id', '$name_variant_products[$i]', '$price_variant_products[$i]', '$stock_variant_products[$i]', '$img_variant_products[$i]')";
        $pdo->query($sql);
        continue;
    } else {
        if ($img_variant_products[$i] != '') {
            $img_variant_product = $_FILES['img_variant_product'];
            $file_name = hash('sha256', $img_variant_products[$i]) . '_' . $img_variant_products[$i];
            $upload_file = $upload_directory . $file_name;
            $upload_check = move_uploaded_file($img_variant_product['tmp_name'][$i], $_SERVER['DOCUMENT_ROOT'] . $upload_file);
            if ($upload_check) {
                $img_variant_products[$i] = $upload_file;
            } else {
                return var_dump($img_variant_product['tmp_name'], 'update', $i, $_POST['variant_product_id']);
                $_SESSION['error'] = 'Failed to upload file';
                header("Location: /admin/products/edit.php?id=$product_id");
                exit;
            }
            $sql = "UPDATE variant_products SET name_variant_product = '$name_variant_products[$i]', price_variant_product = '$price_variant_products[$i]', stock_variant_product = '$stock_variant_products[$i]', img_variant_product = '$img_variant_products[$i]' WHERE id_variant_product = '$variant_product_id'";
        } else {
            $sql = "UPDATE variant_products SET name_variant_product = '$name_variant_products[$i]', price_variant_product = '$price_variant_products[$i]', stock_variant_product = '$stock_variant_products[$i]' WHERE id_variant_product = '$variant_product_id'";
        }
        $pdo->query($sql);
    }
}

header('Location: /admin/products');
