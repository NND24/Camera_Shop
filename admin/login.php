<?php
session_start();
include('config/config.php');
if (isset($_POST['dangnhap'])) {
    $taikhoan = $_POST['username'];
    $matkhau = $_POST['password'];
    $sql = "SELECT * FROM tbl_admin WHERE username='" . $taikhoan . "' AND password='" . $matkhau . "' LIMIT 1 ";
    $sql_query = mysqli_query($mysqli, $sql);
    $count = mysqli_num_rows($sql_query);
    if ($count > 0) {
        $_SESSION['dangnhap'] = $taikhoan;
        header('Location: index.php');
    } else {
        echo '<script>alert("Tai khoa ko dung")</script>';
        header('Location: login.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Css -->
    <link rel="stylesheet" href="css/login.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body>
    <div class="wrapper">
        <form action="" method="POST" autocomplete="off" class="form" id="form-2">
            <h3 class="heading">Đăng nhập</h3>

            <div class="spacer"></div>

            <div class="form-group">
                <label for="username" class="form-label">Tên đăng nhập</label>
                <input id="username" name="username" type="text" placeholder="Nhập tên đăng nhập" class="form-control">
                <span class="form-message"></span>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Mật khẩu</label>
                <input id="password" name="password" type="password" placeholder="Nhập mật khẩu" class="form-control">
                <span class="form-message"></span>
            </div>

            <button class="form-submit" name="dangnhap" type="submit">Đăng nhập</button>
        </form>

        <script src=""></script>
    </div>
</body>

</html>