<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
$sql = "SELECT * FROM tbl_admin WHERE id_admin='" . $_SESSION['dangnhap'] . "' LIMIT 1";
$query = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_array($query);
?>
<div id="member__add-model">
    <div class="model__container member__model-container">
        <form>
            <div class="model__add-new">
                <h3>Quản lý tài khoản</h3>
                <div class="close-modal">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="model__content">
                    <label class="col-2">Tên: </label>
                    <input type="text" readonly value="<?php echo $row['username'] ?>" class="username">
                </div>
                <div class="model__content">
                    <label class="col-2">email: </label>
                    <input type="text" readonly value="<?php echo $row['email'] ?>" class="email">
                </div>
                <div class="model__content">
                    <label class="col-2">Chức vụ: </label>
                    <select class="duty">
                        <?php
                        if ($row['duty'] == 1) {
                        ?>
                        <option value="1">Nhân viên</option>
                        <?php } else { ?>
                        <option value="0">Quản lý</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="model__content">
                    <label class="col-2">Mật khẩu hiện tại: </label>
                    <input type="password" class="current-password">
                </div>
                <div class="model__content">
                    <label class="col-2">Mật khẩu mới: </label>
                    <input type="password" class="password">
                </div>
                <div class="model__content">
                    <label class="col-2">Nhập lại mật khẩu: </label>
                    <input type="password" class="password_confirmation">
                </div>
                <button id="suamatkhau">Đổi mật khẩu</button>
            </div>
        </form>
        <div class="modal__background"></div>
    </div>
</div>

<script>
$(document).ready(() => {
    // Handle add new category
    $(document).on("click", '#suamatkhau', function(e) {
        e.preventDefault();
        var currentPassword = $('.current-password').val();
        var password = $('.password').val();
        var password_confirmation = $('.password_confirmation').val();

        var pageIndexMainMember = 1
        // View data
        function view_data() {
            $.post('modules/quanlythanhvien/handleEvent/listmemberData.php?pageIndex=' +
                pageIndexMainMember,
                function(
                    data) {
                    $('#load_member_data').html(data)
                })
        }

        /** VALIDATE START **/
        let errors = {
            currentPasswordError: '',
            passwordError: '',
            passwordConfirmationError: '',
        }

        // Validate current password
        if (currentPassword.length === 0) {
            errors.currentPasswordError = "Không được để trống hiện mật khẩu hiện tại!";
            $('.current-password').css("border-color", "#f33a58");
            swal("Vui lòng nhập lại", errors.currentPasswordError, "error");
        } else if (currentPassword != <?php echo $row['password'] ?>) {
            errors.currentPasswordError = "Mật khẩu hiện tại sai";
            $('.current-password').css("border-color", "#f33a58");
            swal("Vui lòng nhập lại", errors.currentPasswordError, "error");
        } else {
            errors.currentPasswordError = '';
            $('.current-password').css("border-color", "#008000ab");
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
        if (errors.currentPasswordError == '' && errors.passwordError == '' && errors
            .passwordConfirmationError == '') {
            $.ajax({
                url: "modules/quanlytaikhoan/handleEvent/handleEditAccount.php",
                data: {
                    password: password,
                },
                dataType: 'json',
                method: "post",
                cache: true,
                success: function(data) {
                    swal("OK!", "Đổi mật khẩu thành công", "success");
                    view_data()
                },
                error: function() {
                    swal("OK!", "Đổi mật khẩu thành công", "success");
                    view_data()
                }
            })
        }

    })
})
</script>