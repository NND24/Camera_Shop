<?php
include('../../config/config.php');
$sql = "SELECT * FROM tbl_sanpham ORDER BY id_sanpham DESC";
$query = mysqli_query($mysqli, $sql);
$data = mysqli_fetch_all($query);
echo json_encode($data);
