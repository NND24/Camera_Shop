<?php
session_start();
include('../../admin/config/config.php');

$idProduct = $_POST['idProduct'];
$idUser = $_SESSION['id_user'];
$starCount = $_POST['starCount'];
$reviewContent = $_POST['reviewContent'];

$sql_review = "INSERT INTO tbl_reviews(id_sanpham, id_user, rating, description, review_date) VALUE(
    '" . $idProduct . "','" . $idUser . "','" . $starCount . "','" . $reviewContent . "','" . time() . "'
)";
$query_review = mysqli_query($mysqli, $sql_review);

$sql_review = "SELECT * FROM tbl_reviews WHERE tbl_reviews.id_sanpham=$idProduct ";
$query_review = mysqli_query($mysqli, $sql_review);

$reviewCount = 0;
$reviewRating = 0;
$starAverage = 0;
while ($row_review = mysqli_fetch_array($query_review)) {
    $reviewCount++;
    $reviewRating += $row_review['rating'];
}
if ($reviewCount > 0) {
    $starAverage = round($reviewRating / $reviewCount, 2);
}
$sql_update = "UPDATE `tbl_sanpham` SET `average_rating`='$starAverage'  WHERE id_sanpham=$idProduct ";
$query_update = mysqli_query($mysqli, $sql_update);
