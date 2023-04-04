<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

$username = $_POST['username'];
$email = $_POST['email'];
$duty = $_POST['duty'];
$id_admin = $_POST['idmember'];

//Validate exist member name
$sql_get_member = "SELECT * FROM tbl_admin WHERE id_admin='" . $id_admin . "' ";
$query_get_member = mysqli_query($mysqli, $sql_get_member);
$row_get_member = mysqli_fetch_array($query_get_member);

$sql_name = "SELECT * FROM tbl_admin WHERE email='" . $email . "' ";
$query_name = mysqli_query($mysqli, $sql_name);

if ($row_get_member['email'] == $email) {
    $d = array("existEmail" => 0);
    echo json_encode($d);
    $sql_update = "UPDATE tbl_admin SET username='" . $username . "',email='" . $email . "',duty='" . $duty . "',last_updated='" . time() . "' WHERE id_admin='$id_admin' ";
    mysqli_query($mysqli, $sql_update);
} else {
    if (mysqli_num_rows($query_name) > 0) {
        $a = array("existEmail" => 1);
        echo json_encode($a);
    } else {
        $d = array("existEmail" => 0);
        echo json_encode($d);
        $sql_update = "UPDATE tbl_admin SET username='" . $username . "',email='" . $email . "',duty='" . $duty . "',last_updated='" . time() . "' WHERE id_admin='$id_admin' ";
        mysqli_query($mysqli, $sql_update);
    }
}