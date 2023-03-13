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
            $sql_pro = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.id_danhmuc='$_GET[id]' ORDER BY id_sanpham ASC LIMIT $begin,20";
            $query_pro = mysqli_query($mysqli, $sql_pro);
            // Lay ten danh muc
            $sql_cate = "SELECT * FROM tbl_danhmuc WHERE tbl_danhmuc.id_danhmuc='$_GET[id]' LIMIT 1 ";
            $query_cate = mysqli_query($mysqli, $sql_cate);
            $row_title = mysqli_fetch_array($query_cate);
            ?>

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
                            <li>Giá cao đến thấp</li>
                        </ul>
                    </div>

                    <!-- Shop container -->
                    <div class="shop__container">
                        <div class="term__description">
                            <?php echo $row_title['category_detail'] ?>
                        </div>

                        <div class="row no-wrap products-category">
                            <?php
                            while ($row_pro = mysqli_fetch_array($query_pro)) {
                            ?>
                                <div class="col col-lg-3 col-md-4 col-4 mb-10">
                                    <div class="row__item item--product">
                                        <div class="row__item-container">
                                            <div class="row__item-display br-5">
                                                <div class="view__product-detail" value="<?php echo $row_pro['id_sanpham'] ?>">
                                                    <div class="row__item-img" style="background: url('./admin/modules/quanlysp/handleEvent/uploads/<?php echo $row_pro['hinhanh'] ?>') no-repeat center center / cover">
                                                    </div>
                                                </div>
                                                <div class="add-to-cart-btn">
                                                    <form method="POST" action="pages/main/addToCart.php?idsanpham=<?php echo $row_pro['id_sanpham'] ?>">
                                                        <i class="fa-solid fa-cart-plus"></i>
                                                        <input name="themgiohang" type="submit" value="Thêm vào giỏ hàng">
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="row__item-info">
                                                <a href="#" class="row__info-name"><?php echo $row_pro['tensanpham'] ?></a>
                                                <div class="price__wrapper">
                                                    <span class="price-has-dropped"><?php echo number_format($row_pro['giasp'], 0, ',', '.') ?>đ</span>
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
        </div>
    </div>
    <?php
    include('pages/footer.php');
    ?>
    <script>
        $(document).ready(() => {
            $(document).on("click", '.view__product-detail', function() {
                var id = $(this).attr("value");
                console.log(id)
                var url = "chitietsanpham.php?id=" + id;
                window.history.pushState("new", "title", url);
                $("#main").load("chitietsanpham.php?id=" + id);
            })
        })
    </script>
</body>

</html>