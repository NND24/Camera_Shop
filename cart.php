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

                        if (isset($_SESSION['cart'])) {
                            $sosp = 0;
                            $tongtien = 0;
                            foreach ($_SESSION['cart'] as $cart_item) {
                                $sosp += $cart_item['soluong'];
                                $thanhtien = $cart_item['soluong'] * $cart_item['giasp'];
                                $tongtien += $thanhtien;
                            }
                        ?>
                        <div class="cart__content">

                            <div class="cart__title">
                                <div class="row">
                                    <div class="col-md-10 col-7">
                                        <h4><b>GIỎ HÀNG</b></h4>
                                    </div>
                                    <div class="col-md-2 col-5  text-right text-muted"><?php echo $sosp ?> sản phẩm
                                    </div>
                                </div>
                            </div>

                            <div class="row__title row">
                                <div class="col-4 justify-content-center d-flex">SẢN PHẨM</div>
                                <div class="col-2 justify-content-center d-flex">GIÁ</div>
                                <div class="col-3 justify-content-center d-flex quantity">SỐ LƯỢNG</div>
                                <div class="col justify-content-center sum">TỔNG</div>
                            </div>

                            <div id="load__cart-product"></div>

                            <div class="d-flex justify-content-between mb-3">
                                <div class="back-to-shop">
                                    <a class="back-to-shop-btn" href="index.php">
                                        <span class="text-muted">TIẾP TỤC MUA SẮM</span>
                                    </a>
                                </div>
                                <div class="pay-product">
                                    <a href="pages/main/thanhtoan.php"><span class="pay-product-text">THANH
                                            TOÁN</span></a>

                                </div>
                            </div>

                        </div>
                        <?php } else { ?>
                        <div class="d-flex justify-content-center align-items-center flex-column" style="height:100%;">
                            <span class="mb-4" style="font-size:25px;">HIỆN TẠI GIỎ HÀNG TRỐNG</span>
                            <a class="back-to-shop-btn" href="index.php">
                                <span class="text-muted">QUAY TRỞ LẠI MUA HÀNG</span>
                            </a>
                        </div>
                        <?php } ?>
                    </div>


                    <div class="col-md-4 summary border-bottom">
                        <div class=" pb-3">
                            <h5><b>TÓM TẮT ĐƠN HÀNG</b></h5>
                        </div>
                        <?php if (isset($_SESSION['cart'])) { ?>
                        <p class=" pb-2">Chi phí đơn hàng = Giá trị đơn hàng + phí vận chuyển + Thuế</p>
                        <div class="d-flex justify-content-between pb-2">
                            <p>Giá trị đơn hàng</p>
                            <p><?php echo number_format($tongtien, 0, ',', '.') ?>đ</p>
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
                            <p style="font-weight:500;font-size:18px;">
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
            $.post('http://localhost:3000/pages/handleCart/handleCartData.php',
                function(data) {
                    console.log(data);
                })
        }
        view_data()

        $(document).on("click", '.cart__delete-btn', function() {
            var idProduct = $(this).attr("value");
            console.log(idProduct)
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
                }
            })
        })

        $(document).on("click", '.plus-quantity-btn', function() {
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
                }
            })
        })
    })
    </script>
</body>

</html>