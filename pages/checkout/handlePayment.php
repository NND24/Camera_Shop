<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

$id_khachhang = $_SESSION['id_user'];
$code_order = rand(0, 9999);
$insert_cart = "INSERT INTO tbl_cart(id_khachhang,code_cart,cart_status) VALUE('" . $id_khachhang . "','" . $code_order . "',1)";
$cart_query = mysqli_query($mysqli, $insert_cart);
if ($cart_query) {
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['idUser'] == $_SESSION['id_user']) {
            $id_sanpham = $cart_item['id'];
            $soluong = $cart_item['soluong'];
            $insert_order_details = "INSERT INTO tbl_cart_details(id_sanpham, id_user, code_cart, soluongmua) 
        VALUE('" . $id_sanpham . "','" . $id_khachhang . "','" . $code_order . "','" . $soluong . "')";
            mysqli_query($mysqli, $insert_order_details);
        }
    }
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['idUser'] != $_SESSION['id_user']) {
            $product[] = array(
                'tensanpham' => $cart_item['tensanpham'], 'tendanhmuc' => $cart_item['tendanhmuc'], 'id' => $cart_item['id'], 'idUser' => $cart_item['idUser'], 'soluong' => $cart_item['soluong'],
                'giasp' => $cart_item['giasp'], 'hinhanh' => $cart_item['hinhanh'], 'masp' => $cart_item['masp']
            );
        }
        $_SESSION['cart'] = $product;
    }
}
