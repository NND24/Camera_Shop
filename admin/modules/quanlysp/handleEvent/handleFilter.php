<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
$item_per_page = 7;
$current_page = $_GET['pageIndex'];
$offset = ($current_page - 1) * $item_per_page;

$status = $_POST['status'];
$category = $_POST['category'];
$filter = $_POST['filter'];

$sql_sp = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc 
AND (($status = 0 AND tbl_sanpham.trangthaisp = 0 AND $category = 0)
OR   ($status = 0 AND tbl_sanpham.trangthaisp = 0 AND tbl_sanpham.id_danhmuc = $category AND $category != 0)
OR   ($status = 1 AND tbl_sanpham.trangthaisp = 1 AND $category = 0)
OR   ($status = 1 AND tbl_sanpham.trangthaisp = 1 AND tbl_sanpham.id_danhmuc = $category AND $category != 0)
OR   ($status = 2 AND (tbl_sanpham.trangthaisp = 0  OR tbl_sanpham.trangthaisp = 1) AND $category = 0)
OR   ($status = 2 AND (tbl_sanpham.trangthaisp = 0  OR tbl_sanpham.trangthaisp = 1) AND tbl_sanpham.id_danhmuc = $category AND $category != 0))
ORDER BY 
    CASE WHEN $filter = -1 THEN id_sanpham END DESC,
    CASE WHEN $filter = 0 THEN tensanpham END DESC,
    CASE WHEN $filter = 1 THEN tensanpham END ASC,
    CASE WHEN $filter = 2 THEN giadagiam END DESC,
    CASE WHEN $filter = 3 THEN giadagiam END ASC,
    CASE WHEN $filter = 4 THEN soluong END DESC,
    CASE WHEN $filter = 5 THEN soluong END ASC,
    CASE WHEN $filter = 6 THEN giamgia END DESC,
    CASE WHEN $filter = 7 THEN giamgia END ASC,
    CASE WHEN $filter = 8 THEN daban END DESC,
    CASE WHEN $filter = 9 THEN daban END ASC,
    CASE WHEN $filter = 10 THEN average_rating END DESC,
    CASE WHEN $filter = 11 THEN average_rating END ASC,
    CASE WHEN $filter = 12 THEN last_updated END ASC,
    CASE WHEN $filter = 13 THEN last_updated END DESC
LIMIT " . $item_per_page . " OFFSET " . $offset . " ";
$query_sp = mysqli_query($mysqli, $sql_sp);

$sql_privilege = "SELECT * FROM tbl_privilege WHERE id_admin='" . $_SESSION['dangnhap'] . "' LIMIT 1";
$query_privilege = mysqli_query($mysqli, $sql_privilege);
$row_privilege = mysqli_fetch_array($query_privilege);

$totalRecords = mysqli_query($mysqli, "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc
AND (($status = 0 AND tbl_sanpham.trangthaisp = 0 AND $category = 0)
OR   ($status = 0 AND tbl_sanpham.trangthaisp = 0 AND $category = 0 AND tbl_sanpham.id_danhmuc = $category AND $category != 0)
OR   ($status = 1 AND tbl_sanpham.trangthaisp = 1 AND $category = 0)
OR   ($status = 1 AND tbl_sanpham.trangthaisp = 1 AND tbl_sanpham.id_danhmuc = $category AND $category != 0)
OR   ($status = 2 AND (tbl_sanpham.trangthaisp = 0  OR tbl_sanpham.trangthaisp = 1) AND $category = 0)
OR   ($status = 2 AND (tbl_sanpham.trangthaisp = 0  OR tbl_sanpham.trangthaisp = 1) AND tbl_sanpham.id_danhmuc = $category AND $category != 0))");
$totalRecords = mysqli_num_rows($totalRecords);
$totalPages = ceil($totalRecords / $item_per_page);
if (mysqli_num_rows($query_sp) > 0) {
    while ($row = mysqli_fetch_array($query_sp)) {
?>
<div class="products-row">
    <div class="product-cell col-1-8 image">
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
    <div class="product-cell col-1-5 status-cell">
        <?php
                if ($row['soluong'] > 0) {
                ?>
        <span class="status active">Còn hàng</span>
        <?php
                } else if ($row['soluong'] <= 0) {
                ?>
        <span class="status">Hết hàng</span>
        <?php
                }
                ?>
    </div>
    <div class="product-cell col-1-8 sales">
        <?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                echo date('d/m/Y', $row['created_time']) ?></div>
    <div class="product-cell col-1-8 stock"><?php echo date('d/m/Y', $row['last_updated']) ?></div>

    <?php
            if ($row_privilege['detail_product'] == 1) {
            ?>
    <div class="product-cell col-1-8 detail">
        <button title="Xem chi tiết" class="detail-product" value="<?php echo $row['id_sanpham'] ?>"><span>Xem
                chi tiết</span></button>
    </div>
    <?php } ?>
    <?php
            if ($row_privilege['delete_product'] == 1) {
            ?>
    <div class="product-cell col btn">
        <button title="Xóa" class="remove-product" value="<?php echo $row['id_sanpham'] ?>"><i
                class="fa-solid fa-trash"></i></button>
    </div>
    <?php } ?>
    <?php
            if ($row_privilege['edit_product'] == 1) {
            ?>
    <div class="product-cell col btn">
        <button title="Sửa" class="edit-product" value="<?php echo $row['id_sanpham'] ?>"><i
                class="fa-regular fa-pen-to-square"></i></button>
    </div>
    <?php } ?>
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
                <a class="page-link filter first-page-shopPage" value="<?php echo $first_page ?>"><i
                        class="fa-solid fa-angles-left"></i></a>
            </li>
            <?php
                }
                if ($current_page > 1) {
                    $prev_page = $current_page - 1;
                ?>
            <li class="page-item">
                <a class="page-link filter prev-page-shopPage" value="<?php echo $current_page - 1 ?>"><i
                        class="fa-solid fa-angle-left"></i></a>
            </li>
            <?php } ?>

            <?php for ($num = 1; $num <= $totalPages; $num++) { ?>
            <?php if ($num != $current_page) { ?>
            <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
            <li class="page-item <?php echo ($current_page == $num) ? 'active' : '' ?>"><a class="page-link filter"
                    value="<?php echo $num ?>"><?php echo $num ?></a></li>
            <?php } ?>
            <?php } else { ?>
            <li class="page-item <?php echo ($current_page == $num) ? 'active' : '' ?>"><a class="page-link filter"
                    value="<?php echo $num ?>"><?php echo $num ?></a></li>
            <?php } ?>
            <?php } ?>


            <?php
                if ($current_page < $totalPages - 1) {
                    $next_page = $current_page + 1;
                ?>
            <li class=" page-item">
                <a class="page-link filter next-page-shopPage" value="<?php echo $current_page + 1 ?>"><i
                        class="fa-solid fa-angle-right"></i></a>
            </li>
            <?php
                }
                if ($current_page < $totalPages - 3) {
                    $end_page = $totalPages;
                ?>
            <li class="page-item">
                <a class="page-link filter last-page-shopPage" value="<?php echo $end_page ?>"><i
                        class="fa-solid fa-angles-right"></i></a>
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