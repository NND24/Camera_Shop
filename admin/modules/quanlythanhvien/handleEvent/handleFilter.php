<?php
session_start();
include('../../../../admin/config/config.php');
$item_per_page = 10;
$current_page = $_GET['pageIndex'];
$offset = ($current_page - 1) * $item_per_page;

$duty = $_POST['duty'];

$sql_lietke_member = "SELECT * FROM tbl_admin WHERE 
 (($duty = 0 AND tbl_admin.duty = 1)
OR   ($duty = 1 AND tbl_admin.duty = 0)
OR   ($duty = 2 AND (tbl_admin.duty = 0  OR tbl_admin.duty = 1)))
ORDER BY id_admin ASC LIMIT " . $item_per_page . " OFFSET " . $offset . "";
$query_lietke_member = mysqli_query($mysqli, $sql_lietke_member);

$sql_admin = "SELECT * FROM tbl_admin WHERE id_admin='" . $_SESSION['dangnhap'] . "' LIMIT 1";
$query_admin = mysqli_query($mysqli, $sql_admin);
$row_admin = mysqli_fetch_array($query_admin);

$sql_privilege = "SELECT * FROM tbl_privilege WHERE id_admin='" . $_SESSION['dangnhap'] . "' LIMIT 1";
$query_privilege = mysqli_query($mysqli, $sql_privilege);
$row_privilege = mysqli_fetch_array($query_privilege);

$totalRecords = mysqli_query($mysqli, "SELECT * FROM tbl_admin WHERE 
 (($duty = 0 AND tbl_admin.duty = 1)
OR   ($duty = 1 AND tbl_admin.duty = 0)
OR   ($duty = 2 AND (tbl_admin.duty = 0  OR tbl_admin.duty = 1)))");
$totalRecords = mysqli_num_rows($totalRecords);
$totalPages = ceil($totalRecords / $item_per_page);
if (mysqli_num_rows($query_lietke_member) > 0) {
    while ($row = mysqli_fetch_array($query_lietke_member)) {
?>
        <div class="products-row">
            <div class="product-cell col-2 id_danhmuc-danhmuc  ">
                <p><?php echo $row['username'] ?></p>
            </div>
            <div class="product-cell col-2 id_danhmuc-danhmuc ">
                <?php
                if ($row['duty'] == 1) {
                ?>
                    <span class="status active">Nhân viên</span>
                <?php
                } else if ($row['duty'] == 0) {
                ?>
                    <span class="status active">Quản lý</span>
                <?php
                }
                ?>
            </div>

            <div class="product-cell col sales"><?php
                                                date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                echo date('d/m/Y', $row['created_time'])
                                                ?>
            </div>
            <div class="product-cell col stock"><?php echo date('d/m/Y', $row['last_updated']) ?>
            </div>

            <?php
            if ($row_privilege['detail_member'] == 1 || $row_admin['duty'] == 0) {
            ?>
                <div class="product-cell col-2 detail">
                    <button title="Xem chi tiết" class="detail-member privilege-member" value="<?php echo $row['id_admin'] ?>"><span>Phân
                            quyền</span></button>
                </div>
            <?php } ?>
            <?php
            if ($row_privilege['delete_member'] == 1) {
            ?>
                <div class="product-cell col-1 btn">
                    <button title="Xóa" class="remove-member" value="<?php echo $row['id_admin'] ?>"><i class="fa-solid fa-trash"></i></button>
                </div>
            <?php } ?>
            <?php
            if ($row_privilege['edit_member'] == 1) {
            ?>
                <div class="product-cell col-1 btn">
                    <button title="Sửa" class="edit-member" value="<?php echo $row['id_admin'] ?>"><i class="fa-regular fa-pen-to-square"></i></button>
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
    <h1 class="empty-row">Chưa có thành viên nào</h1>
<?php
}
?>