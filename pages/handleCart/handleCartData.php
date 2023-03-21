<?php
session_start();
if (isset($_SESSION['cart'])) {
    $sosp = 0;
    $tongtien = 0;
    foreach ($_SESSION['cart'] as $cart_item) {
        $sosp += $cart_item['soluong'];
        $thanhtien = $cart_item['soluong'] * $cart_item['giasp'];
        $tongtien += $thanhtien;
    }
    $a = array("sosp" => $sosp, "tongtien" => $tongtien);
    echo json_encode(array_merge($a));
?>
<?php } ?>