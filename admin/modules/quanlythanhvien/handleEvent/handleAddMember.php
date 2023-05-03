<?php
include('../../../../admin/config/config.php');

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


    $sql_admin = "SELECT * FROM tbl_admin WHERE email='" . $email . "' ";
    $query_admin = mysqli_query($mysqli, $sql_admin);
    $row_admin = mysqli_fetch_array($query_admin);

    if ($duty == 0) {
        mysqli_query($mysqli, "INSERT INTO tbl_privilege(id_admin,list_category,add_category,delete_category,delete_all_category,detail_category,edit_category,list_product,add_product,delete_product,delete_all_product,detail_product,edit_product,list_order,delete_order,delete_all_order,detail_order,list_member,add_member,delete_member,delete_all_member,detail_member,edit_member) 
        VALUE ('" . $row_admin['id_admin'] . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "')");
    } else {
        mysqli_query($mysqli, "INSERT INTO tbl_privilege(id_admin,list_category,add_category,delete_category,delete_all_category,detail_category,edit_category,list_product,add_product,delete_product,delete_all_product,detail_product,edit_product,list_order,delete_order,delete_all_order,detail_order,list_member,add_member,delete_member,delete_all_member,detail_member,edit_member) 
        VALUE ('" . $row_admin['id_admin'] . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 1 . "','" . 0 . "','" . 0 . "','" . 0 . "','" . 0 . "','" . 0 . "','" . 0 . "','" . 0 . "','" . 0 . "','" . 0 . "','" . 0 . "')");
    }
}
