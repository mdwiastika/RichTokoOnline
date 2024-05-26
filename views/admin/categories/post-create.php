<?php
session_start();
include_once './../../connection/connection.php';
include_once './../validation/validation-form.php';
$upload_directory = '/uploads/categories/';
$parent_category_id = $_POST['parent_category_id'];
$name = $_POST['name_category'];
$icon = $_FILES['icon_category'];
$slug = strtolower(str_replace(' ', '-', $name));
$check_name = $pdo->query("SELECT * FROM categories WHERE name_category = '$name'")->fetch();
if ($check_name) {
    $_SESSION['error'] = 'Name already exists';
    header("Location: /admin/categories/create.php");
    exit;
}
validation_form($parent_category_id, 'Parent Category Field is required', "/admin/categories/create.php");
validation_form($name, 'Name Field is required', "/admin/categories/create.php");
validation_form($icon, 'Icon Field is required', "/admin/categories/create.php");
$file_name = hash('sha256', $icon['name']) . '_' . $icon['name'];
$upload_file = $upload_directory . $file_name;
$upload_check = move_uploaded_file($icon['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $upload_file);
if ($upload_check) {
    $sql = "INSERT INTO categories (parent_category_id, name_category, icon_category, slug_category) VALUES ('$parent_category_id', '$name', '$upload_file', '$slug')";
    $pdo->query($sql);
    header('Location: /admin/categories');
} else {
    $_SESSION['error'] = 'Failed to upload file';
    header("Location: /admin/categories/create.php");
}
