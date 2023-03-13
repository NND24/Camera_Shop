<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
$sql_lietke_dh = "SELECT * FROM tbl_cart,tbl_dangky WHERE tbl_cart.id_khachhang=tbl_dangky.id_dangky ORDER BY tbl_cart.id_cart ASC";
$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
$i = 1;
if (mysqli_num_rows($query_lietke_dh) > 0) {
    while ($row = mysqli_fetch_array($query_lietke_dh)) {
?>
        <div class="products-row">
            <button class="cell-more-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical">
                    <circle cx="12" cy="12" r="1" />
                    <circle cx="12" cy="5" r="1" />
                    <circle cx="12" cy="19" r="1" />
                </svg>
            </button>
            <div class="product-cell col-0-4 ">
                <p>
                    <td><?php echo $i ?></td>
                </p>
            </div>
            <div class="product-cell col category ">
                <p>
                    <td><?php echo $row['code_cart'] ?></td>
                </p>
            </div>
            <div class="product-cell col-2 category ">
                <p>
                    <td><?php echo $row['tenkhachhang'] ?></td>
                </p>
            </div>
            <div class="product-cell col sales">
                <td><?php echo $row['diachi'] ?></td>

            </div>
            <div class="product-cell col stock">
                <td><?php echo $row['email'] ?></td>
            </div>
            <div class="product-cell col stock">
                <td><?php echo $row['dienthoai'] ?></td>
            </div>
            <div class="product-cell col status-cell">

                <?php
                if ($row['cart_status'] == 1) {
                    echo '<a href="modules/quanlydonhang/xuly.php?&code=' . $row['code_cart'] . '">Đơn hàng mới</a>';
                } else {
                    echo '<a>Đã xem</a>';
                }
                ?>
            </div>
            <div class="product-cell col-1-8 detail">
                <button title="Xem chi tiết" class="detail-order" value="<?php echo $row['id_sanpham'] ?>"><span>Xem
                        chi tiết</span></button>
            </div>
        </div>
    <?php
    }
    ?>
<?php
} else {
?>
    <h1 class="empty-row">Chưa có đơn hàng nào</h1>
<?php
}
?>