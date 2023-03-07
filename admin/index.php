<?php
session_start();
if (!isset($_SESSION['dangnhap'])) {
    header('Location: login.php');
}
if ((isset($_GET['dangxuat']) == 1)) {
    unset($_SESSION['dangnhap']);
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/styleadmin.css">
    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <div class="app-container">

        <!-- Sidebar -->
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
                <li class="sidebar-list-item">
                    <a class="list-gallery" href="#danhmuc">Quản lý danh mục sản phẩm</a>
                </li>
                <li class="sidebar-list-item ">
                    <a class="list-product" href="#sanpham">Quản lý sản phẩm</a>
                </li>
                <li class="sidebar-list-item">
                    <a class="list-order" href="#donhang">Quản lý đơn hàng</a>
                </li>
            </ul>
        </div>
        <div class="main" id="main">
            <?php include('modules/quanlydanhmucsp/lietke.php') ?>
        </div>
        <script>
        $(document).ready(() => {
            $(".list-gallery").click(() => {
                //console.log(window.location.href)
                $('#main').load('modules/quanlydanhmucsp/lietke.php');
            })

            $(".list-product").click(() => {
                $('#main').load('modules/quanlysp/lietke.php');
            })

            $(".list-order").click(() => {
                $('#main').load('modules/quanlydonhang/lietke.php');
            })
        })
        </script>
    </div>

    <script src="js/script.js"></script>

</body>

</html>