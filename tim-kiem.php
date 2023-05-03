<?php
include('./admin/config/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPM Camera</title>
    <?php include('./js/link.php'); ?>
</head>

<body>
    <div class="container">
        <div class="main" id="main">
            <?php
            include('pages/header.php');
            ?>

            <!-- Breadcrumb -->
            <div class="breadcrumb breadcrumb-shop">
                <div class="breadcrumb-wrapper">
                    <div class="view__home"><span>Trang chủ </span></div>
                    »
                    <span class="breadcrumb_last">Tìm kiếm</span>
                </div>
            </div>

            <!-- Shop page title -->
            <div class="row">
                <div class="col col-lg-12">
                    <div class="shop__page-title">
                        <h1>Tìm kiếm: <?php
                                        $modified_string = str_replace('-', ' ', $_GET['tukhoa']);
                                        echo $modified_string ?></h1>
                    </div>
                </div>
            </div>

            <!--  -->
            <div class="row category__page-row">

                <div class="col col-lg-12 mt-10">
                    <!-- Shop container -->
                    <div class="shop__container">

                        <div id="load__product-search">
                            <div class="row no-wrap products-category">
                                <?php
                                $sql_pro = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc AND
    tbl_sanpham.tensanpham LIKE '%" . $modified_string . "%'";
                                $query_pro = mysqli_query($mysqli, $sql_pro);
                                if (mysqli_num_rows($query_pro) > 0) {
                                    while ($row_pro = mysqli_fetch_array($query_pro)) {
                                ?>
                                        <div class="col col-lg-2-4 col-md-3 col-4 mb-10">
                                            <div class="row__item item--product">
                                                <div class="row__item-container">
                                                    <?php if ($row_pro['giamgia'] > 0) { ?>
                                                        <div class="discount-banner">
                                                            Giảm <?php echo $row_pro['giamgia'] ?>%
                                                        </div>
                                                    <?php } ?>
                                                    <div class="row__item-display br-5">

                                                        <div class="view__product-detail" value="<?php echo $row_pro['id_sanpham'] ?>">
                                                            <div class="row__item-img" style="background: url('./admin/modules/quanlysp/handleEvent/uploads/<?php echo $row_pro['hinhanh'] ?>') no-repeat center center / cover">
                                                            </div>
                                                        </div>
                                                        <div class="add-to-cart-btn" value="<?php echo $row_pro['id_sanpham'] ?>">
                                                            <i class="fa-solid fa-cart-plus"></i>
                                                            <span>Thêm vào giỏ hàng</span>
                                                        </div>
                                                    </div>
                                                    <div class="row__item-info">
                                                        <div class="view__product-detail" value="<?php echo $row_pro['id_sanpham'] ?>">
                                                            <div class="row__info-name">
                                                                <span style="cursor:pointer;"><?php echo $row_pro['tensanpham'] ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="price__wrapper">
                                                            <?php
                                                            if ($row_pro['giamgia'] > 0) {
                                                            ?>
                                                                <span class="price-discount"><?php echo number_format($row_pro['giadagiam'], 0, ',', '.') ?>đ</span>
                                                                <span class="price-normal-discount"><?php echo number_format($row_pro['giasp'], 0, ',', '.') ?>đ</span>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <span class="price-normal"><?php echo number_format($row_pro['giasp'], 0, ',', '.') ?>đ</span>
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
                                } else {
                                    ?>
                                    <h1>Không tìm thấy sản phẩm</h1>
                                <?php  } ?>
                            </div>
                        </div>

                    </div>
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

    <script>
        $(document).ready(() => {
            // View product detail
            $(document).on("click", '.view__product-detail', function() {
                var id = $(this).attr("value");
                var url = "san-pham.php?id=" + id;
                window.history.pushState("new", "title", url);
                $(".container").load("san-pham.php?id=" + id);
                $(window).scrollTop(0);
                window.location.reload();
            })

            // Quay ve trang chu
            $(document).on("click", '.view__home', function() {
                var url = "index.php";
                window.history.pushState("new", "title", url);
                $(".container").load("index.php");
                $(window).scrollTop(0);
            })
        })
    </script>
</body>

</html>