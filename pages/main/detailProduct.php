<link rel="stylesheet" href="css/detailProduct.css">
<!-- Link Swiper's CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

<?php
$sql_chitiet = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc 
    AND tbl_sanpham.id_sanpham='$_GET[id]' LIMIT 1 ";
$query_chitiet = mysqli_query($mysqli, $sql_chitiet);
while ($row_chitiet = mysqli_fetch_array($query_chitiet)) {
?>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <span>
        <span>
            <a href="#">Home</a>
        </span>
        »
        <span>
            <a href="index.php?quanly=danhmucsanpham&id=<?php echo $row_chitiet['id_danhmuc'] ?>">Shop</a>
        </span>
        »
        <span class="breadcrumb_last"><?php echo $row_chitiet['tensanpham'] ?></span>
    </span>
</div>

<div class="product__detail-container">
    <div class="product__header-container">
        <h1 class="product_title"><?php echo $row_chitiet['tensanpham'] ?></h1>
        <div class="product_rating">
            <span class="average_rate">5.00</span>
            <div class="star_rating">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
            </div>
            <a href="#" class="review_link">(4 đánh giá)</a>
            <span class="sold">
                <span class="sold_count">258948</span>
                đã bán
            </span>
        </div>
    </div>

    <div class="product_main-container">
        <div class="row">
            <div class="col-lg-5 col product_gallery">
                <img class="product_thumbnail"
                    src="./admin/modules/quanlysp/uploads/<?php echo $row_chitiet['hinhanh'] ?>" alt="">
            </div>

            <div class="col-lg-4 col product_summary">
                <div class="price_wrapper">
                    <h4>Gía bán: </h4>
                    <span class="price_on_sale"><?php echo number_format($row_chitiet['giasp'], 0, ',', '.') ?>đ</span>
                    <span class="price_original">560,000đ</span>
                </div>
                <div class="status__wrapper">
                    <h4>Tình trạng:</h4>
                    <span class="product_status">Còn hàng</span>
                </div>

                <div class="product-short-description">
                    <h3>Đặc điểm nổi bật</h3>
                    <?php echo $row_chitiet['tomtat'] ?>

                </div>

                <form action="" class="cart">
                    <div class="quantity_wrapper">
                        <label for="quantity">Số lượng: </label>
                        <div class="quantity_button-wrapper">
                            <input type="button" value="-" class="minus-quantity button-quantity">
                            <input type="number" name="quantity" class="input-text" step="1" min="1" value="1"
                                id="quantity" placeholder inputmode="numeric">
                            <input type="button" value="+" class="plus-quantity button-quantity">
                        </div>
                    </div>
                    <button type="submit" name="add-to-cart" class="add-to-cart-button">THÊM VÀO GIỎ HÀNG</button>
                </form>

                <a href="#" class="buy_now">
                    <strong>MUA NGAY</strong>
                    <span>Gọi điện xác nhận và giao hàng tận nơi</span>
                </a>

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

            <div class="col-lg-3 col product_sidebar hide-for-medium">
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

                    <div class="swiper-slide">
                        <div class=" row__item item--product">
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

                    <div class="swiper-slide">
                        <div class=" row__item item--product">
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

                    <div class="swiper-slide">
                        <div class=" row__item item--product">
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

                    <div class="swiper-slide">
                        <div class=" row__item item--product">
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

                    <div class="swiper-slide">
                        <div class=" row__item item--product">
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

                    <div class="swiper-slide">
                        <div class=" row__item item--product">
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

                    <div class="swiper-slide">
                        <div class=" row__item item--product">
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

                    <div class="swiper-slide">
                        <div class=" row__item item--product">
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

                    <div class="swiper-slide">
                        <div class=" row__item item--product">
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
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

        <div class="content__product-footer">
            <div class="row">
                <div class="col-12 col-lg-9">
                    <div class="product__footer-content">
                        <div class="product__tab-header">MÔ TẢ</div>

                        <div class="product__tab-content">
                            <?php echo $row_chitiet['noidung'] ?>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-12 col-lg-3">
                    <div class="product__footer-sidebar">
                        <h3 class="footer__sidebar-title">BẠN CÓ THỂ THÍCH</h3>

                        <div class="footer__sidebar-inner">
                            <div class="row">

                                <div class="col">
                                    <div class="sidebar__product-wrapper">
                                        <div class="sidebar__product-img">
                                            <img src="./images/products/yoosee-3-rau-3m.jpg" alt="">
                                        </div>
                                        <div class="sidebar__product-text">
                                            <div class="title-wrapper">
                                                <p class="category-title">Camera Yoosee</p>
                                                <p class="product-name">
                                                    <a href="#">Camera Wifi Uniarch Uho-S2 Loại Tốt</a>
                                                </p>
                                            </div>
                                            <div class="price-wrapper">
                                                <span class="price-has-dropped">290,000đ</span>
                                                <span class="price-previous-dropped">560,000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="sidebar__product-wrapper">
                                        <div class="sidebar__product-img">
                                            <img src="./images/products/yoosee-3-rau-3m.jpg" alt="">
                                        </div>
                                        <div class="sidebar__product-text">
                                            <div class="title-wrapper">
                                                <p class="category-title">Camera Yoosee</p>
                                                <p class="product-name">
                                                    <a href="#">Camera Wifi Uniarch Uho-S2 Loại Tốt</a>
                                                </p>
                                            </div>
                                            <div class="price-wrapper">
                                                <span class="price-has-dropped">290,000đ</span>
                                                <span class="price-previous-dropped">560,000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="sidebar__product-wrapper">
                                        <div class="sidebar__product-img">
                                            <img src="./images/products/yoosee-3-rau-3m.jpg" alt="">
                                        </div>
                                        <div class="sidebar__product-text">
                                            <div class="title-wrapper">
                                                <p class="category-title">Camera Yoosee</p>
                                                <p class="product-name">
                                                    <a href="#">Camera Wifi Uniarch Uho-S2 Loại Tốt</a>
                                                </p>
                                            </div>
                                            <div class="price-wrapper">
                                                <span class="price-has-dropped">290,000đ</span>
                                                <span class="price-previous-dropped">560,000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="sidebar__product-wrapper">
                                        <div class="sidebar__product-img">
                                            <img src="./images/products/yoosee-3-rau-3m.jpg" alt="">
                                        </div>
                                        <div class="sidebar__product-text">
                                            <div class="title-wrapper">
                                                <p class="category-title">Camera Yoosee</p>
                                                <p class="product-name">
                                                    <a href="#">Camera Wifi Uniarch Uho-S2 Loại Tốt</a>
                                                </p>
                                            </div>
                                            <div class="price-wrapper">
                                                <span class="price-has-dropped">290,000đ</span>
                                                <span class="price-previous-dropped">560,000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="sidebar__product-wrapper">
                                        <div class="sidebar__product-img">
                                            <img src="./images/products/yoosee-3-rau-3m.jpg" alt="">
                                        </div>
                                        <div class="sidebar__product-text">
                                            <div class="title-wrapper">
                                                <p class="category-title">Camera Yoosee</p>
                                                <p class="product-name">
                                                    <a href="#">Camera Wifi Uniarch Uho-S2 Loại Tốt</a>
                                                </p>
                                            </div>
                                            <div class="price-wrapper">
                                                <span class="price-has-dropped">290,000đ</span>
                                                <span class="price-previous-dropped">560,000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="sidebar__product-wrapper">
                                        <div class="sidebar__product-img">
                                            <img src="./images/products/yoosee-3-rau-3m.jpg" alt="">
                                        </div>
                                        <div class="sidebar__product-text">
                                            <div class="title-wrapper">
                                                <p class="category-title">Camera Yoosee</p>
                                                <p class="product-name">
                                                    <a href="#">Camera Wifi Uniarch Uho-S2 Loại Tốt</a>
                                                </p>
                                            </div>
                                            <div class="price-wrapper">
                                                <span class="price-has-dropped">290,000đ</span>
                                                <span class="price-previous-dropped">560,000đ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="sidebar__product-wrapper">
                                        <div class="sidebar__product-img">
                                            <img src="./images/products/yoosee-3-rau-3m.jpg" alt="">
                                        </div>
                                        <div class="sidebar__product-text">
                                            <div class="title-wrapper">
                                                <p class="category-title">Camera Yoosee</p>
                                                <p class="product-name">
                                                    <a href="#">Camera Wifi Uniarch Uho-S2 Loại Tốt</a>
                                                </p>
                                            </div>
                                            <div class="price-wrapper">
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
            </div>
        </div>

        <div class="review__product">
            <div class="review__title">Đánh giá Camera Yoosee Ngoài Trời 5.0Mp – Nhìn Đêm Có Màu – Chống Nước – Đàm
                Thoại 2 Chiều (Mẫu Mới 2022)
            </div>

            <div class="star__box">
                <div class="star__average">
                    <strong>CHƯA CÓ
                        <br>
                        ĐÁNH GIÁ NÀO
                    </strong>
                </div>
                <div class="star__box-left">
                    <div class="reviews_bar">
                        <div class="review-row">
                            <div class="stars_value">5 <i class="fa-solid fa-star"></i></div>
                            <div class="rating_bar">
                                <div class="rating_scale"></div>
                            </div>
                            <span class="nums_review">
                                <b>0%</b>
                                | 0 đánh giá
                            </span>
                        </div>

                        <div class="review-row">
                            <div class="stars_value">4 <i class="fa-solid fa-star"></i></div>
                            <div class="rating_bar">
                                <div class="rating_scale"></div>
                            </div>
                            <span class="nums_review">
                                <b>0%</b>
                                | 0 đánh giá
                            </span>
                        </div>

                        <div class="review-row">
                            <div class="stars_value">3 <i class="fa-solid fa-star"></i></div>
                            <div class="rating_bar">
                                <div class="rating_scale"></div>
                            </div>
                            <span class="nums_review">
                                <b>0%</b>
                                | 0 đánh giá
                            </span>
                        </div>

                        <div class="review-row">
                            <div class="stars_value">2 <i class="fa-solid fa-star"></i></div>
                            <div class="rating_bar">
                                <div class="rating_scale"></div>
                            </div>
                            <span class="nums_review">
                                <b>0%</b>
                                | 0 đánh giá
                            </span>
                        </div>

                        <div class="review-row">
                            <div class="stars_value">1 <i class="fa-solid fa-star"></i></div>
                            <div class="rating_bar">
                                <div class="rating_scale"></div>
                            </div>
                            <span class="nums_review">
                                <b>0%</b>
                                | 0 đánh giá
                            </span>
                        </div>
                    </div>
                </div>
                <div class="star__box-right">
                    <a href="#" title="Đánh giá ngay" class="btn-reviews-now">Đánh giá ngay</a>
                </div>
            </div>

            <div class="review__form-wrapper"></div>

            <p class="no-review">Chưa có đánh giá nào.</p>
        </div>

        <div class="comment__product">
            <strong>Hỏi đáp</strong>
            <div class="comment__form">
                <form action="" method="post">
                    <div class="comment__input">
                        <textarea placeholder="Mời bạn tham gia thảo luận, vui lòng nhập tiếng Việt có dấu." name=""
                            id="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form__comment-bottom">
                        <div class="comment__gender-radio">
                            <div>
                                <input type="radio" value="male" checked name="comment_gender" id="male">
                                <label for="male">Anh</label>
                            </div>
                            <div>
                                <input type="radio" value="female" name="comment_gender" id="female">
                                <label for="female">Chị</label>
                            </div>
                        </div>
                        <div class="comment__name-input">
                            <input type="text" placeholder="Họ tên (bắt buộc)" name="" id="">
                        </div>
                        <div class="comment__email-input">
                            <input type="email" placeholder="Email" name="" id="">
                        </div>
                        <div class="comment__submit">
                            <button type="submit">Gửi</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="comment__list"></div>
        </div>
    </div>
</div>

<?php
}
?>
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
var swiper = new Swiper(".mySwiper", {
    slidesPerView: 5,
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
            slidesPerView: 3,
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
</script>