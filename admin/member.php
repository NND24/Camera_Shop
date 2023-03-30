<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý thành viên</title>
    <?php include('./js/link.php') ?>
</head>

<body>
    <div class="app-container">
        <div class="main" id="main">
            <?php include('./modules/menu.php') ?>
            <div class="app-content">
                <div class="app-content-header">
                    <h1 class="app-content-headerText">Thành viên</h1>
                    <button class="app-content-headerButton add-new-member-btn">
                        Thêm thành viên
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
                        <div class="filter-button-wrapper">
                            <button class="action-button delete-all-member">Xóa tất cả thành viên</button>
                        </div>
                    </div>
                </div>

                <div class="products-area-wrapper tableView">
                    <div class="products-header">
                        <div class="product-cell col-2 member">Tên thành viên</div>
                        <div class="product-cell col-2 image">Chức vụ</div>
                        <div class="product-cell col sales">Ngày tạo</div>
                        <div class="product-cell col stock">Ngày cập nhật</div>
                        <div class="product-cell col-2 price">Phân quyền</div>
                        <div class="product-cell col-1 price">Xóa</div>
                        <div class="product-cell col-1 price">Sửa</div>
                    </div>
                    <div id="load_member_data"></div>
                    <div id="view-add-member"></div>
                    <div id="view-detail-member"></div>
                    <div id="view-edit-member"></div>
                </div>
            </div>

        </div>
    </div>

    <script>
    $(document).ready(() => {
        var pageIndexMainMember = 1
        view_data();
        // View data
        function view_data() {
            $.post('http://localhost:3000/admin/modules/quanlythanhvien/handleEvent/listmemberData.php?pageIndex=' +
                pageIndexMainMember,
                function(
                    data) {
                    $('#load_member_data').html(data)
                })
        }

        $(document).on("click", '.page-link.mainMember', function() {
            pageIndexMainMember = $(this).attr("value");
            $.ajax({
                url: 'http://localhost:3000/admin/modules/quanlythanhvien/handleEvent/listmemberData.php?pageIndex=' +
                    pageIndexMainMember,
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

        // Add member
        $(document).on("click", '.add-new-member-btn', function() {
            var id = $(this).val();
            var url =
                "http://localhost:3000/admin/modules/quanlythanhvien/addNewMember.php";
            $.post(url, (data) => {
                $("#view-add-member").html(data);
            });
        })

        $(document).on("click", '.close-modal', function() {
            $("#member__add-model").remove();
        })

        $(document).on("click", '.modal__member-add-background', function() {
            $("#member__add-model").remove();
        })

        // Remove member
        $(document).on("click", '.remove-member', function() {
            var id = $(this).val();
            var url =
                "http://localhost:3000/admin/modules/quanlythanhvien/handleEvent/handleDeleteMember.php?idmember=" +
                id;
            swal({
                    title: "Bạn có chắc muốn xóa thành viên này không?",
                    text: "Nếu có thành viên này sẽ bị xóa đi!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("thành viên đã bị xóa!", {
                            icon: "success",
                        });
                        $.post(url, (data) => {
                            view_data();
                        });
                    }
                });
        })

        // Delete all member
        $(document).on("click", '.delete-all-member', function() {
            var url =
                "http://localhost:3000/admin/modules/quanlythanhvien/handleEvent/handleDeletemember.php?action=deleteAll";
            swal({
                    title: "Bạn có chắc muốn thực hiện thao tác không?",
                    text: "Nếu có tất cả thành viên sẽ bị xóa đi!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Tất cả thành viên đã bị xóa!", {
                            icon: "success",
                        });
                        $.post(url, (data) => {
                            view_data();
                        });
                    }
                });
        })

        // Edit member
        $(document).on("click", '.edit-member', function() {
            var id = $(this).val();
            var url =
                "http://localhost:3000/admin/modules/quanlythanhvien/editMember.php?idmember=" +
                id;
            $.post(url, (data) => {
                $("#view-edit-member").html(data);
            });
        })

        $(document).on("click", '.close-modal', function() {
            $("#member__add-model").remove();
        })

        $(document).on("click", '.modal__member-add-background', function() {
            $("#member__add-model").remove();
        })

        // View detail member
        $(document).on("click", '.detail-member', function() {
            var id = $(this).val();
            var url =
                "http://localhost:3000/admin/modules/quanlythanhvien/viewDetailmember.php?idmember=" +
                id;
            $.post(url, (data) => {
                $("#view-detail-member").html(data);
                $('.model-close-btn i').click(() => {
                    $('.model__view-detail-container').css("display", "none");
                })
            });
        })

        $(document).on("click", '.close-modal', function() {
            $("#member__add-model").remove();
        })

        $(document).on("click", '.modal__member-add-background', function() {
            $("#member__add-model").remove();
        })



        // Handle search
        var pageIndexMemberSearch = 1;
        $(document).on("keyup", '.search-bar', function() {
            var searchInput = $(this).val();
            if (searchInput.length > 0) {
                $.ajax({
                    url: "http://localhost:3000/admin/modules/quanlythanhvien/handleEvent/handleSearch.php?pageIndex=" +
                        pageIndexMemberSearch,
                    data: {
                        searchInput: searchInput,
                    },
                    dataType: 'html',
                    method: "post",
                    cache: true,
                    success: function(data) {
                        $('#load_member_data').html(data)
                    }
                })
            } else {
                view_data()
            }
        })

        $(document).on("click", '.page-link.searchMember', function() {
            pageIndexMemberSearch = $(this).attr("value");
            var searchInput = $('.search-bar').val();
            if (searchInput.length > 0) {
                $.ajax({
                    url: "http://localhost:3000/admin/modules/quanlythanhvien/handleEvent/handleSearch.php?pageIndex=" +
                        pageIndexMemberSearch,
                    data: {
                        searchInput: searchInput,
                    },
                    dataType: 'html',
                    method: "post",
                    cache: true,
                    success: function(data) {
                        $('#load_member_data').html(data)
                    }
                })
            } else {
                view_data()
            }
        })

        // Handle filter
        $(".jsFilter").on("click", function() {
            document.querySelector(".filter-menu-Member").classList.toggle("active");
        });

        var pageIndexMemberFilter = 1
        $(document).on("click", '.filter-button.apply', function() {
            var status = $('.filter_status').val();
            var dated = $('.filter_dated').val();
            $.ajax({
                url: "http://localhost:3000/admin/modules/quanlythanhvien/handleEvent/handleFilter.php?pageIndex=" +
                    pageIndexMemberFilter,
                data: {
                    status: status,
                    dated: dated
                },
                dataType: 'html',
                method: "post",
                cache: true,
                success: function(data) {
                    $('#load_member_data').html(data)
                }
            })
        })

        $(document).on("click", '.page-link.searchMember', function() {
            pageIndexMemberFilter = $(this).attr("value");
            var status = $('.filter_status').val();
            var dated = $('.filter_dated').val();
            $.ajax({
                url: "http://localhost:3000/admin/modules/quanlythanhvien/handleEvent/handleFilter.php?pageIndex=" +
                    pageIndexMemberFilter,
                data: {
                    status: status,
                    dated: dated
                },
                dataType: 'html',
                method: "post",
                cache: true,
                success: function(data) {
                    $('#load_member_data').html(data)
                }
            })
        })

        $(document).on("click", '.filter-button.reset', function() {
            $('.filter_status').val('2')
            $('.filter_dated').val('2')
        })
    })
    </script>
</body>

</html>