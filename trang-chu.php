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
        <?php
        include('pages/header.php');
        ?>
        <div class="main" id="main">
            <?php
            // Query category
            $sql_danhmuc = "SELECT * FROM tbl_danhmuc WHERE category_status=1 ORDER BY id_danhmuc ASC LIMIT 9 ";
            $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
            ?>
            <div id="home">
                <div class="content">

                    <!-- Ads slide -->
                    <section class="section box__slide_home">
                        <div class="section_content">
                            <div class="row ">
                                <div class="col-lg-3 col-md-4 hide-on-mobile">
                                    <ul class="home__menu">
                                        <?php
                                        while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
                                        ?>
                                        <li>
                                            <button class="category__product-btn"
                                                value="<?php echo $row_danhmuc['id_danhmuc'] ?>">
                                                <i class="fa-solid fa-chevron-right"></i>
                                                <?php echo $row_danhmuc['ten_danhmuc'] ?>
                                            </button>
                                        </li>

                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="col-lg-9 col-md-8 col-12">
                                    <div class="slide_ads">
                                        <!-- Swiper -->
                                        <div class="swiper mySwiper">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <img src="images/ads/ads2.jpg" alt="">
                                                </div>
                                                <div class="swiper-slide">
                                                    <img src="images/ads/ads2.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="swiper-button-next"></div>
                                            <div class="swiper-button-prev"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Banner -->
                    <section class="section box__banner">
                        <div class="section_content">
                            <div class="freeship_banner">
                                <div class="row">
                                    <div class="col-12">
                                        <img src="images/banner/freeship-banner.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Promotional Products -->
                    <section class="section box__promotion box__product">
                        <div class="section_content row">
                            <div class="col col-lg-12 col-md-12 col-12">
                                <div class="container__header">
                                    <h2 class="container__header-title">Sản Phẩm Khuyến Mãi</h2>
                                    <div class="countdown-time">
                                        <p>Chương trình kết thúc</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col col-lg-12 col-md-12 col-12">
                                <div class="row no-wrap product--container">
                                    <?php
                                    $sql_product_discount = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.soluong>0 AND trangthaisp=1 AND giamgia > 0 ORDER BY giamgia DESC LIMIT 10";
                                    $query_product_discount = mysqli_query($mysqli, $sql_product_discount);
                                    while ($row_product_discount = mysqli_fetch_array($query_product_discount)) {
                                    ?>
                                    <div class="col col-lg-2-4 col-md-3 col-6 mb-10">
                                        <div class="row__item item--product">
                                            <div class="row__item-container">
                                                <?php if ($row_product_discount['giamgia'] > 0) { ?>
                                                <div class="discount-banner">
                                                    Giảm <?php echo $row_product_discount['giamgia'] ?>%
                                                </div>
                                                <?php } ?>
                                                <div class="row__item-display br-5">
                                                    <div class="view__product-detail"
                                                        value="<?php echo $row_product_discount['id_sanpham'] ?>">
                                                        <div class="row__item-img"
                                                            style="background: url('./admin/modules/quanlysp/handleEvent/uploads/<?php echo $row_product_discount['hinhanh'] ?>') no-repeat center center / cover">
                                                        </div>
                                                    </div>
                                                    <?php if (isset($_SESSION['id_user'])) { ?>
                                                    <button class="add-to-cart-btn"
                                                        value="<?php echo $row_product_discount['id_sanpham'] ?>">
                                                        <i class="fa-solid fa-cart-plus"></i>
                                                        <span>Thêm vào giỏ hàng</span>
                                                    </button>
                                                    <?php } else { ?>
                                                    <button class="add-to-cart-btn-not-login"
                                                        value="<?php echo $row_product_discount['id_sanpham'] ?>">
                                                        <i class="fa-solid fa-cart-plus"></i>
                                                        <span>Thêm vào giỏ hàng</span>
                                                    </button>
                                                    <?php } ?>
                                                </div>
                                                <div class="row__item-info">
                                                    <div class="view__product-detail"
                                                        value="<?php echo $row_product_discount['id_sanpham'] ?>">
                                                        <div class="row__info-name">
                                                            <span
                                                                style="cursor:pointer;"><?php echo $row_product_discount['tensanpham'] ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="price__wrapper">
                                                        <?php
                                                            if ($row_product_discount['giamgia'] > 0) {
                                                            ?>
                                                        <span
                                                            class="price-discount"><?php echo number_format($row_product_discount['giasp'] - ($row_product_discount['giasp'] * $row_product_discount['giamgia']) / 100, 0, ',', '.') ?>đ</span>
                                                        <span
                                                            class="price-normal-discount"><?php echo number_format($row_product_discount['giasp'], 0, ',', '.') ?>đ</span>
                                                        <?php
                                                            } else {
                                                            ?>
                                                        <span
                                                            class="price-normal"><?php echo number_format($row_product_discount['giasp'], 0, ',', '.') ?>đ</span>
                                                        <?php
                                                            }
                                                            ?>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                    </section>

                    <!--  Products Sold -->
                    <section class="section box__product">
                        <div class="section_content row">
                            <div class="col col-lg-12 col-md-12 col-12">
                                <div class="container__header">
                                    <h2 class="container__header-title">Sản Phẩm Bán Chạy</h2>
                                </div>
                            </div>
                            <div class="col col-lg-12 col-md-12 col-12">
                                <div class="row no-wrap product--container">
                                    <?php
                                    $sql_product_sold = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.soluong>0 AND trangthaisp=1 ORDER BY daban ASC LIMIT 10";
                                    $query_product_sold = mysqli_query($mysqli, $sql_product_sold);
                                    while ($row_product_sold = mysqli_fetch_array($query_product_sold)) {
                                    ?>
                                    <div class="col col-lg-2-4 col-md-3 col-6 mb-10">
                                        <div class="row__item item--product">
                                            <div class="row__item-container">
                                                <?php if ($row_product_sold['giamgia'] > 0) { ?>
                                                <div class="discount-banner">
                                                    Giảm <?php echo $row_product_sold['giamgia'] ?>%
                                                </div>
                                                <?php } ?>
                                                <div class="row__item-display br-5">
                                                    <div class="view__product-detail"
                                                        value="<?php echo $row_product_sold['id_sanpham'] ?>">
                                                        <div class="row__item-img"
                                                            style="background: url('./admin/modules/quanlysp/handleEvent/uploads/<?php echo $row_product_sold['hinhanh'] ?>') no-repeat center center / cover">
                                                        </div>
                                                    </div>
                                                    <?php if (isset($_SESSION['id_user'])) { ?>
                                                    <button class="add-to-cart-btn"
                                                        value="<?php echo $row_product_sold['id_sanpham'] ?>">
                                                        <i class="fa-solid fa-cart-plus"></i>
                                                        <span>Thêm vào giỏ hàng</span>
                                                    </button>
                                                    <?php } else { ?>
                                                    <button class="add-to-cart-btn-not-login"
                                                        value="<?php echo $row_product_sold['id_sanpham'] ?>">
                                                        <i class="fa-solid fa-cart-plus"></i>
                                                        <span>Thêm vào giỏ hàng</span>
                                                    </button>
                                                    <?php } ?>
                                                </div>
                                                <div class="row__item-info">
                                                    <div class="view__product-detail"
                                                        value="<?php echo $row_product_sold['id_sanpham'] ?>">
                                                        <div class="row__info-name">
                                                            <span
                                                                style="cursor:pointer;"><?php echo $row_product_sold['tensanpham'] ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="price__wrapper">
                                                        <?php
                                                            if ($row_product_sold['giamgia'] > 0) {
                                                            ?>
                                                        <span
                                                            class="price-discount"><?php echo number_format($row_product_sold['giasp'] - ($row_product_sold['giasp'] * $row_product_sold['giamgia']) / 100, 0, ',', '.') ?>đ</span>
                                                        <span
                                                            class="price-normal-discount"><?php echo number_format($row_product_sold['giasp'], 0, ',', '.') ?>đ</span>
                                                        <?php
                                                            } else {
                                                            ?>
                                                        <span
                                                            class="price-normal"><?php echo number_format($row_product_sold['giasp'], 0, ',', '.') ?>đ</span>
                                                        <?php
                                                            }
                                                            ?>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Normal  Products -->
                    <?php
                    $sql_category = "SELECT * FROM tbl_danhmuc WHERE category_status=1 ORDER BY id_danhmuc ASC LIMIT 10";
                    $query_category = mysqli_query($mysqli, $sql_category);
                    while ($row_category = mysqli_fetch_array($query_category)) {
                        $sql_product = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.soluong>0 AND trangthaisp=1 AND tbl_sanpham.id_danhmuc = tbl_danhmuc.id_danhmuc AND tbl_sanpham.id_danhmuc='$row_category[id_danhmuc]' ORDER BY daban ASC LIMIT 10";
                        $query_product = mysqli_query($mysqli, $sql_product);
                        if (mysqli_num_rows($query_product) > 0) {
                    ?>
                    <section class="section box__product">
                        <div class="section_content row">
                            <div class="col col-lg-12 col-md-12 col-12">
                                <div class="container__header">
                                    <h2 class="container__header-title"><?php echo $row_category['ten_danhmuc'] ?></h2>
                                    <div class="view-all">
                                        <div class="view__all-product-with-category"
                                            value="<?php echo $row_category['id_danhmuc'] ?>">Xem tất cả<i
                                                class="fa-solid fa-chevron-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-lg-12 col-md-12 col-12">
                                <div class="row no-wrap product--container">
                                    <?php

                                            while ($row_product = mysqli_fetch_array($query_product)) {
                                            ?>
                                    <div class="col col-lg-2-4 col-md-3 col-6 mb-10">
                                        <div class="row__item item--product">
                                            <div class="row__item-container">
                                                <?php if ($row_product['giamgia'] > 0) { ?>
                                                <div class="discount-banner">
                                                    Giảm <?php echo $row_product['giamgia'] ?>%
                                                </div>
                                                <?php } ?>
                                                <div class="row__item-display br-5">
                                                    <div class="view__product-detail"
                                                        value="<?php echo $row_product['id_sanpham'] ?>">
                                                        <div class="row__item-img"
                                                            style="background: url('./admin/modules/quanlysp/handleEvent/uploads/<?php echo $row_product['hinhanh'] ?>') no-repeat center center / cover">
                                                        </div>
                                                    </div>
                                                    <?php if (isset($_SESSION['id_user'])) { ?>
                                                    <button class="add-to-cart-btn"
                                                        value="<?php echo $row_product['id_sanpham'] ?>">
                                                        <i class="fa-solid fa-cart-plus"></i>
                                                        <span>Thêm vào giỏ hàng</span>
                                                    </button>
                                                    <?php } else { ?>
                                                    <button class="add-to-cart-btn-not-login"
                                                        value="<?php echo $row_product['id_sanpham'] ?>">
                                                        <i class="fa-solid fa-cart-plus"></i>
                                                        <span>Thêm vào giỏ hàng</span>
                                                    </button>
                                                    <?php } ?>
                                                </div>
                                                <div class="row__item-info">
                                                    <div class="view__product-detail"
                                                        value="<?php echo $row_product['id_sanpham'] ?>">
                                                        <div class="row__info-name">
                                                            <span
                                                                style="cursor:pointer;"><?php echo $row_product['tensanpham'] ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="price__wrapper">
                                                        <?php
                                                                    if ($row_product['giamgia'] > 0) {
                                                                    ?>
                                                        <span
                                                            class="price-discount"><?php echo number_format($row_product['giasp'] - ($row_product['giasp'] * $row_product['giamgia']) / 100, 0, ',', '.') ?>đ</span>
                                                        <span
                                                            class="price-normal-discount"><?php echo number_format($row_product['giasp'], 0, ',', '.') ?>đ</span>
                                                        <?php
                                                                    } else {
                                                                    ?>
                                                        <span
                                                            class="price-normal"><?php echo number_format($row_product['giasp'], 0, ',', '.') ?>đ</span>
                                                        <?php
                                                                    }
                                                                    ?>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                            }
                                            ?>
                                </div>
                            </div>
                        </div>
                    </section>
                    <?php
                        }
                        ?>
                    <?php
                    }
                    ?>
                </div>
            </div>

        </div>
        <?php
        include('pages/footer.php');
        ?>
    </div>

    <div class="loader-wrapper">
        <div id="loader">
            <div id="shadow"></div>
            <div id="box"></div>
        </div>
    </div>

    <!-- Swiper JS -->
    <script>
    $(document).ready(() => {
        // Hien thi silde anh
        var swiper = new Swiper(".mySwiper", {
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                dynamicBullets: true,
            },
        });

        // Hien thi trang san pham
        $(document).on("click", '.view__product-detail', function() {
            var idDetail = $(this).attr("value");
            var url = "san-pham.php?id=" + idDetail;
            window.history.pushState("new", "title", url);
            $(".container").load("san-pham.php?id=" + idDetail);
            $(window).scrollTop(0);
            window.location.reload();
        })

        // Hien thi san pham theo danh muc
        $(document).on("click", '.view__all-product-with-category', function() {
            var idAll = $(this).attr("value");
            var url = "danh-muc.php?id=" + idAll;
            window.history.pushState("new", "title", url);
            $(".container").load("danh-muc.php?id=" + idAll);
            $(window).scrollTop(0);
            window.location.reload();
        })

        // Set the date we're counting down to
        // var countDownDate = new Date("Jan 5, 2024 15:37:25").getTime();
        var countDownDate = new Date("Jun 1, 2023 00:00:00").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.querySelector(".countdown-time p").innerHTML = days + "d " + hours + "h " +
                minutes + "m " + seconds + "s ";

            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.querySelector(".countdown-time p").innerHTML = "Chương trình kết thúc";
            }
        }, 1000);
    })
    </script>
</body>

</html>