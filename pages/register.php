<div class="wrapper register">
    <div class="close-login"><i class="fa-solid fa-xmark"></i></div>
    <form class="form" id="form-1">
        <div class="close-register-modal">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <h3 class="heading col-12">Đăng ký thành viên</h3>

        <div class="spacer"></div>

        <div class="form-group col-lg-12 col-sm-12 col-md-12">
            <label for="name" class="form-label">Tên đăng nhập</label>
            <div class="form-input">
                <input id="name" name="name" type="text" placeholder="VD: Nguyễn Văn A" class="form-control">
                <div class="error-icon name-error"><i class="fa-solid fa-exclamation"></i></i></div>
                <div class="valid-icon name-valid"><i class="fa-regular fa-circle-check"></i></div>
            </div>
            <span class="form-message name-error-message"></span>
        </div>

        <div class="form-group col-lg-12 col-sm-12 col-md-6">
            <label for="email" class="form-label">Email</label>
            <div class="form-input">
                <input id="email" name="email" type="email" placeholder="VD: email@domain.com" class="form-control">
                <div class="error-icon email-error"><i class="fa-solid fa-exclamation"></i></i></div>
                <div class="valid-icon email-valid"><i class="fa-regular fa-circle-check"></i></div>
            </div>
            <span class="form-message email-error-message"></span>
        </div>

        <div class="form-group col-lg-6 col-sm-12 col-md-6" style="padding-right:20px;">
            <label for="password" class="form-label">Mật khẩu</label>
            <div class="form-input">
                <input id="password" name="password" type="password" placeholder="Nhập mật khẩu" class="form-control">
                <div class="error-icon password-error"><i class="fa-solid fa-exclamation"></i></i></div>
                <div class="valid-icon password-valid"><i class="fa-regular fa-circle-check"></i></div>
            </div>
            <span class="form-message password-error-message"></span>
        </div>

        <div class="form-group col-lg-6 col-sm-12 col-md-6">
            <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
            <div class="form-input">
                <input id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu" type="password" class="form-control">
                <div class="error-icon password_confirmation-error"><i class="fa-solid fa-exclamation"></i></i></div>
                <div class="valid-icon password_confirmation-valid"><i class="fa-regular fa-circle-check"></i></div>
            </div>
            <span class="form-message password_confirmation-error-message"></span>
        </div>

        <button id="form-register-submit" class="form-submit">Đăng ký</button>
        <span>Nếu bạn đã có tài khoản! <a class="login-btn">Đăng nhập</a></span>
    </form>
    <div class="modal-background"></div>
</div class="wrapper">

<script>
    $(document).ready(() => {
        const validateEmail = (email) => {
            return email.match(
                /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            );
        };

        $('#form-register-submit').click((e) => {
            e.preventDefault();
            var name = $('#name').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var passwordConfirmation = $('#password_confirmation').val();
            /** VALIDATE START **/
            let errors = {
                nameError: '',
                emailError: '',
                passwordError: '',
                passwordConfirmationError: '',
            }

            // Validate name
            if (name.length === 0) {
                errors.nameError = "Không được để trống tên!";
                $('#name').css("border-color", "#f33a58");
                $('.name-error').css("display", "block");
                $('.name-valid').css("display", "none");
                $('.name-error-message').text(errors.nameError);
            } else if (name.length <= 2) {
                errors.nameError = "Tên phải lớn hơn 2 ký tự!";
                $('#name').css("border-color", "#f33a58");
                $('.name-error').css("display", "block");
                $('.name-valid').css("display", "none");
                $('.name-error-message').text(errors.nameError);
            } else if (name.length >= 100) {
                errors.nameError = "Tên phải nhỏ hơn 100 ký tự!";
                $('#name').css("border-color", "#f33a58");
                $('.name-error').css("display", "block");
                $('.name-valid').css("display", "none");
                $('.name-error-message').text(errors.nameError);
            } else {
                errors.nameError = '';
                $('#name').css("border-color", "#008000ab");
                $('.name-error').css("display", "none");
                $('.name-valid').css("display", "block");
                $('.name-error-message').text('');
            }

            // Validate email
            if (email.length === 0) {
                errors.emailError = "Không được để trống email!";
                $('#email').css("border-color", "#f33a58");
                $('.email-error').css("display", "block");
                $('.email-valid').css("display", "none");
                $('.email-error-message').text(errors.emailError);
            } else if (!validateEmail(email)) {
                errors.emailError = "Email không hợp lệ!";
                $('#email').css("border-color", "#f33a58");
                $('.email-error').css("display", "block");
                $('.email-valid').css("display", "none");
                $('.email-error-message').text(errors.emailError);
            } else {
                errors.emailError = '';
                $('#email').css("border-color", "#008000ab");
                $('.email-error').css("display", "none");
                $('.email-valid').css("display", "block");
                $('.email-error-message').text('');
            }

            // Validate password
            if (password.length === 0) {
                errors.passwordError = "Không được để trống mật khẩu!";
                $('#password').css("border-color", "#f33a58");
                $('.password-error').css("display", "block");
                $('.password-valid').css("display", "none");
                $('.password-error-message').text(errors.passwordError);
            } else if (password.length <= 6) {
                errors.passwordError = "Mật khẩu phải nhiều hơn 6 ký tự!";
                $('#password').css("border-color", "#f33a58");
                $('.password-error').css("display", "block");
                $('.password-valid').css("display", "none");
                $('.password-error-message').text(errors.passwordError);
            } else {
                errors.passwordError = '';
                $('#password').css("border-color", "#008000ab");
                $('.password-error').css("display", "none");
                $('.password-valid').css("display", "block");
                $('.password-error-message').text('');
            }

            // Validate password confirm
            if (passwordConfirmation.length === 0) {
                errors.passwordConfirmation = "Không được để trống nhập lại mật khẩu!";
                $('#password_confirmation').css("border-color", "#f33a58");
                $('.password_confirmation-error').css("display", "block");
                $('.password_confirmation-valid').css("display", "none");
                $('.password_confirmation-error-message').text(errors.passwordConfirmation);
            } else if (passwordConfirmation != password) {
                errors.passwordConfirmation = "Không trùng khớp với mật khẩu!";
                $('#password_confirmation').css("border-color", "#f33a58");
                $('.password_confirmation-error').css("display", "block");
                $('.password_confirmation-valid').css("display", "none");
                $('.password_confirmation-error-message').text(errors.passwordConfirmation);
            } else if (passwordConfirmation.length <= 6) {
                errors.passwordConfirmation = "Mật khẩu phải nhiều hơn 6 ký tự!";
                $('#password_confirmation').css("border-color", "#f33a58");
                $('.password_confirmation-error').css("display", "block");
                $('.password_confirmation-valid').css("display", "none");
                $('.password_confirmation-error-message').text(errors.passwordConfirmation);
            } else {
                errors.passwordConfirmation = '';
                $('#password_confirmation').css("border-color", "#008000ab");
                $('.password_confirmation-error').css("display", "none");
                $('.password_confirmation-valid').css("display", "block");
                $('.password_confirmation-error-message').text('');
            }

            /** VALIDATE END **/

            /** SEND DATA **/
            if (errors.nameError == '' && errors.emailError == '' && errors
                .passwordError == '' && errors.passwordConfirmation == '') {
                $.ajax({
                    url: "pages/handleEvent/handleRegister.php",
                    data: {
                        name: name,
                        email: email,
                        password: password,
                    },
                    dataType: 'json',
                    method: "post",
                    cache: true,
                    success: function(data) {
                        if (data.existEmail === 1) {
                            swal("Tài khoản đã tồn tại", "Vui đăng nhập hoặc lòng nhập lại",
                                "error");
                            $('#name').val('')
                            $('#email').val('')
                            $('#password').val('')
                            $('#password_confirmation').val('')

                            $('#name').css("border-color", "gray");
                            $('#email').css("border-color", "gray");
                            $('#password').css("border-color", "gray");
                            $('#password_confirmation').css("border-color", "gray");

                            $('.name-valid').css("display", "none");
                            $('.email-valid').css("display", "none");
                            $('.password-valid').css("display", "none");
                            $('.password_confirmation-valid').css("display", "none");
                        } else if (data.existEmail == 0) {
                            swal("OK!", "Đăng ký thành công", "success");
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