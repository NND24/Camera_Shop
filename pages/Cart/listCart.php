<?php
session_start();
include('../../admin/config/config.php');
if (isset($_SESSION['id_user'])) {
    $item_per_page = 3;
    $current_page = $_GET['pageIndex'];
    $offset = ($current_page - 1) * $item_per_page;

    $sosp = 0;
    $tongtien = 0;

    $sql_cart = "SELECT * FROM tbl_cart, tbl_sanpham WHERE tbl_cart.id_sanpham=tbl_sanpham.id_sanpham AND id_user='$_SESSION[id_user])'  LIMIT " . $item_per_page . " OFFSET " . $offset . " ";
    $query_cart = mysqli_query($mysqli, $sql_cart);

    $totalRecords = mysqli_query($mysqli, "SELECT * FROM tbl_cart, tbl_sanpham WHERE tbl_cart.id_sanpham=tbl_sanpham.id_sanpham AND id_user='$_SESSION[id_user])'");
    $totalRecords = mysqli_num_rows($totalRecords);
    $totalPages = ceil($totalRecords / $item_per_page);

    while ($row_cart = mysqli_fetch_array($query_cart)) {
        if ($row_cart['id_user'] == $_SESSION['id_user']) {
            $sosp += $row_cart['amount'];
            $thanhtien = $row_cart['amount'] * $row_cart['giadagiam'];
            $thanhtien = round($thanhtien, -3);
            $tongtien += $thanhtien;
            $tongtien = round($tongtien, -3);
            @$sql_danhmuc = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc='$row_cart[id_danhmuc]' LIMIT 1";
            $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
            $row_danhmuc = mysqli_fetch_array($query_danhmuc)
?>
            <div class="row no-wrap border-bottom">
                <div class="row  no-wrap cart align-items-center cart__wrapper">
                    <div class="col-lg-1-5 col cart__img-product view__product-detail" value="<?php echo $row_cart['id_sanpham'] ?>"><img class="img-fluid" src="./admin/modules/quanlysp/handleEvent/uploads/<?php echo $row_cart['hinhanh'] ?>">
                    </div>

                    <div class="col-lg-2-4 col ">
                        <div class="row text-muted cart__name-category category__product-btn" value="<?php echo $row_danhmuc['id_danhmuc'] ?>">
                            <?php echo $row_danhmuc['ten_danhmuc'] ?></div>
                        <div class="row cart__name-product view__product-detail" value="<?php echo $row_cart['id_sanpham'] ?>">
                            <?php echo $row_cart['tensanpham'] ?></div>
                    </div>
                    <div class="col justify-content-center hide-on-mobile-425">
                        <?php echo number_format($row_cart['giadagiam'], 0, ',', '.') ?>đ</div>


                    <div class="col">
                        <div class="quantity_button-wrapper">
                            <a class="minus-quantity-btn" value="<?php echo $row_cart['id_sanpham'] ?>"><input type="button" value="-" class="minus-quantity button-quantity"></a>
                            <input type="number" readonly class="input-text" step="1" min="1" value="<?php echo $row_cart['amount'] ?>" id="quantity" placeholder inputmode="numeric">
                            <a class="plus-quantity-btn" value="<?php echo $row_cart['id_sanpham'] ?>"><input type="button" value="+" class="plus-quantity button-quantity"></a>
                        </div>
                    </div>
                    <div class="col d-flex justify-content-between">
                        <?php echo number_format($thanhtien, 0, ',', '.')  ?>đ
                        <a value="<?php echo $row_cart['id_sanpham'] ?>" class="cart__delete-btn">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    <div class="d-flex justify-content-between mb-3">
        <div class="back-to-shop">
            <a class="back-to-shop-btn">
                <span class="text-muted">TIẾP TỤC MUA SẮM</span>
            </a>
        </div>

        <div class="pagination__wrapper ">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php

                    if ($current_page > 3) {
                        $first_page = 1;
                    ?>
                        <li class="page-item">
                            <a class="page-link cart first-page-shopPage" value="<?php echo $first_page ?>"><i class="fa-solid fa-angles-left"></i></a>
                        </li>
                    <?php
                    }
                    if ($current_page > 1) {
                        $prev_page = $current_page - 1;
                    ?>
                        <li class="page-item">
                            <a class="page-link cart prev-page-shopPage" value="<?php echo $current_page - 1 ?>"><i class="fa-solid fa-angle-left"></i></a>
                        </li>
                    <?php } ?>

                    <?php for ($num = 1; $num <= $totalPages; $num++) { ?>
                        <?php if ($num != $current_page) { ?>
                            <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
                                <li class="page-item <?php echo ($current_page == $num) ? 'active' : '' ?>"><a class="page-link cart" value="<?php echo $num ?>"><?php echo $num ?></a></li>
                            <?php } ?>
                        <?php } else { ?>
                            <li class="page-item <?php echo ($current_page == $num) ? 'active' : '' ?>"><a class="page-link cart" value="<?php echo $num ?>"><?php echo $num ?></a></li>
                        <?php } ?>
                    <?php } ?>


                    <?php
                    if ($current_page < $totalPages - 1) {
                        $next_page = $current_page + 1;
                    ?>
                        <li class=" page-item">
                            <a class="page-link cart next-page-shopPage" value="<?php echo $current_page + 1 ?>"><i class="fa-solid fa-angle-right"></i></a>
                        </li>
                    <?php
                    }
                    if ($current_page < $totalPages - 3) {
                        $end_page = $totalPages;
                    ?>
                        <li class="page-item">
                            <a class="page-link cart last-page-shopPage" value="<?php echo $end_page ?>"><i class="fa-solid fa-angles-right"></i></a>
                        </li>
                    <?php
                    }
                    ?>

                </ul>
            </nav>
        </div>

        <div class="delete-all-cart">
            <span class="delete-all-cart-btn">Xóa tất cả</span>

        </div>
    </div>
<?php
}
?>