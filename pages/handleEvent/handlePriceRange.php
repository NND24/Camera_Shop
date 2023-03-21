<div class="row no-wrap products-category">
    <?php
    $mysqli = new mysqli("localhost", "root", "", "camera_shop");
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


    if ($_POST['priceRange'] == 1) {
        $sql_pro = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.id_danhmuc='$_GET[id]' AND tbl_sanpham.giasp < 500000 ORDER BY id_sanpham ASC LIMIT $begin,20";
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
                        <div class="row__item-img"
                            style="background: url('./admin/modules/quanlysp/handleEvent/uploads/<?php echo $row_pro['hinhanh'] ?>') no-repeat center center / cover">
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
                        <span
                            class="price-discount"><?php echo number_format($row_pro['giadagiam'], 0, ',', '.') ?>đ</span>
                        <span
                            class="price-normal-discount"><?php echo number_format($row_pro['giasp'], 0, ',', '.') ?>đ</span>
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
            ?>
    <?php
        } else {
        ?>
    <h1>Không có sản phẩm giá dưới 500.000đ</h1>
    <?php
        }
        ?>
    <?php
    } else if ($_POST['priceRange'] == 2) {
        $sql_pro = "SELECT * FROM tbl_sanpham WHERE tbl_sanpham.id_danhmuc='$_GET[id]' AND tbl_sanpham.giasp >= 500000 AND tbl_sanpham.giasp <= 2000000 ORDER BY id_sanpham ASC LIMIT $begin,20";
        $query_pro = mysqli_query($mysqli, $sql_pro);
        if (mysqli_num_rows($query_pro) > 0) {
            while ($row_pro = mysqli_fetch_array($query_pro)) {
        ?>
    <div class="col col-lg-2-4 col-md-3 col-4 mb-10">
        <div class="row__item item--product">
            <div class="row__item-container">
                <div class="row__item-display br-5">
                    <div class="view__product-detail" value="<?php echo $row_pro['id_sanpham'] ?>">
                        <div class="row__item-img"
                            style="background: url('./admin/modules/quanlysp/handleEvent/uploads/<?php echo $row_pro['hinhanh'] ?>') no-repeat center center / cover">
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
                        <span
                            class="price-discount"><?php echo number_format($row_pro['giadagiam'], 0, ',', '.') ?>đ</span>
                        <span
                            class="price-normal-discount"><?php echo number_format($row_pro['giasp'], 0, ',', '.') ?>đ</span>
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
            ?>
    <?php
        } else {
        ?>
    <h1>Không có sản phẩm giá từ 500.000đ đến 2.000.000đ</h1>
    <?php
        }
        ?>
    <?php
    }
    ?>
</div>