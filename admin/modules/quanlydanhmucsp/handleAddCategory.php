<?php
include('../../config/config.php');
//echo json_encode($_POST);

//Validate exist category name
$sql_category_name = "SELECT * FROM tbl_danhmuc WHERE ten_danhmuc='" . $_POST['tendanhmuc'] . "' ";
$query_category_name = mysqli_query($mysqli, $sql_category_name);
// Validate exist category thu tu
$sql_category_thutu = "SELECT * FROM tbl_danhmuc WHERE thutu='" . $_POST['thutu'] . "' ";
$query_category_thutu  = mysqli_query($mysqli, $sql_category_thutu);


if (mysqli_num_rows($query_category_name) > 0 && mysqli_num_rows($query_category_thutu) > 0) {
    $a = array("existName" => 1, "existThutu" => 1);
    echo json_encode(array_merge($_POST, $a));
} else if (mysqli_num_rows($query_category_name) == 0 && mysqli_num_rows($query_category_thutu) > 0) {
    $b = array("existName" => 0, "existThutu" => 1);
    echo json_encode(array_merge($_POST, $b));
} else if (mysqli_num_rows($query_category_name) > 0 && mysqli_num_rows($query_category_thutu) == 0) {
    $c = array("existName" => 1, "existThutu" => 0);
    echo json_encode(array_merge($_POST, $c));
} else {
    $tendanhmuc = $_POST['tendanhmuc'];
    $thutu = $_POST['thutu'];
    $trangthai = $_POST['trangthai'];
    $category_detail = $_POST['category_detail'];
    $d = array("existName" => 0, "existThutu" => 0, "category_created_time" => time(), "category_last_updated" => time());
    echo json_encode(array_merge($_POST, $d));
}

if (mysqli_num_rows($query_category_name) == 0 && mysqli_num_rows($query_category_thutu) == 0) {
    $sql_them = "INSERT INTO tbl_danhmuc(ten_danhmuc, thutu,category_status,category_detail,category_created_time,category_last_updated) 
    VALUE('" . $tendanhmuc . "', '" . $thutu . "', '" . $trangthai . "','" . $category_detail . "','" . time() . "','" . time() . "')";
    mysqli_query($mysqli, $sql_them);
}
