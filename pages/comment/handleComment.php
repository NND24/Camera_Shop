<?php
session_start();
include('../../admin/config/config.php');
echo json_encode($_POST);

$idProduct = $_POST['idProduct'];
$idUser = $_SESSION['id_user'];
$comment = $_POST['comment'];

$sql_comment = "INSERT INTO tbl_comments(id_sanpham, id_user, comment, comment_date) VALUE(
    '" . $idProduct . "','" . $idUser . "','" . $comment . "','" . time() . "'
)";
$query_comment = mysqli_query($mysqli, $sql_comment);
