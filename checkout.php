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
            <?php
            include('pages/header.php');
            ?>

            <div class=" address__container">
                <div class="address__header">
                    <span><i class="fa-solid fa-location-dot"></i>Địa chỉ nhận hàng</span>
                </div>
                <?php
                $sql_address = "SELECT * FROM tbl_user WHERE id_user='$_SESSION[id_user]' LIMIT 1 ";
                $query_address = mysqli_query($mysqli, $sql_address);
                $row_address = mysqli_fetch_array($query_address);
                ?>
                <div class="row address__wrapper">
                    <?php if (strlen($row_address['tendathang']) && strlen($row_address['sodienthoaidathang']) && strlen($row_address['address'])) { ?>
                    <div class="col-lg-3 name-and-phonenumber">
                        <p class="customer-name"><?php echo $row_address['tendathang'] ?></p>
                        <p class="customer-phonenumber"><?php echo $row_address['sodienthoaidathang'] ?></p>
                        </p>
                    </div>

                    <div class="col-lg-7 address">
                        <p><?php echo $row_address['address'] ?></p>
                        </p>
                    </div>

                    <div class="col-lg-2 change-address">
                        <button class="change-address-btn">Đổi địa chỉ</button>
                    </div>

                    <?php } else { ?>
                    <div class="col-lg-10">
                        <p>Chưa có địa chỉ</p>
                    </div>

                    <div class="col-lg-2 change-address">
                        <button class="add-address-btn">Thêm địa chỉ</button>
                    </div>
                    <?php } ?>
                    <div id="load__address-modal"></div>

                </div>
            </div>

            <div class="order__container">
                <div class="row order__header">
                    <span class="col-lg-6 col-md-6 col-6 order__header-title">Sản phẩm</span>
                    <span class="col-lg-2 col-md-2 col-2 order__header-text d-flex justify-content-end">Đơn
                        giá</span>
                    <span class="col-lg-2 col-md-2 col-2 order__header-text d-flex justify-content-end">Số
                        lượng</span>
                    <span class="col-lg-2 col-md-2 col-2 order__header-text d-flex justify-content-end">Thành
                        tiền</span>
                </div>

                <?php
                $sosp = 0;
                $tongtien = 0;
                foreach ($_SESSION['cart'] as $cart_item) {
                    if ($cart_item['idUser'] == $_SESSION['id_user']) {
                        $sosp += $cart_item['soluong'];
                        $thanhtien = $cart_item['soluong'] * $cart_item['giasp'];
                        $tongtien += $thanhtien;
                        @$sql_danhmuc = "SELECT * FROM tbl_danhmuc WHERE ten_danhmuc='$cart_item[tendanhmuc]' LIMIT 1";
                        $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
                        $row_danhmuc = mysqli_fetch_array($query_danhmuc)
                ?>
                <div class="row no-wrap border-bottom">
                    <div class="row  no-wrap order align-items-center justify-content-between order__wrapper">
                        <div class="col-lg-1 col-md-1 col-sm-2 col-2 order__img-product view__product-detail"
                            value="<?php echo $cart_item['id'] ?>"><img class="img-fluid"
                                src="./admin/modules/quanlysp/handleEvent/uploads/<?php echo $cart_item['hinhanh'] ?>">
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-5 col-4 ">
                            <div class="row text-muted order__name-category category__product-btn"
                                value="<?php echo $row_danhmuc['id_danhmuc'] ?>">
                                <?php echo $cart_item['tendanhmuc'] ?></div>
                            <div class="row order__name-product view__product-detail"
                                value="<?php echo $cart_item['id'] ?>">
                                <?php echo $cart_item['tensanpham'] ?></div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-3 justify-content-center order__price">
                            <?php echo number_format($cart_item['giasp'], 0, ',', '.') ?>đ</div>


                        <div class="col-lg-1 col-md-1 col-sm-1 col-1 order__price">
                            <div class="quantity-wrapper">

                                <span><?php echo $cart_item['soluong'] ?></span>

                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-2 d-flex justify-content-end order__price">
                            <?php echo number_format($thanhtien, 0, ',', '.')  ?>đ

                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php } ?>
            </div>

            <div class="payment__container">
                <!-- <div class="row payment__header">
                    <span class="col-lg-6">Phương thức thanh toán</span>
                    <span class="col-lg-4">Thanh toán khi nhận hàng</span>
                    <div class="col-lg-2 change-pay-method">
                        <button class="change-pay-method-btn">Thay đổi</button>
                    </div>
                </div> -->

                <div class="address__header">
                    <span>Thanh toán</span>
                </div>

                <div class="payment__content">
                    <div class="payment__content-wrapper">
                        <div class="d-flex justify-content-between pb-2">
                            <p>Tổng tiền hàng</p>
                            <p><?php echo number_format($tongtien, 0, ',', '.') ?>đ
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <p>Phí vận chuyển</p>
                            <p>0đ</p>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <p>Tổng thanh toán</p>
                            <p><?php echo number_format($tongtien, 0, ',', '.') ?>đ
                        </div>
                    </div>
                </div>

                <div class="row payment__footer">
                    <span class="col-10">Nhấn "Đặt hàng" đồng nghĩa với việc bạn đồng ý tuân theo Điều khoản
                    </span>
                    <button class="col-2 confirm-order-btn">Đặt hàng</button>
                </div>
            </div>
            <?php
            include('pages/footer.php');
            ?>
        </div>
    </div>
    <script>
    $(document).ready(() => {
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
            var address = $('.address-input').val();

            let errors = {
                nameError: '',
                phoneNumberError: '',
                addressError: '',
            }

            if (name.length === 0) {
                errors.nameError = "Không được để trống tên!";
                $('.name-form').css("border-color", "#f33a58");
                $('.name-error-message').text(errors.nameError);
            } else {
                errors.nameError = '';
                $('.name-form').css("border-color", "#008000ab");
                $('.name-error-message').text(errors.nameError);
            }

            if (phonenumber.length === 0) {
                errors.phoneNumberError = "Không được để trống số điện thoại!";
                $('.phonenumber-form').css("border-color", "#f33a58");
                $('.phonenumber-error-message').text(errors.phoneNumberError);
            } else if (validatePhoneNumber(phonenumber) == false) {
                errors.phoneNumberError =
                    "Số điện thoại không hợp lệ!";
                $('.phonenumber-form').css("border-color", "#f33a58");
                $('.phonenumber-error-message').text(errors.phoneNumberError);
            } else {
                errors.phoneNumberError = '';
                $('.phonenumber-form').css("border-color", "#008000ab");
                $('.phonenumber-error-message').text(errors.phoneNumberError);
            }

            if (address.length === 0) {
                errors.addressError = "Không được để trống!";
                $('.address-form').css("border-color", "#f33a58");
                $('.address-error-message').text(errors.addressError);
            } else {
                errors.addressError = '';
                $('.address-form').css("border-color", "#008000ab");
                $('.address-error-message').text(errors.addressError);
            }

            if (errors.nameError == '' && errors.phoneNumberError == '' && errors.addressError == '') {
                $.ajax({
                    url: "http://localhost:3000/pages/checkout/handleUserAddress.php",
                    data: {
                        name: name,
                        phonenumber: phonenumber,
                        address: address,
                    },
                    dataType: 'json',
                    method: "post",
                    cache: true,
                    success: function(data) {
                        swal("OK!", "Thêm thông tin thành công", "success");
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    },
                    error: function() {
                        swal("OK!", "Thêm thông tin thành công", "success");
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    }
                })
            }
        })

        $(document).on("click", '.edit-address-btn', function() {

            var name = $('.name').val();
            var phonenumber = $('.phonenumber').val();
            var address = $('.address-input').val();

            let errors = {
                nameError: '',
                phoneNumberError: '',
                addressError: '',
            }

            if (name.length === 0) {
                errors.nameError = "Không được để trống tên!";
                $('.name-form').css("border-color", "#f33a58");
                $('.name-error-message').text(errors.nameError);
            } else {
                errors.nameError = '';
                $('.name-form').css("border-color", "#008000ab");
                $('.name-error-message').text(errors.nameError);
            }

            if (phonenumber.length === 0) {
                errors.phoneNumberError = "Không được để trống số điện thoại!";
                $('.phonenumber-form').css("border-color", "#f33a58");
                $('.phonenumber-error-message').text(errors.phoneNumberError);
            } else if (validatePhoneNumber(phonenumber) == false) {
                errors.phoneNumberError =
                    "Số điện thoại không hợp lệ!";
                $('.phonenumber-form').css("border-color", "#f33a58");
                $('.phonenumber-error-message').text(errors.phoneNumberError);
            } else {
                errors.phoneNumberError = '';
                $('.phonenumber-form').css("border-color", "#008000ab");
                $('.phonenumber-error-message').text(errors.phoneNumberError);
            }

            if (address.length === 0) {
                errors.addressError = "Không được để trống!";
                $('.address-form').css("border-color", "#f33a58");
                $('.address-error-message').text(errors.addressError);
            } else {
                errors.addressError = '';
                $('.address-form').css("border-color", "#008000ab");
                $('.address-error-message').text(errors.addressError);
            }

            if (errors.nameError == '' && errors.phoneNumberError == '' && errors.addressError == '') {
                $.ajax({
                    url: "http://localhost:3000/pages/checkout/handleUserAddress.php",
                    data: {
                        name: name,
                        phonenumber: phonenumber,
                        address: address,
                    },
                    dataType: 'json',
                    method: "post",
                    cache: true,
                    success: function(data) {
                        swal("OK!", "Thêm thông tin thành công", "success");
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    },
                    error: function() {
                        swal("OK!", "Đổi thông tin thành công", "success");
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    }
                })
            }
        })

        $(document).on("click", '.confirm-order-btn', function() {
            let errors = {
                addressError: '',
            }

            // if (name.length === 0) {
            //     errors.addressError = "Vui lòng nhập địa chỉ!";
            //     swal("Chưa có địa chỉ", errors.addressError,
            //         "error");
            // } else {
            // }
            errors.addressError = '';
            if (errors.addressError == '') {
                $.ajax({
                    url: "http://localhost:3000/pages/checkout/handlePayment.php",
                    dataType: 'json',
                    method: "post",
                    cache: true,
                    success: function(data) {

                    },

                })
                swal("OK!", "Thanh toán thành công", "success");
                var url = "home.php";
                window.history.pushState("new", "title", url);
                $(".container").load("http://localhost:3000/home.php");
                $(window).scrollTop(0);
            }
        })
    })
    </script>
</body>

</html>