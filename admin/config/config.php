<?php
// Create connection
// $mysqli = new mysqli("sql.freedb.tech", "freedb_gpm_camera", "wk94?FQWZh@r4V$", "freedb_camera_shop");
//$mysqli = new mysqli("bfeypcz1fjmygmftanga-mysql.services.clever-cloud.com", "uh3hcv7axncms5dw", "uRex3aqqWjBy06YDASKf", "bfeypcz1fjmygmftanga");
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
