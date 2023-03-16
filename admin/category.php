<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý danh mục</title>
    <?php include('./js/link.php') ?>
</head>

<body>

    <div class="app-container">
        <div class="main" id="main">
            <?php include('./modules/menu.php') ?>
            <div class="app-content">
                <div class="app-content-header">
                    <h1 class="app-content-headerText">Danh mục</h1>
                    <button class="mode-switch" title="Switch Theme">
                        <svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
                            <defs></defs>
                            <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
                        </svg>
                    </button>
                    <button class="app-content-headerButton add-new-category-btn">
                        Thêm danh mục
                    </button>

                </div>

                <div class="app-content-actions">
                    <div class="app-content-actions-wrapper" style="margin:0;">
                        <input class="search-bar" placeholder="Search..." type="text">
                    </div>
                    <div class="app-content-actions-wrapper">
                        <div class="filter-button-wrapper">
                            <button class="action-button filter jsFilter"><span>Filter</span><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-filter">
                                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                                </svg></button>
                            <div class="filter-menu">
                                <label>Trạng thái</label>
                                <select class="filter_status">
                                    <option value="3">Tất cả trạng thái</option>
                                    <option value="1">Kích hoạt</option>
                                    <option value="0">Ẩn</option>
                                </select>
                                <label>Thời gian</label>
                                <select class="filter_status">
                                    <input type="date">
                                    <input type="date">
                                </select>
                                <div class="filter-menu-buttons">
                                    <button type="reset" class="filter-button reset">
                                        Reset
                                    </button>
                                    <button class="filter-button apply">
                                        Apply
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="filter-button-wrapper">
                            <button class="action-button delete-all-category">Xóa tất cả danh mục</button>
                        </div>
                    </div>
                </div>

                <div class="products-area-wrapper tableView">
                    <div class="products-header">
                        <div class="product-cell col-1-5 image">Thứ tự</div>
                        <div class="product-cell col-2 category">Tên danh mục</div>
                        <div class="product-cell col status-cell">Trạng thái</div>
                        <div class="product-cell col sales">Ngày tạo</div>
                        <div class="product-cell col stock">Ngày cập nhật</div>
                        <div class="product-cell col-1-8 price">Chi tiết</div>
                        <div class="product-cell col-1 price">Xóa</div>
                        <div class="product-cell col-1 price">Sửa</div>
                    </div>
                    <div id="load_category_data"></div>
                    <div id="view-detail-category"></div>
                    <div id="view-edit-category"></div>
                </div>
            </div>

        </div>
    </div>

    <script>
    $(document).ready(() => {
        view_data();
        // View data
        function view_data() {
            $.post('http://localhost:3000/admin/modules/quanlydanhmucsp/handleEvent/listCategoryData.php',
                function(
                    data) {
                    $('#load_category_data').html(data)
                })
        }

        // Remove category
        $(document).on("click", '.remove-category', function() {
            var id = $(this).val();
            var url =
                "http://localhost:3000/admin/modules/quanlydanhmucsp/handleEvent/handleDeleteCategory.php?iddanhmuc=" +
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

        // Delete all category
        $(document).on("click", '.delete-all-category', function() {
            var url =
                "http://localhost:3000/admin/modules/quanlydanhmucsp/handleEvent/handleDeleteCategory.php?action=deleteAll";
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
        $(document).on("click", '.detail-category', function() {
            var id = $(this).val();
            var url =
                "http://localhost:3000/admin/modules/quanlydanhmucsp/handleEvent/handleViewDetail.php?iddanhmuc=" +
                id;
            $.post(url, (data) => {
                $("#view-detail-category").html(data);
                $('.model-close-btn i').click(() => {
                    $('.model__view-detail-container').css("display", "none");
                })
            });
        })

        // Edit category
        $(document).on("click", '.edit-category', function() {
            var id = $(this).val();
            var url =
                "http://localhost:3000/admin/modules/quanlydanhmucsp/sua.php?iddanhmuc=" +
                id;
            $.post(url, (data) => {
                $("#view-edit-category").html(data);
                $('.model-close-btn i').click(() => {
                    $('.model__edit-category-container').css("display", "none");
                })
            });
        })

        // Handle search
        $(document).on("keyup", '.search-bar', function() {
            var searchInput = $(this).val();

            $.ajax({
                url: "http://localhost:3000/admin/modules/quanlydanhmucsp/handleEvent/handleSearch.php",
                data: {
                    searchInput: searchInput,
                },
                dataType: 'html',
                method: "post",
                cache: true,
                success: function(data) {
                    $('#load_category_data').html(data)
                }
            })
        })

        // Handle filter
        $(".jsFilter").on("click", function() {
            console.log('asd');
            $(".filter-menu").classList.toggle("active");
        });

        $('.filter-button.apply').click((e) => {
            var status = $('.filter_status').val();
            $.ajax({
                url: "http://localhost:3000/admin/modules/quanlydanhmucsp/handleEvent/handleFilter.php",
                data: {
                    status: status,
                },
                dataType: 'html',
                method: "post",
                cache: true,
                success: function(data) {
                    console.log(data)
                    $('#load_category_data').html(data)
                }
            })
        })
    })
    </script>
</body>

</html>