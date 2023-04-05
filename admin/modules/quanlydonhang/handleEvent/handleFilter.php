<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
$item_per_page = 8;
$current_page = $_GET['pageIndex'];
$offset = ($current_page - 1) * $item_per_page;

$status = $_POST['status'];
$filter = $_POST['filter'];

$sql_lietke_dh = "SELECT * FROM tbl_order,tbl_user WHERE tbl_order.id_user=tbl_user.id_user 
AND (($status = 0 AND tbl_order.order_status = 0)
OR   ($status = 1 AND tbl_order.order_status = 1)
OR   ($status = 2 AND (tbl_order.order_status = 0  OR tbl_order.order_status = 1)))
ORDER BY 
    CASE WHEN $filter = -1 THEN id_order END DESC,
    CASE WHEN $filter = 0 THEN total END DESC,
    CASE WHEN $filter = 1 THEN total END ASC,
    CASE WHEN $filter = 2 THEN amount END DESC,
    CASE WHEN $filter = 3 THEN amount END ASC  
LIMIT " . $item_per_page . " OFFSET " . $offset . " ";
$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);

$sql_privilege = "SELECT * FROM tbl_privilege WHERE id_admin='" . $_SESSION['dangnhap'] . "' LIMIT 1";
$query_privilege = mysqli_query($mysqli, $sql_privilege);
$row_privilege = mysqli_fetch_array($query_privilege);

$totalRecords = mysqli_query($mysqli, "SELECT * FROM tbl_order,tbl_user WHERE tbl_order.id_user=tbl_user.id_user
AND (($status = 0 AND tbl_order.order_status = 0)
OR   ($status = 1 AND tbl_order.order_status = 1)
OR   ($status = 2 AND (tbl_order.order_status = 0  OR tbl_order.order_status = 1)))");
$totalRecords = mysqli_num_rows($totalRecords);
$totalPages = ceil($totalRecords / $item_per_page);
$i = 0;
if (mysqli_num_rows($query_lietke_dh) > 0) {
    while ($row = mysqli_fetch_array($query_lietke_dh)) {
        $i++;
?>
<div class="products-row">

    <div class="product-cell col-1">
        <p>
            <td><?php echo $i ?></td>
        </p>
    </div>
    <div class="product-cell col-2 category ">
        <p>
            <td><?php echo $row['order_code'] ?></td>
        </p>
    </div>
    <div class="product-cell col-2 status-cell">
        <?php
                if ($row['order_status'] == 1) {
                ?>
        <span class="status active">Đã duyệt</span>
        <?php
                } else if ($row['order_status'] == 0) {
                ?>
        <span class="status">Chưa duyệt</span>
        <?php
                }
                ?>
    </div>
    <div class="product-cell col sales">
        <?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                echo date('d/m/Y', $row['buyed_date']) ?>
    </div>
    <div class="product-cell col sales">
        <?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                echo date('d/m/Y', $row['browsed_date']) ?>
    </div>

    <?php
            if ($row_privilege['detail_order'] == 1) {
            ?>
    <div class="product-cell col-2 detail">
        <button title="Xem chi tiết" class="detail-order" value="<?php echo $row['id_order'] ?>"><span>Duyệt
                đơn</span></button>
    </div>
    <?php } ?>
    <?php
            if ($row_privilege['delete_order'] == 1) {
            ?>
    <div class="product-cell col-1 btn">
        <button title="Xóa" class="remove-order" value="<?php echo $row['id_order'] ?>"><i
                class="fa-solid fa-trash"></i></button>
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
<h1 class="empty-row">Chưa có đơn hàng nào</h1>
<?php
}
?>