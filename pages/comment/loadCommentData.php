<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
$item_per_page = 10;
$current_page = $_GET['pageIndex'];
$offset = ($current_page - 1) * $item_per_page;

$idsanpham = $_GET['idsanpham'];
$sql_comment = "SELECT * FROM tbl_comments, tbl_user WHERE tbl_comments.id_user=tbl_user.id_user AND tbl_comments.id_sanpham=$idsanpham LIMIT " . $item_per_page . " OFFSET " . $offset . " ";
$query_comment = mysqli_query($mysqli, $sql_comment);

$totalRecords = mysqli_query($mysqli, "SELECT * FROM tbl_comments, tbl_user WHERE tbl_comments.id_user=tbl_user.id_user AND tbl_comments.id_sanpham=$idsanpham");
$totalRecords = mysqli_num_rows($totalRecords);
$totalPages = ceil($totalRecords / $item_per_page);
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
        <button class="comment__edit-modal-btn btn btn-primary"
            value="<?php echo $row_comment['id_comment'] ?>">Sửa</button>
        <?php
                }
                ?>

    </div>
    <div class="comment__footer">
        <div class="comment__space"></div>
        <?php
                if (isset($_SESSION['id_user'])) {
                    $sql_user = "SELECT * FROM tbl_user WHERE id_user='$_SESSION[id_user]' LIMIT 1 ";
                    $query_user = mysqli_query($mysqli, $sql_user);
                    $row_user = mysqli_fetch_array($query_user);
                    if ($row_user['privilege'] == 1) {
                ?>
        <button class="comment__footer-answer" value="<?php echo $row_comment['id_comment'] ?>">Trả lời</button> &#8226;
        <?php }
                } ?>
        <div class="comment__footer-date"><?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                    echo date('d/m/Y', $row_comment['comment_date']) ?></div>
    </div>

    <?php
            if (strlen($row_comment['answer_comment'])) {
            ?>
    <div class="answer__wrapper">
        <div class="review__header">
            <span class="review__header-name"><?php echo $row_comment['name'] ?></span>
            <span class="review__admin">Quản trị viên</span>

        </div>
        <div class="review__content">
            <div class="answer_review_content row">
                <span class="col-11"><?php echo $row_comment['answer_comment'] ?></span>
                <?php
                            if (isset($_SESSION['id_user']) && $_SESSION['id_user'] == $row_comment['id_admin'] && $row_comment['privilege'] = '1') {
                            ?>
                <button class="answer-comment-delete-btn btn btn-danger col-1"
                    value="<?php echo $row_comment['id_comment'] ?>">Xóa</button>
                <?php
                            }
                            ?>
            </div>
        </div>
        <div class="review__footer">
            <div class="review__footer-date"><?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                            echo date('d/m/Y', $row_comment['answer_date']) ?></div>
        </div>
    </div>
    <?php } ?>
</div>
<?php
    }
    ?>
<div class="pagination__wrapper ">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php
                        if ($current_page > 3) {
                            $first_page = 1;
                        ?>
            <li class="page-item">
                <a class="page-link main first-page-shopPage" value="<?php echo $first_page ?>"><i
                        class="fa-solid fa-angles-left"></i></a>
            </li>
            <?php
                        }
                        if ($current_page > 1) {
                            $prev_page = $current_page - 1;
                        ?>
            <li class="page-item">
                <a class="page-link main prev-page-shopPage" value="<?php echo $current_page - 1 ?>"><i
                        class="fa-solid fa-angle-left"></i></a>
            </li>
            <?php } ?>

            <?php for ($num = 1; $num <= $totalPages; $num++) { ?>
            <?php if ($num != $current_page) { ?>
            <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
            <li class="page-item <?php echo ($current_page == $num) ? 'active' : '' ?>"><a class="page-link main"
                    value="<?php echo $num ?>"><?php echo $num ?></a></li>
            <?php } ?>
            <?php } else { ?>
            <li class="page-item <?php echo ($current_page == $num) ? 'active' : '' ?>"><a class="page-link main"
                    value="<?php echo $num ?>"><?php echo $num ?></a></li>
            <?php } ?>
            <?php } ?>


            <?php
                        if ($current_page < $totalPages - 1) {
                            $next_page = $current_page + 1;
                        ?>
            <li class=" page-item">
                <a class="page-link main next-page-shopPage" value="<?php echo $current_page + 1 ?>"><i
                        class="fa-solid fa-angle-right"></i></a>
            </li>
            <?php
                        }
                        if ($current_page < $totalPages - 3) {
                            $end_page = $totalPages;
                        ?>
            <li class="page-item">
                <a class="page-link main last-page-shopPage" value="<?php echo $end_page ?>"><i
                        class="fa-solid fa-angles-right"></i></a>
            </li>
            <?php
                        }
                        ?>

        </ul>
    </nav>
</div>
<?php
} else {
?>
<p class="no-review">Chưa có câu hỏi nào.</p>
<?php
}
?>