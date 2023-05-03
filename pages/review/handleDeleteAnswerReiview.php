<?php
session_start();
include('../../admin/config/config.php');

$answerContent = '';
$reviewId = $_POST['idReview'];

$sql_update = "UPDATE `tbl_reviews` SET `id_admin`='0',`answer_review`='$answerContent' WHERE id_review = '$reviewId'";
$query_update = mysqli_query($mysqli, $sql_update);
