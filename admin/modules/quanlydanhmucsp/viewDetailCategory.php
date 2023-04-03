<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
$sql = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc='" . $_GET['iddanhmuc'] . "' LIMIT 1";
$query = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_array($query)
?>
<div id="category__add-model">
    <div class="model__container">
        <form enctype="multipart/form-data">
            <div class="model__add-new">
                <h3>Chi tiết danh mục</h3>
                <div class="close-modal">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="model__content">
                    <label class="col-2">Tên danh mục: </label>
                    <input readonly value="<?php echo $row['ten_danhmuc'] ?>" />
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
                    <select>
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
                    <textarea readonly id="view-content"><?php echo $row['category_detail'] ?></textarea>
                </div>
            </div>
        </form>
        <div class="modal__background modal__add-category"></div>
    </div>
</div>

<script>
CKEDITOR.replace('view-content')
</script>