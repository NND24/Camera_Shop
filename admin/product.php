<?php include('./js/link.php') ?>
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
            <?php include('modules/quanlysp/addNewProduct.php');
            // echo '<pre>'; print_r($_SERVER);  echo '</pre>';
            //exit; 
            ?>

            <div class="app-content-header">
                <h1 class="app-content-headerText">Sản phẩm</h1>
                <button class="mode-switch" title="Switch Theme">
                    <svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
                        <defs></defs>
                        <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
                    </svg>
                </button>
                <button class="app-content-headerButton add-new-product-btn">Thêm sản phẩm</button>
            </div>

            <div class="app-content-actions">
                <input class="search-bar" placeholder="Search..." type="text">
                <div class="app-content-actions-wrapper">
                    <div class="filter-button-wrapper">
                        <button class="action-button filter jsFilter"><span>Filter</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                            </svg></button>
                        <div class="filter-menu">
                            <label>Category</label>
                            <select>
                                <option>All Categories</option>
                                <option>Furniture</option>
                                <option>Decoration</option>
                                <option>Kitchen</option>
                                <option>Bathroom</option>
                            </select>
                            <label>Status</label>
                            <select>
                                <option>All Status</option>
                                <option>Active</option>
                                <option>Disabled</option>
                            </select>
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
                        <button class="action-button delete-all-product">Xóa tất cả danh mục</button>
                    </div>
                </div>
            </div>

            <div class="products-area-wrapper tableView">
                <div class="products-header">
                    <div class="product-cell col-2-4 image">
                        Sản phẩm
                        <button class="sort-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512">
                                <path fill="currentColor" d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z" />
                            </svg>
                        </button>
                    </div>
                    <div class="product-cell col-1-8 category">Danh mục<button class="sort-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512">
                                <path fill="currentColor" d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z" />
                            </svg>
                        </button></div>
                    <div class="product-cell col-1-5 status-cell">Trạng thái<button class="sort-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512">
                                <path fill="currentColor" d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z" />
                            </svg>
                        </button></div>
                    <div class="product-cell col-2 sales">Ngày tạo<button class="sort-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512">
                                <path fill="currentColor" d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z" />
                            </svg>
                        </button></div>
                    <div class="product-cell col-2 stock">Ngày cập nhật<button class="sort-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512">
                                <path fill="currentColor" d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z" />
                            </svg>
                        </button></div>
                    <div class="product-cell col-1-8 price">Chi tiết</div>
                    <div class="product-cell col price">Xóa</div>
                    <div class="product-cell col price">Sửa</div>
                </div>
                <div id="load_product_data"></div>
                <div id="view-detail-product"></div>
                <div id="view-edit-product"></div>
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(() => {
        $(".list-gallery").click(() => {
            //console.log(window.location.href)
            const url = "category.php";
            window.history.pushState("new", "title", url);
            $("#main").load("category.php");
        });

        $(".list-product").click(() => {
            const url = "product.php";
            window.history.pushState("new", "title", url);
            $("#main").load("product.php");
        });

        $('.add-new-product-btn').click((e) => {
            e.preventDefault();

            $('.model__add-new-container').css("display", "block")
        })
        $('.model-close-btn i').click((e) => {
            console.log(e);
            $('.model__add-new-container').css("display", "none");
        })

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
                "http://localhost:3000/admin/modules/quanlysp/handleEvent/handleViewDetail.php?idsanpham=" +
                id;
            $.post(url, (data) => {
                console.log(data)
                $("#view-detail-product").html(data);
                $('.model-close-btn i').click(() => {
                    $('.model__view-detail-container').css("display", "none");
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
                    $('.model__edit-product-container').css("display", "none");
                })
            });
        })

        // Handle search
        $(document).on("keyup", '.search-bar', function() {
            var searchInput = $(this).val();

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
        })

        // Handle filter
        document.querySelector(".jsFilter").addEventListener("click", function() {
            document.querySelector(".filter-menu").classList.toggle("active");
        });

        $('.filter-button.apply').click((e) => {
            var status = $('.filter_status').val();
            $.ajax({
                url: "http://localhost:3000/admin/modules/quanlysp/handleEvent/handleFilter.php",
                data: {
                    status: status,
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
    })
</script>