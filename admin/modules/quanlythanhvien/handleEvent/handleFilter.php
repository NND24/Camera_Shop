<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
$item_per_page = 10;
$current_page = $_GET['pageIndex'];
$offset = ($current_page - 1) * $item_per_page;

$status = $_POST['status'];
$dated = $_POST['dated'];

$sql_danhmucsp = "SELECT * FROM tbl_danhmuc WHERE (($status = 0 AND category_status = 0) 
OR ($status = 1 AND category_status = 1) OR ($status = 2 AND (category_status = 0  OR category_status = 1)))
ORDER BY 
    CASE WHEN $dated = 0 THEN category_last_updated END ASC,
    CASE WHEN $dated = 1 THEN category_last_updated END DESC,
    CASE WHEN $dated = 2 THEN category_last_updated END ASC
LIMIT " . $item_per_page . " OFFSET " . $offset . "";
$query_danhmucsp = mysqli_query($mysqli, $sql_danhmucsp);

$totalRecords = mysqli_query($mysqli, "SELECT * FROM tbl_danhmuc WHERE (($status = 0 AND category_status = 0) 
OR ($status = 1 AND category_status = 1) OR ($status = 2 AND (category_status = 0  OR category_status = 1)))");
$totalRecords = mysqli_num_rows($totalRecords);
$totalPages = ceil($totalRecords / $item_per_page);
$i = 0;
if (mysqli_num_rows($query_danhmucsp) > 0) {
    while ($row = mysqli_fetch_array($query_danhmucsp)) {
        $i++
?>
        <div class="products-row">
            <div class="product-cell col-1-5 id_danhmuc-danhmuc ">
                <p><?php echo $i ?></p>
            </div>
            <div class="product-cell col-2 category ">
                <p><?php echo $row['ten_danhmuc'] ?></p>
            </div>
            <div class="product-cell col status-cell">

                <?php
                if ($row['category_status'] == 1) {
                ?>
                    <span class="status active">Kích hoạt</span>
                <?php
                } else {
                ?>
                    <span class="status">Ẩn</span>
                <?php
                }
                ?>
            </div>
            <div class="product-cell col sales"><?php
                                                date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                echo date('d/m/Y H:i', $row['category_created_time'])
                                                ?>
            </div>
            <div class="product-cell col stock"><?php echo date('d/m/Y H:i', $row['category_last_updated']) ?>
            </div>
            <div class="product-cell col-1-8 detail">
                <button title="Xem chi tiết" class="detail-category" value="<?php echo $row['id_danhmuc'] ?>"><span>Xem
                        chi tiết</span></button>
            </div>
            <div class="product-cell col-1 btn">
                <button title="Xóa" class="remove-category" value="<?php echo $row['id_danhmuc'] ?>"><i class="fa-solid fa-trash"></i></button>
            </div>
            <div class="product-cell col-1 btn">
                <button title="Sửa" class="edit-category" value="<?php echo $row['id_danhmuc'] ?>"><i class="fa-regular fa-pen-to-square"></i></button>
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
                        <a class="page-link mainCate first-page-shopPage" value="<?php echo $first_page ?>"><i class="fa-solid fa-angles-left"></i></a>
                    </li>
                <?php
                }
                if ($current_page > 1) {
                    $prev_page = $current_page - 1;
                ?>
                    <li class="page-item">
                        <a class="page-link mainCate prev-page-shopPage" value="<?php echo $current_page - 1 ?>"><i class="fa-solid fa-angle-left"></i></a>
                    </li>
                <?php } ?>

                <?php for ($num = 1; $num <= $totalPages; $num++) { ?>
                    <?php if ($num != $current_page) { ?>
                        <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
                            <li class="page-item <?php echo ($current_page == $num) ? 'active' : '' ?>"><a class="page-link mainCate" value="<?php echo $num ?>"><?php echo $num ?></a></li>
                        <?php } ?>
                    <?php } else { ?>
                        <li class="page-item <?php echo ($current_page == $num) ? 'active' : '' ?>"><a class="page-link mainCate" value="<?php echo $num ?>"><?php echo $num ?></a></li>
                    <?php } ?>
                <?php } ?>


                <?php
                if ($current_page < $totalPages - 1) {
                    $next_page = $current_page + 1;
                ?>
                    <li class=" page-item">
                        <a class="page-link mainCate next-page-shopPage" value="<?php echo $current_page + 1 ?>"><i class="fa-solid fa-angle-right"></i></a>
                    </li>
                <?php
                }
                if ($current_page < $totalPages - 3) {
                    $end_page = $totalPages;
                ?>
                    <li class="page-item">
                        <a class="page-link mainCate last-page-shopPage" value="<?php echo $end_page ?>"><i class="fa-solid fa-angles-right"></i></a>
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
    <h1 class="empty-row">Chưa có danh mục nào</h1>
<?php
}
?>