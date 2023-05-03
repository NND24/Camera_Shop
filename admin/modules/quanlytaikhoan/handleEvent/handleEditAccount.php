<?php
session_start();
include('../../../../admin/config/config.php');

$password = $_POST['password'];

$sql_update = "UPDATE tbl_admin SET password='" . $password . "', last_updated='" . time() . "'  WHERE email='" . $_SESSION['dangnhap'] . "' LIMIT 1";
mysqli_query($mysqli, $sql_update);
