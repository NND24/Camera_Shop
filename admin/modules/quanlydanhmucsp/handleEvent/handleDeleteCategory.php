<?php
include('../../../../admin/config/config.php');

if (isset($_GET['iddanhmuc'])) {
    $id = $_GET['iddanhmuc'];
    $sql_xoa = "DELETE FROM tbl_danhmuc WHERE id_danhmuc='" . $id . "'";
    $query_xoa = mysqli_query($mysqli, $sql_xoa);
} else if (isset($_GET['action'])) {
    $sql_delete_all = "TRUNCATE TABLE tbl_danhmuc ";
    $query_delete_all = mysqli_query($mysqli, $sql_delete_all);
}
