<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
//echo json_encode($_POST);

if (isset($_POST['searchInput'])) {
    $item_per_page = 7;
    $current_page = $_GET['pageIndex'];
    $offset = ($current_page - 1) * $item_per_page;
    $input = $_POST['searchInput'];
    $sql = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc AND tensanpham LIKE '%{$input}%'  LIMIT " . $item_per_page . " OFFSET " . $offset . " ";
    $query = mysqli_query($mysqli, $sql);;

    $totalRecords = mysqli_query($mysqli, "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc AND tensanpham LIKE '%{$input}%'");
    $totalRecords = mysqli_num_rows($totalRecords);
    $totalPages = ceil($totalRecords / $item_per_page);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_array($query)) {
?>
            <div class="products-row">
                <button class="cell-more-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical">
                        <circle cx="12" cy="12" r="1" />
                        <circle cx="12" cy="5" r="1" />
                        <circle cx="12" cy="19" r="1" />
                    </svg>
                </button>
                <div class="product-cell col-2-4 image">
                    <img src="modules/quanlysp/handleEvent/uploads/<?php echo $row['hinhanh'] ?>">
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
                            <a class="page-link search first-page-shopPage" value="<?php echo $first_page ?>"><i class="fa-solid fa-angles-left"></i></a>
                        </li>
                    <?php
                    }
                    if ($current_page > 1) {
                        $prev_page = $current_page - 1;
                    ?>
                        <li class="page-item">
                            <a class="page-link search prev-page-shopPage" value="<?php echo $current_page - 1 ?>"><i class="fa-solid fa-angle-left"></i></a>
                        </li>
                    <?php } ?>

                    <?php for ($num = 1; $num <= $totalPages; $num++) { ?>
                        <?php if ($num != $current_page) { ?>
                            <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
                                <li class="page-item <?php echo ($current_page == $num) ? 'active' : '' ?>"><a class="page-link search" value="<?php echo $num ?>"><?php echo $num ?></a></li>
                            <?php } ?>
                        <?php } else { ?>
                            <li class="page-item <?php echo ($current_page == $num) ? 'active' : '' ?>"><a class="page-link search" value="<?php echo $num ?>"><?php echo $num ?></a></li>
                        <?php } ?>
                    <?php } ?>


                    <?php
                    if ($current_page < $totalPages - 1) {
                        $next_page = $current_page + 1;
                    ?>
                        <li class=" page-item">
                            <a class="page-link search next-page-shopPage" value="<?php echo $current_page + 1 ?>"><i class="fa-solid fa-angle-right"></i></a>
                        </li>
                    <?php
                    }
                    if ($current_page < $totalPages - 3) {
                        $end_page = $totalPages;
                    ?>
                        <li class="page-item">
                            <a class="page-link search last-page-shopPage" value="<?php echo $end_page ?>"><i class="fa-solid fa-angles-right"></i></a>
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
        <h1 class="empty-row">Không tìm thấy danh mục nào</h1>
    <?php
    }
    ?>
<?php
}
?>