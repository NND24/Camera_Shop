<?php
$sql_sua_sanpham = "SELECT * FROM tbl_sanpham WHERE id_sanpham='$_GET[idsanpham]' LIMIT 1";
$query_sua_sanpham = mysqli_query($mysqli, $sql_sua_sanpham);
?>

<p>Sửa sản phẩm</p>
<Table width="100%">
    <form method="POST" action="modules/quanlysp/xuly.php?idsanpham=<?php echo $_GET['idsanpham'] ?>"
        enctype="multipart/form-data">
        <?php 
        while($row = mysqli_fetch_array($query_sua_sanpham)) {
        ?>
        <tr>
            <td>Tên sản phẩm</td>
            <td><input type="text" value="<?php echo $row['tensanpham'] ?>" name="tensanpham"></td>
        </tr>
        <tr>
            <td>Mã sản phẩm</td>
            <td><input type="text" value="<?php echo $row['masp'] ?>" name="masp"></td>
        </tr>
        <tr>
            <td>Gía sản phẩm</td>
            <td><input type="text" value="<?php echo $row['giasp'] ?>" name="giasp"></td>
        </tr>
        <tr>
            <td>Số lượng</td>
            <td><input type="text" value="<?php echo $row['soluong'] ?>" name="soluong"></td>
        </tr>
        <tr>
            <td>Hình ảnh</td>
            <td><input type="file" value="<?php echo $row['hinhanh'] ?>" name="hinhanh"></td>
            <img src="modules/quanlysp/uploads/<?php echo $row['hinhanh'] ?>" width="150px" alt="">
        </tr>
        <tr>
            <td>Tóm tắt</td>
            <td>
                <textarea name="tomtat" rows="5" style="resize:none;"><?php echo $row['tomtat'] ?></textarea>
            </td>
        </tr>
        <tr>
            <td>Nội dung</td>
            <td>
                <textarea name="noidung" rows="5" style="resize:none;"><?php echo $row['noidung'] ?></textarea>
            </td>
        </tr>
        <tr>
            <td>Danh mục sản phẩm</td>
            <td>
                <select name="danhmuc">
                    <?php 
                        $sql_danhmuc = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
                        $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
                        while($row_danhmuc = mysqli_fetch_array($query_danhmuc)) {
                            if($row_danhmuc['id_danhmuc'] == $row['id_danhmuc']) {
                    ?>
                    <option selected value="<?php echo $row_danhmuc['id_danhmuc'] ?>">
                        <?php echo $row_danhmuc['ten_danhmuc'] ?>
                    </option>
                    <?php 
                            } else {     
                    ?>
                    <option value="<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['ten_danhmuc'] ?>
                    </option>
                    <?php 
                        }
                    ?>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Tình trạng</td>
            <td>
                <select name="tinhtrang">

                    <?php 
                    if($row['tinhtrang'] == 1) {
                    ?>
                    <option value="1" selected>Kích hoạt</option>
                    <option value="0">Ẩn</option>
                    <?php 
                    } else {
                    ?>
                    <option value="1" selected>Kích hoạt</option>
                    <option value="0">Ẩn</option>
                    <?php 
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="suasanpham" value="Sửa sản phẩm"></td>
        </tr>
        <?php 
        }
        ?>
    </form>
</Table>