<?php
include('../../../admin/config/config.php');
$sql = "SELECT * FROM tbl_admin WHERE id_admin='" . $_GET['idmember'] . "' LIMIT 1";
$query = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_array($query);

$sql_privilege = "SELECT * FROM tbl_privilege WHERE id_admin='" . $_GET['idmember'] . "' LIMIT 1";
$query_privilege = mysqli_query($mysqli, $sql_privilege);
$row_privilege = mysqli_fetch_array($query_privilege)
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

                <div class="model__content">
                    <label for="col-12">Danh mục</label>

                    <div class="row">
                        <div class="col-3">
                            <?php
                            if ($row_privilege['list_category'] == 1) {
                            ?>
                                <input checked type="checkbox" class="checkbox " id="check-list-category">
                            <?php
                            } else {
                            ?>
                                <input type="checkbox" class="checkbox " id="check-list-category">
                            <?php
                            }
                            ?>
                            <label for="check-list-category">Danh sách danh mục</label>
                        </div>

                        <div class="col-3">
                            <?php
                            if ($row_privilege['add_category'] == 1) {
                            ?>
                                <input checked type="checkbox" class="checkbox " id="check-add-category">
                            <?php
                            } else {
                            ?>
                                <input type="checkbox" class="checkbox " id="check-add-category">
                            <?php
                            }
                            ?>
                            <label for="check-add-category">Thêm danh mục</label>
                        </div>

                        <div class="col-3">
                            <?php
                            if ($row_privilege['delete_category'] == 1) {
                            ?>
                                <input checked type="checkbox" class="checkbox " id="check-delete-category">
                            <?php
                            } else {
                            ?>
                                <input type="checkbox" class="checkbox " id="check-delete-category">
                            <?php
                            }
                            ?>
                            <label for="check-delete-category">Xóa danh mục</label>
                        </div>

                        <div class="col-3">
                            <?php
                            if ($row_privilege['delete_all_category'] == 1) {
                            ?>
                                <input checked type="checkbox" class="checkbox " id="check-delete-all-category">
                            <?php
                            } else {
                            ?>
                                <input type="checkbox" class="checkbox " id="check-delete-all-category">
                            <?php
                            }
                            ?>
                            <label for="check-delete-all-category">Xóa tất cả danh mục</label>
                        </div>

                        <div class="col-3">
                            <?php
                            if ($row_privilege['detail_category'] == 1) {
                            ?>
                                <input checked type="checkbox" class="checkbox " id="check-detail-category">
                            <?php
                            } else {
                            ?>
                                <input type="checkbox" class="checkbox " id="check-detail-category">
                            <?php
                            }
                            ?>
                            <label for="check-detail-category">Chi tiết danh mục</label>
                        </div>

                        <div class="col-3">
                            <?php
                            if ($row_privilege['edit_category'] == 1) {
                            ?>
                                <input checked type="checkbox" class="checkbox " id="check-edit-category">
                            <?php
                            } else {
                            ?>
                                <input type="checkbox" class="checkbox " id="check-edit-category">
                            <?php
                            }
                            ?>
                            <label for="check-edit-category">Sửa danh mục</label>
                        </div>
                    </div>
                </div>

                <div class="model__content">
                    <label for="col-12">Sản phẩm</label>
                    <div class="row">
                        <div class="col-3">
                            <?php
                            if ($row_privilege['list_product'] == 1) {
                            ?>
                                <input checked type="checkbox" class="checkbox " id="check-list-product">
                            <?php
                            } else {
                            ?>
                                <input type="checkbox" class="checkbox " id="check-list-product">
                            <?php
                            }
                            ?>
                            <label for="check-list-product">Danh sách sản phẩm</label>
                        </div>

                        <div class="col-3">
                            <?php
                            if ($row_privilege['add_product'] == 1) {
                            ?>
                                <input checked type="checkbox" class="checkbox " id="check-add-product">
                            <?php
                            } else {
                            ?>
                                <input type="checkbox" class="checkbox " id="check-add-product">
                            <?php
                            }
                            ?>
                            <label for="check-add-product">Thêm sản phẩm</label>
                        </div>

                        <div class="col-3">
                            <?php
                            if ($row_privilege['delete_product'] == 1) {
                            ?>
                                <input checked type="checkbox" class="checkbox " id="check-delete-product">
                            <?php
                            } else {
                            ?>
                                <input type="checkbox" class="checkbox " id="check-delete-product">
                            <?php
                            }
                            ?>
                            <label for="check-delete-product">Xóa sản phẩm</label>
                        </div>

                        <div class="col-3">
                            <?php
                            if ($row_privilege['delete_all_product'] == 1) {
                            ?>
                                <input checked type="checkbox" class="checkbox " id="check-delete-all-product">
                            <?php
                            } else {
                            ?>
                                <input type="checkbox" class="checkbox " id="check-delete-all-product">
                            <?php
                            }
                            ?>
                            <label for="check-delete-all-product">Xóa tất cả sản phẩm</label>
                        </div>

                        <div class="col-3">
                            <?php
                            if ($row_privilege['detail_product'] == 1) {
                            ?>
                                <input checked type="checkbox" class="checkbox " id="check-detail-product">
                            <?php
                            } else {
                            ?>
                                <input type="checkbox" class="checkbox " id="check-detail-product">
                            <?php
                            }
                            ?>
                            <label for="check-detail-product">Chi tiết sản phẩm</label>
                        </div>

                        <div class="col-3">
                            <?php
                            if ($row_privilege['edit_product'] == 1) {
                            ?>
                                <input checked type="checkbox" class="checkbox " id="check-edit-product">
                            <?php
                            } else {
                            ?>
                                <input type="checkbox" class="checkbox " id="check-edit-product">
                            <?php
                            }
                            ?>
                            <label for="check-edit-product">Sửa sản phẩm</label>
                        </div>
                    </div>
                </div>

                <div class="model__content">
                    <label for="col-12">Đơn hàng</label>
                    <div class="row">
                        <div class="col-3">
                            <?php
                            if ($row_privilege['list_order'] == 1) {
                            ?>
                                <input checked type="checkbox" class="checkbox " id="check-list-order">
                            <?php
                            } else {
                            ?>
                                <input type="checkbox" class="checkbox " id="check-list-order">
                            <?php
                            }
                            ?>
                            <label for="check-list-order">Danh sách đơn hàng</label>
                        </div>

                        <div class="col-3">
                            <?php
                            if ($row_privilege['delete_order'] == 1) {
                            ?>
                                <input checked type="checkbox" class="checkbox " id="check-delete-order">
                            <?php
                            } else {
                            ?>
                                <input type="checkbox" class="checkbox " id="check-delete-order">
                            <?php
                            }
                            ?>
                            <label for="check-delete-order">Xóa đơn hàng</label>
                        </div>

                        <div class="col-3">
                            <?php
                            if ($row_privilege['delete_all_order'] == 1) {
                            ?>
                                <input checked type="checkbox" class="checkbox " id="check-delete-all-order">
                            <?php
                            } else {
                            ?>
                                <input type="checkbox" class="checkbox " id="check-delete-all-order">
                            <?php
                            }
                            ?>
                            <label for="check-delete-all-order">Xóa tất cả đơn hàng</label>
                        </div>

                        <div class="col-3">
                            <?php
                            if ($row_privilege['detail_order'] == 1) {
                            ?>
                                <input checked type="checkbox" class="checkbox " id="check-detail-order">
                            <?php
                            } else {
                            ?>
                                <input type="checkbox" class="checkbox " id="check-detail-order">
                            <?php
                            }
                            ?>
                            <label for="check-detail-order">Duyệt đơn hàng</label>
                        </div>
                    </div>
                </div>

                <div class="model__content">
                    <label for="col-12">Thành viên</label>
                    <div class="row">
                        <div class="col-3">
                            <?php
                            if ($row_privilege['list_member'] == 1) {
                            ?>
                                <input checked type="checkbox" class="checkbox " id="check-list-member">
                            <?php
                            } else {
                            ?>
                                <input type="checkbox" class="checkbox " id="check-list-member">
                            <?php
                            }
                            ?>
                            <label for="check-list-member">Danh sách thành viên</label>
                        </div>

                        <div class="col-3">
                            <?php
                            if ($row_privilege['add_member'] == 1) {
                            ?>
                                <input checked type="checkbox" class="checkbox " id="check-add-member">
                            <?php
                            } else {
                            ?>
                                <input type="checkbox" class="checkbox " id="check-add-member">
                            <?php
                            }
                            ?>
                            <label for="check-add-member">Thêm thành viên</label>
                        </div>

                        <div class="col-3">
                            <?php
                            if ($row_privilege['delete_member'] == 1) {
                            ?>
                                <input checked type="checkbox" class="checkbox " id="check-delete-member">
                            <?php
                            } else {
                            ?>
                                <input type="checkbox" class="checkbox " id="check-delete-member">
                            <?php
                            }
                            ?>
                            <label for="check-delete-member">Xóa thành viên</label>
                        </div>

                        <div class="col-3">
                            <?php
                            if ($row_privilege['delete_all_member'] == 1) {
                            ?>
                                <input checked type="checkbox" class="checkbox " id="check-delete-all-member">
                            <?php
                            } else {
                            ?>
                                <input type="checkbox" class="checkbox " id="check-delete-all-member">
                            <?php
                            }
                            ?>
                            <label for="check-delete-all-member">Xóa tất cả thành viên</label>
                        </div>

                        <div class="col-3">
                            <?php
                            if ($row_privilege['detail_member'] == 1) {
                            ?>
                                <input checked type="checkbox" class="checkbox " id="check-detail-member">
                            <?php
                            } else {
                            ?>
                                <input type="checkbox" class="checkbox " id="check-detail-member">
                            <?php
                            }
                            ?>
                            <label for="check-detail-member">Phân quyền</label>
                        </div>

                        <div class="col-3">
                            <?php
                            if ($row_privilege['edit_member'] == 1) {
                            ?>
                                <input checked type="checkbox" class="checkbox " id="check-edit-member">
                            <?php
                            } else {
                            ?>
                                <input type="checkbox" class="checkbox " id="check-edit-member">
                            <?php
                            }
                            ?>
                            <label for="check-edit-member">Sửa thành viên</label>
                        </div>
                    </div>
                </div>
                <div class="model__button">
                    <button id="phanquyen">Phân quyền</button>
                </div>
            </div>
        </form>
        <div class="modal__background modal__view-privilege"></div>
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

            var listCategory = $('#check-list-category');
            var addCategory = $('#check-add-category');
            var deleteCategory = $('#check-delete-category');
            var deleteAllCategory = $('#check-delete-all-category');
            var detailCategory = $('#check-detail-category');
            var editCategory = $('#check-edit-category');

            var list_category = listCategory.is(':checked') ? 1 : 0;
            var add_category = addCategory.is(':checked') ? 1 : 0;
            var delete_category = deleteCategory.is(':checked') ? 1 : 0;
            var delete_all_category = deleteAllCategory.is(':checked') ? 1 : 0;
            var detail_category = detailCategory.is(':checked') ? 1 : 0;
            var edit_category = editCategory.is(':checked') ? 1 : 0;

            var listProduct = $('#check-list-product');
            var addProduct = $('#check-add-product');
            var deleteProduct = $('#check-delete-product');
            var deleteAllProduct = $('#check-delete-all-product');
            var detailProduct = $('#check-detail-product');
            var editProduct = $('#check-edit-product');

            var list_product = listProduct.is(':checked') ? 1 : 0;
            var add_product = addProduct.is(':checked') ? 1 : 0;
            var delete_product = deleteProduct.is(':checked') ? 1 : 0;
            var delete_all_product = deleteAllProduct.is(':checked') ? 1 : 0;
            var detail_product = detailProduct.is(':checked') ? 1 : 0;
            var edit_product = editProduct.is(':checked') ? 1 : 0;

            var listOrder = $('#check-list-order');
            var deleteOrder = $('#check-delete-order');
            var deleteAllOrder = $('#check-delete-all-order');
            var detailOrder = $('#check-detail-order');

            var list_order = listOrder.is(':checked') ? 1 : 0;
            var delete_order = deleteOrder.is(':checked') ? 1 : 0;
            var delete_all_order = deleteAllOrder.is(':checked') ? 1 : 0;
            var detail_order = detailOrder.is(':checked') ? 1 : 0;

            var listMember = $('#check-list-member');
            var addMember = $('#check-add-member');
            var deleteMember = $('#check-delete-member');
            var deleteAllMember = $('#check-delete-all-member');
            var detailMember = $('#check-detail-member');
            var editMember = $('#check-edit-member');

            var list_member = listMember.is(':checked') ? 1 : 0;
            var add_member = addMember.is(':checked') ? 1 : 0;
            var delete_member = deleteMember.is(':checked') ? 1 : 0;
            var delete_all_member = deleteAllMember.is(':checked') ? 1 : 0;
            var detail_member = detailMember.is(':checked') ? 1 : 0;
            var edit_member = editMember.is(':checked') ? 1 : 0;

            $.ajax({
                url: "modules/quanlythanhvien/handleEvent/handlePrivilegeMember.php",
                data: {
                    duty: duty,
                    list_category: list_category,
                    add_category: add_category,
                    delete_category: delete_category,
                    delete_all_category: delete_all_category,
                    detail_category: detail_category,
                    edit_category: edit_category,

                    list_product: list_product,
                    add_product: add_product,
                    delete_product: delete_product,
                    delete_all_product: delete_all_product,
                    detail_product: detail_product,
                    edit_product: edit_product,

                    list_order: list_order,
                    delete_order: delete_order,
                    delete_all_order: delete_all_order,
                    detail_order: detail_order,

                    list_member: list_member,
                    add_member: add_member,
                    delete_member: delete_member,
                    delete_all_member: delete_all_member,
                    detail_member: detail_member,
                    edit_member: edit_member,

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