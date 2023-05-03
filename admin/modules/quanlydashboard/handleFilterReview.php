<?php
session_start();
include('../../../admin/config/config.php');
$status = $_POST['status'];
if ($status == 0) {
?>
    <header class="review-header">
        <span>Đánh giá</span>
        <select class="review-filter">
            <option>Lọc</option>
            <option selected value="0">Chưa trả lời</option>
            <option value="1">Đã trả lời</option>
            <option value="2">Trong tháng này</option>
        </select>
    </header>
    <div class="review-admin-wrapper">
        <?php
        $sql_review = "SELECT * FROM tbl_reviews, tbl_user, tbl_sanpham WHERE tbl_reviews.id_user=tbl_user.id_user AND tbl_reviews.id_sanpham=tbl_sanpham.id_sanpham";
        $query_review = mysqli_query($mysqli, $sql_review);
        if (mysqli_num_rows($query_review) > 0) {
            while ($row_review = mysqli_fetch_array($query_review)) {
                if (strlen($row_review['answer_review']) == 0) {
        ?>
                    <div class="review-container">
                        <div class="review__header">
                            <span class="review__header-name"><?php echo $row_review['name'] ?></span>
                            <?php if (strlen($row_review['answer_review'])) { ?>
                                <span class="review__header-check"><i class="fa-solid fa-circle-check"></i>Đã trả
                                    lời</span>
                            <?php } ?>
                            <button class="review__delete-btn btn btn-danger" value="<?php echo $row_review['id_review'] ?>">Xóa</button>
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
                        </div>
                        <div class="review_product">
                            <span>Sản phẩm: <?php echo $row_review['tensanpham'] ?></span>
                            <br>
                            <?php if (strlen($row_review['answer_review'])) { ?>
                                <span>Trả lời: <?php echo $row_review['answer_review'] ?></span>
                            <?php } ?>
                        </div>
                        <div class="review__footer">
                            <button class="review__footer-answer" value="<?php echo $row_review['id_review'] ?>">Trả lời</button>
                            &#8226;
                            <div class="review__footer-date">
                                <?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                                echo date('d/m/Y', $row_review['review_date']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="load__review-modal"></div>
                    <div class="load__comment-modal"></div>
            <?php
                }
            }
        } else {
            ?>
            <p class="no-review">Chưa có đánh giá nào.</p>
        <?php
        }
        ?>
    </div>
<?php
} else if ($status == 1) {
?>
    <header class="review-header">
        <span>Đánh giá</span>
        <select class="review-filter">
            <option>Lọc</option>
            <option value="0">Chưa trả lời</option>
            <option selected value="1">Đã trả lời</option>
            <option value="2">Trong tháng này</option>
        </select>
    </header>
    <div class="review-admin-wrapper">
        <?php
        $sql_review = "SELECT * FROM tbl_reviews, tbl_user, tbl_sanpham WHERE tbl_reviews.id_user=tbl_user.id_user AND tbl_reviews.id_sanpham=tbl_sanpham.id_sanpham";
        $query_review = mysqli_query($mysqli, $sql_review);
        if (mysqli_num_rows($query_review) > 0) {
            while ($row_review = mysqli_fetch_array($query_review)) {
                if (strlen($row_review['answer_review'])) {
        ?>
                    <div class="review-container">
                        <div class="review__header">
                            <span class="review__header-name"><?php echo $row_review['name'] ?></span>
                            <?php if (strlen($row_review['answer_review'])) { ?>
                                <span class="review__header-check"><i class="fa-solid fa-circle-check"></i>Đã trả
                                    lời</span>
                            <?php } ?>
                            <button class="review__delete-btn btn btn-danger" value="<?php echo $row_review['id_review'] ?>">Xóa</button>
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
                        </div>
                        <div class="review_product">
                            <span>Sản phẩm: <?php echo $row_review['tensanpham'] ?></span>
                            <br>
                            <?php if (strlen($row_review['answer_review'])) { ?>
                                <span>Trả lời: <?php echo $row_review['answer_review'] ?></span>
                            <?php } ?>
                        </div>
                        <div class="review__footer">
                            <button class="review__footer-answer" value="<?php echo $row_review['id_review'] ?>">Trả lời</button>
                            &#8226;
                            <div class="review__footer-date">
                                <?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                                echo date('d/m/Y', $row_review['review_date']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="load__review-modal"></div>
                    <div class="load__comment-modal"></div>
            <?php
                }
            }
        } else {
            ?>
            <p class="no-review">Chưa có đánh giá nào.</p>
        <?php
        }
        ?>
    </div>
<?php
} else if ($status == 2) {
?>
    <header class="review-header">
        <span>Đánh giá</span>
        <select class="review-filter">
            <option>Lọc</option>
            <option value="0">Chưa trả lời</option>
            <option value="1">Đã trả lời</option>
            <option selected value="2">Trong tháng này</option>
        </select>
    </header>
    <div class="review-admin-wrapper">
        <?php
        $sql_review = "SELECT * FROM tbl_reviews, tbl_user, tbl_sanpham WHERE tbl_reviews.id_user=tbl_user.id_user AND tbl_reviews.id_sanpham=tbl_sanpham.id_sanpham";
        $query_review = mysqli_query($mysqli, $sql_review);
        if (mysqli_num_rows($query_review) > 0) {
            while ($row_review = mysqli_fetch_array($query_review)) {
                if (date('m', $row_review['review_date']) == date('m')) {
        ?>
                    <div class="review-container">
                        <div class="review__header">
                            <span class="review__header-name"><?php echo $row_review['name'] ?></span>
                            <?php if (strlen($row_review['answer_review'])) { ?>
                                <span class="review__header-check"><i class="fa-solid fa-circle-check"></i>Đã trả
                                    lời</span>
                            <?php } ?>
                            <button class="review__delete-btn btn btn-danger" value="<?php echo $row_review['id_review'] ?>">Xóa</button>
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
                        </div>
                        <div class="review_product">
                            <span>Sản phẩm: <?php echo $row_review['tensanpham'] ?></span>
                            <br>
                            <?php if (strlen($row_review['answer_review'])) { ?>
                                <span>Trả lời: <?php echo $row_review['answer_review'] ?></span>
                            <?php } ?>
                        </div>
                        <div class="review__footer">
                            <button class="review__footer-answer" value="<?php echo $row_review['id_review'] ?>">Trả lời</button>
                            &#8226;
                            <div class="review__footer-date">
                                <?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                                echo date('d/m/Y', $row_review['review_date']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="load__review-modal"></div>
                    <div class="load__comment-modal"></div>
            <?php
                }
            }
        } else {
            ?>
            <p class="no-review">Chưa có đánh giá nào.</p>
        <?php
        }
        ?>
    </div>
<?php
}
?>