<div class="sidebar">
    <div class="sidebar-header">
        <a href="#">Đăng xuất
        </a>
    </div>

    <ul class="sidebar-list">
        <li class="sidebar-list-item">
            <a class="list-gallery">Quản lý danh mục</a>
        </li>
        <li class="sidebar-list-item ">
            <a class="list-product">Quản lý sản phẩm</a>
        </li>
    </ul>
</div>

<script>
    $(document).ready(() => {
        $(".list-gallery").click(() => {
            const url = "category.php";
            window.history.pushState("", "", url);
            $("#main").load("category.php");
        });

        $(".list-product").click(() => {
            const url = "product.php";
            window.history.pushState("", "", url);
            $("#main").load("product.php");
        });
    })
</script>