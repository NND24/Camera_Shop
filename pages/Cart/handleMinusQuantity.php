<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
$id = $_POST['id_sanpham'];

if (isset($_SESSION['id_user'])) {
    $id_sanpham = $_POST['id_sanpham'];

    $sql_cart = "SELECT * FROM tbl_cart WHERE id_sanpham='$id_sanpham' AND id_user='$_SESSION[id_user]'";
    $query_cart = mysqli_query($mysqli, $sql_cart);
    $row_cart = mysqli_fetch_array($query_cart);

    if ($row_cart['amount'] > 1) {
        $soluong = $row_cart['amount'] - 1;
        $sql_update = "UPDATE tbl_cart SET amount='" . $soluong . "' WHERE id_sanpham='$id_sanpham' AND id_user='$_SESSION[id_user]'";
        mysqli_query($mysqli, $sql_update);
    }
}
