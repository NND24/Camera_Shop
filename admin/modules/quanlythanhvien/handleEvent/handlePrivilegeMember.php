<?php
include('../../../../admin/config/config.php');

$duty = $_POST['duty'];

$list_category = $_POST['list_category'];
$add_category = $_POST['add_category'];
$delete_category = $_POST['delete_category'];
$delete_all_category = $_POST['delete_all_category'];
$detail_category = $_POST['detail_category'];
$edit_category = $_POST['edit_category'];

$list_product = $_POST['list_product'];
$add_product = $_POST['add_product'];
$delete_product = $_POST['delete_product'];
$delete_all_product = $_POST['delete_all_product'];
$detail_product = $_POST['detail_product'];
$edit_product = $_POST['edit_product'];

$list_order = $_POST['list_order'];
$delete_order = $_POST['delete_order'];
$delete_all_order = $_POST['delete_all_order'];
$detail_order = $_POST['detail_order'];

$list_member = $_POST['list_member'];
$add_member = $_POST['add_member'];
$delete_member = $_POST['delete_member'];
$delete_all_member = $_POST['delete_all_member'];
$detail_member = $_POST['detail_member'];
$edit_member = $_POST['edit_member'];

$id_admin = $_POST['idmember'];


mysqli_query($mysqli, "UPDATE tbl_privilege SET list_category='" . $list_category . "',add_category='" . $add_category . "',delete_category='" . $delete_category . "',
    delete_all_category='" . $delete_all_category . "',detail_category='" . $detail_category . "',edit_category='" . $edit_category . "',list_product='" . $list_product . "',add_product='" . $add_product . "',delete_product='" . $delete_product . "',
    delete_all_product='" . $delete_all_product . "',detail_product='" . $detail_product . "',edit_product='" . $edit_product . "',list_order='" . $list_order . "',delete_order='" . $delete_order . "',
    delete_all_order='" . $delete_all_order . "',detail_order='" . $detail_order . "',list_member='" . $list_member . "',add_member='" . $add_member . "',delete_member='" . $delete_member . "',
    delete_all_member='" . $delete_all_member . "',detail_member='" . $detail_member . "',edit_member='" . $edit_member . "'  
    WHERE id_admin='$id_admin' ");
$sql_update = "UPDATE tbl_admin SET duty='" . $duty . "',last_updated='" . time() . "' WHERE id_admin='$id_admin' ";
mysqli_query($mysqli, $sql_update);
