<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPM Camera</title>
    <?php include('./js/link.php');
    include('admin/config/config.php'); ?>
</head>

<body>
    <div class="container">
        <div class="main" id="main">
            <div id="load__address-modal"></div>
            <?php
            include('pages/header.php');
            ?>
            <!-- Breadcrumb -->
            <div class="breadcrumb breadcrumb-shop">
                <div class="breadcrumb-wrapper">
                    <div class="view__home"><span>Trang chủ </span></div>
                    »
                    <span class="breadcrumb_last">Trang cá nhân</span>
                </div>
            </div>

            <div class="row profile_wrapper">
                <div class="col-lg-3 col-md-3 col profile__sidebar">
                    <div class="profile__avatar">
                        <i class="fa-solid fa-user"></i>
                        <span><?php echo $_SESSION['login'] ?></span>
                    </div>
                    <button class="user-detail">Thông tin chi tiết</button>

                    <?php
                    $sql_address = "SELECT * FROM tbl_user WHERE id_user='$_SESSION[id_user]' LIMIT 1 ";
                    $query_address = mysqli_query($mysqli, $sql_address);
                    $row_address = mysqli_fetch_array($query_address);

                    $sql_province = "SELECT * FROM province WHERE province_id='$row_address[province_id]' LIMIT 1 ";
                    $query_province = mysqli_query($mysqli, $sql_province);
                    $row_province = mysqli_fetch_array($query_province);

                    $sql_district = "SELECT * FROM district WHERE district_id='$row_address[district_id]' LIMIT 1 ";
                    $query_district = mysqli_query($mysqli, $sql_district);
                    $row_district = mysqli_fetch_array($query_district);

                    $sql_wards = "SELECT * FROM wards WHERE wards_id='$row_address[wards_id]' LIMIT 1 ";
                    $query_wards = mysqli_query($mysqli, $sql_wards);
                    $row_wards = mysqli_fetch_array($query_wards);
                    ?>
                    <?php if (strlen($row_address['tendathang']) && strlen($row_address['phonenumber']) && $row_address['province_id'] != 0 && $row_address['district_id'] != 0 && $row_address['wards_id'] != 0) { ?>
                        <button class="change-address-btn" style="color: #000;border-radius: 0px;">Đổi thông tin</button>
                    <?php } else { ?>
                        <button class="add-address-btn" style="color: #000;border-radius: 0px;">Thêm thông tin</button>
                    <?php } ?>

                    <button class="change-password">Đổi mật khẩu</button>
                </div>
                <?php
                $sql_user = "SELECT * FROM tbl_user WHERE id_user='$_SESSION[id_user]'";
                $query_user = mysqli_query($mysqli, $sql_user);
                $row_user = mysqli_fetch_array($query_user);
                ?>
                <div class="col-lg-9 col-md-9 col profile__content">

                </div>
            </div>
            <?php
            include('pages/footer.php');
            ?>
        </div>
    </div>
    <script>
        $(document).ready(() => {
            // Lay du lieu thon tin kh
            view_data();

            function view_data() {
                $.post('pages/profile/userDetail.php',
                    function(data) {
                        $('.profile__content').html(data)
                    })
            }

            // Quay lai trang chu
            $(document).on("click", '.view__home', function() {
                var url = "index.php";
                window.history.pushState("new", "title", url);
                $(".container").load("index.php");
                $(window).scrollTop(0);
            })

            // Vao trang doi mat khau
            $(document).on("click", '.change-password', function(e) {
                e.preventDefault()
                $.ajax({
                    url: "pages/profile/changePasswordPage.php",
                    dataType: 'html',
                    method: "post",
                    cache: true,
                    success: function(data) {
                        $('.profile__content').empty();
                        $('.profile__content').html(data)
                    }
                })
            })

            // Vao trang thong tin chi tiet
            $(document).on("click", '.user-detail', function(e) {
                e.preventDefault()
                $.ajax({
                    url: "pages/profile/userDetail.php",
                    dataType: 'html',
                    method: "post",
                    cache: true,
                    success: function(data) {
                        view_data()
                    }
                })
            })

            // Xu ly sua mat khau
            $(document).on("click", '.suamatkhau', function(e) {
                e.preventDefault();
                var currentPassword = $('.current-password').val();
                var password = $('.password').val();
                var password_confirmation = $('.password_confirmation').val();

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
                } else if (currentPassword != <?php echo $row_user['password'] ?>) {
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
                        url: "pages/profile/handleEvent/handleChangePass.php",
                        data: {
                            password: password,
                        },
                        dataType: 'json',
                        method: "post",
                        cache: true,
                        success: function(data) {
                            swal("OK!", "Đổi mật khẩu thành công", "success");
                        },
                        error: function() {
                            swal("OK!", "Đổi mật khẩu thành công", "success");
                        }
                    })
                }

            })

            $(document).on("click", '.add-address-btn', function() {
                $('#load__address-modal').load('pages/checkout/addressModal.php')
            })

            $(document).on("click", '.change-address-btn', function() {
                $('#load__address-modal').load('pages/checkout/editAddressModal.php')
            })

            $(document).on("click", '.address__modal-background', function() {
                $('.address__modal-container').remove()
            })

            $(document).on("click", '.close-add-address-modal', function() {
                $('.address__modal-container').remove()
            })

            const validatePhoneNumber = (phoneNumber) => {
                var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
                if (vnf_regex.test(phoneNumber) == false) {
                    return false;
                } else {
                    return true;
                }
            }
            $(document).on("click", '.confirm-address-btn', function() {
                var name = $('.name').val();
                var phonenumber = $('.phonenumber').val();
                var province = $('#province').val();
                var district = $('#district').val();
                var wards = $('#wards').val();
                var addressDetail = $('.address-input').val();

                let errors = {
                    nameError: '',
                    phoneNumberError: '',
                    provinceError: '',
                    districtError: '',
                    wardsError: '',
                }

                if (name.length === 0) {
                    errors.nameError = "Không được để trống họ và tên!";
                    $('.name-form').css("border-color", "#f33a58");
                    swal("Vui lòng nhập lại họ và tên", errors.nameError,
                        "error");
                } else {
                    errors.nameError = '';
                    $('.name-form').css("border-color", "#008000ab");
                    $('.name-error-message').text(errors.nameError);
                }

                if (phonenumber.length === 0) {
                    errors.phoneNumberError = "Không được để trống số điện thoại!";
                    $('.phonenumber-form').css("border-color", "#f33a58");
                    swal("Vui lòng nhập lại số điện thoại", errors.phoneNumberError,
                        "error");
                } else if (validatePhoneNumber(phonenumber) == false) {
                    errors.phoneNumberError =
                        "Số điện thoại không hợp lệ!";
                    $('.phonenumber-form').css("border-color", "#f33a58");
                    swal("Vui lòng nhập lại số điện thoại", errors.phoneNumberError,
                        "error");
                } else {
                    errors.phoneNumberError = '';
                    $('.phonenumber-form').css("border-color", "#008000ab");
                    $('.phonenumber-error-message').text(errors.phoneNumberError);
                }

                if (province.length === 0) {
                    errors.provinceError = "Không được để trống!";
                    $('.address-form').css("border-color", "#f33a58");
                    swal("Vui lòng chọn tỉnh/thành phố", errors.provinceError,
                        "error");
                } else {
                    errors.provinceError = '';
                    $('.address-form').css("border-color", "#008000ab");
                    $('.address-error-message').text(errors.provinceError);
                }

                if (district.length === 0) {
                    errors.districtError = "Không được để trống!";
                    $('.address-form').css("border-color", "#f33a58");
                    swal("Vui lòng chọn quận/huyện", errors.districtError,
                        "error");
                } else {
                    errors.districtError = '';
                    $('.address-form').css("border-color", "#008000ab");
                    $('.address-error-message').text(errors.districtError);
                }

                if (wards.length === 0) {
                    errors.wardsError = "Không được để trống!";
                    $('.address-form').css("border-color", "#f33a58");
                    swal("Vui lòng chọn xã/phường", errors.wardsError,
                        "error");
                } else {
                    errors.wardsError = '';
                    $('.address-form').css("border-color", "#008000ab");
                    $('.address-error-message').text(errors.wardsError);
                }

                if (errors.nameError == '' && errors.phoneNumberError == '' && errors.provinceError == '' &&
                    errors.districtError == '' && errors.wardsError == '') {
                    $.ajax({
                        url: "pages/checkout/handleUserAddress.php",
                        data: {
                            name: name,
                            phonenumber: phonenumber,
                            province: province,
                            district: district,
                            wards: wards,
                            addressDetail: addressDetail,
                        },
                        dataType: 'json',
                        method: "post",
                        cache: true,
                        success: function(data) {
                            swal("OK!", "Thêm thông tin thành công", "success");
                            view_data()
                        },
                        error: function() {
                            swal("OK!", "Thêm thông tin thành công", "success");
                            view_data()
                        }
                    })
                }
            })

            $(document).on("click", '.edit-address-btn', function() {
                var name = $('.name').val();
                var phonenumber = $('.phonenumber').val();
                var province = $('#province').val();
                var district = $('#district').val();
                var wards = $('#wards').val();
                var addressDetail = $('.address-input').val();

                let errors = {
                    nameError: '',
                    phoneNumberError: '',
                    provinceError: '',
                    districtError: '',
                    wardsError: '',
                }

                if (name.length === 0) {
                    errors.nameError = "Không được để trống họ và tên!";
                    $('.name-form').css("border-color", "#f33a58");
                    swal("Vui lòng nhập lại họ và tên", errors.nameError,
                        "error");
                } else {
                    errors.nameError = '';
                    $('.name-form').css("border-color", "#008000ab");
                    $('.name-error-message').text(errors.nameError);
                }

                if (phonenumber.length === 0) {
                    errors.phoneNumberError = "Không được để trống số điện thoại!";
                    $('.phonenumber-form').css("border-color", "#f33a58");
                    swal("Vui lòng nhập lại số điện thoại", errors.phoneNumberError,
                        "error");
                } else if (validatePhoneNumber(phonenumber) == false) {
                    errors.phoneNumberError =
                        "Số điện thoại không hợp lệ!";
                    $('.phonenumber-form').css("border-color", "#f33a58");
                    swal("Vui lòng nhập lại số điện thoại", errors.phoneNumberError,
                        "error");
                } else {
                    errors.phoneNumberError = '';
                    $('.phonenumber-form').css("border-color", "#008000ab");
                    $('.phonenumber-error-message').text(errors.phoneNumberError);
                }

                if (province.length === 0) {
                    errors.provinceError = "Không được để trống!";
                    $('.address-form').css("border-color", "#f33a58");
                    swal("Vui lòng chọn tỉnh/thành phố", errors.provinceError,
                        "error");
                } else {
                    errors.provinceError = '';
                    $('.address-form').css("border-color", "#008000ab");
                    $('.address-error-message').text(errors.provinceError);
                }

                if (district.length === 0) {
                    errors.districtError = "Không được để trống!";
                    $('.address-form').css("border-color", "#f33a58");
                    swal("Vui lòng chọn quận/huyện", errors.districtError,
                        "error");
                } else {
                    errors.districtError = '';
                    $('.address-form').css("border-color", "#008000ab");
                    $('.address-error-message').text(errors.districtError);
                }

                if (wards.length === 0) {
                    errors.wardsError = "Không được để trống!";
                    $('.address-form').css("border-color", "#f33a58");
                    swal("Vui lòng chọn xã/phường", errors.wardsError,
                        "error");
                } else {
                    errors.wardsError = '';
                    $('.address-form').css("border-color", "#008000ab");
                    $('.address-error-message').text(errors.wardsError);
                }

                if (errors.nameError == '' && errors.phoneNumberError == '' && errors.provinceError == '' &&
                    errors.districtError == '' && errors.wardsError == '') {
                    $.ajax({
                        url: "pages/checkout/handleUserAddress.php",
                        data: {
                            name: name,
                            phonenumber: phonenumber,
                            province: province,
                            district: district,
                            wards: wards,
                            addressDetail: addressDetail,
                        },
                        dataType: 'json',
                        method: "post",
                        cache: true,
                        success: function(data) {
                            swal("OK!", "Sửa thông tin thành công", "success");
                            view_data()
                        },
                        error: function() {
                            swal("OK!", "Sửa thông tin thành công", "success");
                            view_data()
                        }
                    })
                }
            })
        })
    </script>
</body>

</html>