<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
$sql_view_detail_category = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc='" . $_GET['iddanhmuc'] . "' LIMIT 1";
$query__view_detail_category = mysqli_query($mysqli, $sql_view_detail_category);
?>
<div class="model__view-detail-container">
    <div class="model-close-btn"><i class="fa-solid fa-xmark"></i></div>
    <form>
        <div class="model__view-detail">
            <h3>Chi tiết danh mục</h3>
            <?php
            while ($row = mysqli_fetch_array($query__view_detail_category)) {
            ?>
            <div class="model__content">
                <label class="col-2">Tên danh mục: </label>
                <input readonly value="<?php echo $row['ten_danhmuc'] ?>" />
            </div>
            <div class="model__content">
                <label class="col-2">Thứ tự danh mục: </label>
                <input readonly value="<?php echo $row['thutu'] ?>" />
            </div>
            <div class="model__content">
                <label class="col-2">Ngày tạo: </label>
                <input readonly value="<?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                                            echo date('d/m/Y H:i', $row['category_created_time']) ?>" />
            </div>
            <div class="model__content">
                <label class="col-2">Ngày cập nhật: </label>
                <input readonly value="<?php echo date('d/m/Y H:i', $row['category_created_time']) ?>" />
            </div>
            <div class="model__content">
                <label class="col-2">Trạng thái: </label>
                <select name="trangthai">

                    <?php
                        if ($row['category_status'] == 1) {
                        ?>
                    <option readonly value="1" selected>Kích hoạt</option>
                    <?php
                        } else {
                        ?>
                    <option readonly value="0">Ẩn</option>
                    <?php
                        }
                        ?>
                </select>
            </div>
            <div class="model__content">
                <label>Chi tiết danh mục: </label>
                <textarea readonly name="content" id="view-content"><?php echo $row['category_detail'] ?></textarea>
            </div>
            <?php
            }
            ?>
        </div>
    </form>
</div>

<script>
CKEDITOR.replace('view-content')
</script>