<?php
session_start();
include('../../admin/config/config.php');

$email = $_POST['email'];
$password = $_POST['password'];

$sql_user = "SELECT * FROM tbl_user WHERE email='" . $_POST['email'] . "' AND password='" . $_POST['password'] . "' LIMIT 1 ";
$query_user = mysqli_query($mysqli, $sql_user);
if (mysqli_num_rows($query_user) > 0) {
    $a = array("existAccount" => 1);
    echo json_encode($a);
    $data = mysqli_fetch_array($query_user);
    $_SESSION['login'] = $data['name'];
    $_SESSION['id_user'] = $data['id_user'];
} else {
    $b = array("existAccount" => 0);
    echo json_encode($b);
}

if (isset($_GET['logout'])) {
    unset($_SESSION['login']);
    unset($_SESSION['id_user']);
}
