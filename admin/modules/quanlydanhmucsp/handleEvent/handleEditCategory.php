<?php
include('../../../../admin/config/config.php');

$tendanhmuc = $_POST['tendanhmuc'];
$trangthai = $_POST['trangthai'];
$category_detail = $_POST['category_detail'];
$id_category = $_POST['iddanhmuc'];

//Validate exist category name
$sql_get_category = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc='" . $id_category . "' ";
$query_get_category = mysqli_query($mysqli, $sql_get_category);
$row_get_category = mysqli_fetch_array($query_get_category);

$sql_name = "SELECT * FROM tbl_danhmuc WHERE ten_danhmuc='" . $tendanhmuc . "' ";
$query_name = mysqli_query($mysqli, $sql_name);

if ($row_get_category['ten_danhmuc'] == $tendanhmuc) {
    $d = array("existName" => 0);
    echo json_encode($d);
    $sql_update = "UPDATE tbl_danhmuc SET ten_danhmuc='" . $tendanhmuc . "',category_status='" . $trangthai . "',category_detail='" . $category_detail . "',category_last_updated='" . time() . "' WHERE id_danhmuc='$id_category' ";
    mysqli_query($mysqli, $sql_update);
} else {
    if (mysqli_num_rows($query_name) > 0) {
        $a = array("existName" => 1);
        echo json_encode($a);
    } else {
        $d = array("existName" => 0);
        echo json_encode($d);
        $sql_update = "UPDATE tbl_danhmuc SET ten_danhmuc='" . $tendanhmuc . "',category_status='" . $trangthai . "',category_detail='" . $category_detail . "',category_last_updated='" . time() . "' WHERE id_danhmuc='$id_category' ";
        mysqli_query($mysqli, $sql_update);
    }
}
