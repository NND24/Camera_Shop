<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
if (isset($_SESSION['cart']) && isset($_SESSION['id_user'])) {
    $sosp = 0;
    $tongtien = 0;
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['idUser'] == $_SESSION['id_user']) {
            $sosp += $cart_item['soluong'];
            $thanhtien = $cart_item['soluong'] * $cart_item['giasp'];
            $tongtien += $thanhtien;
            $sql_danhmuc = "SELECT * FROM tbl_danhmuc WHERE ten_danhmuc='$cart_item[tendanhmuc]' LIMIT 1";
            $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
            $row_danhmuc = mysqli_fetch_array($query_danhmuc)
?>
<div class="row border-bottom">
    <div class="row main align-items-center cart__wrapper">
        <div class="col-lg-1-5 cart__img-product view__product-detail" value="<?php echo $cart_item['id'] ?>"><img
                class="img-fluid"
                src="./admin/modules/quanlysp/handleEvent/uploads/<?php echo $cart_item['hinhanh'] ?>">
        </div>

        <div class="col-lg-2-4 ">
            <div class="row text-muted cart__name-category category__product-btn"
                value="<?php echo $row_danhmuc['id_danhmuc'] ?>">
                <?php echo $cart_item['tendanhmuc'] ?></div>
            <div class="row cart__name-product view__product-detail" value="<?php echo $cart_item['id'] ?>">
                <?php echo $cart_item['tensanpham'] ?></div>
        </div>
        <div class="col d-flex justify-content-center">
            <?php echo number_format($cart_item['giasp'], 0, ',', '.') ?>đ
        </div>
        <div class="col">
            <div class="quantity_button-wrapper">
                <a class="minus-quantity-btn" value="<?php echo $cart_item['id'] ?>"><input type="button" value="-"
                        class="minus-quantity button-quantity"></a>
                <input type="number" name="quantity" class="input-text" step="1" min="1"
                    value="<?php echo $cart_item['soluong'] ?>" id="quantity" placeholder inputmode="numeric">
                <a class="plus-quantity-btn" value="<?php echo $cart_item['id'] ?>"><input type="button" value="+"
                        class="plus-quantity button-quantity"></a>
            </div>
        </div>
        <div class="col d-flex justify-content-between">
            <?php echo number_format($thanhtien, 0, ',', '.')  ?>đ
            <a value="<?php echo $cart_item['id'] ?>" class="cart__delete-btn">
                <i class="fa-solid fa-xmark"></i>
            </a>
        </div>
    </div>
</div>
<?php } ?>
<?php } ?>
<div class="d-flex justify-content-between mb-3">
    <div class="back-to-shop">
        <a class="back-to-shop-btn">
            <span class="text-muted">TIẾP TỤC MUA SẮM</span>
        </a>
    </div>
    <div class="pay-product">
        <a><span class="pay-product-text">THANH
                TOÁN</span></a>

    </div>
</div>
<?php } ?>