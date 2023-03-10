<?php
if (isset($_GET['trang'])) {
    $page = $_GET['trang'];
} else {
    $page = '';
}
if ($page == '' || $page == 1) {
    $begin = 0;
} else {
    $begin = ($page * 3) - 3;
}
$sql_pro = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.id_danhmuc='$_GET[id]' ORDER BY id_sanpham DESC LIMIT $begin,20";
$query_pro = mysqli_query($mysqli, $sql_pro);
// Lay ten danh muc
$sql_cate = "SELECT * FROM tbl_danhmuc WHERE tbl_danhmuc.id_danhmuc='$_GET[id]' LIMIT 1 ";
$query_cate = mysqli_query($mysqli, $sql_cate);
$row_title = mysqli_fetch_array($query_cate);
?>

<link rel="stylesheet" href="css/shopPage.css">

<!-- Breadcrumb -->
<div class="breadcrumb">
    <span>
        <span>
            <a href="index.php">Trang chủ</a>
        </span>
        »
        <span class="breadcrumb_last"><?php echo $row_title['ten_danhmuc'] ?></span>
    </span>
</div>

<!-- Shop page title -->
<div class="row">
    <div class="col col-lg-12">
        <div class="shop__page-title">
            <h1><?php echo $row_title['ten_danhmuc'] ?></h1>
        </div>
    </div>
</div>

<!--  -->
<div class="row category__page-row">
    <div class="col col-lg-12">
        <div class="sidebar__filter">
            <p>Bộ lọc:</p>
            <div class="price__list-filter">
                <span class="price__filter-title">Lọc theo giá<i class="fa-solid fa-chevron-down"></i></span>
            </div>
        </div>
    </div>
    <div class="col col-lg-12 mt-10">
        <div class="ordering">
            <ul>
                <li>Sắp xếp theo:</li>
                <li>Mức độ phổ biến</li>
                <li>Điểm đánh giá</li>
                <li>Mới nhất</li>
                <li>Giá thấp đến cao</li>
                <li>Gía cao đến thấp</li>
            </ul>
        </div>

        <!-- Shop container -->
        <div class="shop__container">
            <!-- <div class="term__description">
                <h2>Camera Yoosee</h2>
                <p>Camera Yoosee là dòng camera wifi bán chạy nhất hiện nay. Nhờ các tính năng thông minh dễ sử dụng.
                    Hình ảnh sắc nét tốt độ phân giải cao. đặc biệt giá thành rẻ. Dòng camera này nổi tiếng với 3 mẫu
                    sản phẩm bán chạy nhất hiện nay gồm:</p>
                <ul>
                    <li>Sản phẩm Camera 3 Râu</li>
                    <li>Sản phẩm camera ngoài trời</li>
                    <li>Sản phẩm camera PTZ quay quét.</li>
                </ul>
                <h2>Tính năng camera</h2>
                <ul>
                    <li>Tích hợp <strong>camera wifi</strong> kết nối không dây siêu nhanh.</li>
                    <li>Mắt camera quan sát siêu nhỏ</li>
                    <li>Tích hợp kiểu dáng nhỏ gọn</li>
                    <li>Tích hợp quay liên tục 24/24h</li>
                    <li>Hình ảnh chuẩn Full HD.</li>
                    <li>Hỗ trợ file&nbsp; xem lại Mp4.</li>
                    <li>Thu được cả âm thanh.</li>
                    <li>Đàm thoại 2 chiều.</li>
                    <li>Đặc biệt kết nối wifi dễ dàng. Điều khiển trực tiếp qua điện thoại.</li>
                    <li>Lắp đặt dễ dàng. Một số dòng tích hợp Pin hoạt động độc lập.</li>
                </ul>
            </div> -->

            <div class="row no-wrap products-category">
                <?php
                while ($row_pro = mysqli_fetch_array($query_pro)) {
                ?>
                <div class="col col-lg-3 col-md-4 col-4 mb-10">
                    <div class="row__item item--product">
                        <div class="row__item-container">
                            <div class="row__item-display br-5">
                                <a href="index.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham'] ?>">
                                    <div class="row__item-img"
                                        style="background: url('./admin/modules/quanlysp/uploads/<?php echo $row_pro['hinhanh'] ?>') no-repeat center center / cover">
                                    </div>
                                </a>
                                <div class="add-to-cart-btn">
                                    <form method="POST"
                                        action="pages/main/addToCart.php?idsanpham=<?php echo $row_pro['id_sanpham'] ?>">
                                        <i class="fa-solid fa-cart-plus"></i>
                                        <input name="themgiohang" type="submit" value="Thêm vào giỏ hàng">
                                    </form>
                                </div>
                            </div>
                            <div class="row__item-info">
                                <a href="#" class="row__info-name"><?php echo $row_pro['tensanpham'] ?></a>
                                <div class="price__wrapper">
                                    <span
                                        class="price-has-dropped"><?php echo number_format($row_pro['giasp'], 0, ',', '.') ?>đ</span>
                                    <span class="price-previous-dropped">560,000đ</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>

            <?php
            $sql_trang = mysqli_query($mysqli, "SELECT * FROM tbl_sanpham");
            $row_count = mysqli_num_rows($sql_trang);
            $trang = ceil($row_count / 20)
            ?>
            <ul class="page__pagination col-8">
                <li class="page__btn"><i class="fa-solid fa-angles-left"></i></li>
                <li class="page__btn"><i class="fa-solid fa-chevron-left"></i></li>

                <?php
                for ($i = 1; $i <= $trang; $i++) {
                ?>
                <li class="page__numbers <?php if ($i == $page) {
                                                    echo "active";
                                                } ?>">
                    <a href="index.php?quanly=danhmucsanpham&id=1&trang=<?php echo $i ?>"><?php echo $i ?></a>
                </li>
                <?php
                }
                ?>

                <!--  <li class="page__numbers active">2</li> -->
                <!-- <li class="page__dots">...</li> -->
                <li class="page__btn"><i class="fa-solid fa-chevron-right"></i></li>
                <li class="page__btn"><i class="fa-solid fa-angles-right"></i></li>
            </ul>
        </div>
    </div>
</div>