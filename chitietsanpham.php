<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPM Camera</title>
    <?php include('./js/link.php');
    include('admin/config/config.php');
    $mysqli = new mysqli("localhost", "root", "", "camera_shop"); ?>
</head>

<body class="container">
    <div class="container">
        <div class="main" id="main">
            <?php
            session_start();
            include('pages/header.php');
            $sql_chitiet = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc 
    AND tbl_sanpham.id_sanpham='$_GET[id]' LIMIT 1 ";
            $query_chitiet = mysqli_query($mysqli, $sql_chitiet);
            $row_chitiet = mysqli_fetch_array($query_chitiet);
            $iddanhmuc = $row_chitiet['id_danhmuc'];
            ?>

            <!-- Breadcrumb -->
            <div class="breadcrumb">
                <div class="breadcrumb-wrapper">
                    <div class="view__home"><span>Trang chủ </span></div>
                    »
                    <div class="view__category" value="<?php echo $row_chitiet['id_danhmuc'] ?>">Shop</div>
                    »
                    <span class="breadcrumb_last"><?php echo $row_chitiet['ten_danhmuc'] ?></span>
                </div>
            </div>

            <div class="product__detail-container">
                <div class="product__header-container">
                    <h1 class="product_title"><?php echo $row_chitiet['tensanpham'] ?></h1>
                    <div class="product_rating">
                        <?php
                        $sql_review = "SELECT * FROM tbl_reviews WHERE tbl_reviews.id_sanpham='$_GET[id]' ";
                        $query_review = mysqli_query($mysqli, $sql_review);

                        $reviewCount = 0;
                        $reviewRating = 0;
                        $starAverage = 0;
                        $star_1 = 0;
                        $star_2 = 0;
                        $star_3 = 0;
                        $star_4 = 0;
                        $star_5 = 0;
                        while ($row_review = mysqli_fetch_array($query_review)) {
                            $reviewCount++;
                            $reviewRating += $row_review['rating'];
                            if ($row_review['rating'] == 1) {
                                $star_1++;
                            } else if ($row_review['rating'] == 2) {
                                $star_2++;
                            } else if ($row_review['rating'] == 3) {
                                $star_3++;
                            } else if ($row_review['rating'] == 4) {
                                $star_4++;
                            } else if ($row_review['rating'] == 5) {
                                $star_5++;
                            }
                        }
                        if ($reviewCount > 0) {
                            $starAverage = round($reviewRating / $reviewCount, 2);
                        }
                        ?>
                        <?php
                        if ($starAverage > 0) {
                        ?>
                        <span class="average_rate"><?php echo  $starAverage ?></span>
                        <?php } ?>
                        <div class="star_rating">
                            <?php
                            if ($starAverage <= 0) {
                            ?>

                            <?php
                            } else if ($starAverage > 0 && $starAverage < 2) {
                            ?>
                            <i class="fa-solid fa-star"></i>
                            <?php
                            } else if ($starAverage >= 2 && $starAverage < 3) {
                            ?>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <?php
                            } else if ($starAverage >= 3 && $starAverage < 4) {
                            ?>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <?php
                            } else if ($starAverage >= 4 && $starAverage < 5) {
                            ?>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <?php
                            } else {
                            ?>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <?php
                            }
                            ?>
                        </div>
                        <a class="review_link">(<?php echo $reviewCount  ?> đánh giá)</a>
                        <span class="sold">
                            <span class="sold_count"><?php echo $row_chitiet['daban'] ?></span>
                            đã bán
                        </span>
                    </div>
                </div>

                <div class="product_main-container">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-sm-12 product_category">
                            <img class="product_thumbnail"
                                src="./admin/modules/quanlysp/handleEvent/uploads/<?php echo $row_chitiet['hinhanh'] ?>"
                                alt="">
                        </div>
                        <div class="product_preview">
                            <img class="product_thumbnail-preview"
                                src="./admin/modules/quanlysp/handleEvent/uploads/<?php echo $row_chitiet['hinhanh'] ?>"
                                alt="">
                        </div>

                        <div class="col-lg-4  col-md-6 col-sm-12 product_summary">
                            <div class="price_wrapper">
                                <h4>Giá bán: </h4>
                                <?php
                                if ($row_chitiet['giamgia'] > 0) {
                                ?>
                                <span
                                    class="price_on_sale"><?php echo number_format($row_chitiet['giadagiam'], 0, ',', '.') ?>đ</span>
                                <span
                                    class="price_original"><?php echo number_format($row_chitiet['giasp'], 0, ',', '.') ?>đ</span>
                                <?php
                                } else {
                                ?>
                                <span
                                    class="price_on_sale"><?php echo number_format($row_chitiet['giasp'], 0, ',', '.') ?>đ</span>
                                <?php
                                }
                                ?>
                            </div>
                            <?php if ($row_chitiet['giamgia'] > 0) { ?>
                            <div class="price_wrapper">
                                <h4>Giảm: </h4>
                                <div class="price_on_sale">

                                    <?php echo $row_chitiet['giamgia'] ?>%
                                </div>
                            </div>
                            <?php } ?>
                            <div class="status__wrapper">
                                <h4>Tình trạng:</h4>
                                <?php
                                if ($row_chitiet['soluong'] == 0) {
                                ?>
                                <span class="product_status">Hết hàng</span>

                                <?php
                                } else {
                                ?>
                                <span class="product_status">Còn hàng</span>
                                <?php
                                }
                                ?>
                            </div>

                            <div class="product-short-description">
                                <h3>Đặc điểm nổi bật</h3>
                                <?php echo $row_chitiet['tomtat'] ?>

                            </div>


                            <?php if (isset($_SESSION['id_user'])) { ?>
                            <div class="cart">
                                <button class="add-to-cart-button" value="<?php echo $row_chitiet['id_sanpham'] ?>">THÊM
                                    VÀO GIỎ
                                    HÀNG</button>
                            </div>
                            <?php } else { ?>
                            <div class="cart">
                                <button class="add-to-cart-button-not-login">THÊM
                                    VÀO GIỎ
                                    HÀNG</button>
                            </div>
                            <?php } ?>

                            <?php if (isset($_SESSION['id_user'])) { ?>
                            <a class="buy_now add-to-cart-button" value="<?php echo $row_chitiet['id_sanpham'] ?>">
                                <strong>MUA NGAY</strong>

                                <span>Gọi điện xác nhận và giao hàng tận nơi</span>
                            </a>
                            <?php } else { ?>
                            <a class="buy_now-not-login">
                                <strong>MUA NGAY</strong>
                                <span>Gọi điện xác nhận và giao hàng tận nơi</span>
                            </a>
                            <?php } ?>


                            <div class="social_icon">
                                <i class="fa-brands fa-facebook-f"></i>
                                <i class="fa-brands fa-twitter"></i>
                                <i class="fa-regular fa-envelope"></i>
                                <i class="fa-brands fa-pinterest-p"></i>
                                <i class="fa-brands fa-linkedin-in"></i>
                            </div>

                            <div class="content_after_share">
                                <p>Tư vấn bán hàng liên hệ:</p>
                                <span style="color: #ff0000;"><a style="color: #ff0000;" title="Tư vấn bán hàng"
                                        href="tel:0123.456.789">0123.456.789</a></span>
                            </div>
                        </div>

                        <div class="col-lg-3 col-12 product_sidebar hide-for-medium">
                            <div class="featured__box-wrapper">

                                <div class="featured__box">
                                    <div class="featured__box-icon">
                                        <img src="images/featuredBox/giao-hang-hikvision.png" alt="">
                                    </div>
                                    <div class="featured__box-text">
                                        <p>
                                            <strong>GIAO HÀNG NGAY</strong>
                                            <br>
                                            Giao hàng toàn quốc
                                        </p>
                                    </div>
                                </div>

                                <div class="featured__box">
                                    <div class="featured__box-icon">
                                        <img src="images/featuredBox/package-1.png" alt="">
                                    </div>
                                    <div class="featured__box-text">
                                        <p>
                                            <strong>ĐỔI HÀNG 07 NGÀY</strong>
                                            <br>
                                            Nếu lỗi do nhà sản xuất
                                        </p>
                                    </div>
                                </div>

                                <div class="featured__box">
                                    <div class="featured__box-icon">
                                        <img src="images/featuredBox/thanh-toan-camera-hikvision.png" alt="">
                                    </div>
                                    <div class="featured__box-text">
                                        <p>
                                            <strong>THANH TOÁN</strong>
                                            <br>
                                            Thanh toán khi nhận hàng
                                        </p>
                                    </div>
                                </div>

                                <div class="featured__box">
                                    <div class="featured__box-icon">
                                        <img src="images/featuredBox/dien-thoai-camera-hik.png" alt="">
                                    </div>
                                    <div class="featured__box-text">
                                        <p>
                                            <strong>TỔNG CSKH 9H00 -18H00</strong>
                                            <br>
                                            Hotline: 0123.456.789
                                        </p>
                                    </div>
                                </div>

                                <div class="featured__box">
                                    <div class="featured__box-icon">
                                        <img src="images/featuredBox/house.png" alt="">
                                    </div>
                                    <div class="featured__box-text">
                                        <p>
                                            <strong>HÀ NỘI</strong>
                                            <br>
                                            Số 30 Đại Từ, Đại Kim, Hoàng Mai, Hà Nội( Ô Tô Đỗ )
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product__footer-container">
                    <div class="related__products-wrapper">
                        <h3>SẢN PHẨM TƯƠNG TỰ</h3>
                        <!-- Swiper -->
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper ">
                                <?php
                                $sql_pro = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc 
                                    AND tbl_sanpham.id_danhmuc=$iddanhmuc ORDER BY daban";
                                $query_pro = mysqli_query($mysqli, $sql_pro);
                                while ($row_pro = mysqli_fetch_array($query_pro)) {
                                ?>
                                <div class="swiper-slide">
                                    <div class="row__item item--product">
                                        <div class="row__item-container">
                                            <?php if ($row_pro['giamgia'] > 0) { ?>
                                            <div class="discount-banner">
                                                Giảm <?php echo $row_pro['giamgia'] ?>%
                                            </div>
                                            <?php } ?>
                                            <div class="row__item-display br-5">
                                                <div class="view__product-detail"
                                                    value="<?php echo $row_pro['id_sanpham'] ?>">
                                                    <div class="row__item-img"
                                                        style="background: url('./admin/modules/quanlysp/handleEvent/uploads/<?php echo $row_pro['hinhanh'] ?>') no-repeat center center / cover">
                                                    </div>
                                                </div>


                                                <?php if (isset($_SESSION['id_user'])) { ?>
                                                <div class="add-to-cart-btn"
                                                    value="<?php echo $row_pro['id_sanpham'] ?>">
                                                    <i class="fa-solid fa-cart-plus" style="
                                                                left: 21px;
                                                            "></i>
                                                    <span style="
                                                                font-size: 1rem;
                                                            ">Thêm vào giỏ hàng</span>
                                                </div>
                                                <?php } else { ?>
                                                <div class="add-to-cart-btn-not-login"
                                                    value="<?php echo $row_pro['id_sanpham'] ?>">
                                                    <i class="fa-solid fa-cart-plus" style="
                                                                left: 21px;
                                                            "></i>
                                                    <span style="
                                                                font-size: 1rem;
                                                            ">Thêm vào giỏ hàng</span>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="row__item-info">
                                                <div class="view__product-detail"
                                                    value="<?php echo $row_pro['id_sanpham'] ?>">
                                                    <div class="row__info-name">
                                                        <span
                                                            style="cursor:pointer;"><?php echo $row_pro['tensanpham'] ?></span>
                                                    </div>
                                                </div>
                                                <div class="price__wrapper">
                                                    <?php
                                                        if ($row_pro['giamgia'] > 0) {
                                                        ?>
                                                    <span
                                                        class="price-discount"><?php echo number_format($row_pro['giadagiam'], 0, ',', '.') ?>đ</span>
                                                    <span
                                                        class="price-normal-discount"><?php echo number_format($row_pro['giasp'], 0, ',', '.') ?>đ</span>
                                                    <?php
                                                        } else {
                                                        ?>
                                                    <span
                                                        class="price-normal"><?php echo number_format($row_pro['giasp'], 0, ',', '.') ?>đ</span>
                                                    <?php
                                                        }
                                                        ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>

                    </div>

                    <div class="content__product-footer">
                        <div class="row">
                            <div class="col-12 col-lg-9" style="padding: 0;">
                                <div class="product__footer-content">
                                    <div class="product__tab-header">MÔ TẢ</div>

                                    <div class="product__tab-content">
                                        <?php echo $row_chitiet['noidung'] ?>
                                    </div>
                                    <div class="load-more">
                                        <span>Xem thêm <i class="fa-solid fa-caret-down"></i></span>
                                    </div>
                                    <div class="collapse">
                                        <span>Thu gọn <i class="fa-solid fa-caret-up"></i></i></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Sidebar -->
                            <div class="col-12 col-lg-3">
                                <div class="product__footer-sidebar">
                                    <h3 class="footer__sidebar-title">BẠN CÓ THỂ THÍCH</h3>

                                    <div class="footer__sidebar-inner">
                                        <div class="row">
                                            <?php
                                            $sql_pro = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE trangthaisp=1 AND tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc 
                                                AND tbl_sanpham.id_danhmuc=$iddanhmuc ORDER BY daban ASC LIMIT 6";
                                            $query_pro = mysqli_query($mysqli, $sql_pro);
                                            while ($row_pro = mysqli_fetch_array($query_pro)) {
                                            ?>
                                            <div class="col" style="padding: 0;">
                                                <div class="sidebar__product-wrapper ">
                                                    <div class="sidebar__product-img view__product-detail"
                                                        value="<?php echo $row_pro['id_sanpham'] ?>">
                                                        <img alt="<?php echo $row_pro['ten_danhmuc'] ?></p>"
                                                            src="./admin/modules/quanlysp/handleEvent/uploads/<?php echo $row_pro['hinhanh'] ?>"
                                                            alt="">
                                                    </div>

                                                    <div class="sidebar__product-text">
                                                        <div class="title-wrapper">
                                                            <p class="category-title">
                                                                <?php echo $row_pro['ten_danhmuc'] ?></p>
                                                            <span class="product-name view__product-detail"
                                                                value="<?php echo $row_pro['id_sanpham'] ?>"
                                                                title="<?php echo $row_pro['tensanpham'] ?>">
                                                                <?php echo $row_pro['tensanpham'] ?>
                                                            </span>
                                                        </div>
                                                        <div class="price-wrapper">
                                                            <?php
                                                                if ($row_pro['giamgia'] > 0) {
                                                                ?>
                                                            <span
                                                                class="price-discount"><?php echo number_format($row_pro['giadagiam'], 0, ',', '.') ?>đ</span>
                                                            <span
                                                                class="price-normal-discount"><?php echo number_format($row_pro['giasp'], 0, ',', '.') ?>đ</span>
                                                            <?php
                                                                } else {
                                                                ?>
                                                            <span
                                                                class="price-normal"><?php echo number_format($row_pro['giasp'], 0, ',', '.') ?>đ</span>
                                                            <?php
                                                                }
                                                                ?>
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
                            </div>
                        </div>
                    </div>

                    <div class="review__product">
                        <div class="review__title">Đánh giá <?php echo $row_chitiet['tensanpham'] ?></div>

                        <div class="star__box">
                            <div class="star__average">
                                <?php
                                    if ($starAverage <= 0) {
                                ?>
                                <strong>CHƯA CÓ
                                    <br>
                                    ĐÁNH GIÁ NÀO
                                </strong>
                                <?php
                                    } else {
                                ?>
                                <strong>
                                    <div class="star__average-text">
                                        <?php echo $starAverage ?> <i class="fa-solid fa-star"></i>
                                    </div>
                                    <span>ĐÁNH GIÁ TRUNG BÌNH</span>
                                </strong>
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="star__box-left">
                                <?php
                                    if ($reviewCount > 0) {
                                ?>
                                <style>
                                .rating_scale-5::before {
                                    content: "";
                                    height: 100%;
                                    width: <?php echo round(($star_5 / $reviewCount) * 100, 2) ?>%;
                                    display: block;
                                    background-color: #ffbe00;
                                }

                                .rating_scale-4::before {
                                    content: "";
                                    height: 100%;
                                    width: <?php echo round(($star_4 / $reviewCount) * 100, 2) ?>%;
                                    display: block;
                                    background-color: #ffbe00;
                                }

                                .rating_scale-3::before {
                                    content: "";
                                    height: 100%;
                                    width: <?php echo round(($star_3 / $reviewCount) * 100, 2) ?>%;
                                    display: block;
                                    background-color: #ffbe00;
                                }

                                .rating_scale-2::before {
                                    content: "";
                                    height: 100%;
                                    width: <?php echo round(($star_2 / $reviewCount) * 100, 2) ?>%;
                                    display: block;
                                    background-color: #ffbe00;
                                }

                                .rating_scale-1::before {
                                    content: "";
                                    height: 100%;
                                    width: <?php echo round(($star_1 / $reviewCount) * 100, 2) ?>%;
                                    display: block;
                                    background-color: #ffbe00;
                                }
                                </style>
                                <div class="reviews_bar">
                                    <div class="review-row">
                                        <div class="stars_value">5 <i class="fa-solid fa-star"></i></div>
                                        <div class="rating_bar">
                                            <div class="rating_scale rating_scale-5"></div>
                                        </div>
                                        <span class="nums_review">
                                            <b><?php echo round(($star_5 / $reviewCount) * 100, 2)  ?>%</b>
                                            | <?php echo $star_5 ?> đánh giá
                                        </span>
                                    </div>

                                    <div class="review-row">
                                        <div class="stars_value">4 <i class="fa-solid fa-star"></i></div>
                                        <div class="rating_bar">
                                            <div class="rating_scale rating_scale-4"></div>
                                        </div>
                                        <span class="nums_review">
                                            <b><?php echo round(($star_4 / $reviewCount) * 100, 2)  ?>%</b>
                                            | <?php echo $star_4 ?> đánh giá
                                        </span>
                                    </div>

                                    <div class="review-row">
                                        <div class="stars_value">3 <i class="fa-solid fa-star"></i></div>
                                        <div class="rating_bar">
                                            <div class="rating_scale rating_scale-3"></div>
                                        </div>
                                        <span class="nums_review">
                                            <b><?php echo round(($star_3 / $reviewCount) * 100, 2)  ?>%</b>
                                            | <?php echo $star_3 ?> đánh giá
                                        </span>
                                    </div>

                                    <div class="review-row">
                                        <div class="stars_value">2 <i class="fa-solid fa-star"></i></div>
                                        <div class="rating_bar">
                                            <div class="rating_scale rating_scale-2"></div>
                                        </div>
                                        <span class="nums_review">
                                            <b><?php echo round(($star_2 / $reviewCount) * 100, 2)  ?>%</b>
                                            | <?php echo $star_2 ?> đánh giá
                                        </span>
                                    </div>

                                    <div class="review-row">
                                        <div class="stars_value">1 <i class="fa-solid fa-star"></i></div>
                                        <div class="rating_bar">
                                            <div class="rating_scale rating_scale-1"></div>
                                        </div>
                                        <span class="nums_review">
                                            <b><?php echo round(($star_1 / $reviewCount) * 100, 2)  ?>%</b>
                                            | <?php echo $star_1 ?> đánh giá
                                        </span>
                                    </div>
                                </div>

                                <?php } else { ?>
                                <div class="reviews_bar">
                                    <div class="review-row">
                                        <div class="stars_value">5 <i class="fa-solid fa-star"></i></div>
                                        <div class="rating_bar">
                                            <div class="rating_scale rating_scale-5"></div>
                                        </div>
                                        <span class="nums_review">
                                            <b>0%</b>
                                            | 0 đánh giá
                                        </span>
                                    </div>

                                    <div class="review-row">
                                        <div class="stars_value">4 <i class="fa-solid fa-star"></i></div>
                                        <div class="rating_bar">
                                            <div class="rating_scale rating_scale-4"></div>
                                        </div>
                                        <span class="nums_review">
                                            <b>0%</b>
                                            | 0 đánh giá
                                        </span>
                                    </div>

                                    <div class="review-row">
                                        <div class="stars_value">3 <i class="fa-solid fa-star"></i></div>
                                        <div class="rating_bar">
                                            <div class="rating_scale rating_scale-3"></div>
                                        </div>
                                        <span class="nums_review">
                                            <b>0%</b>
                                            | 0 đánh giá
                                        </span>
                                    </div>

                                    <div class="review-row">
                                        <div class="stars_value">2 <i class="fa-solid fa-star"></i></div>
                                        <div class="rating_bar">
                                            <div class="rating_scale rating_scale-2"></div>
                                        </div>
                                        <span class="nums_review">
                                            <b>0%</b>
                                            | 0 đánh giá
                                        </span>
                                    </div>

                                    <div class="review-row">
                                        <div class="stars_value">1 <i class="fa-solid fa-star"></i></div>
                                        <div class="rating_bar">
                                            <div class="rating_scale rating_scale-1"></div>
                                        </div>
                                        <span class="nums_review">
                                            <b>0%</b>
                                            | 0 đánh giá
                                        </span>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="star__box-right">
                                <?php
                                    if (isset($_SESSION['id_user'])) {
                                        $sql_order_details = "SELECT * FROM tbl_order_details, tbl_user WHERE tbl_order_details.id_user=tbl_user.id_user AND tbl_order_details.id_user=$_SESSION[id_user] AND tbl_order_details.id_sanpham='$_GET[id]'";
                                        $query_order_details = mysqli_query($mysqli, $sql_order_details);
                                        if (mysqli_num_rows($query_order_details) > 0) {
                                ?>
                                <button title="Đánh giá ngay" class="btn-reviews-now">Đánh giá ngay</button>
                                <?php } else { ?>
                                <button title="Đánh giá ngay" class="btn-reviews-not-buy">Đánh giá ngay</button>
                                <?php } ?>
                                <?php
                                    } else {
                                ?>
                                <button title="Đánh giá ngay" class="btn-reviews-not-login">Đánh giá ngay</button>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>

                        <div class="load__review-modal"></div>

                        <div id="load__review-data"></div>

                    </div>

                    <div class="comment__product">
                        <strong>Hỏi đáp</strong>
                        <div class="comment__form">
                            <form action="" method="post">
                                <div class="comment__input">
                                    <textarea placeholder="Mời bạn tham gia thảo luận, vui lòng nhập tiếng Việt có dấu."
                                        name="" id="question" cols="30" rows="10"></textarea>
                                    <div class="wrap-attaddsend-comment"><span class="countContent">0</span> ký tự (Tối
                                        thiểu
                                        10)
                                    </div>

                                    <div class="form__comment-bottom">

                                        <?php
                                        if (isset($_SESSION['id_user'])) {
                                        ?>
                                        <div class="comment__submit">
                                            Gửi
                                        </div>
                                        <?php
                                        } else {
                                        ?>
                                        <div class="comment__submit-not-login">
                                            Gửi
                                        </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                            </form>
                        </div>
                        <div class="load__comment-modal"></div>
                        <div id="load__comment-data">

                        </div>
                    </div>
                </div>
            </div>

            <?php
                                }
        ?>
        </div>
        <?php
        include('pages/footer.php');
        ?>
    </div>

    <div class="loader-wrapper">
        <figure>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </figure>
    </div>

    <!-- Initialize Swiper -->
    <script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 4,
        spaceBetween: 15,
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            0: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            425: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            768: {
                slidesPerView: 4,
                spaceBetween: 10,
            },
            1024: {
                slidesPerView: 5,
                spaceBetween: 15,
            },
        },
    });

    $(document).ready(() => {
        // Back to shop page
        $(document).on("click", '.view__category', function() {
            var id = $(this).attr("value");
            var url = "shopPage.php?id=" + id;
            window.history.pushState("new", "title", url);
            $(".container").load("shopPage.php?id=" + id);
        })

        // Back to home
        $(document).on("click", '.view__home', function() {
            var url = "home.php"
            window.history.pushState("new", "title", url);
            $(".container").load("home.php");
        })

        // Preview product
        $(document).on("click", '.product_thumbnail', function() {
            $('.product_preview').css("display", "block")
        })

        $(document).on("click", '.product_preview', function() {
            $('.product_preview').css("display", "none")
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

        // Load more description
        $(document).on("click", '.product__footer-content .load-more', function() {
            $('.product__tab-content').css('height', '100%');
            $('.product__footer-content .load-more').css('display', 'none')
            $('.product__footer-content .collapse').css('display', 'block')
        })

        // Collapse description
        $(document).on("click", '.product__footer-content .collapse', function() {
            $('.product__tab-content').css('height', '560px');
            $('.product__footer-content .load-more').css('display', 'block')
            $('.product__footer-content .collapse').css('display', 'none')
        })

        /* REVIEW STAR ANIMATION START */

        $(document).on("click", '.star-wrapper .s1', function() {
            $('.star-wrapper .s1').css("color", "#fe9727")
            $('.star-wrapper .s2').css("color", "grey")
            $('.star-wrapper .s3').css("color", "grey")
            $('.star-wrapper .s4').css("color", "grey")
            $('.star-wrapper .s5').css("color", "grey")
        })

        $(document).on("click", '.star-wrapper .s2', function() {
            $('.star-wrapper .s1').css("color", "#fe9727")
            $('.star-wrapper .s2').css("color", "#fe9727")
            $('.star-wrapper .s3').css("color", "grey")
            $('.star-wrapper .s4').css("color", "grey")
            $('.star-wrapper .s5').css("color", "grey")
        })

        $(document).on("click", '.star-wrapper .s3', function() {
            $('.star-wrapper .s1').css("color", "#fe9727")
            $('.star-wrapper .s2').css("color", "#fe9727")
            $('.star-wrapper .s3').css("color", "#fe9727")
            $('.star-wrapper .s4').css("color", "grey")
            $('.star-wrapper .s5').css("color", "grey")
        })

        $(document).on("click", '.star-wrapper .s4', function() {
            $('.star-wrapper .s1').css("color", "#fe9727")
            $('.star-wrapper .s2').css("color", "#fe9727")
            $('.star-wrapper .s3').css("color", "#fe9727")
            $('.star-wrapper .s4').css("color", "#fe9727")
            $('.star-wrapper .s5').css("color", "grey")
        })

        $(document).on("click", '.star-wrapper .s5', function() {
            $('.star-wrapper .s1').css("color", "#fe9727")
            $('.star-wrapper .s2').css("color", "#fe9727")
            $('.star-wrapper .s3').css("color", "#fe9727")
            $('.star-wrapper .s4').css("color", "#fe9727")
            $('.star-wrapper .s5').css("color", "#fe9727")
        })

        /* REVIEW STAR ANIMATION END */

        // Open review modal
        $(document).on("click", '.btn-reviews-now', function() {
            var id = <?php echo $_GET['id'] ?>;
            $(".load__review-modal").load("pages/review/reviewModal.php?id=" + id);
        })

        $(document).on("click", '.btn-reviews-not-login', function() {
            swal("Bạn cần đăng nhập để đánh giá",
                "Vui lòng đăng nhập hoặc đăng ký tài khoản!",
                "error");
        })

        $(document).on("click", '.btn-reviews-not-buy', function() {
            swal("Quý khách chưa mua sản phẩm này",
                "Vui lòng mua sản phẩm để tiếp tục đánh giá!",
                "error");
        })

        $(document).on("click", '.comment__submit-not-login', function() {
            swal("Bạn cần đăng nhập để đánh giá",
                "Vui lòng đăng nhập hoặc đăng ký tài khoản!",
                "error");
        })


        // View review modal
        $(document).on("click", '.close-review-modal', function() {
            $(".review-modal-container").remove();
        })

        $(document).on("click", '.review-modal-background', function() {
            $(".review-modal-container").remove();
        })

        // View review data
        function view_review_data() {
            $.post(' pages/review/loadReviewData.php?idsanpham=' +
                <?php echo $_GET['id'] ?>,
                function(data) {
                    $('#load__review-data').html(data)
                })
        }
        view_review_data()

        /* HANDLE REVIEW START */
        var starCount = 0
        $(document).on("click", '.star-wrapper .fa-star', function() {
            starCount = $(this).attr('value');
        })

        $(document).on("click", '.review-btn', function() {
            var reviewContent = $('#review').val()
            var idProduct = <?php echo $_GET['id'] ?>;
            let errors = {
                reviewContentError: '',
                starCountError: '',
            }

            if (reviewContent.length === 0) {
                errors.reviewContentError = "Nội dung đánh giá không được để trống!";
                swal("Vui lòng nhập lại", errors.reviewContentError, "error");
            } else if (reviewContent.length <= 10) {
                errors.reviewContentError = "Nội dung đánh giá phải nhiều hơn 10 ký tự!";
                swal("Vui lòng nhập lại", errors.reviewContentError, "error");
            } else {
                errors.reviewContentError = '';
            }

            if (starCount == 0) {
                errors.starCountError = "Quý khách vui lòng chọn số sao muốn đánh giá!";
                swal("Vui lòng chọn lại", errors.starCountError, "error");
            } else {
                errors.starCountError = '';
            }

            if (errors.reviewContentError == '' && errors.starCountError == '') {
                $.ajax({
                    url: " pages/review/handleReview.php",
                    data: {
                        starCount: starCount,
                        reviewContent: reviewContent,
                        idProduct: idProduct,
                    },
                    dataType: 'json',
                    method: "post",
                    cache: true,
                    success: function(data) {
                        swal("OK!", "Đánh giá thành công", "success");
                        $('#review').val('')
                        view_review_data();
                        starCount = 0
                    }
                })
            }
        })
        /* HANDLE REVIEW END */

        // Delete review
        $(document).on("click", '.review__delete-btn', function() {
            var idReview = $(this).val()

            $.ajax({
                url: " pages/review/handleDeleteReview.php",
                data: {
                    idReview: idReview,
                },
                dataType: 'json',
                method: "post",
                cache: true,
                success: function(data) {
                    swal("OK!", "Xóa đánh giá thành công", "success");
                    view_review_data()
                },
                error: function() {
                    view_review_data()
                }
            })
        })

        // Edit review
        var idReview;
        $(document).on("click", '.review__edit-modal-btn', function() {
            idReview = $(this).val()
            var id = <?php echo $_GET['id'] ?>;
            $(".load__review-modal").load("pages/review/editReviewModal.php?id=" + id +
                '&idReview=' + idReview);
        })

        $(document).on("click", '.review__edit-btn', function() {
            var reviewContent = $('#review').val()
            $.ajax({
                url: " pages/review/handleEditReview.php",
                data: {
                    idReview: idReview,
                    starCount: starCount,
                    reviewContent: reviewContent,
                },
                dataType: 'json',
                method: "post",
                cache: true,
                success: function(data) {
                    view_review_data()
                    starCount = 0
                },
                error: function() {
                    swal("OK!", "Sửa đánh giá thành công", "success");
                    view_review_data()
                }
            })
        })

        // Answer review
        var reviewId;
        $(document).on("click", '.review__footer-answer', function() {
            reviewId = $(this).val()
            var id = <?php echo $_GET['id'] ?>;
            $(".load__review-modal").load("pages/review/answerReviewModal.php?id=" + id +
                '&idReview=' + reviewId);
        })

        $(document).on("click", '.review__answer-btn', function() {
            var answerContent = $('.answer-review').val()
            $.ajax({
                url: " pages/review/handleAnswerReview.php",
                data: {
                    answerContent: answerContent,
                    reviewId: reviewId
                },
                dataType: 'json',
                method: "post",
                cache: true,
                success: function(data) {
                    view_review_data()
                },
                error: function() {
                    view_review_data()
                }
            })
        })

        // Delete answer review
        $(document).on("click", '.answer-review-delete-btn', function() {
            var idReview = $(this).val()

            $.ajax({
                url: " pages/review/handleDeleteAnswerReiview.php",
                data: {
                    idReview: idReview,
                },
                dataType: 'json',
                method: "post",
                cache: true,
                success: function(data) {
                    swal("OK!", "Xóa đánh giá thành công", "success");
                    view_review_data()
                },
                error: function() {
                    view_review_data()
                }
            })
        })

        $(document).on("keyup", '#review', function() {
            var content = $(this).val();
            $('.countContentReview').html(content.length)
        })
        /* COMMENT START */

        // View comment data
        function view_comment_data() {
            $.post(' pages/comment/loadCommentData.php?idsanpham=' +
                <?php echo $_GET['id'] ?>,
                function(data) {
                    $('#load__comment-data').html(data)
                })
        }
        view_comment_data()

        $(document).on("click", '.comment__submit', function() {
            var comment = $('#question').val()
            var idProduct = <?php echo $_GET['id'] ?>;
            let errors = {
                commentError: '',
            }

            if (comment.length === 0) {
                errors.commentError = "Nội dung đánh giá không được để trống!";
                swal("Vui lòng nhập lại", errors.commentError, "error");
            } else if (comment.length <= 10) {
                errors.commentError = "Nội dung đánh giá phải nhiều hơn 10 ký tự!";
                swal("Vui lòng nhập lại", errors.commentError, "error");
            } else {
                errors.commentError = '';
            }

            if (errors.commentError == '') {
                $.ajax({
                    url: " pages/comment/handleComment.php",
                    data: {
                        comment: comment,
                        idProduct: idProduct,
                    },
                    dataType: 'json',
                    method: "post",
                    cache: true,
                    success: function(data) {
                        $('#question').val('')
                        view_comment_data();
                    }
                })
            }
        })

        // Delete comment
        $(document).on("click", '.comment__delete-btn', function() {
            var idComment = $(this).val()

            $.ajax({
                url: " pages/comment/handleDeleteComment.php",
                data: {
                    idComment: idComment,
                },
                dataType: 'json',
                method: "post",
                cache: true,
                success: function(data) {
                    swal("OK!", "Xóa câu hỏi thành công", "success");
                    view_comment_data()
                },
                error: function() {
                    view_comment_data()
                }
            })
        })

        // Edit comment
        var idComment;
        $(document).on("click", '.comment__edit-modal-btn', function() {
            idComment = $(this).val()
            var id = <?php echo $_GET['id'] ?>;
            $(".load__comment-modal").load("pages/comment/editCommentModal.php?id=" + id +
                '&idComment=' + idComment);
        })

        $(document).on("click", '.comment__edit-btn', function() {
            var comment = $('.edit-comment').val()
            let errors = {
                commentError: '',
            }

            if (comment.length == 0) {
                errors.commentError = "Nội dung đánh giá không được để trống!";
                swal("Vui lòng nhập lại", errors.commentError, "error");
            } else if (comment.length <= 10) {
                errors.commentError = "Nội dung đánh giá phải nhiều hơn 10 ký tự!";
                swal("Vui lòng nhập lại", errors.commentError, "error");
            } else {
                errors.commentError = '';
            }

            if (errors.commentError == '') {
                $.ajax({
                    url: " pages/comment/handleEditComment.php",
                    data: {
                        idComment: idComment,
                        comment: comment,
                    },
                    dataType: 'json',
                    method: "post",
                    cache: true,
                    success: function(data) {
                        swal("OK!", "Sửa câu hỏi thành công", "success");
                        view_comment_data()
                    },
                    error: function() {
                        swal("OK!", "Sửa câu hỏi thành công", "success");
                        view_comment_data()
                    }
                })
            }
        })

        // Answer comment
        var commentId;
        $(document).on("click", '.comment__footer-answer', function() {
            commentId = $(this).val()
            var id = <?php echo $_GET['id'] ?>;
            $(".load__comment-modal").load("pages/comment/answerCommentModal.php?id=" + id +
                '&idcomment=' + commentId);
        })

        $(document).on("click", '.comment__answer-btn', function() {
            var answerContent = $('.answer-comment').val()
            $.ajax({
                url: " pages/comment/handleAnswerComment.php",
                data: {
                    answerContent: answerContent,
                    commentId: commentId
                },
                dataType: 'json',
                method: "post",
                cache: true,
                success: function(data) {
                    view_comment_data()
                },
                error: function() {
                    view_comment_data()
                }
            })
        })

        // Delete answer comment
        $(document).on("click", '.answer-comment-delete-btn', function() {
            var idComment = $(this).val()

            $.ajax({
                url: " pages/comment/handleDeleteAnswerComment.php",
                data: {
                    idComment: idComment,
                },
                dataType: 'json',
                method: "post",
                cache: true,
                success: function(data) {
                    swal("OK!", "Xóa đánh giá thành công", "success");
                    view_comment_data()
                },
                error: function() {
                    view_comment_data()
                }
            })
        })

        $(document).on("click", '#content', function() {
            var content = $(this).val();
        })

        $(document).on("keyup", '#question', function() {
            var content = $(this).val();
            $('.countContent').html(content.length)
        })

        $(document).on("keyup", '.edit-comment', function() {
            var content = $(this).val();
            $('.countContentEditReview').html(content.length)
        })

        /* COMMENT END */
    })
    </script>
</body>

</html>