<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

$tendanhmuc = $_POST['tendanhmuc'];
$trangthai = $_POST['trangthai'];
$category_detail = $_POST['category_detail'];

//Validate exist category name
$sql_category_name = "SELECT * FROM tbl_danhmuc WHERE ten_danhmuc='" . $tendanhmuc . "' ";
$query_category_name = mysqli_query($mysqli, $sql_category_name);

if (mysqli_num_rows($query_category_name) > 0) {
    $a = array("existName" => 1);
    echo json_encode($a);
} else {
    $d = array("existName" => 0);
    echo json_encode($d);
    $sql_them = "INSERT INTO tbl_danhmuc(ten_danhmuc, category_status, category_detail, category_created_time, category_last_updated) 
    VALUE('" . $tendanhmuc . "', '" . $trangthai . "','" . $category_detail . "','" . time() . "','" . time() . "')";
    mysqli_query($mysqli, $sql_them);
}
