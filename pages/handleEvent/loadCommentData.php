<?php
session_start();
$idsanpham = $_GET['idsanpham'];
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
$sql_comment = "SELECT * FROM tbl_comments, tbl_user WHERE tbl_comments.id_user=tbl_user.id_user AND tbl_comments.id_sanpham=$idsanpham LIMIT 10 ";
$query_comment = mysqli_query($mysqli, $sql_comment);
if (mysqli_num_rows($query_comment) > 0) {
    while ($row_comment = mysqli_fetch_array($query_comment)) {
?>
        <div class="review-container">
            <div class="review__header">
                <div class="comment__header-avatar">
                    <i class="fa-solid fa-user"></i>
                </div>
                <span class="review__header-name"><?php echo $query_comment['name'] ?></span>

                <?php
                if (isset($_SESSION['id_user']) && $_SESSION['id_user'] == $query_comment['id_user']) {
                ?>
                    <button class="review__delete-btn btn btn-danger">Xóa</button>
                <?php
                }
                ?>
            </div>
            <div class="review__content">
                <div class="comment__space"></div>
                <div class="review__content-description">
                    <span><?php echo $query_comment['description'] ?></span>
                </div>
                <?php
                if (isset($_SESSION['id_user']) && $_SESSION['id_user'] == $query_comment['id_user']) {
                ?>
                    <button class="review__edit-btn btn btn-primary">Sửa</button>
                <?php
                }
                ?>

            </div>
            <div class="review__footer">
                <div class="comment__space"></div>
                <button class="review__footer-answer">Trả lời</button> &#8226;
                <div class="review__footer-date"><?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                    echo date('d/m/Y', $query_comment['review_updated_date']) ?></div>
            </div>
        </div>
    <?php
    }
    ?>

<?php
} else {
?>
    <p class="no-review">Chưa có câu hỏi nào.</p>
<?php
}
?>