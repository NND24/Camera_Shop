<?php
session_start();
?>
<link rel="stylesheet" href="css/cart.css">

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
                        <div class="col-md-2 col-5  text-right text-muted"><?php echo $sosp ?> sản phẩm</div>
                    </div>
                </div>

                <div class="row__title row">
                    <div class="col-4 justify-content-center d-flex">SẢN PHẨM</div>
                    <div class="col-2 justify-content-center d-flex">GIÁ</div>
                    <div class="col-3 justify-content-center d-flex quantity">SỐ LƯỢNG</div>
                    <div class="col justify-content-center sum">TỔNG</div>
                </div>
                <?php

                    foreach ($_SESSION['cart'] as $cart_item) {
                        $thanhtien = $cart_item['soluong'] * $cart_item['giasp'];
                    ?>
                <div class="row border-bottom">
                    <div class="row main align-items-center">
                        <div class="col-2"><img class="img-fluid"
                                src="./admin/modules/quanlysp/uploads/<?php echo $cart_item['hinhanh'] ?>"></div>

                        <div class="col">
                            <div class="row text-muted">Shirt</div>
                            <div class="row"><?php echo $cart_item['tensanpham'] ?></div>
                        </div>
                        <div class="col d-flex justify-content-between">
                            <?php echo number_format($cart_item['giasp'], 0, ',', '.') ?>đ
                        </div>
                        <div class="col">
                            <div class="quantity_button-wrapper">
                                <a href="pages/main/addToCart.php?tru=<?php echo $cart_item['id'] ?>"><input
                                        type="button" value="-" class="minus-quantity button-quantity"></a>
                                <input type="number" name="quantity" class="input-text" step="1" min="1"
                                    value="<?php echo $cart_item['soluong'] ?>" id="quantity" placeholder
                                    inputmode="numeric">
                                <a href="pages/main/addToCart.php?cong=<?php echo $cart_item['id'] ?>"><input
                                        type="button" value="+" class="plus-quantity button-quantity"></a>
                            </div>
                        </div>
                        <div class="col d-flex justify-content-between">
                            <?php echo number_format($thanhtien, 0, ',', '.')  ?>đ
                            <a href="pages/main/addToCart.php?xoa=<?php echo $cart_item['id'] ?>" class="close">
                                <i class="fa-solid fa-xmark"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="d-flex justify-content-between mb-3">
                    <div class="back-to-shop">
                        <a class="back-to-shop-btn" href="index.php">
                            <span class="text-muted">TIẾP TỤC MUA SẮM</span>
                        </a>
                    </div>
                    <div class="pay-product">
                        <a href="index.php?quanly=thanhtoan"><span class="pay-product-text">THANH TOÁN</span></a>

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
                <p style="font-weight:500;font-size:18px;"><?php echo number_format($tongtien, 0, ',', '.') ?>đ</p>
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