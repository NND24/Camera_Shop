<?php
session_start();
if (isset($_SESSION['cart']) && isset($_SESSION['id_user'])) {
    $sosp = 0;
    $tongtien = 0;
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['idUser'] == $_SESSION['id_user']) {
            $sosp += $cart_item['soluong'];
            $thanhtien = $cart_item['soluong'] * $cart_item['giasp'];
            $tongtien += $thanhtien;
        }
    }
    $tongtien = number_format($tongtien, 0, ',', '.');
    $a = array("sosp" => $sosp, "tongtien" => $tongtien);
    echo json_encode(array_merge($a));
?>
<?php } ?>