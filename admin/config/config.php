<?php
// Create connection
// $mysqli = new mysqli("sql.freedb.tech", "freedb_gpm_camera", "wk94?FQWZh@r4V$", "freedb_camera_shop");
//$mysqli = new mysqli("localhost", "nuldhpme_camera_shop", "0935013553", "nuldhpme_camera_shop");
//$mysqli = new mysqli("localhost", "root", "", "camera_shop");

$servername = "localhost";
$database = "camera_shop";
$username = "root";
$password = "";

// Create connection

$mysqli = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
