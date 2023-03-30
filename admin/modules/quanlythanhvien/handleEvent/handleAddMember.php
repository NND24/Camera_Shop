<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

$username = $_POST['username'];
$email = $_POST['email'];
$duty = $_POST['duty'];
$password = $_POST['password'];

//Validate exist  name
$sql_name = "SELECT * FROM tbl_admin WHERE email='" . $email . "' ";
$query_name = mysqli_query($mysqli, $sql_name);

if (mysqli_num_rows($query_name) > 0) {
    $a = array("existName" => 1);
    echo json_encode($a);
} else {
    $d = array("existName" => 0);
    echo json_encode($d);
    $sql_them = "INSERT INTO tbl_admin(username, email, duty, password, created_time, last_updated) 
    VALUE('" . $username . "', '" . $email . "','" . $duty . "','" . $password . "','" . time() . "','" . time() . "')";
    mysqli_query($mysqli, $sql_them);

    $sql_dangky = mysqli_query($mysqli, "INSERT INTO tbl_user(privilege,name,email,password, created_time) 
VALUE ('" . 1 . "','" . $username . "','" . $email . "','" . $password . "','" . time() . "')");
}
