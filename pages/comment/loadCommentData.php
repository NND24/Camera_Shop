<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
$idsanpham = $_GET['idsanpham'];
$sql_user = "SELECT * FROM tbl_user WHERE id_user='$_SESSION[id_user]' LIMIT 1 ";
$query_user = mysqli_query($mysqli, $sql_user);
$row_user = mysqli_fetch_array($query_user);

$sql_comment = "SELECT * FROM tbl_comments, tbl_user WHERE tbl_comments.id_user=tbl_user.id_user AND tbl_comments.id_sanpham=$idsanpham LIMIT 10 ";
$query_comment = mysqli_query($mysqli, $sql_comment);
if (mysqli_num_rows($query_comment) > 0) {
    while ($row_comment = mysqli_fetch_array($query_comment)) {
?>
        <div class="comment-container">
            <div class="comment__header">
                <div class="comment__header-avatar">
                    <i class="fa-solid fa-user"></i>
                </div>
                <span class="comment__header-name"><?php echo $row_comment['name'] ?></span>

                <?php
                if (isset($_SESSION['id_user']) && $_SESSION['id_user'] == $row_comment['id_user']) {
                ?>
                    <button class="comment__delete-btn btn btn-danger" value="<?php echo $row_comment['id_comment'] ?>">Xóa</button>
                <?php
                }
                ?>
            </div>
            <div class="comment__content">
                <div class="comment__space"></div>
                <div class="comment__content-description">
                    <span><?php echo $row_comment['comment'] ?></span>
                </div>
                <?php
                if (isset($_SESSION['id_user']) && $_SESSION['id_user'] == $row_comment['id_user']) {
                ?>
                    <button class="comment__edit-modal-btn btn btn-primary" value="<?php echo $row_comment['id_comment'] ?>">Sửa</button>
                <?php
                }
                ?>

            </div>
            <div class="comment__footer">
                <div class="comment__space"></div>
                <?php if ($row_user['privilege'] == 1) { ?>
                    <button class="comment__footer-answer" value="<?php echo $row_comment['id_comment'] ?>">Trả lời</button> &#8226;
                <?php } ?>
                <div class="comment__footer-date"><?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                    echo date('d/m/Y', $row_comment['comment_date']) ?></div>
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