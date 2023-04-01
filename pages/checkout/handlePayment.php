<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];
    $order_code = rand(0, 99999999);
    $amount = $_POST['amount'];
    $total = $_POST['total'];

    $sql_address = "SELECT * FROM tbl_user WHERE id_user='$_SESSION[id_user]' LIMIT 1 ";
    $query_address = mysqli_query($mysqli, $sql_address);
    $row_address = mysqli_fetch_array($query_address);

    $tendathang = $row_address['tendathang'];
    $sodienthoaidathang = $row_address['sodienthoaidathang'];
    $address_detail = $row_address['address_detail'];
    $province_id = $row_address['province_id'];
    $district_id = $row_address['district_id'];
    $wards_id = $row_address['wards_id'];

    $sql_order = "INSERT INTO tbl_order (id_user, order_code, order_status, tendathang, sodienthoaidathang,address_detail, province_id, district_id, wards_id, amount, total, buyed_date) VALUES ('" . $id_user . "','" . $order_code . "',0,'" . $tendathang . "','" . $sodienthoaidathang . "','" . $address_detail . "','" . $province_id . "','" . $district_id . "','" . $wards_id . "','" . $amount . "','" . $total . "','" . time() . "' )";

    $query_order = mysqli_query($mysqli, $sql_order);

    if ($query_order) {
        $sql_cart = "SELECT * FROM tbl_cart, tbl_sanpham WHERE tbl_cart.id_sanpham=tbl_sanpham.id_sanpham AND id_user='$_SESSION[id_user])'";
        $query_cart = mysqli_query($mysqli, $sql_cart);

        while ($row_cart = mysqli_fetch_array($query_cart)) {
            if ($row_cart['id_user'] == $_SESSION['id_user']) {
                $insert_order_details = "INSERT INTO tbl_order_details(id_user,order_code,id_sanpham, soluongmua) 
        VALUE('" . $id_user . "','" . $order_code . "','" . $row_cart['id_sanpham'] . "','" . $row_cart['amount'] . "')";
                mysqli_query($mysqli, $insert_order_details);

                $soluong = $row_cart['soluong'] - $row_cart['amount'];
                $daban = $row_cart['daban'] + $row_cart['amount'];
                $sql_update = "UPDATE `tbl_sanpham` SET `soluong`='$soluong',`daban`='$daban',`last_updated`='" . time() . "' WHERE id_sanpham='" . $row_cart['id_sanpham'] . "'";
                mysqli_query($mysqli, $sql_update);
            }
        }

        $sql_xoa = "DELETE FROM tbl_cart WHERE id_user='$_SESSION[id_user])'";
        mysqli_query($mysqli, $sql_xoa);
    }
}
