<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");

$idsanpham = $_GET['idsanpham'];
$sql_review = "SELECT * FROM tbl_reviews, tbl_user WHERE tbl_reviews.id_user=tbl_user.id_user AND tbl_reviews.id_sanpham=$idsanpham LIMIT 10 ";
$query_review = mysqli_query($mysqli, $sql_review);
if (mysqli_num_rows($query_review) > 0) {
    while ($row_review = mysqli_fetch_array($query_review)) {
?>
<div class="review-container">
    <div class="review__header">
        <span class="review__header-name"><?php echo $row_review['name'] ?></span>
        <span class="review__header-check"><i class="fa-solid fa-circle-check"></i>Đã mua
            hàng tại GPM Camera</span>
        <?php
                if (isset($_SESSION['id_user']) && $_SESSION['id_user'] == $row_review['id_user']) {
                ?>
        <button class="review__delete-btn btn btn-danger" value="<?php echo $row_review['id_review'] ?>">Xóa</button>
        <?php
                }
                ?>
    </div>
    <div class="review__content">
        <div class="review__content-rating">
            <?php
                    if ($row_review['rating'] == 1) {
                    ?>
            <i class="fa-solid fa-star"></i>
            <?php } else if ($row_review['rating'] == 2) { ?>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <?php } else if ($row_review['rating'] == 3) { ?>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <?php } else if ($row_review['rating'] == 4) { ?>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <?php } else {  ?>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <?php }  ?>
        </div>
        <div class="review__content-description">
            <span><?php echo $row_review['description'] ?></span>
        </div>
        <?php
                if (isset($_SESSION['id_user']) && $_SESSION['id_user'] == $row_review['id_user']) {
                ?>
        <button class="review__edit-modal-btn btn btn-primary"
            value="<?php echo $row_review['id_review'] ?>">Sửa</button>
        <?php
                }
                ?>

    </div>
    <div class="review__footer">
        <?php
                if (isset($_SESSION['id_user'])) {
                    $sql_user = "SELECT * FROM tbl_user WHERE id_user='$_SESSION[id_user]' LIMIT 1 ";
                    $query_user = mysqli_query($mysqli, $sql_user);
                    $row_user = mysqli_fetch_array($query_user);
                    if ($row_user['privilege'] == 1) {
                ?>
        <button class="review__footer-answer" value="<?php echo $row_review['id_review'] ?>">Trả lời</button> &#8226;
        <?php }
                } ?>
        <div class="review__footer-date"><?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                    echo date('d/m/Y', $row_review['review_date']) ?></div>
    </div>

    <?php
            if (strlen($row_review['answer_review'])) {
            ?>
    <div class="answer__wrapper">
        <div class="review__header">
            <span class="review__header-name"><?php echo $row_review['name'] ?></span>
            <span class="review__admin">Quản trị viên</span>

        </div>
        <div class="review__content">
            <div class="answer_review_content row">
                <span class="col-11"><?php echo $row_review['answer_review'] ?></span>
                <?php
                            if (isset($_SESSION['id_user']) && $_SESSION['id_user'] == $row_review['id_admin'] && $row_review['privilege'] = '1') {
                            ?>
                <button class="answer-review-delete-btn btn btn-danger col-1"
                    value="<?php echo $row_review['id_review'] ?>">Xóa</button>
                <?php
                            }
                            ?>
            </div>
        </div>
        <div class="review__footer">
            <div class="review__footer-date"><?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                            echo date('d/m/Y', $row_review['answer_date']) ?></div>
        </div>
    </div>
    <?php } ?>
</div>
<?php
    }
    ?>
<?php
} else {
?>
<p class="no-review">Chưa có đánh giá nào.</p>
<?php
}
?>