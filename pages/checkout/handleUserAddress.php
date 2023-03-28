<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
//echo json_encode($_POST);

$name = $_POST['name'];
$phonenumber = $_POST['phonenumber'];
$address = $_POST['address'];

$sql_user = "UPDATE `tbl_user` SET `tendathang`='$name',`sodienthoaidathang`='$phonenumber',`address`='$address' WHERE id_user='$_SESSION[id_user]'";
$query_user = mysqli_query($mysqli, $sql_user);