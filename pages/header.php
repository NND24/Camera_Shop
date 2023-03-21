<?php
session_start();
$sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY thutu ASC LIMIT 9";
$query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
include('./js/link.php');
?>

<header id="header">

    <!-- Header Main -->
    <div class="header_main">
        <div class="header_container">
            <div class="row">
                <!-- Logo -->
                <div class="col-lg-2 col-sm-3 col-3 ">
                    <div class="logo_container">
                        <div class="logo">
                            <a>
                                <img src="images/logo.webp" alt="logo">
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Search -->
                <div class="col-lg-7 col-12  ">
                    <div class="header_search">
                        <div class="header_search_content">
                            <div class="header_search_form_container">
                                <div class="header_search_form">
                                    <input type="search" class="header_search_input" placeholder="Tìm camera...">
                                    <button class="header_search_button">
                                        <img
                                            src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918770/search.png">
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nav option -->
                <div class="col-lg-3 col-9  ">
                    <div class="option_container d-flex flex-row align-items-center justify-content-end">
                        <!-- Cart -->

                        <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                            <a class="cart_icon">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <div class="cart_count"><span>3</span></div>
                            </a>
                        </div>

                        <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                            <div class="user__option">
                                <?php if (isset($_SESSION['login'])) { ?>

                                <i class="fa-solid fa-user roi"></i>
                                <div id="load-user-modal"></div>
                                <?php } else { ?>
                                <i class="fa-solid fa-user chua"></i>
                                <?php } ?>
                            </div>
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
                                            <button class="category__product-btn"
                                                value="<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['ten_danhmuc'] ?></button>
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

<div class="scroll-to-bottom">
    <i>&#8595;</i>
</div>
<div class="scroll-to-top">
    <i>&#8593;</i>
</div>

<div id="view__login"></div>
<script>
$(document).ready(() => {
    $(window).on("load", () => {
        $('.loader-wrapper').fadeOut()
    })

    $(document).on("click", '.category__product-btn', function() {
        var id = $(this).val();
        var url = "shopPage.php?id=" + id;
        window.history.pushState("new", "title", url);
        $(".container").load("shopPage.php?id=" + id);
        $(window).scrollTop(0);
        window.location.reload();
    })

    $(document).on("click", '.logo a', function() {
        var url = "home.php";
        window.history.pushState("new", "title", url);
        $(".container").load("home.php");
        $(window).scrollTop(0);
    })

    $(document).on("click", '.user__option i.chua', function() {
        $("#view__login").load("pages/login.php");
    })

    $(document).on("click", '.user__option i.roi', function() {
        $("#load-user-modal").load("pages/userOptionModal.php");
    })

    $(document).on("click", '.user-modal-background', function() {
        $(".user-modal-wrapper").remove()
    })


    $(document).on("click", '.register-btn', function() {
        $("#view__login").load("pages/register.php");
    })

    $(document).on("click", '.login-btn', function() {
        $("#view__login").load("pages/login.php");
    })

    $(document).on("click", '.logout', function() {
        $.post('http://localhost:3000/pages/handleEvent/handleLogin.php?logout=' + 1, (data) => {
            setTimeout(function() {
                window.location.reload();
            }, 1000);
        });

    })

    $(document).on("click", '.modal-background', function() {
        $(".wrapper").remove();
    })

    $(document).on("click", '.scroll-to-bottom ', function() {
        var height = $(document).height();
        console.log(height)
        height = height - 1070;
        console.log(height)
        $(window).scrollTop(height);
        $('.scroll-to-bottom ').css("display", "none");
        $('.scroll-to-top').css("display", "block");
    })

    $(document).on("click", '.scroll-to-top ', function() {
        $(window).scrollTop(0);
        $('.scroll-to-bottom ').css("display", "block");
        $('.scroll-to-top ').css("display", "none");
    })

    window.onpopstate = function() {
        window.location.reload();
        $(window).scrollTop(0);
    };

    // Search
    $(document).on("click", '.header_search_button ', function() {
        var searchInput = $('.header_search_input').val();
        $.ajax({
            url: "http://localhost:3000/search.php",
            data: {
                searchInput: searchInput,
            },
            dataType: 'html',
            method: "post",
            cache: true,
            success: function(data) {
                let searchInputModified = searchInput.replace(/\s+/g, '-');
                var url = "search.php?tukhoa=" + searchInputModified;
                window.history.pushState("new", "title", url);
                $(".container").load("search.php?tukhoa=" + searchInputModified);
                $(window).scrollTop(0);
            },
        })
    })

    // Add to cart
    $(document).on("click", '.add-to-cart-btn', function() {
        var productID = $(this).val();
        console.log(productID)
        $.ajax({
            url: "http://localhost:3000/pages/handleCart/handleAddToCart.php",
            data: {
                id_sanpham: productID,
            },
            dataType: 'json',
            method: "post",
            cache: true,
            success: function(data) {
                console.log(data)
            },
        })
    })

    $(document).on("click", '.cart_icon', function() {
        var url = "cart.php";
        window.history.pushState("new", "title", url);
        $(".container").load("cart.php");
        $(window).scrollTop(0);
    })

})
</script>