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

<body class="container">
    <div class="container">
        <div class="main" id="main">
            <?php
            include('pages/header.php');
            ?>
            <div class="cart_wrapper">
                <div class="row">
                    <div class="col-md-8 cart">
                        <?php
                        if (isset($_SESSION['id_user']) && mysqli_num_rows($query_cart) > 0) {
                            $sql_cart = "SELECT * FROM tbl_cart, tbl_sanpham WHERE tbl_cart.id_sanpham=tbl_sanpham.id_sanpham AND id_user='$_SESSION[id_user])'";
                            $query_cart = mysqli_query($mysqli, $sql_cart);
                            if (mysqli_num_rows($query_cart) > 0) {
                                $sosp = 0;
                                $tongtien = 0;
                        ?>
                        <div class="cart__content">

                            <div class="cart__title">
                                <div class="row">
                                    <div class="col-8">
                                        <h4><b>GIỎ HÀNG</b></h4>
                                    </div>
                                    <div class=" col-4  text-right text-muted  d-flex"
                                        style="justify-content: flex-end;">
                                        <div class="product-count"><?php echo $sosp ?></div> sản phẩm
                                    </div>
                                </div>
                            </div>

                            <div class="row__title row">
                                <div class="col-4 justify-content-center d-flex">SẢN PHẨM</div>
                                <div class="col justify-content-center  hide-on-mobile-425">GIÁ</div>
                                <div class="col-sm-3 col-lg-2-4-sm justify-content-left d-flex quantity">SỐ LƯỢNG</div>
                                <div class="col justify-content-center sum">TỔNG</div>
                            </div>

                            <div id="load__cart-product"></div>

                        </div>
                        <?php
                            } else { ?>
                        <div class="d-flex justify-content-center align-items-center flex-column" style="height:100%;">
                            <span class="mb-4" style="font-size:25px;">HIỆN TẠI GIỎ HÀNG TRỐNG</span>
                            <a class="back-to-shop-btn">
                                <span class="text-muted">QUAY TRỞ LẠI MUA HÀNG</span>
                            </a>
                        </div>
                        <?php } ?>
                        <?php
                        } else { ?>
                        <div class="d-flex justify-content-center align-items-center flex-column" style="height:100%;">
                            <span class="mb-4" style="font-size:25px;">HIỆN TẠI GIỎ HÀNG TRỐNG</span>
                            <a class="back-to-shop-btn">
                                <span class="text-muted">QUAY TRỞ LẠI MUA HÀNG</span>
                            </a>
                        </div>
                        <?php } ?>
                    </div>


                    <div class="col-md-4 summary border-bottom">
                        <div class=" pb-3">
                            <h5><b>TÓM TẮT ĐƠN HÀNG</b></h5>
                        </div>
                        <?php if (isset($_SESSION['id_user'])) { ?>
                        <p class=" pb-2">Chi phí đơn hàng = Giá trị đơn hàng + phí vận chuyển + Thuế</p>
                        <div class="d-flex justify-content-between pb-2">
                            <p>Giá trị đơn hàng</p>
                            <p class="order-value">0đ</p>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <p>Phí vận chuyển</p>
                            <p>0đ</p>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <p>Thuế</p>
                            <p>0đ</p>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <p>Tổng Chi Phí </p>
                            <p class="order-value" style="font-weight:500;font-size:18px;">
                                0đ</p>
                        </div>
                        <div class="pay-product">
                            <?php
                                if (isset($_SESSION['id_user']) && mysqli_num_rows($query_cart) > 0) {
                                ?>
                            <div class="pay-product-btn">THANH
                                TOÁN</div>
                            <?php } ?>
                        </div>
                        <?php } else { ?>
                        <p class=" pb-2">Chi phí đơn hàng = Giá trị đơn hàng + phí vận chuyển + Thuế</p>
                        <div class="d-flex justify-content-between pb-2">
                            <p>Giá trị đơn hàng</p>
                            <p>0đ</p>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <p>Phí vận chuyển</p>
                            <p>0đ</p>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <p>Thuế</p>
                            <p>0đ</p>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <p>Tổng Chi Phí </p>
                            <p style="font-weight:500;font-size:18px;">0đ</p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include('pages/footer.php');
        ?>
    </div>
    <script>
    $(document).ready(() => {
        var cartCount = 0;
        var pageIndexCart = 1;
        view_data()

        function view_data() {
            $.ajax({
                url: "pages/Cart/handleCartData.php",
                dataType: 'json',
                method: "post",
                cache: true,
                success: function(data) {
                    cartCount = data.cartCount;
                    $('.product-count').html(data.sosp);
                    $('.order-value').html(`${data.tongtien}\u0111`)
                    $('.cart_count span').html(data.sosp)
                    view_cart();
                },
                error: function(data) {
                    cartCount = data.cartCount;
                    $('.product-count').html('0')
                    $('.order-value').html('0đ')
                    $('.cart').html(`
                    <div class="d-flex justify-content-center align-items-center flex-column" style="height:100%;">
                            <span class="mb-4" style="font-size:25px;">HIỆN TẠI GIỎ HÀNG TRỐNG</span>
                            <a class="back-to-shop-btn">
                                <span class="text-muted">QUAY TRỞ LẠI MUA HÀNG</span>
                            </a>
                        </div>
                    `)
                }
            })
        }

        // View data
        function view_cart() {
            $.post('pages/Cart/listCart.php?pageIndex=' + pageIndexCart +
                '&cartCount=' +
                cartCount,
                function(data) {
                    $('#load__cart-product').html(data)
                })
        }

        $(document).on("click", '.page-link.cart', function() {
            pageIndexCart = $(this).attr("value");
            $.ajax({
                url: 'pages/Cart/listCart.php?pageIndex=' +
                    pageIndexCart + '&cartCount=' +
                    cartCount,
                data: {
                    pageIndex: pageIndexCart,
                },
                dataType: 'html',
                method: "post",
                cache: true,
                success: function(data) {
                    $('#load__cart-product').html(data)
                },
                error: function() {
                    $('#load__cart-product').html(data)
                }
            })
        })

        $(document).on("click", '.cart__delete-btn', function() {
            var idProduct = $(this).attr("value");
            $.ajax({
                url: "pages/Cart/handleDeleteCart.php?xoa=1",
                data: {
                    id_sanpham: idProduct,
                },
                dataType: 'json',
                method: "post",
                cache: true,
                success: function() {
                    view_cart();
                    view_data()
                },
                error: function() {
                    view_cart();
                    view_data()
                }
            })
        })

        $(document).on("click", '.delete-all-cart-btn', function() {
            swal({
                    title: "Bạn có chắc muốn xóa toàn bộ giỏ hàng không?",
                    text: "Nếu có toàn bộ giỏ hàng sẽ bị xóa đi!",
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: "Thoát",
                            value: null,
                            visible: true,
                            closeModal: true,
                        },
                        confirm: {
                            text: "Chấp nhận",
                            value: true,
                            visible: true,
                            closeModal: true
                        }
                    },
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Giỏ hàng đã bị xóa!", {
                            icon: "success",
                        });
                        $.ajax({
                            url: "pages/Cart/handleDeleteCart.php?action=deleteAll",
                            dataType: 'json',
                            method: "post",
                            cache: true,
                            success: function() {
                                view_cart();
                                view_data()
                                window.location.reload();
                                $(window).scrollTop(0);
                            },
                            error: function() {
                                view_cart();
                                view_data()
                                window.location.reload();
                                $(window).scrollTop(0);
                            }
                        })
                    }
                });

        })

        $(document).on("click", '.plus-quantity-btn', function() {
            view_data();
            var idProduct = $(this).attr('value');
            $.ajax({
                url: "pages/Cart/handlePlusQuantity.php",
                data: {
                    id_sanpham: idProduct,
                },
                dataType: 'json',
                method: "post",
                cache: true,
                success: function(data) {
                    if (data.hethang == 1) {
                        swal("Sản phẩm đã hết hàng",
                            "Vui lòng chọn mua sản phẩm khác!",
                            "error");
                    }
                    view_cart();
                    view_data();
                },
                error: function(data) {
                    view_cart();
                    view_data()
                }
            })
        })

        $(document).on("click", '.minus-quantity-btn', function() {
            var idProduct = $(this).attr('value');
            $.ajax({
                url: "pages/Cart/handleMinusQuantity.php",
                data: {
                    id_sanpham: idProduct,
                },
                dataType: 'json',
                method: "post",
                cache: true,
                success: function(data) {
                    view_cart();
                    view_data()
                },
                error: function(data) {
                    view_cart();
                    view_data()
                }
            })
        })

        $(document).on("click", '.back-to-shop-btn', function() {
            var url = "trang-chu.php";
            window.history.pushState("new", "title", url);
            $(".container").load("trang-chu.php");
            $(window).scrollTop(0);
        })

        // View product detail
        $(document).on("click", '.view__product-detail', function() {
            var id = $(this).attr("value");
            var url = "san-pham.php?id=" + id;
            window.history.pushState("new", "title", url);
            $(".container").load("san-pham.php?id=" + id);
            $(window).scrollTop(0);
            window.location.reload();
        })

        $(document).on("click", '.pay-product-btn', function() {
            var url = "thanh-toan.php";
            window.history.pushState("new", "title", url);
            $(".container").load("thanh-toan.php");
            window.location.reload();
            $(window).scrollTop(0);
        })
    })
    </script>
</body>

</html>