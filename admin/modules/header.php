<?php
if ((isset($_GET['dangxuat']) == 1)) {
    unset($_SESSION['dangnhap']);
    header('Location: login.php');
}

?>

<link rel="stylesheet" href="css/header.css">
<div class="header">
    <a href="index.php?dangxuat=1">Đăng xuất
        <?php
        if (isset($_SESSION['dangnhap'])) {
            echo $_SESSION['dangnhap'];
        }
        ?>
    </a>
</div>