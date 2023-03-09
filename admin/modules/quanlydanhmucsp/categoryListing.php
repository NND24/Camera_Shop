</script>
<!-- Ckeditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/decoupled-document/ckeditor.js"></script>

<div class="app-content">

    <?php include('them.php');
    // echo '<pre>'; print_r($_SERVER);  echo '</pre>';
    // exit;
    ?>

    <div class="app-content-header">
        <h1 class="app-content-headerText">Danh mục</h1>
        <button class="mode-switch" title="Switch Theme">
            <svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
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
                <button class="action-button filter jsFilter"><span>Filter</span><svg xmlns="http://www.w3.org/2000/svg"
                        width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter">
                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                    </svg></button>
                <div class="filter-menu">
                    <!-- <label>Category</label>
                    <select>
                        <option>All Categories</option>
                        <option>Furniture</option>
                        <option>Decoration</option>
                        <option>Kitchen</option>
                        <option>Bathroom</option>
                    </select> -->
                    <label>Trạng thái</label>
                    <select class="filter_status">
                        <option value="3">Tất cả trạng thái</option>
                        <option value="1">Kích hoạt</option>
                        <option value="0">Ẩn</option>
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
                <button class="action-button delete-all-category">Xóa tất cả danh mục</button>
            </div>
        </div>
    </div>

    <div class="products-area-wrapper tableView">
        <div class="products-header">
            <div class="product-cell col-1-5 image">
                Thứ tự danh mục
                <button class="sort-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z" />
                    </svg>
                </button>
            </div>
            <div class="product-cell col-2 category">Tên danh mục<button class="sort-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z" />
                    </svg>
                </button></div>
            <div class="product-cell col status-cell">Trạng thái<button class="sort-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z" />
                    </svg>
                </button></div>
            <div class="product-cell col sales">Ngày tạo<button class="sort-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z" />
                    </svg>
                </button></div>
            <div class="product-cell col stock">Ngày cập nhật<button class="sort-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z" />
                    </svg>
                </button></div>
            <div class="product-cell col-1-8 price">Chi tiết</div>
            <div class="product-cell col-1 price">Xóa</div>
            <div class="product-cell col-1 price">Sửa</div>
        </div>
        <div id="load_category_data">

        </div>
        <div id="view-detail-category"></div>
        <div id="view-edit-category"></div>
    </div>
</div>

<script>
$(document).ready(() => {
    // Open add model
    $('.add-new-category-btn').click((e) => {
        e.preventDefault();
        $('.model__add-new-container').css("display", "block")
    })

    // Close model
    $('.model-close-btn i').click((e) => {
        e.preventDefault();
        $('.model__add-new-container').css("display", "none");
    })

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