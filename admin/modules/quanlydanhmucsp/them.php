<div class="model__add-new-container">
    <div class="model-close-btn"><i class="fa-solid fa-xmark"></i></div>
    <form method="POST" enctype="multipart/form-data">
        <div class="model__add-new">
            <h3>Thêm danh mục</h3>
            <div class="model__content">
                <label class="col-2">Tên danh mục: </label>
                <input type="text" class="tendanhmuc" val="" name="tendanhmuc">
                <span class="errorName" style="color:red;"></span>
            </div>
            <div class="model__content">
                <label class="col-2">Thứ tự danh mục: </label>
                <input type="number" name="thutu" class="thutu">
                <span class="errorThutu" style="color:red;"></span>
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
            <button id="themdanhmuc">Thêm danh mục sản phẩm</button>
        </div>
    </form>
</div>

<script>
    $(document).ready(() => {
        CKEDITOR.replace('category-content')
        // View data
        function view_data() {
            $.post('http://localhost:3000/admin/modules/quanlydanhmucsp/handleEvent/listCategoryData.php',
                function(
                    data) {
                    $('#load_category_data').html(data)
                })
        }
        // Handle add new category
        $('#themdanhmuc').click((e) => {
            e.preventDefault();
            var tendanhmuc = $('.tendanhmuc').val();
            var thutu = $('.thutu').val();
            var trangthai = $('.trangthai').val();
            var content = CKEDITOR.instances['category-content'].getData();
            console.log(content);

            let errors = {
                nameError: '',
                thuTuError: '',
                detailError: ''
            }

            // Validate category name
            if (tendanhmuc.length === 0) {
                errors.nameError = 'Tên danh mục không được để trống'
                swal("Vui lòng nhập lại", errors.nameError, "error");
                $('.tendanhmuc').val('')
            } else {
                errors.nameError = '';
            }

            // Validate thu tu
            if (thutu.length === 0) {
                errors.thuTuError = 'Thứ tự không được để trống'
                swal("Vui lòng nhập lại", errors.thuTuError, "error");
                $('.thutu').val('');
            } else if (thutu <= 0) {
                errors.thuTuError = 'Thứ tự phải lớn hơn 1'
                swal("Vui lòng nhập lại", errors.thuTuError, "error");
                $('.thutu').val('');
            } else {
                errors.thuTuError = '';
            }

            // Validate category detail
            if (content.length === 0) {
                errors.detailError = 'Nội dung danh mục không được để trống'
                swal("Vui lòng nhập lại", errors.detailError, "error");
            } else {
                errors.detailError = ''
                $('.errorDetail').text(errors.detailError);
            }

            if (errors.detailError === '' && errors.thuTuError === '' && errors.nameError === '') {
                $.ajax({
                    url: "http://localhost:3000/admin/modules/quanlydanhmucsp/handleEvent/handleAddCategory.php",
                    data: {
                        tendanhmuc: tendanhmuc,
                        thutu: thutu,
                        trangthai: trangthai,
                        category_detail: content,
                    },
                    dataType: 'json',
                    method: "post",
                    cache: true,
                    success: function(data) {
                        console.log(data);
                        if (data.existName === 1) {
                            swal("Vui lòng nhập lại", 'Danh mục đã tồn tại', "error");
                            $('.tendanhmuc').val('')
                        }
                        if (data.existThutu === 1) {
                            swal("Vui lòng nhập lại", 'Thứ tự đã tồn tại', "error");
                            $('.thutu').val('');
                        }

                        if (data.existThutu === 0 && data.existName === 0) {
                            $('.tendanhmuc').val('')
                            $('.thutu').val('');
                            swal("OK!", "Thêm thành công", "success");
                            view_data();
                        }
                    }
                })
            }

        })
    })
</script>