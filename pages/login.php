<?php include('../js/link.php');
include('../admin/config/config.php'); ?>

<div class="wrapper login">
    <form action="" method="POST" autocomplete="off" class="form" id="form-2">
        <div class="close-login-modal">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <h3 class="heading">Đăng nhập</h3>

        <div class="spacer"></div>

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <div class="form-input">
                <input id="email" name="email" type="text" placeholder="Nhập email" class="form-control">
                <div class="error-icon email-error"><i class="fa-solid fa-exclamation"></i></i></div>
                <div class="valid-icon email-valid"><i class="fa-regular fa-circle-check"></i></div>
            </div>
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Mật khẩu</label>
            <div class="form-input">
                <input id="password" name="password" type="password" placeholder="Nhập mật khẩu" class="form-control">
                <div class="error-icon password-error"><i class="fa-solid fa-exclamation"></i></i></div>
                <div class="valid-icon password-valid"><i class="fa-regular fa-circle-check"></i></div>
            </div>
            <span class="form-message"></span>
        </div>

        <button class="form-submit" id="form-login-submit">Đăng nhập</button>
        <span>Nếu bạn chưa có tài khoản! <span class="register-btn">Đăng ký</span></span>
    </form>
    <div class="modal-background"></div>
</div>

<script>
    $(document).ready(() => {
        $('#form-login-submit').click((e) => {
            e.preventDefault();
            var email = $('#email').val();
            var password = $('#password').val();

            $.ajax({
                url: " pages/handleEvent/handleLogin.php",
                data: {
                    email: email,
                    password: password,
                },
                dataType: 'json',
                method: "post",
                cache: true,
                success: function(data) {
                    console.log(data)
                    if (data.existAccount == 0) {
                        swal("Email hoặc mật khẩu không đúng",
                            "Vui lòng nhập lại hoặc đăng ký tài khoản",
                            "error");
                        $('#email').css("border-color", "#f33a58");
                        $('.email-error').css("display", "block");

                        $('#password').css("border-color", "#f33a58");
                        $('.password-error').css("display", "block");
                    } else if (data.existAccount == 1) {
                        swal("OK!", "Đăng nhập thành công", "success");
                        $('#password').css("border-color", "#008000ab");
                        $('.password-error').css("display", "none");
                        $('.password-valid').css("display", "block");
                        $('#email').css("border-color", "#008000ab");
                        $('.email-error').css("display", "none");
                        $('.email-valid').css("display", "block");
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    }
                },
            })
        })
    })
</script>