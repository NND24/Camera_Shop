<?php
session_start();
include('../../admin/config/config.php');

$answerContent = $_POST['answerContent'];
$answerContent = trim($answerContent);
$reviewId = $_POST['reviewId'];
$idAdmin = $_POST['idAdmin'];
$answer_date = time();

$sql_update = "UPDATE `tbl_reviews` SET `id_admin`='$idAdmin',`answer_review`='$answerContent',`answer_date`='$answer_date' WHERE id_review = '$reviewId'";
$query_update = mysqli_query($mysqli, $sql_update);
