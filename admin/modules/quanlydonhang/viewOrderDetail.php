<div id="order__detail-model">
    <?php
    $mysqli = new mysqli("localhost", "root", "", "camera_shop");
    $sql_order = "SELECT * FROM tbl_order, tbl_user WHERE tbl_order.id_user=tbl_user.id_user AND tbl_order.id_order='" . $_GET['id_order'] . "' LIMIT 1";
    $query_order = mysqli_query($mysqli, $sql_order);
    $row_order = mysqli_fetch_array($query_order);

    $sql_order_details = "SELECT * FROM tbl_order_details, tbl_sanpham WHERE tbl_order_details.id_sanpham=tbl_sanpham.id_sanpham AND tbl_order_details.order_code='$row_order[order_code]' ";
    $query_order_details = mysqli_query($mysqli, $sql_order_details);

    $sql_address = "SELECT * FROM tbl_user WHERE id_user='$row_order[id_user]' LIMIT 1 ";
    $query_address = mysqli_query($mysqli, $sql_address);
    $row_address = mysqli_fetch_array($query_address);

    $sql_province = "SELECT * FROM province WHERE province_id='$row_address[province_id]' LIMIT 1 ";
    $query_province = mysqli_query($mysqli, $sql_province);
    $row_province = mysqli_fetch_array($query_province);

    $sql_district = "SELECT * FROM district WHERE district_id='$row_address[district_id]' LIMIT 1 ";
    $query_district = mysqli_query($mysqli, $sql_district);
    $row_district = mysqli_fetch_array($query_district);

    $sql_wards = "SELECT * FROM wards WHERE wards_id='$row_address[wards_id]' LIMIT 1 ";
    $query_wards = mysqli_query($mysqli, $sql_wards);
    $row_wards = mysqli_fetch_array($query_wards);
    ?>
    <div class="model__container">
        <form>
            <div class="model__add-new">
                <h3>Duyệt đơn hàng</h3>
                <div class="close-modal">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="model__content">
                    <label class="col-2">Tên khách hàng: </label>
                    <input type="text" readonly value="<?php echo $row_order['tendathang'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Email: </label>
                    <input type="text" readonly value="<?php echo $row_order['email'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Số điện thoại: </label>
                    <input type="text" readonly value="<?php echo $row_order['phonenumber'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Địa chỉ: </label>
                    <input type="text" readonly
                        value="<?php echo $row_wards['name'] ?>, <?php echo $row_district['name'] ?>, <?php echo $row_province['name'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Địa chỉ chi tiết: </label>
                    <input readonly type="text" value="<?php echo $row_address['address_detail'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Ngày mua hàng: </label>
                    <input readonly type="text" value="<?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                        echo date('d/m/Y', $row_order['buyed_date']) ?>" />
                </div>
                <?php if ($row_order['browsed_date'] != 0) { ?>
                <div class="model__content">
                    <label class="col-2">Ngày duyệt đơn: </label>
                    <input readonly type="text" value="<?php echo date('d/m/Y', $row_order['browsed_date']) ?>" />
                </div>
                <?php } else { ?>
                <div class="model__content">
                    <label class="col-2">Ngày duyệt đơn: </label>
                    <input readonly type="text" value="Đơn hàng chưa được duyệt" />
                </div>
                <?php } ?>
                <div class="model__content">
                    <label class="col-2">Tổng sản phẩm: </label>
                    <input type="number" readonly value="<?php echo $row_order['amount'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Tổng tiền: </label>
                    <input type="text" readonly
                        value="<?php echo number_format($row_order['total'], 0, ',', '.')  ?>đ" />
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
                    $sql_order_detail = "SELECT * FROM tbl_order_details, tbl_sanpham WHERE tbl_order_details.id_sanpham=tbl_sanpham.id_sanpham AND tbl_order_details.order_code='$row_order[order_code]' ";
                    $query_order_detail = mysqli_query($mysqli, $sql_order_detail);
                    $sosp = 0;
                    while ($row_order_detail = mysqli_fetch_array($query_order_detail)) {
                        $sosp += $row_order_detail['soluongmua'];
                        $thanhtien = $row_order_detail['soluongmua'] * $row_order_detail['giadagiam'];
                        $thanhtien = round($thanhtien, -3);

                        @$sql_danhmuc = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc='$row_order_detail[id_danhmuc]' LIMIT 1";
                        $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
                        $row_danhmuc = mysqli_fetch_array($query_danhmuc)
                    ?>
                    <div class="row no-wrap border-bottom">
                        <div class="row  no-wrap order align-items-center justify-content-between order__wrapper">

                            <div class="col-lg-1 col-md-1 col-sm-2 col-2 order__img-product">
                                <img class="img-fluid"
                                    src="./modules/quanlysp/handleEvent/uploads/<?php echo $row_order_detail['hinhanh'] ?>">
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-5 col-4 ">
                                <div class="row text-muted order__name-category category__product-btn">
                                    <?php echo $row_danhmuc['ten_danhmuc'] ?>
                                </div>
                                <div class="row order__name-product">
                                    <?php echo $row_order_detail['tensanpham'] ?>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-2 col-3 justify-content-center order__price">
                                <?php echo number_format($row_order_detail['giadagiam'], 0, ',', '.') ?>đ
                            </div>

                            <div class="col-lg-1 col-md-1 col-sm-1 col-1 order__price">
                                <div class="quantity-wrapper">
                                    <span><?php echo $row_order_detail['soluongmua'] ?></span>
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
                if ($row_order['order_status'] == 0) {
                ?>
                <button id="duyetdonhang">Duyệt đơn hàng</button>
                <?php } else { ?>
                <button id="huydonhang">Hủy đơn hàng</button>
                <?php } ?>
            </div>
        </form>
        <div class="modal__background modal__add-order"></div>
    </div>
    <script>
    $(document).ready(() => {

        $(document).on("click", '#duyetdonhang', function(e) {
            var pageIndexOrderMain = 1
            // View data
            function view_data() {
                $.post('modules/quanlydonhang/handleEvent/listOrderData.php?pageIndex=' +
                    pageIndexOrderMain,
                    function(data) {
                        $('#load_order_data').html(data)
                    })
            }
            view_data();

            e.preventDefault();
            $.post('modules/quanlydonhang/handleEvent/browseOrder.php?id_order=' +
                <?php echo $_GET['id_order'] ?> + '&action=duyet',
                function() {
                    swal("OK!", "Duyệt thành công", "success");
                    view_data();
                })
        })

        $(document).on("click", '#huydonhang', function(e) {
            var pageIndexOrderMain = 1
            // View data
            function view_data() {
                $.post('modules/quanlydonhang/handleEvent/listOrderData.php?pageIndex=' +
                    pageIndexOrderMain,
                    function(data) {
                        $('#load_order_data').html(data)
                    })
            }
            view_data();

            e.preventDefault();
            $.post('modules/quanlydonhang/handleEvent/browseOrder.php?id_order=' +
                <?php echo $_GET['id_order'] ?> + '&query=huy',
                function() {
                    swal("OK!", "Hủy thành công", "success");
                    view_data();
                })
        })
    })
    </script>
</div>