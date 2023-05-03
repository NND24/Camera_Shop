<?php
session_start();
include('../../admin/config/config.php');

$name = $_POST['name'];
$phonenumber = $_POST['phonenumber'];
$province = $_POST['province'];
$district = $_POST['district'];
$wards = $_POST['wards'];
$addressDetail = $_POST['addressDetail'];

$sql_user = "UPDATE `tbl_user` SET `tendathang`='$name',`phonenumber`='$phonenumber',
`province_id`='$province',`district_id`='$district',`wards_id`='$wards',`address_detail`='$addressDetail' WHERE id_user='$_SESSION[id_user]'";
mysqli_query($mysqli, $sql_user);
