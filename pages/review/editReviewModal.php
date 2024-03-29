<div class="review-modal-container">
    <div class="review-wrapper">
        <?php
        include('../../admin/config/config.php');
        $sql_chitiet = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc 
                                        AND tbl_sanpham.id_sanpham='$_GET[id]' LIMIT 1 ";
        $query_chitiet = mysqli_query($mysqli, $sql_chitiet);

        $sql_review = "SELECT * FROM tbl_reviews WHERE id_review = '$_GET[idReview]' LIMIT 1";
        $query_review = mysqli_query($mysqli, $sql_review);
        $row_review = mysqli_fetch_array($query_review);
        while ($row_chitiet = mysqli_fetch_array($query_chitiet)) {
            $iddanhmuc = $row_chitiet['id_danhmuc'];
        ?>
            <h3>Đánh giá <?php echo $row_chitiet['tensanpham'] ?></h3>
            <div class="close-review-modal">
                <i class="fa-solid fa-xmark"></i>
            </div>
            <textarea id="review-edit" name="review" cols="45" rows="8" minlength="10" placeholder="Mời bạn chia sẻ thêm một số cảm nhận..." aria-required="true"><?php echo trim($row_review['description']); ?></textarea>
            <div class="wrap-attaddsend-comment"><span class="countContent">0</span> ký tự (Tối
                thiểu
                10)
            </div>

            <div class="comment-form-rating">
                <label for="rating">Bạn cảm thấy thế nào về sản phẩm? (Chọn sao)</label>
                <div class="star-container">
                    <div class="star-wrapper">
                        <a class="fas fa-star s5" value="5"></a>
                        <a class="fas fa-star s4" value="4"> </a>
                        <a class="fas fa-star s3" value="3"></a>
                        <a class="fas fa-star s2" value="2"></a>
                        <a class="fas fa-star s1" value="1"></a>
                    </div>
                    <div class="star-text-wrapper">
                        <span>Tuyệt vời</span>
                        <span>Tốt</span>
                        <span>Trung bình</span>
                        <span>Không tệ</span>
                        <span>Rất tệ</span>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary review__edit-btn">GỬI ĐÁNH GIÁ</button>
        <?php
        }
        ?>
    </div>
    <div class="review-modal-background"></div>
</div>