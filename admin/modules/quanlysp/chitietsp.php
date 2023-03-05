<?php
$sql_sua_sanpham = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc 
AND id_sanpham=41 LIMIT 1";
$query_sua_sanpham = mysqli_query($mysqli, $sql_sua_sanpham);
?>
<div class="model__add-new-container">
    <form method="POST" action="modules/quanlysp/xuly.php?idsanpham=<?php echo $_GET['idsanpham'] ?>">
        <div class="model__add-new">
            <h3>Chi tiết sản phẩm</h3>
            <?php
            while ($row = mysqli_fetch_array($query_sua_sanpham)) {
            ?>
            <div class="model__content">
                <label>Tên sản phẩm: </label>
                <input value="<?php echo $row['tensanpham'] ?>" />
            </div>
            <div class="model__content">
                <label>Danh mục sản phẩm: </label>
                <input value="<?php echo $row['ten_danhmuc'] ?>" />
            </div>
            <div class="model__content">
                <label>Ngày tạo: </label>
                <input value="<?php echo $row['created_time'] ?>" />
            </div>
            <div class="model__content">
                <label>Ngày cập nhật: </label>
                <input value="<?php echo $row['last_updated'] ?>" />
            </div>
            <div class="model__content">
                <label>Hình ảnh: </label>
                <input type="file" value="<?php echo $row['hinhanh'] ?>" name="hinhanh">
                <img src="modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>" width="150px" alt="">
            </div>
            <div class="model__content">
                <label>Mã sản phẩm: </label>
                <input value="<?php echo $row['masp'] ?>" />
            </div>
            <div class="model__content">
                <label>Giá sản phẩm: </label>
                <input value="<?php echo number_format($row['giasp'], '0', ',', '.') ?>đ" />
            </div>
            <div class="model__content">
                <label>Số lượng sản phẩm: </label>
                <input value="<?php echo $row['soluong'] ?>" />
            </div>
            <div class="model__content">
                <label>Giảm giá: </label>
                <input value="<?php echo $row['tensanpham'] ?>" />
            </div>
            <div class="model__content">
                <label>Nổi bật: </label>
                <input value="<?php echo $row['tensanpham'] ?>" />
            </div>
            <div class="model__content">
                <label>Trạng thái: </label>
                <select name="trangthai">

                    <?php
                        if ($row['trangthai'] == 1) {
                        ?>
                    <option value="1" selected>Kích hoạt</option>
                    <option value="0">Ẩn</option>
                    <?php
                        } else {
                        ?>
                    <option value="1" selected>Kích hoạt</option>
                    <option value="0">Ẩn</option>
                    <?php
                        }
                        ?>
                </select>
            </div>
            <div class="model__content">
                <label>Tóm tắt sản phẩm: </label>
                <textarea name="tomtat" rows="5" style="resize:none;"><?php echo $row['tomtat'] ?></textarea>
            </div>
            <div class="model__content">
                <label>Chi tiết sản phẩm: </label>
                <textarea name="noidung" rows="5" style="resize:none;"><?php echo $row['noidung'] ?></textarea>
            </div>
            <?php
            }
            ?>
        </div>
    </form>
</div>