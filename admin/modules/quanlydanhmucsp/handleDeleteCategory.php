<?php
include('../../config/config.php');
echo json_encode($_GET['iddanhmuc']);

$id = $_GET['iddanhmuc'];
$sql_xoa = "DELETE FROM tbl_danhmuc WHERE id_danhmuc='" . $id . "'";
$query_xoa = mysqli_query($mysqli, $sql_xoa);
if ($query_xoa) {
    echo "Xóa thành công";
} else {
    echo "Không xóa được";
}
