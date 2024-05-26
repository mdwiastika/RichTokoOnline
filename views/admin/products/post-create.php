<?php
session_start();
highlight_string("<?php\n\$_POST =\n" . var_export($_POST, true) . ";\n?>");
include_once './../../connection/connection.php';
include_once './../validation/validation-form.php';
$upload_directory = '/uploads/variant_products/';
$category_id = $_POST['category_id'];
$user_id = $_POST['user_id'];
$name = $_POST['name_product'];
$slug = strtolower(str_replace(' ', '-', $name));
$description = $_POST['description_product'];
$check_name = $pdo->query("SELECT * FROM products WHERE name_product = '$name'")->fetch();
$name_variant_products = $_POST['name_variant_product'];
$price_variant_products = $_POST['price_variant_product'];
$price_variant_products = array_map(function ($price) {
    return str_replace(['Rp. ', '.'], '', $price);
}, $price_variant_products);
$stock_variant_products = $_POST['stock_variant_product'];
$img_variant_products = $_FILES['img_variant_product'];
$img_variant_products = array_values(array_filter($img_variant_products['name']));
$check_img = count($img_variant_products) == count($name_variant_products);
if (!$check_img) {
    $_SESSION['error'] = 'Image Field is required';
    header("Location: /admin/products/create.php");
    exit;
}

if ($check_name) {
    $_SESSION['error'] = 'Name already exists';
    header("Location: /admin/products/create.php");
    exit;
}
validation_form($category_id, 'Category Field is required', "/admin/products/create.php");
validation_form($user_id, 'User Field is required', "/admin/products/create.php");
validation_form($name, 'Name Field is required', "/admin/products/create.php");
validation_form($description, 'Description Field is required', "/admin/products/create.php");
for ($i = 0; $i < count($name_variant_products); $i++) {
    validation_form($name_variant_products[$i], 'Name Variant Field is required', "/admin/products/create.php");
    validation_form($price_variant_products[$i], 'Price Variant Field is required', "/admin/products/create.php");
    validation_form($stock_variant_products[$i], 'Stock Variant Field is required', "/admin/products/create.php");
}
for ($i = 0; $i < count($img_variant_products); $i++) {
    $img_variant_product = $_FILES['img_variant_product'];
    $file_name = hash('sha256', $img_variant_product['name'][$i]) . '_' . $img_variant_product['name'][$i];
    $upload_file = $upload_directory . $file_name;
    $img_variant_products[$i] = $upload_file;
    $upload_check = move_uploaded_file($img_variant_product['tmp_name'][$i], $_SERVER['DOCUMENT_ROOT'] . $upload_file);
    if (!$upload_check) {
        $_SESSION['error'] = 'Failed to upload file';
        header("Location: /admin/products/create.php");
        exit;
    }
}
$sql = "INSERT INTO products (category_id, user_id, name_product, slug_product, description_product) VALUES ('$category_id', '$user_id', '$name', '$slug', '$description')";
$pdo->query($sql);
$product_id = $pdo->lastInsertId();
for ($i = 0; $i < count($name_variant_products); $i++) {
    $sql = "INSERT INTO variant_products (product_id, name_variant_product, price_variant_product, stock_variant_product, img_variant_product) VALUES ('$product_id', '$name_variant_products[$i]', '$price_variant_products[$i]', '$stock_variant_products[$i]', '$img_variant_products[$i]')";
    $pdo->query($sql);
}
header('Location: /admin/products');
