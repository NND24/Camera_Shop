<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
$sql_user = "SELECT * FROM tbl_user WHERE id_user = '$_SESSION[id_user]' LIMIT 1 ";
$query_user = mysqli_query($mysqli, $sql_user);
$row_user = mysqli_fetch_array($query_user)
?>
<div class="address__modal-container">
    <div class="address__modal-wrapper">
        <div class="close-add-address-modal">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <span class="address__modal-header">Đổi địa chỉ</span>
        <div class="address__modal-form col-12">
            <label class="address-input-label">Họ và tên</label>
            <input class="address__modal-input name" value="<?php echo $row_user['tendathang'] ?>" placeholder="Họ và tên" type="text">
        </div>
        <div class="address__modal-form col-12">
            <label class="address-input-label">Số điện thoại</label>
            <input class="address__modal-input phonenumber" value="<?php echo $row_user['sodienthoaidathang'] ?>" placeholder="Số điện thoại" type="number">
        </div>
        <div class="address__modal-form col-12">
            <label class="address-input-label">Tỉnh/Thành phố, Quận/Huyện, Phường/Xã</label>
            <input class="address__modal-input address-input" value="<?php echo $row_user['address'] ?>" placeholder="Tỉnh/Thành phố, Quận/Huyện, Phường/Xã" type="text">
        </div>
        <button class="edit-address-btn">Hoàn thành</button>
    </div>
    <div class="address__modal-background"></div>
</div>