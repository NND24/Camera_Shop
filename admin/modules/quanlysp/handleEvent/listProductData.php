<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
$sql_lietke_sp = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc 
ORDER BY id_sanpham DESC";
$query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);
if (mysqli_num_rows($query_lietke_sp) > 0) {
    while ($row = mysqli_fetch_array($query_lietke_sp)) {
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
<?php
} else {
?>
    <h1 class="empty-row">Chưa có sản phẩm nào</h1>
<?php
}
?>