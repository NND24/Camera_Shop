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