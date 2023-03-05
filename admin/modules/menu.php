<link rel="stylesheet" href="css/menu.css">
<?php
if ((isset($_GET['dangxuat']) == 1)) {
    unset($_SESSION['dangnhap']);
    header('Location: login.php');
}
?>

<div class="sidebar">
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
        <li class="sidebar-list-item active">
            <a href="index.php?action=quanlydanhmucsanpham&query=them">Quản lý danh mục sản phẩm</a>
        </li>
        <li class="sidebar-list-item">
            <a href="index.php?action=quanlysanpham&query=them">Quản lý sản phẩm</a>
        </li>
        <li class="sidebar-list-item">
            <a href="index.php?action=quanlybaiviet&query=them">Quản lý bài viết</a>
        </li>
        <li class="sidebar-list-item">
            <a href="index.php?action=quanlydanhmucbaiviet&query=them">Quản lý danh mục bài viết</a>
        </li>
        <li class="sidebar-list-item">
            <a href="index.php?action=quanlydonhang&query=lietke">Quản lý đơn hàng</a>
        </li>
    </ul>
</div>