<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

if ($_GET['dangnhap']) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM tbl_admin WHERE email='" . $email . "' AND password='" . $password . "' LIMIT 1 ";
    $query = mysqli_query($mysqli, $sql);
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        $a = array("error" => 0);
        echo json_encode($a);
        $_SESSION['dangnhap'] = $email;
    } else {
        $a = array("error" => 1);
        echo json_encode($a);
    }
} else if ($_GET['dangxuat']) {
    if ((isset($_GET['dangxuat']) == 1)) {
        unset($_SESSION['dangnhap']);
    }
}
