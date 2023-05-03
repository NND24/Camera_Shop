<?php
session_start();
$mysqli = new mysqli("localhost", "id20562858_gpmcamera", "E$/eM/1KHb{b?D23", "id20562858_camera_shop");
if (!isset($_SESSION['dangnhap'])) {
    header('Location: login.php');
}
$sql = "SELECT * FROM tbl_admin WHERE id_admin='" . $_SESSION['dangnhap'] . "' LIMIT 1";
$query = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_array($query);

$sql_privilege = "SELECT * FROM tbl_privilege WHERE id_admin='" . $_SESSION['dangnhap'] . "' LIMIT 1";
$query_privilege = mysqli_query($mysqli, $sql_privilege);
$row_privilege = mysqli_fetch_array($query_privilege)
?>
<div class="sidebar">
    <button class="sidebar-btn">
        <i class="fa-solid fa-bars"></i>
    </button>

    <h1 style="text-align: center;color: #fff;">ADMIN</h1>
    <div class="sidebar-header">
        <div class="header_avatar">
            <i class="fa-solid fa-user"></i>
        </div>
        <div class="header_text">
            <span class="header_name">Tên: <?php echo $row['username'] ?></span>
            <span class="header_duty">Chức vụ:
                <?php
                if ($row['duty'] == 1) {
                    echo 'Nhân viên';
                } else {
                    echo 'Quản lý';
                }
                ?>
            </span>
        </div>

        <div class="header-modal">
            <button class="logout btn btn-danger">Đăng xuất</button>
            <button class="manage btn btn-primary">Đổi mật khẩu</button>
        </div>
    </div>

    <button class="sidebar-list-item">
        <a class="dashboard">Thống kê</a>
        <img class="dashboard" title="Thống kê" src="../../images/icon/dashboard.png" alt="">
    </button>

    <?php
    if ($row_privilege['list_category'] == 1) {
    ?>
        <button class="sidebar-list-item">
            <a class="list-gallery">Quản lý danh mục</a>
            <img class="list-gallery" title="Quản lý danh mục" src="../../images/icon/menu.png" alt="">
        </button>
    <?php
    }
    ?>
    <?php
    if ($row_privilege['list_product'] == 1) {
    ?>
        <button class="sidebar-list-item ">
            <a class="list-product">Quản lý sản phẩm</a>
            <img class="list-product" title="Quản lý sản phẩm" src="../../images/icon/supply-chain.png" alt="">
        </button>
    <?php
    }
    ?>
    <?php
    if ($row_privilege['list_order'] == 1) {
    ?>
        <button class="sidebar-list-item">
            <a class="list-order">Quản lý đơn hàng</a>
            <img class="list-order" title="Quản lý đơn hàng" src="../../images/icon/ecommerce.png" alt="">
        </button>
    <?php
    }
    ?>
    <?php
    if (($row_privilege['list_member'] == 1 && $row['duty'] == 1) || $row['duty'] == 0) {
    ?>
        <button class="sidebar-list-item">
            <a class="list-member">Quản lý thành viên</a>
            <img class="list-member" title="Quản lý thành viên" src="../../images/icon/management.png" alt="">
        </button>
    <?php
    }
    ?>
    <?php
    //if (true) {
    ?>
    <!-- <button class="sidebar-list-item">
        <a class="list-user">Quản lý khách hàng</a>
        <img class="list-user" title="Quản lý khách hàng" src="../../images/icon/guests.png" alt="">
    </button> -->
    <?php
    //}
    ?>
</div>
<div id="view-edit-account"></div>

<script>
    $(document).ready(() => {
        $(".dashboard").click(() => {
            const url = "dashboard.php";
            window.history.pushState("new", "title", url);
            $("#main").load("dashboard.php");
        });

        $(".list-gallery").click(() => {
            const url = "category.php";
            window.history.pushState("new", "title", url);
            $("#main").load("category.php");
        });

        $(".list-product").click(() => {
            const url = "product.php";
            window.history.pushState("new", "title", url);
            $("#main").load("product.php");
        });

        $(".list-order").click(() => {
            const url = "order.php";
            window.history.pushState("new", "title", url);
            $("#main").load("order.php");
        });

        $(".list-member").click(() => {
            const url = "member.php";
            window.history.pushState("new", "title", url);
            $("#main").load("member.php");
        });

        $(".list-user").click(() => {
            const url = "user.php";
            window.history.pushState("new", "title", url);
            $("#main").load("user.php");
        });

        // 
        $('.sidebar-btn').click(() => {
            document.querySelector(".app-container").classList.toggle("active");
        })

        $('.header_avatar').click(() => {
            document.querySelector(".header-modal").classList.toggle("active");
        })

        $(document).on("click", '.logout', function(e) {
            e.preventDefault();
            $.ajax({
                url: "modules/handleLogin.php?dangxuat=1",
                dataType: 'json',
                method: "post",
                cache: true,
                success: function(data) {
                    swal("OK!", "Đăng xuất thành công", "success");
                    const url = "login.php";
                    window.history.pushState("new", "title", url);
                    $("#main").load("login.php");

                },
                error: function() {
                    swal("OK!", "Đăng xuất thành công", "success");
                    const url = "login.php";
                    window.history.pushState("new", "title", url);
                    $("#main").load("login.php");
                }
            })
        })

        $(document).on("click", '.manage', function() {
            var id = $(this).val();
            var url =
                "modules/quanlytaikhoan/manageAccount.php";
            $.post(url, (data) => {
                $("#view-edit-account").html(data);
            });
        })

        $(document).on("click", '.close-modal', function() {
            $("#member__add-model").remove();
        })

        $(document).on("click", '.modal__member-add-background', function() {
            $("#member__add-model").remove();
        })
    })
</script>