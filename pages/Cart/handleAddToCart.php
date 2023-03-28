<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

if (isset($_SESSION['id_user'])) {
    $id = $_POST['id_sanpham'];
    $soluong = 1;
    $sql = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc AND tbl_sanpham.id_sanpham='" . $id . "' LIMIT 1 ";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($query);
    if ($row) {
        $new_product = array(
            array(
                'tensanpham' => $row['tensanpham'],
                'tendanhmuc' => $row['ten_danhmuc'],
                'id' => $id,
                'idUser' => $_SESSION['id_user'],
                'soluong' => $soluong,
                'giasp' => $row['giadagiam'],
                'hinhanh' => $row['hinhanh'],
                'masp' => $row['masp']
            )
        );

        // Kiem tra session gio hang ton tai
        if (isset($_SESSION['cart'])) {
            $found = false;
            $product = array();
            foreach ($_SESSION['cart'] as $cart_item) {
                if ($cart_item['idUser'] == $_SESSION['id_user']) {
                    // Neu du lieu trung
                    if ($cart_item['id'] == $id) {
                        $cart_item['soluong']++;
                        $found = true;
                    }
                    $product[] = $cart_item;
                } else {
                    $product[] = $cart_item;
                }
            }
            if ($found == false) {
                // Ket hop product va new product
                $product = array_merge($product, $new_product);
            }
            usort($product, function ($a, $b) {
                return $a['idUser'] - $b['idUser'];
            });
            $_SESSION['cart'] = $product;
        } else {
            $_SESSION['cart'] = $new_product;
        }
    }
}

echo json_encode($_SESSION['cart']);
