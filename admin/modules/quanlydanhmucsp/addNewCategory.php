<div id="category__add-model">
    <div class="model__container">
        <form enctype="multipart/form-data">
            <div class="model__add-new">
                <h3>Thêm danh mục</h3>
                <div class="close-modal">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="model__content">
                    <label class="col-2">Tên danh mục: </label>
                    <input type="text" class="tendanhmuc" val="" name="tendanhmuc">
                </div>
                <div class="model__content">
                    <label class="col-2">Trạng thái: </label>
                    <select name="trangthai" class="trangthai">
                        <option value="1">Kích hoạt</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>
                <div class="model__content">
                    <label>Chi tiết danh mục: </label>
                    <textarea name="category-content" class="category-content" id="category-content"></textarea>
                </div>
                <div class="model__button">
                    <button id="themdanhmuc">Thêm danh mục sản phẩm</button>
                </div>
            </div>
        </form>
        <div class="modal__background modal__add-category"></div>
    </div>
</div>

<script>
$(document).ready(() => {
    CKEDITOR.replace('category-content')
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
    // Handle add new category
    $(document).on("click", '#themdanhmuc', function(e) {
        e.preventDefault();
        var tendanhmuc = $('.tendanhmuc').val();
        var trangthai = $('.trangthai').val();
        var content = CKEDITOR.instances['category-content'].getData();

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
                url: "modules/quanlydanhmucsp/handleEvent/handleAddCategory.php",
                data: {
                    tendanhmuc: tendanhmuc,
                    trangthai: trangthai,
                    category_detail: content,
                },
                dataType: 'json',
                method: "post",
                cache: true,
                success: function(data) {
                    if (data.existName === 1) {
                        swal("Vui lòng nhập lại", 'Danh mục đã tồn tại', "error");
                        $('.tendanhmuc').val('')
                    } else {
                        $('.tendanhmuc').val('')
                        swal("OK!", "Thêm thành công", "success");
                        view_data();
                    }
                }
            })
        }

    })
})
</script>