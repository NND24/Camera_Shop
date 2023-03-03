<main class="main">
    <?php
    if (isset($_GET['quanly'])) {
        $tam = $_GET['quanly'];
    } else {
        $tam = '';
    }

    if ($tam == 'danhmucsanpham') {
        include('main/shopPage.php');
    } else if ($tam == 'sanpham') {
        include('main/detailProduct.php');
    } else if ($tam == 'giohang') {
        include('main/cart.php');
    } else if ($tam == 'thanhtoan') {
        include('main/thanhtoan.php');
    } else {
        include('main/home.php');
    }
    ?>
</main>