<?php
session_start();
include_once './../../connection/connection.php';
include_once './../validation/validation-form.php';
$upload_directory = '/uploads/parent-categories/';
$id = $_POST['id_parent_category'];
$name = $_POST['name_parent_category'];
$icon = $_FILES['icon_parent_category'];
$slug = strtolower(str_replace(' ', '-', $name));
$check_name = $pdo->query("SELECT * FROM parent_categories WHERE name_parent_category = '$name' AND id_parent_category != '$id'")->fetch();
if ($check_name) {
    $_SESSION['error'] = 'Name already exists';
    header("Location: /admin/parent-categories/edit.php?id=$id");
    exit;
}
validation_form($name, 'Name Field is required', "/admin/parent-categories/edit.php?id=$id");
if ($icon['name'] != '') {
    validation_form($icon, 'Icon Field is required', "/admin/parent-categories/edit.php?id=$id");
    $file_name = hash('sha256', $icon['name'] . microtime()) . '_' . $icon['name'];
    $upload_file = $upload_directory . $file_name;
    $upload_check = move_uploaded_file($icon['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $upload_file);
    if ($upload_check) {
        $sql = "UPDATE parent_categories SET name_parent_category = '$name', icon_parent_category = '$upload_file', slug_parent_category = '$slug' WHERE id_parent_category = '$id'";
        $pdo->query($sql);
        header('Location: /admin/parent-categories');
    } else {
        $_SESSION['error'] = 'Failed to upload file';
        header("Location: /admin/parent-categories/edit.php?id=$id");
    }
} else {
    $sql = "UPDATE parent_categories SET name_parent_category = '$name', slug_parent_category = '$slug' WHERE id_parent_category = '$id'";
    $result = $pdo->query($sql);
    if ($result) {
        $_SESSION['success'] = 'Parent Category successfully updated';
    } else {
        $_SESSION['error'] = 'Failed to update parent category';
    }
    header('Location: /admin/parent-categories');
}
