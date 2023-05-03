<?php
session_start();
include('../../admin/config/config.php');
if (isset($_SESSION['id_user'])) {
    $sql_cart = "SELECT * FROM tbl_cart, tbl_sanpham WHERE tbl_cart.id_sanpham=tbl_sanpham.id_sanpham AND id_user='$_SESSION[id_user])'";
    $query_cart = mysqli_query($mysqli, $sql_cart);
    $cartCount = 0;
    $sosp = 0;
    $tongtien = 0;
    while ($row_cart = mysqli_fetch_array($query_cart)) {
        if ($row_cart['id_user'] == $_SESSION['id_user']) {
            $sosp += $row_cart['amount'];
            $thanhtien = $row_cart['amount'] * $row_cart['giadagiam'];
            $tongtien += $thanhtien;
            $cartCount++;
        }
    }
    $tongtien = number_format(round($tongtien, -3), 0, ',', '.');
    $a = array("sosp" => $sosp, "tongtien" => $tongtien, "cartCount" => $cartCount);
    echo json_encode($a);
?>
<?php } ?>