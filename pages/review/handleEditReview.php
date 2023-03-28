<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

$rating = $_POST['starCount'];
$description = $_POST['reviewContent'];
$review_date = time();

$sql_update = "UPDATE `tbl_reviews` SET `rating`='$rating',`description`='$description',`review_date`='$review_date' WHERE id_review = '$_POST[idReview]'";
$query_update = mysqli_query($mysqli, $sql_update);