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
        <div class="main" id="main">
            <?php
            include('pages/header.php');
            // Lay ten danh muc
            $sql_cate = "SELECT * FROM tbl_danhmuc WHERE category_status=1 AND id_danhmuc='$_GET[id]' LIMIT 1 ";
            $query_cate = mysqli_query($mysqli, $sql_cate);
            $row_title = mysqli_fetch_array($query_cate);
            ?>

            <!-- Breadcrumb -->
            <div class="breadcrumb breadcrumb-shop">
                <div class="breadcrumb-wrapper">
                    <div class="view__home"><span>Trang chủ </span></div>
                    »
                    <span class="breadcrumb_last"><?php echo $row_title['ten_danhmuc'] ?></span>
                </div>
            </div>

            <!-- Shop page title -->
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="shop__page-title">
                        <h1><?php echo $row_title['ten_danhmuc'] ?></h1>
                    </div>
                </div>
            </div>

            <!--  -->
            <div class="row category__page-row">
                <div class="col-12 col-lg-12">
                    <div class="sidebar__filter">
                        <span>Lọc theo giá:</span>
                        <select class="price__list-filter">
                            <option value="0">Tất cả</option>
                            <option value="1">Dưới 500.000đ</option>
                            <option value="2">500.000đ đến 2.000.000đ</option>
                        </select>
                    </div>
                </div>

                <div class="col col-lg-12 mt-10">
                    <!-- Shop container -->
                    <div class="shop__container">

                        <div class="ordering">
                            <ul>
                                <li>Sắp xếp theo:</li>
                                <li><input checked class="filter__order" value="0" name="filter__order" id="filter__order-1" type="radio"><label for="filter__order-1">Mức
                                        độ phổ biến</label></li>
                                <li><input class="filter__order" value="1" name="filter__order" id="filter__order-2" type="radio"><label for="filter__order-2">Điểm
                                        đánh giá</label></li>
                                <li><input class="filter__order" value="2" name="filter__order" id="filter__order-3" type="radio"><label for="filter__order-3">Mới
                                        nhất</label></li>
                                <li><input class="filter__order" value="3" name="filter__order" id="filter__order-4" type="radio"><label for="filter__order-4">Giá
                                        thấp đến cao</label></li>
                                <li><input class="filter__order" value="4" name="filter__order" id="filter__order-5" type="radio"><label for="filter__order-5">Giá
                                        cao đến thấp</label></li>
                            </ul>
                        </div>
                        <?php
                        $sql_pro = "SELECT * FROM tbl_sanpham WHERE trangthaisp=1 AND tbl_sanpham.id_danhmuc='$_GET[id]'";
                        $query_pro = mysqli_query($mysqli, $sql_pro);
                        if (mysqli_num_rows($query_pro) > 0) { ?>
                            <div class="term__description">
                                <?php echo $row_title['category_detail']; ?>
                                <div class="load-more">
                                    <span>Xem thêm <i class="fa-solid fa-caret-down"></i></span>
                                </div>
                                <div class="collapse">
                                    <span>Thu gọn <i class="fa-solid fa-caret-up"></i></i></span>
                                </div>
                            </div>
                        <?php } ?>
                        <div id="load__product-row"> </div>
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

            // Load more description
            $(document).on("click", '.load-more', function() {
                $('.term__description').css('height', '100%');
                $('.load-more').css('display', 'none')
                $('.collapse').css('display', 'block')
            })

            // Collapse description
            $(document).on("click", '.collapse', function() {
                $('.term__description').css('height', '200px');
                $('.load-more').css('display', 'block')
                $('.collapse').css('display', 'none')
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

            $(document).on("click", '.view__home', function() {
                var url = "home.php";
                window.history.pushState("new", "title", url);
                $(".container").load("home.php");
                $(window).scrollTop(0);
            })

            var pageIndexMain = 1
            // View data
            view_data();

            function view_data() {
                $.post(' pages/handleEvent/listProductData.php?page=main&id=' +
                    '<?php echo $_GET['id'] ?>&pageIndex=' + pageIndexMain,
                    function(data) {
                        $('#load__product-row').html(data)
                    })
            }

            $(document).on("click", '.page-link.main', function() {
                pageIndexMain = $(this).attr("value");
                $.ajax({
                    url: ' pages/handleEvent/listProductData.php?page=main&id=' +
                        '<?php echo $_GET['id'] ?>&pageIndex=' + pageIndexMain,
                    data: {
                        pageIndex: pageIndexMain,
                    },
                    dataType: 'html',
                    method: "post",
                    cache: true,
                    success: function(data) {
                        view_data();
                    },
                    error: function() {
                        view_data();
                    }
                })
            })

            /* FILTER START */

            var pageIndexRange = 1
            var priceRange = 0;
            $(document).on("click", '.price__list-filter', function() {
                priceRange = $(this).val();
                $.ajax({
                    url: ' pages/handleEvent/handlePriceRange.php?id=' +
                        '<?php echo $_GET['id'] ?>&pageIndex=' + pageIndexRange,
                    data: {
                        priceRange: priceRange,
                    },
                    dataType: 'html',
                    method: "post",
                    cache: true,
                    success: function(data) {

                        if (priceRange == 1 || priceRange == 2) {
                            $('#load__product-row').html(data)
                            $('.ordering').html(
                                `
                            <ul>
                                <li>Sắp xếp theo:</li>
                                <li><input checked class="filter__order" value="0" name="filter__order" id="filter__order-1" type="radio"><label for="filter__order-1">Mức
                                        độ phổ biến</label></li>
                                <li><input class="filter__order" value="1" name="filter__order" id="filter__order-2" type="radio"><label for="filter__order-2">Điểm
                                        đánh giá</label></li>
                                <li><input class="filter__order" value="2" name="filter__order" id="filter__order-3" type="radio"><label for="filter__order-3">Mới
                                        nhất</label></li>
                                <li><input class="filter__order" value="3" name="filter__order" id="filter__order-4" type="radio"><label for="filter__order-4">Giá
                                        thấp đến cao</label></li>
                                <li><input class="filter__order" value="4" name="filter__order" id="filter__order-5" type="radio"><label for="filter__order-5">Giá
                                        cao đến thấp</label></li>
                            </ul>
                            `
                            )
                        } else {
                            view_data();
                        }
                    }
                })
            })

            $(document).on("click", '.page-link.order-range', function() {
                pageIndexRange = $(this).attr("value");
                $.ajax({
                    url: ' pages/handleEvent/handlePriceRange.php?id=' +
                        '<?php echo $_GET['id'] ?>&pageIndex=' + pageIndexRange,
                    data: {
                        pageIndex: pageIndexRange,
                        priceRange: priceRange,
                    },
                    dataType: 'html',
                    method: "post",
                    cache: true,
                    success: function(data) {
                        $('#load__product-row').html(data)
                        $('.ordering').html(
                            `
                            <ul>
                                <li>Sắp xếp theo:</li>
                                <li><input checked class="filter__order" value="0" name="filter__order" id="filter__order-1" type="radio"><label for="filter__order-1">Mức
                                        độ phổ biến</label></li>
                                <li><input class="filter__order" value="1" name="filter__order" id="filter__order-2" type="radio"><label for="filter__order-2">Điểm
                                        đánh giá</label></li>
                                <li><input class="filter__order" value="2" name="filter__order" id="filter__order-3" type="radio"><label for="filter__order-3">Mới
                                        nhất</label></li>
                                <li><input class="filter__order" value="3" name="filter__order" id="filter__order-4" type="radio"><label for="filter__order-4">Giá
                                        thấp đến cao</label></li>
                                <li><input class="filter__order" value="4" name="filter__order" id="filter__order-5" type="radio"><label for="filter__order-5">Giá
                                        cao đến thấp</label></li>
                            </ul>
                            `
                        )
                    },
                    error: function() {}
                })
            })

            var pageIndexOrder = 1;
            var value = 1;
            $(document).on("change", '.filter__order', function() {
                value = $(this).val();
                $.ajax({
                    url: ' pages/handleEvent/filterOrder.php?id=' +
                        '<?php echo $_GET['id'] ?>&pageIndex=' + pageIndexOrder,
                    data: {
                        value: value,
                        priceRange: priceRange,
                    },
                    dataType: 'html',
                    method: "post",
                    cache: true,
                    success: function(data) {
                        if (value == 0 || value == 1 || value == 2 || value == 3 || value ==
                            4) {
                            $('#load__product-row').html(data)
                        } else {
                            view_data();
                        }
                    }
                })
            })

            $(document).on("click", '.page-link.order', function() {
                pageIndexOrder = $(this).attr("value");
                $.ajax({
                    url: ' pages/handleEvent/filterOrder.php?id=' +
                        '<?php echo $_GET['id'] ?>&pageIndex=' + pageIndexOrder,
                    data: {
                        pageIndex: pageIndexOrder,
                        priceRange: priceRange,
                        value: value,
                    },
                    dataType: 'html',
                    method: "post",
                    cache: true,
                    success: function(data) {
                        $('#load__product-row').html(data)
                    },
                    error: function() {}
                })
            })
            /* FILTER END */
        })
    </script>
</body>

</html>