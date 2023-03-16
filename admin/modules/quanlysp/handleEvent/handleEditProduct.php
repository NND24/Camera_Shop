<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
//echo json_encode($_POST);

if (isset($_GET['query'])) {
    // Location
    $location = "uploads" . DIRECTORY_SEPARATOR . $_SESSION['product_img'];
    //echo $location;
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


if (isset($_GET['action'])) {
    $tensanpham = $_POST['tensanpham'];
    $giasp = $_POST['giasp'];
    $soluong = $_POST['soluong'];
    $image = $_SESSION['product_img'];
    $giamgia = $_POST['giamgia'];
    $giadagiam = $_POST['giasp'] - ($_POST['giasp'] * $_POST['giamgia']) / 100;
    $trangthai = $_POST['trangthai'];
    $tomtat = $_POST['tomtat'];
    $noidung = $_POST['noidung'];
    $danhmuc = $_POST['danhmuc'];
    $last_updated = time();
    $id = mysqli_real_escape_string($mysqli, $_POST['idsanpham']);
    // Xoa hinh anh
    $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$id'  LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    while ($row = mysqli_fetch_array($query)) {
        //unlink('uploads/' . $row['hinhanh']);
    }

    //if ($image != '') {
    // Sua
    $sql_update = "UPDATE `tbl_sanpham` SET `tensanpham`='$tensanpham',`giasp`='$giasp',`soluong`='$soluong',`hinhanh`='$image',
    `giamgia`='$giamgia',`giadagiam`='$giadagiam',`trangthaisp`='$trangthai',`tomtat`='$tomtat',`noidung`='$noidung',`id_danhmuc`='$danhmuc',`last_updated`='$last_updated' WHERE id_sanpham='$id'";
    $query_update = mysqli_query($mysqli, $sql_update);
    // } else {
    //     $sql_update = "UPDATE tbl_sanpham SET tensanpham='" . $tensanpham . "',masp='" . $masp . "',giasp='" . $giasp . "',
    //     soluong='" . $soluong . "',giamgia='" . $giamgia . "',tomtat='" . $tomtat . "',noidung='" . $noidung . "',trangthai='" . $trangthai . "',id_danhmuc='" . $danhmuc . "'  
    //     WHERE id_sanpham='$_GET[idsanpham]' ";
    // }
}
