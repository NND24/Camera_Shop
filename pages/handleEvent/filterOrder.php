<div class="row no-wrap products-category">
    <?php
    $mysqli = new mysqli("localhost", "root", "", "camera_shop");
    $item_per_page = 15;
    $current_page = $_GET['pageIndex'];
    $offset = ($current_page - 1) * $item_per_page;

    $value = $_POST['value'];
    $priceRange = $_POST['priceRange'];
    $sql_pro = "SELECT * FROM tbl_sanpham 
    WHERE tbl_sanpham.id_danhmuc='$_GET[id]' 
    AND (($priceRange = 0 AND tbl_sanpham.giasp > 0)
         OR ($priceRange = 1 AND tbl_sanpham.giasp < 500000)
         OR ($priceRange = 2 AND tbl_sanpham.giasp >= 500000 AND tbl_sanpham.giasp <= 2000000))
    ORDER BY 
        CASE WHEN $value = 0 THEN daban END ASC,
        CASE WHEN $value = 1 THEN average_rating END DESC,
        CASE WHEN $value = 2 THEN last_updated END ASC,
        CASE WHEN $value = 3 THEN giadagiam END ASC,
        CASE WHEN $value = 4 THEN giadagiam END DESC
      
        LIMIT " . $item_per_page . " OFFSET " . $offset . " 
    ";
    $query_pro = mysqli_query($mysqli, $sql_pro);

    $totalRecords = mysqli_query($mysqli, "SELECT * FROM tbl_sanpham 
    WHERE tbl_sanpham.id_danhmuc='$_GET[id]' 
    AND (($priceRange = 0 AND tbl_sanpham.giasp > 0)
         OR ($priceRange = 1 AND tbl_sanpham.giasp < 500000)
         OR ($priceRange = 2 AND tbl_sanpham.giasp >= 500000 AND tbl_sanpham.giasp <= 2000000))");
    $totalRecords = mysqli_num_rows($totalRecords);
    $totalPages = ceil($totalRecords / $item_per_page);
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

    <div class="pagination__wrapper ">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php
                if ($current_page > 3) {
                    $first_page = 1;
                ?>
                <li class="page-item">
                    <a class="page-link order first-page-shopPage" value="<?php echo $first_page ?>"><i
                            class="fa-solid fa-angles-left"></i></a>
                </li>
                <?php
                }
                if ($current_page > 1) {
                    $prev_page = $current_page - 1;
                ?>
                <li class="page-item">
                    <a class="page-link order prev-page-shopPage" value="<?php echo $current_page - 1 ?>"><i
                            class="fa-solid fa-angle-left"></i></a>
                </li>
                <?php } ?>

                <?php for ($num = 1; $num <= $totalPages; $num++) { ?>
                <?php if ($num != $current_page) { ?>
                <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
                <li class="page-item <?php echo ($current_page == $num) ? 'active' : '' ?>"><a class="page-link order"
                        value="<?php echo $num ?>"><?php echo $num ?></a></li>
                <?php } ?>
                <?php } else { ?>
                <li class="page-item <?php echo ($current_page == $num) ? 'active' : '' ?>"><a class="page-link order"
                        value="<?php echo $num ?>"><?php echo $num ?></a></li>
                <?php } ?>
                <?php } ?>


                <?php
                if ($current_page < $totalPages - 1) {
                    $next_page = $current_page + 1;
                ?>
                <li class=" page-item">
                    <a class="page-link order next-page-shopPage" value="<?php echo $current_page + 1 ?>"><i
                            class="fa-solid fa-angle-right"></i></a>
                </li>
                <?php
                }
                if ($current_page < $totalPages - 3) {
                    $end_page = $totalPages;
                ?>
                <li class="page-item">
                    <a class="page-link order last-page-shopPage" value="<?php echo $end_page ?>"><i
                            class="fa-solid fa-angles-right"></i></a>
                </li>
                <?php
                }
                ?>

            </ul>
        </nav>
    </div>

</div>