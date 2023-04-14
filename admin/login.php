<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <?php include('./js/link.php') ?>
</head>

<body>
    <div class="main" id="main">
        <div class="wrapper">
            <form autocomplete="off" class="form" id="form-2">
                <h3 class="heading">Đăng nhập</h3>

                <div class="spacer"></div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="text" placeholder="Nhập email" class="form-control">
                    <span class="form-message"></span>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input id="password" type="password" placeholder="Nhập mật khẩu" class="form-control">
                    <span class="form-message"></span>
                </div>

                <div class="form-group ">
                    <div class="confirm-password-wrapper">
                        <label for="confirm-password" class="form-label">Nhập lại mật khẩu</label>
                        <input id="confirm-password" type="password" placeholder="Nhập lại mật khẩu"
                            class="form-control">
                        <span class="form-message"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-checkbox">
                        <input id="show-password" type="checkbox">
                        <label for="show-password">Hiển thị mật khẩu</label>
                        <a class="change-password">Quên mật khẩu?</a>
                    </div>
                </div>

                <button class="form-submit login">Đăng nhập</button>
                <button class="form-submit forgot-password">Xác nhận</button>
            </form>

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
                    var heading = $('.heading');
                    var loginSubmit = $('.login');
                    var forgotSubmit = $('.forgot-password');
                    var formCheckbox = $('.form-checkbox');
                    var confirmPassword = $('.confirm-password');
                    var confirmPasswordWrapper = $('.confirm-password-wrapper');

                    heading.html('Đổi mật khẩu')
                    loginSubmit.css("display", "none");
                    forgotSubmit.css("display", "block");
                    formCheckbox.remove();
                    confirmPasswordWrapper.css("display", "block");

                })

                $(document).on("click", '.login', function(e) {
                    e.preventDefault();
                    var email = $('#email').val();
                    var password = $('#password').val();

                    $.ajax({
                        url: "modules/quanlytaikhoan/handleLogin.php?dangnhap=1",
                        data: {
                            email: email,
                            password: password,
                        },
                        dataType: 'json',
                        method: "post",
                        cache: true,
                        success: function(data) {
                            if (data.error == 1) {
                                swal("Vui lòng nhập lại",
                                    "Email hoặc mật khẩu không đúng",
                                    "error");
                                $('#email').val('')
                                $('#password').val('')
                            } else {
                                swal("OK!", "Đăng nhập thành công", "success");
                                const url = "dashboard.php";
                                window.history.pushState("new", "title", url);
                                $("#main").load("dashboard.php");
                            }
                        }
                    })
                })

                $(document).on("click", '.forgot-password', function(e) {
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
                                } else if (data.existAccount == 1) {
                                    swal("OK!", "Đổi mật khẩu thành công", "success");
                                    // setTimeout(function() {
                                    //     window.location.reload();
                                    // }, 1500);
                                }
                            },
                        })
                    }
                })
            })
            </script>
        </div>
    </div>
</body>

</html>