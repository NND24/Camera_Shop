<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

if (isset($_SESSION['id_user'])) {

    $answerContent = $_POST['answerContent'];
    $answerContent = trim($answerContent);
    $commentId = $_POST['commentId'];
    $idAdmin = $_SESSION['id_user'];
    $answer_date = time();

    $sql_update = "UPDATE `tbl_comments` SET `id_admin`='$idAdmin',`answer_comment`='$answerContent',`answer_date`='$answer_date' WHERE id_comment = '$commentId'";
    $query_update = mysqli_query($mysqli, $sql_update);
}