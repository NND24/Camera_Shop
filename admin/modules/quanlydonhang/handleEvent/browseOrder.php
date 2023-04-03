<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

if (isset($_GET['action'])) {
    $sql_update = "UPDATE tbl_order SET order_status='1',browsed_date='" . time() . "' WHERE id_order='$_GET[id_order]' ";
    mysqli_query($mysqli, $sql_update);
}
if (isset($_GET['query'])) {
    $sql_update = "UPDATE tbl_order SET order_status='0' WHERE id_order='$_GET[id_order]' ";
    mysqli_query($mysqli, $sql_update);
}