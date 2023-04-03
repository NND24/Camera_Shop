<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

if (isset($_GET['idsanpham'])) {
    $id = $_GET['idsanpham'];
    $sql_order = "SELECT * FROM tbl_order WHERE id_order = '" . $id . "'";
    $query_order = mysqli_query($mysqli, $sql_order);
    $row_order = mysqli_fetch_array($query_order);

    // Xóa chi tiết đơn hàng
    $sql_delete_detail = "DELETE FROM tbl_order_details WHERE order_code = '" . $row_order['order_code'] . "'";
    mysqli_query($mysqli, $sql_delete_detail);

    // Xóa đơn hàng
    $sql_xoa = "DELETE FROM tbl_order WHERE id_order = '" . $id . "'";
    mysqli_query($mysqli, $sql_xoa);
} else if (isset($_GET['action'])) {
    // Xóa tất cả đơn hàng
    $sql_delete_all_order = "TRUNCATE TABLE tbl_order ";
    mysqli_query($mysqli, $sql_delete_all_order);

    $sql_delete_all_order_details = "TRUNCATE TABLE tbl_order_details ";
    mysqli_query($mysqli, $sql_delete_all_order_details);
}