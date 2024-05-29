<?php
session_start();
include_once './../../connection/connection.php';
include_once './../validation/validation-form.php';
$upload_directory = '/uploads/parent-categories/';
$name = $_POST['name_parent_category'];
$icon = $_FILES['icon_parent_category'];
$slug = strtolower(str_replace(' ', '-', $name));
$check_name = $pdo->query("SELECT * FROM parent_categories WHERE name_parent_category = '$name'")->fetch();
if ($check_name) {
    $_SESSION['error'] = 'Name already exists';
    header("Location: /admin/parent-categories/create.php");
    exit;
}
validation_form($name, 'Name Field is required', "/admin/parent-categories/create.php");
validation_form($icon, 'Icon Field is required', "/admin/parent-categories/create.php");

$file_name = hash('sha256', $icon['name'] . microtime()) . '_' . $icon['name'];
$upload_file = $upload_directory . $file_name;
$upload_check = move_uploaded_file($icon['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $upload_file);
if ($upload_check) {
    $sql = "INSERT INTO parent_categories (name_parent_category, icon_parent_category, slug_parent_category) VALUES ('$name', '$upload_file', '$slug')";
    $result = $pdo->query($sql);
    if ($result) {
        $_SESSION['success'] = 'Parent Category successfully created';
    } else {
        $_SESSION['error'] = 'Failed to create parent category';
    }
    header('Location: /admin/parent-categories');
} else {
    $_SESSION['error'] = 'Failed to upload file';
    header("Location: /admin/parent-categories/create.php");
}
