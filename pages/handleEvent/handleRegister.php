<?php
session_start();
include('../../admin/config/config.php');

$tenkhachhang = $_POST['name'];
$email = $_POST['email'];
$matkhau = $_POST['password'];

$sql_user = "SELECT * FROM tbl_user WHERE email='" . $_POST['email'] . "' ";
$query_user = mysqli_query($mysqli, $sql_user);
if (mysqli_num_rows($query_user) > 0) {
    $a = array("existEmail" => 1);
    echo json_encode($a);
} else {
    $a = array("existEmail" => 0);
    echo json_encode($a);
    $sql_dangky = mysqli_query($mysqli, "INSERT INTO tbl_user(name,email,password) 
VALUES ('" . $tenkhachhang . "','" . $email . "','" . $matkhau . "')");
}