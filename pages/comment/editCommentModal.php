<div class="review-modal-container">
    <div class="review-wrapper">
        <?php
        $mysqli = new mysqli("localhost", "root", "", "camera_shop");

        $sql_comment = "SELECT * FROM tbl_comments WHERE id_comment = '$_GET[idComment]' LIMIT 1";
        $query_comment = mysqli_query($mysqli, $sql_comment);
        $row_comment = mysqli_fetch_array($query_comment);
        ?>
        <h3>Sửa câu hỏi</h3>
        <div class="close-review-modal">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <textarea id="comment" class="comment" name="comment" cols="45" rows="8" minlength="10" required="" placeholder="Mời bạn chia sẻ thêm một số cảm nhận..." aria-required="true">
                <?php echo trim($row_comment['comment']); ?>
            </textarea>
        <div class="wrap-attaddsend-comment"><span class="countContentReview">0</span> ký tự (Tối
            thiểu
            10)
        </div>
    </div>

    <button class="btn btn-primary comment__edit-btn">GỬI CÂU HỎI</button>
</div>
<div class="review-modal-background"></div>
</div>