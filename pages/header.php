<?php
session_start();
$sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY thutu ASC";
$query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);

if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {
    unset($_SESSION['dangky']);
    unset($_SESSION['dangnhap']);
    header('Location: index.php');
}
?>

<link rel="stylesheet" href="css/header.css">

<header id="header">

    <!-- Header Main -->

    <div class="header_main">
        <div class="header_container">
            <div class="row">

                <!-- Logo -->
                <div class="col-lg-2 col-sm-3 col-3 ">
                    <div class="logo_container">
                        <div class="logo"><a href="index.php">
                                <img src="images/logo.webp" alt="logo">
                            </a></div>
                    </div>
                </div>

                <!-- Search -->
                <div class="col-lg-7 col-12  ">
                    <div class="header_search">
                        <div class="header_search_content">
                            <div class="header_search_form_container">
                                <form method="POST" action="index.php?quanly=timkiem"
                                    class="header_search_form clearfix">
                                    <input type="search" name="tukhoa" required="required" class="header_search_input"
                                        placeholder="Tìm camera...">

                                    <button type="submit" class="header_search_button trans_300" name="timkiem"
                                        value="Submit"><img
                                            src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918770/search.png"
                                            alt="">
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nav option -->
                <div class="col-lg-3 col-9  ">
                    <div class="option_container d-flex flex-row align-items-center justify-content-end">
                        <!-- Cart -->

                        <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                            <a href="index.php?quanly=giohang" class="cart_icon">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <div class="cart_count"><span>3</span></div>
                            </a>
                        </div>

                        <div class="user_option d-flex flex-row align-items-center justify-content-end">
                            <?php
                            if (isset($_SESSION['dangky']) || isset($_SESSION['dangnhap'])) {
                            ?>
                            <p style="color:white;">Xin chào
                                <?php
                                    if ($_SESSION['dangnhap']) {
                                        echo $_SESSION['dangnhap'];
                                    } else {
                                        echo $_SESSION['dangnhap'];
                                    }
                                    ?></p>
                            <span><a href="index.php?dangxuat=1">Đăng xuất</a></span>
                            <?php
                            } else {
                            ?>
                            <div><a href="index.php?quanly=dangnhap">Đăng nhập</a></div>
                            <div><a href="index.php?quanly=dangky">Đăng ký</a></div>
                            <?php }  ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->

    <nav class="main_nav">
        <div class="header_container">
            <div class="row">
                <div class="col">

                    <div class="main_nav_content d-flex flex-row">

                        <!-- Main Nav Menu -->

                        <div class="main_nav_menu">
                            <ul class="standard_dropdown main_nav_dropdown">
                                <li class="has_subs">
                                    <a href="#"><i class="fa-solid fa-bars"></i><span>Danh mục sản phẩm</span></a>
                                    <ul>
                                        <?php
                                        while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
                                        ?>
                                        <li>
                                            <a
                                                href="index.php?quanly=danhmucsanpham&id=<?php echo $row_danhmuc['id_danhmuc'] ?>">
                                                <i class="fa-solid fa-chevron-right"></i>
                                                <?php echo $row_danhmuc['ten_danhmuc'] ?>
                                            </a>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <li><a href="#">Tin Tức<i class="fas fa-chevron-down"></i></a></li>
                                <li><a href="#">Liên hệ<i class="fas fa-chevron-down"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

</header>