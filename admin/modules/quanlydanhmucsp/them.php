<div class="model__add-new-container">
    <div class="model-close-btn"><i class="fa-solid fa-xmark"></i></div>
    <form id="form-add-new-category" method="POST" enctype="multipart/form-data">
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
                <!-- The toolbar will be rendered in this container. -->
                <div id="toolbar-container"></div>

                <!-- This container will become the editable. -->
                <div name="category_detail" id="editor">
                </div>
                <span class="errorDetail" style="color:red;"></span>
            </div>
            <button id="themdanhmuc">Thêm danh mục sản phẩm</button>
            <span class="errorExist" style="color:red;"></span>
        </div>
    </form>
</div>



<script>
// CKEditor 5
var myEditor;
DecoupledEditor
    .create(document.querySelector('#editor'))
    .then(editor => {
        const toolbarContainer = document.querySelector('#toolbar-container');
        toolbarContainer.appendChild(editor.ui.view.toolbar.element);
        myEditor = editor;
    })
    .catch(error => {
        console.error(error);
    });

$(document).ready(() => {
    // Handle add new category
    $('#themdanhmuc').click((e) => {
        e.preventDefault();
        var tendanhmuc = $('.tendanhmuc').val();
        var thutu = $('.thutu').val();
        var trangthai = $('.trangthai').val();
        let errors = {
            nameError: '',
            thuTuError: '',
            detailError: ''
        }

        // Validate category name
        if (tendanhmuc.length === 0) {
            errors.nameError = 'Tên danh mục không được để trống'
            $('.errorName').text(errors.nameError);
        } else {
            errors.nameError = '';
            $('.errorName').text(errors.nameError);
        }

        // Validate thu tu
        if (thutu.length === 0) {
            errors.thuTuError = 'Thứ tự không được để trống'
            $('.errorThutu').text(errors.thuTuError);
        } else if (thutu <= 0) {
            errors.thuTuError = 'Thứ tự phải lớn hơn 1'
            $('.errorThutu').text(errors.thuTuError);
        } else {
            errors.thuTuError = ''
            $('.errorThutu').text(errors.thuTuError);
        }

        // Validate category detail
        if (myEditor.getData().length === 0) {
            errors.detailError = 'Nội dung danh mục không được để trống'
            $('.errorDetail').text(errors.detailError);
        } else {
            errors.detailError = ''
            $('.errorDetail').text(errors.detailError);
        }

        if (errors.detailError === '' && errors.thuTuError === '' && errors.nameError === '') {
            $.ajax({
                url: "http://localhost:3000/admin/modules/quanlydanhmucsp/handleAddCategory.php",
                data: {
                    tendanhmuc: tendanhmuc,
                    thutu: thutu,
                    trangthai: trangthai,
                    category_detail: myEditor.getData(),
                },
                dataType: 'json',
                method: "post",
                cache: true,
                success: function(data) {
                    console.log('Du lieu: ', data);
                    if (data.existName === 1) {
                        $('.errorName').text('Danh mục đã tồn tại');
                    } else {
                        $('.errorName').text('');
                    }
                    if (data.existThutu === 1) {
                        $('.errorThutu').text('Thứ tự đã tồn tại');
                    } else {
                        $('.errorThutu').text('');
                    }

                    if (data.existThutu === 0 && data.existName === 0) {
                        var created_time = data.category_created_time;
                        var updated_time = data.category_last_updated;

                        function getLocalTime(nS) {
                            return new Date(parseInt(nS) * 1000).toLocaleString('en-GB')
                                .slice(
                                    0, 17);
                        };

                        // Render category row
                        var category = `
                    <div class="products-row">
                    <button class="cell-more-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-more-vertical">
                            <circle cx="12" cy="12" r="1" />
                            <circle cx="12" cy="5" r="1" />
                            <circle cx="12" cy="19" r="1" />
                        </svg>
                    </button>
                    <div class="product-cell col-1-5 thutu-danhmuc ">
                        <p>${data.thutu}</p>
                    </div>
                    <div class="product-cell col-2 category ">
                        <p>${data.tendanhmuc}</p>
                    </div>
                    <div class="product-cell col status-cell">

                        
                        <span class="status active">Kích hoạt</span>
                        
                    </div>
                    <div class="product-cell col sales">${getLocalTime(created_time)}
                    </div>
                    <div class="product-cell col stock">${getLocalTime(updated_time)}
                    </div>
                    <div class="product-cell col-1-8 detail">
                    <button title="Xem chi tiết" class="detail-category" value="<?php echo $row['id_danhmuc'] ?>"><span>Xem
                chi tiết</span></button>
                    </div>
                    <div class="product-cell col-1 btn">
                        <!-- <a title="Xóa" href="modules/quanlydanhmucsp/xuly.php?iddanhmuc=<?php echo $row['id_danhmuc'] ?>"><i class="fa-solid fa-trash"></i></a> -->
                        <button class="remove-category" value="<?php echo $row['id_danhmuc'] ?>"><i
                class="fa-solid fa-trash"></i></button>
                    </div>
                    <div class="product-cell col-1 btn">
                        <a href="?action=quanlydanhmucsanpham&query=sua&iddanhmuc=<?php echo $row['id_danhmuc'] ?>"><i
                                class="fa-regular fa-pen-to-square"></i></a>
                    </div>
                </div>
                    `;
                        $('.products-area-wrapper').append(category);
                    }
                }
            })
        }

    })
})
</script>