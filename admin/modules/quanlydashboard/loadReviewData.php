<header class="review-header">
    <span>Đánh giá</span>
    <select class="review-filter">
        <option>Lọc</option>
        <option value="0">Chưa trả lời</option>
        <option value="1">Đã trả lời</option>
        <option value="2">Trong tháng này</option>
    </select>
</header>
<div class="review-admin-wrapper">
    <?php
    session_start();
    include('../../../admin/config/config.php');
    $sql_review = "SELECT * FROM tbl_reviews, tbl_user, tbl_sanpham WHERE tbl_reviews.id_user=tbl_user.id_user AND tbl_reviews.id_sanpham=tbl_sanpham.id_sanpham";
    $query_review = mysqli_query($mysqli, $sql_review);
    if (mysqli_num_rows($query_review) > 0) {
        while ($row_review = mysqli_fetch_array($query_review)) {
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
    } else {
        ?>
        <p class="no-review">Chưa có đánh giá nào.</p>
    <?php
    }
    ?>
</div>

<script>
    $(document).ready(() => {
        // View review data
        function view_review_data() {
            $.post('modules/quanlydashboard/loadReviewData.php',
                function(data) {
                    $('#load__review-data').html(data)
                })
        }

        // Answer review
        var reviewId;
        $(document).on("click", '.review__footer-answer', function() {
            reviewId = $(this).val()
            $(".load__review-modal").load("../pages/review/answerReviewModal.php");
        })

        $(document).on("click", '.close-review-modal', function() {
            $(".review-modal-container").remove();
        })

        $(document).on("click", '.review-modal-background', function() {
            $(".review-modal-container").remove();
        })

        var answerContent;
        $(document).on("change", '.answer-review', function() {
            answerContent = $(this).val();
        })

        $(document).on("click", '.review__answer-btn', function() {
            $.ajax({
                url: "../pages/review/handleAnswerReview.php",
                data: {
                    answerContent: answerContent,
                    reviewId: reviewId,
                    idAdmin: <?php echo $_SESSION['dangnhap'] ?>,
                },
                dataType: 'json',
                method: "post",
                cache: true,
                success: function() {
                    swal("OK!", "Đánh giá thành công", "success");
                    answerContent = '';
                    view_review_data()
                },
                error: function() {
                    swal("OK!", "Đánh giá thành công", "success");
                    answerContent = '';
                    view_review_data()
                }
            })
        })

        // Delete review
        $(document).on("click", '.review__delete-btn', function() {
            var idReview = $(this).val()
            swal({
                    title: "Bạn có chắc muốn xóa đánh giá này không?",
                    text: "Nếu có đánh giá này sẽ bị xóa đi!",
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: "Thoát",
                            value: null,
                            visible: true,
                            closeModal: true,
                        },
                        confirm: {
                            text: "Chấp nhận",
                            value: true,
                            visible: true,
                            closeModal: true
                        }
                    },
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "../pages/review/handleDeleteReview.php",
                            data: {
                                idReview: idReview,
                            },
                            dataType: 'json',
                            method: "post",
                            cache: true,
                            success: function(data) {
                                swal("OK!", "Xóa đánh giá thành công", "success");
                                view_review_data()
                            },
                            error: function(data) {
                                swal("OK!", "Xóa đánh giá thành công", "success");
                                view_review_data()
                            }
                        })
                    }
                });
        })

        // Filter review
        $(document).on("change", '.review-filter', function() {
            var status = $(this).val();
            if (status == 0 || status == 1 || status == 2) {
                $.ajax({
                    url: "modules/quanlydashboard/handleFilterReview.php",
                    data: {
                        status: status,
                    },
                    dataType: 'html',
                    method: "post",
                    cache: true,
                    success: function(data) {
                        $('#load__review-data').html(data)
                    }
                })
            } else {
                view_review_data()
            }
        })
    })
</script>