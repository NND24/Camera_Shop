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
                <h3>Sửa danh mục</h3>
                <div class="close-modal">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="model__content">
                    <label class="col-2">Tên danh mục: </label>
                    <input class="tendanhmuc" value="<?php echo $row['ten_danhmuc'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Trạng thái: </label>
                    <select class="trangthai">
                        <?php
                        if ($row['category_status'] == 1) {
                        ?>
                        <option value="1" selected>Kích hoạt</option>
                        <option value="0">Ẩn</option>
                        <?php
                        } else {
                        ?>
                        <option value="1">Kích hoạt</option>
                        <option value="0" selected>Ẩn</option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="model__content">
                    <label>Chi tiết danh mục: </label>
                    <textarea id="edit-category"><?php echo $row['category_detail'] ?></textarea>
                </div>
                <div class="model__content">
                    <button id="suadanhmuc">Sửa danh mục sản phẩm</button>
                </div>
            </div>
        </form>
        <div class="modal__category-add-background"></div>
    </div>
</div>


<script>
$(document).ready(() => {
    CKEDITOR.replace('edit-category')

    // View data
    var pageIndexMainCate = 1

    function view_data() {
        $.post('modules/quanlydanhmucsp/handleEvent/listCategoryData.php?pageIndex=' +
            pageIndexMainCate,
            function(
                data) {
                $('#load_category_data').html(data)
            })
    }

    // Handle edit category
    $(document).on("click", '#suadanhmuc', function(e) {
        e.preventDefault();
        var tendanhmuc = $('.tendanhmuc').val();
        var trangthai = $('.trangthai').val();
        var content = CKEDITOR.instances['edit-category'].getData();

        let errors = {
            nameError: '',
            detailError: ''
        }

        // Validate category name
        if (tendanhmuc.length === 0) {
            errors.nameError = 'Tên danh mục không được để trống'
            swal("Vui lòng nhập lại", errors.nameError, "error");
            $('.tendanhmuc').val('')
            $('.tendanhmuc').css("border-color", "#ff000087");
        } else {
            errors.nameError = '';
            $('.tendanhmuc').css("border-color", "#008000ab");
        }

        // Validate category detail
        if (content.length === 0) {
            errors.detailError = 'Nội dung danh mục không được để trống'
            swal("Vui lòng nhập lại", errors.detailError, "error");
            $('.cke_chrome').css("border-color", "#ff000087");
        } else {
            errors.detailError = ''
            $('.errorDetail').text(errors.detailError);
            $('.cke_chrome').css("border-color", "#008000ab");
        }

        if (errors.detailError === '' && errors.nameError === '') {
            $.ajax({
                url: "modules/quanlydanhmucsp/handleEvent/handleEditCategory.php",
                data: {
                    tendanhmuc: tendanhmuc,
                    trangthai: trangthai,
                    category_detail: content,
                    iddanhmuc: <?php echo $_GET['iddanhmuc'] ?>,
                },
                dataType: 'json',
                method: "post",
                cache: true,
                success: function(data) {
                    if (data.existName == 1) {
                        swal("Vui lòng nhập lại", 'Danh mục đã tồn tại', "error");
                        $('.tendanhmuc').val('')
                    } else {
                        swal("OK!", "Thêm thành công", "success");
                        view_data();
                    }
                }
            })
        }
    })
})
</script>