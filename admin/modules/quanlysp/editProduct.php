<div id="product__edit-model">
    <?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
$sql_view_detail_sp = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc AND id_sanpham='" . $_GET['idsanpham'] . "' LIMIT 1";
$query_view_detail_sp = mysqli_query($mysqli, $sql_view_detail_sp);
while ($row = mysqli_fetch_array($query_view_detail_sp)) {
?>
    <div class="model__container">
        <div class="model-close-btn"><i class="fa-solid fa-xmark" style="padding-bottom: 1460px;"></i></div>
        <form method="" enctype=" multipart/form-data">
            <div class="model__add-new">
                <h3>Sửa sản phẩm</h3>
                <div class="model__content">
                    <label class="col-2">Tên sản phẩm: </label>
                    <input type="text" class="tensanpham" value="<?php echo $row['tensanpham'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Danh mục sản phẩm: </label>
                    <select class="danhmuc">
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
                        <option value="<?php echo $row_danhmuc['id_danhmuc'] ?>">
                            <?php echo $row_danhmuc['ten_danhmuc'] ?>
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
                    <img src="modules/quanlysp/handleEvent/uploads/<?php echo $row['hinhanh'] ?>" class="image" alt=""
                        style="width:100px; border:1px solid #ccc;">
                </div>
                <div class="model__content">
                    <label class="col-2">Giá sản phẩm: </label>
                    <input type="number" class="giasp" value="<?php echo $row['giasp'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Số lượng: </label>
                    <input type="number" class="soluong" value="<?php echo $row['soluong'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Giảm giá: </label>
                    <input type="number" class="giamgia" value="<?php echo $row['giamgia'] ?>" />
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
                    <textarea id="product-edit-tomtat"><?php echo $row['tomtat'] ?></textarea>
                </div>
                <div class="model__content">
                    <label>Chi tiết sản phẩm: </label>
                    <textarea id="product-edit-detail"><?php echo $row['noidung'] ?></textarea>
                </div>
                <button id="suasanpham" name="suasanpham">Sửa sản phẩm</button>
            </div>
        </form>
    </div>
    <?php
}
?>

    <script>
    $(document).ready(() => {
        CKEDITOR.replace('product-edit-tomtat');
        CKEDITOR.replace('product-edit-detail');

        $('input[type="file"]').on('change', function() {
            var currentImg = this;
            var fileData = currentImg.files[0];
            var formĐata = new FormData();
            formĐata.append('file', fileData);
            var ajax = new XMLHttpRequest();
            ajax.onreadystatechange = function() {
                if (ajax.status == 200 && ajax.readyState == 4) {
                    var imgPath = ajax.responseText;
                    // $('.image').attr('src', " ")
                    $('.image').attr('src', "http://localhost:3000/images/products/" + imgPath)
                }
            }
            ajax.open('POST',
                'modules/quanlysp/handleEvent/handleUpload.php', true);
            ajax.send(formĐata);
        })

        // Handle edit product
        $('#suasanpham').click((e) => {
            e.preventDefault()
            var tensanpham = $('.tensanpham').val();
            var danhmuc = $('.danhmuc').val();
            var giasp = $('.giasp').val();
            var soluong = $('.soluong').val();
            var giamgia = $('.giamgia').val();
            var trangthai = $('.trangthai').val();
            var tomtat = CKEDITOR.instances['product-edit-tomtat'].getData();
            var noidung = CKEDITOR.instances['product-edit-detail'].getData();

            var currentImg = document.querySelector('input[type="file"]');
            var fileData = currentImg.files[0];
            var formĐata = new FormData();
            formĐata.append('file', fileData);
            var ajax = new XMLHttpRequest();
            console.log(formĐata)
            ajax.open('POST',
                'modules/quanlysp/handleEvent/handleEditProduct.php?query=image', true);
            ajax.send(formĐata);

            function view_data() {
                $.post('http://localhost:3000/admin/modules/quanlysp/handleEvent/listproductData.php',
                    function(
                        data) {
                        $('#load_product_data').html(data)
                    })
            }

            $.ajax({
                url: "http://localhost:3000/admin/modules/quanlysp/handleEvent/handleEditProduct.php?action=edit",
                data: {
                    tensanpham: tensanpham,
                    danhmuc: danhmuc,
                    giasp: giasp,
                    soluong: soluong,
                    giamgia: giamgia,
                    trangthai: trangthai,
                    tomtat: tomtat,
                    noidung: noidung,
                    idsanpham: <?php echo $_GET['idsanpham'] ?>,
                },
                dataType: 'json',
                method: "post",
                cache: true,
                success: function(data) {
                    console.log('Du lieu: ', data);
                    view_data();
                }
            })
        })
    })
    </script>
</div>