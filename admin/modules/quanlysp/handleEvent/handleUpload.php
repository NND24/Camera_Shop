<?php
$filename = $_FILES['file']['name'];
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
    echo $filename;
}
