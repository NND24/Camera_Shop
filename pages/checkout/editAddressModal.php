<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
$sql_user = "SELECT * FROM tbl_user WHERE id_user = '$_SESSION[id_user]' LIMIT 1 ";
$query_user = mysqli_query($mysqli, $sql_user);
$row_user = mysqli_fetch_array($query_user);

$sql_address = "SELECT * FROM tbl_user WHERE id_user='$_SESSION[id_user]' LIMIT 1 ";
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
<div class="address__modal-container">
    <div class="address__modal-wrapper">
        <div class="close-add-address-modal">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <span class="address__modal-header">Đổi địa chỉ</span>
        <div class="address__modal-form col-12">
            <label class="address-input-label">Họ và tên đặt hàng</label>
            <input class="address__modal-input name" value="<?php echo $row_user['tendathang'] ?>" placeholder="Họ và tên đặt hàng" type="text">
        </div>
        <div class="address__modal-form col-12">
            <label class="address-input-label">Số điện thoại đặt hàng</label>
            <input class="address__modal-input phonenumber" value="<?php echo $row_user['phonenumber'] ?>" placeholder="Số điện thoại đặt hàng" type="number">
        </div>
        <div class="address__modal-form col-4">
            <label class="address-input-label">Tỉnh/Thành phố</label>
            <select id="province" class="address__modal-input">
                <option value="<?php echo $row_province['province_id'] ?>"><?php echo $row_province['name'] ?></option>
                <?php
                $sql_tinh = "SELECT * FROM province";
                $query_tinh = mysqli_query($mysqli, $sql_tinh);
                while ($row_tinh = mysqli_fetch_array($query_tinh)) {
                ?>
                    <option value="<?php echo $row_tinh['province_id'] ?>"><?php echo $row_tinh['name'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="address__modal-form col-4">
            <label class="address-input-label">Quận/Huyện</label>
            <select id="district" class="address__modal-input">
                <option value="<?php echo $row_district['district_id'] ?>"><?php echo $row_district['name'] ?></option>
            </select>
        </div>
        <div class="address__modal-form col-4">
            <label class="address-input-label">Phường/Xã</label>
            <select id="wards" class="address__modal-input">
                <option value="<?php echo $row_wards['wards_id'] ?>"><?php echo $row_wards['name'] ?></option>
            </select>
        </div>
        <div class="address__modal-form col-12">
            <label class="address-input-label">Địa chỉ chi tiết</label>
            <input class="address__modal-input address-input" value="<?php echo $row_user['address_detail'] ?>" placeholder="Địa chỉ chi tiết" type="text">
        </div>
        <div class="col-12" style="display: flex;justify-content: end;">
            <button class="edit-address-btn">Hoàn thành</button>
        </div>

    </div>
    <div class="address__modal-background"></div>
</div>

<script>
    $(document).ready(() => {
        $(document).on("change", '#province', function(e) {
            e.preventDefault()
            var province_id = $(this).val();
            if (province_id) {
                $.ajax({
                    url: " pages/checkout/getDistrict.php",
                    data: {
                        province_id: province_id,
                    },
                    dataType: 'json',
                    method: "post",
                    cache: true,
                    success: function(data) {
                        $('#district').empty();

                        $.each(data, function(i, district) {
                            $('#district').append($('<option>', {
                                value: district.id,
                                text: district.name
                            }));
                        });

                        $('#wards').empty();
                    }
                })
                $('#wards').empty();
            } else {
                $('#district').empty();
            }
        })

        $(document).on("change", '#district', function(e) {
            e.preventDefault()
            var district_id = $(this).val();
            if (district_id) {
                $.ajax({
                    url: " pages/checkout/getWard.php",
                    data: {
                        district_id: district_id,
                    },
                    dataType: 'json',
                    method: "post",
                    cache: true,
                    success: function(data) {
                        $('#ward').empty();
                        $.each(data, function(i, wards) {
                            $('#wards').append($('<option>', {
                                value: wards.id,
                                text: wards.name
                            }));
                        });
                    }
                })
            } else {
                $('#ward').empty();
            }
        })
    })
</script>