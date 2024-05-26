<?php
function validation_form($data, $message, $location)
{
    if (empty($data)) {
        $_SESSION['error'] = $message;
        header("Location: $location");
        exit;
    }
}
