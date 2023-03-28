<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
$id_review = $_POST['idReview'];

$sql_xoa = "DELETE FROM tbl_reviews WHERE id_review ='" . $id_review . "'";
mysqli_query($mysqli, $sql_xoa);
