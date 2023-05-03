<?php
session_start();
include('../../../../admin/config/config.php');

if ($_GET['dangnhap']) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM tbl_admin WHERE email='" . $email . "' AND password='" . $password . "' LIMIT 1 ";
    $query = mysqli_query($mysqli, $sql);
    $data = mysqli_fetch_array($query);
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        $a = array("error" => 0);
        echo json_encode($a);
        $_SESSION['dangnhap'] = $data['id_admin'];
    } else {
        $a = array("error" => 1);
        echo json_encode($a);
    }
} else if ($_GET['dangxuat']) {
    if ((isset($_GET['dangxuat']) == 1)) {
        unset($_SESSION['dangnhap']);
    }
}
