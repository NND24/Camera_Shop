<?php
include('../../../admin/config/config.php');
require '../../Carbon/autoload.php';

use Carbon\Carbon;

if (isset($_POST['thoigian'])) {
    $thoigian = $_POST['thoigian'];
} else {
    $thoigian = '';
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
}

if ($thoigian == '7ngay') {
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
} else if ($thoigian == '28ngay') {
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(28)->toDateString();
} else if ($thoigian == '90ngay') {
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->toDateString();
} else if ($thoigian == '365ngay') {
    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
}

$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

$sql = "SELECT * FROM tbl_tkdonhang WHERE ngaydat BETWEEN '$subdays' AND '$now'  ORDER BY ngaydat";
$query = mysqli_query($mysqli, $sql);
$char_data = array(); // Initialize the variable as an empty array
while ($val = mysqli_fetch_array($query)) {
    $char_data[] = array(
        'date' => $val['ngaydat'],
        'sales' => $val['doanhthu'],
        'quantity' => $val['soluongban'],
    );
}

echo $data = json_encode($char_data);
