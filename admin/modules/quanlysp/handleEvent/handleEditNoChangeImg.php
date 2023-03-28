<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

/** VALIDATE EXIST START **/

//Validate exist category name
$sql_product = "SELECT * FROM tbl_sanpham WHERE id_sanpham='" . $_POST['idsanpham'] . "'";
$query_product = mysqli_query($mysqli, $sql_product);
$row_product = mysqli_fetch_array($query_product);

$sql_product_name = "SELECT * FROM tbl_sanpham WHERE tensanpham='" . $_POST['tensanpham'] . "'";
$query_product_name = mysqli_query($mysqli, $sql_product_name);

if ($row_product['tensanpham'] == $_POST['tensanpham']) {
    $tensanpham = $_POST['tensanpham'];
    $giasp = $_POST['giasp'];
    $soluong = $_POST['soluong'];
    $giamgia = $_POST['giamgia'];
    $giadagiam = $_POST['giasp'] - ($_POST['giasp'] * $_POST['giamgia']) / 100;
    $tomtat = $_POST['tomtat'];
    $noidung = $_POST['noidung'];
    $trangthai = $_POST['trangthai'];
    $danhmuc = $_POST['danhmuc'];
    $last_updated = time();
    $id = $_POST['idsanpham'];

    $b = array("existName" => 0);
    echo json_encode($b);

    // Sua
    $sql_update = "UPDATE tbl_sanpham SET tensanpham='" . $tensanpham . "',giasp='" . $giasp . "',soluong='" . $soluong . "',giamgia='" . $giamgia . "',
    giadagiam='" . $giadagiam . "',tomtat='" . $tomtat . "',noidung='" . $noidung . "',	trangthaisp='" . $trangthai . "',id_danhmuc='" . $danhmuc . "',
    last_updated='" . $last_updated . "' WHERE id_sanpham='$id' ";
    $query_update = mysqli_query($mysqli, $sql_update);
} else {
    if (mysqli_num_rows($query_product_name) > 0) {
        $a = array("existName" => 1);
        echo json_encode($a);
    } else {
        $tensanpham = $_POST['tensanpham'];
        $giasp = $_POST['giasp'];
        $soluong = $_POST['soluong'];
        $giamgia = $_POST['giamgia'];
        $giadagiam = $_POST['giasp'] - ($_POST['giasp'] * $_POST['giamgia']) / 100;
        $tomtat = $_POST['tomtat'];
        $noidung = $_POST['noidung'];
        $trangthai = $_POST['trangthai'];
        $danhmuc = $_POST['danhmuc'];
        $last_updated = time();
        $id = $_POST['idsanpham'];

        $b = array("existName" => 0);
        echo json_encode($b);

        // Sua
        $sql_update = "UPDATE tbl_sanpham SET tensanpham='" . $tensanpham . "',giasp='" . $giasp . "',soluong='" . $soluong . "',giamgia='" . $giamgia . "',
    giadagiam='" . $giadagiam . "',tomtat='" . $tomtat . "',noidung='" . $noidung . "',	trangthaisp='" . $trangthai . "',id_danhmuc='" . $danhmuc . "',
    last_updated='" . $last_updated . "' WHERE id_sanpham='$id' ";
        $query_update = mysqli_query($mysqli, $sql_update);
    }
}
