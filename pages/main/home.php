<?php 
$sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
$query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
?>

<link rel="stylesheet" href="css/home.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<div id="home">
    <div class="content">

        <!-- Ads slide -->
        <section class="section box__slide_home">
            <div class="section_content">
                <div class="row ">
                    <div class="col-3">
                        <ul class="home__menu">
                            <?php 
                            while($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
                            ?>
                            <li>
                                <a href="index.php?quanly=danhmucsanpham&id=<?php echo $row_danhmuc['id_danhmuc'] ?>">
                                    <i class="fa-solid fa-chevron-right"></i>
                                    <?php echo $row_danhmuc['ten_danhmuc'] ?>
                                </a>
                            </li>
                            <?php 
                                        }
                                        ?>
                        </ul>
                    </div>
                    <div class="col-9">
                        <div class="slide_ads">
                            <!-- Swiper -->
                            <div class="swiper mySwiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="images/ads/ads1.gif" alt="">
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

                        <div class="col col-lg-2-4 col-md-3 col-4 mb-10">
                            <div class="row__item item--product">
                                <div class="row__item-container">
                                    <div class="row__item-display br-5">
                                        <div class="row__item-img"
                                            style="background: url('./images/products/yoosee-3-rau-3m.jpg') no-repeat center center / cover">
                                        </div>
                                        <div class="add-to-cart-btn">
                                            <a><i class="fa-solid fa-cart-plus"></i>Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                    <div class="row__item-info">
                                        <a href="#" class="row__info-name">Camera Yoosee 3 Râu 3M Ban Đêm Có Màu</a>
                                        <div class="price__wrapper">
                                            <span class="price-has-dropped">290,000đ</span>
                                            <span class="price-previous-dropped">560,000đ</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col col-lg-2-4 col-md-3 col-4 mb-10">
                            <div class="row__item item--product">
                                <div class="row__item-container">
                                    <div class="row__item-display br-5">
                                        <div class="row__item-img"
                                            style="background: url('./images/products/yoosee-3-rau-3m.jpg') no-repeat center center / cover">
                                        </div>
                                        <div class="add-to-cart-btn">
                                            <a><i class="fa-solid fa-cart-plus"></i>Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                    <div class="row__item-info">
                                        <a href="#" class="row__info-name">Camera Yoosee 3 Râu 3M Ban Đêm Có Màu</a>
                                        <div class="price__wrapper">
                                            <span class="price-has-dropped">290,000đ</span>
                                            <span class="price-previous-dropped">560,000đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col col-lg-2-4 col-md-3 col-4 mb-10">
                            <div class="row__item item--product">
                                <div class="row__item-container">
                                    <div class="row__item-display br-5">
                                        <div class="row__item-img"
                                            style="background: url('./images/products/yoosee-3-rau-3m.jpg') no-repeat center center / cover">
                                        </div>
                                        <div class="add-to-cart-btn">
                                            <a><i class="fa-solid fa-cart-plus"></i>Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                    <div class="row__item-info">
                                        <a href="#" class="row__info-name">Camera Yoosee 3 Râu 3M Ban Đêm Có Màu</a>
                                        <div class="price__wrapper">
                                            <span class="price-has-dropped">290,000đ</span>
                                            <span class="price-previous-dropped">560,000đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col col-lg-2-4 col-md-3 col-4 mb-10">
                            <div class="row__item item--product">
                                <div class="row__item-container">
                                    <div class="row__item-display br-5">
                                        <div class="row__item-img"
                                            style="background: url('./images/products/yoosee-3-rau-3m.jpg') no-repeat center center / cover">
                                        </div>
                                        <div class="add-to-cart-btn">
                                            <a><i class="fa-solid fa-cart-plus"></i>Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                    <div class="row__item-info">
                                        <a href="#" class="row__info-name">Camera Yoosee 3 Râu 3M Ban Đêm Có Màu</a>
                                        <div class="price__wrapper">
                                            <span class="price-has-dropped">290,000đ</span>
                                            <span class="price-previous-dropped">560,000đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col col-lg-2-4 col-md-3 col-4 mb-10">
                            <div class="row__item item--product">
                                <div class="row__item-container">
                                    <div class="row__item-display br-5">
                                        <div class="row__item-img"
                                            style="background: url('./images/products/yoosee-3-rau-3m.jpg') no-repeat center center / cover">
                                        </div>
                                        <div class="add-to-cart-btn">
                                            <a><i class="fa-solid fa-cart-plus"></i>Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                    <div class="row__item-info">
                                        <a href="#" class="row__info-name">Camera Yoosee 3 Râu 3M Ban Đêm Có Màu</a>
                                        <div class="price__wrapper">
                                            <span class="price-has-dropped">290,000đ</span>
                                            <span class="price-previous-dropped">560,000đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col col-lg-2-4 col-md-3 col-4 mb-10">
                            <div class="row__item item--product">
                                <div class="row__item-container">
                                    <div class="row__item-display br-5">
                                        <div class="row__item-img"
                                            style="background: url('./images/products/yoosee-3-rau-3m.jpg') no-repeat center center / cover">
                                        </div>
                                        <div class="add-to-cart-btn">
                                            <a><i class="fa-solid fa-cart-plus"></i>Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                    <div class="row__item-info">
                                        <a href="#" class="row__info-name">Camera Yoosee 3 Râu 3M Ban Đêm Có Màu</a>
                                        <div class="price__wrapper">
                                            <span class="price-has-dropped">290,000đ</span>
                                            <span class="price-previous-dropped">560,000đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col col-lg-2-4 col-md-3 col-4 mb-10">
                            <div class="row__item item--product">
                                <div class="row__item-container">
                                    <div class="row__item-display br-5">
                                        <div class="row__item-img"
                                            style="background: url('./images/products/yoosee-3-rau-3m.jpg') no-repeat center center / cover">
                                        </div>
                                        <div class="add-to-cart-btn">
                                            <a><i class="fa-solid fa-cart-plus"></i>Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                    <div class="row__item-info">
                                        <a href="#" class="row__info-name">Camera Yoosee 3 Râu 3M Ban Đêm Có Màu</a>
                                        <div class="price__wrapper">
                                            <span class="price-has-dropped">290,000đ</span>
                                            <span class="price-previous-dropped">560,000đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col col-lg-2-4 col-md-3 col-4 mb-10">
                            <div class="row__item item--product">
                                <div class="row__item-container">
                                    <div class="row__item-display br-5">
                                        <div class="row__item-img"
                                            style="background: url('./images/products/yoosee-3-rau-3m.jpg') no-repeat center center / cover">
                                        </div>
                                        <div class="add-to-cart-btn">
                                            <a><i class="fa-solid fa-cart-plus"></i>Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                    <div class="row__item-info">
                                        <a href="#" class="row__info-name">Camera Yoosee 3 Râu 3M Ban Đêm Có Màu</a>
                                        <div class="price__wrapper">
                                            <span class="price-has-dropped">290,000đ</span>
                                            <span class="price-previous-dropped">560,000đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col col-lg-2-4 col-md-3 col-4 mb-10">
                            <div class="row__item item--product">
                                <div class="row__item-container">
                                    <div class="row__item-display br-5">
                                        <div class="row__item-img"
                                            style="background: url('./images/products/yoosee-3-rau-3m.jpg') no-repeat center center / cover">
                                        </div>
                                        <div class="add-to-cart-btn">
                                            <a><i class="fa-solid fa-cart-plus"></i>Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                    <div class="row__item-info">
                                        <a href="#" class="row__info-name">Camera Yoosee 3 Râu 3M Ban Đêm Có Màu</a>
                                        <div class="price__wrapper">
                                            <span class="price-has-dropped">290,000đ</span>
                                            <span class="price-previous-dropped">560,000đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col col-lg-2-4 col-md-3 col-4 mb-10">
                            <div class="row__item item--product">
                                <div class="row__item-container">
                                    <div class="row__item-display br-5">
                                        <div class="row__item-img"
                                            style="background: url('./images/products/yoosee-3-rau-3m.jpg') no-repeat center center / cover">
                                        </div>
                                        <div class="add-to-cart-btn">
                                            <a><i class="fa-solid fa-cart-plus"></i>Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                    <div class="row__item-info">
                                        <a href="#" class="row__info-name">Camera Yoosee 3 Râu 3M Ban Đêm Có Màu</a>
                                        <div class="price__wrapper">
                                            <span class="price-has-dropped">290,000đ</span>
                                            <span class="price-previous-dropped">560,000đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!--  Products -->
        <section class="section box__product">
            <div class="section_content row">
                <div class="col col-lg-12 col-md-12 col-12">
                    <div class="container__header">
                        <h2 class="container__header-title">Sản Phẩm Bán Chạy</h2>
                        <div class="view-all">
                            <a href="#">Xem tất cả<i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col col-lg-12 col-md-12 col-12">
                    <div class="row no-wrap product--container">

                        <div class="col col-lg-2-4 col-md-3 col-4 mb-10">
                            <div class="row__item item--product">
                                <div class="row__item-container">
                                    <div class="row__item-display br-5">
                                        <div class="row__item-img"
                                            style="background: url('./images/products/yoosee-3-rau-3m.jpg') no-repeat center center / cover">
                                        </div>
                                        <div class="add-to-cart-btn">
                                            <a><i class="fa-solid fa-cart-plus"></i>Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                    <div class="row__item-info">
                                        <a href="#" class="row__info-name">Camera Yoosee 3 Râu 3M Ban Đêm Có Màu</a>
                                        <div class="price__wrapper">
                                            <span class="price-has-dropped">290,000đ</span>
                                            <span class="price-previous-dropped">560,000đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col col-lg-2-4 col-md-3 col-4 mb-10">
                            <div class="row__item item--product">
                                <div class="row__item-container">
                                    <div class="row__item-display br-5">
                                        <div class="row__item-img"
                                            style="background: url('./images/products/yoosee-3-rau-3m.jpg') no-repeat center center / cover">
                                        </div>
                                        <div class="add-to-cart-btn">
                                            <a><i class="fa-solid fa-cart-plus"></i>Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                    <div class="row__item-info">
                                        <a href="#" class="row__info-name">Camera Yoosee 3 Râu 3M Ban Đêm Có Màu</a>
                                        <div class="price__wrapper">
                                            <span class="price-has-dropped">290,000đ</span>
                                            <span class="price-previous-dropped">560,000đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col col-lg-2-4 col-md-3 col-4 mb-10">
                            <div class="row__item item--product">
                                <div class="row__item-container">
                                    <div class="row__item-display br-5">
                                        <div class="row__item-img"
                                            style="background: url('./images/products/yoosee-3-rau-3m.jpg') no-repeat center center / cover">
                                        </div>
                                        <div class="add-to-cart-btn">
                                            <a><i class="fa-solid fa-cart-plus"></i>Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                    <div class="row__item-info">
                                        <a href="#" class="row__info-name">Camera Yoosee 3 Râu 3M Ban Đêm Có Màu</a>
                                        <div class="price__wrapper">
                                            <span class="price-has-dropped">290,000đ</span>
                                            <span class="price-previous-dropped">560,000đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col col-lg-2-4 col-md-3 col-4 mb-10">
                            <div class="row__item item--product">
                                <div class="row__item-container">
                                    <div class="row__item-display br-5">
                                        <div class="row__item-img"
                                            style="background: url('./images/products/yoosee-3-rau-3m.jpg') no-repeat center center / cover">
                                        </div>
                                        <div class="add-to-cart-btn">
                                            <a><i class="fa-solid fa-cart-plus"></i>Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                    <div class="row__item-info">
                                        <a href="#" class="row__info-name">Camera Yoosee 3 Râu 3M Ban Đêm Có Màu</a>
                                        <div class="price__wrapper">
                                            <span class="price-has-dropped">290,000đ</span>
                                            <span class="price-previous-dropped">560,000đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col col-lg-2-4 col-md-3 col-4 mb-10">
                            <div class="row__item item--product">
                                <div class="row__item-container">
                                    <div class="row__item-display br-5">
                                        <div class="row__item-img"
                                            style="background: url('./images/products/yoosee-3-rau-3m.jpg') no-repeat center center / cover">
                                        </div>
                                        <div class="add-to-cart-btn">
                                            <a><i class="fa-solid fa-cart-plus"></i>Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                    <div class="row__item-info">
                                        <a href="#" class="row__info-name">Camera Yoosee 3 Râu 3M Ban Đêm Có Màu</a>
                                        <div class="price__wrapper">
                                            <span class="price-has-dropped">290,000đ</span>
                                            <span class="price-previous-dropped">560,000đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col col-lg-2-4 col-md-3 col-4 mb-10">
                            <div class="row__item item--product">
                                <div class="row__item-container">
                                    <div class="row__item-display br-5">
                                        <div class="row__item-img"
                                            style="background: url('./images/products/yoosee-3-rau-3m.jpg') no-repeat center center / cover">
                                        </div>
                                        <div class="add-to-cart-btn">
                                            <a><i class="fa-solid fa-cart-plus"></i>Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                    <div class="row__item-info">
                                        <a href="#" class="row__info-name">Camera Yoosee 3 Râu 3M Ban Đêm Có Màu</a>
                                        <div class="price__wrapper">
                                            <span class="price-has-dropped">290,000đ</span>
                                            <span class="price-previous-dropped">560,000đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col col-lg-2-4 col-md-3 col-4 mb-10">
                            <div class="row__item item--product">
                                <div class="row__item-container">
                                    <div class="row__item-display br-5">
                                        <div class="row__item-img"
                                            style="background: url('./images/products/yoosee-3-rau-3m.jpg') no-repeat center center / cover">
                                        </div>
                                        <div class="add-to-cart-btn">
                                            <a><i class="fa-solid fa-cart-plus"></i>Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                    <div class="row__item-info">
                                        <a href="#" class="row__info-name">Camera Yoosee 3 Râu 3M Ban Đêm Có Màu</a>
                                        <div class="price__wrapper">
                                            <span class="price-has-dropped">290,000đ</span>
                                            <span class="price-previous-dropped">560,000đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col col-lg-2-4 col-md-3 col-4 mb-10">
                            <div class="row__item item--product">
                                <div class="row__item-container">
                                    <div class="row__item-display br-5">
                                        <div class="row__item-img"
                                            style="background: url('./images/products/yoosee-3-rau-3m.jpg') no-repeat center center / cover">
                                        </div>
                                        <div class="add-to-cart-btn">
                                            <a><i class="fa-solid fa-cart-plus"></i>Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                    <div class="row__item-info">
                                        <a href="#" class="row__info-name">Camera Yoosee 3 Râu 3M Ban Đêm Có Màu</a>
                                        <div class="price__wrapper">
                                            <span class="price-has-dropped">290,000đ</span>
                                            <span class="price-previous-dropped">560,000đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col col-lg-2-4 col-md-3 col-4 mb-10">
                            <div class="row__item item--product">
                                <div class="row__item-container">
                                    <div class="row__item-display br-5">
                                        <div class="row__item-img"
                                            style="background: url('./images/products/yoosee-3-rau-3m.jpg') no-repeat center center / cover">
                                        </div>
                                        <div class="add-to-cart-btn">
                                            <a><i class="fa-solid fa-cart-plus"></i>Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                    <div class="row__item-info">
                                        <a href="#" class="row__info-name">Camera Yoosee 3 Râu 3M Ban Đêm Có Màu</a>
                                        <div class="price__wrapper">
                                            <span class="price-has-dropped">290,000đ</span>
                                            <span class="price-previous-dropped">560,000đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col col-lg-2-4 col-md-3 col-4 mb-10">
                            <div class="row__item item--product">
                                <div class="row__item-container">
                                    <div class="row__item-display br-5">
                                        <div class="row__item-img"
                                            style="background: url('./images/products/yoosee-3-rau-3m.jpg') no-repeat center center / cover">
                                        </div>
                                        <div class="add-to-cart-btn">
                                            <a><i class="fa-solid fa-cart-plus"></i>Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                    <div class="row__item-info">
                                        <a href="#" class="row__info-name">Camera Yoosee 3 Râu 3M Ban Đêm Có Màu</a>
                                        <div class="price__wrapper">
                                            <span class="price-has-dropped">290,000đ</span>
                                            <span class="price-previous-dropped">560,000đ</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- Swiper JS -->
        <script>
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
        </script>

    </div>
</div>