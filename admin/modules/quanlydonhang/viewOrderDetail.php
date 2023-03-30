<div id="order__detail-model">
    <?php
    $mysqli = new mysqli("localhost", "root", "", "camera_shop");
    $sql_cart = "SELECT * FROM tbl_cart, tbl_user WHERE tbl_cart.id_khachhang=tbl_user.id_user AND tbl_cart.id_cart='" . $_GET['id_cart'] . "' LIMIT 1";
    $query_cart = mysqli_query($mysqli, $sql_cart);
    $row_cart = mysqli_fetch_array($query_cart);

    $sql_cart_details = "SELECT * FROM tbl_cart_details, tbl_sanpham WHERE tbl_cart_details.id_sanpham=tbl_sanpham.id_sanpham AND tbl_cart_details.code_cart='$row_cart[code_cart]' ";
    $query_cart_details = mysqli_query($mysqli, $sql_cart_details);

    $sosanpham = 0;
    $moneySum = 0;
    while ($row_cart_details = mysqli_fetch_array($query_cart_details)) {
        $sosanpham += $row_cart_details['soluongmua'];
        $money = $row_cart_details['soluongmua'] * $row_cart_details['giasp'];
        $moneySum += $money;
    }
    ?>
    <div class="model__container">
        <form>
            <div class="model__add-new">
                <h3>Chi tiết đơn hàng</h3>
                <div class="close-modal">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="model__content">
                    <label class="col-2">Tên khách hàng: </label>
                    <input type="text" readonly value="<?php echo $row_cart['tendathang'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Email: </label>
                    <input type="text" readonly value="<?php echo $row_cart['email'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Số điện thoại: </label>
                    <input type="text" readonly value="<?php echo $row_cart['sodienthoaidathang'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Địa chỉ: </label>
                    <input type="text" readonly value="<?php echo $row_cart['address'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Ngày mua hàng: </label>
                    <input readonly type="text" value="<?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                        echo date('d/m/Y H:i', $row_cart['buy_time']) ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Ngày duyệt đơn: </label>
                    <input readonly type="text" value="<?php echo date('d/m/Y H:i', $row_cart['browse_time']) ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Tổng tiền: </label>
                    <input type="number" readonly value="<?php echo $sosanpham ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Tổng tiền: </label>
                    <input type="text" readonly value="<?php echo number_format($moneySum, 0, ',', '.')  ?>đ" />
                </div>
                <div class="model__content">
                    <div class="row order__header">
                        <span class="col-lg-6 col-md-6 col-6 order__header-title">Sản phẩm</span>
                        <span class="col-lg-2 col-md-2 col-2 order__header-text d-flex justify-content-end">Đơn
                            giá</span>
                        <span class="col-lg-2 col-md-2 col-2 order__header-text d-flex justify-content-end">Số
                            lượng</span>
                        <span class="col-lg-2 col-md-2 col-2 order__header-text d-flex justify-content-end">Thành
                            tiền</span>
                    </div>
                    <?php
                    $sql_cart_detail = "SELECT * FROM tbl_cart_details, tbl_sanpham WHERE tbl_cart_details.id_sanpham=tbl_sanpham.id_sanpham AND tbl_cart_details.code_cart='$row_cart[code_cart]' ";
                    $query_cart_detail = mysqli_query($mysqli, $sql_cart_detail);
                    $sosp = 0;
                    $tongtien = 0;
                    while ($row_cart_detail = mysqli_fetch_array($query_cart_detail)) {
                        $sosp += $row_cart_detail['soluongmua'];
                        $thanhtien = $row_cart_detail['soluongmua'] * $row_cart_detail['giasp'];
                        $tongtien += $thanhtien;

                        @$sql_danhmuc = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc='$row_cart_detail[id_danhmuc]' LIMIT 1";
                        $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
                        $row_danhmuc = mysqli_fetch_array($query_danhmuc)
                    ?>
                    <div class="row no-wrap border-bottom">
                        <div class="row  no-wrap order align-items-center justify-content-between order__wrapper">

                            <div class="col-lg-1 col-md-1 col-sm-2 col-2 order__img-product">
                                <img class="img-fluid"
                                    src="./modules/quanlysp/handleEvent/uploads/<?php echo $row_cart_detail['hinhanh'] ?>">
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-5 col-4 ">
                                <div class="row text-muted order__name-category category__product-btn">
                                    <?php echo $row_danhmuc['ten_danhmuc'] ?>
                                </div>
                                <div class="row order__name-product">
                                    <?php echo $row_cart_detail['tensanpham'] ?>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-2 col-3 justify-content-center order__price">
                                <?php echo number_format($row_cart_detail['giasp'], 0, ',', '.') ?>đ
                            </div>

                            <div class="col-lg-1 col-md-1 col-sm-1 col-1 order__price">
                                <div class="quantity-wrapper">
                                    <span><?php echo $row_cart_detail['soluongmua'] ?></span>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-2 d-flex justify-content-end order__price">
                                <?php echo number_format($thanhtien, 0, ',', '.')  ?>đ
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <?php
                if ($row_cart['cart_status'] == 0) {
                ?>
                <button id="duyetdonhang">Duyệt đơn hàng</button>
                <?php } else { ?>
                <button id="huydonhang">Hủy đơn hàng</button>
                <?php } ?>
            </div>
        </form>
        <div class="modal__background"></div>
    </div>
    <script>
    $(document).ready(() => {

        $(document).on("click", '#duyetdonhang', function(e) {
            var pageIndexOrderMain = 1
            // View data
            function view_data() {
                $.post('http://localhost:3000/admin/modules/quanlydonhang/handleEvent/listOrderData.php?pageIndex=' +
                    pageIndexOrderMain,
                    function(data) {
                        $('#load_order_data').html(data)
                    })
            }
            view_data();

            e.preventDefault();
            $.post('http://localhost:3000/admin/modules/quanlydonhang/handleEvent/browseOrder.php?id_cart=' +
                <?php echo $_GET['id_cart'] ?> + '&action=duyet',
                function() {
                    swal("OK!", "Duyệt thành công", "success");
                    view_data();
                })
        })

        $(document).on("click", '#huydonhang', function(e) {
            var pageIndexOrderMain = 1
            // View data
            function view_data() {
                $.post('http://localhost:3000/admin/modules/quanlydonhang/handleEvent/listOrderData.php?pageIndex=' +
                    pageIndexOrderMain,
                    function(data) {
                        $('#load_order_data').html(data)
                    })
            }
            view_data();

            e.preventDefault();
            $.post('http://localhost:3000/admin/modules/quanlydonhang/handleEvent/browseOrder.php?id_cart=' +
                <?php echo $_GET['id_cart'] ?> + '&query=huy',
                function() {
                    swal("OK!", "Hủy thành công", "success");
                    view_data();
                })
        })
    })
    </script>
</div>