<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <?php include('./js/link.php'); ?>
</head>

<body>
    <?php
    $mysqli = new mysqli("localhost", "root", "", "camera_shop");
    $sql_lietke_sp = "SELECT * FROM tbl_sanpham, tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc 
ORDER BY id_sanpham DESC";
    $query_lietke_sp = mysqli_query($mysqli, $sql_lietke_sp);
    ?>

    <div class="app-container">
        <div class="main" id="main">
            <?php include('./modules/menu.php') ?>

            <div class="app-content">
                <div class="app-content-header">
                    <h1 class="app-content-headerText">Sản phẩm</h1>
                    <button class="app-content-headerButton add-new-product-btn add-product">Thêm sản phẩm</button>
                </div>

                <div class="app-content-actions">
                    <input class="search-bar" placeholder="Search..." type="text">
                    <div class="app-content-actions-wrapper">
                        <div class="filter-button-wrapper">
                            <button class="action-button filter jsFilter"><span>Filter</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter">
                                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                                </svg></button>
                            <div class="filter-menu d-flex wrap" style=" width: 400px;flex-wrap: wrap;">
                                <div class=" col-6 " style="padding-right: 10px;">
                                    <label>Trạng thái</label>
                                    <select class="filter_status">
                                        <option value="2">Tất cả</option>
                                        <option value="1">Kích hoạt</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label>Tên </label>
                                    <select class="filter_name">
                                        <option value="2">Tất cả</option>
                                        <option value="1">Từ A-Z</option>
                                        <option value="0">Từ Z-A</option>
                                    </select>
                                </div>
                                <div class="col-6" style="padding-right: 10px;">
                                    <label>Giá </label>
                                    <select class="filter_price">
                                        <option value="2">Tất cả</option>
                                        <option value="1">Tăng dần</option>
                                        <option value="0">Giảm dần</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label>Số lượng</label>
                                    <select class="filter_amount">
                                        <option value="2">Tất cả</option>
                                        <option value="1">Tăng dần</option>
                                        <option value="0">Giảm dần</option>
                                    </select>
                                </div>
                                <div class="col-6" style="padding-right: 10px;">
                                    <label>Giảm giá</label>
                                    <select class="filter_discount">
                                        <option value="2">Tất cả</option>
                                        <option value="1">Tăng dần</option>
                                        <option value="0">Giảm dần</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label>Số lượng đã bán</label>
                                    <select class="filter_sold-amount">
                                        <option value="2">Tất cả</option>
                                        <option value="1">Tăng dần</option>
                                        <option value="0">Giảm dần</option>
                                    </select>
                                </div>
                                <div class="col-6" style="padding-right: 10px;">
                                    <label>Đánh giá</label>
                                    <select class="filter_rating">
                                        <option value="2">Tất cả</option>
                                        <option value="1">Tăng dần</option>
                                        <option value="0">Giảm dần</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label>Ngày đăng</label>
                                    <select class="filter_dated">
                                        <option value="2">Tất cả</option>
                                        <option value="1">Mới nhất</option>
                                        <option value="0">Cũ nhất</option>
                                    </select>
                                </div>
                                <div class="filter-menu-buttons">
                                    <button class="filter-button reset">
                                        Reset
                                    </button>
                                    <button class="filter-button apply">
                                        Apply
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="filter-button-wrapper">
                            <button class="action-button delete-all-product">Xóa tất cả sản phẩm</button>
                        </div>
                    </div>
                </div>

                <div class="products-area-wrapper tableView">
                    <div class="products-header">
                        <div class="product-cell col-2-4 image"> Sản phẩm</div>
                        <div class="product-cell col-1-8 category">Danh mục</div>
                        <div class="product-cell col-1-5 status-cell">Trạng thái</div>
                        <div class="product-cell col-2 sales">Ngày tạo</div>
                        <div class="product-cell col-2 stock">Ngày cập nhật</div>
                        <div class="product-cell col-1-8 price">Chi tiết</div>
                        <div class="product-cell col price">Xóa</div>
                        <div class="product-cell col price">Sửa</div>
                    </div>
                    <div id="load_product_data"></div>
                    <div id="view-detail-product"></div>
                    <div id="view-edit-product"></div>
                    <div id="view-add-product"></div>

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(() => {
            var pageIndexMain = 1
            // View data
            view_data();

            function view_data() {
                $.post('http://localhost:3000/admin/modules/quanlysp/handleEvent/listProductData.php?pageIndex=' +
                    pageIndexMain,
                    function(data) {
                        $('#load_product_data').html(data)
                    })
            }

            $(document).on("click", '.page-link.main', function() {
                pageIndexMain = $(this).attr("value");
                $.ajax({
                    url: 'http://localhost:3000/admin/modules/quanlysp/handleEvent/listProductData.php?pageIndex=' +
                        pageIndexMain,
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

            // Remove product
            $(document).on("click", '.remove-product', function() {
                var id = $(this).val();
                var url =
                    "http://localhost:3000/admin/modules/quanlysp/handleEvent/handleDeleteProduct.php?idsanpham=" +
                    id;
                swal({
                        title: "Bạn có chắc muốn xóa danh sách này không?",
                        text: "Nếu có danh sách này sẽ bị xóa đi!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Danh sách đã bị xóa!", {
                                icon: "success",
                            });
                            $.post(url, (data) => {
                                view_data();
                            });
                        }
                    });
            })

            // Delete all product
            $(document).on("click", '.delete-all-product', function() {
                var url =
                    "http://localhost:3000/admin/modules/quanlysp/handleEvent/handleDeleteProduct.php?action=deleteAll";
                swal({
                        title: "Bạn có chắc muốn thực hiện thao tác không?",
                        text: "Nếu có tất cả danh sách sẽ bị xóa đi!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Tất cả danh sách đã bị xóa!", {
                                icon: "success",
                            });
                            $.post(url, (data) => {
                                view_data();
                            });
                        }
                    });
            })

            // View detail category
            $(document).on("click", '.detail-product', function() {
                var id = $(this).val();
                var url =
                    "http://localhost:3000/admin/modules/quanlysp/viewProductDetail.php?idsanpham=" +
                    id;
                $.post(url, (data) => {
                    $("#view-detail-product").html(data);
                });
            })

            $(document).on("click", '.close-modal', function() {
                $("#product__detail-model").remove();
            })

            $(document).on("click", '.modal__background', function() {
                $("#product__detail-model").remove();
            })

            // Edit product
            $(document).on("click", '.edit-product', function() {
                var id = $(this).val();
                var url =
                    "http://localhost:3000/admin/modules/quanlysp/editProduct.php?idsanpham=" +
                    id;
                $.post(url, (data) => {
                    $("#view-edit-product").html(data);
                });
            })

            $(document).on("click", '.close-modal', function() {
                $("#product__edit-model").remove();
            })

            $(document).on("click", '.modal__background', function() {
                $("#product__edit-model").remove();
            })

            // Add product
            $(document).on("click", '.add-product', function() {
                var id = $(this).val();
                var url =
                    "http://localhost:3000/admin/modules/quanlysp/addNewProduct.php";
                $.post(url, (data) => {
                    $("#view-add-product").html(data);
                });
            })

            $(document).on("click", '.close-modal', function() {
                $("#product__add-model").remove();
            })

            $(document).on("click", '.modal__background-add', function() {
                $("#product__add-model").remove();
            })

            // Handle search
            var pageIndexSearch = 1;
            $(document).on("keyup", '.search-bar', function() {
                var searchInput = $(this).val();
                if (searchInput.length > 0) {
                    $.ajax({
                        url: "http://localhost:3000/admin/modules/quanlysp/handleEvent/handleSearch.php?pageIndex=" +
                            pageIndexSearch,
                        data: {
                            searchInput: searchInput,
                        },
                        dataType: 'html',
                        method: "post",
                        cache: true,
                        success: function(data) {
                            $('#load_product_data').html(data)
                        }
                    })
                } else {
                    view_data()
                }
            })

            $(document).on("click", '.page-link.search', function() {
                pageIndexSearch = $(this).attr("value");
                var searchInput = $('.search-bar').val();
                if (searchInput.length > 0) {
                    $.ajax({
                        url: "http://localhost:3000/admin/modules/quanlysp/handleEvent/handleSearch.php?pageIndex=" +
                            pageIndexSearch,
                        data: {
                            searchInput: searchInput,
                        },
                        dataType: 'html',
                        method: "post",
                        cache: true,
                        success: function(data) {
                            $('#load_product_data').html(data)
                        }
                    })
                } else {
                    view_data()
                }
            })

            // Handle filter
            $(".jsFilter").on("click", function() {
                document.querySelector(".filter-menu").classList.toggle("active");
            });

            var pageIndexFilter = 1
            $('.filter-button.apply').click((e) => {
                var status = $('.filter_status').val();
                var name = $('.filter_name').val();
                var price = $('.filter_price').val();
                var amount = $('.filter_amount').val();
                var discount = $('.filter_discount').val();
                var soldAmount = $('.filter_sold-amount').val();
                var rating = $('.filter_rating').val();
                var dated = $('.filter_dated').val();
                $.ajax({
                    url: "http://localhost:3000/admin/modules/quanlysp/handleEvent/handleFilter.php?pageIndex=" +
                        pageIndexFilter,
                    data: {
                        status: status,
                        name: name,
                        price: price,
                        amount: amount,
                        discount: discount,
                        soldAmount: soldAmount,
                        rating: rating,
                        dated: dated,
                    },
                    dataType: 'html',
                    method: "post",
                    cache: true,
                    success: function(data) {
                        console.log(data)
                        $('#load_product_data').html(data)
                    }
                })
            })

            $(document).on("click", '.page-link.filter', function() {
                pageIndexFilter = $(this).attr("value");
                var status = $('.filter_status').val();
                var name = $('.filter_name').val();
                var price = $('.filter_price').val();
                var amount = $('.filter_amount').val();
                var discount = $('.filter_discount').val();
                var soldAmount = $('.filter_sold-amount').val();
                var rating = $('.filter_rating').val();
                var dated = $('.filter_dated').val();
                $.ajax({
                    url: "http://localhost:3000/admin/modules/quanlysp/handleEvent/handleFilter.php?pageIndex=" +
                        pageIndexFilter,
                    dataType: 'html',
                    data: {
                        status: status,
                        name: name,
                        price: price,
                        amount: amount,
                        discount: discount,
                        soldAmount: soldAmount,
                        rating: rating,
                        dated: dated,
                    },
                    method: "post",
                    cache: true,
                    success: function(data) {
                        $('#load_product_data').html(data)
                    }
                })
            })
        })
    </script>
</body>

</html>