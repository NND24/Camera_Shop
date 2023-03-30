<div id="product__edit-model">
    <div class="model__container">
        <form enctype="multipart/form-data">
            <div class="model__add-new">
                <h3>Sửa sản phẩm</h3>
                <div class="close-modal">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="model__content">
                    <label class="col-2">Tên sản phẩm: </label>
                    <input type="text" class="tensanpham" />
                </div>
                <div class="model__content">
                    <label class="col-2">Danh mục sản phẩm: </label>
                    <select class="danhmuc">
                        <?php
                        $mysqli = new mysqli("localhost", "root", "", "camera_shop");
                        $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc ASC";
                        $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
                        while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
                        ?>
                        <option value="<?php echo $row_danhmuc['id_danhmuc'] ?>">
                            <?php echo $row_danhmuc['ten_danhmuc'] ?>
                        </option>

                        <?php } ?>
                    </select>
                </div>
                <div class="model__content">
                    <label class="col-2">Hình ảnh: </label>
                    <input type="file" name="file" class="file[]">
                    <img src="" class="image" alt="" style="width:100px; border:1px solid #ccc;">
                </div>
                <div class="model__content">
                    <label class="col-2">Giá sản phẩm: </label>
                    <input type="number" min="0" class="giasp" />
                </div>
                <div class="model__content">
                    <label class="col-2">Số lượng: </label>
                    <input type="number" min="0" class="soluong" />
                </div>
                <div class="model__content">
                    <label class="col-2">Giảm giá: </label>
                    <input type="number" min="0" class="giamgia" />
                </div>
                <div class="model__content">
                    <label class="col-2">Trạng thái: </label>
                    <select class="trangthai">
                        <option value="1" selected>Kích hoạt</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>
                <div class="model__content">
                    <label>Tóm tắt sản phẩm: </label>
                    <textarea id="product-tomtat"></textarea>
                </div>
                <div class="model__content">
                    <label>Chi tiết sản phẩm: </label>
                    <textarea id="product-detail"></textarea>
                </div>
                <button id="themsanpham">Thêm sản phẩm</button>
            </div>
        </form>
        <div class="modal__background"></div>
    </div>


    <script>
    $(document).ready(() => {
        CKEDITOR.replace('product-tomtat');
        CKEDITOR.replace('product-detail');

        var fileData;
        $(document).on("change", 'input[type="file"]', function() {
            var currentImg = this;
            fileData = currentImg.files[0];
            var formĐata = new FormData();
            formĐata.append('file', fileData);
            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function() {
                if (ajax.status == 200 && ajax.readyState == 4) {
                    var imgPath = ajax.responseText;
                    $('.image').attr('src', "http://localhost:3000/images/products/" + imgPath)
                }
            }
            ajax.open('POST',
                'modules/quanlysp/handleEvent/handleUpload.php', true);
            ajax.send(formĐata);


        })

        // Handle edit product
        $(document).on("click", '#themsanpham', function(e) {
            e.preventDefault()
            var tensanpham = $('.tensanpham').val();
            var danhmuc = $('.danhmuc').val();
            var giasp = $('.giasp').val();
            var soluong = $('.soluong').val();
            var giamgia = $('.giamgia').val();
            var trangthai = $('.trangthai').val();
            var tomtat = CKEDITOR.instances['product-tomtat'].getData();
            var noidung = CKEDITOR.instances['product-detail'].getData();

            var pageIndexMain = 1
            // View data
            function view_data() {
                $.post('http://localhost:3000/admin/modules/quanlysp/handleEvent/listProductData.php?pageIndex=' +
                    pageIndexMain,
                    function(data) {
                        $('#load_product_data').html(data)
                    })
            }

            /** VALIDATE START **/
            let errors = {
                nameError: '',
                priceError: '',
                amountError: '',
                discountError: '',
                briefError: '',
                detailError: '',
            }

            // Validate product name
            if (tensanpham.length === 0) {
                errors.nameError = "Tên sản phẩm không được để trống";
                swal("Vui lòng nhập lại", errors.nameError, "error");
                $('.tensanpham').css("border-color", "#ff000087");
            } else {
                errors.nameError = '';
                $('.tensanpham').css("border-color", "#008000ab");
            }

            // Validate product image
            if (!fileData) {
                errors.imageError = "Hình ảnh sản phẩm không được để trống";
                swal("Vui lòng nhập lại", errors.imageError, "error");
                $('input[type="file"]').css("border-color", "#ff000087",
                    "background-color",
                    "#ff000059");
            } else {
                errors.imageError = '';
                $('input[type="file"]').css("border-color", "#008000ab");
            }

            // Validate product price
            if (giasp.length === 0) {
                errors.priceError = "Giá sản phẩm không được để trống";
                swal("Vui lòng nhập lại", errors.priceError, "error");
                $('.giasp').css("border-color", "#ff000087");
            } else if (giasp < 0) {
                errors.priceError = "Giá sản phẩm phải lớn hơn 0";
                swal("Vui lòng nhập lại", errors.priceError, "error");
                $('.giasp').css("border-color", "#ff000087");
            } else {
                errors.priceError = '';
                $('.giasp').css("border-color", "#008000ab");
            }

            // Validate product amount
            if (soluong.length === 0) {
                errors.amountError = "Số lượng sản phẩm không được để trống";
                swal("Vui lòng nhập lại", errors.amountError, "error");
                $('.soluong').css("border-color", "#ff000087");
            } else if (soluong < 0) {
                errors.priceError = "Số lượng sản phẩm phải lớn hơn 0";
                swal("Vui lòng nhập lại", errors.priceError, "error");
                $('.soluong').css("border-color", "#ff000087");
            } else {
                errors.amountError = '';
                $('.soluong').css("border-color", "#008000ab");
            }

            // Validate product discount
            if (giamgia.length === 0) {
                errors.discountError = "Giảm giá không được để trống";
                swal("Vui lòng nhập lại", errors.discountError, "error");
                $('.giamgia').css("border-color", "#ff000087");
            } else if (giamgia < 0) {
                errors.priceError = "Giảm giá phải lớn hơn 0";
                swal("Vui lòng nhập lại", errors.priceError, "error");
                $('.giamgia').css("border-color", "#ff000087");
            } else {
                errors.discountError = '';
                $('.giamgia').css("border-color", "#008000ab");
            }

            // Validate product brief
            if (tomtat.length === 0) {
                errors.briefError = "Tóm tắt sản phẩm không được để trống";
                swal("Vui lòng nhập lại", errors.briefError, "error");
                $('.cke_chrome').css("border-color", "#ff000087");
            } else {
                errors.briefError = '';
                $('.cke_chrome').css("border-color", "#008000ab");
            }

            // Validate product detail
            if (noidung.length === 0) {
                errors.detailError = "Nội dung sản phẩm không được để trống";
                swal("Vui lòng nhập lại", errors.detailError, "error");
                $('.cke_chrome').css("border-color", "#ff000087");
            } else {
                errors.detailError = '';
                $('.cke_chrome').css("border-color", "#008000ab");
            }
            /** VALIDATE END **/
            console.log(fileData)
            /** SEND DATA **/
            if (errors.nameError == '' && errors.priceError == '' && errors
                .amountError == '' &&
                errors
                .discountError == '' && errors.briefError == '' && errors.detailError ==
                '') {
                //Send image
                var form_data = new FormData();
                form_data.append('file', fileData);
                form_data.append('tensanpham', tensanpham);
                form_data.append('danhmuc', danhmuc);
                form_data.append('giasp', giasp);
                form_data.append('soluong', soluong);
                form_data.append('giamgia', giamgia);
                form_data.append('trangthai', trangthai);
                form_data.append('tomtat', tomtat);
                form_data.append('noidung', noidung);

                var ajax = new XMLHttpRequest();
                ajax.open('POST', 'modules/quanlysp/handleEvent/handleAddProduct.php',
                    true);
                ajax.send(form_data);

                ajax.onreadystatechange = function() {
                    if (ajax.readyState === 4 && ajax.status === 200) {
                        var response = JSON.parse(ajax.responseText);
                        console.log(response)
                        if (response.existName == 1) {
                            swal("Vui lòng nhập lại", "Tên sản phẩm đã tồn tại",
                                "error");
                            $('.tensanpham').css("border-color", "#ff000087");
                            $('.tensanpham').val('');
                        } else {
                            swal("OK!", "Thêm thành công", "success");
                            $('.tensanpham').css("border-color", "grey");
                            $('.tensanpham').val('');
                            $('.giasp').css("border-color", "grey");
                            $('.giasp').val('');
                            $('.soluong').css("border-color", "grey");
                            $('.soluong').val('');
                            $('.giamgia').css("border-color", "grey");
                            $('.giamgia').val('');
                            $('.cke_chrome').css("border-color", "grey");
                            CKEDITOR.instances['product-tomtat'].setData('');
                            CKEDITOR.instances['product-detail'].setData('');
                            $('.image').attr('src', "");
                            $('input[type="file"]').val('');
                            view_data();
                        }
                    }
                };

            }
        })

    })
    </script>
</div>