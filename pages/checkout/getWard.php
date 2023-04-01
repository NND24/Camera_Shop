<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

$district_id = $_POST['district_id'];

$sql_wards = "SELECT * FROM wards WHERE district_id='$district_id '";
$query_wards = mysqli_query($mysqli, $sql_wards);


$data[0] = [
    'id' => null,
    'name' => 'Chọn một xã/phường'
];

while ($row_wards = mysqli_fetch_array($query_wards)) {
    $data[] = [
        'id' => $row_wards['wards_id'],
        'name' => $row_wards['name']
    ];
}

echo json_encode($data);