<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

if (isset($_SESSION['id_user'])) {
    $id_sanpham = $_POST['id_sanpham'];

    $sql_cart = "SELECT * FROM tbl_cart WHERE id_sanpham='$id_sanpham' AND id_user='$_SESSION[id_user]'";
    $query_cart = mysqli_query($mysqli, $sql_cart);
    $row_cart = mysqli_fetch_array($query_cart);

    $sql_sanpham = "SELECT * FROM tbl_sanpham WHERE id_sanpham='$id_sanpham'";
    $query_sanpham = mysqli_query($mysqli, $sql_sanpham);
    $row_sanpham = mysqli_fetch_array($query_sanpham);

    if ($row_sanpham['soluong'] - 1 < 0) {
        $a = array("hethang" => 1);
        echo json_encode($a);
    } else {
        if ($row_cart['id_sanpham'] == $id_sanpham) {
            if ($row_sanpham['soluong'] - ($row_cart['amount'] + 1) < 0) {
                $a = array("hethang" => 1);
                echo json_encode($a);
            } else {

                $soluong = $row_cart['amount'] + 1;
                $sql_update = "UPDATE tbl_cart SET amount='" . $soluong . "' WHERE id_sanpham='$id_sanpham' AND id_user='$_SESSION[id_user]'";
                mysqli_query($mysqli, $sql_update);
            }
        } else {
            $sql_them = "INSERT INTO tbl_cart(id_user, id_sanpham, amount) 
        VALUE('" . $_SESSION['id_user'] . "', '" . $id_sanpham . "','" . 1 . "')";
            mysqli_query($mysqli, $sql_them);
        }
    }
}
