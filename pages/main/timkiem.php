<?php
if (isset($_POST['timkiem'])) {
    $tukhoa = $_POST['tukhoa'];
}
$sql_pro = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc AND
    tbl_sanpham.tensanpham LIKE '%" . $tukhoa . "%'";
$query_pro = mysqli_query($mysqli, $sql_pro);
$row_pro = mysqli_fetch_array($query_pro)
?>

<link rel="stylesheet" href="css/shopPage.css">
<!-- Breadcrumb -->
<div class="breadcrumb">
    <span>
        <span>
            <a href="index.php">Trang chủ</a>
        </span>
        »
        <span class="breadcrumb_last">Sản phẩm tìm kiếm</span>
    </span>
</div>

<!-- Shop page title -->
<div class="row">
    <div class="col col-lg-12">
        <div class="shop__page-title">
            <h1>Từ khóa tìm kiếm: <?php echo $tukhoa ?></h1>
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

            <div class="row no-wrap products-category">
                <?php
                if ($row_pro) {
                    while ($row_pro) {
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
                } else {
                    ?>
                <span>KHÔNG TÌM THẤY SẢN PHẨM</span>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>