<?php
include('../../admin/config/config.php');
$id_review = $_POST['idReview'];

$sql_xoa = "DELETE FROM tbl_reviews WHERE id_review ='" . $id_review . "'";
mysqli_query($mysqli, $sql_xoa);
