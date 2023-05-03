<?php
session_start();
include('../../../../admin/config/config.php');

$tensanpham = $_POST['tensanpham'];
$giasp = round($_POST['giasp'], -3);
$soluong = $_POST['soluong'];
$filename = $_FILES['file']['name'];
$image = time() . '_' . $filename;
$giamgia = $_POST['giamgia'];
$giadagiam = $giasp - ($giasp * $_POST['giamgia']) / 100;
$tomtat = $_POST['tomtat'];
$noidung = $_POST['noidung'];
$trangthai = $_POST['trangthai'];
$danhmuc = $_POST['danhmuc'];

/** VALIDATE EXIST START **/

//Validate exist category name
$sql_product_name = "SELECT * FROM tbl_sanpham WHERE tensanpham='" . $_POST['tensanpham'] . "' ";
$query_product_name = mysqli_query($mysqli, $sql_product_name);
if (mysqli_num_rows($query_product_name) > 0) {
    $a = array("existName" => 1);
    echo json_encode($a);
} else {
    // Location
    $location = "uploads" . DIRECTORY_SEPARATOR . time() . '_' . $filename;
    $uploadOk = 1;
    $imageFileType = pathinfo($location, PATHINFO_EXTENSION);

    // Valid Extension
    $valid_extensions = array("jpg", "jpeg", "png", "gif");
    // Check
    if (!in_array(strtolower($imageFileType), $valid_extensions)) {
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo 0;
    } else {
        move_uploaded_file($_FILES['file']['tmp_name'], realpath('') . DIRECTORY_SEPARATOR . $location);
    }


    $b = array("existName" => 0);
    echo json_encode($b);
    $sql_them = "INSERT INTO tbl_sanpham(tensanpham, giasp, soluong, hinhanh, giamgia,giadagiam, tomtat,
 noidung, trangthaisp, id_danhmuc, created_time, last_updated) 
VALUE('" . $tensanpham . "','" . $giasp . "','" . $soluong . "','" . $image . "','" . $giamgia . "','" . round($giadagiam, -3)  . "','" . $tomtat . "','" . $noidung . "',
'" . $trangthai . "','" . $danhmuc . "','" . time() . "','" . time() . "')";
    mysqli_query($mysqli, $sql_them);
}
/** VALIDATE EXIST END **/
