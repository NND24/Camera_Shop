<?php
// Create connection
$mysqli = new mysqli("sql.freedb.tech", "freedb_gpm_camera", "wk94?FQWZh@r4V$", "freedb_camera_shop");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
