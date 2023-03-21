<?php
session_start();
$id = $_POST['id_sanpham'];
foreach ($_SESSION['cart'] as $cart_item) {
    if ($cart_item['id'] != $id) {
        $product[] = array(
            'tensanpham' => $cart_item['tensanpham'], 'tendanhmuc' => $cart_item['tendanhmuc'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'],
            'giasp' => $cart_item['giasp'], 'hinhanh' => $cart_item['hinhanh'], 'masp' => $cart_item['masp']
        );
        $_SESSION['cart'] = $product;
    } else {
        $giamsoluong = $cart_item['soluong'] - 1;
        if ($cart_item['soluong'] > 1) {
            $product[] = array(
                'tensanpham' => $cart_item['tensanpham'], 'tendanhmuc' => $cart_item['tendanhmuc'], 'id' => $cart_item['id'], 'soluong' => $giamsoluong,
                'giasp' => $cart_item['giasp'], 'hinhanh' => $cart_item['hinhanh'], 'masp' => $cart_item['masp']
            );
        } else {
            $product[] = array(
                'tensanpham' => $cart_item['tensanpham'], 'tendanhmuc' => $cart_item['tendanhmuc'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'],
                'giasp' => $cart_item['giasp'], 'hinhanh' => $cart_item['hinhanh'], 'masp' => $cart_item['masp']
            );
        }
        $_SESSION['cart'] = $product;
    }
}
echo json_encode($_POST);