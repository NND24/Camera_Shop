<?php
$mysqli = new mysqli("localhost", "root", "", "camera_shop");
$sql = "SELECT * FROM tbl_admin WHERE id_admin='" . $_GET['idmember'] . "' LIMIT 1";
$query = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_array($query)
?>
<div id="member__add-model">
    <div class="model__container">
        <form>
            <div class="model__add-new">
                <h3>Sửa thành viên</h3>
                <div class="close-modal">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="model__content">
                    <label class="col-2">Tên: </label>
                    <input type="text" class="username" value="<?php echo $row['username'] ?>">
                </div>
                <div class="model__content">
                    <label class="col-2">Email: </label>
                    <input type="text" class="email" value="<?php echo $row['email'] ?>">
                </div>
                <div class="model__content">
                    <label class="col-2">Chức vụ: </label>
                    <select class="duty">
                        <?php if ($row['duty'] == 1) {  ?>
                        <option value="1" selected>Nhân viên</option>
                        <option value="0">Quản lý</option>
                        <?php } else { ?>
                        <option value="1">Nhân viên</option>
                        <option value="0" selected>Quản lý</option>
                        <?php } ?>
                    </select>
                </div>
                <button id="suathanhvien">Sửa thành viên</button>
            </div>
        </form>
        <div class="modal__background"></div>
    </div>
</div>


<script>
$(document).ready(() => {
    // View data
    var pageIndexMainCate = 1

    function view_data() {
        $.post('modules/quanlythanhvien/handleEvent/listMemberData.php?pageIndex=' +
            pageIndexMainCate,
            function(
                data) {
                $('#load_member_data').html(data)
            })
    }

    const validateEmail = (email) => {
        return email.match(
            /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
    };

    // Handle edit member
    $(document).on("click", '#suathanhvien', function(e) {
        e.preventDefault();
        var username = $('.username').val();
        var email = $('.email').val();
        var duty = $('.duty').val();
        let errors = {
            nameError: '',
            emailError: '',
        }

        // Validate member name
        if (username.length === 0) {
            errors.nameError = 'Tên danh mục không được để trống'
            swal("Vui lòng nhập lại", errors.nameError, "error");
            $('.username').val('')
            $('.username').css("border-color", "#ff000087");
        } else {
            errors.nameError = '';
            $('.username').css("border-color", "#008000ab");
        }

        // Validate email
        if (email.length === 0) {
            errors.emailError = "Không được để trống email!";
            $('.email').css("border-color", "#f33a58");
            swal("Vui lòng nhập lại", errors.emailError, "error");
        } else if (!validateEmail(email)) {
            errors.emailError = "Email không hợp lệ!";
            $('.email').css("border-color", "#f33a58");
            swal("Vui lòng nhập lại", errors.emailError, "error");
        } else {
            errors.emailError = '';
            $('#email').css("border-color", "#008000ab");
        }

        if (errors.nameError == '' && errors.emailError == '') {
            $.ajax({
                url: "modules/quanlythanhvien/handleEvent/handleEditMember.php",
                data: {
                    username: username,
                    email: email,
                    duty: duty,
                    idmember: <?php echo $_GET['idmember'] ?>,
                },
                dataType: 'json',
                method: "post",
                cache: true,
                success: function(data) {
                    if (data.existEmail == 1) {
                        swal("Vui lòng nhập lại", 'Thành viên đã tồn tại', "error");
                    } else {
                        swal("OK!", "Sửa thành công", "success");
                        view_data();
                    }
                }
            })
        }
    })
})
</script>