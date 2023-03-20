<div class="review-modal-container">
    <div class="review-wrapper">
        <?php
        $mysqli = new mysqli("localhost", "root", "", "camera_shop");
        $sql_chitiet = "SELECT * FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc 
                                        AND tbl_sanpham.id_sanpham='$_GET[id]' LIMIT 1 ";
        $query_chitiet = mysqli_query($mysqli, $sql_chitiet);
        while ($row_chitiet = mysqli_fetch_array($query_chitiet)) {
            $iddanhmuc = $row_chitiet['id_danhmuc'];
        ?>
        <h3>Đánh giá <?php echo $row_chitiet['tensanpham'] ?></h3>
        <div class="close-review-modal">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <textarea id="review" name="review" cols="45" rows="8" minlength="10" required=""
            placeholder="Mời bạn chia sẻ thêm một số cảm nhận..." aria-required="true"></textarea>
        <div class="wrap-attaddsend"><span id="countContent">0 ký tự (Tối thiểu 10)</span>
        </div>
        <div class="comment-form-rating"><label for="rating">Bạn cảm thấy thế nào về sản
                phẩm? (Chọn sao)</label>
            <span>
                <div class="star star-1" value="1"><i class="fa-solid fa-star"></i>Rất tệ</div>
                <div class="star star-2" value="2"><i class="fa-solid fa-star"></i>Không tệ</div>
                <div class="star star-3" value="3"><i class="fa-solid fa-star"></i>Trung bình
                </div>
                <div class="star star-4" value="4"><i class="fa-solid fa-star"></i>Tốt</div>
                <div class="star star-5" value="5"><i class="fa-solid fa-star"></i>Tuyệt
                    vời</div>
            </span>
        </div>

        <button class="btn btn-primary">GỬI ĐÁNH GIÁ</button>
        <?php
        }
        ?>
    </div>
    <div class="review-modal-background"></div>
</div>