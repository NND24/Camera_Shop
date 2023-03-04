<?php
session_start();
if (isset($_POST['dangky'])) {
    $tenkhachhang = $_POST['hovaten'];
    $email = $_POST['email'];
    $dienthoai = $_POST['dienthoai'];
    $matkhau = $_POST['password'];
    $diachi = $_POST['diachi'];
    $sql_dangky = mysqli_query($mysqli, "INSERT INTO tbl_dangky(tenkhachhang,email,diachi,matkhau,dienthoai) 
    VALUE ('" . $tenkhachhang . "','" . $email . "','" . $diachi . "','" . $matkhau . "','" . $dienthoai . "')");

    if ($sql_dangky) {
        $_SESSION['dangky'] = $tenkhachhang;
        $_SESSION['id_khachhang'] = mysqli_insert_id($mysqli);
        header('Location: index.php');
    }
}
?>

<link rel="stylesheet" href="css/login.css">
<div class="wrapper">
    <form action="" method="POST" class="form" id="form-1">
        <h3 class="heading">Đăng ký thành viên</h3>

        <div class="spacer"></div>

        <div class="form-group">
            <label for="hovaten" class="form-label">Tên đầy đủ</label>
            <input id="hovaten" name="hovaten" type="text" placeholder="VD: Đạt Nguyễn" class="form-control">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email" name="email" type="text" placeholder="VD: email@domain.com" class="form-control">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="dienthoai" class="form-label">Điện thoại</label>
            <input id="dienthoai" name="dienthoai" type="text" placeholder="VD: email@domain.com" class="form-control">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="diachi" class="form-label">Địa chỉ</label>
            <input id="diachi" name="diachi" type="text" placeholder="VD: email@domain.com" class="form-control">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Mật khẩu</label>
            <input id="password" name="password" type="password" placeholder="Nhập mật khẩu" class="form-control">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
            <input id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu"
                type="password" class="form-control">
            <span class="form-message"></span>
        </div>

        <button class="form-submit" name="dangky">Đăng ký</button>
        <span>Nếu bạn đã có tài khoản <a href="index.php?quanly=dangnhap">Đăng nhập</a></span>
    </form>
</div class="wrapper">