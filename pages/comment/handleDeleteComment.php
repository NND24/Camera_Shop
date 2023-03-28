<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
$id_comment = $_POST['idComment'];

$sql_xoa = "DELETE FROM tbl_comments WHERE id_comment ='" . $id_comment . "'";
mysqli_query($mysqli, $sql_xoa);