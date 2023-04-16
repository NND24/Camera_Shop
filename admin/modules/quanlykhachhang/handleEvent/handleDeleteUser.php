<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

if (isset($_GET['iduser'])) {
    $id = $_GET['iduser'];
    $sql_xoa = "DELETE FROM tbl_user WHERE id_user='" . $id . "'";
    $query_xoa = mysqli_query($mysqli, $sql_xoa);
} else if (isset($_GET['action'])) {
    $sql_delete_all = "TRUNCATE TABLE tbl_user ";
    $query_delete_all = mysqli_query($mysqli, $sql_delete_all);
}
