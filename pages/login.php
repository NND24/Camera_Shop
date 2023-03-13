<?php
session_start();
if (isset($_POST['dangnhap'])) {
    $email = $_POST['email'];
    $matkhau = $_POST['password'];
    $sql = "SELECT * FROM tbl_dangky WHERE email='" . $email . "' AND matkhau='" . $matkhau . "' LIMIT 1 ";
    $sql_query = mysqli_query($mysqli, $sql);
    $count = mysqli_num_rows($sql_query);
    if ($count > 0) {
        $data = mysqli_fetch_array($sql_query);
        $_SESSION['dangnhap'] = $data['tenkhachhang'];
        $_SESSION['id_khachhang'] = $data['id_dangky'];
        header('Location: index.php');
    } else {
        echo '<p style="color:red;">Mật khẩu hoặc email sai, vui lòng nhập lại</p>';
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
    <?php include('../js/link.php');
    include('../admin/config/config.php'); ?>
</head>

<body>
    <div class="wrapper">
        <div class="close-login"><i class="fa-solid fa-xmark"></i></div>
        <form action="" method="POST" autocomplete="off" class="form" id="form-2">
            <h3 class="heading">Đăng nhập</h3>

            <div class="spacer"></div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" name="email" type="text" placeholder="" class="form-control">
                <span class="form-message"></span>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Mật khẩu</label>
                <input id="password" name="password" type="password" placeholder="Nhập mật khẩu" class="form-control">
                <span class="form-message"></span>
            </div>

            <button class="form-submit" name="dangnhap" type="submit">Đăng nhập</button>
            <span>Nếu bạn chưa có tài khoản <div class="register-btn">Đăng ký</div></span>
        </form>
    </div>
</body>

</html>