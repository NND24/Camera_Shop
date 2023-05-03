<?php
session_start();
include('../../admin/config/config.php');

$email = $_POST['email'];
$password = $_POST['password'];

$sql_user = "SELECT * FROM tbl_user WHERE email='" . $email . "' LIMIT 1 ";
$query_user = mysqli_query($mysqli, $sql_user);
if (mysqli_num_rows($query_user) > 0) {
    $a = array("existAccount" => 1);
    echo json_encode($a);

    $sql_update = "UPDATE tbl_user SET password='" . $password . "' WHERE email='" . $email . "'  LIMIT 1";
    mysqli_query($mysqli, $sql_update);
} else {
    $b = array("existAccount" => 0);
    echo json_encode($b);
}
