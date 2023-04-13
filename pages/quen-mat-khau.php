<?php include('../js/link.php');
include('../admin/config/config.php'); ?>

<div class="wrapper login">
    <form autocomplete="off" class="form" id="form-2">
        <div class="close-login-modal">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <h3 class="heading">Quên mật khẩu</h3>

        <div class="spacer"></div>

        <div class="form-group">
            <label for="email-user" class="form-label">Email</label>
            <div class="form-input">
                <input id="email-user" type="text" placeholder="Nhập email" class="form-control">
                <div class="error-icon email-error"><i class="fa-solid fa-exclamation"></i></i></div>
                <div class="valid-icon email-valid"><i class="fa-regular fa-circle-check"></i></div>
            </div>
        </div>

        <div class="form-group">
            <label for="password-user" class="form-label">Mật khẩu mới</label>
            <div class="form-input">
                <input id="password-user" type="password" placeholder="Mật khẩu mới" class="form-control" required>
                <div class="error-icon password-error"><i class="fa-solid fa-exclamation"></i></i></div>
                <div class="valid-icon password-valid"><i class="fa-regular fa-circle-check"></i></div>
            </div>
        </div>

        <div class="form-group">
            <label for="confirm-password-user" class="form-label">Nhập lại mật khẩu</label>
            <div class="form-input">
                <input id="confirm-password-user" type="password" placeholder="Nhập lại mật khẩu" class="form-control"
                    required>
                <div class="error-icon password-error"><i class="fa-solid fa-exclamation"></i></i></div>
                <div class="valid-icon password-valid"><i class="fa-regular fa-circle-check"></i></div>
            </div>
        </div>

        <button class="form-submit" id="form-change-submit">Xác nhận</button>
    </form>
    <div class="modal-background"></div>
</div>

<script>
$(document).ready(() => {
    $(document).on("click", '#form-change-submit', function(e) {
        e.preventDefault();
        var email = $('#email-user').val();
        var password = $('#password-user').val();
        var password_confirmation = $('#confirm-password-user').val();

        /** VALIDATE START **/
        let errors = {
            emailError: '',
            passwordError: '',
            passwordConfirmationError: '',
        }

        // Validate current password
        if (email.length === 0) {
            errors.emailError = "Không được để trống email!";
            $('#email-user').css("border-color", "#f33a58");
            swal("Vui lòng nhập lại", errors.emailError, "error");
        } else {
            errors.emailError = '';
            $('#email-user').css("border-color", "#008000ab");
        }

        // Validate password
        if (password.length === 0) {
            errors.passwordError = "Không được để trống mật khẩu!";
            $('#password-user').css("border-color", "#f33a58");
            swal("Vui lòng nhập lại", errors.passwordError, "error");
        }
        if (password.length <= 6) {
            errors.passwordError = "Mật khẩu phải nhiều hơn 6 ký tự!";
            $('#password-user').css("border-color", "#f33a58");
            swal("Vui lòng nhập lại", errors.passwordError, "error");
        } else {
            errors.passwordError = '';
            $('#password-user').css("border-color", "#008000ab");
        }

        // Validate password confirm
        if (password_confirmation.length === 0) {
            errors.passwordConfirmationError = "Không được để trống nhập lại mật khẩu!";
            $('#confirm-password-user').css("border-color", "#f33a58");
            swal("Vui lòng nhập lại", errors.passwordConfirmationError, "error");
        } else if (password_confirmation != password) {
            errors.passwordConfirmationError = "Không trùng khớp với mật khẩu!";
            $('#confirm-password-user').css("border-color", "#f33a58");
            swal("Vui lòng nhập lại", errors.passwordConfirmationError, "error");
        } else if (password_confirmation.length <= 6) {
            errors.passwordConfirmationError = "Mật khẩu phải nhiều hơn 6 ký tự!";
            $('#confirm-password-user').css("border-color", "#f33a58");
            swal("Vui lòng nhập lại", errors.passwordConfirmationError, "error");
        } else {
            errors.passwordConfirmationError = '';
            $('#confirm-password-user').css("border-color", "#008000ab");
        }

        /** VALIDATE END **/

        if (errors.emailError == '' && errors.passwordError == '' && errors
            .passwordConfirmationError == '') {
            $.ajax({
                url: " pages/handleEvent/handleChangePassword.php",
                data: {
                    email: email,
                    password: password,
                },
                dataType: 'json',
                method: "post",
                cache: true,
                success: function(data) {
                    if (data.existAccount == 0) {
                        swal("Email không tồn tại",
                            "Vui lòng nhập lại email",
                            "error");
                        $('#email').css("border-color", "#f33a58");
                        $('.email-error').css("display", "block");
                        $('#password').css("border-color", "#f33a58");
                        $('.password-error').css("display", "block");
                    } else if (data.existAccount == 1) {
                        swal("OK!", "Đổi mật khẩu thành công", "success");
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
        }
    })
})
</script>