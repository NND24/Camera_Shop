<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

$answerContent = $_POST['answerContent'];
$commentId = $_POST['commentId'];
$answer_date = time();

$sql_update = "UPDATE `tbl_comments` SET `id_admin`='$_SESSION[id_user]',`answer_comment`='$answerContent',`answer_date`='$answer_date' WHERE id_comment = '$commentId'";
$query_update = mysqli_query($mysqli, $sql_update);