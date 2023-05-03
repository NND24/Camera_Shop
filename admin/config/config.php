<?php
// Create connection
$mysqli = new mysqli("localhost", "id20562858_gpmcamera", "E$/eM/1KHb{b?D23", "id20562858_camera_shop");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
