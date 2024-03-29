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
            $sql_admin = "SELECT * FROM tbl_admin WHERE id_admin='" . $_SESSION['dangnhap'] . "' LIMIT 1";
            $query_admin = mysqli_query($mysqli, $sql_admin);
            $row_admin = mysqli_fetch_array($query_admin);

            $sql_privilege = "SELECT * FROM tbl_privilege WHERE id_admin='" . $_SESSION['dangnhap'] . "' LIMIT 1";
            $query_privilege = mysqli_query($mysqli, $sql_privilege);
            $row_privilege = mysqli_fetch_array($query_privilege);
            ?>
            <div class="app-content">
                <?php
                if (($row_privilege['list_member'] == 1 && $row_admin['duty'] == 1) || $row_admin['duty'] == 0) {
                ?>
                <div class="app-content-header">
                    <h1 class="app-content-headerText">Thành viên</h1>
                    <?php
                        if ($row_privilege['add_member'] == 1) {
                        ?>
                    <button class="app-content-headerButton add-new-member-btn">
                        Thêm thành viên
                    </button>
                    <?php } ?>
                </div>

                <div class="app-content-actions">
                    <div class="app-content-actions-wrapper" style="margin:0;">
                        <input class="search-bar" placeholder="Tìm kiếm..." type="text">
                    </div>
                    <div class="app-content-actions-wrapper">
                        <div class="filter-button-wrapper">
                            <button class="action-button filter jsFilter"><span>Lọc</span><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-filter">
                                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                                </svg></button>
                            <div class="filter-menu-cate">
                                <label>Chức vụ</label>
                                <select class="filter_duty">
                                    <option value="2">Tất cả</option>
                                    <option value="1">Quản lý</option>
                                    <option value="0">Nhân viên</option>
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
                            if ($row_privilege['delete_all_member'] == 1) {
                            ?>
                        <div class="filter-button-wrapper">
                            <button class="action-button delete-all-member">Xóa tất cả thành viên</button>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="products-area-wrapper tableView">
                    <div class="products-header">
                        <div class="product-cell col-2 member">Tên thành viên</div>
                        <div class="product-cell col-2 image">Chức vụ</div>
                        <div class="product-cell col sales">Ngày tạo</div>
                        <div class="product-cell col stock">Ngày cập nhật</div>
                        <?php
                            if ($row_privilege['detail_member'] == 1 || $row_admin['duty'] == 0) {
                            ?>
                        <div class="product-cell col-2 price">Phân quyền</div>
                        <?php } ?>
                        <?php
                            if ($row_privilege['delete_member'] == 1) {
                            ?>
                        <div class="product-cell col-1 price">Xóa</div>
                        <?php } ?>
                        <?php
                            if ($row_privilege['edit_member'] == 1) {
                            ?>
                        <div class="product-cell col-1 price">Sửa</div>
                        <?php } ?>
                    </div>
                    <div id="load_member_data"></div>
                    <div id="view-add-member"></div>
                    <div id="view-privilege-member"></div>
                    <div id="view-edit-member"></div>
                </div>
                <script>
                $(document).ready(() => {
                    var pageIndexMainMember = 1
                    view_data();
                    // View data
                    function view_data() {
                        $.post('modules/quanlythanhvien/handleEvent/listMemberData.php?pageIndex=' +
                            pageIndexMainMember,
                            function(
                                data) {
                                $('#load_member_data').html(data)
                            })
                    }

                    $(document).on("click", '.page-link.mainMember', function() {
                        pageIndexMainMember = $(this).attr("value");
                        $.ajax({
                            url: 'modules/quanlythanhvien/handleEvent/listMemberData.php?pageIndex=' +
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
                            "modules/quanlythanhvien/addNewMember.php";
                        $.post(url, (data) => {
                            $("#view-add-member").html(data);
                        });
                    })

                    $(document).on("click", '.close-modal', function() {
                        $("#member__add-model").remove();
                    })

                    $(document).on("click", '.modal__background', function() {
                        $("#member__add-model").remove();
                    })

                    // Remove member
                    $(document).on("click", '.remove-member', function() {
                        var id = $(this).val();
                        var url =
                            "modules/quanlythanhvien/handleEvent/handleDeleteMember.php?idmember=" +
                            id;
                        swal({
                                title: "Bạn có chắc muốn xóa thành viên này không?",
                                text: "Nếu có thành viên này sẽ bị xóa đi!",
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
                            "modules/quanlythanhvien/handleEvent/handleDeletemember.php?action=deleteAll";
                        swal({
                                title: "Bạn có chắc muốn thực hiện thao tác không?",
                                text: "Nếu có tất cả thành viên sẽ bị xóa đi!",
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
                            "modules/quanlythanhvien/editMember.php?idmember=" +
                            id;
                        $.post(url, (data) => {
                            $("#view-edit-member").html(data);
                        });
                    })

                    $(document).on("click", '.close-modal', function() {
                        $("#member__add-model").remove();
                    })

                    $(document).on("click", '.modal__background', function() {
                        $("#member__add-model").remove();
                    })

                    // Privilege member
                    $(document).on("click", '.privilege-member', function() {
                        var id = $(this).val();
                        var url =
                            "modules/quanlythanhvien/viewPrivilegeMember.php?idmember=" +
                            id;
                        $.post(url, (data) => {
                            $("#view-privilege-member").html(data);
                        });
                    })

                    $(document).on("click", '.close-modal', function() {
                        $("#member__add-model").remove();
                    })

                    $(document).on("click", '.modal__background', function() {
                        $("#member__add-model").remove();
                    })

                    // Handle search
                    var pageIndexMemberSearch = 1;
                    $(document).on("keyup", '.search-bar', function() {
                        var searchInput = $(this).val();
                        if (searchInput.length > 0) {
                            $.ajax({
                                url: "modules/quanlythanhvien/handleEvent/handleSearch.php?pageIndex=" +
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
                                url: "modules/quanlythanhvien/handleEvent/handleSearch.php?pageIndex=" +
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
                        document.querySelector(".filter-menu-cate").classList.toggle("active");
                    });

                    var pageIndexMemberFilter = 1
                    $(document).on("click", '.filter-button.apply', function() {
                        var duty = $('.filter_duty').val();
                        $.ajax({
                            url: "modules/quanlythanhvien/handleEvent/handleFilter.php?pageIndex=" +
                                pageIndexMemberFilter,
                            data: {
                                duty: duty,
                            },
                            dataType: 'html',
                            method: "post",
                            cache: true,
                            success: function(data) {
                                $('#load_member_data').html(data)
                            }
                        })
                    })

                    $(document).on("click", '.page-link.search', function() {
                        pageIndexMemberFilter = $(this).attr("value");
                        var duty = $('.filter_duty').val();
                        $.ajax({
                            url: "modules/quanlythanhvien/handleEvent/handleFilter.php?pageIndex=" +
                                pageIndexMemberFilter,
                            data: {
                                duty: duty,
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
                        $('.filter_duty').val('2')
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