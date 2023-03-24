<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- Link -->
    <?php include('./js/link.php') ?>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['dangnhap'])) {
        header('Location: login.php');
    }
    if ((isset($_GET['dangxuat']) == 1)) {
        //unset($_SESSION['dangnhap']);
        header('Location: login.php');
    }
    // echo '<pre>'; print_r($_SERVER);  echo '</pre>';
    //exit;
    // $url = "";
    // $regexResult = checkPrivilege();
    // if (!$regexResult) {
    //     echo "Bạn không có quyền truy cập chức năng này";
    // }
    ?>

    <?php include('category.php') ?>

    <script src="js/script.js"></script>

</body>

</html>