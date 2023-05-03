<?php
include('../../admin/config/config.php');

$province_id = $_POST['province_id'];

$sql_district = "SELECT * FROM district WHERE province_id='$province_id '";
$query_district = mysqli_query($mysqli, $sql_district);


$data[0] = [
    'id' => null,
    'name' => 'Chọn một Quận/Huyện'
];

while ($row_district = mysqli_fetch_array($query_district)) {
    $data[] = [
        'id' => $row_district['district_id'],
        'name' => $row_district['name']
    ];
}

echo json_encode($data);
