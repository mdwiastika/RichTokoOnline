<?php
include_once './../../connection/connection.php';
include_once './../validation/validation-form.php';
session_start();
$variant_product_id = $_POST['variant_product_id'];
$user_id = $_POST['user_id'];
$star = $_POST['star'];
$description_review = $_POST['description_review'];
$image_review = $_FILES['image_review']['name'];
validation_form($variant_product_id, 'Variant Product Field is required', "/admin/reviews/create.php");
validation_form($user_id, 'User Field is required', "/admin/reviews/create.php");
validation_form($star, 'Star Field is required', "/admin/reviews/create.php");
validation_form($description_review, 'Description Field is required', "/admin/reviews/create.php");
if ($image_review) {
    $upload_directory = '/uploads/reviews/';
    $file_name = time() . hash('sha256', $image_review) . '_' . $image_review;
    $upload_file = $upload_directory . $file_name;
    $upload_check = move_uploaded_file($_FILES['image_review']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $upload_file);
    $sql = "INSERT INTO reviews (variant_product_id, user_id, star, description_review, image_review) VALUES ('$variant_product_id', '$user_id', '$star', '$description_review', '$upload_file')";
} else {
    $sql = "INSERT INTO reviews (variant_product_id, user_id, star, description_review) VALUES ('$variant_product_id', '$user_id', '$star', '$description_review')";
}
$stmt = $pdo->prepare($sql);
$result = $stmt->execute();
if ($result) {
    $_SESSION['success'] = 'Review successfully created';
} else {
    $_SESSION['error'] = 'Failed to create review';
}
header('Location: /admin/reviews');
