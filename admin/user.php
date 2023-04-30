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
            // $sql_privilege = "SELECT * FROM tbl_privilege WHERE id_admin='" . $_SESSION['dangnhap'] . "' LIMIT 1";
            // $query_privilege = mysqli_query($mysqli, $sql_privilege);
            // $row_privilege = mysqli_fetch_array($query_privilege);
            ?>
            <div class="app-content">
                <?php
                // if ($row_privilege['list_user'] == 1) {
                ?>
                <div class="app-content-header">
                    <h1 class="app-content-headerText">Khách hàng</h1>
                </div>

                <div class="app-content-actions">
                    <div class="app-content-actions-wrapper" style="margin:0;">
                        <input class="search-bar" placeholder="Tìm kiếm..." type="text">
                    </div>
                    <div class="app-content-actions-wrapper">
                        <div class="filter-button-wrapper">
                            <button class="action-button filter jsFilter"><span>Loc</span><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-filter">
                                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                                </svg></button>
                            <div class="filter-menu-cate">
                                <label>Ngày đăng</label>
                                <select class="filter_dated">
                                    <option value="2">Tất cả</option>
                                    <option value="1">Mới nhất</option>
                                    <option value="0">Cũ nhất</option>
                                </select>
                                <div class="filter-menu-buttons">
                                    <button type="reset" class="filter-button reset">
                                        Đặt lại
                                    </button>
                                    <button class="filter-button apply">
                                        Áp dụng
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php
                        //if ($row_privilege['delete_all_user'] == 1) {
                        ?>
                        <div class="filter-button-wrapper">
                            <button class="action-button delete-all-product">Xóa tất cả khách hàng</button>
                        </div>
                        <?php // } 
                        ?>
                    </div>
                </div>

                <div class="products-area-wrapper tableView">
                    <div class="products-header">
                        <div class="product-cell col-1-5 image">Thứ tự</div>
                        <div class="product-cell col user">Tên khách hàng</div>
                        <div class="product-cell col user">Số điện thoại</div>
                        <div class="product-cell col sales">Ngày tạo</div>
                        <?php
                        //if ($row_privilege['detail_user'] == 1) {
                        ?>
                        <div class="product-cell col price">Chi tiết</div>
                        <?php // } 
                        ?>
                        <?php
                        // if ($row_privilege['delete_user'] == 1) {
                        ?>
                        <div class="product-cell col-1 price">Xóa</div>
                        <?php // } 
                        ?>

                    </div>
                    <div id="load_user_data"></div>
                    <div id="view-add-user"></div>
                    <div id="view-detail-user"></div>
                    <div id="view-edit-user"></div>
                </div>

                <script>
                $(document).ready(() => {
                    var pageIndexMainCate = 1
                    view_data();
                    // View data
                    function view_data() {
                        $.post('modules/quanlykhachhang/handleEvent/listuserData.php?pageIndex=' +
                            pageIndexMainCate,
                            function(
                                data) {
                                $('#load_user_data').html(data)
                            })
                    }

                    $(document).on("click", '.page-link.mainCate', function() {
                        pageIndexMainCate = $(this).attr("value");
                        $.ajax({
                            url: 'modules/quanlykhachhang/handleEvent/listuserData.php?pageIndex=' +
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

                    // Remove user
                    $(document).on("click", '.remove-user', function() {
                        var id = $(this).val();
                        var url =
                            "modules/quanlykhachhang/handleEvent/handleDeleteUser.php?iduser=" +
                            id;
                        swal({
                                title: "Bạn có chắc muốn xóa khách hàng này không?",
                                text: "Nếu có khach hang này sẽ bị xóa đi!",
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
                                    swal("khách hàng đã bị xóa!", {
                                        icon: "success",
                                    });
                                    $.post(url, (data) => {
                                        view_data();
                                    });
                                }
                            });
                    })

                    // Delete all user
                    $(document).on("click", '.delete-all-user', function() {
                        var url =
                            "modules/quanlykhachhang/handleEvent/handleDeleteUser.php?action=deleteAll";
                        swal({
                                title: "Bạn có chắc muốn thực hiện thao tác không?",
                                text: "Nếu có tất cả khách hàng sẽ bị xóa đi!",
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
                                    swal("Tất cả khách hàng đã bị xóa!", {
                                        icon: "success",
                                    });
                                    $.post(url, (data) => {
                                        view_data();
                                    });
                                }
                            });
                    })

                    // View detail user
                    $(document).on("click", '.detail-user', function() {
                        var id = $(this).val();
                        var url =
                            "modules/quanlykhachhang/viewDetailUser.php?idUser=" +
                            id;
                        $.post(url, (data) => {
                            $("#view-detail-user").html(data);
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
                                url: "modules/quanlykhachhang/handleEvent/handleSearch.php?pageIndex=" +
                                    pageIndexCateSearch,
                                data: {
                                    searchInput: searchInput,
                                },
                                dataType: 'html',
                                method: "post",
                                cache: true,
                                success: function(data) {
                                    $('#load_user_data').html(data)
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
                                url: "modules/quanlykhachhang/handleEvent/handleSearch.php?pageIndex=" +
                                    pageIndexCateSearch,
                                data: {
                                    searchInput: searchInput,
                                },
                                dataType: 'html',
                                method: "post",
                                cache: true,
                                success: function(data) {
                                    $('#load_user_data').html(data)
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
                        var dated = $('.filter_dated').val();
                        $.ajax({
                            url: "modules/quanlykhachhang/handleEvent/handleFilter.php?pageIndex=" +
                                pageIndexCateFilter,
                            data: {
                                dated: dated
                            },
                            dataType: 'html',
                            method: "post",
                            cache: true,
                            success: function(data) {
                                $('#load_user_data').html(data)
                            }
                        })
                    })

                    $(document).on("click", '.page-link.searchCate', function() {
                        pageIndexCateFilter = $(this).attr("value");
                        var dated = $('.filter_dated').val();
                        $.ajax({
                            url: "modules/quanlykhachhang/handleEvent/handleFilter.php?pageIndex=" +
                                pageIndexCateFilter,
                            data: {
                                dated: dated
                            },
                            dataType: 'html',
                            method: "post",
                            cache: true,
                            success: function(data) {
                                $('#load_user_data').html(data)
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
                // } else {
                ?>
                <!-- <h1 style="color:#fff;">Bạn không có quyền thực hiện chức năng này</h1> -->
                <?php //} 
                ?>
            </div>
        </div>
    </div>
</body>

</html>