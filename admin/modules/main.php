<div class="clear"></div>
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
    } else {
        include('modules/dashboard.php');
    }
    ?>
</div>