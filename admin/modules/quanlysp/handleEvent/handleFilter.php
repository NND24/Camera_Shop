<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
$item_per_page = 7;
$current_page = $_GET['pageIndex'];
$offset = ($current_page - 1) * $item_per_page;

$status = $_POST['status'];
$name = $_POST['name'];
$price = $_POST['price'];
$amount = $_POST['amount'];
$discount = $_POST['discount'];
$soldAmount = $_POST['soldAmount'];
$rating = $_POST['rating'];
$dated = $_POST['dated'];

$sql_lietke_sp = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc 
AND (($status = 0 AND tbl_sanpham.trangthaisp = 0)
OR   ($status = 1 AND tbl_sanpham.trangthaisp = 1)
OR   ($status = 2 AND (tbl_sanpham.trangthaisp = 0  OR tbl_sanpham.trangthaisp = 1)))
ORDER BY 
    CASE WHEN $name = 0 AND $price = 2 AND $amount = 2 AND $discount = 2 AND $soldAmount = 2 AND $rating = 2 AND $dated = 2 THEN tensanpham  END DESC,
    CASE WHEN $name = 0 AND $price = 0 AND $amount = 2 AND $discount = 2 AND $soldAmount = 2 AND $rating = 2 AND $dated = 2 THEN tensanpham AND giadagiam END DESC,
    CASE WHEN $name = 1 AND $price = 2 AND $amount = 2 AND $discount = 2 AND $soldAmount = 2 AND $rating = 2 AND $dated = 2  THEN tensanpham  END ASC,

    CASE WHEN $price = 0 AND $name = 2 AND $amount = 2 AND $discount = 2 AND $soldAmount = 2 AND $rating = 2 AND $dated = 2 THEN giadagiam END DESC,
    CASE WHEN $price = 1 AND $name = 2 AND $amount = 2 AND $discount = 2 AND $soldAmount = 2 AND $rating = 2 AND $dated = 2 THEN giadagiam END ASC,
    CASE WHEN $amount = 0 AND $name = 2 AND $price = 2 AND $discount = 2 AND $soldAmount = 2 AND $rating = 2 AND $dated = 2 THEN soluong END DESC,
    CASE WHEN $amount = 1 AND $name = 2 AND $price = 2 AND $discount = 2 AND $soldAmount = 2 AND $rating = 2 AND $dated = 2 THEN soluong END ASC,

    CASE WHEN $discount = 0 AND $name = 2 AND $price = 2 AND $amount = 2 AND $soldAmount = 2 AND $rating = 2 AND $dated = 2 THEN giamgia END DESC,
    CASE WHEN $discount = 1 AND $name = 2 AND $price = 2 AND $amount = 2 AND $soldAmount = 2 AND $rating = 2 AND $dated = 2 THEN giamgia END ASC,

    CASE WHEN $soldAmount = 0 AND $name = 2 AND $price = 2 AND $amount = 2 AND $discount = 2 AND $rating = 2 AND $dated = 2 THEN daban END DESC,
    CASE WHEN $soldAmount = 1 AND $name = 2 AND $price = 2 AND $amount = 2 AND $discount = 2 AND $rating = 2 AND $dated = 2 THEN daban END ASC,

    CASE WHEN $rating = 0 AND $name = 2 AND $price = 2 AND $amount = 2 AND $discount = 2 AND $soldAmount = 2 AND $dated = 2 THEN average_rating END DESC,
    CASE WHEN $rating = 1 AND $name = 2 AND $price = 2 AND $amount = 2 AND $discount = 2 AND $soldAmount = 2 AND $dated = 2 THEN average_rating END ASC,
    
    CASE WHEN $dated = 0 AND $name = 2 AND $price = 2 AND $amount = 2 AND $discount = 2 AND $rating = 2 AND $soldAmount = 2 THEN last_updated END ASC,
    CASE WHEN $dated = 1 AND $name = 2 AND $price = 2 AND $amount = 2 AND $discount = 2 AND $rating = 2 AND $soldAmount = 2 THEN last_updated END DESC,

    
    CASE WHEN $name = 2 AND $price = 2 AND $amount = 2 AND $discount = 2 AND $soldAmount = 2 AND $rating = 2 AND $dated = 2  THEN id_sanpham  END DESC
LIMIT " . $item_per_page . " OFFSET " . $offset . " ";
$query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);


$totalRecords = mysqli_query($mysqli, "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc
AND (($status = 0 AND tbl_sanpham.trangthaisp = 0)
OR   ($status = 1 AND tbl_sanpham.trangthaisp = 1)
OR   ($status = 2 AND (tbl_sanpham.trangthaisp = 0  OR tbl_sanpham.trangthaisp = 1)))");
$totalRecords = mysqli_num_rows($totalRecords);
$totalPages = ceil($totalRecords / $item_per_page);
if (mysqli_num_rows($query_lietke_sp) > 0) {
    while ($row = mysqli_fetch_array($query_lietke_sp)) {
?>
        <div class="products-row">
            <div class="product-cell col-2-4 image">
                <img src="modules/quanlysp/handleEvent/uploads/<?php echo $row['hinhanh'] ?>" alt="product">
                <span title="<?php echo $row['tensanpham'] ?>"><?php echo $row['tensanpham'] ?></span>
            </div>
            <div class="product-cell col-1-8 category ">
                <p><?php echo $row['ten_danhmuc'] ?></p>
            </div>
            <div class="product-cell col-1-5 status-cell">
                <?php
                if ($row['trangthaisp'] == 1) {
                ?>
                    <span class="status active">Kích hoạt</span>
                <?php
                } else if ($row['trangthaisp'] == 0) {
                ?>
                    <span class="status">Ẩn</span>
                <?php
                }
                ?>
            </div>
            <div class="product-cell col-2 sales">
                <?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                echo date('d/m/Y H:i', $row['created_time']) ?></div>
            <div class="product-cell col-2 stock"><?php echo date('d/m/Y H:i', $row['last_updated']) ?></div>
            <div class="product-cell col-1-8 detail">
                <button title="Xem chi tiết" class="detail-product" value="<?php echo $row['id_sanpham'] ?>"><span>Xem
                        chi tiết</span></button>
            </div>
            <div class="product-cell col btn">
                <button title="Xóa" class="remove-product" value="<?php echo $row['id_sanpham'] ?>"><i class="fa-solid fa-trash"></i></button>
            </div>
            <div class="product-cell col btn">
                <button title="Sửa" class="edit-product" value="<?php echo $row['id_sanpham'] ?>"><i class="fa-regular fa-pen-to-square"></i></button>
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
                        <a class="page-link filter first-page-shopPage" value="<?php echo $first_page ?>"><i class="fa-solid fa-angles-left"></i></a>
                    </li>
                <?php
                }
                if ($current_page > 1) {
                    $prev_page = $current_page - 1;
                ?>
                    <li class="page-item">
                        <a class="page-link filter prev-page-shopPage" value="<?php echo $current_page - 1 ?>"><i class="fa-solid fa-angle-left"></i></a>
                    </li>
                <?php } ?>

                <?php for ($num = 1; $num <= $totalPages; $num++) { ?>
                    <?php if ($num != $current_page) { ?>
                        <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
                            <li class="page-item <?php echo ($current_page == $num) ? 'active' : '' ?>"><a class="page-link filter" value="<?php echo $num ?>"><?php echo $num ?></a></li>
                        <?php } ?>
                    <?php } else { ?>
                        <li class="page-item <?php echo ($current_page == $num) ? 'active' : '' ?>"><a class="page-link filter" value="<?php echo $num ?>"><?php echo $num ?></a></li>
                    <?php } ?>
                <?php } ?>


                <?php
                if ($current_page < $totalPages - 1) {
                    $next_page = $current_page + 1;
                ?>
                    <li class=" page-item">
                        <a class="page-link filter next-page-shopPage" value="<?php echo $current_page + 1 ?>"><i class="fa-solid fa-angle-right"></i></a>
                    </li>
                <?php
                }
                if ($current_page < $totalPages - 3) {
                    $end_page = $totalPages;
                ?>
                    <li class="page-item">
                        <a class="page-link filter last-page-shopPage" value="<?php echo $end_page ?>"><i class="fa-solid fa-angles-right"></i></a>
                    </li>
                <?php
                }
                ?>

            </ul>
        </nav>
    </div>
<?php
} else {
?>
    <h1 class="empty-row">Chưa có sản phẩm nào</h1>
<?php
}
?>