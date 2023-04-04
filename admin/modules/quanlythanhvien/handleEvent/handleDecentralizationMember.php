<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

$duty = $_POST['duty'];
$id_admin = $_POST['idmember'];

$sql_update = "UPDATE tbl_admin SET duty='" . $duty . "',last_updated='" . time() . "' WHERE id_admin='$id_admin' ";
mysqli_query($mysqli, $sql_update);