<div class="sidebar">
    <button class="sidebar-btn">

    </button>
    <div class="sidebar-header">
        <a href="index.php?dangxuat=1">Đăng xuất
            <?php
            if (isset($_SESSION['dangnhap'])) {
                echo $_SESSION['dangnhap'];
            }
            ?>
        </a>
    </div>

    <ul class="sidebar-list">
        <li class="sidebar-list-item">
            <a class="list-gallery">Quản lý danh mục</a>
        </li>
        <li class="sidebar-list-item ">
            <a class="list-product">Quản lý sản phẩm</a>
        </li>
        <li class="sidebar-list-item">
            <a class="list-order">Quản lý đơn hàng</a>
        </li>
    </ul>
</div>

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

        // 
        $('.sidebar-btn').click(() => {
            document.querySelector(".sidebar").classList.toggle("active");
        })
    })
</script>