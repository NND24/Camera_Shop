<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <?php include('./js/link.php') ?>
</head>

<body>
    <div class="main-background"></div>
    <div class="app-container">
        <div class="main" id="main">
            <?php include('./modules/menu.php') ?>
            <div class="app-content">
                <h1 class="app-content-headerText">Dashboard</h1>
                <div class="supply-statistics-container row">
                    <?php
                    $sql_review = "SELECT * FROM tbl_reviews";
                    $query_review = mysqli_query($mysqli, $sql_review);
                    $total_review = mysqli_num_rows($query_review);

                    $sql_order = "SELECT * FROM tbl_order";
                    $query_order = mysqli_query($mysqli, $sql_order);
                    $total_order = mysqli_num_rows($query_order);

                    $sql_user = "SELECT * FROM tbl_user WHERE privilege=0";
                    $query_user = mysqli_query($mysqli, $sql_user);
                    $total_user = mysqli_num_rows($query_user);

                    $sql_order_detail = "SELECT * FROM tbl_order_details, tbl_sanpham WHERE tbl_order_details.id_sanpham=tbl_sanpham.id_sanpham";
                    $query_order_detail = mysqli_query($mysqli, $sql_order_detail);
                    $total_revenue = 0;
                    while ($row_order_detail = mysqli_fetch_array($query_order_detail)) {
                        $total_revenue += $row_order_detail['soluongmua'] * $row_order_detail['giadagiam'];
                    }

                    ?>
                    <div class="supply-statistics-wrapper total-review col-3">
                        <h1><?php echo $total_review ?></h1>
                        <h4>Tổng số đánh giá</h4>
                    </div>
                    <div class="supply-statistics-wrapper total-revenue col-3">
                        <?php if ($total_revenue > 1000000) {
                            if ($total_revenue / 100000 < 100) {
                        ?>
                                <h1><?php echo round($total_revenue / 1000000, 1) ?>Mđ</h1>

                            <?php } else if ($total_revenue / 100000 < 1000) { ?>
                                <h1><?php echo round($total_revenue / 1000000, 1) ?>Mđ</h1>
                            <?php } else { ?>
                                <h1><?php echo number_format(round($total_revenue, -5) / 100000, 0, ',', '.') ?>Mđ</h1>

                            <?php } ?>

                        <?php } else { ?>
                            <h1><?php echo number_format($total_revenue, 0, ',', '.')  ?>đ</h1>
                        <?php } ?>
                        <h4>Tổng doanh thu</h4>
                    </div>
                    <div class="supply-statistics-wrapper total-order col-3">
                        <h1><?php echo $total_order ?></h1>
                        <h4>Tổng số đơn hàng</h4>
                    </div>
                    <div class="supply-statistics-wrapper total-user col-3">
                        <h1><?php echo $total_user ?></h1>
                        <h4>Tổng số khách hàng</h4>
                    </div>
                </div>

                <div class="review-comment-container row">
                    <div class="review-container col-6">
                        <div id="load__review-data"></div>
                    </div>

                    <div class="comment-container col-6">
                        <div id="load__comment-data"></div>
                    </div>
                </div>

                <div class="chart-container">
                    <div class="chart-header">
                        <h1 class="app-content-headerText">Bảng thống kê</h1>
                        <select class="order-date-filter">
                            <option>Lọc</option>
                            <option value="7ngay">7 ngày qua</option>
                            <option value="28ngay">28 ngày qua</option>
                            <option value="90ngay">90 ngày qua</option>
                            <option value="365ngay">365 ngày qua</option>
                        </select>
                    </div>
                    <div id="myfirstchart" style="height: 250px;"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(() => {
            $(document).on("click", '.update-revenue-btn', function() {
                $.post('modules/quanlydashboard/loadCommentData.php')
            })

            function update_revenue_data() {
                $.post('modules/quanlydashboard/handleUbdateRevenue.php')
            }
            update_revenue_data()


            // View review data
            function view_review_data() {
                $.post('modules/quanlydashboard/loadReviewData.php',
                    function(data) {
                        $('#load__review-data').html(data)
                    })
            }
            view_review_data()

            // View comment data
            function view_comment_data() {
                $.post('modules/quanlydashboard/loadCommentData.php',
                    function(data) {
                        $('#load__comment-data').html(data)
                    })
            }
            view_comment_data()

            var char = new Morris.Line({

                element: 'myfirstchart',

                xkey: 'date',

                ykeys: ['sales', 'quantity'],

                labels: ['Doanh thu', 'Số lượng bán ra']
            });

            $(document).on("change", '.order-date-filter', function() {
                var thoigian = $(this).val();
                $.ajax({
                    url: "modules/quanlydashboard/handleStatistics.php",
                    method: 'POST',
                    data: {
                        thoigian: thoigian
                    },
                    dataType: "json",
                    success: function(data) {
                        char.setData(data);
                    }
                })
            })

            function thongke() {
                var text = '365 ngày qua';
                $.ajax({
                    url: "modules/quanlydashboard/handleStatistics.php",
                    method: 'POST',
                    dataType: "json",
                    success: function(data) {
                        char.setData(data);
                    }
                })
            }
            thongke();
        })
    </script>
</body>

</html>