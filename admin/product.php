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

    <div class="main-background"></div>
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
                            <button class="action-button filter jsFilter"><span>Filter</span><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-filter">
                                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                                </svg></button>
                            <div class="filter-menu d-flex wrap" style=" width: 400px;flex-wrap: wrap;">
                                <div class="col-12">
                                    <label>Trạng thái</label>
                                    <select class="filter_status">
                                        <option value="2">Tất cả</option>
                                        <option value="1">Kích hoạt</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>
                                <div class="col-12 row filter-input-wrap">
                                    <div class=" col-6 d-flex no-wrap">
                                        <input type="radio" class="filter__order" name="filter__order" value="0"
                                            id="name-de">
                                        <label for="name-de">Tên: Giảm dần</label>
                                    </div>
                                    <div class=" col-6 d-flex no-wrap">
                                        <input type="radio" class="filter__order" name="filter__order" value="1"
                                            id="name-in">
                                        <label for="name-in">Tên: Tăng dần</label>
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
                                <div class="col-12 row filter-input-wrap">
                                    <div class=" col-6 d-flex no-wrap">
                                        <input type="radio" class="filter__order" name="filter__order" value="4"
                                            id="discount-de">
                                        <label for="discount-de">Giảm giá: Giảm dần</label>
                                    </div>
                                    <div class=" col-6 d-flex no-wrap">
                                        <input type="radio" class="filter__order" name="filter__order" value="5"
                                            id="discount-in">
                                        <label for="discount-in">Giảm giá: Tăng dần</label>
                                    </div>
                                </div>
                                <div class="col-12 row filter-input-wrap">
                                    <div class=" col-6 d-flex no-wrap">
                                        <input type="radio" class="filter__order" name="filter__order" value="6"
                                            id="sold-de">
                                        <label for="sold-de">Số lượng bán: Giảm dần</label>
                                    </div>
                                    <div class=" col-6 d-flex no-wrap">
                                        <input type="radio" class="filter__order" name="filter__order" value="7"
                                            id="sold-in">
                                        <label for="sold-in">Số lượng bán: Tăng dần</label>
                                    </div>
                                </div>
                                <div class="col-12 row filter-input-wrap">
                                    <div class=" col-6 d-flex no-wrap">
                                        <input type="radio" class="filter__order" name="filter__order" value="8"
                                            id="rating-de">
                                        <label for="rating-de">Đánh giá: Giảm dần</label>
                                    </div>
                                    <div class=" col-6 d-flex no-wrap">
                                        <input type="radio" class="filter__order" name="filter__order" value="9"
                                            id="rating-in">
                                        <label for="rating-in">Đánh giá: Tăng dần</label>
                                    </div>
                                </div>
                                <div class="col-12 row filter-input-wrap">
                                    <div class=" col-6 d-flex no-wrap">
                                        <input type="radio" class="filter__order" name="filter__order" value="10"
                                            id="date-de">
                                        <label for="date-de">Ngày đăng: Cũ nhất</label>
                                    </div>
                                    <div class=" col-6 d-flex no-wrap">
                                        <input type="radio" class="filter__order" name="filter__order" value="11"
                                            id="date-in">
                                        <label for="date-in">Ngày đăng: Mới nhất</label>
                                    </div>
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
                        <div class="product-cell col-1-8 image"> Sản phẩm</div>
                        <div class="product-cell col-1-8 category">Danh mục</div>
                        <div class="product-cell col-1-5 status-cell">Trạng thái</div>
                        <div class="product-cell col-1-5 status-cell">Tình trạng</div>
                        <div class="product-cell col-1-8 sales">Ngày tạo</div>
                        <div class="product-cell col-1-8 stock">Ngày cập nhật</div>
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
            $.post('modules/quanlysp/handleEvent/listProductData.php?pageIndex=' +
                pageIndexMain,
                function(data) {
                    $('#load_product_data').html(data)
                })
        }

        $(document).on("click", '.page-link.main', function() {
            pageIndexMain = $(this).attr("value");
            $.ajax({
                url: 'modules/quanlysp/handleEvent/listProductData.php?pageIndex=' +
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
                "modules/quanlysp/handleEvent/handleDeleteProduct.php?idsanpham=" +
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
                "modules/quanlysp/handleEvent/handleDeleteProduct.php?action=deleteAll";
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
                "modules/quanlysp/viewProductDetail.php?idsanpham=" +
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
                "modules/quanlysp/editProduct.php?idsanpham=" +
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
            var url =
                "modules/quanlysp/addNewProduct.php";
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
                    url: "modules/quanlysp/handleEvent/handleSearch.php?pageIndex=" +
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
                    url: "modules/quanlysp/handleEvent/handleSearch.php?pageIndex=" +
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

        var filter = -1;
        $(document).on("change", '.filter__order', function() {
            filter = $(this).val();
        })

        var pageIndexFilter = 1
        $('.filter-button.apply').click((e) => {
            var status = $('.filter_status').val();
            $.ajax({
                url: "modules/quanlysp/handleEvent/handleFilter.php?pageIndex=" +
                    pageIndexFilter,
                data: {
                    status: status,
                    filter: filter,
                },
                dataType: 'html',
                method: "post",
                cache: true,
                success: function(data) {
                    $('#load_product_data').html(data)
                }
            })
        })

        $(document).on("click", '.page-link.filter', function() {
            pageIndexFilter = $(this).attr("value");
            var status = $('.filter_status').val();
            $.ajax({
                url: "modules/quanlysp/handleEvent/handleFilter.php?pageIndex=" +
                    pageIndexFilter,
                dataType: 'html',
                data: {
                    status: status,
                    filter: filter,
                },
                method: "post",
                cache: true,
                success: function(data) {
                    $('#load_product_data').html(data)
                }
            })
        })

        $('.filter-button.reset').click((e) => {
            $('.filter_status').val('2');
            filter = -1
        })
    })
    </script>
</body>

</html>