<?php
session_start();
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
if (!isset($_SESSION['dangnhap'])) {
    header('Location: login.php');
}
$sql = "SELECT * FROM tbl_admin WHERE email='" . $_SESSION['dangnhap'] . "' LIMIT 1";
$query = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_array($query);
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
        <img class="dashboard" title="Thống kê" src="../../images/icon/menu.png" alt="">
    </button>
    <button class="sidebar-list-item">
        <a class="list-gallery">Quản lý danh mục</a>
        <img class="list-gallery" title="Quản lý danh mục" src="../../images/icon/menu.png" alt="">
    </button>
    <button class="sidebar-list-item ">
        <a class="list-product">Quản lý sản phẩm</a>
        <img class="list-product" title="Quản lý sản phẩm" src="../../images/icon/supply-chain.png" alt="">
    </button>
    <button class="sidebar-list-item">
        <a class="list-order">Quản lý đơn hàng</a>
        <img class="list-order" title="Quản lý đơn hàng" src="../../images/icon/ecommerce.png" alt="">
    </button>
    <button class="sidebar-list-item">
        <a class="list-member">Quản lý thành viên</a>
        <img class="list-member" title="Quản lý thành viên" src="../../images/icon/management.png" alt="">
    </button>

</div>
<div id="view-add-member"></div>

<script>
    $(document).ready(() => {
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

        // 
        $('.sidebar-btn').click(() => {
            document.querySelector(".sidebar").classList.toggle("active");
        })

        $('.header_avatar').click(() => {
            document.querySelector(".header-modal").classList.toggle("active");
        })

        $(document).on("click", '.logout', function(e) {
            e.preventDefault();
            $.ajax({
                url: " admin/modules/handleLogin.php?dangxuat=1",
                dataType: 'json',
                method: "post",
                cache: true,
                success: function(data) {
                    swal("OK!", "Đăng nhập thành công", "success");
                    const url = "login.php";
                    window.history.pushState("new", "title", url);
                    $("#main").load("login.php");

                },
                error: function() {
                    swal("OK!", "Đăng nhập thành công", "success");
                    const url = "login.php";
                    window.history.pushState("new", "title", url);
                    $("#main").load("login.php");
                }
            })
        })

        $(document).on("click", '.manage', function() {
            var id = $(this).val();
            var url =
                " admin/modules/quanlytaikhoan/manageAccount.php";
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
    })
</script>