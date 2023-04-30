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
            <?php
            $sql_privilege = "SELECT * FROM tbl_privilege WHERE id_admin='" . $_SESSION['dangnhap'] . "' LIMIT 1";
            $query_privilege = mysqli_query($mysqli, $sql_privilege);
            $row_privilege = mysqli_fetch_array($query_privilege);
            ?>
            <div class="app-content">
                <?php
                if ($row_privilege['list_order'] == 1) {
                ?>
                <div class="app-content-header">
                    <h1 class="app-content-headerText">Đơn hàng</h1>
                </div>

                <div class="app-content-actions">
                    <!-- <input class="search-bar" placeholder="Search..." type="text"> -->
                    <label class="search-label" for="">Từ ngày: </label>
                    <input class="search-bar time-search time-search-from" type="date" name="" id="">

                    <label class="search-label" for="">Đến ngày:</label>
                    <input class="search-bar time-search time-search-to" type="date" name="" id="">
                    <button class="app-content-headerButton time-search-btn">Lọc</button>
                    <div class="app-content-actions-wrapper">
                        <div class="filter-button-wrapper">
                            <button class="action-button filter jsFilter"><span>Lọc</span><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-filter">
                                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                                </svg></button>
                            <div class="filter-menu d-flex wrap" style=" width: 400px;flex-wrap: wrap;">
                                <div class="col-12">
                                    <label>Tình trạng</label>
                                    <select class="filter_status">
                                        <option value="2">Tất cả</option>
                                        <option value="1">Đã duyệt</option>
                                        <option value="0">Chưa duyệt</option>
                                    </select>
                                </div>
                                <div class="col-12 row filter-input-wrap">
                                    <div class=" col-6 d-flex no-wrap">
                                        <input type="radio" class="filter__order" name="filter__order" value="0"
                                            id="name-de">
                                        <label for="name-de">Tổng tiền: Giảm dần</label>
                                    </div>
                                    <div class=" col-6 d-flex no-wrap">
                                        <input type="radio" class="filter__order" name="filter__order" value="1"
                                            id="name-in">
                                        <label for="name-in">Tổng tiền: Tăng dần</label>
                                    </div>
                                </div>
                                <div class="col-12 row filter-input-wrap">
                                    <div class=" col-6 d-flex no-wrap">
                                        <input type="radio" class="filter__order" name="filter__order" value="2"
                                            id="amount-de">
                                        <label for="amount-de">Số lượng: Giảm dần</label>
                                    </div>
                                    <div class=" col-6 d-flex no-wrap">
                                        <input type="radio" class="filter__order" name="filter__order" value="3"
                                            id="amount-in">
                                        <label for="amount-in">Số lượng: Tăng dần</label>
                                    </div>
                                </div>

                                <div class="filter-menu-buttons">
                                    <button class="filter-button reset">
                                        Đặt lại
                                    </button>
                                    <button class="filter-button apply">
                                        Áp dụng
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php
                            if ($row_privilege['delete_all_order'] == 1) {
                            ?>
                        <div class="filter-button-wrapper">
                            <button class="action-button delete-all-order">Xóa tất cả đơn hàng</button>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="products-area-wrapper tableView">
                    <div class="products-header">
                        <div class="product-cell col-1 image">Thứ tự</div>
                        <div class="product-cell col-2 category">Mã đơn hàng</div>
                        <div class="product-cell col-2 price">Tình trạng</div>
                        <div class="product-cell col price">Ngày mua hàng</div>
                        <div class="product-cell col price">Ngày duyệt đơn</div>
                        <?php
                            if ($row_privilege['detail_order'] == 1) {
                            ?>
                        <div class="product-cell col-2 price">Duyệt đơn hàng</div>
                        <?php } ?>
                        <?php
                            if ($row_privilege['delete_order'] == 1) {
                            ?>
                        <div class="product-cell col-1 price">Xóa</div>
                        <?php } ?>
                    </div>
                    <div id="load_order_data"></div>
                    <div id="view-detail-order"></div>
                    <div id="view-edit-order"></div>
                    <div id="view-add-order"></div>

                </div>
                <script>
                $(document).ready(() => {
                    var pageIndexOrderMain = 1
                    // View data
                    function view_data() {
                        $.post('modules/quanlydonhang/handleEvent/listOrderData.php?pageIndex=' +
                            pageIndexOrderMain,
                            function(data) {
                                $('#load_order_data').html(data)
                            })
                    }
                    view_data();

                    $(document).on("click", '.page-link.main-order', function() {
                        var pageIndexOrderMain = 1;
                        $.ajax({
                            url: 'modules/quanlydonhang/handleEvent/listOrderData.php?pageIndex=' +
                                pageIndexOrderMain,
                            dataType: 'html',
                            method: "post",
                            cache: true,
                            success: function() {
                                view_data();
                            },
                            error: function() {
                                view_data();
                            }
                        })
                    })

                    // View detail order
                    $(document).on("click", '.detail-order', function() {
                        var id = $(this).val();
                        var url =
                            "modules/quanlydonhang/viewOrderDetail.php?id_order=" +
                            id;
                        $.post(url, (data) => {
                            $("#view-detail-order").html(data);
                        });
                    })

                    $(document).on("click", '.close-modal', function() {
                        $("#order__detail-model").remove();
                    })

                    $(document).on("click", '.modal__background', function() {
                        $("#order__detail-model").remove();
                    })

                    // Remove order
                    $(document).on("click", '.remove-order', function() {
                        var id = $(this).val();
                        var url =
                            "modules/quanlydonhang/handleEvent/handleDeleteOrder.php?idsanpham=" +
                            id;
                        swal({
                                title: "Bạn có chắc muốn xóa đơn hàng này không?",
                                text: "Nếu có đơn hàng này sẽ bị xóa đi!",
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
                                    swal("đơn hàng đã bị xóa!", {
                                        icon: "success",
                                    });
                                    $.post(url, (data) => {
                                        view_data();
                                    });
                                }
                            });
                    })

                    // Delete all order
                    $(document).on("click", '.delete-all-order', function() {
                        var url =
                            "modules/quanlydonhang/handleEvent/handleDeleteOrder.php?action=deleteAll";
                        swal({
                                title: "Bạn có chắc muốn thực hiện thao tác không?",
                                text: "Nếu có tất cả đơn hàng sẽ bị xóa đi!",
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
                                    swal("Tất cả đơn hàng đã bị xóa!", {
                                        icon: "success",
                                    });
                                    $.post(url, (data) => {
                                        view_data();
                                    });
                                }
                            });
                    })

                    // Handle filter
                    $(".jsFilter").on("click", function() {
                        document.querySelector(".filter-menu").classList.toggle("active");
                    });

                    var filter = -1;
                    $(document).on("change", '.filter__order', function() {
                        filter = $(this).val();
                    })

                    var pageIndexFilter = 1
                    $('.filter-button.apply').click((e) => {
                        var status = $('.filter_status').val();
                        $.ajax({
                            url: "modules/quanlydonhang/handleEvent/handleFilter.php?pageIndex=" +
                                pageIndexFilter,
                            data: {
                                status: status,
                                filter: filter,
                            },
                            dataType: 'html',
                            method: "post",
                            cache: true,
                            success: function(data) {
                                $('#load_order_data').html(data)
                            }
                        })
                    })

                    $(document).on("click", '.page-link.filter', function() {
                        pageIndexFilter = $(this).attr("value");
                        var status = $('.filter_status').val();
                        $.ajax({
                            url: "modules/quanlydonhang/handleEvent/handleFilter.php?pageIndex=" +
                                pageIndexFilter,
                            dataType: 'html',
                            data: {
                                status: status,
                                filter: filter,
                            },
                            method: "post",
                            cache: true,
                            success: function(data) {
                                $('#load_order_data').html(data)
                            }
                        })
                    })

                    $('.filter-button.reset').click((e) => {
                        $('.filter_status').val('2');
                        filter = -1
                    })

                    // Filter by time
                    var pageIndexSearch = 1
                    $(document).on("click", '.time-search-btn', function() {
                        var timeFrom = $('.time-search-from').val();
                        var timeTo = $('.time-search-to').val();
                        if (timeFrom.length > 0 || timeTo.length > 0) {
                            $.ajax({
                                url: "modules/quanlydonhang/handleEvent/handleFilterTime.php?pageIndex=" +
                                    pageIndexSearch,
                                data: {
                                    timeFrom: timeFrom,
                                    timeTo: timeTo,
                                },
                                dataType: 'html',
                                method: "post",
                                cache: true,
                                success: function(data) {
                                    $('#load_order_data').html(data)
                                }
                            })
                        } else {
                            view_data()
                        }
                    })

                    $(document).on("click", '.page-link.search', function() {
                        pageIndexSearch = $(this).attr("value");
                        var timeFrom = $('.time-search-from').val();
                        var timeTo = $('.time-search-to').val();
                        $.ajax({
                            url: "modules/quanlydonhang/handleEvent/handleFilterTime.php?pageIndex=" +
                                pageIndexSearch,
                            dataType: 'html',
                            data: {
                                timeFrom: timeFrom,
                                timeTo: timeTo,
                            },
                            method: "post",
                            cache: true,
                            success: function(data) {
                                $('#load_order_data').html(data)
                            }
                        })
                    })
                })
                </script>
                <?php
                } else {
                ?>
                <h1 style="color:#fff;">Bạn không có quyền thực hiện chức năng này</h1>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>