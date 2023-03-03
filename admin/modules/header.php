<?php
if (isset($_GET['action']) == 'dangxuat') {
    unset($_SESSION['dangnhap']);
    header('Location: login.php');
}

?>

<link rel="stylesheet" href="css/header.css">
<div class="header">
    <a href="index.php?action=dangxuat">Đăng xuất
        <?php
        if (isset($_SESSION['dangnhap'])) {
            echo $_SESSION['dangnhap'];
        }
        ?>
    </a>
</div>