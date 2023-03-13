<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

$tensanpham = $_POST['tensanpham'];
$masp = time() . mt_rand(0, 999);
$giasp = $_POST['giasp'];
$soluong = $_POST['soluong'];
$image = $_SESSION['product_img'];
$giamgia = $_POST['giamgia'];
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
    if (isset($_GET['query'])) {
        // Location
        $location = "uploads" . DIRECTORY_SEPARATOR . $_SESSION['product_img'];
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
    }

    $b = array("existName" => 0);
    echo json_encode($b);
    if (isset($_GET['action'])) {
        $sql_them = "INSERT INTO tbl_sanpham(tensanpham, masp, giasp, soluong, hinhanh, giamgia, tomtat,
 noidung, trangthaisp, id_danhmuc, created_time, last_updated) 
VALUE('" . $tensanpham . "','" . $masp . "','" . $giasp . "','" . $soluong . "','" . $image . "','" . $giamgia . "','" . $tomtat . "','" . $noidung . "',
'" . $trangthai . "','" . $danhmuc . "','" . time() . "','" . time() . "')";
        mysqli_query($mysqli, $sql_them);
    }
}
/** VALIDATE EXIST END **/
