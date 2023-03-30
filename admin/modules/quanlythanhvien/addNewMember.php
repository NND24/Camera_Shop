<div id="member__add-model">
    <div class="model__container">
        <form enctype="multipart/form-data">
            <div class="model__add-new">
                <h3>Thêm thành viên</h3>
                <div class="close-modal">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="model__content">
                    <label class="col-2">Tên: </label>
                    <input type="text" class="username">
                </div>
                <div class="model__content">
                    <label class="col-2">email: </label>
                    <input type="text" class="email">
                </div>
                <div class="model__content">
                    <label class="col-2">Chức vụ: </label>
                    <select class="duty">
                        <option value="1" selected>Nhân viên</option>
                        <option value="0">Quản lý</option>
                    </select>
                </div>
                <div class="model__content">
                    <label class="col-2">Mật khẩu: </label>
                    <input type="password" class="password">
                </div>
                <div class="model__content">
                    <label class="col-2">Nhập lại mật khẩu: </label>
                    <input type="password" class="password_confirmation">
                </div>
                <button id="themthanhvien">Thêm thành viên</button>
            </div>
        </form>
        <div class="modal__category-add-background"></div>
    </div>
</div>

<script>
    $(document).ready(() => {
        const validateEmail = (email) => {
            return email.match(
                /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            );
        };

        // Handle add new category
        $(document).on("click", '#themthanhvien', function(e) {
            e.preventDefault();
            var username = $('.username').val();
            var email = $('.email').val();
            var duty = $('.duty').val();
            var password = $('.password').val();
            var password_confirmation = $('.password_confirmation').val();

            var pageIndexMainMember = 1
            // View data
            function view_data() {
                $.post('http://localhost:3000/admin/modules/quanlythanhvien/handleEvent/listmemberData.php?pageIndex=' +
                    pageIndexMainMember,
                    function(
                        data) {
                        $('#load_member_data').html(data)
                    })
            }

            /** VALIDATE START **/
            let errors = {
                nameError: '',
                emailError: '',
                dutyError: '',
                passwordError: '',
                passwordConfirmationError: '',
            }

            // Validate name
            if (username.length === 0) {
                errors.nameError = "Không được để trống tên!";
                $('.name').css("border-color", "#f33a58");
                swal("Vui lòng nhập lại", errors.nameError, "error");
            } else if (username.length <= 2) {
                errors.nameError = "Tên phải lớn hơn 2 ký tự!";
                $('.name').css("border-color", "#f33a58");
                swal("Vui lòng nhập lại", errors.nameError, "error");
            } else {
                errors.nameError = '';
                $('#name').css("border-color", "#008000ab");
            }

            // Validate email
            if (email.length === 0) {
                errors.emailError = "Không được để trống email!";
                $('.email').css("border-color", "#f33a58");
                swal("Vui lòng nhập lại", errors.emailError, "error");
            } else if (!validateEmail(email)) {
                errors.emailError = "Email không hợp lệ!";
                $('.email').css("border-color", "#f33a58");
                swal("Vui lòng nhập lại", errors.emailError, "error");
            } else {
                errors.emailError = '';
                $('#email').css("border-color", "#008000ab");
            }

            // Validate duty
            if (duty.length === 0) {
                errors.dutyError =
                    "Không được để trống chức vụ!";
                $('.duty').css("border-color", "#f33a58");
                swal("Vui lòng nhập lại", errors.dutyError, "error");
            } else {
                errors.dutyErrorError = '';
                $('.duty').css("border-color", "#008000ab");
            }

            // Validate password
            if (password.length === 0) {
                errors.passwordError = "Không được để trống mật khẩu!";
                $('.password').css("border-color", "#f33a58");
                swal("Vui lòng nhập lại", errors.passwordError, "error");
            }
            if (password.length <= 6) {
                errors.passwordError = "Mật khẩu phải nhiều hơn 6 ký tự!";
                $('.password').css("border-color", "#f33a58");
                swal("Vui lòng nhập lại", errors.passwordError, "error");
            } else {
                errors.passwordError = '';
                $('.password').css("border-color", "#008000ab");
            }

            // Validate password confirm
            if (password_confirmation.length === 0) {
                errors.passwordConfirmationError = "Không được để trống nhập lại mật khẩu!";
                $('.password_confirmation').css("border-color", "#f33a58");
                swal("Vui lòng nhập lại", errors.passwordConfirmationError, "error");
            } else if (password_confirmation != password) {
                errors.passwordConfirmationError = "Không trùng khớp với mật khẩu!";
                $('.password_confirmation').css("border-color", "#f33a58");
                swal("Vui lòng nhập lại", errors.passwordConfirmationError, "error");
            } else if (password_confirmation.length <= 6) {
                errors.passwordConfirmationError = "Mật khẩu phải nhiều hơn 6 ký tự!";
                $('.password_confirmation').css("border-color", "#f33a58");
                swal("Vui lòng nhập lại", errors.passwordConfirmationError, "error");
            } else {
                errors.passwordConfirmationError = '';
                $('.password_confirmation').css("border-color", "#008000ab");
            }

            /** VALIDATE END **/

            /** SEND DATA **/
            if (errors.nameError == '' && errors.emailError == '' && errors.dutyError == '' && errors
                .passwordError == '' && errors.passwordConfirmationError == '') {
                $.ajax({
                    url: "http://localhost:3000/admin/modules/quanlythanhvien/handleEvent/handleAddMember.php",
                    data: {
                        username: username,
                        email: email,
                        duty: duty,
                        password: password,
                    },
                    dataType: 'json',
                    method: "post",
                    cache: true,
                    success: function(data) {
                        if (data.existName === 1) {
                            swal("Vui lòng nhập lại", 'Thành viên đã tồn tại', "error");
                            $('.email').val('')
                        } else {
                            $('.email').val('')
                            swal("OK!", "Thêm thành công", "success");
                            view_data();
                        }
                    }
                })
            }

        })
    })
</script>