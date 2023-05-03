<?php
session_start();
include('../../admin/config/config.php');

$answerContent = '';
$commentId = $_POST['idComment'];

$sql_update = "UPDATE `tbl_comments` SET `id_admin`='0',`answer_comment`='$answerContent' WHERE id_comment = '$commentId'";
$query_update = mysqli_query($mysqli, $sql_update);
