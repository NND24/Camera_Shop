<?php
session_start();
$filename = $_FILES['file']['name'];
$_SESSION['product_img'] = time() . '_' . $filename;
// Location
$location = "uploads" . DIRECTORY_SEPARATOR . time() . '_' . $filename;
//echo $location;
$uploadOk = 1;
$imageFileType = pathinfo($location, PATHINFO_EXTENSION);

// Valid Extension
$valid_extensions = array("jpg", "jpeg", "png", "gif");
// Check
if (!in_array(strtolower($imageFileType), $valid_extensions)) {
    $uploadOk = 0;
}
if ($uploadOk == 0) {
    echo 0;
} else {
    if (move_uploaded_file($_FILES['file']['tmp_name'], realpath('') . DIRECTORY_SEPARATOR . $location)) {
        echo str_replace(DIRECTORY_SEPARATOR, "/", $location);
    } else {
        echo 0;
    }
}
