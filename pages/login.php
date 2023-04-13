<?php include('../js/link.php');
include('../admin/config/config.php'); ?>

<div class="wrapper login">
    <form autocomplete="off" class="form" id="form-2">
        <div class="close-login-modal">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <h3 class="heading">Đăng nhập</h3>

        <div class="spacer"></div>

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <div class="form-input">
                <input id="email" type="text" placeholder="Nhập email" class="form-control">
                <div class="error-icon email-error"><i class="fa-solid fa-exclamation"></i></i></div>
                <div class="valid-icon email-valid"><i class="fa-regular fa-circle-check"></i></div>
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Mật khẩu</label>
            <div class="form-input">
                <input id="password" type="password" placeholder="Nhập mật khẩu" class="form-control" required>
                <div class="error-icon password-error"><i class="fa-solid fa-exclamation"></i></i></div>
                <div class="valid-icon password-valid"><i class="fa-regular fa-circle-check"></i></div>
            </div>
        </div>

        <div class="form-group">
            <div class="form-checkbox">
                <input id="show-password" type="checkbox">
                <label for="show-password">Hiển thị mật khẩu</label>
                <a class="change-password">Quên mật khẩu?</a>
            </div>
        </div>

        <button class="form-submit" id="form-login-submit">Đăng nhập</button>
        <span>Nếu bạn chưa có tài khoản! <span class="register-btn">Đăng ký</span></span>
    </form>
    <div class="modal-background"></div>
</div>

<script>
$(document).ready(() => {
    $(document).on("click", '#show-password', function() {
        var passwordInput = $('#password');
        var showPassword = $('#show-password');
        if (showPassword.prop('checked')) {
            passwordInput.attr('type', 'text');
        } else {
            passwordInput.attr('type', 'password');
        }
    });

    $(document).on("click", '.change-password', function() {
        $("#view__login").load("pages/quen-mat-khau.php");
    })


    $(document).on("click", '#form-login-submit', function(e) {
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