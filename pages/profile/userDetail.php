<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

$sql_user = "SELECT * FROM tbl_user WHERE id_user='$_SESSION[id_user]'";
$query_user = mysqli_query($mysqli, $sql_user);
$row_user = mysqli_fetch_array($query_user);

$sql_address = "SELECT * FROM tbl_user WHERE id_user='$_SESSION[id_user]' LIMIT 1 ";
$query_address = mysqli_query($mysqli, $sql_address);
$row_address = mysqli_fetch_array($query_address);

$sql_province = "SELECT * FROM province WHERE province_id='$row_address[province_id]' LIMIT 1 ";
$query_province = mysqli_query($mysqli, $sql_province);
$row_province = mysqli_fetch_array($query_province);

$sql_district = "SELECT * FROM district WHERE district_id='$row_address[district_id]' LIMIT 1 ";
$query_district = mysqli_query($mysqli, $sql_district);
$row_district = mysqli_fetch_array($query_district);

$sql_wards = "SELECT * FROM wards WHERE wards_id='$row_address[wards_id]' LIMIT 1 ";
$query_wards = mysqli_query($mysqli, $sql_wards);
$row_wards = mysqli_fetch_array($query_wards);
?>
<?php if (strlen($row_address['tendathang']) && strlen($row_address['phonenumber']) && $row_address['province_id'] != 0 && $row_address['district_id'] != 0 && $row_address['wards_id'] != 0) { ?>
    <h2>Hồ sơ của tôi</h2>
    <p>Tên đăng nhập: <?php echo $row_user['name'] ?></p>
    <p>Email: <?php echo $row_user['email'] ?></p>
    <p>Họ và tên: <?php echo $row_user['tendathang'] ?></p>
    <p>Số điện thoại: <?php echo $row_user['phonenumber'] ?></p>
    <p>Địa chỉ: <?php echo $row_wards['name'] ?>,
        <?php echo $row_district['name'] ?>,
        <?php echo $row_province['name'] ?>
        <br>
    <p><?php echo $row_address['address_detail'] ?></p>
    </p>
<?php } else { ?>
    <h2>Hồ sơ của tôi</h2>
    <p>Tên đăng nhập: <?php echo $row_user['name'] ?></p>
    <p>Email: <?php echo $row_user['email'] ?></p>
<?php } ?>