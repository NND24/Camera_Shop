<?php
include('../../config/config.php');
$sql_edit_detail_category = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc='" . $_GET['iddanhmuc'] . "' LIMIT 1";
$query__edit_detail_category = mysqli_query($mysqli, $sql_edit_detail_category);
?>
<div class="model__edit-category-container">
    <div class="model-close-btn"><i class="fa-solid fa-xmark"></i></div>
    <form id="form-edit-category" method="POST" enctype="multipart/form-data">
        <div class="model__edit-category">
            <h3>Sửa danh mục</h3>
            <?php
            while ($row = mysqli_fetch_array($query__edit_detail_category)) {
            ?>
                <div class="model__content">
                    <label class="col-2">Tên danh mục: </label>
                    <input type="text" class="tendanhmuc1" value="<?php echo $row['ten_danhmuc'] ?>" name="tendanhmuc">
                </div>
                <div class="model__content">
                    <label class="col-2">Thứ tự danh mục: </label>
                    <input type="number" value="<?php echo $row['thutu'] ?>" name="thutu" class="thutu1">
                </div>
                <div class="model__content">
                    <label class="col-2">Trạng thái: </label>
                    <select name="trangthai" class="trangthai1">
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
                    <textarea name="content" id="edit-category"><?php echo $row['category_detail'] ?></textarea>
                </div>
            <?php
            }
            ?>
            <div class="model__content">

                <button id="suadanhmuc">Sửa danh mục sản phẩm</button>
            </div>
            <span class="errorExist" style="color:red;"></span>
        </div>

</div>
</form>
</div>

<script>
    $(document).ready(() => {
        CKEDITOR.replace('edit-category')
        // Handle add new category
        $('#suadanhmuc').click((e) => {
            e.preventDefault();
            var tendanhmuc = $('.tendanhmuc1').val();
            var thutu = $('.thutu1').val();
            var trangthai = $('.trangthai1').val();
            var content = CKEDITOR.instances['category-content'].getData();
            let errors = {
                nameError: '',
                thuTuError: '',
                detailError: ''
            }

            // Validate category name
            if (tendanhmuc.length === 0) {
                errors.nameError = 'Tên danh mục không được để trống'
                swal("Vui lòng nhập lại", errors.nameError, "error");
            } else {
                errors.nameError = '';
            }

            // Validate thu tu
            if (thutu.length === 0) {
                errors.thuTuError = 'Thứ tự không được để trống'
                swal("Vui lòng nhập lại", errors.thuTuError, "error");
            } else if (thutu <= 0) {
                errors.thuTuError = 'Thứ tự phải lớn hơn 1'
                swal("Vui lòng nhập lại", errors.thuTuError, "error");
            } else {
                errors.thuTuError = '';
            }

            // Validate category detail
            if (content.length === 0) {
                errors.detailError = 'Nội dung danh mục không được để trống'
                swal("Vui lòng nhập lại", errors.detailErrorr, "error");
            } else {
                errors.detailError = '';
            }

            function view_data() {
                $.post('http://localhost:3000/admin/modules/quanlydanhmucsp/handleEvent/listCategoryData.php',
                    function(
                        data) {
                        $('#load_category_data').html(data)
                    })
            }
            if (errors.detailError === '' && errors.thuTuError === '' && errors.nameError === '') {
                $.ajax({
                    url: "http://localhost:3000/admin/modules/quanlydanhmucsp/handleEvent/handleEditCategory.php",
                    data: {
                        tendanhmuc: tendanhmuc,
                        thutu: thutu,
                        trangthai: trangthai,
                        category_detail: content,
                        iddanhmuc: <?php echo $_GET['iddanhmuc'] ?>,
                    },
                    dataType: 'json',
                    method: "post",
                    cache: true,
                    success: function(data) {
                        console.log('Du lieu: ', data);
                        view_data();
                        if (data.existName === 1) {
                            swal("Vui lòng nhập lại", 'Danh mục đã tồn tại', "error");
                        }
                        if (data.existThutu === 1) {
                            swal("Vui lòng nhập lại", 'Thứ tự đã tồn tại', "error");
                        }

                        if (data.existThutu === 0 && data.existName === 0) {
                            $('.tendanhmuc').val('')
                            $('.thutu').val('');
                            swal("OK!", "Sửa thành công", "success");
                            view_data();
                        }
                    }
                })
            }

        })
    })
</script>