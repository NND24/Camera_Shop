<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
echo json_encode($_POST);

$idProduct = $_POST['idProduct'];
$idUser = $_SESSION['id_user'];
$starCount = $_POST['starCount'];
$reviewContent = $_POST['reviewContent'];

$sql_review = "INSERT INTO tbl_reviews(id_sanpham, id_user, rating, description, review_date) VALUE(
    '" . $idProduct . "','" . $idUser . "','" . $starCount . "','" . $reviewContent . "','" . time() . "'
)";
$query_review = mysqli_query($mysqli, $sql_review);
