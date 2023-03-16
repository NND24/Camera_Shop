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
                    <button class="mode-switch" title="Switch Theme">
                        <svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
                            <defs></defs>
                            <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
                        </svg>
                    </button>
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
                                        <option value="2">Tất cả trạng thái</option>
                                        <option value="1">Kích hoạt</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label>Tên </label>
                                    <select class="filter_name">
                                        <option value="2">Tất cả</option>
                                        <option value="1">Tăng dần</option>
                                        <option value="0">Giảm dần</option>
                                    </select>
                                </div>
                                <div class="col-6" style="padding-right: 10px;">
                                    <label>Giá </label>
                                    <select class="filter_status">
                                        <option value="2">Tất cả</option>
                                        <option value="1">Tăng dần</option>
                                        <option value="0">Giảm dần</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label>Số lượng</label>
                                    <select class="filter_status">
                                        <option value="2">Tất cả</option>
                                        <option value="1">Tăng dần</option>
                                        <option value="0">Giảm dần</option>
                                    </select>
                                </div>
                                <div class="col-6" style="padding-right: 10px;">
                                    <label>Giảm giá</label>
                                    <select class="filter_status">
                                        <option value="2">Tất cả</option>
                                        <option value="1">Tăng dần</option>
                                        <option value="0">Giảm dần</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label>Đã bán</label>
                                    <select class="filter_status">
                                        <option value="2">Tất cả</option>
                                        <option value="1">Tăng dần</option>
                                        <option value="0">Giảm dần</option>
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
            // View data
            function view_data() {
                $.post('http://localhost:3000/admin/modules/quanlysp/handleEvent/listProductData.php',
                    function(data) {
                        $('#load_product_data').html(data)
                    })
            }
            view_data();

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
                    $('.model-close-btn i').click(() => {
                        $("#product__detail-model").remove();
                    })
                });
            })

            // Edit product
            $(document).on("click", '.edit-product', function() {
                var id = $(this).val();
                var url =
                    "http://localhost:3000/admin/modules/quanlysp/editProduct.php?idsanpham=" +
                    id;
                $.post(url, (data) => {
                    $("#view-edit-product").html(data);
                    $('.model-close-btn i').click(() => {
                        $("#product__edit-model").remove();
                    })
                });
            })

            // Add product
            $(document).on("click", '.add-product', function() {
                var id = $(this).val();
                var url =
                    "http://localhost:3000/admin/modules/quanlysp/addNewProduct.php";
                $.post(url, (data) => {
                    $("#view-add-product").html(data);
                    $('.model-close-btn i').click(() => {
                        $("#product__add-model").remove();
                    })
                });
            })

            // Handle search
            $(document).on("keyup", '.search-bar', function() {
                var searchInput = $(this).val();
                if (searchInput.length > 0) {
                    $.ajax({
                        url: "http://localhost:3000/admin/modules/quanlysp/handleEvent/handleSearch.php",
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

            $('.filter-button.apply').click((e) => {
                var status = $('.filter_status').val();
                var name = $('.filter_name').val();
                var price = $('.filter_status').val();
                var amount = $('.filter_status').val();
                var discount = $('.filter_status').val();
                var soldCount = $('.filter_status').val();
                if (status == 0 || status == 1) {
                    $.ajax({
                        url: "http://localhost:3000/admin/modules/quanlysp/handleEvent/handleFilter/filterStatus.php",
                        data: {
                            status: status,
                        },
                        dataType: 'html',
                        method: "post",
                        cache: true,
                        success: function(data) {
                            $('#load_product_data').html(data)
                        }
                    })
                } else if (status == 2) {
                    view_data();
                }

                // if (name == 0 || name == 1) {
                //     $.ajax({
                //         url: "http://localhost:3000/admin/modules/quanlysp/handleEvent/handleFilter/filterName.php",
                //         data: {
                //             name: name,
                //         },
                //         dataType: 'html',
                //         method: "post",
                //         cache: true,
                //         success: function(data) {
                //             $('#load_product_data').html(data)
                //         }
                //     })
                // } else if (name == 2) {
                //     view_data();
                // }
            })
        })
    </script>
</body>

</html>