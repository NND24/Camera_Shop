<link rel="stylesheet" href="css/main.css">

<div class="main">
    <?php
    if (isset($_GET['action']) && isset($_GET['query'])) {
        $tam = $_GET['action'];
        $query = $_GET['query'];
    } else {
        $tam = '';
        $query = 'them';
    }

    if ($tam == 'quanlydanhmucsanpham' && $query == 'them') {
        include('modules/quanlydanhmucsp/them.php');
        include('modules/quanlydanhmucsp/lietke.php');
    } else if ($tam == 'quanlydanhmucsanpham' && $query == 'sua') {
        include('modules/quanlydanhmucsp/sua.php');
    } else if ($tam == 'quanlysanpham' && $query == 'them') {
        include('modules/quanlysp/them.php');
        include('modules/quanlysp/lietke.php');
    } else if ($tam == 'quanlysanpham' && $query == 'sua') {
        include('modules/quanlysp/sua.php');
    } else if ($tam == 'quanlydonhang' && $query == 'lietke') {
        include('modules/quanlydonhang/lietke.php');
    } else if ($tam == 'donhang' && $query == 'xemdonhang') {
        include('modules/quanlydonhang/xemdonhang.php');
    } else {
        include('modules/dashboard.php');
    }
    ?>
</div>