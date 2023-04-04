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
                <h3>Phân quyền thành viên</h3>
                <div class="close-modal">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <div class="model__content">
                    <label class="col-2">Tên: </label>
                    <input type="text" readonly class="username" value="<?php echo $row['username'] ?>">
                </div>
                <div class="model__content">
                    <label class="col-2">Email: </label>
                    <input type="text" readonly class="email" value="<?php echo $row['email'] ?>">
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
                <button id="phanquyen">Phân quyền</button>
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

    // Handle edit member
    $(document).on("click", '#phanquyen', function(e) {
        e.preventDefault();
        var duty = $('.duty').val();

        $.ajax({
            url: "modules/quanlythanhvien/handleEvent/handleDecentralizationMember.php",
            data: {
                duty: duty,
                idmember: <?php echo $_GET['idmember'] ?>,
            },
            dataType: 'json',
            method: "post",
            cache: true,
            success: function() {
                swal("OK!", "Phân quyền thành công", "success");
                view_data();
            },
            error: function() {
                swal("OK!", "Phân quyền thành công", "success");
                view_data();
            }
        })

    })
})
</script>