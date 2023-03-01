<?php
$sql_lietke_danhmucsp = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc='$_GET[iddanhmuc]' LIMIT 1";
$query_lietke_danhmucsp = mysqli_query($mysqli, $sql_lietke_danhmucsp);
?>

<p>Sửa danh mục sản phẩm</p>
<Table width="100%">
    <form method="POST" action="modules/quanlydanhmucsp/xuly.php?iddanhmuc=<?php echo $_GET['iddanhmuc'] ?>">
        <?php 
        while($dong = mysqli_fetch_array($query_lietke_danhmucsp)) {
        ?>
        <tr>
            <td>Tên danh mục</td>
            <td><input type="text" value="<?php echo $dong['ten_danhmuc'] ?>" name="tendanhmuc"></td>
        </tr>
        <tr>
            <td>Thứ tự</td>
            <td><input type="text" value="<?php echo $dong['thutu'] ?>" name="thutu"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="suadanhmuc" value="Sửa danh mục sản phẩm"></td>
        </tr>
        <?php 
        }
        ?>
    </form>
</Table>