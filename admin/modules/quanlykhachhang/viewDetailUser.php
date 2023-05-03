<?php
include('../../../admin/config/config.php');
$sql = "SELECT * FROM tbl_user WHERE id_user='" . $_GET['idUser'] . "' LIMIT 1";
$query = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_array($query);

$sql_address = "SELECT * FROM tbl_user WHERE id_user='$_GET[idUser]' LIMIT 1 ";
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
<div id="category__add-model">
    <div class="model__container">
        <form enctype="multipart/form-data">
            <div class="model__add-new">
                <h3>Chi tiết khách hàng</h3>
                <div class="close-modal">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="model__content">
                    <label class="col-2">Tên tài khoản: </label>
                    <input readonly value="<?php echo $row['name'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Tên khách hàng: </label>
                    <input readonly value="<?php echo $row['tendathang'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Email: </label>
                    <input readonly value="<?php echo $row['email'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Số điện thoại: </label>
                    <input readonly value="<?php echo $row['phonenumber'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Phường/Xã: </label>
                    <input readonly value="<?php echo @$row_wards['name'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Quận/Huyện: </label>
                    <input readonly value="<?php echo @$row_district['name'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Tỉnh/Thành phố: </label>
                    <input readonly value="<?php echo @$row_province['name'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Địa chỉ chi tiết: </label>
                    <input readonly value="<?php echo $row['address_detail'] ?>" />
                </div>
                <div class="model__content">
                    <label class="col-2">Ngày tạo: </label>
                    <input readonly value="<?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                                            echo date('d/m/Y H:i', $row['created_time']) ?>" />
                </div>
            </div>
        </form>
        <div class="modal__background modal__add-category"></div>
    </div>
</div>

<script>
    CKEDITOR.replace('view-content')
</script>