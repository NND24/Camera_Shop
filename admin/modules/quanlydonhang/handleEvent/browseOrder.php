<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

if (isset($_GET['action'])) {
    $sql_update = "UPDATE tbl_cart SET cart_status='1',browse_time='" . time() . "' WHERE id_cart='$_GET[id_cart]' ";
    mysqli_query($mysqli, $sql_update);
}
if (isset($_GET['query'])) {
    $sql_update = "UPDATE tbl_cart SET cart_status='0' WHERE id_cart='$_GET[id_cart]' ";
    mysqli_query($mysqli, $sql_update);
}
