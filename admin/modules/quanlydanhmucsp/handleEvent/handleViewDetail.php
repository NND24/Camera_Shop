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
                <!-- The toolbar will be rendered in this container. -->
                <div id="view-detail-toolbar-container"></div>

                <!-- This container will become the editable. -->
                <div name="category_detail" id="view-detail-editor">
                    <?php echo $row['category_detail'] ?>
                </div>
                <script>
                DecoupledEditor
                    .create(document.querySelector('#view-detail-editor'))
                    .then(editor => {
                        const toolbarContainer = document.querySelector('#view-detail-toolbar-container');
                        editor.setData('<?php echo $row['category_detail'] ?>');
                        editor.enableReadOnlyMode("view-detail-editor");
                        toolbarContainer.appendChild(editor.ui.view.toolbar.element);
                    })
                </script>
            </div>
            <?php
            }
            ?>
        </div>
    </form>
</div>