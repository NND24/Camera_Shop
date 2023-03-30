<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <?php include('./js/link.php') ?>
</head>

<body>
    <div class="main" id="main">
        <div class="wrapper">
            <form autocomplete="off" class="form" id="form-2">
                <h3 class="heading">Đăng nhập</h3>

                <div class="spacer"></div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="text" placeholder="Nhập email" class="form-control">
                    <span class="form-message"></span>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input id="password" type="password" placeholder="Nhập mật khẩu" class="form-control">
                    <span class="form-message"></span>
                </div>

                <button class="form-submit login">Đăng nhập</button>
            </form>

            <script>
                $(document).ready(() => {
                    $(document).on("click", '.login', function(e) {
                        e.preventDefault();
                        var email = $('#email').val();
                        var password = $('#password').val();

                        $.ajax({
                            url: "http://localhost:3000/admin/modules/quanlytaikhoan/handleLogin.php?dangnhap=1",
                            data: {
                                email: email,
                                password: password,
                            },
                            dataType: 'json',
                            method: "post",
                            cache: true,
                            success: function(data) {
                                if (data.error == 1) {
                                    swal("Vui lòng nhập lại",
                                        "Email hoặc mật khẩu không đúng",
                                        "error");
                                    $('#email').val('')
                                    $('#password').val('')
                                } else {
                                    swal("OK!", "Đăng nhập thành công", "success");
                                    const url = "category.php";
                                    window.history.pushState("new", "title", url);
                                    $("#main").load("category.php");
                                }
                            }
                        })
                    })
                })
            </script>
        </div>
    </div>
</body>

</html>