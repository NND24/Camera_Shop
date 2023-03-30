<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
$sql = "SELECT * FROM tbl_admin WHERE id_admin='" . $_GET['idmember'] . "' LIMIT 1";
$query = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_array($query)
?>
<div id="member__add-model">
    <div class="model__container">
        <form enctype="multipart/form-data">
            <div class="model__add-new">
                <h3>Thêm thành viên</h3>
                <div class="close-modal">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="model__content">
                    <label class="col-2">Tên: </label>
                    <input type="text" class="username" value="<?php echo $row['username'] ?>">
                </div>
                <div class="model__content">
                    <label class="col-2">email: </label>
                    <input type="text" class="email" value="<?php echo $row['email'] ?>">
                </div>
                <div class="model__content">
                    <label class="col-2">Chức vụ: </label>
                    <select class="duty">
                        <?php if ($row['email'] == 1) {  ?>
                        <option value="1" selected>Nhân viên</option>
                        <option value="0">Quản lý</option>
                        <?php } else { ?>
                        <option value="1">Nhân viên</option>
                        <option value="0" selected>Quản lý</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="model__content">
                    <label class="col-2">Mật khẩu: </label>
                    <input type="password" class="password">
                </div>
                <div class="model__content">
                    <label class="col-2">Nhập lại mật khẩu: </label>
                    <input type="password" class="password_confirmation">
                </div>
                <button id="suathanhvien">Thêm thành viên</button>
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
        $.post('http://localhost:3000/admin/modules/quanlydanhmucsp/handleEvent/listCategoryData.php?pageIndex=' +
            pageIndexMainCate,
            function(
                data) {
                $('#load_category_data').html(data)
            })
    }

    // Handle edit category
    $(document).on("click", '#suathanhvien', function(e) {
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
                url: "http://localhost:3000/admin/modules/quanlydanhmucsp/handleEvent/handleEditCategory.php",
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