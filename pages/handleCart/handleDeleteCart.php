<?php
session_start();
$id = $_POST['id_sanpham'];
foreach ($_SESSION['cart'] as $cart_item) {
    if ($cart_item['id'] != $id || $cart_item['idUser'] != $_SESSION['id_user']) {
        $product[] = array(
            'tensanpham' => $cart_item['tensanpham'], 'tendanhmuc' => $cart_item['tendanhmuc'], 'id' => $cart_item['id'], 'idUser' => $cart_item['idUser'], 'soluong' => $cart_item['soluong'],
            'giasp' => $cart_item['giasp'], 'hinhanh' => $cart_item['hinhanh'], 'masp' => $cart_item['masp']
        );
    }
    if ($cart_item['idUser'] != $_SESSION['id_user']) {
    }
    $_SESSION['cart'] = $product;
}
