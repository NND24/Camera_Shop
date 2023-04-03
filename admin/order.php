<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
    <?php include('./js/link.php') ?>
</head>

<body>
    <div class="main-background"></div>
    <div class="app-container">
        <div class="main" id="main">
            <?php include('./modules/menu.php') ?>

            <div class="app-content">
                <div class="app-content-header">
                    <h1 class="app-content-headerText">Đơn hàng</h1>
                </div>

                <div class="app-content-actions">
                    <input class="search-bar" placeholder="Search..." type="text">
                    <div class="app-content-actions-wrapper">
                        <div class="filter-button-wrapper">
                            <button class="action-button filter jsFilter"><span>Filter</span><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-filter">
                                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                                </svg></button>
                            <div class="filter-menu">

                            </div>
                        </div>
                        <div class="filter-button-wrapper">
                            <button class="action-button delete-all-order">Xóa tất cả đơn hàng</button>
                        </div>
                    </div>
                </div>

                <div class="products-area-wrapper tableView">
                    <div class="products-header">
                        <div class="product-cell col-1 image">Thứ tự</div>
                        <div class="product-cell col-2 category">Mã đơn hàng</div>
                        <div class="product-cell col-2 price">Tình trạng</div>
                        <div class="product-cell col price">Ngày mua hàng</div>
                        <div class="product-cell col price">Ngày duyệt đơn</div>
                        <div class="product-cell col-2 price">Duyệt đơn hàng</div>
                        <div class="product-cell col-1 price">Xóa</div>
                    </div>
                    <div id="load_order_data"></div>
                    <div id="view-detail-order"></div>
                    <div id="view-edit-order"></div>
                    <div id="view-add-order"></div>

                </div>
            </div>

        </div>
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
                    buttons: true,
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
                    buttons: true,
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
    })
    </script>
</body>

</html>