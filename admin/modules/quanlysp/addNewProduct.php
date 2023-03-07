<div class="model__add-new-container">
    <div class="model-close-btn"><i class="fa-solid fa-xmark"></i></div>
    <form method="POST" action="modules/quanlysp/xuly.php" enctype="multipart/form-data">
        <div class="model__add-new">
            <h3>Thêm sản phẩm</h3>
            <div class="model__content">
                <label class="col-2">Tên sản phẩm: </label>
                <input name="tensanpham" />
            </div>
            <div class="model__content">
                <label class="col-2">Danh mục sản phẩm: </label>
                <select name="danhmuc">
                    <?php
                    $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
                    $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
                    while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
                        if ($row_danhmuc['id_danhmuc'] == $row['id_danhmuc']) {
                    ?>
                    <option selected value="<?php echo $row_danhmuc['id_danhmuc'] ?>">
                        <?php echo $row_danhmuc['ten_danhmuc'] ?>
                    </option>
                    <?php
                        } else {
                        ?>
                    <option value="<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['ten_danhmuc'] ?>
                    </option>
                    <?php
                        }
                        ?>
                    <?php } ?>
                </select>
            </div>
            <div class="model__content">
                <label class="col-2">Hình ảnh: </label>
                <input type="file" name="hinhanh">
            </div>
            <div class="model__content">
                <label class="col-2">Giá sản phẩm: </label>
                <input name="giasp" />
            </div>
            <div class="model__content">
                <label class="col-2">Số lượng : </label>
                <input name="soluong" />
            </div>
            <div class="model__content">
                <label class="col-2">Giảm giá: </label>
                <input name="giamgia" />
            </div>
            <div class="model__content">
                <label class="col-2">Nổi bật: </label>
                <select name="noibat">

                    <?php
                    if ($row['noibat'] == 1) {
                    ?>
                    <option value="1" selected>Nổi bật</option>
                    <option value="0">Không nổi bật</option>
                    <?php
                    } else {
                    ?>
                    <option value="1" selected>Nổi bật</option>
                    <option value="0">Không nổi bật</option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="model__content">
                <label class="col-2">Trạng thái: </label>
                <select name="trangthai">
                    <option value="1" selected>Kích hoạt</option>
                    <option value="0">Ẩn</option>
                </select>
            </div>
            <div class="model__content">
                <label>Tóm tắt sản phẩm: </label>
                <textarea name="tomtat" rows="5" style="resize:none;"></textarea>
            </div>
            <div class="model__content">
                <label>Chi tiết sản phẩm: </label>
                <textarea name="noidung" rows="5" style="resize:none;"></textarea>
            </div>
            <input type="submit" name="themsanpham" value="Thêm sản phẩm">
        </div>
    </form>
</div>