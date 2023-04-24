<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
$status = $_POST['status'];
if ($status == 0) {
?>
    <header class="review-header">
        <span>Đánh giá</span>
        <select class="comment-filter">
            <option>Lọc</option>
            <option selected value="0">Chưa trả lời</option>
            <option value="1">Đã trả lời</option>
            <option value="2">Trong tháng này</option>
        </select>
    </header>
    <div class="review-admin-wrapper">
        <?php
        $sql_comment = "SELECT * FROM tbl_comments, tbl_user, tbl_sanpham WHERE tbl_comments.id_user=tbl_user.id_user AND tbl_comments.id_sanpham=tbl_sanpham.id_sanpham";
        $query_comment = mysqli_query($mysqli, $sql_comment);
        if (mysqli_num_rows($query_comment) > 0) {
            while ($row_comment = mysqli_fetch_array($query_comment)) {
                if (strlen($row_comment['answer_comment']) == 0) {
        ?>
                    <div class="comment-container">
                        <div class="review__header">
                            <span class="review__header-name"><?php echo $row_comment['name'] ?></span>
                            <?php if (strlen($row_comment['answer_comment'])) { ?>
                                <span class="review__header-check"><i class="fa-solid fa-circle-check"></i>Đã trả
                                    lời</span>
                            <?php } ?>
                            <button class="review__delete-btn btn btn-danger" value="<?php echo $row_comment['id_comment'] ?>">Xóa</button>
                        </div>
                        <div class="review__content">
                            <div class="review__content-description">
                                <span><?php echo $row_comment['comment'] ?></span>
                            </div>

                        </div>
                        <div class="review_product">
                            <span>Sản phẩm: <?php echo $row_comment['tensanpham'] ?></span>
                            <br>
                            <?php if (strlen($row_comment['answer_comment'])) { ?>
                                <span>Trả lời: <?php echo $row_comment['answer_comment'] ?></span>
                            <?php } ?>
                        </div>
                        <div class="review__footer">
                            <button class="comment__footer-answer" value="<?php echo $row_comment['id_comment'] ?>">Trả lời</button>
                            &#8226;
                            <div class="review__footer-date">
                                <?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                                echo date('d/m/Y', $row_comment['comment_date']) ?></div>
                        </div>
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
                        <select class="comment-filter">
                            <option>Lọc</option>
                            <option value="0">Chưa trả lời</option>
                            <option selected value="1">Đã trả lời</option>
                            <option value="2">Trong tháng này</option>
                        </select>
                    </header>
                    <div class="review-admin-wrapper">
                        <?php
                        $sql_comment = "SELECT * FROM tbl_comments, tbl_user, tbl_sanpham WHERE tbl_comments.id_user=tbl_user.id_user AND tbl_comments.id_sanpham=tbl_sanpham.id_sanpham";
                        $query_comment = mysqli_query($mysqli, $sql_comment);
                        if (mysqli_num_rows($query_comment) > 0) {
                            while ($row_comment = mysqli_fetch_array($query_comment)) {
                                if (strlen($row_comment['answer_comment'])) {
                        ?>
                                    <div class="comment-container">
                                        <div class="review__header">
                                            <span class="review__header-name"><?php echo $row_comment['name'] ?></span>
                                            <?php if (strlen($row_comment['answer_comment'])) { ?>
                                                <span class="review__header-check"><i class="fa-solid fa-circle-check"></i>Đã trả
                                                    lời</span>
                                            <?php } ?>
                                            <button class="review__delete-btn btn btn-danger" value="<?php echo $row_comment['id_comment'] ?>">Xóa</button>
                                        </div>
                                        <div class="review__content">
                                            <div class="review__content-description">
                                                <span><?php echo $row_comment['comment'] ?></span>
                                            </div>

                                        </div>
                                        <div class="review_product">
                                            <span>Sản phẩm: <?php echo $row_comment['tensanpham'] ?></span>
                                            <br>
                                            <?php if (strlen($row_comment['answer_comment'])) { ?>
                                                <span>Trả lời: <?php echo $row_comment['answer_comment'] ?></span>
                                            <?php } ?>
                                        </div>
                                        <div class="review__footer">
                                            <button class="comment__footer-answer" value="<?php echo $row_comment['id_comment'] ?>">Trả lời</button>
                                            &#8226;
                                            <div class="review__footer-date">
                                                <?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                echo date('d/m/Y', $row_comment['comment_date']) ?></div>
                                        </div>
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
                                        <select class="comment-filter">
                                            <option>Lọc</option>
                                            <option value="0">Chưa trả lời</option>
                                            <option value="1">Đã trả lời</option>
                                            <option selected value="2">Trong tháng này</option>
                                        </select>
                                    </header>
                                    <div class="review-admin-wrapper">
                                        <?php
                                        $sql_comment = "SELECT * FROM tbl_comments, tbl_user, tbl_sanpham WHERE tbl_comments.id_user=tbl_user.id_user AND tbl_comments.id_sanpham=tbl_sanpham.id_sanpham";
                                        $query_comment = mysqli_query($mysqli, $sql_comment);
                                        if (mysqli_num_rows($query_comment) > 0) {
                                            while ($row_comment = mysqli_fetch_array($query_comment)) {
                                                if (date('m', $row_comment['comment_date']) == date('m')) {
                                        ?>
                                                    <div class="comment-container">
                                                        <div class="review__header">
                                                            <span class="review__header-name"><?php echo $row_comment['name'] ?></span>
                                                            <?php if (strlen($row_comment['answer_comment'])) { ?>
                                                                <span class="review__header-check"><i class="fa-solid fa-circle-check"></i>Đã trả
                                                                    lời</span>
                                                            <?php } ?>
                                                            <button class="review__delete-btn btn btn-danger" value="<?php echo $row_comment['id_comment'] ?>">Xóa</button>
                                                        </div>
                                                        <div class="review__content">
                                                            <div class="review__content-description">
                                                                <span><?php echo $row_comment['comment'] ?></span>
                                                            </div>

                                                        </div>
                                                        <div class="review_product">
                                                            <span>Sản phẩm: <?php echo $row_comment['tensanpham'] ?></span>
                                                            <br>
                                                            <?php if (strlen($row_comment['answer_comment'])) { ?>
                                                                <span>Trả lời: <?php echo $row_comment['answer_comment'] ?></span>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="review__footer">
                                                            <button class="comment__footer-answer" value="<?php echo $row_comment['id_comment'] ?>">Trả
                                                                lời</button>
                                                            &#8226;
                                                            <div class="review__footer-date">
                                                                <?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                                echo date('d/m/Y', $row_comment['comment_date']) ?>
                                                            </div>
                                                        </div>
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