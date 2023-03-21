<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

$id = $_POST['id_sanpham'];
$soluong = 1;
$sql = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc AND tbl_sanpham.id_sanpham='" . $id . "' LIMIT 1 ";
$query = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_array($query);
if ($row) {
    $new_product = array(array(
        'tensanpham' => $row['tensanpham'], 'tendanhmuc' => $row['ten_danhmuc'], 'id' => $id, 'soluong' => $soluong, 'giasp' => $row['giadagiam'],
        'hinhanh' => $row['hinhanh'], 'masp' => $row['masp']
    ));
    // Kiem tra session gio hang ton tai
    if (isset($_SESSION['cart'])) {
        $found = false;
        foreach ($_SESSION['cart'] as $cart_item) {
            // Neu du lieu trung
            if ($cart_item['id'] == $id) {
                $product[] = array(
                    'tensanpham' => $cart_item['tensanpham'], 'tendanhmuc' => $cart_item['tendanhmuc'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'] + 1,
                    'giasp' => $cart_item['giasp'], 'hinhanh' => $cart_item['hinhanh'], 'masp' => $cart_item['masp']
                );
                $found = true;
            } else {
                // Neu du lieu khong trung
                $product[] = array(
                    'tensanpham' => $cart_item['tensanpham'], 'tendanhmuc' => $cart_item['tendanhmuc'], 'id' => $cart_item['id'], 'soluong' => $cart_item['soluong'],
                    'giasp' => $cart_item['giasp'], 'hinhanh' => $cart_item['hinhanh'], 'masp' => $cart_item['masp']
                );
            }
        }
        if ($found == false) {
            // Ket hop product va new product
            $_SESSION['cart'] = array_merge($product, $new_product);
        } else {
            $_SESSION['cart'] = $product;
        }
    } else {
        $_SESSION['cart'] = $new_product;
    }
}