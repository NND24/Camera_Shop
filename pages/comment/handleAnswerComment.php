<?php
session_start();
include('../../admin/config/config.php');


$answerContent = $_POST['answerContent'];
$answerContent = trim($answerContent);
$commentId = $_POST['commentId'];
$idAdmin = $_POST['idAdmin'];
$answer_date = time();

$sql_update = "UPDATE `tbl_comments` SET `id_admin`='$idAdmin',`answer_comment`='$answerContent',`answer_date`='$answer_date' WHERE id_comment = '$commentId'";
$query_update = mysqli_query($mysqli, $sql_update);
