<?php
include('../../../../admin/config/config.php');

if (isset($_GET['idmember'])) {
    $id = $_GET['idmember'];
    $sql_admin = "SELECT * FROM tbl_admin WHERE id_admin= '" . $id . "'";
    $query_admin = mysqli_query($mysqli, $sql_admin);
    $row_admin = mysqli_fetch_array($query_admin);

    $sql_delete_user = "DELETE FROM tbl_user WHERE email = '" . $row_admin['email'] . "'";
    mysqli_query($mysqli, $sql_delete_user);

    $sql_xoa = "DELETE FROM tbl_admin WHERE id_admin = '" . $id . "'";
    mysqli_query($mysqli, $sql_xoa);
} else if (isset($_GET['action'])) {
    $sql_delete_all = "TRUNCATE TABLE tbl_admin ";
    mysqli_query($mysqli, $sql_delete_all);

    $sql = "SELECT * FROM tbl_admin";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($query);

    $sql_delete_all_user = "DELETE FROM tbl_user WHERE email = '" . $row['email'] . "'";
    mysqli_query($mysqli, $sql_delete_all_user);
}
