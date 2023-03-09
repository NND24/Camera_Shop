<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
//echo json_encode($_POST);
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
    $d = array("existName" => 0, "existThutu" => 0, "category_created_time" => time(), "category_last_updated" => time());
    echo json_encode(array_merge($_POST, $d));
    $sql_update = "UPDATE tbl_danhmuc SET ten_danhmuc='" . $_POST['tendanhmuc'] . "',thutu='" . $_POST['thutu'] . "',category_detail='" . $_POST['category_detail'] . "',category_detail='" . $_POST['category_detail'] . "',category_last_updated='" . time() . "' WHERE id_danhmuc='$_POST[iddanhmuc]' ";
    mysqli_query($mysqli, $sql_update);
}