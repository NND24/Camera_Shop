<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
$item_per_page = 8;
$current_page = $_GET['pageIndex'];
$offset = ($current_page - 1) * $item_per_page;

$dated = $_POST['dated'];

$sql_user = "SELECT * FROM tbl_user ORDER BY 
    CASE WHEN $dated = 0 THEN created_time END ASC,
    CASE WHEN $dated = 1 THEN created_time END DESC,
    CASE WHEN $dated = 2 THEN created_time END ASC
LIMIT " . $item_per_page . " OFFSET " . $offset . "";
$query_user = mysqli_query($mysqli, $sql_user);

// $sql_privilege = "SELECT * FROM tbl_privilege WHERE id_admin='" . $_SESSION['dangnhap'] . "' LIMIT 1";
// $query_privilege = mysqli_query($mysqli, $sql_privilege);
// $row_privilege = mysqli_fetch_array($query_privilege);

$totalRecords = mysqli_query($mysqli, "SELECT * FROM tbl_user ");
$totalRecords = mysqli_num_rows($totalRecords);
$totalPages = ceil($totalRecords / $item_per_page);
$i = 0;
if (mysqli_num_rows($query_user) > 0) {
    while ($row = mysqli_fetch_array($query_user)) {
        $i++
?>
<div class="products-row">
    <div class="product-cell col-1-5">
        <p><?php echo $i ?></p>
    </div>
    <div class="product-cell col user ">
        <p><?php echo $row['name'] ?></p>
    </div>

    <div class="product-cell col user ">
        <p><?php echo $row['phonenumber'] ?></p>
    </div>

    <div class="product-cell col sales"><?php
                                                date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                echo date('d/m/Y', $row['created_time'])
                                                ?>
    </div>

    <?php
            //  if ($row_privilege['detail_user'] == 1) {
            ?>
    <div class="product-cell col detail">
        <button title="Xem chi tiết" class="detail-user" value="<?php echo $row['id_user'] ?>"><span>Xem
                chi tiết</span></button>
    </div>
    <?php //} 
            ?>
    <?php
            // if ($row_privilege['delete_user'] == 1) {
            ?>
    <div class="product-cell col-1 btn">
        <button title="Xóa" class="remove-user" value="<?php echo $row['id_user'] ?>"><i
                class="fa-solid fa-trash"></i></button>
    </div>
    <?php //} 
            ?>
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
                <a class="page-link mainCate first-page-shopPage" value="<?php echo $first_page ?>"><i
                        class="fa-solid fa-angles-left"></i></a>
            </li>
            <?php
                }
                if ($current_page > 1) {
                    $prev_page = $current_page - 1;
                ?>
            <li class="page-item">
                <a class="page-link mainCate prev-page-shopPage" value="<?php echo $current_page - 1 ?>"><i
                        class="fa-solid fa-angle-left"></i></a>
            </li>
            <?php } ?>

            <?php for ($num = 1; $num <= $totalPages; $num++) { ?>
            <?php if ($num != $current_page) { ?>
            <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
            <li class="page-item <?php echo ($current_page == $num) ? 'active' : '' ?>"><a class="page-link mainCate"
                    value="<?php echo $num ?>"><?php echo $num ?></a></li>
            <?php } ?>
            <?php } else { ?>
            <li class="page-item <?php echo ($current_page == $num) ? 'active' : '' ?>"><a class="page-link mainCate"
                    value="<?php echo $num ?>"><?php echo $num ?></a></li>
            <?php } ?>
            <?php } ?>


            <?php
                if ($current_page < $totalPages - 1) {
                    $next_page = $current_page + 1;
                ?>
            <li class=" page-item">
                <a class="page-link mainCate next-page-shopPage" value="<?php echo $current_page + 1 ?>"><i
                        class="fa-solid fa-angle-right"></i></a>
            </li>
            <?php
                }
                if ($current_page < $totalPages - 3) {
                    $end_page = $totalPages;
                ?>
            <li class="page-item">
                <a class="page-link mainCate last-page-shopPage" value="<?php echo $end_page ?>"><i
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
<h1 class="empty-row">Chưa có danh mục nào</h1>
<?php
}
?>