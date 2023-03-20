<?php
session_start();
?>
<div class="user-modal-wrapper">
    <div class="user-modal">
        <p>Chào mừng khách hàng</p>
        <p><?php echo $_SESSION['login'] ?></p>
        <button class="logout">Đăng xuất
    </div>
    <div class="user-modal-background"></div>
</div>