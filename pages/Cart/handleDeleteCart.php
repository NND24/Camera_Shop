<?php
session_start();
include('../../admin/config/config.php');

if (isset($_SESSION['id_user'])) {
    if (isset($_GET['xoa'])) {
        $id_sanpham = $_POST['id_sanpham'];

        $sql_xoa = "DELETE FROM tbl_cart WHERE id_sanpham='$id_sanpham' ";
        mysqli_query($mysqli, $sql_xoa);
    } else if (isset($_GET['action'])) {
        $sql_delete_all = "DELETE FROM tbl_cart WHERE id_user='$_SESSION[id_user]'";
        $query_delete_all = mysqli_query($mysqli, $sql_delete_all);
    }
}
