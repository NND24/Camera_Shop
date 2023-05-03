<div id="product__detail-model">
    <?php
    include('../../../admin/config/config.php');
    $sql_view_detail_sp = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc AND id_sanpham='" . $_GET['idsanpham'] . "' LIMIT 1";
    $query_view_detail_sp = mysqli_query($mysqli, $sql_view_detail_sp);
    $row = mysqli_fetch_array($query_view_detail_sp)
    ?>
    <div class="model__container">
        <form>
            <div class="model__add-new">
                <h3>Chi tiết sản phẩm</h3>
                <div class="close-modal">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="model__content">
                    <label class="col-2">Tên sản phẩm: </label>
                    <input type="text" readonly value="<?php echo $row['tensanpham'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Danh mục sản phẩm: </label>
                    <select readonly>
                        <?php
                        $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc ASC";
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
                                <option value="<?php echo $row_danhmuc['id_danhmuc'] ?>">
                                    <?php echo $row_danhmuc['ten_danhmuc'] ?>
                                </option>
                            <?php
                            }
                            ?>
                        <?php } ?>
                    </select>
                </div>
                <div class="model__content">
                    <label class="col-2">Hình ảnh: </label>
                    <img src="modules/quanlysp/handleEvent/uploads/<?php echo $row['hinhanh'] ?>" class="image" alt="" style="width:100px; border:1px solid #ccc;">
                </div>
                <div class="model__content">
                    <label class="col-2">Số lượng: </label>
                    <input readonly type="number" value="<?php echo $row['soluong'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Giá sản phẩm: </label>
                    <input readonly type="number" value="<?php echo $row['giasp'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Giảm giá: </label>
                    <input readonly type="number" value="<?php echo $row['giamgia'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Giá sau giảm: </label>
                    <input readonly type="number" value="<?php echo $row['giadagiam'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Đã bán: </label>
                    <input readonly type="number" value="<?php echo $row['daban'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Đánh giá trung bình: </label>
                    <input readonly type="number" value="<?php echo $row['average_rating'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Trạng thái: </label>
                    <select readonly>
                        <option value="1" selected>Kích hoạt</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>
                <div class="model__content">
                    <label class="col-2">Ngày tạo: </label>
                    <input readonly type="text" value="<?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                        echo date('d/m/Y H:i', $row['created_time']) ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Ngày cập nhật: </label>
                    <input readonly type="text" value="<?php echo date('d/m/Y H:i', $row['last_updated']) ?>" />
                </div>
                <div class="model__content">
                    <label>Tóm tắt sản phẩm: </label>
                    <textarea readonly id="product-view-tomtat"><?php echo $row['tomtat'] ?></textarea>
                </div>
                <div class="model__content">
                    <label>Chi tiết sản phẩm: </label>
                    <textarea readonly id="product-view-detail"><?php echo $row['noidung'] ?></textarea>
                </div>
            </div>
        </form>
        <div class="modal__background  modal__detail-product"></div>
    </div>

    <script>
        CKEDITOR.replace('product-view-tomtat')
        CKEDITOR.replace('product-view-detail')
    </script>
</div>