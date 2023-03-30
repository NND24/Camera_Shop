<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

if (isset($_GET['idsanpham'])) {
    $id = $_GET['idsanpham'];
    // Xoa hinh anh
    $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$id' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    while ($row = mysqli_fetch_array($query)) {
        unlink('uploads/' . $row['hinhanh']);
    }
    // Xoa san pham
    $sql_xoa = "DELETE FROM tbl_sanpham WHERE id_sanpham='" . $id . "'";
    mysqli_query($mysqli, $sql_xoa);
} else if (isset($_GET['action'])) {
    // Xoa hinh anh
    $sql = "SELECT * FROM tbl_sanpham";
    $query = mysqli_query($mysqli, $sql);
    while ($row = mysqli_fetch_array($query)) {
        unlink('uploads/' . $row['hinhanh']);
    }
    $sql_delete_all = "TRUNCATE TABLE tbl_sanpham ";
    $query_delete_all = mysqli_query($mysqli, $sql_delete_all);
}
