<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

$email = $_POST['email'];
$password = $_POST['password'];

$sql_admin = "SELECT * FROM tbl_admin WHERE email='" . $email . "' LIMIT 1 ";
$query_admin = mysqli_query($mysqli, $sql_admin);
if (mysqli_num_rows($query_admin) > 0) {
    $a = array("existAccount" => 1);
    echo json_encode($a);

    $sql_update = "UPDATE tbl_admin SET password='" . $password . "' WHERE email='" . $email . "'  LIMIT 1";
    mysqli_query($mysqli, $sql_update);
    $sql_update_user = "UPDATE tbl_user SET password='" . $password . "' WHERE email='" . $email . "'  LIMIT 1";
    mysqli_query($mysqli, $sql_update_user);
} else {
    $b = array("existAccount" => 0);
    echo json_encode($b);
}
