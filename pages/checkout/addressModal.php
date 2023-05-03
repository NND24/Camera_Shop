<?php
include('../../admin/config/config.php');
?>
<div class="address__modal-container">
    <div class="address__modal-wrapper">
        <div class="close-add-address-modal">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <span class="address__modal-header">Thêm thông tin</span>
        <div class="address__modal-form col-12">
            <label class="address-input-label">Họ và tên</label>
            <input class="address__modal-input name" placeholder="Họ và tên" type="text">
        </div>
        <div class="address__modal-form col-12">
            <label class="address-input-label">Số điện thoại</label>
            <input class="address__modal-input phonenumber" placeholder="Số điện thoại" type="number">
        </div>
        <div class="address__modal-form col-4">
            <label class="address-input-label">Tỉnh/Thành phố</label>
            <select id="province" class="address__modal-input">
                <option value="">Chọn một tỉnh</option>
                <?php
                $sql_province = "SELECT * FROM province";
                $query_province = mysqli_query($mysqli, $sql_province);
                while ($row_province = mysqli_fetch_array($query_province)) {
                ?>
                    <option value="<?php echo $row_province['province_id'] ?>"><?php echo $row_province['name'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="address__modal-form col-4">
            <label class="address-input-label">Quận/Huyện</label>
            <select id="district" class="address__modal-input">
                <option value="">Chọn một quận/huyện</option>
            </select>
        </div>
        <div class="address__modal-form col-4">
            <label class="address-input-label">Phường/Xã</label>
            <select id="wards" class="address__modal-input">
                <option value="">Chọn một xã</option>
            </select>
        </div>
        <div class="address__modal-form col-12">
            <label class="address-input-label">Địa chỉ chi tiết</label>
            <input class="address__modal-input address-input" placeholder="Địa chỉ chi tiết" type="text">
        </div>
        <div class="col-12" style="display: flex;justify-content: end;">
            <button class="confirm-address-btn">Hoàn thành</button>
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