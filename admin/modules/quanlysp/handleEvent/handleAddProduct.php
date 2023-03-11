<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
echo json_encode($_POST);
// var_dump($_FILES);


//Validate exist category name
// $sql_category_name = "SELECT * FROM tbl_danhmuc WHERE ten_danhmuc='" . $_POST['tendanhmuc'] . "' ";
// $query_category_name = mysqli_query($mysqli, $sql_category_name);
// Validate exist category thu tu
// $sql_category_thutu = "SELECT * FROM tbl_danhmuc WHERE thutu='" . $_POST['thutu'] . "' ";
// $query_category_thutu  = mysqli_query($mysqli, $sql_category_thutu);


// if (mysqli_num_rows($query_category_name) > 0 && mysqli_num_rows($query_category_thutu) > 0) {
//     $a = array("existName" => 1, "existThutu" => 1);
//     echo json_encode(array_merge($_POST, $a));
// } else if (mysqli_num_rows($query_category_name) == 0 && mysqli_num_rows($query_category_thutu) > 0) {
//     $b = array("existName" => 0, "existThutu" => 1);
//     echo json_encode(array_merge($_POST, $b));
// } else if (mysqli_num_rows($query_category_name) > 0 && mysqli_num_rows($query_category_thutu) == 0) {
//     $c = array("existName" => 1, "existThutu" => 0);
//     echo json_encode(array_merge($_POST, $c));
// } else {
// }

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
// $d = array("existName" => 0, "existThutu" => 0, "category_created_time" => time(), "category_last_updated" => time());
// echo json_encode(array_merge($_POST, $d));
$sql_them = "INSERT INTO tbl_sanpham(tensanpham, masp, giasp, soluong, hinhanh, giamgia, tomtat,
 noidung, trangthaisp, id_danhmuc, created_time, last_updated) 
VALUE('" . $tensanpham . "','" . $masp . "','" . $giasp . "','" . $soluong . "','" . $image . "','" . $giamgia . "','" . $tomtat . "','" . $noidung . "',
'" . $trangthai . "','" . $danhmuc . "','" . time() . "','" . time() . "')";
mysqli_query($mysqli, $sql_them);
