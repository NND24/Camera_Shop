<div class="model__add-new-container">
    <div class="model-close-btn"><i class="fa-solid fa-xmark"></i></div>
    <form method="" enctype="multipart/form-data">
        <div class="model__add-new">
            <h3>Thêm sản phẩm</h3>
            <div class="model__content">
                <label class="col-2">Tên sản phẩm: </label>
                <input type="text" name="tensanpham" class="tensanpham" />
            </div>
            <div class="model__content">
                <label class="col-2">Danh mục sản phẩm: </label>
                <select name="danhmuc" class="danhmuc">
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
                    <option value="<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['ten_danhmuc'] ?>
                    </option>
                    <?php
                        }
                        ?>
                    <?php } ?>
                </select>
            </div>
            <div class="model__content">
                <label class="col-2">Hình ảnh: </label>
                <input type="file" name="file" class="file[]">
                <img src="" class="image" alt="" style="width:100px;">
            </div>
            <div class="model__content">
                <label class="col-2">Giá sản phẩm: </label>
                <input type="number" name="giasp" class="giasp" />
            </div>
            <div class="model__content">
                <label class="col-2">Số lượng: </label>
                <input type="number" name="soluong" class="soluong" />
            </div>
            <div class="model__content">
                <label class="col-2">Giảm giá: </label>
                <input type="number" name="giamgia" class="giamgia" />
            </div>
            <div class="model__content">
                <label class="col-2">Trạng thái: </label>
                <select name="trangthai" class="trangthai">
                    <option value="1" selected>Kích hoạt</option>
                    <option value="0">Ẩn</option>
                </select>
            </div>
            <div class="model__content">
                <label>Tóm tắt sản phẩm: </label>
                <textarea name="tomtat" class="product-tomtat" id="product-tomtat"></textarea>
            </div>
            <div class="model__content">
                <label>Chi tiết sản phẩm: </label>
                <textarea name="noidung" class="product-detail" id="product-detail"></textarea>
            </div>
            <button id="themsanpham" name="themsanpham">Thêm sản phẩm</button>
        </div>
    </form>
</div>

<script>
$(document).ready(() => {
    CKEDITOR.replace('product-tomtat')
    CKEDITOR.replace('product-detail')

    $('input[type="file"]').on('change', function() {
        var currentImg = this;
        var fileData = currentImg.files[0];
        var formĐata = new FormData();
        formĐata.append('file', fileData);
        var ajax = new XMLHttpRequest();
        ajax.onreadystatechange = function() {
            if (ajax.status == 200 && ajax.readyState == 4) {
                var imgPath = ajax.responseText;
                $('.image').attr('src', "modules/quanlysp/handleEvent/" + imgPath)
            }
        }
        ajax.open('POST',
            'modules/quanlysp/handleEvent/handleUpload.php', true);
        ajax.send(formĐata);
    })

    // View data
    function view_data() {
        $.post('http://localhost:3000/admin/modules/quanlysp/handleEvent/listProductData.php',
            function(data) {
                $('#load_product_data').html(data)
            })
    }
    view_data();

    // Handle add new product
    $('#themsanpham').click((e) => {
        e.preventDefault();
        var tensanpham = $('.tensanpham').val();
        var danhmuc = $('.danhmuc').val();
        var giasp = $('.giasp').val();
        var soluong = $('.soluong').val();
        var giamgia = $('.giamgia').val();
        var trangthai = $('.trangthai').val();
        var tomtat = CKEDITOR.instances['product-tomtat'].getData();
        var noidung = CKEDITOR.instances['product-detail'].getData();

        // currentImg = document.querySelector('input[type="file"]');
        // var fileData = currentImg.files[0];
        // var formĐata = new FormData();
        // formĐata.append('file', fileData);
        // var ajax = new XMLHttpRequest();
        // console.log(formĐata)
        // ajax.open('POST',
        //     'modules/quanlysp/handleEvent/handleAddproduct.php', true);
        // ajax.send(formĐata);

        let errors = {
            nameError: '',
            imageError: '',
            priceError: '',
            countError: '',
            saleError: '',
            tomtatError: '',
            detailError: '',
        }

        // Validate product name
        // if (tensanpham.length === 0) {
        //     errors.nameError = 'Tên sản phẩm không được để trống'
        //     swal("Vui lòng nhập lại", errors.nameError, "error");
        //     $('.tensanpham').val('')
        // } else {
        //     errors.nameError = '';
        // }

        // Validate thu tu
        // if (thutu.length === 0) {
        //     errors.thuTuError = 'Thứ tự không được để trống'
        //     swal("Vui lòng nhập lại", errors.thuTuError, "error");
        //     $('.thutu').val('');
        // } else if (thutu <= 0) {
        //     errors.thuTuError = 'Thứ tự phải lớn hơn 1'
        //     swal("Vui lòng nhập lại", errors.thuTuError, "error");
        //     $('.thutu').val('');
        // } else {
        //     errors.thuTuError = '';
        // }

        // Validate product detail
        // if (content.length === 0) {
        //     errors.detailError = 'Nội dung danh mục không được để trống'
        //     swal("Vui lòng nhập lại", errors.detailError, "error");
        // } else {
        //     errors.detailError = ''
        //     $('.errorDetail').text(errors.detailError);
        // }

        if (true) {
            $.ajax({
                url: "http://localhost:3000/admin/modules/quanlysp/handleEvent/handleAddproduct.php",
                data: {
                    tensanpham: tensanpham,
                    danhmuc: danhmuc,
                    giasp: giasp,
                    soluong: soluong,
                    giamgia: giamgia,
                    trangthai: trangthai,
                    tomtat: tomtat,
                    noidung: noidung,
                },
                dataType: 'json',
                method: "post",
                cache: true,
                success: function(data) {
                    console.log(data)
                    view_data();
                    // if (data.existName === 1) {
                    //     swal("Vui lòng nhập lại", 'Danh mục đã tồn tại', "error");
                    //     $('.tendanhmuc').val('')
                    // }
                    // if (data.existThutu === 1) {
                    //     swal("Vui lòng nhập lại", 'Thứ tự đã tồn tại', "error");
                    //     $('.thutu').val('');
                    // }

                    // if (data.existThutu === 0 && data.existName === 0) {
                    //     $('.tendanhmuc').val('')
                    //     $('.thutu').val('');
                    //     swal("OK!", "Thêm thành công", "success");
                    //     view_data();
                    // }
                }
            })
        }

    })
})
</script>