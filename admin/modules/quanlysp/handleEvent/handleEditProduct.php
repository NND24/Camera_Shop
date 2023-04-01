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
    $giasp = round($_POST['giasp'], -3);
    $soluong = $_POST['soluong'];
    $giamgia = $_POST['giamgia'];
    $giadagiam = $giasp - ($giasp * $_POST['giamgia']) / 100;
    $trangthai = $_POST['trangthai'];
    $tomtat = $_POST['tomtat'];
    $noidung = $_POST['noidung'];
    $danhmuc = $_POST['danhmuc'];
    $last_updated = time();
    $id = mysqli_real_escape_string($mysqli, $_POST['idsanpham']);

    $b = array("existName" => 0);
    echo json_encode($b);

    $filename = $_FILES['file']['name'];
    // Location
    $location = "uploads" . DIRECTORY_SEPARATOR . time() . '_' . $filename;
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

    $image = time() . '_' . $filename;

    // Xoa hinh anh
    $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$id'  LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    while ($row = mysqli_fetch_array($query)) {
        unlink('uploads/' . $row['hinhanh']);
    }
    // Sua
    $sql_update = "UPDATE `tbl_sanpham` SET `tensanpham`='$tensanpham',`giasp`='$giasp',`soluong`='$soluong',`hinhanh`='$image',
    `giamgia`='$giamgia',`giadagiam`='round($giadagiam, -3)',`trangthaisp`='$trangthai',`tomtat`='$tomtat',`noidung`='$noidung',`id_danhmuc`='$danhmuc',`last_updated`='$last_updated' WHERE id_sanpham='$id'";
    $query_update = mysqli_query($mysqli, $sql_update);
} else {
    if (mysqli_num_rows($query_product_name) > 0) {
        $a = array("existName" => 1);
        echo json_encode($a);
    } else {
        $tensanpham = $_POST['tensanpham'];
        $giasp = round($_POST['giasp'], -3);
        $soluong = $_POST['soluong'];
        $giamgia = $_POST['giamgia'];
        $giadagiam = $giasp - ($giasp * $_POST['giamgia']) / 100;
        $trangthai = $_POST['trangthai'];
        $tomtat = $_POST['tomtat'];
        $noidung = $_POST['noidung'];
        $danhmuc = $_POST['danhmuc'];
        $last_updated = time();
        $id = mysqli_real_escape_string($mysqli, $_POST['idsanpham']);

        $b = array("existName" => 0);
        echo json_encode($b);

        $filename = $_FILES['file']['name'];
        // Location
        $location = "uploads" . DIRECTORY_SEPARATOR . time() . '_' . $filename;
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

        $image = time() . '_' . $filename;

        // Xoa hinh anh
        $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$id'  LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_array($query)) {
            unlink('uploads/' . $row['hinhanh']);
        }
        // Sua
        $sql_update = "UPDATE `tbl_sanpham` SET `tensanpham`='$tensanpham',`giasp`='$giasp',`soluong`='$soluong',`hinhanh`='$image',
        `giamgia`='$giamgia',`giadagiam`='round($giadagiam, -3)',`trangthaisp`='$trangthai',`tomtat`='$tomtat',`noidung`='$noidung',`id_danhmuc`='$danhmuc',`last_updated`='$last_updated' WHERE id_sanpham='$id'";
        $query_update = mysqli_query($mysqli, $sql_update);
    }
}