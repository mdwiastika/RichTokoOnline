<?php
session_start();
include_once './../../connection/connection.php';
include_once './../validation/validation-form.php';
$upload_directory = '/uploads/categories/';
$id = $_POST['id_category'];
$parent_category_id = $_POST['parent_category_id'];
$name = $_POST['name_category'];
$icon = $_FILES['icon_category'];
$slug = strtolower(str_replace(' ', '-', $name));
$check_name = $pdo->query("SELECT * FROM categories WHERE name_category = '$name' AND id_category != '$id'")->fetch();
if ($check_name) {
    $_SESSION['error'] = 'Name already exists';
    header("Location: /admin/categories/edit.php?id=$id");
    exit;
}
validation_form($name, 'Name Field is required', "/admin/categories/edit.php?id=$id");
if ($icon['name'] != '') {
    validation_form($icon, 'Icon Field is required', "/admin/categories/edit.php?id=$id");
    $file_name = hash('sha256', $icon['name']) . '_' . $icon['name'];
    $upload_file = $upload_directory . $file_name;
    $upload_check = move_uploaded_file($icon['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $upload_file);
    if ($upload_check) {
        $sql = "UPDATE categories SET parent_category_id = '$parent_category_id', name_category = '$name', icon_category = '$upload_file', slug_category = '$slug' WHERE id_category = '$id'";
        $pdo->query($sql);
        header('Location: /admin/categories');
    } else {
        $_SESSION['error'] = 'Failed to upload file';
        header("Location: /admin/categories/edit.php?id=$id");
    }
} else {
    $sql = "UPDATE categories SET parent_category_id = '$parent_category_id', name_category = '$name', slug_category = '$slug' WHERE id_category = '$id'";
    $pdo->query($sql);
    header('Location: /admin/categories');
}
