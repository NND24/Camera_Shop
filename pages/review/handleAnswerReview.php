<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

$answerContent = $_POST['answerContent'];
$reviewId = $_POST['reviewId'];
$answer_date = time();

$sql_update = "UPDATE `tbl_reviews` SET `id_admin`='$_SESSION[id_user]',`answer_review`='$answerContent',`answer_date`='$answer_date' WHERE id_review = '$reviewId'";
$query_update = mysqli_query($mysqli, $sql_update);