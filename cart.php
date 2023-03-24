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
            <div class="cart_wrapper">
                <div class="row">
                    <div class="col-md-8 cart">
                        <?php

                        if (isset($_SESSION['cart']) && isset($_SESSION['id_user'])) {
                            $sosp = 0;
                            $tongtien = 0;
                            foreach ($_SESSION['cart'] as $cart_item) {
                                if ($cart_item['idUser'] == $_SESSION['id_user']) {
                                    $sosp += $cart_item['soluong'];
                                    $thanhtien = $cart_item['soluong'] * $cart_item['giasp'];
                                    $tongtien += $thanhtien;
                                }
                            }
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
                    </div>


                    <div class="col-md-4 summary border-bottom">
                        <div class=" pb-3">
                            <h5><b>TÓM TẮT ĐƠN HÀNG</b></h5>
                        </div>
                        <?php if (isset($_SESSION['cart']) && isset($_SESSION['id_user'])) { ?>
                        <p class=" pb-2">Chi phí đơn hàng = Giá trị đơn hàng + phí vận chuyển + Thuế</p>
                        <div class="d-flex justify-content-between pb-2">
                            <p>Giá trị đơn hàng</p>
                            <p class="order-value"><?php echo number_format($tongtien, 0, ',', '.') ?>đ</p>
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
                                <?php echo number_format($tongtien, 0, ',', '.') ?>đ</p>
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
        // View data
        view_cart();

        function view_cart() {
            $.post('http://localhost:3000/pages/handleCart/listCart.php',
                function(data) {
                    $('#load__cart-product').html(data)
                })
        }

        function view_data() {
            $.ajax({
                url: "http://localhost:3000/pages/handleCart/handleCartData.php",
                dataType: 'json',
                method: "post",
                cache: true,
                success: function(data) {
                    $('.product-count').html(data.sosp);
                    $('.order-value').html(`${data.tongtien}\u0111`)
                    $('.cart_count span').html(data.sosp)
                },
                error: function(data) {
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
        view_data()

        $(document).on("click", '.cart__delete-btn', function() {
            var idProduct = $(this).attr("value");
            $.ajax({
                url: "http://localhost:3000/pages/handleCart/handleDeleteCart.php",
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

        $(document).on("click", '.plus-quantity-btn', function() {
            view_data();
            var idProduct = $(this).attr('value');
            console.log(idProduct)
            $.ajax({
                url: "http://localhost:3000/pages/handleCart/handlePlusQuantity.php",
                data: {
                    id_sanpham: idProduct,
                },
                dataType: 'json',
                method: "post",
                cache: true,
                success: function(data) {
                    view_cart();
                    view_data();
                }
            })
        })

        $(document).on("click", '.minus-quantity-btn', function() {
            var idProduct = $(this).attr('value');
            console.log(idProduct)
            $.ajax({
                url: "http://localhost:3000/pages/handleCart/handleMinusQuantity.php",
                data: {
                    id_sanpham: idProduct,
                },
                dataType: 'json',
                method: "post",
                cache: true,
                success: function(data) {
                    view_cart();
                    view_data()
                }
            })
        })

        $(document).on("click", '.back-to-shop-btn', function() {
            var url = "home.php";
            window.history.pushState("new", "title", url);
            $(".container").load("home.php");
            $(window).scrollTop(0);
        })

        // View product detail
        $(document).on("click", '.view__product-detail', function() {
            var id = $(this).attr("value");
            var url = "chitietsanpham.php?id=" + id;
            window.history.pushState("new", "title", url);
            $(".container").load("chitietsanpham.php?id=" + id);
            $(window).scrollTop(0);
            window.location.reload();
        })
    })
    </script>
</body>

</html>