<?php
//$a = array("tontai" => "khong");
//echo json_encode(array_merge($_POST, $a));
echo json_encode($_POST);
include('../../config/config.php');
$tenloaisp = $_POST['tendanhmuc'];
$thutu = $_POST['thutu'];
$trangthai = $_POST['trangthai'];
$error = false;

if (isset($_POST['suadanhmuc'])) {
    $sql_update = "UPDATE tbl_danhmuc SET ten_danhmuc='" . $tenloaisp . "',thutu='" . $thutu . "' WHERE id_danhmuc='$_GET[iddanhmuc]' ";
    mysqli_query($mysqli, $sql_update);
    header('Location:../../index.php?action=quanlydanhmucsanpham&query=them');
} else {
    // $id = $_GET['iddanhmuc'];
    // $sql_xoa = "DELETE FROM tbl_danhmuc WHERE id_danhmuc='" . $id . "'";
    // mysqli_query($mysqli, $sql_xoa);
    //header('Location:../../index.php?action=quanlydanhmucsanpham&query=them');
}
