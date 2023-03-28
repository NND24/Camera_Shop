<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

$comment = $_POST['comment'];
$comment_date = time();

$sql_update = "UPDATE `tbl_comments` SET `comment`='$comment',`comment_date`='$comment_date' WHERE id_comment = '$_POST[idComment]'";
$query_update = mysqli_query($mysqli, $sql_update);
