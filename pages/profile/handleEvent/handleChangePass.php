<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

$password = $_POST['password'];

$sql_update = "UPDATE tbl_user SET password='" . $password . "' WHERE id_user='" . $_SESSION['id_user'] . "' LIMIT 1";
mysqli_query($mysqli, $sql_update);
