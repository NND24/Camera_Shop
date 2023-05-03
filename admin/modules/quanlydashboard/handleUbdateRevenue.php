<?php
include('../../../admin/config/config.php');
require '../../Carbon/autoload.php';

use Carbon\Carbon;

$sql_order = "SELECT * FROM tbl_order";
$query_order = mysqli_query($mysqli, $sql_order);

$sql_tkhoadon = "SELECT * FROM tbl_tkdonhang";
$query_tkhoadon = mysqli_query($mysqli, $sql_tkhoadon);

$data = array();

while ($row = mysqli_fetch_array($query_order)) {
    $date = date('Y-m-d', $row['buyed_date']);
    if (isset($data[$date])) {
        $data[$date]['soluongmua'] += $row['amount'];
        $data[$date]['doanhthu'] += $row['total'];
    } else {
        $data[$date]['soluongmua'] = $row['amount'];
        $data[$date]['doanhthu'] = $row['total'];
    }
}


if (mysqli_num_rows($query_tkhoadon) != 0) {
    mysqli_query($mysqli, "TRUNCATE TABLE tbl_tkdonhang");
    foreach ($data as $date => $values) {
        mysqli_query($mysqli, "INSERT INTO tbl_tkdonhang (ngaydat,soluongban,doanhthu) VALUE('$date','$values[soluongmua]','$values[doanhthu]')");
    }
} else {
    foreach ($data as $date => $values) {
        mysqli_query($mysqli, "INSERT INTO tbl_tkdonhang (ngaydat,soluongban,doanhthu) VALUE('$date','$values[soluongmua]','$values[doanhthu]')");
    }
}
