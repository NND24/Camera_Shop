# CÁC THAO TÁC VỚI MENU

Hiện tại thì menu mới có 1 phần chính là các tab, để có thể điều hướng, thay đổi nội dung ở phía bên phải cả phần header và content

### Giải thích code

Đây là toàn bộ code của phần header hiện tại
`

<html>
    <div class="sidebar">
    <div class="sidebar-header">
        <div href="#">Đăng xuất
        </div>
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
        window.history.pushState("new", "title", url);
        $("#main").load("category.php");
    });

    $(".list-product").click(() => {
        const url = "product.php";
        window.history.pushState("new", "title", url);
        $("#main").load("product.php");
    });
})
</script>
</html>
`
