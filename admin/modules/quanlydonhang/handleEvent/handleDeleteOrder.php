<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

if (isset($_GET['idsanpham'])) {
    $id = $_GET['idsanpham'];
    $sql_cart = "SELECT * FROM tbl_cart WHERE id_cart = '" . $id . "'";
    $query_cart = mysqli_query($mysqli, $sql_cart);
    $row_cart = mysqli_fetch_array($query_cart);

    // Xóa chi tiết đơn hàng
    $sql_delete_detail = "DELETE FROM tbl_cart_details WHERE code_cart = '" . $row_cart['code_cart'] . "'";
    mysqli_query($mysqli, $sql_delete_detail);

    // Xóa đơn hàng
    $sql_xoa = "DELETE FROM tbl_cart WHERE id_cart = '" . $id . "'";
    mysqli_query($mysqli, $sql_xoa);
} else if (isset($_GET['action'])) {
    // Xóa tất cả đơn hàng
    $sql_delete_all_cart = "TRUNCATE TABLE tbl_cart ";
    mysqli_query($mysqli, $sql_delete_all_cart);

    $sql_delete_all_cart_details = "TRUNCATE TABLE tbl_cart_details ";
    mysqli_query($mysqli, $sql_delete_all_cart_details);
}
