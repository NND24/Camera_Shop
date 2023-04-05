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
                if ($row_privilege['list_category'] == 1) {
                ?>
                <div class="app-content-header">
                    <h1 class="app-content-headerText">Danh mục</h1>
                    <?php
                        if ($row_privilege['add_category'] == 1) {
                        ?>
                    <button class="app-content-headerButton add-new-category-btn">
                        Thêm danh mục
                    </button>
                    <?php } ?>
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
                            <div class="filter-menu-cate">
                                <label>Trạng thái</label>
                                <select class="filter_status">
                                    <option value="2">Tất cả trạng thái</option>
                                    <option value="1">Kích hoạt</option>
                                    <option value="0">Ẩn</option>
                                </select>

                                <label>Ngày đăng</label>
                                <select class="filter_dated">
                                    <option value="2">Tất cả</option>
                                    <option value="1">Mới nhất</option>
                                    <option value="0">Cũ nhất</option>
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
                        <?php
                            if ($row_privilege['delete_all_category'] == 1) {
                            ?>
                        <div class="filter-button-wrapper">
                            <button class="action-button delete-all-category">Xóa tất cả danh mục</button>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="products-area-wrapper tableView">
                    <div class="products-header">
                        <div class="product-cell col-1-5 image">Thứ tự</div>
                        <div class="product-cell col-2 category">Tên danh mục</div>
                        <div class="product-cell col status-cell">Trạng thái</div>
                        <div class="product-cell col sales">Ngày tạo</div>
                        <div class="product-cell col stock">Ngày cập nhật</div>
                        <?php
                            if ($row_privilege['detail_category'] == 1) {
                            ?>
                        <div class="product-cell col-1-8 price">Chi tiết</div>
                        <?php } ?>
                        <?php
                            if ($row_privilege['delete_category'] == 1) {
                            ?>
                        <div class="product-cell col-1 price">Xóa</div>
                        <?php } ?>
                        <?php
                            if ($row_privilege['edit_category'] == 1) {
                            ?>
                        <div class="product-cell col-1 price">Sửa</div>
                        <?php } ?>
                    </div>
                    <div id="load_category_data"></div>
                    <div id="view-add-category"></div>
                    <div id="view-detail-category"></div>
                    <div id="view-edit-category"></div>
                </div>

                <script>
                $(document).ready(() => {
                    var pageIndexMainCate = 1
                    view_data();
                    // View data
                    function view_data() {
                        $.post('modules/quanlydanhmucsp/handleEvent/listCategoryData.php?pageIndex=' +
                            pageIndexMainCate,
                            function(
                                data) {
                                $('#load_category_data').html(data)
                            })
                    }

                    $(document).on("click", '.page-link.mainCate', function() {
                        pageIndexMainCate = $(this).attr("value");
                        $.ajax({
                            url: 'modules/quanlydanhmucsp/handleEvent/listCategoryData.php?pageIndex=' +
                                pageIndexMainCate,
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

                    // Add category
                    $(document).on("click", '.add-new-category-btn', function() {
                        var id = $(this).val();
                        var url =
                            "modules/quanlydanhmucsp/addNewCategory.php";
                        $.post(url, (data) => {
                            $("#view-add-category").html(data);
                        });
                    })

                    $(document).on("click", '.close-modal', function() {
                        $("#category__add-model").remove();
                    })

                    $(document).on("click", '.modal__background', function() {
                        $("#category__add-model").remove();
                    })

                    // Remove category
                    $(document).on("click", '.remove-category', function() {
                        var id = $(this).val();
                        var url =
                            "modules/quanlydanhmucsp/handleEvent/handleDeleteCategory.php?iddanhmuc=" +
                            id;
                        swal({
                                title: "Bạn có chắc muốn xóa danh mục này không?",
                                text: "Nếu có danh mục này sẽ bị xóa đi!",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            })
                            .then((willDelete) => {
                                if (willDelete) {
                                    swal("Danh mục đã bị xóa!", {
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
                            "modules/quanlydanhmucsp/handleEvent/handleDeleteCategory.php?action=deleteAll";
                        swal({
                                title: "Bạn có chắc muốn thực hiện thao tác không?",
                                text: "Nếu có tất cả danh mục sẽ bị xóa đi!",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            })
                            .then((willDelete) => {
                                if (willDelete) {
                                    swal("Tất cả danh mục đã bị xóa!", {
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
                            "modules/quanlydanhmucsp/viewDetailCategory.php?iddanhmuc=" +
                            id;
                        $.post(url, (data) => {
                            $("#view-detail-category").html(data);
                        });
                    })

                    $(document).on("click", '.close-modal', function() {
                        $("#category__add-model").remove();
                    })

                    $(document).on("click", '.modal__background', function() {
                        $("#category__add-model").remove();
                    })

                    // Edit category
                    $(document).on("click", '.edit-category', function() {
                        var id = $(this).val();
                        var url =
                            "modules/quanlydanhmucsp/editCategory.php?iddanhmuc=" +
                            id;
                        $.post(url, (data) => {
                            $("#view-edit-category").html(data);
                        });
                    })

                    $(document).on("click", '.close-modal', function() {
                        $("#category__add-model").remove();
                    })

                    $(document).on("click", '.modal__background', function() {
                        $("#category__add-model").remove();
                    })

                    // Handle search
                    var pageIndexCateSearch = 1;
                    $(document).on("keyup", '.search-bar', function() {
                        var searchInput = $(this).val();
                        if (searchInput.length > 0) {
                            $.ajax({
                                url: "modules/quanlydanhmucsp/handleEvent/handleSearch.php?pageIndex=" +
                                    pageIndexCateSearch,
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
                        } else {
                            view_data()
                        }
                    })

                    $(document).on("click", '.page-link.searchCate', function() {
                        pageIndexCateSearch = $(this).attr("value");
                        var searchInput = $('.search-bar').val();
                        if (searchInput.length > 0) {
                            $.ajax({
                                url: "modules/quanlydanhmucsp/handleEvent/handleSearch.php?pageIndex=" +
                                    pageIndexCateSearch,
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
                        } else {
                            view_data()
                        }
                    })

                    // Handle filter
                    $(".jsFilter").on("click", function() {
                        document.querySelector(".filter-menu-cate").classList.toggle("active");
                    });

                    var pageIndexCateFilter = 1
                    $(document).on("click", '.filter-button.apply', function() {
                        var status = $('.filter_status').val();
                        var dated = $('.filter_dated').val();
                        $.ajax({
                            url: "modules/quanlydanhmucsp/handleEvent/handleFilter.php?pageIndex=" +
                                pageIndexCateFilter,
                            data: {
                                status: status,
                                dated: dated
                            },
                            dataType: 'html',
                            method: "post",
                            cache: true,
                            success: function(data) {
                                $('#load_category_data').html(data)
                            }
                        })
                    })

                    $(document).on("click", '.page-link.searchCate', function() {
                        pageIndexCateFilter = $(this).attr("value");
                        var status = $('.filter_status').val();
                        var dated = $('.filter_dated').val();
                        $.ajax({
                            url: "modules/quanlydanhmucsp/handleEvent/handleFilter.php?pageIndex=" +
                                pageIndexCateFilter,
                            data: {
                                status: status,
                                dated: dated
                            },
                            dataType: 'html',
                            method: "post",
                            cache: true,
                            success: function(data) {
                                $('#load_category_data').html(data)
                            }
                        })
                    })

                    $(document).on("click", '.filter-button.reset', function() {
                        $('.filter_status').val('2')
                        $('.filter_dated').val('2')
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